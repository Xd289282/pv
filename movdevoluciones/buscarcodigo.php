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
$noticket=$_POST["noticket"];

$_SESSION["pvtacommand_noticket"]=0;
$consulta="select a.ticket,a.fecha,c.nombrep,b.cantidad,b.pfinal,b.idunicop from mtosalidas as a left join detsalidas as b on a.idunicosal=b.idunicosal left join productos as c on c.idunicop=b.idunicop where a.ticket='$noticket' and a.idunicoe='$idunicoe' and a.idunicos='$idunicos'"
$recordset = mysqli_query($link,$consulta);
while($registro = mysqli_fetch_array($recordset)){$idunicodetsal=$registro["idunicodetsal"];$idunicop=$registro["idunicop"];$nombrep=$registro["nombrep"];}
if(!isset($idunicop)){$idunicop=0;}
if($idunicop>0){
	$_SESSION["pvtacommand_meidunicop"]=$idunicop;
	$_SESSION["pvtacommand_mecodigo"]=$codigo;
	$_SESSION["pvtacommand_menombrep"]=$nombrep;
	$_SESSION["pvtacommand_meidunicodetsal"]=$idunicodetsal;

	echo "1";// existe articulo
}else{
	echo "0";// no existe
}

?>