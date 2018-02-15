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
$codigo=$_POST["codigo"];
$cantidad=$_POST["cantidad"];
$modelo=$_POST["modelo"];
$talla=$_POST["talla"];
$lote=$_POST["lote"];

if(!isset($_POST["fcaducidad"])){
	$fcaducidad="1900-01-01";
}else{
	$fcaducidad=$_POST["fcaducidad"];
	$fcaducidad=substr($fcaducidad,6,4).'-'.substr($fcaducidad,3,2).'-'.substr($fcaducidad,0,2)." 00:00:00";	
}

$opcion=$_POST["opcion"];
$idunicoe=$_SESSION["pvtacommand_idunicoe"];// id unico de la empresa del usuario

$idunicoregi=$_SESSION["pvtacommand_meidunicoregi"];// id unico del producto seleccionado

$idunicop=0;
$consulta="select idunicop from productos where codigo='$codigo' and idunicoe='$idunicoe' and tipo='0'" ;//obtiene el id del inventario asociado a la entrada
$recordset = mysqli_query($link,$consulta);
while($registro = mysqli_fetch_array($recordset)){$idunicop=$registro["idunicop"];}

$resultado=0; // 1  se agrego el registro 2 se modifico 3 se elimino 0 ocurrio un error
if($opcion==1){// agregar
	$idunicop=0;
    $consulta="select idunicop from productos where idunicoe='$idunicoe' and codigo='$codigo' and tipo='0'" ;
	$recordset = mysqli_query($link,$consulta);
	while($registro = mysqli_fetch_array($recordset)){$idunicop=$registro["idunicop"];}    
    if ($idunicop<>0){ //aproducto encontrado
	    $tipoent=0;  //es compra
	   //verificar si el inventario ya existe
	    $existe=0;
	    $consulta="select count(*) as existe from inventario where idunicoregi='$idunicoregi'" ;
		$recordset = mysqli_query($link,$consulta);
		while($registro = mysqli_fetch_array($recordset)){$existe=$registro["existe"];}    
	    if ($existe>0){ //actualiza inventario	   	    
			$consulta="update inventario set cantidad='$cantidad' where idunicoregi='$idunicoregi'";
			mysqli_query($link,$consulta);

	    }else{//da alta al inventario
		    //afecta tabla de entradas obteniendo el consecutivo del inventario
			$consulta="select altainventario('$idunicoe','$idunicos','$idunicop','$cantidad','$modelo','$talla','$lote','$fcaducidad') as num";
			$recordset = mysqli_query($link,$consulta);
			while($registro = mysqli_fetch_array($recordset)){
				$num=$registro["num"];}
				//echo $num;
			if(!isset($num)){$num=1;}    	
	    }
	    echo $consulta;

	    // afecta bitacora
		$consulta="insert into bitacora (idunicoe,idunicos,idunicop,tipo,cantidad,pmostrador,idunicou,fechahora) values ('$idunicoe','$idunicos','$idunicop','2','$cantidad','0','$idunicou','$fechahora')";	
		mysqli_query($link,$consulta);    
		$resultado=1;  	
    }else{
    	$resultado=4;
    }
}elseif($opcion==2){// modificar
	$idunicoregi=$id;

	$consulta="update inventario set cantidad='$cantidad',modelo='$modelo',talla='$talla',lote='$lote',fcaducidad='$fcaducidad' where idunicoregi='$idunicoregi'"; // actualiza la entrada
	mysqli_query($link,$consulta);    
   // afecta bitacora
	$consulta="insert into bitacora (idunicoe,idunicos,idunicop,tipo,cantidad,pmostrador,idunicou,fechahora) values ('$idunicoe','$idunicos','$idunicop','1','$cantidad','0','$idunicou','$fechahora')";	
	mysqli_query($link,$consulta);    

	$resultado=2;

}elseif($opcion==3){//eliminar no aplica para el inventario, se modifica a cero en todo caso

	// $consulta="select cantidad from entradas where idunicoregi='$id'" ;//obtiene el id del inventario asociado a la entrada
	// $recordset = mysqli_query($link,$consulta);
	// while($registro = mysqli_fetch_array($recordset)){$cantidad=$registro["cantidad"];}
	// $consulta="select cantidad from inventario where idunicoregi='$id' and tipo='0'"; //obtiene el id del inventario asociado a la entrada
	// $recordset = mysqli_query($link,$consulta);
	// while($registro = mysqli_fetch_array($recordset)){$cantidadi=$registro["cantidad"];}
 //    if ($cantidad>$cantidadi){echo "La Entrada Ya fue usada para venta";}else{
 //    	$cantidadf=$cantidadi-$cantidad;
	// 	$consulta="delete from entradas where idunicoregi='$id'";
	// 	mysqli_query($link,$consulta);
 //        $consulta="update from inventario set cantidad='$cantidadf' where idunicoregi='$id'";
	// 	mysqli_query($link,$consulta);
 // 		 // afecta bitacora
	// 	$consulta="insert into bitacora (idunicoe,idunicos,idunicop,tipo,cantidad,pmostrador,idunicou,fechahora) values ('$idunicoe','$idunicos','$idunicop','5','$cantidad','0','$idunicou','$fechahora')";	
	// 	mysqli_query($link,$consulta);   
 //    }

	// $resultado=3;
}

echo $resultado;

?>