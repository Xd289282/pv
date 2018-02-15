<?php
session_start(); 
session_name("ssdpvccmm");
if (!isset($_SESSION["pvtacommand_ingsisv"])){echo"<SCRIPT>window.location='../index.php';</SCRIPT>";}	
include "../conexion/conexion.php";
$idunicoe=$_SESSION["pvtacommand_idunicoe"];
$idunicos=$_SESSION["pvtacommand_idunicos"];
$idunicou=$_SESSION["pvtacommand_idunicou"];
$fechahora=date("Y-m-d H:i:s");
$id=$_POST["id"];
$idu=$_POST["idu"];
$codigo=$_POST["codigo"];
$fechae=$_POST["fechae"];
$fechaef=substr($fechae,6,4).'-'.substr($fechae,0,2).'-'.substr($fechae,3,2)." 00:00:00";
//$cantidad=$_POST["cantidad"];

$folio=$_POST["folio"];
$pmostrador=$_POST["pmostrador"];
if(!isset($_POST["modelo"])){
	$modelo="";
}else{
	$modelo=$_POST["modelo"];	
}

if(!isset($_POST["talla"])){
	$talla="";
}else{
	$talla=$_POST["talla"];	
}

if(!isset($_POST["lote"])){
	$lote="";
}else{
	$lote=$_POST["lote"];	
}


$fcaducidadf="1900-01-01";
if(!isset($_POST["fcaducidad"])){
	$fcaducidadf="1900-01-01";
}else{
	$fcaducidadf=$_POST["fcaducidad"];
	$fcaducidadf=substr($fcaducidadf,6,4).'-'.substr($fcaducidadf,0,2).'-'.substr($fcaducidadf,3,2)." 00:00:00";
}



$opcion=$_POST["opcion"];
if ($opcion<>3){
	$pcompra=$_POST["pcompra"];
	$arreglo=$_POST["arreglo"];
	$tam=count($arreglo);
}
$idunicoe=$_SESSION["pvtacommand_idunicoe"];// id unico de la empresa del usuario
$idunicop=0;
/*CONFIGURACIONES*/
$mostrarmarca=0;$mostrarmodelo=0;$mostrartalla=0;$mostrarserie=0;$mostrarlote=0;$mostrarfcaducidad=0;
$consulta="select marca,serie,modelo,talla,lote,fcaducidad from configuraciones where idunicoe='$idunicoe'";
$recordset = mysqli_query($link,$consulta);
while($registro = mysqli_fetch_array($recordset)){				
	$mostrarmarca=$registro["marca"];
	$mostrarserie=$registro["serie"];
	$mostrarmodelo=$registro["modelo"];
	$mostrartalla=$registro["talla"];
	$mostrarfcaducidad=$registro["fcaducidad"];
	$mostrarlote=$registro["lote"];
}


$consulta="select idunicop from productos where codigo='$codigo' and idunicoe='$idunicoe'" ;//obtiene el id del inventario asociado a la entrada
	$recordset = mysqli_query($link,$consulta);
	while($registro = mysqli_fetch_array($recordset)){$idunicop=$registro["idunicop"];}
$resultado=0; // 1  se agrego el registro 2 se modifico 3 se elimino 0 ocurrio un error
if($opcion==1){// agregar
	$idunicop=0;
    $consulta="select idunicop from productos where idunicoe='$idunicoe' and codigo='$codigo'" ;
	$recordset = mysqli_query($link,$consulta);
	while($registro = mysqli_fetch_array($recordset)){$idunicop=$registro["idunicop"];}    
    if ($idunicop<>0){ //aproducto encontrado
	     // obtener siguiente valor de entradas por empresa y sucursal no es necesario porque es autoincremental
		$idunicoregi=0;
	    $tipoent=0;  //es compra
	    $cantidadi=0;
	    $num=1;
	    //verificar si el inventario ya existe

	    //$consulta="select idunicoregi,cantidad as cantidadi from inventario where idunicoe='$idunicoe' and idunicos='$idunicos' and modelo='$modelo' and talla='$talla' and lote='$lote' and fcaducidad='$fcaducidadf'" ;
	    
	    $consulta="select idunicoregi,cantidad as cantidadi from inventario where idunicoe='$idunicoe' and idunicos='$idunicos' and idunicop='$idunicop' ";
	    if($mostrarmodelo>0){$consulta.=" and modelo='$modelo' ";}
	    if($mostrartalla>0){$consulta.=" and talla='$talla' ";}
	    if($mostrarlote>0){$consulta.=" and lote='$lote' ";}
	    if($mostrarfcaducidad>0){$consulta.=" and fcaducidad='$fcaducidadf' ";}

		$recordset = mysqli_query($link,$consulta);
		while($registro = mysqli_fetch_array($recordset)){$idunicoregi=$registro["idunicoregi"];}    
		if(!isset($idunicoregi)){$idunicoregi=0;}

		//actualizar arreglo		
		$contador=0;
		$consulta="select idunicoregi,talla from inventario where idunicoe='$idunicoe' and idunicop='$idunicop' and idunicos='$idunicos' order by cast(talla as UNSIGNED)";
		$recordset = mysqli_query($link,$consulta);
		while($registro = mysqli_fetch_array($recordset)){
			$idunicoregi=$registro["idunicoregi"];
			$talla=$registro["talla"];
			$valor=$arreglo[$contador];
			if(!isset($valor)){$valor=0;}
			$contador++;
			$consulta="update inventario set cantidad=cantidad+'$valor' where idunicoregi='$idunicoregi' and talla='$talla'";
			mysqli_query($link,$consulta);
			
			if($valor>0){
				$consulta="insert into entradas (idunicoe,idunicos,idunicop,fechae,cantidad,pcompra,idunicou,folio,pmostrador,idunicoregi,tipoent) values ('$idunicoe','$idunicos','$idunicop','$fechaef','$valor','$pcompra','$idunicou','$folio','$pmostrador','$idunicoregi','$tipoent')";	
				mysqli_query($link,$consulta);
		   		// afecta bitacora
				$consulta="insert into bitacora (idunicoe,idunicos,idunicop,tipo,cantidad,pmostrador,idunicou,fechahora) values ('$idunicoe','$idunicos','$idunicop','2','$valor','$pmostrador','$idunicou','$fechahora')";	
				mysqli_query($link,$consulta);   
			}
			

		}    

		/*
	    if ($idunicoregi<>0){ //actualiza inventario
	   	    $cantidadf=$cantidadi+$cantidad;
			$consulta="update inventario set cantidad=cantidad+'$cantidadf' where idunicoregi='$idunicoregi'";
			mysqli_query($link,$consulta);

	    }else{//da alta al inventario
		    //afecta tabla de entradas obteniendo el consecutivo del inventario
			$consulta="select altainventario('$idunicoe','$idunicos','$idunicop','$cantidad','$modelo','$talla','$lote','$fcaducidadf') as num";			
			$recordset = mysqli_query($link,$consulta);


			while($registro = mysqli_fetch_array($recordset)){
				$num=$registro["num"];}
				//echo $num;
			if(!isset($num)){$num=1;}    	
	    }
	    */

	//   inserta en la tabla de entradas
		 
		$consulta="update productos set pmostrador='$pmostrador',ultpcompra='$pcompra' where idunicop='$idunicop' and idunicoe='$idunicoe'";// actualiza el precio de mostrador del producto
		mysqli_query($link,$consulta);  
		
		$resultado=1;  	
    }else{
    	$resultado=4;
    }
	
}elseif($opcion==2){// modificar
	$idunicoregi=0;
	$consulta="select idunicoregi from entradas where idunicoreg='$id'"; //obtiene el id del inventario asociado a la entrada
	$recordset = mysqli_query($link,$consulta);

	while($registro = mysqli_fetch_array($recordset)){$idunicoregi=$registro["idunicoregi"];}
	$consulta="update entradas set fechae='$fechaef',pcompra='$pcompra',pmostrador='$pmostrador',folio='$folio' where idunicoreg='$id'"; // actualiza la entrada
	mysqli_query($link,$consulta);  

	$consulta="update inventario set modelo='$modelo',talla='$talla',lote='$lote',fcaducidad='$fcaducidadf' where idunicoregi='$idunicoregi'"; // actualiza la entrada
	mysqli_query($link,$consulta);    
   // afecta bitacora
	$consulta="insert into bitacora (idunicoe,idunicos,idunicop,tipo,cantidad,pmostrador,idunicou,fechahora) values ('$idunicoe','$idunicos','$idunicop','1','$cantidad','0','$idunicou','$fechahora')";	
	mysqli_query($link,$consulta); 
	$consulta="update productos set pmostrador='$pmostrador' where idunicop='$idunicop'";// actualiza el precio de mostrador del producto
	mysqli_query($link,$consulta);  
	  

	$resultado=2;

}elseif($opcion==3){//eliminar
	$id=$idu;
	$idunicoregi=0;
	$cantidadi=0;
	$cantidad=0;
	$consulta="select idunicoregi,cantidad from entradas where idunicoreg='$id'" ;//obtiene el id del inventario asociado a la entrada
	$recordset = mysqli_query($link,$consulta);
	while($registro = mysqli_fetch_array($recordset)){$idunicoregi=$registro["idunicoregi"];$cantidad=$registro["cantidad"];}
	$consulta="select cantidad from inventario where idunicoregi='$idunicoregi'"; //obtiene el id del inventario asociado a la entrada
	$recordset = mysqli_query($link,$consulta);
	while($registro = mysqli_fetch_array($recordset)){$cantidadi=$registro["cantidad"];}
    if ($cantidad>$cantidadi){echo "La Entrada Ya fue usada para venta";}else{
    	$cantidadf=$cantidadi-$cantidad;
		$consulta="delete from entradas where idunicoreg='$id'";
		$consu=$consulta;
		mysqli_query($link,$consulta);
		$consulta="update inventario set cantidad='$cantidadf' where idunicoregi='$idunicoregi'";
		mysqli_query($link,$consulta);
 		 // afecta bitacora
		$consulta="insert into bitacora (idunicoe,idunicos,idunicop,tipo,cantidad,pmostrador,idunicou,fechahora) values ('$idunicoe','$idunicos','$idunicop','5','$cantidad','0','$idunicou','$fechahora')";	
		mysqli_query($link,$consulta);   
    }

	$resultado=3;
}
//echo $consu;
echo $resultado;

?>