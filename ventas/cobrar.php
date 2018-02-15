<?php
	session_start(); 
	session_name("ssdpvccmm");
	if (!isset($_SESSION["pvtacommand_ingsisv"])){echo"<SCRIPT>window.location='../index.php';</SCRIPT>";}	

	include "../estructura/parametros.php";
	include "../conexion/conexion.php";
	$_SESSION["pvtacommand_nivelm"]=2;// nivel de menu
	$_SESSION["pvtacommand_nivelm_sub"]=5; // opcion activa de menu



	
	include "../estructura/parametros.php";
	include "../conexion/conexion.php";
	$idunicoe=$_SESSION["pvtacommand_idunicoe"];// id unico de la empresa del usuario
	$idsesion=$_SESSION["pvtacommand_idsesion"];// id de la sesion del usuario
	$idunicoe=$_SESSION["pvtacommand_idunicoe"];// id unico de la empresa
	$idunicos=$_SESSION["pvtacommand_idunicos"];// id unico de la sucursal
	//numero de productos
	$noproductos=0;
	$consulta="select sum(cantidad) as noproductos  from tmpventas where idsesion='$idsesion' and idunicoe='$idunicoe' ";
	$recordset = mysqli_query($link,$consulta);
	while($registro = mysqli_fetch_array($recordset)){$noproductos=$registro["noproductos"];}
	if(!isset($noproductos)){$noproductos=0;}
	//descuento de productos e importe total precio venta
	
	$importet=0;$descuento=0;$total=0;$sumadesc=0;
	$consulta="select a.cantidad,b.pmostrador,b.iva,b.descuento,a.precio from tmpventas as a left join productos as b on a.idunicoe=b.idunicoe and a.idunicop=b.idunicop where a.idsesion='$idsesion' and a.idunicoe='$idunicoe' and a.idunicos='$idunicos'";
	$recordset = mysqli_query($link,$consulta);
	while($registro = mysqli_fetch_array($recordset)){
		$cantidad=$registro["cantidad"];
		//$pmostrador=$registro["pmostrador"];
		$pmostrador=$registro["precio"];
		$iva=$registro["iva"];
		//$descuento=$registro["descuento"];
		$descuento=10;


		if($iva>0){
			$iva=$iva/100;
			$iva=round($iva,2);	
			$iva=1+$iva;
			//$pmostrador=((($pmostrador*$cantidad)-($cantidad*10)))*$iva;
			$pmostrador=((($pmostrador*$cantidad)))*$iva;	
		}

		if($descuento>0){
			$descuento=$descuento/100;		
			$descuento=round($descuento,2);
			//$sumadesc=$sumadesc+($pmostrador*$descuento);
			//$sumadesc=$sumadesc+($cantidad*10); se desactiva
		}	

		$importet=$importet+($pmostrador*$cantidad);

		
	}

	//$total=$importet-$sumadesc;
	$total=$importet;
	$totalmostrar=number_format($total,2);

?>
<!DOCTYPE html>
<html> 
<head>
	<title><?php echo $sys_nombre; ?></title>
	<?php //include "../estructura/meta.php"; ?>	
	
	<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="../bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" />
	<link href="../bootstrap/extend/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet" />
	<link href="../bootstrap/extend/jasny-bootstrap/css/jasny-bootstrap-responsive.min.css" rel="stylesheet" />
	<link href="../bootstrap/extend/bootstrap-wysihtml5/css/bootstrap-wysihtml5-0.0.2.css" rel="stylesheet" />
	<link rel="stylesheet" href="../theme/scripts/jquery-ui-1.9.2.custom/css/smoothness/jquery-ui-1.9.2.custom.min.css" />
	<link rel="stylesheet" href="../theme/css/glyphicons.css" />
	<link rel="stylesheet" href="../bootstrap/extend/bootstrap-select/bootstrap-select.css" />
	<link rel="stylesheet" href="../bootstrap/extend/bootstrap-toggle-buttons/static/stylesheets/bootstrap-toggle-buttons.css" />
	<link rel="stylesheet" media="screen" href="../theme/scripts/pixelmatrix-uniform/css/uniform.default.css" />
	<script src="../theme/scripts/jquery-1.8.2.min.js"></script>
	<script src="../theme/scripts/modernizr.custom.76094.js"></script>
	<link rel="stylesheet" media="screen" href="../theme/scripts/jquery-miniColors/jquery.miniColors.css" />
	<style type="text/css">@import url(../theme/scripts/plupload/js/jquery.plupload.queue/css/jquery.plupload.queue.css);</style>
	<link rel="stylesheet" href="../theme/css/style.min.css?1359188910" />
	<!-- LESS 2 CSS -->
	<script src="../theme/scripts/less-1.3.3.min.js"></script>
	

	<link href="../theme/css/jquery.alerts.css" rel="StyleSheet" type="text/css" />

	<link rel="stylesheet" href="../theme/css/style.min.css?1359188910" />
	<style>
		

		.numberCircle {
    border-radius: 50%;
    behavior: url(PIE.htc); /* remove if you don't care about IE8 */
    width: 36px;
    height: 36px;
    padding: 8px;
    background: #fff;
    border: 2px solid black;
    color: black;
    text-align: center;
    font: 32px Arial, sans-serif;
    display: inline-block;
}
	</style>	
	<!-- LESS 2 CSS -->
	<script src="../theme/scripts/less-1.3.3.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<body>
	
	<!-- Start Content -->
	
	
	<div class="row-fluid rrow ">
		<div class="span12 main col" role="main">
			<div class="row-fluid rrow">

						<div class="widget widget-2 widget-body-white finances_summary">
							<div class="widget-head">
								<h4 class="heading glyphicons print"><i></i> Resumen Venta</h4>
							</div>
							<div class="widget-body">
								<div class="row-fluid">
									<div class="span4">
										<table width="100%">
											<tr>	
												<td width="60%">
													<div class="well">
														Total de Venta<strong>$<?php echo $totalmostrar;?></strong>
													</div>
													
													<div class="well">
														Su Pago <strong><input id="supago" class="span10" type="number" onkeyup="calcv2(this.value);" placeholder="0" style="font-size: 30px;font-weight: bold; height: 50px;text-align: center;" /></strong>
													</div>

													<div class="well">
														Cambio<div id="cambio"><strong>$</strong></div>
													</div>

													<div class="well" id="divimpticket">
														<button class="btn btn-primary btn-large btn-icon glyphicons print" id="imprimirticket"><i></i>Imprimir Ticket</button>
													</div>
												</td>
												
												<td>	
													<div class="widget widget-2 primary widget-body-white">
														<div class="widget-head">
															<h4 class="heading glyphicons pencil"><i></i></h4>
														</div>
														<div class="widget-body" align="center">
															<table width="100%" border="0">
																<tr>
																	<td>
																		<a href="#" class="btn btn-primary" onclick="calcv(7);"><i class="fa fa-user"><div class="numberCircle">7</div></i></a>
																	</td>
																	<td>
																		<a href="#" class="btn btn-primary" onclick="calcv(8);"><i class="fa fa-user"><div class="numberCircle">8</div></i></a>
																	</td>
																	<td>
																		<a href="#" class="btn btn-primary" onclick="calcv(9);"><i class="fa fa-user"><div class="numberCircle">9</div></i></a>
																	</td>
																	<td rowspan="2">
																		<button class="btn btn-primary" onclick="cobrar();" style="height:100%;"><i class="fa fa-user">Enter..</i></button>
																	</td>
																	
																</tr>
																<tr>
																	<td>
																		<a href="#" class="btn btn-primary" onclick="calcv(4);"><i class="fa fa-user"><div class="numberCircle">4</div></i></a>												
																	</td>
																	<td>
																		<a href="#" class="btn btn-primary" onclick="calcv(5);"><i class="fa fa-user"><div class="numberCircle">5</div></i></a>
																	</td>
																	<td>
																		<a href="#" class="btn btn-primary" onclick="calcv(6);"><i class="fa fa-user"><div class="numberCircle">6</div></i></a>
																	</td>
																	
																</tr>
																<tr>
																	<td>
																		<a href="#" class="btn btn-primary" onclick="calcv(1);"><i class="fa fa-user"><div class="numberCircle">1</div></i></a>
																	</td>
																	<td>
																		<a href="#" class="btn btn-primary" onclick="calcv(2);"><i class="fa fa-user"><div class="numberCircle">2</div></i></a>
																	</td>
																	<td>
																		<a href="#" class="btn btn-primary" onclick="calcv(3);"><i class="fa fa-user"><div class="numberCircle">3</div></i></a>
																	</td>
																	<td rowspan="2">
																		<button class="btn btn-primary" onclick="borrarv();" style="height:100%;"><i class="fa fa-user">Borrar</i></button>

																		
																	</td>																	
																</tr>
																<tr>
																	<td>
																		<button class="btn btn-primary btn-lg btn-block" onclick="calcv(-1);"><i class="fa fa-user"><div class="numberCircle">.</div></i></button>
																	</td>

																	<td colspan="2">
																		<button class="btn btn-primary btn-lg btn-block" onclick="calcv(0);"><i class="fa fa-user"><div class="numberCircle">0</div></i></button>
																	</td>																	
																</tr>																
															</table>
														</div>
													</div>	
												</td>
											</tr>
										</table>									
									</div>									
								</div>								
							</div>
						</div>							
					
			</div>
		</div>
	</div>
		<!-- End Content -->

		
		<!-- Sticky Footer -->

	
	<!-- Cubiq iScroll -->
	<!--[if gte IE 9]><!-->
	

	<script src="../theme/scripts/cubiq-iscroll/src/iscroll.js"></script>	
	<script src="../theme/scripts/jquery-ui-1.9.2.custom/js/jquery-ui-1.9.2.custom.min.js"></script>
	<script src="../theme/scripts/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
	<script src="../theme/scripts/jquery-miniColors/jquery.miniColors.js"></script>
	
	<script src="../theme/scripts/jquery.cookie.js"></script>
	<script src="../theme/scripts/themer.js"></script>
	<script src="../theme/scripts/jquery.ba-resize.js"></script>
	<script src="../theme/scripts/pixelmatrix-uniform/jquery.uniform.min.js"></script>
	<script src="../bootstrap/js/bootstrap.min.js"></script>
	<script src="../bootstrap/extend/bootstrap-select/bootstrap-select.js"></script>
	<script src="../bootstrap/extend/bootstrap-toggle-buttons/static/js/jquery.toggle.buttons.js"></script>
	<script src="../bootstrap/extend/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js"></script>
	<script src="../bootstrap/extend/jasny-bootstrap/js/jasny-bootstrap.min.js" type="text/javascript"></script>
	<script src="../bootstrap/extend/jasny-bootstrap/js/bootstrap-fileupload.js" type="text/javascript"></script>
	<script src="../bootstrap/extend/bootbox.js" type="text/javascript"></script>
	<script src="../bootstrap/extend/bootstrap-wysihtml5/js/wysihtml5-0.3.0_rc2.min.js" type="text/javascript"></script>
	<script src="../bootstrap/extend/bootstrap-wysihtml5/js/bootstrap-wysihtml5-0.0.2.js" type="text/javascript"></script>
	<script src="../theme/scripts/load.js"></script>
	<script type="text/javascript" src="../theme/scripts/browserplus-min.js"></script>
	<script type="text/javascript" src="../theme/scripts/plupload/js/plupload.full.js"></script>
	<script type="text/javascript" src="../theme/scripts/plupload/js/jquery.plupload.queue/jquery.plupload.queue.js"></script>
	<script src="ventas_js.js"></script>

	<script src="../theme/scripts/jquery.alerts.mod.js" type="text/javascript"></script>
	<script type="text/javascript">
	

	function calcv(valor){		
		

		var actual=$('#supago').val();		
		if (isNaN(actual)){actual=0;}
		if(valor==-1){
			actual=actual+'.0';
		}else{
			if (isNaN(valor)){valor=0;}	
			actual=actual+valor;
		}
			
		
		$("#supago").val(actual);

		var total=<?php echo $total;?>;
		var cambio=0;
		cambio=actual-total;
		

		$(	'#cambio').html('$'+cambio.toFixed(2));
		$( '#cambio' ).css('font-weight', 'bold');
		$( '#cambio' ).css('fontSize', '30px');
		$( '#cambio' ).css('color', 'red');	
	
		$( "#supago" ).focus();
	}

	function calcv2(valor){
		
		var total=<?php echo $total;?>;
		var cambio=0;
		cambio=valor-total;
		
		
		$(	'#cambio').html('$'+cambio.toFixed(2));
		$( '#cambio' ).css('font-weight', 'bold');
		$( '#cambio' ).css('fontSize', '30px');
		$( '#cambio' ).css('color', 'red');
		$( "#supago" ).focus();
	}

	function borrarv(){		
		$('#supago').val('');
		$(	'#cambio').html('$');
		$( '#cambio' ).css('font-weight', 'bold');
		$( '#cambio' ).css('fontSize', '30px');
		$( '#cambio' ).css('color', 'red');

		$( "#supago" ).focus();
		
	}
	

	$( "#imprimirticket" ).click(function() {
		cobrar();
	});

	function cobrar(){
		var total=<?php echo $total;?>;
		var pago=$('#supago').val();

		if(total<=pago){
			
			$.post("guardaventa.php",{pago:pago},function(resultado){
                    
                                       
                    
                    if(resultado==0){
                    	//location.reload();
			      		$('#imprimirticket').hide();			      		
			      		
			      		var caracteristicas = "height=700,width=800,scrollTo,resizable=1,scrollbars=1,location=0";
			      		nueva=window.open("../reportes/ticket.php", 'Popup', caracteristicas);
			      		return false;
                    	
                    }else{
                    	alert("Venta No Guardada");
                    }

                    

			      	




                      
                }
            );

		}else{
		  	jAlert('Valor Pago Incorrecto');
		}
		$( "#supago" ).focus();
	}
	</script>	

</body>
</html>

