<?php
session_start(); 
session_name("ssdpvccmm");
if (!isset($_SESSION["pvtacommand_ingsisv"])){echo"<SCRIPT>window.location='../index.php';</SCRIPT>";}	

include "../conexion/conexion.php";
$idunicoe=$_POST["empresa"];
$nombre=utf8_decode($_POST["nombre"]);
$calle=utf8_decode($_POST["calle"]);
$estado=utf8_decode($_POST["estado"]);
$telefono=$_POST["telefono"];
$rfc=$_POST["rfc"];
$colonia=utf8_decode($_POST["colonia"]);
$municipio=utf8_decode($_POST["municipio"]);
$opcion=$_POST["opcion"];
$fechaalta=date('Y-m-d');
//$idunicoe=$_SESSION["pvtacommand_idunicoe"];// id unico de la empresa del usuario


$resultado=0; // 1  se agrego el registro 2 se modifico 3 se elimino 0 ocurrio un error
if($opcion==1){// agregar
    $fppago = strtotime ( '+1 year' , strtotime ( $fechaalta ) ) ;
    $fppago = date ( 'Y-m-j' , $fppago );
	$consulta="insert into sucursal (idunicoe,nombre,rfc,calle,colonia,estado,municipio,telefono,status,fechaalta,tipopago,fppago) values ('$idunicoe','$nombre','$rfc','$calle','$colonia','$estado','$municipio','$telefono','0','$fechaalta','0','$fppago')";	
	mysqli_query($link,$consulta);
	$resultado=1;
}elseif($opcion==2){// modificar
	$idunicos=$_SESSION["pvtacommand_id"];
	$consulta="update sucursal set idunicoe='$idunicoe',nombre='$nombre',rfc='$rfc',calle='$calle',colonia='$colonia',estado='$estado',municipio='$municipio',telefono='$telefono' where idunicos='$idunicos'";
	mysqli_query($link,$consulta);

	$resultado=2;

}elseif($opcion==3){//eliminar
	$idunicos=$_SESSION["pvtacommand_id"];
	$consulta="delete from sucursal where idunicos='$idunicos'";
	mysqli_query($link,$consulta);
	$resultado=3;
}

echo $resultado;

?>