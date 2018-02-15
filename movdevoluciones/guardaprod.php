<?php
if (!isset($_SESSION["pvtacommand_idunicoe"])){
	session_start(); 	
}
session_name("ssdpvccmm");
if (!isset($_SESSION["pvtacommand_ingsisv"])){echo"<SCRIPT>window.location='../index.php';</SCRIPT>";}	
include "../estructura/parametros.php";
include "../conexion/conexion.php";

$ticket=$_POST["ticket"];
if(!isset($_POST["idunicodetsal"])){$idunicodetsal=0;}else{$idunicodetsal=$_POST["idunicodetsal"];}


$idunicoe=$_SESSION["pvtacommand_idunicoe"];// id unico de la empresa del usuario
$idsesion=$_SESSION["pvtacommand_idsesion"];// id de la sesion del usuario
$idunicoe=$_SESSION["pvtacommand_idunicoe"];// id unico de la empresa
$idunicos=$_SESSION["pvtacommand_idunicos"];// id unico de la sucursal

$_SESSION["pvtacommand_meidunicoregi"]=$idunicodetsal;

if($idunicodetsal>0){
	echo "1";// existe articulo
}else{
	echo "0";// no existe
}


?>