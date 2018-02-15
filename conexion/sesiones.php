<?php
function verifica_sesion($tipovalidacion,$idunicou,$idregistro,$login){		
	include "conexion.php";

	$valor=0;
	$dirip=obtieneip();		
	if ($tipovalidacion==1){ // es una validadion inicial solo obtener ip y limpiar todas las varibles
		$no=0;
		$consulta="select count(*) as no from sesiones where login='$login'";
		$recordset = mysqli_query($link,$consulta);
		while($registro = mysqli_fetch_array($recordset)){
			$no=$registro["no"];
		}
		if ($no==0){ //insertar registro
			$consulta="insert into sesiones (idregistro,idunicou,dirip,login) values ('$idregistro','$idunicou','$dirip','$login')";
			mysqli_query($link,$consulta);
		}else{ // ya existe solo actualizar la ip y periodo y limpiar sesiones
			$consulta="update sesiones set dirip='$dirip' where idunicou='$idunicou'";
			mysqli_query($link,$consulta);
		}		
		$valor=0;	
	}elseif ($tipovalidacion==2){ // ya incio sesion validar que la ip no halla cambiado
		$dirip_guardada="";
		$consulta="select dirip from sesiones where idunicou='$idunicou'";
		$recordset = mysqli_query($link,$consulta);
		while($registro = mysqli_fetch_array($recordset)){
			$dirip_guardada=$registro["dirip"];
		}
		if (strcmp($dirip,$dirip_guardada)<>0){ //limpiar variables 
			$consulta="update sesiones set dirip='' where idunicou='$idunicou'";
			mysqli_query($link,$consulta);
			$valor=1;
		}
	}elseif($tipovalidacion==3){ // cerrar sesion limpiar ip y variables
		$consulta="update sesiones set dirip='' where idunicou='$idunicou'";
		mysqli_query($link,$consulta);			
		$valor=0;
	}// fin de tipo de validacion

	$consulta="select idsesion from sesiones where login='$login'";
	$recordset = mysqli_query($link,$consulta);
	while($registro = mysqli_fetch_array($recordset)){$idsesion=$registro["idsesion"];}

	
	return $idsesion;
}

function obtieneip() {
	if (!empty($_SERVER['HTTP_CLIENT_IP']))
		return $_SERVER['HTTP_CLIENT_IP'];		   
	if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
		return $_SERVER['HTTP_X_FORWARDED_FOR'];	   
	return $_SERVER['REMOTE_ADDR'];
}
?>