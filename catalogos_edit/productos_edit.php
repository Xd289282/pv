<?php
if (!isset($_SESSION["pvtacommand_ingsisv"])){
  echo"<SCRIPT>window.location='../index.php';</SCRIPT>";   
}
$idunicoe=$_SESSION["pvtacommand_idunicoe"];// id unico de la empresa del usuario

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
$codigo="";$nombrep="";$descrip="";$ultpcompra=0;$pmostrador=0;$stock=0;$iva=16;$descuento=0;$marca="";$color="";$serie="";$tipo=0;$modelo="";
$talla1=0;$talla2=0;$modelo="";
include "../conexion/conexion.php";
$idunicoe=$_SESSION["pvtacommand_idunicoe"];// id unico de la empresa

if($opcion==2 || $opcion==3){ // mostrar valores
	$consulta="select * from productos where idunicop='$id' and idunicoe='$idunicoe'";
	$recordset = mysqli_query($link,$consulta);
	while($registro = mysqli_fetch_array($recordset)){
		$codigo=$registro["codigo"];
		$nombrep=utf8_encode($registro["nombrep"]);		
		$descrip=utf8_encode($registro["descrip"]);
		$ultpcompra=$registro["ultpcompra"];
		$pmostrador=$registro["pmostrador"];
		$stock=$registro["stock"];
		$iva=$registro["iva"];
		$descuento=$registro["descuento"];
		$marca=$registro["marca"];
		$color=$registro["color"];
		$serie=$registro["serie"];
		$tipo=$registro["tipo"];
		$cvetip=$registro["cvetip"];		
	}
	
	$consulta="select min(talla) as talla1,max(talla) as talla2 from inventario where idunicop='$id' and idunicoe='$idunicoe'";
	$recordset = mysqli_query($link,$consulta);
	while($registro = mysqli_fetch_array($recordset)){
		$talla1=$registro["talla1"];
		$talla2=$registro["talla2"];
	}
	$consulta="select modelo from inventario where idunicop='$id' and idunicoe='$idunicoe'";
	$recordset = mysqli_query($link,$consulta);
	while($registro = mysqli_fetch_array($recordset)){$modelo=$registro["modelo"];}
}
$mensajetit="";
$serie='';
if($opcion==2){$mensajetit=" a Modificar";}
if($opcion==3){$mensajetit=" a Eliminar";}
//verificar si se solicita la marca 
$mostrarmarca=0;$mostrarserie=0;$talla=0;
$consulta="select marca,serie,talla from configuraciones where idunicoe='$idunicoe' ";
$recordset = mysqli_query($link,$consulta);
while($registro = mysqli_fetch_array($recordset)){$mostrarmarca=$registro["marca"];$mostrarserie=$registro["serie"];$talla=$registro["talla"];}

?>	

	<div class="widget-head">
		<ul>
			<li class="active"><a href="#pestana1" data-toggle="tab" class="glyphicons home"><i></i>Datos Generales</a></li>
			<?php
			if($opcion<>1){
			?>
			<li><a href="#pestana2" data-toggle="tab" class="glyphicons folder_new"><i></i>Agrupadores</a></li>
			<?php
			}
			?>
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
							<h4>Datos del Producto <?php echo $mensajetit;?></h4>
							<hr class="separator" />
							<div class="row-fluid">
							<div class="span6">								
								<div class="control-group">
									<label class="control-label" for="nombre">Codigo:</label>
									<div class="controls"><input class="span12" id="codigo" name="codigo" type="text" maxlength="100" value="<?php echo $codigo;?>"  /></div>
								</div>
								<div class="control-group">
									<label class="control-label" for="calle">Descripción:</label>
									<div class="controls"><input class="span12" id="nombrep" name="nombrep" type="text" maxlength="30" value="<?php echo $nombrep;?>" /></div>
								</div>
                                <div class="control-group">
									<label class="control-label" for="colonia">Tipo:</label>
									<div class="controls">
										<select class="selectpicker span6" data-style="btn-success" id="cvetip" name="cvetip">
											<?php
											
												$consulta="select a.cvetip,a.descripcion from tipoprod as a ;";	
												$recordset = mysqli_query($link,$consulta);
												while($registro = mysqli_fetch_array($recordset)){
													$cvetip=$registro["cvetip"];
													$descripcion=$registro["descripcion"];
													
													echo'<option value="'.$cvetip.'"/>'.$descripcion;
												}


											?>										
										</select>

									</div>
								</div>											
<!-- 
								<div class="control-group">
									<label class="control-label" for="colonia">Iva:</label>
									<div class="controls"><input class="span12" id="iva" name="iva" type="text" maxlength="30" value="<?php echo $iva;?>"/></div>
								</div> -->

								<div class="control-group">
									<label class="control-label" for="colonia">% Descuento:</label>
									<div class="controls"><input class="span12" id="descuento" name="descuento" type="text" maxlength="30" value="<?php echo $descuento;?>"/></div>
								</div>


								<!-- <div class="control-group">
									<label class="control-label" for="telefono">Tipo:</label>
									<div class="controls">
										<input type="radio" rel="radiotipo" class="radio" name="radiotipo" id="radiotipo" value="0" <?php if($tipo==0){ echo 'checked="checked"';} if($opcion==2 || $opcion==3){ echo 'disabled';}?> /> Producto
										<input type="radio" rel="radiotipo" class="radio" name="radiotipo" id="radiotipo" value="1" <?php if($tipo==1){ echo 'checked="checked"';} if($opcion==2 || $opcion==3){ echo 'disabled';}?>/> Servicio
										
									</div>
								</div> -->
							</div>
							<div class="span6">


								<?php
								if($mostrarmarca==1){
								?>

								<div class="control-group">
									<label class="control-label" for="municipio">Marca:</label>
									<div class="controls"><input class="span12" id="marca" name="marca" type="text" maxlength="30" value="<?php echo $marca;?>" /></div>
								</div>
								<div class="control-group">
										<label class="control-label" for="nombre">Modelo:</label>
									<div class="controls"><input class="span12" id="modelo" name="modelo" type="text" maxlength="30" value="<?php echo $modelo;?>"/></div>
									</div>	
								<?php
								}
								?>
								<div class="control-group">
									<label class="control-label" for="colonia">Color:</label>
									<div class="controls"><input class="span12" id="color" name="color" type="text" maxlength="30" value="<?php echo $color;?>"/></div>
								</div>
								<?php
								if ($mostrarserie==1){	
								?>
									<div class="control-group">
										<label class="control-label" for="nombre">Serie:</label>
									<div class="controls"><input class="span12" id="serie" name="serie" type="text" maxlength="30" value="<?php echo $serie;?>"/></div>
									</div>	
								<?php
								}  
								if($talla==1){
								?>
								<div class="control-group">
									<label class="control-label" for="nombre">Corrida:</label>
									<div class="controls">
										Inicial:
										<input class="span3" type="number" id="talla1" name="talla1" min="1" max="50" value="<?php echo $talla1;?>">
										Final:
										<input class="span3" type="number" id="talla2" name="talla2" min="1" max="50" value="<?php echo $talla2;?>">
										
									</div>
								</div>

								<div class="control-group">
									<label class="control-label" for="rfc">Stock:</label>
									<div class="controls"><input class="span12" id="stock" name="stock" type="text" maxlength="30" value="<?php echo $stock;?>" /></div>
								</div>

								<div class="control-group">
									<label class="control-label" for="estado">Precio Compra:</label>
									<div class="controls"><input class="span12" id="ultpcompra" name="ultpcompra" onkeyup="calculaprecio(this.value)" type="text" maxlength="30" value="<?php echo $ultpcompra;?>" /></div>
								</div>
								<div class="control-group">
									<label class="control-label" for="telefono">Precio Venta:</label>
									<div class="controls"><input class="span12" id="pmostrador" name="pmostrador" type="text" maxlength="10" value="<?php echo $pmostrador;?>" /></div>
								</div>


                                <div class="control-group">
									<label class="control-label" for="colonia">Proveedor:</label>
									<div class="controls">
										<select class="selectpicker span6" data-style="btn-success" id="proveedor" name="proveedor">
											<?php
											
												$consulta="select a.idunicopr,a.nombre from proveedores as a where a.idunicoe='$idunicoe';";	
												$recordset = mysqli_query($link,$consulta);
												while($registro = mysqli_fetch_array($recordset)){
													$idunicopr=$registro["idunicopr"];
													$nombre=$registro["nombre"];
													
													echo'<option value="'.$idunicopr.'"/>'.$nombre;
												}


											?>										
										</select>

									</div>
								</div>								




								<?php
								}
								?>





							</div>
							</div>
							<div class="form-actions">
								<?php
								$nombreboton="Guardar";
								switch ($opcion) {
									case 1: $nombreboton="Guardar";break;
									case 2: $nombreboton="Modificar";break;
									case 3: $nombreboton="Eliminar";break;
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
			<?php
			if($opcion<>1){
			?>
			<div class="tab-pane" id="pestana2">
				

				<form class="form-horizontal" style="padding-top: 10px; margin-bottom: 0;" id="validaempresa" method="post" action="" autocomplete="off" />	
					<div class="row-fluid">
					<div class="span8">
						<div class="well" style="padding-bottom: 10px;">
							<h4>Agrupadores del Producto</h4>
							<hr class="separator" />
							<div class="row-fluid">
							<div class="span6">								
								<div class="control-group">
									<?php
									$consulta="select * from catagrupadores where idunicoe='$idunicoe' order by agrupador";
									$recordset = mysqli_query($link,$consulta);
									while($registro = mysqli_fetch_array($recordset)){			
										
										$idunicoa=$registro["idunicoa"];
										$agrupador=$registro["agrupador"];
										//verificar si el producto ya tiene seleccionado este agrupador
										$marcado=0;
										$consulta="select count(*) as marcado from detprodagrup where idunicoe='$idunicoe' and idunicop='$id' and idunicoa='$idunicoa'";
										$recordset2 = mysqli_query($link,$consulta);
										while($registro2 = mysqli_fetch_array($recordset2)){				
											$marcado=$registro2["marcado"];
										}
										$checked="";
										if($marcado>0){
											$checked="checked";
										}

										echo'<label class="checkbox">';
											echo'<input type="checkbox" class="checkbox" onclick="guardaagrup('.$idunicoa.','.$id.');"  value="'.$idunicoa.'" '.$checked.' />';
											echo $agrupador;
										echo'</label>';

									}
									?>
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




			</div><!-- fin del div de pestaña 2-->
			<?php
			}
			?>
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