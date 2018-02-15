<?php
	session_start(); 
	session_name("ssdpvccmm");
	if (!isset($_SESSION["pvtacommand_ingsisv"])){echo"<SCRIPT>window.location='../index.php';</SCRIPT>";}	
	include "../estructura/parametros.php";	
?>
<!DOCTYPE html>
<html> 
<head>
	<title><?php echo $sys_nombre; ?></title>
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
							<div class="inner topRight">
								<?php include "../estructura/titular_menu.php";?>
								<div class="separator"></div>
								<div class="heading-buttons">
									<h2 class="glyphicons bookmark"><i></i>Inventario</h2>
									<div class="buttons pull-right">
										
									</div>
								</div>
								<div class="separator"></div>
								<div class="row-fluid">									
									
									<div class="widget widget-2 widget-tabs">
										<?php include "inventario_edit.php";?>	
									</div>
									
									
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
	      	<?php include "../estructura/pie.php";?>
	    </div>		
	</div>	
	<script src="../theme/scripts/cubiq-iscroll/src/iscroll.js"></script>	
	<script src="../js/script.js" type="text/javascript"></script>	
	<script src="../theme/scripts/jquery-ui-1.9.2.custom/js/jquery-ui-1.9.2.custom.min.js"></script>		
	<script src="../theme/scripts/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>		
	<script src="../theme/scripts/jquery-miniColors/jquery.miniColors.js"></script>		
	<script src="../js/colores.js"></script>
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

	<!--tablas -->
	<link rel="stylesheet" type="text/css" href="../theme/css/jquery.dataTables.css">	
	<link rel="stylesheet" type="text/css" href="../theme/css/demo.css">	
	<script type="text/javascript" language="javascript" src="../theme/scripts/jquery.dataTables.js">
	</script>	
	<script type="text/javascript" language="javascript" class="init">
		$(document).ready(function() {
			$('#example').DataTable( {
				columnDefs: [ {
					targets: [ 0 ],
					orderData: [ 0, 1 ]
				}, {
					targets: [ 1 ],
					orderData: [ 1, 0 ]
				}, {
					targets: [ 4 ],
					orderData: [ 4, 0 ]
				} ]
			} );
		} );




	$.validator.setDefaults(
	{
		submitHandler: function() {
			 acciones_sql();
		},
		showErrors: function(map, list)
		{
			this.currentElements.parents('label:first, .controls:first').find('.error').remove();
			this.currentElements.parents('.control-group:first').removeClass('error');

			$.each(list, function(index, error)
			{
				var ee = $(error.element);
				var eep = ee.parents('label:first').length ? ee.parents('label:first') : ee.parents('.controls:first');

				ee.parents('.control-group:first').addClass('error');
				eep.find('.error').remove();
				eep.append('<p class="error help-block"><span class="label label-important">' + error.message + '</span></p>');
			});
			//refreshScrollers();
		}
	});
	</script>
	<!--tablas -->
	<!--validacion -->
	<script src="../theme/scripts/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>	
	<script src="inventario_js.js" type="text/javascript"></script>
	<!--validacion -->
</body>
</html>