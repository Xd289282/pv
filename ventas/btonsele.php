<?php
if (!isset($_SESSION["pvtacommand_idunicoe"])){
	session_start(); 
	
}
session_name("ssdpvccmm");
if (!isset($_SESSION["pvtacommand_ingsisv"])){echo"<SCRIPT>window.location='../index.php';</SCRIPT>";}	

$boton=$_POST["boton"]; //  0 boton cantidad 1 boton codigo
if($boton==0){
	$_SESSION["pvtacommand_btnventa"]=0;//0 esta seleccionado boton cantidad 1 boton codigo
	echo "0";
}else{
	$_SESSION["pvtacommand_btnventa"]=1;
	echo "1";
}




?>