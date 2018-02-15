<?php	
	session_name("ssdpvccmm");
	if (!isset($_SESSION["pvtacommand_ingsisv"])){echo"<SCRIPT>window.location='../index.php';</SCRIPT>";}	
	include "../estructura/parametros.php";
	include "../conexion/conexion.php";
	
	$idunicoe=$_SESSION["pvtacommand_idunicoe"];
    $idunicos=$_SESSION["pvtacommand_idunicos"];

?>
<div class="widget-head">
	<h4 class="heading glyphicons list"><i></i>Administración de Entradas</h4>
</div>
<div class="widget-body">
	
	
	
	<table id="example" class="display table table-bordered table-condensed table-striped table-primary table-vertical-center checkboxs js-table-sortable" cellspacing="0" width="100%">
		<thead>
			<tr>				
				<th>Fecha</th>
				<th>Producto</th>
				<th>Cantidad</th>
				<th>P.Compra</th>
				<th>P.Venta</th>

				<th class="center" width="60">Acciones</th>
			</tr>
		</thead>

		<tbody>
			<?php
			if ($idunicos<>0){
				$consulta="select * from entradas left join productos on entradas.idunicoe=productos.idunicoe and entradas.idunicop=productos.idunicop where entradas.idunicos='$idunicos' order by entradas.fechae desc";}
			else
			   {$consulta="select * from entradas left join productos on entradas.idunicoe=productos.idunicoe and entradas.idunicop=productos.idunicop where entradas.idunicoe='$idunicoe' order by entradas.fechae desc";}

			$recordset = mysqli_query($link,$consulta);
			while($registro = mysqli_fetch_array($recordset)){
                $idunicoreg=$registro["idunicoreg"];
                $fechae=$registro["fechae"];
				$fechae=substr($fechae, 8,2).'/'.substr($fechae, 5,2).'/'.substr($fechae,0,4);
				$nombrep=utf8_encode($registro["nombrep"]);
				$cantidad=$registro["cantidad"];
				$precio=$registro["pcompra"];
                $preciov=$registro["pmostrador"];
							
				echo'<tr class="selectable">';					
					echo'<td><strong>'.$fechae.'</strong></td>';
					echo'<td>'.$nombrep.'</td>';
					echo'<td>'.$cantidad.'</td>';
					echo'<td><strong>'.$precio.'</strong></td>';
					echo'<td><strong>'.$preciov.'</strong></td>';
					echo'
						<td class="center">
	
							<a href="#" onClick="acciones(3,'.$idunicoreg.');" title="eliminar" class="btn-action glyphicons remove_2 btn-danger"><i></i></a>
						</td>';
				echo'</tr>';
				
			}    	
			?>

			
				

		</tbody>
	</table>





	
</div>