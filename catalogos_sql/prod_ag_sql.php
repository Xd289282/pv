<?php
session_start(); 
session_name("ssdpvccmm");
if (!isset($_SESSION["pvtacommand_ingsisv"])){echo"<SCRIPT>window.location='../index.php';</SCRIPT>";}	

include "../conexion/conexion.php";

$idunicoa=$_POST["idunicoa"];
$idunicop=$_POST["idunicop"];
$idunicoe=$_SESSION["pvtacommand_idunicoe"];// id unico de la empresa del usuario

$existe=0;
$consulta="select count(*) as existe from detprodagrup where idunicoe='$idunicoe' and idunicop='$idunicop' and idunicoa='$idunicoa'";
$recordset = mysqli_query($link,$consulta);
while($registro = mysqli_fetch_array($recordset)){			
	$existe=$registro["existe"];
}
if(!isset($existe)){$existe=0;}								

if($existe==0){
	$consulta="insert into detprodagrup (idunicoe,idunicop,idunicoa) values ('$idunicoe','$idunicop','$idunicoa')";
	mysqli_query($link,$consulta);
}else{
	$consulta="delete from  detprodagrup  where idunicoe='$idunicoe' and  idunicop='$idunicop' and idunicoa='$idunicoa'";
	mysqli_query($link,$consulta);
}

echo $consulta;

?>