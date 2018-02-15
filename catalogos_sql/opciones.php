<?php
session_start();
session_name("ssdpvccmm");
if (!isset($_SESSION["pvtacommand_ingsisv"])){
	echo"<SCRIPT>window.location='../index.php';</SCRIPT>";   
}	


//opciones  1 agregar 2 editar 3 eliminar
$_SESSION["pvtacommand_id"]=$_POST["id"];
$_SESSION["pvtacommand_axx"]=$_POST["opcion"];
?>