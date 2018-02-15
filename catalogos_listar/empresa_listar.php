<?php
	if (!isset($_SESSION["pvtacommand_ingsisv"])){
	  echo"<SCRIPT>window.location='../index.php';</SCRIPT>";   
	}	
	
	include "../estructura/parametros.php";
	include "../conexion/conexion.php";
?>
<div class="widget-head">
	<h4 class="heading glyphicons list"><i></i>Administración de Empresas</h4>
</div>
<div class="widget-body">
	
	
	
	<table id="example" class="display table table-bordered table-condensed table-striped table-primary table-vertical-center checkboxs js-table-sortable" cellspacing="0" width="100%">
		<thead>
			<tr>				
				<th width="1%" class="center">No.</th>
				<th>Empresa</th>
				<th>RFC</th>
				<th>Status</th>
				<th>Fecha Alta</th>
				<th class="center" width="60">Acciones</th>
			</tr>
		</thead>

		<tbody>
			<?php
			$idregistro=$_SESSION["pvtacommand_idregistro"];// id del registro del usuario creador de empresas
			//$consulta="select *  from empresa order by idunicoe";
			$consulta="select * from empresa as b where b.idregistro='$idregistro' order by b.idunicoe";	
			$recordset = mysqli_query($link,$consulta);
			while($registro = mysqli_fetch_array($recordset)){
				
				$idunicoe=$registro["idunicoe"];
				$nombre=utf8_encode($registro["nombre"]);
				$rfc=$registro["rfc"];
				$status=$registro["status"];
				$fechaalta=$registro["fechaalta"];				
				$fechaalta=substr($fechaalta, 8,2).'/'.substr($fechaalta, 5,2).'/'.substr($fechaalta,0,4);

				

				switch ($status) {//0=prueba 1=activo 2=suspendida 3=baja
					case 0: $status="Prueba";break;
					case 1: $status="Activo";break;
					case 2: $status="Suspendida";break;
					case 3: $status="Baja";break;
					default:$status="Suspendida";break;
				}
				
				echo'<tr class="selectable">';
					echo'<td class="center">'.$idunicoe.'</td>';
					echo'<td><strong>'.$nombre.'</strong></td>';
					echo'<td>'.$rfc.'</td>';
					echo'<td>'.$status.'</td>';
					echo'<td><strong>'.$fechaalta.'</strong></td>';
					echo'
						<td class="center">
							<a href="#" onClick="acciones(2,'.$idunicoe.');" title="modificar" class="btn-action glyphicons pencil btn-success"><i></i></a>
							<a href="#" onClick="acciones(3,'.$idunicoe.');" title="eliminar" class="btn-action glyphicons remove_2 btn-danger"><i></i></a>
						</td>';
				echo'</tr>';
				
			}    	
			?>

			
				

		</tbody>
	</table>





	
</div>