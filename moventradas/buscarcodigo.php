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
$codigo=$_POST["codigo"];

$consulta="select idunicop,nombrep from productos where idunicoe='$idunicoe' and codigo='$codigo' and tipo='0'";
//echo $consulta;
$recordset = mysqli_query($link,$consulta);
while($registro = mysqli_fetch_array($recordset)){$idunicop=$registro["idunicop"];$nombrep=$registro["nombrep"];}
if(!isset($idunicop)){$idunicop=0;}
if($idunicop>0){
	$_SESSION["pvtacommand_meidunicop"]=$idunicop;
	$_SESSION["pvtacommand_mecodigo"]=$codigo;
	$_SESSION["pvtacommand_menombrep"]=$nombrep;
	echo "1";// existe articulo
}else{
	echo "0";// no existe
}

?>