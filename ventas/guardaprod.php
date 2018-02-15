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

$idunicoregi=$_POST["idunicoregi"];
$cantidad=$_POST["cantidad"]; // cantidad
$opcion=$_POST["opcion"]; // 1 se pulso el boton agregar 2 se pulso el boton de quitar


$idunicop=0;
$consulta="select idunicop from inventario where idunicoe='$idunicoe' and idunicoregi='$idunicoregi'";
$recordset = mysqli_query($link,$consulta);
while($registro = mysqli_fetch_array($recordset)){
	$idunicop=$registro["idunicop"];
}
$precio=0;
$consulta="select pmostrador from productos where idunicop='$idunicop' and idunicoe='$idunicoe'";
$recordset = mysqli_query($link,$consulta);
while($registro = mysqli_fetch_array($recordset)){
	$precio=$registro["pmostrador"];
}

$existe=0;
$consulta="select count(*) as no from tmpventas where idsesion='$idsesion' and idunicoe='$idunicoe' and idunicoregi='$idunicoregi'";
$recordset = mysqli_query($link,$consulta);
while($registro = mysqli_fetch_array($recordset)){$existe=$registro["no"];}
if(!isset($existe)){$existe=0;}

if($opcion==1){	
	
	if($existe==0){
        //consultar cantidad por producto para validarlo
        $existencia=0;
        $consulta="select cantidad from inventario where idunicoregi='$idunicoregi' and idunicoe='$idunicoe'";
		$recordset2 = mysqli_query($link,$consulta);
		while($registro2 = mysqli_fetch_array($recordset2)){
			//$pmostrador=$registro2["pmostrador"];
			$existencia=$registro2["cantidad"];
		}        
        if ($existencia<$cantidad){
            $cantidad=$existencia;
        }


		$consulta="insert into tmpventas (idsesion,idunicoe,idunicos,idunicop,cantidad,idunicoregi,precio) values ('$idsesion','$idunicoe','$idunicos','$idunicop','$cantidad','$idunicoregi','$precio')";
		mysqli_query($link,$consulta);
	}else{
		$consulta="update tmpventas set cantidad=cantidad+'$cantidad' where idsesion='$idsesion' and idunicoe='$idunicoe' and idunicoregi='$idunicoregi'";
		mysqli_query($link,$consulta);
	}
}else{
	if($existe>0){
		$consulta="update tmpventas set cantidad=cantidad-'$cantidad' where idsesion='$idsesion' and idunicoe='$idunicoe' and idunicoregi='$idunicoregi'";
		mysqli_query($link,$consulta);
		//verificar cantidad resultante
		$cantidad=0;
		$consulta="select cantidad from tmpventas where idsesion='$idsesion' and idunicoe='$idunicoe' and idunicoregi='$idunicoregi'";
		$recordset = mysqli_query($link,$consulta);
		while($registro = mysqli_fetch_array($recordset)){$cantidad=$registro["cantidad"];}
		if(!isset($cantidad)){$cantidad=0;}		
		if($cantidad<=0){
			$consulta="delete from tmpventas where  idsesion='$idsesion' and idunicoregi='$idunicoregi'";
			mysqli_query($link,$consulta);
		}

	}
}

//echo $consulta;

//$link = mysqli_connect("localhost", "root", "cuboye1081");
//mysqli_select_db($link, "pventa");
//$tildes = $link->query("SET NAMES 'utf8'"); //Para que se muestren las tildes correctamente
//$consulta="insert into tmpventas (idsesion) values ('1')";
//mysqli_query($link,$consulta);

//echo $link;
?>