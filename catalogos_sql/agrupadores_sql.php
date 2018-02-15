<?php
session_start(); 
session_name("ssdpvccmm");

if (!isset($_SESSION["pvtacommand_ingsisv"])){
  echo"<SCRIPT>window.location='../index.php';</SCRIPT>";   
}	


include "../conexion/conexion.php";
$idunicoe=$_POST["empresa"];
$agrupador=utf8_decode($_POST["agrupador"]);
$opcion=$_POST["opcion"];
//$idunicoe=$_SESSION["pvtacommand_idunicoe"];// id unico de la empresa del usuario


$resultado=0; // 1  se agrego el registro 2 se modifico 3 se elimino 0 ocurrio un error
if($opcion==1){// agregar
	$consulta="insert into catagrupadores (idunicoe,agrupador) values ('$idunicoe','$agrupador')";	
	mysqli_query($link,$consulta);
	$resultado=1;
}elseif($opcion==2){// modificar
	$idunicoa=$_SESSION["pvtacommand_id"];
	$consulta="update catagrupadores set agrupador='$agrupador' where idunicoa='$idunicoa'";	
	mysqli_query($link,$consulta);
	$resultado=2;

}elseif($opcion==3){//eliminar
	$idunicoa=$_SESSION["pvtacommand_id"];
	$consulta="delete from catagrupadores where idunicoa='$idunicoa'";
	mysqli_query($link,$consulta);
	$resultado=3;
}

echo $resultado;

?>