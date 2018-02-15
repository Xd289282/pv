<?php
	if (!isset($_SESSION["pvtacommand_ingsisv"])){
	  echo"<SCRIPT>window.location='../index.php';</SCRIPT>";   
	}	
	
	include "../estructura/parametros.php";
	include "../conexion/conexion.php";
	$idunicoe=$_SESSION["pvtacommand_idunicoe"]; // id unico de la empresa
?>
<div class="widget-head">
	<h4 class="heading glyphicons list"><i></i>Administración de Proveedores</h4>
</div>
<div class="widget-body">
	
	
	
	<table id="example" class="display table table-bordered table-condensed table-striped table-primary table-vertical-center checkboxs js-table-sortable" cellspacing="0" width="100%">
		<thead>
			<tr>				
				<th width="1%" class="center">No.</th>
				<th>Proveedor</th>
				<th class="center" width="60">Acciones</th>
			</tr>
		</thead>

		<tbody>
			<?php
			$idregistro=$_SESSION["pvtacommand_idregistro"];// id del registro del usuario creador de empresas
			//$consulta="select *  from empresa order by idunicoe";
			$consulta="select * from proveedores as b where b.idunicoe='$idunicoe' order by b.idunicopr";	
			//echo $consulta;
			$recordset = mysqli_query($link,$consulta);
			while($registro = mysqli_fetch_array($recordset)){
				
				$idunicopr=$registro["idunicopr"];
				$nombre=utf8_encode($registro["nombre"]);
			

			
				echo'<tr class="selectable">';
					echo'<td class="center">'.$idunicopr.'</td>';
					echo'<td><strong>'.$nombre.'</strong></td>';
					echo'
						<td class="center">
							<a href="#" onClick="acciones(2,'.$idunicopr.');" title="modificar" class="btn-action glyphicons pencil btn-success"><i></i></a>
							<a href="#" onClick="acciones(3,'.$idunicopr.');" title="eliminar" class="btn-action glyphicons remove_2 btn-danger"><i></i></a>
						</td>';
				echo'</tr>';
				
			}    	
			?>

			
				

		</tbody>
	</table>





	
</div>