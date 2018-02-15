<?php
if (!isset($_SESSION["pvtacommand_idunicoe"])){
	session_start(); 	
}
session_name("ssdpvccmm");
if (!isset($_SESSION["pvtacommand_ingsisv"])){echo"<SCRIPT>window.location='../index.php';</SCRIPT>";}	
	
include "../estructura/parametros.php";
include "../conexion/conexion.php";



$idsesion=$_POST["idsesion"];
$idunicoregi=$_POST["idunicoregi"];

$consulta="delete from tmpbajas where  idsesion='$idsesion' and idunicoregi='$idunicoregi'";
mysqli_query($link,$consulta);



?>