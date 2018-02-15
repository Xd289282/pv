<?php
	if (!isset($_SESSION["pvtacommand_idunicoe"])){
		session_start(); 		
	}
	session_name("ssdpvccmm");
	if (!isset($_SESSION["pvtacommand_ingsisv"])){echo"<SCRIPT>window.location='../index.php';</SCRIPT>";}	
	include "../estructura/parametros.php";
	include "../conexion/conexion.php";

	$idunicoe=$_SESSION["pvtacommand_idunicoe"];// id unico de la empresa del usuario
	$idunicos=$_SESSION["pvtacommand_idunicos"];// id unico de la sucursal
	$idsesion=$_SESSION["pvtacommand_idsesion"];// id de la sesion del usuario
	
	$mostrarmodelo=0;$mostrartalla=0;	
	$consulta="select marca,serie,modelo,talla from configuraciones where idunicoe='$idunicoe'";
	$recordset = mysqli_query($link,$consulta);
	while($registro = mysqli_fetch_array($recordset)){						
		$mostrarmodelo=$registro["modelo"];
		$mostrartalla=$registro["talla"];
	}
?>
<table id="example" class="display table table-bordered table-condensed table-striped table-primary table-vertical-center checkboxs js-table-sortable" cellspacing="0" width="100%">
		<thead>
			<tr>				
				<th class="center" width="8%" class="center">Codigo</th>
				<th class="center" width="50%">Producto</th>				
				<th class="center" width="8%">Cantidad</th>
				<th class="center" width="10%">Precio</th>
				<th class="center" width="10%">Descuento</th>
				<th class="center" width="10%">Iva</th>
				<th class="center" width="10%">Subtotal</th>
				<th class="center" width="10%">Acciones</th>
			</tr>
		</thead>

		<tbody>
			<?php
			
			$consulta="select a.idunicop,b.codigo,b.nombrep,a.cantidad,a.precio,b.iva,b.descuento,b.color,a.idunicoregi from tmpventas as a left join productos as b on a.idunicop=b.idunicop where a.idsesion='$idsesion' and a.idunicoe='$idunicoe'";
			$recordset = mysqli_query($link,$consulta);
			while($registro = mysqli_fetch_array($recordset)){				
				$idunicop=$registro["idunicop"];
				$codigo=$registro["codigo"];
				$nombrep=utf8_encode($registro["nombrep"]);	
				$cantidad=$registro["cantidad"];
				$pmostrador=$registro["precio"];
				$iva=$registro["iva"];
				$descuento=$registro["descuento"];
				$idunicoregi=$registro["idunicoregi"];

								

				if(!isset($registro["color"])){$color="";}else{$color=$registro["color"];}
				

				//obtener modelo y talla
				$modelo="";$talla="";
				if($mostrarmodelo>0 || $mostrartalla>0){
					$consulta="select modelo, talla from inventario where idunicoregi='$idunicoregi' and idunicoe='$idunicoe' and idunicos='$idunicos'";
					$recordset2 = mysqli_query($link,$consulta);
					while($registro2 = mysqli_fetch_array($recordset2)){				
						$modelo=$registro2["modelo"];
						$talla=$registro2["talla"];
					}
					$nombrep.=" ".$modelo." ".$color." ".$talla;
				}


				$pmostrador=$pmostrador*$cantidad;
				
				if($descuento>0){
					//$descuento=$pmostrador*($descuento/100);
					$descuento=$cantidad*10;
				}


				if($iva>0){
					$iva=$iva/100;
					$iva=round($iva,2);
					$iva=($pmostrador-$descuento)*$iva;
				}

				
				$subtotal=$pmostrador-$descuento+$iva;

				$pmostrador=number_format($pmostrador,2);
				$descuento=number_format($descuento,2);
				$subtotal=number_format($subtotal,2);
				

				echo'<tr class="selectable">';
					echo'<td class="center">'.$codigo.'</td>';
					echo'<td><strong>'.$nombrep.'</strong></td>';					
					echo'<td class="center">'.$cantidad.'</td>';
					echo'<td class="center">'.$pmostrador.'</td>';
					echo'<td class="center">'.$descuento.'</td>';
					echo'<td class="center">'.$iva.'</td>';
					echo'<td class="center">'.$subtotal.'</td>';
					echo'
						<td class="center">							
							<a href="#" onClick="delprodventa('.$idsesion.','.$idunicoregi.');" title="eliminar" class="btn-action glyphicons remove_2 btn-danger"><i></i></a>
							<a href="#" onClick="precio2venta('.$idsesion.','.$idunicoregi.','.$idunicop.');" title="Aplica Precio2" class="btn-action glyphicons hand_up btn-danger"><i></i></a>
						</td>';
				echo'</tr>';
				
			}    	
			?>

			
				

		</tbody>
	</table>