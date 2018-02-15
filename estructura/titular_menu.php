<?php
if (!isset($_SESSION["pvtacommand_ingsisv"])){echo"<SCRIPT>window.location='../index.php';</SCRIPT>";}	
$menuactivo=$_SESSION["pvtacommand_nivelm_sub"];
$submenu="";
$categoria="";
switch ($menuactivo) {
	case 1:$submenu="Inicio";break;
	case 18:$categoria="Catálogos";	$submenu="Usuarios";break;
	case 3 :$categoria="Catálogos";	$submenu="Productos";break;
	
	case 4:$categoria="Ventas";$submenu="Ventas";break;
	
	case 5:$categoria="Movimientos";$submenu="Entradas";break;
	case 6:$categoria="Movimientos";$submenu="Traspasos";break;
	case 7:$categoria="Movimientos";$submenu="Bajas";break;
	case 8:$categoria="Movimientos";$submenu="Inventarios";break;
	
	case 9:$categoria="Reportes";$submenu="Entradas";break;
	case 10:$categoria="Reportes";$submenu="Ventas";break;
	case 11:$categoria="Reportes";$submenu="Traspasos";break;
	case 12:$categoria="Reportes";$submenu="Bajas";break;
	case 13:$categoria="Reportes";$submenu="Inventarios";break;
	case 14:$categoria="Reportes";$submenu="Productos";break;

	case 15 :$categoria="Catálogos";	$submenu="Empresa";break;
	case 16 :$categoria="Catálogos";	$submenu="Sucursales";break;
	case 17 :$categoria="Catálogos";	$submenu="Agrupadores";break;
	case 18 :$categoria="Catálogos";	$submenu="Usuarios";break;
	case 19 :$categoria="Movimientos";	$submenu="Devoluciones";break;
	case 20 :$categoria="Configuración";	$submenu="Utilidad";break;


	default:
		
		break;
}
					/*
					1 empresa
					2 sucursales
					3 agrupadores
					4 Devoluciones
					*/

?>

<ul class="breadcrumb">
	<li><a href="index.html" class="glyphicons home"><i></i><?php echo $sys_nombre; ?></a></li>
	<li class="divider"></li>
	<li><?php echo $categoria; ?></li>
	<li class="divider"></li>
	<li><?php echo $submenu; ?></li>
</ul>