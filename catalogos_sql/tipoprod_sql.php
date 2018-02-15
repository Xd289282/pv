<?php
session_start(); 
session_name("ssdpvccmm");
$idregistro=$_SESSION["pvtacommand_idregistro"]; // id unico de registro
$idunicoe=$_SESSION["pvtacommand_idunicoe"]; // id unico de la empresa

if (!isset($_SESSION["pvtacommand_ingsisv"])){
	echo"<SCRIPT>window.location='../index.php';</SCRIPT>";   
}	

include "../conexion/conexion.php";
$cvetip=utf8_decode($_POST["cvetip"]);
$descripcion=utf8_decode($_POST["descripcion"]);
$opcion=$_POST["opcion"];

$resultado=0; // 1  se agrego el registro 2 se modifico 3 se elimino 0 ocurrio un error
if($opcion==1){// agregar

	$consulta="insert into tipoprod (cvetip,descripcion) values ('$cvetip','$descripcion')";	
	mysqli_query($link,$consulta);
	
	//echo $consulta;
	$resultado=1;
}elseif($opcion==2){// modificar
	$idunicopr=$_SESSION["pvtacommand_id"];
	$consulta="update tipoprod set descripcion='$descripcion' where cvetip='$cvetip'";
	mysqli_query($link,$consulta);
	$resultado=2;

}elseif($opcion==3){//eliminar
	$cvetip=$_SESSION["pvtacommand_id"];
	$consulta="delete from tipoprod where cvetip='$cvetip'";
	mysqli_query($link,$consulta);

	$resultado=3;
}

echo $resultado;

?>