<?php
session_start(); 
session_name("ssdpvccmm");
$idregistro=$_SESSION["pvtacommand_idregistro"]; // id unico de registro

if (!isset($_SESSION["pvtacommand_ingsisv"])){
	echo"<SCRIPT>window.location='../index.php';</SCRIPT>";   
}	

include "../conexion/conexion.php";
$nombre=utf8_decode($_POST["nombre"]);
$calle=utf8_decode($_POST["calle"]);
$estado=utf8_decode($_POST["estado"]);
$telefono=$_POST["telefono"];
$rfc=$_POST["rfc"];
$colonia=utf8_decode($_POST["colonia"]);
$municipio=utf8_decode($_POST["municipio"]);
$opcion=$_POST["opcion"];
$fechaalta=date('Y-m-d');

$serie=$_POST["serie"];
$marca=$_POST["marca"];
$modelo=$_POST["modelo"];
$talla=$_POST["talla"];
$lote=$_POST["lote"];
$fcaducidad=$_POST["fcaducidad"];

$resultado=0; // 1  se agrego el registro 2 se modifico 3 se elimino 0 ocurrio un error
if($opcion==1){// agregar
	
	$idunicoe=1;
	try{
		$query="select max(idunicoe)+1 as maximo from empresa";
		//$recordset = mysql_query($query) or die(mysql_error());
		$recordset = mysqli_query($link,$query);
		while($registro = mysqli_fetch_array($recordset)){
			$idunicoe=$registro["maximo"];
		}
		if ($idunicoe==0)
		{
			$idunicoe=1;
		}
	}catch (Exception $e){
		$idunicoe=1;
	}

    $fppago = strtotime ( '+1 year' , strtotime ( $fechaalta ) ) ;
    $fppago = date ( 'Y-m-j' , $fppago );
	$consulta="insert into empresa (idunicoe,nombre,rfc,calle,colonia,estado,municipio,telefono,status,fechaalta,idregistro,fppago,rutalogo,piedepagina,leyendaticket) values ('$idunicoe','$nombre','$rfc','$calle','$colonia','$estado','$municipio','$telefono','0','$fechaalta','$idregistro','$fppago','logopventa.jpg','piedepagina2.png','Nuestra Satisfacción Servirle.......')";	
	mysqli_query($link,$consulta);
	
	$consulta="insert into configuraciones (idunicoe,serie,marca,modelo,talla,lote,fcaducidad) values ('$idunicoe','$serie','$marca','$modelo','$talla','$lote','$fcaducidad')";
	mysqli_query($link,$consulta);	
	//echo $consulta;
	$resultado=1;
}elseif($opcion==2){// modificar
	$idunicoe=$_SESSION["pvtacommand_id"];
	$consulta="update empresa set nombre='$nombre',rfc='$rfc',calle='$calle',colonia='$colonia',estado='$estado',municipio='$municipio',telefono='$telefono' where idunicoe='$idunicoe'";
	mysqli_query($link,$consulta);
	$resultado=2;

}elseif($opcion==3){//eliminar
	$idunicoe=$_SESSION["pvtacommand_id"];
	$consulta="delete from empresa where idunicoe='$idunicoe'";
	mysqli_query($link,$consulta);
	$consulta="delete from configuraciones where idunicoe='$idunicoe'";
	mysqli_query($link,$consulta);

	$resultado=3;
}

echo $resultado;

?>