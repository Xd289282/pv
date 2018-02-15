<?php
	if (!isset($_SESSION["pvtacommand_ingsisv"])){
	  echo"<SCRIPT>window.location='../index.php';</SCRIPT>";   
	}	
	
	include "../estructura/parametros.php";
	include "../conexion/conexion.php";
?>
<div class="widget-head">
	<h4 class="heading glyphicons list"><i></i>Administración de Productos</h4>
</div>
<div class="widget-body">
	
	
	
	<table id="example" class="display table table-bordered table-condensed table-striped table-primary table-vertical-center checkboxs js-table-sortable" cellspacing="0" width="100%">
		<thead>
			<tr>				
				<th>Codigo</th>
				<th>Descripcion</th>				
				<th>Stock</th>
				<th>P. Compra</th>
				<th>P. Venta</th>
				<th>Descto</th>

				<th class="center" width="60">Acciones</th>
			</tr>
		</thead>

		<tbody>
			<?php
			$idunicoe=$_SESSION["pvtacommand_idunicoe"];// id unico de la empresa del usuario
			$consulta="select *  from productos where idunicoe='$idunicoe' order by nombrep";
			$recordset = mysqli_query($link,$consulta);
			while($registro = mysqli_fetch_array($recordset)){
				
				$idunicop=$registro["idunicop"];
				$codigo=$registro["codigo"];
				$nombrep=utf8_encode($registro["nombrep"]);				
				$ultpcompra=$registro["ultpcompra"];
				$pmostrador=$registro["pmostrador"];
				$stock=$registro["stock"];
				$iva=$registro["iva"];
				$descuento=$registro["descuento"];
				$tipo=$registro["tipo"];

				$ultpcompra=number_format($ultpcompra,2);
				$pmostrador=number_format($pmostrador,2);
				if($tipo==0){
					$tipo="Producto";
				}else{
					$tipo="Servicio";
				}
			
				
				echo'<tr class="selectable">';					
					echo'<td><strong>'.$codigo.'</strong></td>';
					echo'<td>'.$nombrep.'</td>';
					echo'<td>'.$stock.'</td>';
					echo'<td><strong>'.$ultpcompra.'</strong></td>';
					echo'<td><strong>'.$pmostrador.'</strong></td>';
					
					echo'<td>'.$descuento.'</td>';
					
					echo'
						<td class="center">
							<a href="#" onClick="acciones(2,'.$idunicop.');" title="modificar" class="btn-action glyphicons pencil btn-success"><i></i></a>
							<a href="#" onClick="acciones(3,'.$idunicop.');" title="eliminar" class="btn-action glyphicons remove_2 btn-danger"><i></i></a>
						</td>';
				echo'</tr>';
				
			}    	
			?>

			
				

		</tbody>
	</table>





	
</div>