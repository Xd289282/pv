<?php
session_start(); 
session_name("ssdpvccmm");
if (!isset($_SESSION["pvtacommand_ingsisv"])){echo"<SCRIPT>window.location='../index.php';</SCRIPT>";}	

include "../conexion/conexion.php";
$login=$_POST["login"];
$password=$_POST["password"];
$nombre=utf8_decode($_POST["nombre"]);
$tipo=$_POST["radio"];
$idunicos=$_POST["sucursal"];
$empresa=$_POST["empresa"];
$opcion=$_POST["opcion"];
$idunicoe=$_SESSION["pvtacommand_idunicoe"];// id unico de la empresa del usuario

$consulta="select idunicoe from sucursal where idunicos='$idunicos'; ";	
$recordset = mysqli_query($link,$consulta);
while($registro = mysqli_fetch_array($recordset)){
	$empresa=$registro["idunicoe"];
}

$resultado=0; // 1  se agrego el registro 2 se modifico 3 se elimino 0 ocurrio un error
if($opcion==1){// agregar
	$consulta="insert into catusuarios (idunicoe,login,password,nombre,tipo,idunicos) values ('$empresa','$login','$password','$nombre','$tipo','$idunicos')";	
	mysqli_query($link,$consulta);

	$resultado=1;
}elseif($opcion==2){// modificar
	$idunicou=$_SESSION["pvtacommand_id"];
	$consulta="update catusuarios set login='$login',password='$password',nombre='$nombre',tipo='$tipo',idunicos='$idunicos' where idunicou='$idunicou'";
	mysqli_query($link,$consulta);
	$resultado=2;

}elseif($opcion==3){//eliminar
	$idunicou=$_SESSION["pvtacommand_id"];
	$consulta="delete from catusuarios where idunicou='$idunicou'";
	mysqli_query($link,$consulta);
	$resultado=3;
}

echo $resultado;

?>