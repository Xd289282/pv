<?php
	session_start(); 
	session_name("ssdpvccmm");
	if (!isset($_SESSION["pvtacommand_ingsisv"])){echo"<SCRIPT>window.location='../index.php';</SCRIPT>";}	
	include "../estructura/parametros.php";
	include "../conexion/conexion.php";
	$_SESSION["pvtacommand_nivelm"]=2;// nivel de menu
	$_SESSION["pvtacommand_nivelm_sub"]=6; // opcion activa de menu
	$btnsele=$_SESSION["pvtacommand_btnventa"];//0 esta seleccionado boton cantidad 1 boton codigo
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

	<link href="../theme/css/jquery.alerts.css" rel="StyleSheet" type="text/css" />
	
	

	<link rel="stylesheet" href="../theme/css/style.min.css?1359188910" />
	<style>
		.modal.ventana1 { width:800px; height:500px; }
		.ventana1 .modal-body { height:500px; }

		.modal.ventana2 { width:700px; height:600px; }
		.ventana2 .modal-body { height:600px; }

		.modal.videobox { width:1000px; height:600px; }
		.videobox .modal-body { height:600px; }

		.modal-content {
		  width: 900px;
		  margin-left: -150px;
		}

		.class-with-width { width: 500px !important; }

		.btnseleccionado{background-color:green;}



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
<div class="container-fluid left-menu">		
	<div class="navbar main">
		<?php include "../estructura/notificaciones.php";?>
	</div>
	
	<div class="row-fluid rrow main">
		<div class="span12 main col" role="main">
			<div class="row-fluid rrow">
				<?php include "../estructura/menu.php";?>	
				<div class="span10 col main-right">
					<div class="rrow scroll-y" id="mainYScroller">
						<?php include "../estructura/titular_menu.php";?>
						<div class="separator"></div>
						<div class="heading-buttons">
						</div>
						<div class="separator"></div>
						<div class="filter-bar">
							<form />
								<div id="selecantidad" class="lbl glyphicons cogwheel" <?php if($btnsele==0){ echo 'style="background-color:green"';}?>><i></i>Cantidad:</div>
								<div>			
									<div class="input-append">
										<div class="input-append" >
											<input type="text" name="cantidad" id="cantidad"  value="1"  style="width:80px;height:30px;font-size:20px; font-weight: bold;"  />
										</div>
									</div>
								</div>
								<div  id="selecodigo" class="lbl glyphicons cogwheel"<?php if($btnsele==1){ echo 'style="background-color:green"';}?>><i></i>Codigo:</div>
								<div>											
									<div class="input-append">
										<input type="text" name="codigo" id="codigo" class='large'  style="width:200px;height:30px;font-size:20px; font-weight: bold;" />
									</div>
									<div class="input-append">
										<button class="btn" style="height:37px;" id="ventana1">
											<p><span class="glyphicons search" ><i></i></span></p>
										</button>										
									</div>

									<div  id="sucu" class="lbl glyphicons cogwheel"><i></i>Sucursal a Traspasar:</div>
									<div class="input-append">
										
										<select class="selectpicker " data-style="btn-success" id="sucursal" name="sucursal" style="height:3em;">
											<option value="0"/>Seleccione
											<?php
											$idunicoe=$_SESSION["pvtacommand_idunicoe"];// id unico de la empresa del usuario
											$idsesion=$_SESSION["pvtacommand_idsesion"];// id de la sesion del usuario
											$idunicoe=$_SESSION["pvtacommand_idunicoe"];// id unico de la empresa
											$idunicos=$_SESSION["pvtacommand_idunicos"];// id unico de la sucursal
											
											$consulta="select idunicos,nombre from sucursal where idunicoe='$idunicoe' and idunicos<>'$idunicos' order by nombre";
											$recordset = mysqli_query($link,$consulta);
											while($registro = mysqli_fetch_array($recordset)){
												$idunicos=$registro["idunicos"];
												$nombre=$registro["nombre"];
												echo'<option value="'.$idunicos.'"/>'.$nombre;
											}
											?>
										</select>

									</div>


									<div class="input-append">										
										<button class="btn btn-primary btn-large btn-icon glyphicons print" id="generatraspaso"><i></i>Generar Traspaso</button>
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
													<h4 class="heading glyphicons edit"><i></i>Listado Productos</h4>
												</div>
												<div class="widget-body" style="padding-bottom: 0;">
													<div id="listadoventas">

														<?php include "listadoventas.php";?>
													</div>
												</div>
											</div>

											<div class="row-fluid" id="totales">												
												<?php include "totales.php";?>
											</div>
										</div>											
									</div>
								</form>
							</div>
										
							<div class="span3" id="calc">
								<?php include "calc.php";?>


							</div>
						</div>
							
					</div>
				</div>
			</div>
		</div>
	</div>
		<!-- End Content -->
</div>
		
		<!-- Sticky Footer -->
<div id="footer" class="hide">
	<?php include "../estructura/pie.php";?>
</div>
	
	<!-- Cubiq iScroll -->
	<!--[if gte IE 9]><!-->
	<script src="../theme/scripts/cubiq-iscroll/src/iscroll.js"></script>	
	<script src="../theme/scripts/jquery-ui-1.9.2.custom/js/jquery-ui-1.9.2.custom.min.js"></script>
	<script src="../theme/scripts/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
	<script src="../theme/scripts/jquery-miniColors/jquery.miniColors.js"></script>
	<script>
	var themerPrimaryColor = '#DA4C4C',
		themerHeaderColor = '#393D41',
		themerMenuColor = '#232628';
	</script>
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
	<script src="traspasos_js.js"></script>

	<!--tablas -->
	<link rel="stylesheet" type="text/css" href="../theme/css/jquery.dataTables.css">	
	<link rel="stylesheet" type="text/css" href="../theme/css/demo.css">	
	<script type="text/javascript" language="javascript" src="../theme/scripts/jquery.dataTables.js"></script>


	<script src="../theme/scripts/jquery.ui.draggable.js" type="text/javascript"></script>
	<script src="../theme/scripts/jquery.alerts.mod.js" type="text/javascript"></script>


	<script type="text/javascript">
	

	</script>
	
</body>
</html>
