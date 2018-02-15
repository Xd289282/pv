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

$descripcion="";$cvetip="";
include "../conexion/conexion.php";
if($opcion==2 || $opcion==3){ // mostrar valores
	$consulta="select * from tipoprod where cvetip='$id'";
	$recordset = mysqli_query($link,$consulta);
	while($registro = mysqli_fetch_array($recordset)){
		$cvetip=$registro["cvetip"];
		$descripcion=utf8_encode($registro["descripcion"]);

	}

}
$mensajetit="";
if($opcion==2){$mensajetit=" a Modificar";}
if($opcion==3){$mensajetit=" a Eliminar";}
?>	

	<div class="widget-head">
		<ul>
			<li class="active"><a href="#pestana1" data-toggle="tab" class="glyphicons home"><i></i>Datos Generales</a></li>
			
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
				

				<form class="form-horizontal" style="padding-top: 10px; margin-bottom: 0;" id="validaproveedores" method="post" action="" autocomplete="off" />	
					<div class="row-fluid">
					<div class="span8">
						<div class="well" style="padding-bottom: 10px;">
							<h4>Datos del Tipo de Producto <?php echo $mensajetit;?></h4>
							<hr class="separator" />
							<div class="row-fluid">
							<div class="span6">
								
								<div class="control-group">
									<label class="control-label" for="nombre">Clave del Tipo:</label>
									<div class="controls"><input class="span12" id="cvetip" name="cvetip" type="text" maxlength="12" value="<?php echo $cvetip;?>"  /></div>
								</div>
								<div class="control-group">
									<label class="control-label" for="nombre">Descripcion:</label>
									<div class="controls"><input class="span12" id="descripcion" name="descripcion" type="text" maxlength="12" value="<?php echo $descripcion;?>"  /></div>
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
			
			
			
			
			<div class="tab-pane" id="pestana3">
			
			</div>
			
			<div class="tab-pane" id="pestana4">
			
			</div>			
			<div class="tab-pane" id="pestana5">
			
			</div>
			 -->
			
		</div>
	</div>