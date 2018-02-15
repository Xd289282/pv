<?php
	if (!isset($_SESSION["pvtacommand_ingsisv"])){
	  echo"<SCRIPT>window.location='../index.php';</SCRIPT>";   
	}	
	
	include "../estructura/parametros.php";
	include "../conexion/conexion.php";
?>
<div class="widget-head">
	<h4 class="heading glyphicons list"><i></i>Administración de Sucursales</h4>
</div>
<div class="widget-body">
	
	
	
	<table id="example" class="display table table-bordered table-condensed table-striped table-primary table-vertical-center checkboxs js-table-sortable" cellspacing="0" width="100%">
		<thead>
			<tr>				
				<th>Empresa</th>
				<th>Sucursal</th>
				<th>RFC</th>
				<th>Status</th>
				<th>Fecha Alta</th>
				<th class="center" width="60">Acciones</th>
			</tr>
		</thead>

		<tbody>
			<?php
			$idregistro=$_SESSION["pvtacommand_idregistro"];// id del registro del usuario creador de empresas
			$idunicoe=$_SESSION["pvtacommand_idunicoe"];// id unico de la empresa del usuario
			//$consulta="select *  from sucursal where idunicoe='$idunicoe' order by idunicos";
			$consulta="select a.idunicoe,a.idunicos,a.nombre,a.rfc,a.`status`,a.fechaalta,b.nombre as nombreempresa from sucursal as a left join empresa as b on a.idunicoe=b.idunicoe where b.idregistro='$idregistro' order by b.nombre,a.nombre";
			$recordset = mysqli_query($link,$consulta);
			while($registro = mysqli_fetch_array($recordset)){
				$idunicoe=$registro["idunicoe"];
				$idunicos=$registro["idunicos"];
				$nombre=utf8_encode($registro["nombre"]);
				$rfc=$registro["rfc"];
				$status=$registro["status"];
				$fechaalta=$registro["fechaalta"];				
				$fechaalta=substr($fechaalta, 8,2).'/'.substr($fechaalta, 5,2).'/'.substr($fechaalta,0,4);
				$nombreempresa=$registro["nombreempresa"];

				
				

				switch ($status) {//0=prueba 1=activo 2=suspendida 3=baja
					case 0: $status="Prueba";break;
					case 1: $status="Activo";break;
					case 2: $status="Suspendida";break;
					case 3: $status="Baja";break;
					default:$status="Suspendida";break;
				}
				
				echo'<tr class="selectable">';					
					echo'<td><strong>'.$nombreempresa.'</strong></td>';
					echo'<td><strong>'.$nombre.'</strong></td>';
					echo'<td>'.$rfc.'</td>';
					echo'<td>'.$status.'</td>';
					echo'<td><strong>'.$fechaalta.'</strong></td>';
					echo'
						<td class="center">
							<a href="#" onClick="acciones(2,'.$idunicos.');" title="modificar" class="btn-action glyphicons pencil btn-success"><i></i></a>
							<a href="#" onClick="acciones(3,'.$idunicos.');" title="eliminar" class="btn-action glyphicons remove_2 btn-danger"><i></i></a>
						</td>';
				echo'</tr>';
				
			}    	
			?>

			
				

		</tbody>
	</table>





	
</div>