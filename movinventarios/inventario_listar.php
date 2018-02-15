<?php
	session_name("ssdpvccmm");
	if (!isset($_SESSION["pvtacommand_ingsisv"])){echo"<SCRIPT>window.location='../index.php';</SCRIPT>";}	
	
	include "../estructura/parametros.php";
	include "../conexion/conexion.php";
	
	$idunicoe=$_SESSION["pvtacommand_idunicoe"];
    $idunicos=$_SESSION["pvtacommand_idunicos"];

?>
<div class="widget-head">
	<h4 class="heading glyphicons list"><i></i>Administración de Inventarios</h4>
</div>
<div class="widget-body">
	
	
	
	<table id="example" class="display table table-bordered table-condensed table-striped table-primary table-vertical-center checkboxs js-table-sortable" cellspacing="0" width="100%">
		<thead>
			<tr>				
				<th>Clave</th>
				<th>Producto</th>
				<th>Cantidad</th>
				<th>Talla</th>
				<th class="center" width="60">Acciones</th>
			</tr>
		</thead>

		<tbody>
			<?php
			if ($idunicos<>0)
			   {$consulta="select inventario.idunicoregi,productos.codigo,productos.nombrep,inventario.cantidad,inventario.talla from inventario left join productos on inventario.idunicop=productos.idunicop where inventario.idunicoe='$idunicoe' and inventario.idunicos='$idunicos' and inventario.tipo='0' order by inventario.idunicoregi,inventario.talla desc
";}
			else
			   {$consulta="select inventario.idunicoregi,productos.codigo,productos.nombrep,inventario.cantidad,inventario.talla from inventario left join productos on inventario.idunicop=productos.idunicop where inventario.idunicoe='$idunicoe' and inventario.tipo='0' order by inventario.idunicoregi,inventario.talla desc";}

			$recordset = mysqli_query($link,$consulta);
			while($registro = mysqli_fetch_array($recordset)){
                $idunicoregi=$registro["idunicoregi"];
                $codigo=$registro["codigo"];
                $nombrep=$registro["nombrep"];
				$cantidad=$registro["cantidad"];
				$talla=$registro["talla"];

							
				echo'<tr class="selectable">';					
					echo'<td><strong>'.$codigo.'</strong></td>';
					echo'<td>'.$nombrep.'</td>';
					echo'<td>'.$cantidad.'</td>';
					echo'<td><strong>'.$talla.'</strong></td>';
					echo'
						<td class="center">
							<a href="#" onClick="acciones(2,'.$idunicoregi.');" title="modificar" class="btn-action glyphicons pencil btn-success"><i></i></a>
							
						</td>';
				echo'</tr>';
				
			}    	
			?>

			
				

		</tbody>
	</table>





	
</div>