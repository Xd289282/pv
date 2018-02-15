<?php
	if (!isset($_SESSION["pvtacommand_ingsisv"])){
	  echo"<SCRIPT>window.location='../index.php';</SCRIPT>";   
	}	
	
	include "../estructura/parametros.php";
	include "../conexion/conexion.php";
?>
<div class="widget-head">
	<h4 class="heading glyphicons list"><i></i>Administración de Usuarios</h4>
</div>
<div class="widget-body">
	
	
	
	<table id="example" class="display table table-bordered table-condensed table-striped table-primary table-vertical-center checkboxs js-table-sortable" cellspacing="0" width="100%">
		<thead>
			<tr>				
				<th>Nombre</th>
				<th>Login</th>
				<th>Tipo</th>
				<th>Sucursal</th>
				<th class="center" width="60">Acciones</th>
			</tr>
		</thead>

		<tbody>
			<?php
			$idregistro=$_SESSION["pvtacommand_idregistro"];// id del registro del usuario creador de empresas
			$idunicoe=$_SESSION["pvtacommand_idunicoe"];// id unico de la empresa del usuario
			//$consulta="select *  from catusuarios where idunicoe='$idunicoe' order by login";
			if ($idregistro<>0){
				$consulta="select a.idunicou,a.login,a.nombre,a.tipo,a.idunicos from catusuarios as a left join empresa as b on a.idunicoe=b.idunicoe left join registro as c on b.idregistro=c.idregistro where c.idregistro='$idregistro' order by a.idunicoe";

			}else{
			$consulta="select a.idunicou,a.login,a.nombre,a.tipo,a.idunicos from catusuarios as a left join empresa as b on a.idunicoe=b.idunicoe where b.idunicoe='$idunicoe' order by a.idunicoe";
			}	
			
			$recordset = mysqli_query($link,$consulta);
			while($registro = mysqli_fetch_array($recordset)){
							
				$idunicou=$registro["idunicou"];
				$login=$registro["login"];
				$nombre=utf8_encode($registro["nombre"]);				
				$tipo=$registro["tipo"];
				$idunicos=$registro["idunicos"];	
				$sucursal="";			
				switch ($tipo) {
					case 0:$tipo="Usuario";break;
					case 1:$tipo="Supervisor";break;
					case 2:$tipo="Administrador";break;
					default:$tipo="";break;
				}	
				$consulta="select nombre from sucursal where idunicos='$idunicos'";
				$recordset2 = mysqli_query($link,$consulta);
				while($registro2 = mysqli_fetch_array($recordset2)){
					$sucursal=$registro2["nombre"];
				}

				
				echo'<tr class="selectable">';					
					echo'<td><strong>'.$nombre.'</strong></td>';
					echo'<td>'.$login.'</td>';
					echo'<td>'.$tipo.'</td>';
					echo'<td><strong>'.$sucursal.'</strong></td>';
					echo'
						<td class="center">
							<a href="#" onClick="acciones(2,'.$idunicou.');" title="modificar" class="btn-action glyphicons pencil btn-success"><i></i></a>
							<a href="#" onClick="acciones(3,'.$idunicou.');" title="eliminar" class="btn-action glyphicons remove_2 btn-danger"><i></i></a>
						</td>';
				echo'</tr>';
				
			}    	
			?>

			
				

		</tbody>
	</table>





	
</div>