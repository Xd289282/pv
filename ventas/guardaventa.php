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
$idunicou=$_SESSION["pvtacommand_idunicou"];// id unico del usuario
$fechahora=date("Y-m-d H:i:s");

$importet=0;$descuento=0;$total=0;
$consulta="select a.cantidad,a.precio,b.iva,b.descuento from tmpventas as a left join productos as b on a.idunicoe=b.idunicoe and a.idunicop=b.idunicop where a.idsesion='$idsesion' and a.idunicoe='$idunicoe'";
$recordset = mysqli_query($link,$consulta);
while($registro = mysqli_fetch_array($recordset)){
	$cantidad=$registro["cantidad"];
	$pmostrador=$registro["precio"];
	$iva=$registro["iva"];
	$descuento=$descuento+$registro["descuento"];
	if($iva>0){
		$iva=$iva/100;
		$iva=round($iva,2);		
	}	
	$pmostrador=($cantidad*$pmostrador)*(1+$iva);
	$importet=$importet+$pmostrador;		
}
//$total=$importet-$descuento;
//$total=$importet-($cantidad*10);
$total=$importet;
$pago=$_POST["pago"];
$cambio=($total+$descuento)-$pago;	




$fecha=date("Y-m-d H:i:s");
$idunicotras=0;//idunico del traspaso consecutivo de traspasos por empresa/sucursal
$idunicosr=0;//id unico de la sucursal que recibe el traspaso
$baja=0;//id unico de la baja consecutivo por empresa/sucursal
/*insertar maestro de salidas*/
// idunicoe,idunicos,tiposal,idunicou,fecha,idunicotras,idunicosr,baja,total // parametros
$tiposal=0;//tipo de salida 0=venta 1=traspaso 2=baja
$consulta="select inserta('$idunicoe','$idunicos','$tiposal','$idunicou','$fecha','$idunicotras','$idunicosr','$baja','$total','$pago','$cambio') as ticket";
$recordset = mysqli_query($link,$consulta);
while($registro = mysqli_fetch_array($recordset)){$ticket=$registro["ticket"];}
if(!isset($ticket)){$ticket=1;}
$idunicosal=0;
$consulta="select idunicosal from mtosalidas where idunicoe='$idunicoe' and idunicos='$idunicos' and ticket='$ticket'";
$recordset = mysqli_query($link,$consulta);
while($registro = mysqli_fetch_array($recordset)){$idunicosal=$registro["idunicosal"];}

$_SESSION["pvtacommand_idunicosal"]=$idunicosal;

if($idunicosal>0){

	$consulta="select * from tmpventas where idsesion='$idsesion' and idunicoe='$idunicoe' and idunicos='$idunicos'";
	$recordset = mysqli_query($link,$consulta);
	while($registro = mysqli_fetch_array($recordset)){
		$idunicop=$registro["idunicop"];
		$cantidad=$registro["cantidad"];
		$idunicoregi=$registro["idunicoregi"];
		$tipo=0;
		$modelo="";
		$talla="";
		$lote="";
		$fcaducidad='0000-00-00';


		$consulta="select tipo,modelo,talla,lote,fcaducidad from inventario where idunicoregi='$idunicoregi' and idunicoe='$idunicoe'";
		$recordset2 = mysqli_query($link,$consulta);
		while($registro2 = mysqli_fetch_array($recordset2)){
		     $tipo=$registro2["tipo"];
		     $modelo=$registro2["modelo"];
		     $talla=$registro2["talla"];
		     $lote=$registro2["lote"];
		     $fcaducidad=$registro2["fcaducidad"];
		}//0 producto 1 servicio


		$iva=0;
		$pfinal=0;
		$consulta="select pmostrador,descuento,iva from productos where idunicop='$idunicop' and idunicoe='$idunicoe'";
		$recordset2 = mysqli_query($link,$consulta);
		while($registro2 = mysqli_fetch_array($recordset2)){
			//$pmostrador=$registro2["pmostrador"];
			$iva=$registro2["iva"];
		}
		$consulta="select precio from tmpventas where idunicop='$idunicop' and idunicoe='$idunicoe' and idunicop='$idunicop'";
		$recordset2 = mysqli_query($link,$consulta);
		while($registro2 = mysqli_fetch_array($recordset2)){
			$pmostrador=$registro2["precio"];			
		}

		if($iva>0){
			$iva=(($cantidad*$pmostrador)-($cantidad*10))*($iva/100);
			$iva=round($iva,2);
		}
		//$pfinal=(($cantidad*$pmostrador)-($cantidad*10))+$iva;
		$pfinal=(($cantidad*$pmostrador))+$iva;
		//$descuento=$cantidad*10;   se quito por desuento de diez pesos abril 2017
		

		$consulta="insert into detsalidas (idunicosal,idunicop,pmostrador,cantidad,descuento,iva,pfinal,modelo,talla,lote,fcaducidad) values ('$idunicosal','$idunicop','$pmostrador','$cantidad','$descuento','$iva','$pfinal','$modelo','$talla','$lote','$fcaducidad')";
		mysqli_query($link,$consulta);
		//actualizar el inventario
		if($tipo==0){//producto
			$consulta="update inventario set cantidad=cantidad-'$cantidad' where idunicoregi='$idunicoregi' and idunicoe='$idunicoe'";
			mysqli_query($link,$consulta);
		}

		$consulta="insert into bitacora (idunicoe,idunicos,idunicop,tipo,cantidad,pmostrador,idunicou,fechahora) values ('$idunicoe','$idunicos','$idunicop','3','$cantidad','$pmostrador','$idunicou','$fechahora')";	
		mysqli_query($link,$consulta); 
	}

	$consulta="delete from tmpventas where idsesion='$idsesion' and idunicoe='$idunicoe' and idunicos='$idunicos'";
	mysqli_query($link,$consulta);

	echo "0";
}else{
	echo "1";
}
//echo $cambio;
?>