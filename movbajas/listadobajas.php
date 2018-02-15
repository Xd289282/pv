<?php
	if (!isset($_SESSION["pvtacommand_idunicoe"])){
		session_start(); 		
	}
	session_name("ssdpvccmm");
	if (!isset($_SESSION["pvtacommand_ingsisv"])){echo"<SCRIPT>window.location='../index.php';</SCRIPT>";}	
	include "../estructura/parametros.php";
	include "../conexion/conexion.php";
	$idunicoe=$_SESSION["pvtacommand_idunicoe"];// id unico de la empresa del usuario

	$mostrarmarca=0;$mostrarmodelo=0;$mostrartalla=0;$mostrarserie=0;$mostrarlote=0;$mostrarfcaducidad=0;
	$consulta="select marca,serie,modelo,talla,lote,fcaducidad from configuraciones where idunicoe='$idunicoe'";
	$recordset = mysqli_query($link,$consulta);
	while($registro = mysqli_fetch_array($recordset)){				
		$mostrarmarca=$registro["marca"];
		$mostrarserie=$registro["serie"];
		$mostrarmodelo=$registro["modelo"];
		$mostrartalla=$registro["talla"];
		$mostrarfcaducidad=$registro["fcaducidad"];
		$mostrarlote=$registro["lote"];
	}

?>
<table id="example" class="display table table-bordered table-condensed table-striped table-primary table-vertical-center checkboxs js-table-sortable" cellspacing="0" width="100%">
		<thead>
			<tr>				
				<th class="center" width="8%" class="center">Codigo</th>
				<th class="center" width="50%">Producto</th>
				<?php if($mostrarmarca>0){ echo "<th>Marca</th>";}?>
				<?php if($mostrarmodelo>0){ echo "<th>Mod</th>";}?>
				<th>Color</th>						
				<?php if($mostrartalla>0){ echo "<th>Talla</th>";}?>
				<?php if($mostrarserie>0){ echo "<th>Serie</th>";}?>
				<?php if($mostrarlote>0){ echo "<th>Lote</th>";}?>
				<?php if($mostrarfcaducidad>0){ echo "<th>Cad</th>";}?>				
				<th class="center" width="8%">Cantidad</th>
				<th class="center" width="10%">Precio</th>				
				<th class="center" width="10%">Acciones</th>
			</tr>
		</thead>

		<tbody>
			<?php
			$idunicoe=$_SESSION["pvtacommand_idunicoe"];// id unico de la empresa del usuario
			$idsesion=$_SESSION["pvtacommand_idsesion"];// id de la sesion del usuario
			$consulta="select a.idunicop,b.codigo,b.nombrep,a.cantidad,b.pmostrador,b.iva,b.descuento,b.marca,b.color,b.serie,a.idunicoregi from tmpbajas as a left join productos as b on a.idunicop=b.idunicop where a.idsesion='$idsesion' and a.idunicoe='$idunicoe'";
			$recordset = mysqli_query($link,$consulta);
			while($registro = mysqli_fetch_array($recordset)){				
				$idunicop=$registro["idunicop"];
				$codigo=$registro["codigo"];
				$nombrep=utf8_encode($registro["nombrep"]);	
				$cantidad=$registro["cantidad"];
				$pmostrador=$registro["pmostrador"];
				$iva=$registro["iva"];
				$descuento=$registro["descuento"];
				$marca=$registro["marca"];
				$color=$registro["color"];
				$idunicoregi=$registro["idunicoregi"];

				if(!isset($serie)){$serie="";}else{$serie=$registro["serie"];}
				if($iva>0){
					$iva=$iva/100;
					$iva=round($iva,2);
					$pmostrador=($cantidad*$pmostrador)*(1+$iva);
				}

				if($descuento>0){
					$descuento=$pmostrador*($descuento/100);
				}
				$subtotal=$pmostrador-$descuento;
				$pmostrador=number_format($pmostrador,2);
				$descuento=number_format($descuento,2);
				$subtotal=number_format($subtotal,2);

				$modelo="";$talla="";$lote="";$fcaducidad="";
				$consulta="select * from inventario where idunicoregi='$idunicoregi' and idunicoe='$idunicoe'";
				$recordset2 = mysqli_query($link,$consulta);
				while($registro2 = mysqli_fetch_array($recordset2)){				
					$modelo=$registro2["modelo"];
					$talla=$registro2["talla"];
					$lote=$registro2["lote"];
					$fcaducidad=$registro2["fcaducidad"];
					$fcaducidad=substr($fcaducidad,8,2).'/'.substr($fcaducidad,5,2).'/'.substr($fcaducidad,0,4);
				}
				

				echo'<tr class="selectable">';
				echo'<td class="center">'.$codigo.'</td>';
				echo'<td><strong>'.$nombrep.'</strong></td>';	

				//marca
				if($mostrarmarca>0){ echo'<td class="center">'.$marca.'</td>';}

				//modelo
				if($mostrarmodelo>0){ echo'<td class="center">'.$modelo.'</td>';}
						
				//color
				echo'<td class="center">'.$color.'</td>';		
					
				//talla
				if($mostrartalla>0){ echo'<td class="center">'.$talla.'</td>';}

				//serie
				if($mostrarserie>0){ echo'<td class="center">'.$serie.'</td>';}

				//lote
				if($mostrarlote>0){ echo'<td class="center">'.$lote.'</td>';}
				//fcaducidad
				if($mostrarfcaducidad>0){echo'<td class="center">'.$fcaducidad.'</td>';}

				echo'<td class="center">'.$cantidad.'</td>';
				echo'<td class="center">'.$pmostrador.'</td>';
				echo'
					<td class="center">							
						<a href="#" onClick="delprodventa('.$idsesion.','.$idunicoregi.');" title="eliminar" class="btn-action glyphicons remove_2 btn-danger"><i></i></a>
						</td>';
				echo'</tr>';
				
			}    	
			?>

			
				

		</tbody>
	</table>