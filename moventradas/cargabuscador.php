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

$marca="";$modelo="";$color="";$talla="";$serie="";$lote="";$fcaducidad="";$pmostrador=0;$folio="";
//datos del producto
$consulta="select * from productos left join inventario on productos.idunicop=inventario.idunicop where productos.idunicop='$idunicop' and productos.idunicoe='$idunicoe' ";
$recordset = mysqli_query($link,$consulta);
while($registro = mysqli_fetch_array($recordset)){
	$codigo=utf8_encode($registro["codigo"]);
	$pmostrador=$registro["pmostrador"];
	$pcompra=$registro["ultpcompra"];
	$descripcion=$registro["descrip"];

	if(!isset($registro["marca"])){$marca="";}else{$marca=trim($registro["marca"]);}
	if(!isset($registro["modelo"])){$modelo="";}else{$modelo=trim($registro["modelo"]);}
    if(!isset($registro["color"])){$color="";}else{$color=trim($registro["color"]);}
    if(!isset($registro["serie"])){$serie="";}else{$serie=trim($registro["serie"]);}

}
// inventario
$consulta="select * from inventario where idunicoregi='$idunicoregi' and idunicoe='$idunicoe' and idunicop='$idunicop'";
$recordset = mysqli_query($link,$consulta);
while($registro = mysqli_fetch_array($recordset)){
	$cantidad=$registro["cantidad"];
	//$modelo=$registro["modelo"];
	$talla=$registro["talla"];
	$lote=$registro["lote"];

	if(!isset($registro["fcaducidad"])){
		$fcaducidad="";
	}else{
		$fcaducidad=$registro["fcaducidad"];
		$fcaducidad=substr($fcaducidad,8,2).'/'.substr($fcaducidad,5,2).'/'.substr($fcaducidad,0,4);			
	}


}


?>
<div class="control-group">
     <label class="control-label" for="nombre">Codigo:</label>
<div class="controls">
	<input class="span12" id="codigo" name="codigo" type="text" maxlength="100" value="<?php echo $codigo;?>"/> 	
	<a href="#" onclick="btnbuscar();" class="glyphicons search btn" data-placement="bottom"><i></i><span>Buscar</span></a>
	<a href="#" onclick="btnlimpiar();" class="glyphicons refresh btn" data-placement="bottom"><i></i><span>Limpiar</span></a>
</div>

 </div>
</div>
<div class="control-group">
     <label class="control-label" for="nombre">Tipo:</label>
	<div class="controls"><input class="span12" id="descrip" name="descrip" type="text" maxlength="100" value="<?php echo $descripcion;?>"  /></div>
</div>

								<?php
									if ($mostrarmarca==1){	
									?>
										<div class="control-group">
											<label class="control-label" for="nombre">Marca:</label>
											<div class="controls"><input class="span12" id="marca" name="marca" type="text" maxlength="50" value="<?php echo $marca;?>"  /></div>
										</div>
									<?php
									}  
									
									if ($mostrarmodelo==1){	
									?>
										<div class="control-group">
											<label class="control-label" for="nombre">Modelo:</label>
											<div class="controls"><input class="span12" id="modelo" name="modelo" type="text" maxlength="50" value="<?php echo $modelo;?>"  /></div>
										</div>
									<?php
									}  
									?>

									<div class="control-group">
											<label class="control-label" for="nombre">Color:</label>
											<div class="controls"><input class="span12" id="color" name="color" type="text" maxlength="50" value="<?php echo $color;?>"  /></div>
										</div>

									<?php
									if ($mostrartalla==1){	
									?>
										<!--
										<div class="control-group">
											<label class="control-label" for="nombre">Talla:</label>
											<div class="controls"><input class="span12" id="talla" name="talla" type="text" maxlength="50" value="<?php echo $talla;?>"  /></div>
										</div>	
										-->
									<?php
									}  
									
									if ($mostrarserie==1){	
									?>
										<div class="control-group">
											<label class="control-label" for="nombre">Serie:</label>
											<div class="controls"><input class="span12" id="serie" name="serie" type="text" maxlength="50" value="<?php echo $serie;?>"  /></div>
										</div>	
									<?php
									}  
									?>



	                                <?php
									if ($mostrarlote==1){
									?>		
										<div class="control-group">
											<label class="control-label" for="nombre">Lote:</label>
											<div class="controls"><input class="span12" id="lote" name="lote" type="text" maxlength="50" value="<?php echo $lote;?>"  /></div>
										</div>			
									<?php
									}	
										
									if ($mostrarfcaducidad==1){	
									?>		
										<div class="control-group">
											<label class="control-label" for="nombre">Fecha de Caducidad:</label>
		   							        
		   							        <div class="controls">
	                                          <div class="input-append">
		   							                <input type="text"  id="datepicker2" class="span12" value="<?php echo $fcaducidad;?>" />
													<span class="add-on glyphicons calendar"><i></i></span>
									          </div>
									   		 </div>


		   							          
										</div>			
									<?php
									}	
									?>		

									<div class="control-group">
										<label class="control-label" for="nombre">Precio de Venta:</label>
										<div class="controls"><input class="span12" id="preciom" name="preciom" type="text" maxlength="10" value="<?php echo $pmostrador;?>"  /></div>
									</div>	

									<div class="control-group">
										<label class="control-label" for="nombre">Precio de Compra:</label>
										<div class="controls"><input class="span12" id="precioc" name="precioc" type="text" maxlength="10" value="<?php echo $pcompra;?>"  /></div>
									</div>			
		
		
	<script src="../theme/scripts/load.js"></script>	