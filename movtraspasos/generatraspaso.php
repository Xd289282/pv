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
$idunicos=$_SESSION["pvtacommand_idunicos"];// id unico de la sucursal
$idunicou=$_SESSION["pvtacommand_idunicou"];// id unico del usuario

$sucursal_a=$_POST["sucursal"];//sucursal a la que se va a traspasar 
$idunicosr=$sucursal_a; // sucrusal que recibe el traspaso
$baja=0;//id unico de la baja consecutivo por empresa/sucursal
$fechahora=date("Y-m-d H:i:s");

$existenreg=0;
$consulta="select count(*) as no from tmptraspaso where idsesion='$idsesion' and idunicoe='$idunicoe' and idunicos='$idunicos'";
$recordset = mysqli_query($link,$consulta);
while($registro = mysqli_fetch_array($recordset)){$existenreg=$registro["no"];}
if(!isset($existenreg)){$existenreg=1;}

if($existenreg>0){

	/*insertar maestro de salidas*/
	$fecha=date("Y-m-d H:i:s");
	$idunicotras=0;//idunico del traspaso consecutivo de traspasos por empresa/sucursal
	$consulta="select max(idunicotras)+1 as idunicotras from mtosalidas where idunicoe='$idunicoe' and idunicos='$idunicos'";
	$recordset = mysqli_query($link,$consulta);
	while($registro = mysqli_fetch_array($recordset)){$idunicotras=$registro["idunicotras"];}
	if(!isset($idunicotras)){$idunicotras=1;}
	$total=0;
	// idunicoe,idunicos,tiposal,idunicou,fecha,idunicotras,idunicosr,baja,total // parametros
	$tiposal=1;//tipo de salida 0=venta 1=traspaso 2=baja
	$idunicosal=1;
	$consulta="select inserta_tras_baj('$idunicoe','$idunicos','$tiposal','$idunicou','$fecha','$idunicotras','$idunicosr','$baja','$total') as idunicosal";
	$recordset = mysqli_query($link,$consulta);
	while($registro = mysqli_fetch_array($recordset)){$idunicosal=$registro["idunicosal"];}
	if(!isset($idunicosal)){$idunicosal=1;}



	$consulta="select * from tmptraspaso where idsesion='$idsesion' and idunicoe='$idunicoe' and idunicos='$idunicos'";
	$recordset = mysqli_query($link,$consulta);
	while($registro = mysqli_fetch_array($recordset)){
		$idunicoregi=$registro["idunicoregi"];	
		$idunicop=$registro["idunicop"];
		$cantidad=$registro["cantidad"];
		$cantidadmov=$registro["cantidad"];// cantidad original del movimiento

		$modelo="";$talla="";$lote="";$fcaducidad="";
		$consulta="select modelo,talla,lote,fcaducidad from inventario where idunicoe='$idunicoe' and idunicoregi='$idunicoregi'";
		$recordset2 = mysqli_query($link,$consulta);
		while($registro2 = mysqli_fetch_array($recordset2)){
			$modelo=$registro2["modelo"];$talla=$registro2["talla"];$lote=$registro2["lote"];$fcaducidad=$registro2["fcaducidad"];
		}



		//buscar si el articulo existe en el inventario de la sucursal a la que se va a traspasar
		$existe=0;
		//$consulta="select count(*) as existe from inventario where idunicoe='$idunicoe' and idunicop='$idunicop' and idunicos='$sucursal_a' and modelo='$modelo' and talla='$talla' and lote='$lote' and fcaducidad='$fcaducidad'";
		$consulta="select count(*) as existe from inventario where idunicoe='$idunicoe' and idunicop='$idunicop' and idunicos='$sucursal_a' and talla='$talla'";
		$recordset2 = mysqli_query($link,$consulta);
		while($registro2 = mysqli_fetch_array($recordset2)){$existe=$registro2["existe"];}
		if(!isset($existe)){$existe=0;}
		if($existe==0){// no existe agregarlo			
			$consulta="insert into inventario (idunicoe,idunicop,idunicos,cantidad,modelo,talla,lote,fcaducidad) values ('$idunicoe','$idunicop','$sucursal_a','0','$modelo','$talla','$lote','$fcaducidad')";
			mysqli_query($link,$consulta);
		}

		//verificar si la cantidad solicitada en el traspaso esta disponible
		$existencia=0;
		$consulta="select cantidad from inventario where idunicoe='$idunicoe' and idunicoregi='$idunicoregi'";
		$recordset2 = mysqli_query($link,$consulta);
		while($registro2 = mysqli_fetch_array($recordset2)){$existencia=$registro2["cantidad"];}
		if(!isset($existencia)){$existencia=0;}
		//cantidad en proceso de venta
		$cantidadventas=0;
		$consulta="select cantidad from tmpventas where idunicoe='$idunicoe' and idunicop='$idunicop' and idunicos='$idunicos'";
		$recordset2 = mysqli_query($link,$consulta);
		while($registro2 = mysqli_fetch_array($recordset2)){$cantidadventas=$registro2["cantidad"];}
		if(!isset($cantidadventas)){$cantidadventas=0;}

		if($cantidad>($existencia-$cantidadventas)){			
			$cantidad=$existencia-$cantidadventas;			
		}
		if($cantidad>0){ // existe cantidad disponible del producto realizar operaciones

			//datos del producto
			$pmostrador=0;$iva=0;$descuento=0;$pfinal=0;
			$consulta="select pmostrador,iva,descuento from productos where idunicop='$idunicop' and  idunicoe='$idunicoe'";
			$recordset2 = mysqli_query($link,$consulta);
			while($registro2 = mysqli_fetch_array($recordset2)){
				$pmostrador=$registro2["pmostrador"];
				$iva=$registro2["iva"];
				$descuento=$registro2["descuento"];
			}
			
			if($descuento>0){
				$descuento=($cantidad*$pmostrador)*($descuento/100);
			}
			if($iva>0){
				$iva=$iva/100;
				$iva=round($iva,2);
				$iva=(($cantidad*$pmostrador)-$descuento)*$iva;
			}
			$pfinal=($cantidad*$pmostrador)-$descuento+$iva;


			$consulta="insert into detsalidas (idunicosal,idunicop,pmostrador,cantidad,modelo,talla,descuento,iva,pfinal) values ('$idunicosal','$idunicop','$pmostrador','$cantidad','$modelo','$talla','$descuento','$iva','$pfinal')";
			mysqli_query($link,$consulta);

			//decrementar el inventario a la sucursal actual
			$consulta="update inventario set cantidad=cantidad-'$cantidad' where idunicoe='$idunicoe' and idunicoregi='$idunicoregi'";
			mysqli_query($link,$consulta);
			//echo $consulta;

			
			//registros a la que se le realiza el traspaso
			$folio=" "; //no se indica el folio que se va a registrar en la entrada
			$tipoent=1;// 0 compra 1 traspaso
			$consulta="insert into entradas (idunicoe,idunicos,idunicop,fechae,cantidad,pcompra,idunicou,folio,pmostrador,idunicoregi,tipoent) values ('$idunicoe','$idunicosr','$idunicop','$fecha','$cantidad','$pmostrador','$idunicou','$folio','$pmostrador','$idunicoregi','$tipoent')";	
			mysqli_query($link,$consulta);


			//incrementar inventario a la sucursal del traspaso
			$idunicoregi_2=0;
			//$consulta="select idunicoregi from inventario where idunicoe='$idunicoe' and idunicop='$idunicop' and idunicos='$idunicosr'  and modelo='$modelo' and talla='$talla' and lote='$lote' and fcaducidad='$fcaducidad'";
			$consulta="select idunicoregi from inventario where idunicoe='$idunicoe' and idunicop='$idunicop' and idunicos='$idunicosr' and talla='$talla'";	
			$recordset2 = mysqli_query($link,$consulta);
			while($registro2 = mysqli_fetch_array($recordset2)){$idunicoregi_2=$registro2["idunicoregi"];}

			$consulta="update inventario set cantidad=cantidad+'$cantidad' where idunicoe='$idunicoe' and idunicop='$idunicop' and idunicos='$idunicosr' and idunicoregi='$idunicoregi_2'";
			mysqli_query($link,$consulta);
	        // actualizar bitacora
	        $consulta="insert into bitacora (idunicoe,idunicos,idunicop,tipo,cantidad,pmostrador,idunicou,fechahora) values ('$idunicoe','$idunicos','$idunicop','4','$cantidad','$pmostrador','$idunicou','$fechahora')";	
			mysqli_query($link,$consulta);   

		}// fin de verificar si hay cantidad disponible del producto actual

	}
	//actualizar idunicosal con el total de la salida
	$sumatotal=0;
	$consulta="select sum(pfinal) as sumatotal from detsalidas where idunicosal='$idunicosal'";
	$recordset2 = mysqli_query($link,$consulta);
	while($registro2 = mysqli_fetch_array($recordset2)){$sumatotal=$registro2["sumatotal"];}	
	$consulta="update mtosalidas set total='$sumatotal' where idunicosal='$idunicosal'";
	mysqli_query($link,$consulta);

	//borrar temporal
	$consulta="delete from tmptraspaso where idsesion='$idsesion' and idunicoe='$idunicoe' and idunicos='$idunicos'";
	mysqli_query($link,$consulta);
	$resultado="1";

}else{
	$resultado="0";
}
echo $resultado;
?>