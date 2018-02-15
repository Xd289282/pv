<?php
session_start(); 
session_name("ssdpvccmm");
if (!isset($_SESSION["pvtacommand_ingsisv"])){echo"<SCRIPT>window.location='../index.php';</SCRIPT>";}	
include "../conexion/conexion.php";
$idunicoe=$_SESSION["pvtacommand_idunicoe"];
$idunicos=$_SESSION["pvtacommand_idunicos"];
$idunicou=$_SESSION["pvtacommand_idunicou"];
$idunicodetsal=$_SESSION["pvtacommand_meidunicoregi"];
$fechae=date("d/m/Y");
$fechahora=date("Y-m-d H:i:s");
$fechaef=substr($fechae,6,4).'-'.substr($fechae,3,2).'-'.substr($fechae,0,2)." 00:00:00";

	$consulta="select a.idunicoe,a.idunicos,b.idunicop,b.pmostrador,b.cantidad,b.descuento,b.iva,b.pfinal,b.modelo,b.talla,b.lote,b.fcaducidad from mtosalidas as a left join detsalidas as b on a.idunicosal=b.idunicosal where b.idunicodetsal='$idunicodetsal'" ;//obtiene los datos de la salida a devolver
	$recordset = mysqli_query($link,$consulta);
	while($registro = mysqli_fetch_array($recordset)){
		$idunicoe=$registro["idunicoe"];
		$idunicos=$registro["idunicos"];
		$idunicop=$registro["idunicop"];
		$pmostrador=$registro["pmostrador"];
		$cantidad=$registro["cantidad"];
		$descuento=$registro["descuento"];
		$iva=$registro["iva"];
		$pfinal=$registro["pfinal"];
		$modelo=$registro["modelo"];
		$talla=$registro["talla"];
		$lote=$registro["lote"];
		$fcaducidad=$registro["fcaducidad"];

	}
	$consulta="select idunicoregi,cantidad from inventario where idunicoe='$idunicoe' and idunicos='$idunicos' and idunicop='$idunicop' and modelo='$modelo' and talla='$talla' and lote='$lote' and fcaducidad='$fcaducidad'"; //obtiene el id del inventario asociado a la venta
	$recordset = mysqli_query($link,$consulta);
	while($registro = mysqli_fetch_array($recordset)){
		$cantidadi=$registro["cantidad"];
		$idunicoregi=$registro["idunicoregi"];
	}
    $cantidadf=$cantidadi+$cantidad;
	$consulta="update inventario set cantidad='$cantidadf' where idunicoregi='$idunicoregi'";
	mysqli_query($link,$consulta);
//   inserta en la tabla de entradas
	$folio="DEV";
	$consulta="insert into entradas (idunicoe,idunicos,idunicop,fechae,cantidad,pcompra,idunicou,folio,pmostrador,idunicoregi,tipoent) values ('$idunicoe','$idunicos','$idunicop','$fechaef','$cantidad','$pcompra','$idunicou','$folio','$pmostrador','$idunicoregi','2')";	
	mysqli_query($link,$consulta);	
 		 // afecta bitacora
	$consulta="insert into bitacora (idunicoe,idunicos,idunicop,tipo,cantidad,pmostrador,idunicou,fechahora) values ('$idunicoe','$idunicos','$idunicop','7','$cantidad','0','$idunicou','$fechahora')";	
	mysqli_query($link,$consulta);   
	 // afecta devoluciones
	$idunicod=1;
    $consulta="select max(idunicod) as ultimo from devoluciones"; //obtiene el ultimo id de devoluciones
	$recordset = mysqli_query($link,$consulta);
	while($registro = mysqli_fetch_array($recordset)){
		$idunicod=$registro["ultimo"]+1;
	}

	$consulta="insert into devoluciones (idunicod,idunicoe,idunicos,idunicosal,idunicop,pmostrador,cantidad,descuento,iva,pfinal,tipodev,fecha,cliente,idunicoent,idunicopsalc) values ('$idunicod','$idunicoe','$idunicos','$idunicosal','$idunicop','$pmostrador','$cantidad','$descuento','$iva','$pfinal','$tipodev','$fechaef','$cliente','$idunicoent','$idunicopsalc')";	
	mysqli_query($link,$consulta);   


$resultado=1;

echo $resultado;

?>