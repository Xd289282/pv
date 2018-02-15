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
//numero de productos
$noproductos=0;
$consulta="select sum(cantidad) as noproductos  from tmpventas where idsesion='$idsesion' and idunicoe='$idunicoe' ";
$recordset = mysqli_query($link,$consulta);
while($registro = mysqli_fetch_array($recordset)){$noproductos=$registro["noproductos"];}
if(!isset($noproductos)){$noproductos=0;}
//descuento de productos e importe total precio venta
$importet=0;$descuento=0;$total=0;$sumadesc=0;
$consulta="select a.cantidad,a.precio,b.iva,b.descuento from tmpventas as a left join productos as b on a.idunicoe=b.idunicoe and a.idunicop=b.idunicop where a.idsesion='$idsesion' and a.idunicoe='$idunicoe'";
$recordset = mysqli_query($link,$consulta);
while($registro = mysqli_fetch_array($recordset)){
	$cantidad=$registro["cantidad"];
	$pmostrador=$registro["precio"];
	$iva=$registro["iva"];	
	$descuento=$registro["descuento"];
	//$descuento=10;
	$pmostrador=$pmostrador*$cantidad;



	if($descuento>0){
		$descuento=$cantidad*10;
		//$sumadesc=$sumadesc+$descuento;
		$sumadesc=$sumadesc+($cantidad*10);
	}

	if($iva>0){
		$iva=$iva/100;
		$iva=round($iva,2);
		$iva=($pmostrador-$descuento)*$iva;
	}
				
	$importet=$importet+(($pmostrador-$descuento)+$iva);
	
}

$total=$importet+$sumadesc;// total 

$importet=number_format($importet,2); // importe por cobrar
$sumadesc=number_format($sumadesc,2);
$total=number_format($total,2);




?>
<div class="span4">
	<div class="widget widget-3">
			
		<div class="widget-head">
				
				<h4 class="heading"><span class="glyphicons user_add"><i></i></span>No. Productos</h4>
			</div>
			<div class="widget-body large cancellations">
				<?php echo $noproductos;?>
			</div>
			<div class="widget-footer align-center">
				
			</div>
		</div>
	</div>
	<div class="span4">
		<div class="widget widget-3">
			<div class="widget-head">
				<h4 class="heading"><span class="glyphicons user_add"><i></i></span>Descuento</h4>
			</div>
			<div class="widget-body large">
				<ant style="font-size:40%;"><?php if($descuento>0){echo "$".$total."-";}?></ant> $<?php echo $sumadesc;?>
			</div>
			<div class="widget-footer">
				
			</div>
		</div>
	</div>
	<div class="span4">
		<div class="widget widget-3">
			
			<div class="widget-head">
				<h4 class="heading"><span class="glyphicons coins"><i></i></span>Total</h4>
			</div>
			<div class="widget-body large">
				$<?php echo $importet;?>
			</div>
			<div class="widget-footer align-right">
				
			</div>
		</div>
	</div>