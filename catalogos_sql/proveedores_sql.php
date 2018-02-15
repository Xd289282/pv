<?php
session_start(); 
session_name("ssdpvccmm");
$idregistro=$_SESSION["pvtacommand_idregistro"]; // id unico de registro
$idunicoe=$_SESSION["pvtacommand_idunicoe"]; // id unico de la empresa

if (!isset($_SESSION["pvtacommand_ingsisv"])){
	echo"<SCRIPT>window.location='../index.php';</SCRIPT>";   
}	

include "../conexion/conexion.php";
$nombre=utf8_decode($_POST["nombre"]);
$opcion=$_POST["opcion"];

$resultado=0; // 1  se agrego el registro 2 se modifico 3 se elimino 0 ocurrio un error
if($opcion==1){// agregar
	
	$idunicopr=1;
	try{
		$query="select max(idunicopr)+1 as maximo from proveedores";
		//$recordset = mysql_query($query) or die(mysql_error());
		$recordset = mysqli_query($link,$query);
		while($registro = mysqli_fetch_array($recordset)){
			$idunicopr=$registro["maximo"];
		}
		if ($idunicopr==0)
		{
			$idunicopr=1;
		}
	}catch (Exception $e){
		$idunicopr=1;
	}

	$consulta="insert into proveedores (idunicopr,nombre,idunicoe) values ('$idunicopr','$nombre','$idunicoe')";	
	mysqli_query($link,$consulta);
	
	//echo $consulta;
	$resultado=1;
}elseif($opcion==2){// modificar
	$idunicopr=$_SESSION["pvtacommand_id"];
	$consulta="update proveedores set nombre='$nombre' where idunicopr='$idunicopr'";
	mysqli_query($link,$consulta);
	$resultado=2;

}elseif($opcion==3){//eliminar
	$idunicopr=$_SESSION["pvtacommand_id"];
	$consulta="delete from proveedores where idunicopr='$idunicopr' and idunicoe='$idunicoe'";
	mysqli_query($link,$consulta);

	$resultado=3;
}

echo $resultado;

?>