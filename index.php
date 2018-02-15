<?php	
	session_start(); 
	session_name("ssdpvccmm");
	include "./estructura/parametros.php";
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
			<div class="innerpx">
				<button type="button" class="btn btn-navbar hidden-desktop hidden-tablet">
					<span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
				</button>
				<div class="positionWrapper">
					<span class="line"></span>
					<div class="profile heading">
						<h1><?php echo $sys_nombre; ?></h1>
						<em>La manera mas fácil de Vender</em>
					</div>
				</div>
			</div>
		</div>
	
		<div class="row-fluid rrow main">
			<div class="span12 main col" role="main">
				<div class="row-fluid rrow">
					<div class="span2 col main-left hide login menu-large">
						<div class="rrow scroll-y-left">
							<div class="iScrollWrapper">
								
							</div>
							<span class="navarrow hide">
								<span class="glyphicons circle_arrow_down"><i></i></span>
							</span>
						</div>
					</div>
					<div class="span10 col main-right login">
						<div class="rrow scroll-y" id="mainYScroller">
							<div class="inner topRight"><div class="positionWrapper loginWrapper hide">
								<span class="line"></span>
								<div class="box-1 loginbox">
									<div class="inner">
										<form  action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"  />
											<fieldset>
												<legend>Ingresar</legend>
												<hr class="separator bottom" style="margin-bottom: 10px;" />
												<div class="input-prepend input-full">
													<span class="add-on glyphicons user"><i></i></span>
													<input type="text" name="login" id="login" class="" placeholder="Usuario" />
												</div>
												<div class="input-prepend input-full">
													<span class="add-on glyphicons lock"><i></i></span>
													<input type="password" name="password" id="password" class="" placeholder="Contraseña" />
												</div>
												
												<hr class="separator bottom" style="margin-bottom: 10px;" />
												<button type="submit"  id="ingresar" name="ingresar" class="btn btn-icon btn-block glyphicons right flash btn-primary">Ingresar<i></i></button>
											</fieldset>
										</form>
									</div>
								</div>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Content -->
	</div>		
</div>

	<script src="theme/scripts/cubiq-iscroll/src/iscroll.js"></script>	
	<script type="text/javascript">
	var scrollers = [];
	var mainYScroller;	
	$(function()
	{
		//document.addEventListener('touchmove', function(e){ e.preventDefault(); });
		var xScrollers = $(".scroll-x");
	    for (var i = 0; i < xScrollers.length; i++)
			scrollers.push(new iScroll(xScrollers[i], { 
				vScroll: false, 
				hideScrollbar: true,
				useTransform: $('html').is('.lt-ie9') ? false : true,
				onBeforeScrollStart: function (e) 
				{
					var target;
					if (!e) var e = window.event;
					if (e.target) target = e.target;
					else if (e.srcElement) target = e.srcElement;
					if (target.nodeType == 3) target = target.parentNode;

					if (target.tagName != 'SELECT' && target.tagName != 'INPUT' && target.tagName != 'TEXTAREA')
					{
						if (e.preventDefault) e.preventDefault();
						else e.returnValue = false;
					}
				} 
			}));

		var yScrollers = $('.scroll-y').not('#mainYScroller');
	    $.each(yScrollers, function(i,v)
		{
	    	var scroller = new iScroll($(v).attr('id'),
	    	{
		    	hScroll: false, 
		    	hideScrollbar: true,
		    	useTransform: $('html').is('.lt-ie9') ? false : true,
		    	onBeforeScrollStart: function (e) 
		    	{
		    		var target;
					if (!e) var e = window.event;
					if (e.target) target = e.target;
					else if (e.srcElement) target = e.srcElement;
					if (target.nodeType == 3) target = target.parentNode;
					
					if (target.tagName != 'SELECT' && 
						target.tagName != 'INPUT' && 
						target.tagName != 'TEXTAREA' &&
						$(target).parents('table-responsive').size() == 0)
					{
						if (e.preventDefault) e.preventDefault();
						else e.returnValue = false;
					}
				}
		    });
	    	scrollers.push(scroller);
		});

	    mainYScroller = new iScroll('mainYScroller',
    	{
	    	zoom: true,
	    	hScroll: false, 
	    	hideScrollbar: true,
	    	useTransform: $('html').is('.lt-ie9') ? false : true,
	    	onBeforeScrollStart: function (e) 
	    	{
	    		var target;
				if (!e) var e = window.event;
				if (e.target) target = e.target;
				else if (e.srcElement) target = e.srcElement;
				if (target.nodeType == 3) target = target.parentNode;

				if ($('input:focus, textarea:focus').length) $('input:focus, textarea:focus').blur();

				if ($(target).parents('.table-responsive').size() > 0 ||
					$(target).parents('.google-visualization-table-table').size() > 0 ||
					$(target).parents('#calendar').size() > 0 ||
					$(target).is('.btn'))
					{
						return true;
					}
					
				if (target.tagName != 'SELECT' && 
					target.tagName != 'INPUT' && 
					target.tagName != 'TEXTAREA')
				{
					if (e.preventDefault) e.preventDefault();
					else e.returnValue = false;
				}
			},
			onScrollEnd: function()
			{
				//if (mainYScroller.enabled == false) mainYScroller.enable();
			}
	    });
	    scrollers['mainYScroller'] = mainYScroller;
	});
	</script>	
	<script src="theme/scripts/jquery-ui-1.9.2.custom/js/jquery-ui-1.9.2.custom.min.js"></script>
	<script src="theme/scripts/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
	<script src="theme/scripts/jquery-miniColors/jquery.miniColors.js"></script>
	<script src="js/colores.js"></script>
	<script src="theme/scripts/jquery.cookie.js"></script>
	<script src="theme/scripts/themer.js"></script>	
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
	<link href="http://localhost/jalert/sample_jalerts/jquery.alerts.css" rel="StyleSheet" type="text/css" />	
	<script src="http://localhost/jalert/sample_jalerts/jquery.ui.draggable.js" type="text/javascript"></script>
	<script src="http://localhost/jalert/sample_jalerts/jquery.alerts.mod.js" type="text/javascript"></script>
</body>
</html>

<?php
if(isset($_POST["ingresar"])){		
	$login=$_POST["login"];
	$password=$_POST["password"];
	$tipouser=0;// 1 es un usuario admin de registro esta en la tabla registro 2 es un usuario normal esta en la tabla catusuarios
	$idunicos=3; //  id de la sucursal del usuario
	$password2="";$encontrado=0;$cveusuario=0;$existeregistro=0;$idregistro=0;$idunicou=0;$idunicoe=0;
	$nombreusuario="";
	if(strlen($login)>0 && strlen($password)>0){					
		include "./conexion/conexion.php";
		include "./conexion/sesiones.php";		
		//verificar si se encuentra en la tabla de registros		
		$consulta="select count(*) as no from registro where login='$login'";
		$recordset = mysqli_query($link,$consulta);		
		while($registro = mysqli_fetch_array($recordset)){$existeregistro=$registro["no"];}
		if(!isset($existeregistro)){$existeregistro=0;}
		if($existeregistro>0){
			$consulta="select idregistro,password,nombre,appaterno from registro where login='$login'";
			$recordset = mysqli_query($link,$consulta);
			while($registro = mysqli_fetch_array($recordset)){		
				$encontrado=1;
				$idregistro=$registro["idregistro"];
				$password2=$registro["password"];	
				$nombreusuario=$registro["nombre"]." ".$registro["appaterno"];
				$tipouser=3; // usuario administrador

				$idunicou=0;
				$idunicoe=0;// id unico de la empresa
				$idunicos=0;// id unico de la sucursal
			}
			$consulta="select idunicoe from empresa where idregistro='$idregistro'";
			$recordset = mysqli_query($link,$consulta);
			while($registro = mysqli_fetch_array($recordset)){$idunicoe=$registro["idunicoe"];}
		}

		if($encontrado==0){ // buscar en el catalogo de usuarios
			$consulta="select idunicou,password,idunicoe,idunicos,tipo,nombre from catusuarios where login='$login'";
			$recordset = mysqli_query($link,$consulta);
			while($registro = mysqli_fetch_array($recordset)){		
				$encontrado=2;
				$idunicou=$registro["idunicou"];
				$password2=$registro["password"];
				$idunicoe=$registro["idunicoe"];// id unico de la empresa
				$idunicos=$registro["idunicos"];// id unico de la sucursal
				$tipouser=$registro["tipo"];//0 vendedor 1 supervisor 2 administrador	
				$nombreusuario=$registro["nombre"];
				$_SESSION["pvtacommand_meidunicoregi"]=0; // id unico de registro
			}	

		}
		
			
		if($encontrado==1 || $encontrado==2){				
			
			if ($password==$password2){		
				session_name("ssdpvccmm");
				$idsesion=verifica_sesion(1,$idunicou,$idregistro,$login);	
				$_SESSION["pvtacommand_ingsisv"]=1; // indicador de que se ha iniciado sesion en el sistema					
				$_SESSION["pvtacommand_idunicou"]=$idunicou; // id unico del usuario
				$_SESSION["pvtacommand_idunicoe"]=$idunicoe; // id unico de la empresa
				$_SESSION["pvtacommand_idregistro"]=$idregistro; // id unico de registro
				$_SESSION["pvtacommand_meidunicoregi"]=$idregistro; // id unico de registro
				$_SESSION["pvtacommand_idsesion"]=$idsesion;
				$_SESSION["pvtacommand_nivelm_sub"]=0;// id del menu activo
				$_SESSION["pvtacommand_btnventa"]=1; //0 esta seleccionado boton cantidad 1 boton codigo
				$_SESSION["pvtacommand_idunicop_inv"]=0;// el producto actual solo tiene un registro en inventario
				$_SESSION["pvtacommand_idunicos"]=$idunicos;//id unico de la sucursal
				$_SESSION["pvtacommand_tipouser"]=$tipouser;//0 vendedor 1 supervisor 2 administrador 3 creador de empresa
				$_SESSION["pvtacommand_nombreuser"]=$nombreusuario; // nombre del usuario
				
				//echo"<SCRIPT>alert(".$idsesion.");</SCRIPT>";
				//echo "id unicoe ".$idunicoe;
				
				echo"<SCRIPT>window.location='principal.php';</SCRIPT>";

			}else{
				$_SESSION["pvtacommand_idunicou"]="";
				echo"<SCRIPT>jAlert('Usuario y/o Contraseña Invalidos1');</SCRIPT>";				
			}
		}else{			
			$_SESSION["pvtacommand_idunicou"]="";
			echo"<SCRIPT>jAlert('Usuario No Existe');</SCRIPT>";	
		}

	}else{
		$_SESSION["pvtacommand_idunicou"]="";
		echo"<SCRIPT>jAlert('Usuario y/o Contraseña Invalidos2');</SCRIPT>";			
	}	
	
}
?>