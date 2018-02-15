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
$codigo=$_POST["codigo"];
$cantidad=$_POST["cantidad"];
$existearticulo=0;
$idunicoregi=0;// id unico del registro de inventario
$_SESSION["pvtacommand_prodinv"]=0;// el producto actual solo tiene un registro en inventario

$consulta="select idunicop from productos where idunicoe='$idunicoe' and codigo='$codigo' and tipo='0'";
$recordset = mysqli_query($link,$consulta);
while($registro = mysqli_fetch_array($recordset)){$idunicop=$registro["idunicop"];}


$consulta="select  count(*) as existearticulo from productos where idunicoe='$idunicoe' and codigo='$codigo' and tipo='0'";
$recordset = mysqli_query($link,$consulta);
while($registro = mysqli_fetch_array($recordset)){$existearticulo=$registro["existearticulo"];}
if(!isset($existearticulo)){$existearticulo=0;}
if($existearticulo>0){
	
	$existearticulo=0;
	$consulta="select count(*) as existearticulo from inventario as a left join productos as b on a.idunicoe=b.idunicoe and a.idunicop=b.idunicop
				where b.codigo='$codigo' and a.idunicoe='$idunicoe' and a.cantidad>='1' and idunicos='$idunicos' and a.tipo='0'";	
	$recordset = mysqli_query($link,$consulta);
	while($registro = mysqli_fetch_array($recordset)){$existearticulo=$registro["existearticulo"];}
	if(!isset($existearticulo)){$existearticulo=0;}	

	//obtener la cantidad en existencia del articulo

	//echo " existearticulo ".$existearticulo;
	
	
	if($existearticulo>1){// existen varias entradas del mismo articulo en el inventario
		$_SESSION["pvtacommand_idunicop_inv"]=$idunicop;// el producto actual tiene diversos registros en el inventario
		$existearticulo=0; // no insertar registro en esta consulta
	}else{
		//tiene una sola entrada
		//contar cantidades que ya se han agregado a la tabla temporal
		$consulta="select sum(cantidad) as cantidad from tmptraspaso where idunicoe='$idunicoe' and idunicop='$idunicop' and idunicos='$idunicos' ";
		$recordset = mysqli_query($link,$consulta);
		while($registro = mysqli_fetch_array($recordset)){$cantidadv=$registro["cantidad"];}
		if(!isset($cantidadv)){$cantidadv=0;}	

		//cantidad en existencia	
		$consulta="select sum(a.cantidad) as cantidad from inventario as a left join productos as b on a.idunicoe=b.idunicoe and a.idunicop=b.idunicop  where b.codigo='$codigo' and a.idunicoe='$idunicoe' and a.idunicos='$idunicos' and a.tipo='0'";
		$recordset = mysqli_query($link,$consulta);
		while($registro = mysqli_fetch_array($recordset)){$existencia=$registro["cantidad"];}
		if(!isset($existencia)){$existencia=0;}
		$disponible=$existencia-$cantidadv;

		//echo "disponible ".$disponible;

		if($cantidad<=$disponible){
			$_SESSION["pvtacommand_idunicop_inv"]=0;// el producto actual solo tiene un registro en inventario

		}else{//mostrar resultado de busqueda
			$_SESSION["pvtacommand_idunicop_inv"]=$idunicop;// el producto actual tiene diversos registros en el inventario
			$existearticulo=0; // no insertar registro en esta consulta
		}


		

		
	}
	
}


if($existearticulo>0){//si existe agregarlo a la venta
	$idunicop=0;
	$consulta="select idunicop from productos where idunicoe='$idunicoe' and codigo='$codigo' and tipo='0'";
	$recordset = mysqli_query($link,$consulta);
	while($registro = mysqli_fetch_array($recordset)){$idunicop=$registro["idunicop"];}

	$existe=0;
	$consulta="select count(*) as no from tmptraspaso where idsesion='$idsesion' and idunicoe='$idunicoe' and idunicop='$idunicop' and idunicos='$idunicos'";
	$recordset = mysqli_query($link,$consulta);
	while($registro = mysqli_fetch_array($recordset)){
		$existe=$registro["no"];
	}
	if(!isset($existe)){$existe=0;}
	
	if($existe==0){
		$idunicoregi=0;
		$consulta="select idunicoregi from inventario where idunicoe='$idunicoe' and idunicop='$idunicop' and idunicos='$idunicos'";
		$recordset = mysqli_query($link,$consulta);
		while($registro = mysqli_fetch_array($recordset)){$idunicoregi=$registro["idunicoregi"];}

		$consulta="insert into tmptraspaso (idsesion,idunicoe,idunicos,idunicop,cantidad,idunicoregi) values ('$idsesion','$idunicoe','$idunicos','$idunicop','$cantidad','$idunicoregi')";
		mysqli_query($link,$consulta);
	}else{
		$consulta="update tmptraspaso set cantidad=cantidad+'$cantidad' where idsesion='$idsesion' and idunicoe='$idunicoe' and idunicop='$idunicop'";
		mysqli_query($link,$consulta);
	}

}

echo $existearticulo;
?>