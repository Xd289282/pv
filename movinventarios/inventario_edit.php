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
$idunicos=$_SESSION["pvtacommand_idunicos"];// id unico de la sucursal
$codigo="";$cantidad="";$pcompra="";$folio="";$pmostrador="";$modelo="";$talla="";$lote="";$fcaducidad="";$marca="";$color="";$serie="";
$Descripcion="";
include "../conexion/conexion.php";

if($opcion==2 || $opcion==3){ // mostrar valores
	//$consulta="select * from inventario where inventario.idunicoregi='$id'";
	$consulta="select b.codigo,nombrep,a.cantidad,a.modelo,a.talla,a.lote,a.fcaducidad,b.pmostrador,b.marca,b.color from inventario as a left join productos as b on a.idunicop=b.idunicop and a.idunicoe=b.idunicoe where a.idunicoregi='$id' and a.idunicoe='$idunicoe' and a.idunicos='$idunicos' and a.tipo='0'";
	$recordset = mysqli_query($link,$consulta);
	while($registro = mysqli_fetch_array($recordset)){
		$codigo=$registro["codigo"];	
		$Descripcion=$registro["nombrep"];
		$cantidad=$registro["cantidad"];	
		$modelo=$registro["modelo"];	
	    $talla=$registro["talla"];			
	    $lote=$registro["lote"];
	    $marca=$registro["marca"];
	    $color=$registro["color"];	
	    $fcaducidad=$registro["fcaducidad"];	
	    $pmostrador=$registro["pmostrador"];
	}
}
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
if($opcion==2){$mensajetit=" a Modificar";}
if($opcion==3){$mensajetit=" a Eliminar";}

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
							<h4>Datos de Inventario <?php echo $mensajetit;?></h4>
							<hr class="separator" />
							<div class="row-fluid">
							<div class="span6">
								<div id="descripciones">
									<div class="control-group">
										<label class="control-label" for="nombre">Codigo:</label>
										<div class="controls">
											<input class="span12" id="codigo" name="codigo" type="text" maxlength="100" value="<?php echo $codigo;?>"/> <?php	
											if ($opcion==1)
											{?>
											<a href="#" onclick="btnbuscar();" class="glyphicons search btn" data-placement="bottom"><i></i><span>Buscar</span></a>
											<a href="#" onclick="btnlimpiar();" class="glyphicons refresh btn" data-placement="bottom"><i></i><span>Limpiar</span></a>

											<?php
											}?>

									    </div>
									</div>
									<div class="control-group">
										<label class="control-label" for="nombre">Descripcion:</label>
										<div class="controls"><input class="span12" id="descrip" name="descrip" type="text" maxlength="100" value="<?php echo $Descripcion;?>"  /></div>
									</div>


									<?php
									if ($mostrarmarca==1){	
									?>
										<div class="control-group">
											<label class="control-label" for="nombre">Marca:</label>
											<div class="controls"><input class="span12" id="marca" name="marca" type="text" maxlength="50" value=" <?php echo $marca;?>"  /></div>
										</div>
									<?php
									}  
									
									if ($mostrarmodelo==1){	
									?>
										<div class="control-group">
											<label class="control-label" for="nombre">Modelo:</label>
											<div class="controls"><input class="span12" id="modelo" name="modelo" type="text" maxlength="50" value=" <?php echo $modelo;?>"  /></div>
										</div>
									<?php
									}  
									?>

									<div class="control-group">
											<label class="control-label" for="nombre">Color:</label>
											<div class="controls"><input class="span12" id="color" name="color" type="text" maxlength="50" value=" <?php echo $color;?>"  /></div>
										</div>

									<?php
									if ($mostrartalla==1){	
									?>
										<div class="control-group">
											<label class="control-label" for="nombre">Talla:</label>
											<div class="controls"><input class="span12" id="talla" name="talla" type="text" maxlength="50" value="<?php echo $talla;?>"  /></div>
										</div>	
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
		   							                <input type="text"  id="datepicker2" class="span12" value="<?php echo $fecha;?>" />
													<span class="add-on glyphicons calendar"><i></i></span>
									          </div>
									   		 </div>


		   							          
										</div>			
									<?php
									}	
									?>		

									<div class="control-group">
										<label class="control-label" for="nombre">Precio Mostrador:</label>
										<div class="controls"><input class="span12" id="preciom" name="preciom" type="text" maxlength="10" value="<?php echo $pmostrador;?>"  /></div>
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
								<div class="control-group">
									<label class="control-label" for="nombre">Cantidad:</label>
									<div class="controls"><input class="span12" id="cantidad" name="cantidad" type="text" maxlength="10" value="<?php echo $cantidad;?>"  /></div>
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
<!-- 								<input name="dateRangeTo" id="dateRangeTo" type="hidden" value="<?php echo $dateRangeTo;?>" />
 -->							
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