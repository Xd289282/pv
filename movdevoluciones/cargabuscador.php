<?php
if (!isset($_SESSION["pvtacommand_idunicoe"])){
	session_start(); 	
}
session_name("ssdpvccmm");
if (!isset($_SESSION["pvtacommand_ingsisv"])){echo"<SCRIPT>window.location='../index.php';</SCRIPT>";}	
include "../conexion/conexion.php";

//$codigo=$_SESSION["pvtacommand_mecodigo"];
//$descripcion=$_SESSION["pvtacommand_menombrep"];
//$idunicoe=$_SESSION["pvtacommand_idunicoe"];
$idunicos=$_SESSION["pvtacommand_idunicos"];// id unico de la sucursal

$idunicoregi=$_SESSION["pvtacommand_meidunicoregi"];
//$idunicop=$_SESSION["pvtacommand_meidunicop"];


// detalle de venta por el producto seleccionado
$consulta="select b.idunicodetsal,a.ticket,a.fecha,c.codigo,c.nombrep,b.cantidad,b.pfinal from mtosalidas as a left join detsalidas as b on a.idunicosal=b.idunicosal left join productos as c on b.idunicop=c.idunicop where b.idunicodetsal='$idunicoregi'";
$recordset = mysqli_query($link,$consulta);
while($registro = mysqli_fetch_array($recordset)){
	$ticket=$registro["ticket"];
	$fecha=ltrim($registro["fecha"]);
	$codigo=$registro["codigo"];
	$cantidad=$registro["cantidad"];
	$nombrep=$registro["nombrep"];
	$pfinal=$registro["pfinal"];


}


?>
<div class="control-group">
     <label class="control-label" for="nombre">Ticket:</label>
<div class="controls">
	<input class="span12" id="ticket" name="ticket" type="text" maxlength="100" value="<?php echo $ticket;?>"/> 	
	<a href="#" onclick="btnbuscar();" class="glyphicons search btn" data-placement="bottom"><i></i><span>Buscar</span></a>
	<a href="#" onclick="btnlimpiar();" class="glyphicons refresh btn" data-placement="bottom"><i></i><span>Limpiar</span></a>
</div>

 </div>
</div>
<div class="control-group">
     <label class="control-label" for="codigo">codigo:</label>
	<div class="controls"><input class="span12" id="descrip" name="descrip" type="text" maxlength="100" value="<?php echo $codigo;?>"  /></div>
</div>

<div class="control-group">
     <label class="control-label" for="nombre">Descripcion:</label>
	<div class="controls"><input class="span12" id="descrip" name="descrip" type="text" maxlength="100" value="<?php echo $nombrep;?>"  /></div>
</div>


									<div class="control-group">
										<label class="control-label" for="nombre">Precio Mostrador:</label>
										<div class="controls"><input class="span12" id="preciom" name="preciom" type="text" maxlength="10" value="<?php echo $pfinal;?>"  /></div>
									</div>	
                                    
                                    <div class="control-group">
										<label class="control-label" for="nombre">Fecha de Venta:</label>
	   							     <div class="controls">
                                          <div class="input-append">
	   							                <input type="text"  id="datepicker" <?php if ($opcion=1) {echo "disabled";}?> class="span12" value="<?php echo $fecha;?>" />
												<span class="add-on glyphicons calendar"><i></i></span>
								          </div>
								    </div>	

								</div>	

                                
								<div class="control-group">
									<label class="control-label" for="nombre">Cantidad:</label>
	
									<div class="controls"><input class="span12" id="cantidad" <?php if ($opcion=1) {echo "disabled";}?> name="cantidad" type="text" maxlength="10" value="<?php echo $cantidad;?>"  /></div>

								</div>
	
		
		
	<script src="../theme/scripts/load.js"></script>	