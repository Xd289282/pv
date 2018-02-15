<?php
	session_start();	
	session_name("ssdpvccmm");

	$nivel=$_SESSION["pvtacommand_nivelm"];
	if($nivel==1){
		$nivel="./";
	}else{
		$nivel="../";
	}
	session_destroy();
	//include "conexion.php";
	//include "conexion/sesiones.php";
	//verifica_sesion(3,$_SESSION["sadm_user"],0);
	
	
	echo $nivel."index.php"
?>