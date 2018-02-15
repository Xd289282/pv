<?php
if (!isset($_SESSION["pvtacommand_idunicoe"])){
	session_start(); 
	
}
session_name("ssdpvccmm");
if (!isset($_SESSION["pvtacommand_ingsisv"])){echo"<SCRIPT>window.location='../index.php';</SCRIPT>";}	

	
include "../estructura/parametros.php";
include "../conexion/conexion.php";

	$idunicoe=$_SESSION["pvtacommand_idunicoe"];// id unico de la empresa del usuario
	$idunicos=$_SESSION["pvtacommand_idunicos"];// id unico de la sucursal
	$idsesion=$_SESSION["pvtacommand_idsesion"];// id de la sesion del usuario


$idsesion=$_POST["idsesion"];
$idunicoregi=$_POST["idunicoregi"];
$idunicop=$_POST["idunicop"];


$pmostrador=0;
$consulta="select pmostrador from productos where idunicop='$idunicop' and idunicoe='$idunicoe'";
$recordset = mysqli_query($link,$consulta);
while($registro = mysqli_fetch_array($recordset)){				
	$pmostrador=$registro["pmostrador"]-10;
}


$consulta="update tmpventas set precio='$pmostrador' where idsesion='$idsesion' and idunicoregi='$idunicoregi'";
mysqli_query($link,$consulta);


?>