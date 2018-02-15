<?php
	session_start(); 
	session_name("ssdpvccmm");
	if (!isset($_SESSION["pvtacommand_ingsisv"])){echo"<SCRIPT>window.location='../index.php';</SCRIPT>";}	
	include "../estructura/parametros.php";
	$_SESSION["pvtacommand_nivelm"]=2;// nivel de menu
	$_SESSION["pvtacommand_nivelm_sub"]=8; // opcion activa de menu

?>
<!DOCTYPE html>
<html> 
<head>
	<title><?php echo $sys_nombre; ?></title>
	<?php include "../estructura/meta.php"; ?>	
<body>	
	<!-- Start Content -->
	<div class="container-fluid left-menu">		
		<div class="navbar main">
			<?php include "../estructura/notificaciones.php";?>
		</div>	
		<div class="row-fluid rrow main">
			<div class="span12 main col" role="main">
				<div class="row-fluid rrow">
					<?php 
						
						include "../estructura/menu.php";?>	

					<div class="span10 col main-right">
						<div class="rrow scroll-y" id="mainYScroller">
							<div class="inner topRight">
								<?php 									
									include "../estructura/titular_menu.php";
								?>
								<div class="separator"></div>
								<div class="heading-buttons">
									<h2 class="glyphicons home"><i></i>Inventario de Productos</h2>
									<div class="buttons pull-right">
										<a href="#" onclick="accionese(1,0)" class="btn btn-primary btn-icon glyphicons circle_plus"><i></i>Agregar Movimiento</a>
									</div>
								</div>
								<div class="separator"></div>
								<div class="row-fluid">
									<div class="span9">
										<div class="widget widget-2">
											<?php include "inventario_listar.php";?>	
										</div>
									</div>
									<?php include "inventario_filtro.php";?>
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
	<script src="../js/cerrarsesion.js"></script>	
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
		
		
function accionese(opcion,id){ // 1 agregar 2 modificar 3 eliminar
	
	$.post("opciones.php",{id:id,opcion:opcion},function(resultado){
		$(location).attr('href','inventario_add.php');

	}
	);


}


	</script>
	<!--tablas -->

	<script src="inventario_js.js" type="text/javascript"></script>
</body>
</html>