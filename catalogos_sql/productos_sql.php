<?php
session_start(); 
session_name("ssdpvccmm");
if (!isset($_SESSION["pvtacommand_ingsisv"])){echo"<SCRIPT>window.location='../index.php';</SCRIPT>";}	
include "../conexion/conexion.php";

$codigo=$_POST["codigo"];
$nombrep=utf8_decode($_POST["nombrep"]);
//$descrip=utf8_decode($_POST["descrip"]);
$ultpcompra=$_POST["ultpcompra"];
$pmostrador=round($_POST["pmostrador"]);
$stock=$_POST["stock"];
$iva='16';
$descuento=$_POST["descuento"];
$cvetip=$_POST["cvetip"];
if(!isset($_POST["marca"])){
	$marca="";
}else{
	$marca=$_POST["marca"];	
}
if(!isset($_POST["serie"])){
	$serie="";
}else{
	$serie=$_POST["serie"];	
}

$color=$_POST["color"];
$opcion=$_POST["opcion"];
$tipo=0; //0  es un producto 1 es servicio

$talla1=$_POST["talla1"];
$talla2=$_POST["talla2"];

if(!isset($_POST["modelo"])){
	$modelo="";
}else{
	$modelo=$_POST["modelo"];	
}
if(!isset($_POST["proveedor"])){
	$proveedor="";
}else{
	$proveedor=$_POST["proveedor"];	
}


$idunicoe=$_SESSION["pvtacommand_idunicoe"];// id unico de la empresa del usuario

$resultado=0; // 1  se agrego el registro 2 se modifico 3 se elimino 0 ocurrio un error
if($opcion==1){// agregar

    $codigoe=0;		
	$consulta="select idunicop from productos where idunicoe='$idunicoe' and codigo='$codigo' ";
	$recordset = mysqli_query($link,$consulta);
	while($registro = mysqli_fetch_array($recordset)){$codigoe=$registro["idunicop"];}

	if ($codigoe==0){

		$consulta="insert into productos (idunicoe,codigo,nombrep,descrip,ultpcompra,pmostrador,stock,iva,descuento,marca,color,serie,tipo,idunicopr,cvetip) values ('$idunicoe','$codigo','$nombrep','','$ultpcompra','$pmostrador','$stock','16','$descuento','$marca','$color','$serie','0','$proveedor','$cvetip')";	
		mysqli_query($link,$consulta);
		//if($tipo==1){// servicio agregar registro en inventario
		//echo $consulta;	
		$idunicop=1;		
		$consulta="select idunicop from productos where idunicoe='$idunicoe' and codigo='$codigo' and nombrep='$nombrep' and tipo='$tipo'";
		$recordset = mysqli_query($link,$consulta);
		while($registro = mysqli_fetch_array($recordset)){$idunicop=$registro["idunicop"];}

		//recorrer sucursales
		$consulta="select idunicos from sucursal where idunicoe='$idunicoe'";
		$recordset = mysqli_query($link,$consulta);
		while($registro = mysqli_fetch_array($recordset)){
			$idunicos_inv=$registro["idunicos"];
			
			for ($i=$talla1; $i <=$talla2 ; $i=$i+.5) { 		
				$consulta="insert into inventario (idunicoe,idunicop,idunicos,cantidad,tipo,talla,modelo) values ('$idunicoe','$idunicop','$idunicos_inv','0','$tipo','$i','$modelo')";
				mysqli_query($link,$consulta);			
			}
		}	

        $resultado=1;

    }else{$resultado=5;}
		

	//}
	
    
}elseif($opcion==2){// modificar
	$idunicop=$_SESSION["pvtacommand_id"];
	$consulta="update productos set codigo='$codigo',nombrep='$nombrep',descrip='',ultpcompra='$ultpcompra',pmostrador='$pmostrador',stock='$stock',iva='16',descuento='$descuento',marca='$marca',color='$color',serie='$serie',tipo='0',idunicopr='$proveedor',cvetip='$cvetip' where idunicop='$idunicop'";
	mysqli_query($link,$consulta);
	//modificar las tallas
	for ($i=$talla1; $i <=$talla2 ; $i=$i+.5) { 	
	            //consultar que no exista ya
                //recorrer sucursales
		        $consultas="select idunicos from sucursal where idunicoe='$idunicoe'";
		        $recordsets = mysqli_query($link,$consultas);
		        while($registros = mysqli_fetch_array($recordsets)){
			          $idunicos_inv=$registros["idunicos"];

	                  $busca="Select count(talla) as existe from inventario where idunicoe='$idunicoe' and idunicos='$idunicos_inv' and idunicop='$idunicop' and talla='$i'";
	                  $existe=0;
		              $recordsetsb= mysqli_query($link,$busca);
		              while($registrob = mysqli_fetch_array($recordsetsb)){
                            $existe=$registrob["existe"];		              	
                      }
                      if ($existe==0){
				          $consulta="insert into inventario (idunicoe,idunicop,idunicos,cantidad,tipo,talla,modelo) values ('$idunicoe','$idunicop','$idunicos_inv','0','$tipo','$i','$modelo')";
				          mysqli_query($link,$consulta);			

                      }
                }


	}	

	$resultado=2;

}elseif($opcion==3){//eliminar
	$idunicop=$_SESSION["pvtacommand_id"];
	//verificar que no tenga registros en 	inventario
	$no=0;
	$consulta="select count(*) as no from inventario where idunicoe='$idunicoe' and idunicop='$idunicop' and tipo='0'";
	$recordset = mysqli_query($link,$consulta);
	while($registro = mysqli_fetch_array($recordset)){
		$no=$registro["no"];
	}
	////verificar entradas
	$consulta="select count(*) as no from entradas where idunicoe='$idunicoe' and idunicop='$idunicop'";
	$recordset = mysqli_query($link,$consulta);
	while($registro = mysqli_fetch_array($recordset)){
		$no=$registro["no"];
	}
	
	////verificar salidas
	$consulta="select count(*) as no from detsalidas where idunicop='$idunicop'";
	$recordset = mysqli_query($link,$consulta);
	while($registro = mysqli_fetch_array($recordset)){
		$no=$registro["no"];
	}

	if(!isset($no)){$no=0;}
	if($no==0){
		$consulta="delete from productos where idunicop='$idunicop'";
		mysqli_query($link,$consulta);
			$consulta="delete from inventario where idunicoe='$idunicoe' and idunicop='$idunicop' and tipo='$tipo'";
			mysqli_query($link,$consulta);
		$resultado=3;	
	}else{
		$resultado=4;
	}
	
}

echo $resultado;

?>