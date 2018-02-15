<?php
	session_start();
	session_name("ssdpvccmm");
	include "./estructura/parametros.php";	
	$_SESSION["pvtacommand_nivelm"]=1;
	$_SESSION["pvtacommand_nivelm_sub"]=1; // opcion activa de menu

	if (!isset($_SESSION["pvtacommand_ingsisv"])){
	  echo"<SCRIPT>window.location='index.php';</SCRIPT>";   
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $sys_nombre; ?></title>
	
	<?php include "./estructura/metap.php";?>
<body>
	
	<!-- Start Content -->
	<div class="container-fluid left-menu">		
		<div class="navbar main">			
			<?php include "./estructura/notificaciones.php";?>			
		</div>
		<!-- Content -->
		<div class="row-fluid rrow main">
			<div class="span12 main col" role="main">
				<div class="row-fluid rrow">
					<?php 
						
						include "./estructura/menu.php";
					?>					
					<div class="span10 col main-right">
						<div class="rrow scroll-y" id="mainYScroller">
							<div class="inner topRight">								
								<?php include "./estructura/tituloprincipal.php";?>
								<div class="well">
									<?php include "./estructura/contenidoprincipal.php";?>
								</div>
							<br />							
							</div>
						</div>
					</div>
				</div>
			</div>
		<!-- End Content -->
		</div>
		
		<!-- Sticky Footer -->
		<div id="footer" class="hide">
			<?php include "./estructura/pie.php";?>
	    </div>
		
	</div>
	
	<!-- Cubiq iScroll -->
	<!--[if gte IE 9]><!-->
	<script src="theme/scripts/cubiq-iscroll/src/iscroll.js"></script>	
	<script src="js/script_principal2.js" type="text/javascript"></script>
	<script src="theme/scripts/jquery-ui-1.9.2.custom/js/jquery-ui-1.9.2.custom.min.js"></script>		
	<script src="theme/scripts/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>	
	<script src="theme/scripts/jquery-miniColors/jquery.miniColors.js"></script>	
	<script src="js/colores.js"></script>
	<script src="theme/scripts/jquery.cookie.js"></script>
	<script src="theme/scripts/themer.js"></script>	
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	<script src="theme/scripts/flot/jquery.flot.js" type="text/javascript"></script>
	<script src="theme/scripts/flot/jquery.flot.pie.js" type="text/javascript"></script>
	<script src="theme/scripts/flot/jquery.flot.tooltip.js" type="text/javascript"></script>
	<script src="theme/scripts/flot/jquery.flot.selection.js"></script>
	<script src="theme/scripts/flot/jquery.flot.resize.js" type="text/javascript"></script>
	<script src="theme/scripts/flot/jquery.flot.orderBars.js" type="text/javascript"></script>
	<script src="js/script_principal.js" type="text/javascript"></script>
	<script src="theme/scripts/jquery.ba-resize.js"></script>	
	<script src="theme/scripts/pixelmatrix-uniform/jquery.uniform.min.js"></script>	
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="bootstrap/extend/bootstrap-select/bootstrap-select.js"></script>
	<script src="bootstrap/extend/bootstrap-toggle-buttons/static/js/jquery.toggle.buttons.js"></script>
	<script src="bootstrap/extend/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js"></script>
	<script src="bootstrap/extend/jasny-bootstrap/js/jasny-bootstrap.min.js" type="text/javascript"></script>
	<script src="bootstrap/extend/jasny-bootstrap/js/bootstrap-fileupload.js" type="text/javascript"></script>
	<script src="bootstrap/extend/bootbox.js" type="text/javascript"></script>
	<script src="bootstrap/extend/bootstrap-wysihtml5/js/wysihtml5-0.3.0_rc2.min.js" type="text/javascript"></script>
	<script src="bootstrap/extend/bootstrap-wysihtml5/js/bootstrap-wysihtml5-0.0.2.js" type="text/javascript"></script>	
	<script src="theme/scripts/load.js"></script>	
	<script src="js/cerrarsesion.js"></script>	
	<script>
	google.load('visualization', '1.0', {'packages':['table', 'corechart']});
	google.setOnLoadCallback(charts.traffic_sources_dataTables.init);
	</script>

</body>
</html>