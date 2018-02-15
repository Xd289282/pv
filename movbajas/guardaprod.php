<?php
if (!isset($_SESSION["pvtacommand_idunicoe"])){
	session_start(); 	
}
session_name("ssdpvccmm");
if (!isset($_SESSION["pvtacommand_ingsisv"])){echo"<SCRIPT>window.location='../index.php';</SCRIPT>";}	

	
include "../estructura/parametros.php";
include "../conexion/conexion.php";
$idunicoe=$_SESSION["pvtacommand_idunicoe"];// id unico de la empresa del usuario
$idsesion=$_SESSION["pvtacommand_idsesion"];// id de la sesion del usuario
$idunicoe=$_SESSION["pvtacommand_idunicoe"];// id unico de la empresa
$idunicos=$_SESSION["pvtacommand_idunicos"];// id unico de la sucursal

$_SESSION["pvtacommand_meidunicoregi"]=$idunicoregi;
$idunicoregi=$_POST["idunicoregi"];
$idunicop=$_POST["idunicop"];
$cantidad=$_POST["cantidad"]; // cantidad

	

$existe=0;
$consulta="select count(*) as no from tmpbajas where idsesion='$idsesion' and idunicoe='$idunicoe' and idunicop='$idunicop' and idunicoregi='$idunicoregi'";
$recordset = mysqli_query($link,$consulta);
while($registro = mysqli_fetch_array($recordset)){
	$existe=$registro["no"];
}
if(!isset($existe)){$existe=0;}
if($existe==0){
	$consulta="insert into tmpbajas (idsesion,idunicoe,idunicos,idunicop,cantidad,idunicoregi) values ('$idsesion','$idunicoe','$idunicos','$idunicop','$cantidad','$idunicoregi')";
	mysqli_query($link,$consulta);
}else{
	$consulta="update tmpbajas set cantidad=cantidad+'$cantidad' where idsesion='$idsesion' and idunicoe='$idunicoe' and idunicop='$idunicop' and idunicoregi='$idunicoregi'";
	mysqli_query($link,$consulta);
}
?>