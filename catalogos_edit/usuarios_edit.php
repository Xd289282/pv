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
$login="";$password="";$nombre="";$tipo=0;$idunicos=0;
include "../conexion/conexion.php";
if($opcion==2 || $opcion==3){ // mostrar valores
	$consulta="select * from catusuarios where idunicou='$id'";
	$recordset = mysqli_query($link,$consulta);
	while($registro = mysqli_fetch_array($recordset)){
		$login=$registro["login"];
		$password=$registro["password"];
		$nombre=utf8_encode($registro["nombre"]);
		$tipo=$registro["tipo"];
		$idunicos=$registro["idunicos"];		
	}
}
$mensajetit="";
if($opcion==2){$mensajetit=" a Modificar";}
if($opcion==3){$mensajetit=" a Eliminar";}

$idregistro=$_SESSION["pvtacommand_idregistro"];// id del registro del usuario creador de empresas
$idunicoe=$_SESSION["pvtacommand_idunicoe"];// id unico de la empresa del usuario
$idunicos=$_SESSION["pvtacommand_idunicos"];// id unico de la empresa del usuario


?>	

	<div class="widget-head">
		<ul>
			<li class="active"><a href="#pestana1" data-toggle="tab" class="glyphicons home"><i></i>Datos Generales</a></li>
			
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
							<h4>Datos del Usuario <?php echo $mensajetit;?></h4>
							<hr class="separator" />
							<div class="row-fluid">
							<div class="span6">
								<div class="control-group">
									<label class="control-label" for="nombre">Login:</label>
									<div class="controls"><input class="span12" id="login" name="login" type="text" maxlength="10" value="<?php echo $login;?>"  /></div>
								</div>
								<div class="control-group">
									<label class="control-label" for="calle">Password:</label>
									<div class="controls"><input class="span12" id="password" name="password" type="text" maxlength="10" value="<?php echo $password;?>" /></div>
								</div>		
								<div class="control-group">
									<label class="control-label" for="rfc">Nombre:</label>
									<div class="controls"><input class="span12" id="nombre" name="nombre" type="text" maxlength="50" value="<?php echo $nombre;?>" /></div>
								</div>						
							</div>
							<div class="span6">
								
								<div class="control-group">
									<label class="control-label" for="colonia">Tipo:</label>
									<div class="controls">
										
										<input type="radio" rel="radiotipo" class="radio" name="radiotipo" id="radiotipo" value="0" <?php if($tipo==0){ echo 'checked="checked"';}?> /> Usuario
										<input type="radio" rel="radiotipo" class="radio" name="radiotipo" id="radiotipo" value="1" <?php if($tipo==1){ echo 'checked="checked"';}?>/> Supervisor
										<input type="radio" rel="radiotipo" class="radio" name="radiotipo" id="radiotipo" value="2" <?php if($tipo==2){ echo 'checked="checked"';}?> /> Administrador

									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="colonia">Sucursal:</label>
									<div class="controls">
										<select class="selectpicker span6" data-style="btn-success" id="sucursal" name="sucursal">
											<?php
											
											if($idunicos>0){
												//$consulta="select idunicos,nombre from sucursal where idunicos='$idunicos'";
												$consulta="select a.idunicos,a.nombre from sucursal as a where a.idunicos='$idunicos';";	
												$recordset = mysqli_query($link,$consulta);
												while($registro = mysqli_fetch_array($recordset)){
													$idunicos=$registro["idunicos"];
													$nombre=$registro["nombre"];
													
													echo'<option value="'.$idunicos.'"/>'.$nombre;
												}
											}else{

													$consulta="select a.idunicos,a.nombre from sucursal as a left join empresa as b on a.idunicoe=b.idunicoe left join registro as c on b.idregistro=c.idregistro 
		where c.idregistro='$idregistro'; ";	
													$recordset = mysqli_query($link,$consulta);
													while($registro = mysqli_fetch_array($recordset)){
														$idunicos=$registro["idunicos"];
														$nombre=$registro["nombre"];
														
														echo'<option value="'.$idunicos.'"/>'.$nombre;
													}
										    }
											//echo'<option value="'.$idunicos.'"/>'.$consulta;
											?>										
										</select>

									</div>
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