<?php	
	session_name("ssdpvccmm");
	if (!isset($_SESSION["pvtacommand_ingsisv"])){echo"<SCRIPT>window.location='../index.php';</SCRIPT>";}	
	include "../estructura/parametros.php";
	include "../conexion/conexion.php";
	
	$idunicoe=$_SESSION["pvtacommand_idunicoe"];
    $idunicos=$_SESSION["pvtacommand_idunicos"];

?>
<div class="widget-head">
	<h4 class="heading glyphicons list"><i></i>Administración de Devoluciones</h4>
</div>
<div class="widget-body">
	
	
	
	<table id="example" class="display table table-bordered table-condensed table-striped table-primary table-vertical-center checkboxs js-table-sortable" cellspacing="0" width="100%">
		<thead>
			<tr>				
				<th>Fecha</th>
				<th>Producto</th>
				<th>Cantidad</th>
				<th>Precio de Compra</th>
				<th class="center" width="60">Acciones</th>
			</tr>
		</thead>

		<tbody>
			<?php
			if ($idunicos<>0){
				$consulta="select a.idunicod,a.fecha,b.nombrep,a.cantidad,a.pfinal from devoluciones as a left join productos as b on a.idunicoe=b.idunicoe and 
a.idunicop=b.idunicop where a.idunicos='$idunicos' order by a.fecha desc";}
			else
			   {$consulta="select a.idunicod,a.fecha,b.nombrep,a.cantidad,a.pfinal from devoluciones as a left join productos as b on a.idunicoe=b.idunicoe and a.idunicop=b.idunicop where a.idunicoe='$idunicoe' order by a.fecha desc";}

			$recordset = mysqli_query($link,$consulta);
			while($registro = mysqli_fetch_array($recordset)){
                $idunicoreg=$registro["idunicod"];
                $fechae=$registro["fecha"];
				$fechae=substr($fechae, 8,2).'/'.substr($fechae, 5,2).'/'.substr($fechae,0,4);
				$nombrep=utf8_encode($registro["nombrep"]);
				$cantidad=$registro["cantidad"];
				$precio=$registro["pfinal"];

							
				echo'<tr class="selectable">';					
					echo'<td><strong>'.$fechae.'</strong></td>';
					echo'<td>'.$nombrep.'</td>';
					echo'<td>'.$cantidad.'</td>';
					echo'<td><strong>'.$precio.'</strong></td>';
					echo'
						<td class="center">
						</td>';
				echo'</tr>';
				
			}    	
			?>

			
				

		</tbody>
	</table>





	
</div>