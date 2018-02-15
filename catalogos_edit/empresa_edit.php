<?php
if (!isset($_SESSION["pvtacommand_ingsisv"])){
  echo"<SCRIPT>window.location='../index.php';</SCRIPT>";   
}

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
$serie=0;

$nombre="";$rfc="";$calle="";$colonia="";$estado="";$municipio="";$telefono="";
$serie=0;$marca=0;$modelo=0;$talla=0;$lote=0;$fcaducidad=0;
include "../conexion/conexion.php";
if($opcion==2 || $opcion==3){ // mostrar valores
	$consulta="select * from empresa where idunicoe='$id'";
	$recordset = mysqli_query($link,$consulta);
	while($registro = mysqli_fetch_array($recordset)){
		$nombre=utf8_encode($registro["nombre"]);
		$rfc=$registro["rfc"];
		$calle=utf8_encode($registro["calle"]);
		$colonia=utf8_encode($registro["colonia"]);
		$estado=utf8_encode($registro["estado"]);
		$municipio=utf8_encode($registro["municipio"]);	
		$telefono=$registro["telefono"];

	}
	$consulta="select * from configuraciones where idunicoe='$id'";
	$recordset = mysqli_query($link,$consulta);
	while($registro = mysqli_fetch_array($recordset)){		
		$serie=$registro["serie"];
		$marca=$registro["marca"];
		$modelo=$registro["modelo"];
		$talla=$registro["talla"];
		$lote=$registro["lote"];
		$fcaducidad=$registro["fcaducidad"];
	}
}
$mensajetit="";
if($opcion==2){$mensajetit=" a Modificar";}
if($opcion==3){$mensajetit=" a Eliminar";}
?>	

	<div class="widget-head">
		<ul>
			<li class="active"><a href="#pestana1" data-toggle="tab" class="glyphicons home"><i></i>Datos Generales</a></li>
			<li><a href="#pestana2" data-toggle="tab" class="glyphicons settings"><i></i>Configuración</a></li>
			<!-- pestañas
			
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
							<h4>Datos de la Empresa <?php echo $mensajetit;?></h4>
							<hr class="separator" />
							<div class="row-fluid">
							<div class="span6">
								
								<div class="control-group">
									<label class="control-label" for="nombre">Nombre:</label>
									<div class="controls"><input class="span12" id="nombre" name="nombre" type="text" maxlength="100" value="<?php echo $nombre;?>"  /></div>
								</div>
								<div class="control-group">
									<label class="control-label" for="calle">Calle:</label>
									<div class="controls"><input class="span12" id="calle" name="calle" type="text" maxlength="30" value="<?php echo $calle;?>" /></div>
								</div>
								<div class="control-group">
									<label class="control-label" for="estado">Estado:</label>
									<div class="controls"><input class="span12" id="estado" name="estado" type="text" maxlength="30" value="<?php echo $estado;?>" /></div>
								</div>
								<div class="control-group">
									<label class="control-label" for="telefono">Telefono:</label>
									<div class="controls"><input class="span12" id="telefono" name="telefono" type="text" maxlength="10" value="<?php echo $telefono;?>" /></div>
								</div>
							</div>
							<div class="span6">
								<div class="control-group">
									<label class="control-label" for="rfc">RFC:</label>
									<div class="controls"><input class="span12" id="rfc" name="rfc" type="text" maxlength="30" value="<?php echo $rfc;?>" /></div>
								</div>
								<div class="control-group">
									<label class="control-label" for="colonia">Colonia:</label>
									<div class="controls"><input class="span12" id="colonia" name="colonia" type="text" maxlength="30" value="<?php echo $colonia;?>"/></div>
								</div>
								<div class="control-group">
									<label class="control-label" for="municipio">Municipio:</label>
									<div class="controls"><input class="span12" id="municipio" name="municipio" type="text" maxlength="30" value="<?php echo $municipio;?>" /></div>
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
								<input name="opcion" id="opcion" type="hidden" value="<?php echo $opcion;?>" />

							</div>
						</div>
					</div>
					<div class="span4">
						<!-- espacio 2da columna -->

					</div>
					</div>
				</form>
			</div>




			<div class="tab-pane" id="pestana2">
				<form class="form-horizontal" style="padding-top: 10px; margin-bottom: 0;" id="validaempresa" method="post" action="" autocomplete="off" />	
					<div class="row-fluid">
					<div class="span8">
						<div class="well" style="padding-bottom: 10px;">
							<h4>Controles de la Empresa</h4>
							<hr class="separator" />
							<div class="row-fluid">
							<div class="span6">
								<div class="control-group">
									<label class="control-label" for="nombre">Serie:</label>
									<div class="controls">
										<div class="toggle-button" data-togglebutton-style-enabled="success">
											<input type="checkbox" name="serie" id="serie" <?php if($serie==1){echo "checked";}?> <?php if($opcion<>1){echo "disabled";}?>  />
										</div>
									</div>
								</div>


								<div class="control-group">
									<label class="control-label" for="nombre">Marca:</label>
									<div class="controls">
										<div class="toggle-button" data-togglebutton-style-enabled="success">
											<input type="checkbox" name="marca" id="marca" <?php if($marca==1){echo "checked";}?>  <?php if($opcion<>1){echo "disabled";}?> />
										</div>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="nombre">Modelo:</label>
									<div class="controls">
										<div class="toggle-button" data-togglebutton-style-enabled="success">
											<input type="checkbox" name="modelo" id="modelo" <?php if($modelo==1){echo "checked";}?> <?php if($opcion<>1){echo "disabled";}?> />
										</div>
									</div>
								</div>								
							</div>
							<div class="span6">
								<div class="control-group">
									<label class="control-label" for="nombre">Talla:</label>
									<div class="controls">
										<div class="toggle-button" data-togglebutton-style-enabled="success">
											<input type="checkbox" name="talla" id="talla" <?php if($talla==1){echo "checked";}?> <?php if($opcion<>1){echo "disabled";}?> />
										</div>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="nombre">Lote:</label>
									<div class="controls">
										<div class="toggle-button" data-togglebutton-style-enabled="success">
											<input type="checkbox" name="lote" id="lote" <?php if($lote==1){echo "checked";}?> <?php if($opcion<>1){echo "disabled";}?> />
										</div>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="nombre">Fecha Caducidad:</label>
									<div class="controls">
										<div class="toggle-button" data-togglebutton-style-enabled="success">
											<input type="checkbox" name="fcaducidad" id="fcaducidad" <?php if($fcaducidad==1){echo "checked";}?> <?php if($opcion<>1){echo "disabled";}?> />
										</div>
									</div>
								</div>
							</div>
							</div>
							<div class="form-actions">
								

							</div>
						</div>
					</div>
					<div class="span4">
						<!-- espacio 2da columna -->

					</div>
					</div>
				</form>

			</div> <!-- fin de pestaña 2
			<!-- pestañas
			
			
			
			
			<div class="tab-pane" id="pestana3">
			
			</div>
			
			<div class="tab-pane" id="pestana4">
			
			</div>			
			<div class="tab-pane" id="pestana5">
			
			</div>
			 -->
			
		</div>
	</div>