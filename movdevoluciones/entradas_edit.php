<?php
session_name("ssdpvccmm");
if (!isset($_SESSION["pvtacommand_ingsisv"])){echo"<SCRIPT>window.location='../index.php';</SCRIPT>";}	

//opciones 1 agregar 2 modificar 3 eliminar
$opcion=1; // 1 agregar 2 modificar 3 eliminar
if (!isset($_SESSION["pvtacommand_axx"])){ 
    $opcion=1;    
}else{   
    $opcion=$_SESSION["pvtacommand_axx"];
}

if (!isset($_SESSION["pvtacommand_id"])){ 
    $id=0;    
}else{   
    $id=$_SESSION["pvtacommand_id"];
}
$idunicoe=$_SESSION["pvtacommand_idunicoe"];
$codigo="";$cantidad="";$pcompra="";$folio="";$pmostrador="";$modelo="";$talla="";$lote="";$fcaducidad="";$marca="";$color="";$serie="";
$Descripcion="";$noticket="";
include "../conexion/conexion.php";

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
$mensajetit="";

$fechah=date("d/m/Y");
$fecha=substr($fechah,3,2).'/'.substr($fechah,0,2).'/'.substr($fechah,6,4);


?>	

	<div class="widget-head">
		<ul>
			<li class="active"><a href="#pestana1" data-toggle="tab" class="glyphicons home"><i></i>Información Detallada</a></li>
			
			<!-- pestañas
			<li><a href="#pestana2" data-toggle="tab" class="glyphicons picture"><i></i>Pestaña2</a></li>
			<li><a href="#pestana3" data-toggle="tab" class="glyphicons adjust_alt"><i></i>Pestaña 3</a></li>
			<li><a href="#pestana4" data-toggle="tab" class="glyphicons table"><i></i>Pestaña 4</a></li>
			<li><a href="#pestana5" data-toggle="tab" class="glyphicons podium"><i></i>Pestaña 5</a></li>
			-->
		</ul>
	</div>
	<div class="widget-body large">
		<div class="tab-content">		
			<!-- Description -->
			<div class="tab-pane active" id="pestana1">
				

				<form class="form-horizontal" style="padding-top: 10px; margin-bottom: 0;" id="validaempresa" method="post" action="" autocomplete="off" />	
					<div class="row-fluid">
					<div class="span8">
						<div class="well" style="padding-bottom: 10px;">
							<h4>Datos de la Devolución <?php echo $mensajetit;?></h4>

							<hr class="separator" />
							<div class="row-fluid">
							<div class="span6">
								<div id="descripciones">
									<div class="control-group">
										<label class="control-label" for="nombre">No.Ticket:</label>
										<div class="controls">
											<input class="span12" id="noticket" name="noticket" type="text" maxlength="10" value="<?php echo $noticket;?>"/> 	
											<a href="#" onclick="btnbuscar();" class="glyphicons search btn" data-placement="bottom"><i></i><span>Buscar</span></a>
											<a href="#" onclick="btnlimpiar();" class="glyphicons refresh btn" data-placement="bottom"><i></i><span>Limpiar</span></a>

									    </div>
									</div>

									<div class="control-group">
										<label class="control-label" for="nombre">Codigo:</label>
										<div class="controls">
											<input class="span12" id="codigo" <?php if ($opcion=1) {echo "disabled";}?> name="codigo" type="text" maxlength="100" value="<?php echo $codigo;?>"/> 	
									    </div>
									</div>





									<div class="control-group">
										<label class="control-label" for="nombre">Descripcion:</label>
	<div class="controls"><input class="span12" id="descrip" <?php if ($opcion=1) {echo "disabled";}?> name="descrip" type="text" maxlength="100" value="<?php echo $Descripcion;?>"/></div>
									</div>



									


								</div>
    								
									
									

										

							</div>
							<div class="span6">
								<div class="control-group">
								</div>
								<div class="control-group">
								</div>
								<div class="control-group">
								</div>

								<div class="control-group">
								</div>
								
	
								
								
							</div>
							</div>
							<div class="form-actions">
								<?php
								$nombreboton="Guardar";
								switch ($opcion) {
									case 1: $nombreboton="Guardar";break;
									case 2: $nombreboton="Modificar";break;
									case 3: $nombreboton="Elimimar";break;
								}
								?>
								<button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?php echo $nombreboton;?></button>
								<button type="button" onclick="cancelar();" class="btn btn-icon btn-default glyphicons circle_remove"><i></i>Cancelar</button>
								<input name="id" id="id" type="hidden" value="<?php echo $id;?>" />
								<input name="opcion" id="opcion" type="hidden" value="<?php echo $opcion;?>" />
								<input name="codigo" id="codigo" type="hidden" value="<?php echo $codigo;?>" />
								<!--<input name="modelo" id="modelo" type="hidden" value="<?php echo $modelo;?>" />-->
								<input name="talla" id="talla" type="hidden" value="<?php echo $talla;?>" />
								<input name="lote" id="lote" type="hidden" value="<?php echo $lote;?>" />
								<!-- <input name="dateRangeTo" id="dateRangeTo" type="hidden" value="<?php echo $dateRangeTo;?>" /> -->

							</div>
						</div>
					</div>
					<div class="span4">
						<!-- espacio 2da columna -->

					</div>
					</div>




















				</form>






			</div>
			<!-- pestañas
			
			
			<div class="tab-pane" id="pestana2">
			
			</div>
			
			<div class="tab-pane" id="pestana3">
			
			</div>
			
			<div class="tab-pane" id="pestana4">
			
			</div>			
			<div class="tab-pane" id="pestana5">
			
			</div>
			 -->
			
		</div>
	</div>
