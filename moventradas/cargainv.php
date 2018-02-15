<?php
if (!isset($_SESSION["pvtacommand_idunicoe"])){
	session_start(); 	
}
session_name("ssdpvccmm");
if (!isset($_SESSION["pvtacommand_ingsisv"])){echo"<SCRIPT>window.location='../index.php';</SCRIPT>";}	
include "../conexion/conexion.php";

$codigo=$_SESSION["pvtacommand_mecodigo"];
$descripcion=$_SESSION["pvtacommand_menombrep"];
$idunicoe=$_SESSION["pvtacommand_idunicoe"];
$idunicos=$_SESSION["pvtacommand_idunicos"];// id unico de la sucursal

$idunicoregi=$_SESSION["pvtacommand_meidunicoregi"];
$idunicop=$_SESSION["pvtacommand_meidunicop"];





$consulta="select idunicoregi,idunicop,talla,cantidad from inventario where idunicoe='$idunicoe' and idunicop='$idunicop' and idunicos='$idunicos' order by cast(talla as UNSIGNED)";
$recordset = mysqli_query($link,$consulta);
while($registro = mysqli_fetch_array($recordset)){		
	$idunicoregi=$registro["idunicoregi"];
	$idunicopinv=$registro["idunicop"];
	$talla=$registro["talla"];
	$cantidad=$registro["cantidad"];
	$nombre="inv_".$idunicoregi;
	echo'<div class="control-group">';
	echo'<label class="control-label" for="nombre"><strong>Cantidad--> '.$cantidad.'</strong> </label>';
	echo'<label class="control-label" for="nombre"><strong>Talla:'.$talla.':--:</strong> </label>';
	echo'<input class="span3" id="'.$nombre.'" name="folio" type="number" maxlength="10" min=0 value="0" align="justify" />';
    
	

	echo'</div>';
}

?>