<?php
	session_start(); 
	session_name("ssdpvccmm");
if (!isset($_SESSION["pvtacommand_ingsisv"])){echo"<SCRIPT>window.location='../index.php';</SCRIPT>";}	

	include "../estructura/parametros.php";
	include "../conexion/conexion.php";
	$_SESSION["pvtacommand_nivelm"]=2;// nivel de menu
	$_SESSION["pvtacommand_nivelm_sub"]=5; // opcion activa de menu
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
	

	
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<body>
	
	<!-- Start Content -->
	
	
	<div class="row-fluid rrow ">
		<div class="span12 main col" role="main">
			<div class="row-fluid rrow" style="overflow:scroll; height:100%;">
						<div class="filter-bar">
							<form />
								
								<div class="lbl glyphicons cogwheel"><i></i>Descripción:</div>
								<div>											
									<div class="input-append">
										<input type="text" name="describusca" id="describusca"  style="width:200px;height:30px;"   onkeyup="filtradoproductos();"/>
									</div>
									<div class="input-append">
										<div class="btn-group">
											
											<div class="btn-group">
												<!--
												<select class="selectpicker span12" data-style="btn-success" id="agrupador" name="agrupador" onchange="filtradoproductos();">
													<option value="0">Ninguno</option>';
													<?php
													$idunicoe=$_SESSION["pvtacommand_idunicoe"];// id unico de la empresa del usuario
													$consulta="select idunicoa,agrupador  from catagrupadores where idunicoe='$idunicoe' order by agrupador";
													$recordset = mysqli_query($link,$consulta);
													while($registro = mysqli_fetch_array($recordset)){													
														$idunicoa=$registro["idunicoa"];
														$agrupador=$registro["agrupador"];
														echo ' <option value="'.$idunicoa.'">'.$agrupador.'</option>';
													}			
													?>
												</select>

												-->


												<div class="btn-group">
													<button class="btn btn-primary">Selecciona</button>
													<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span> </a>
													<ul class="dropdown-menu pull-right">
														

														<?php
														$idunicoe=$_SESSION["pvtacommand_idunicoe"];// id unico de la empresa del usuario
														$consulta="select idunicoa,agrupador  from catagrupadores where idunicoe='$idunicoe' order by agrupador";
														$recordset = mysqli_query($link,$consulta);
														while($registro = mysqli_fetch_array($recordset)){													
															$idunicoa=$registro["idunicoa"];
															$agrupador=$registro["agrupador"];	
															$namecheck="check_".$idunicoa;														
															echo'<li><a href="#" onclick="seleccionaagrupador('.$idunicoa.');"><input class="selectag" type="checkbox" value="'.$idunicoa.'" id="'.$namecheck.'"/>&nbsp;'.$agrupador.'</a></li>';
														}			
														?>
														
													</ul>
												</div>

											

												


											</div>
										</div>






									</div>
								</div>
								<div class="clearfix"></div>
							</form>
						</div>
					
						<div class="row-fluid">	
							<div class="span9">
								<form class="form-horizontal" />
									<div class="tab-content" style="padding: 0;">
										<div class="tab-pane active" id="account-details">											
											<div class="widget widget-2">
												<div class="widget-head">
													<h4 class="heading glyphicons edit"><i></i>Listado Venta</h4>
												</div>
												<div class="widget-body" style="padding-bottom: 0;">
													<div id="listaproductos">
														<?php include "listaproductos.php";?>
													</div>
												</div>
											</div>

											
										</div>											
									</div>
								</form>
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
	<script type="text/javascript">
	function filtradoproductos(){
		var describusca=$("#describusca").val();
		//var agrupador=$("#agrupador").val();

		var arregloe = new Array();
		var id=0;		
		$(".selectag").each(function(){            
		  if ($(this).attr("checked")){        
			valor=$(this).val(); 
			arregloe[id]=valor;
			id=id+1;
		  }          
		});
		
		
		$.post("listaproductos.php",{describusca:describusca,arregloe:arregloe},function(resultado){			
			$('#listaproductos').html(resultado);
			}
		);
	
		
	}


	function seleccionaagrupador(idunicoa){
		var describusca=$("#describusca").val();
		var nombrecheck="#check_"+idunicoa;		
		if( $(nombrecheck).prop('checked') ) {
		    $(nombrecheck).prop("checked", "");
		}else{
			
			$(nombrecheck).prop("checked", "checked");
		}

		var arregloe = new Array();
		var id=0;		
		$(".selectag").each(function(){            
		  if ($(this).attr("checked")){        
			valor=$(this).val(); 
			arregloe[id]=valor;
			id=id+1;
		  }          
		});
		
		$.post("listaproductos.php",{describusca:describusca,arregloe:arregloe},function(resultado){	
				$('#listaproductos').html(resultado);
			}
		);
	}

	</script>	
	<link rel="stylesheet" type="text/css" href="../theme/css/jquery.dataTables.css">	
	<link rel="stylesheet" type="text/css" href="../theme/css/demo.css">	
	<script type="text/javascript" language="javascript" src="../theme/scripts/jquery.dataTables.js"></script>
</body>
</html>

