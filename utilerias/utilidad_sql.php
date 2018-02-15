<?php
header("Content-Type: text/html;charset=utf-8");
set_time_limit(0);
session_start();
session_name("ssdpvccmm");
if (!isset($_SESSION["pvtacommand_ingsisv"])){echo"<SCRIPT>window.location='../index.php';</SCRIPT>";}	

include("../conexion/conexion.php");
//carga de variables de session
//$anioactual=$_SESSION["sadm_anio"];
$idunicoe=$_SESSION["pvtacommand_idunicoe"];
$idunicos=$_SESSION["pvtacommand_idunicos"];

$utilidad=$_POST["utilidad"];

$resultado=1;
//actualiza parametro de la empresa
$consulta="update empresa set utilidad='$utilidad' where idunicoe='$idunicoe'";
$recordset = mysqli_query($link,$consulta);
//actualiza precios del catalogo de productos de la empresa
$porcutilidad=(($utilidad/100)+1);
$consulta="update productos set pmostrador=((ultpcompra*$porcutilidad)+10) where idunicoe='$idunicoe'";
$recordset = mysqli_query($link,$consulta);
echo $resultado;

?>