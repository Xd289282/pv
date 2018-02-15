<?php

	if (!isset($_SESSION["pvtacommand_idunicoe"])){
		session_start();

	}
	session_name("ssdpvccmm");
	if (!isset($_SESSION["pvtacommand_ingsisv"])){echo"<SCRIPT>window.location='../index.php';</SCRIPT>";}


	include "../estructura/parametros.php";
	include "../conexion/conexion.php";

	if(!isset($_POST["describusca"])){
		$describusca="";
	}else{
		$describusca=$_POST["describusca"];
	}


	$prodinv=$_SESSION["pvtacommand_idunicop_inv"]; // id articulo que tiene mas de un registro en inventario
	$_SESSION["pvtacommand_idunicop_inv"]=0;
	$idunicoe=$_SESSION["pvtacommand_idunicoe"];// id unico de la empresa del usuario
	$idunicos=$_SESSION["pvtacommand_idunicos"];//id unico de la sucursal

	$cadagru="(";
	$agrupador=0;
	if(isset($_POST["arregloe"])){
		$arregloe=$_POST["arregloe"];//arreglo de expedientes
		$tam=count($arregloe);//mañano del arreglo

		//recorrer arreglo para obtener el id del expediente
		for($a=0;$a<$tam;$a++){
			$idunicoa=$arregloe[$a];
		    $cadagru.=$idunicoa;
		    if(($a+1)<$tam){$cadagru.=",";}
		    $agrupador++;
		}
	}
	$cadagru.=")";

	$mostrarmarca=0;
	$mostrarmodelo=0;
	$mostrartalla=0;
	$mostrarserie=0;
	$consulta="select marca,serie,modelo,talla from configuraciones where idunicoe='$idunicoe'";
	$recordset = mysqli_query($link,$consulta);
	while($registro = mysqli_fetch_array($recordset)){
		$mostrarmarca=$registro["marca"];
		$mostrarserie=$registro["serie"];
		$mostrarmodelo=$registro["modelo"];
		$mostrartalla=$registro["talla"];
	}





?>
<table id="example" class="display table table-bordered table-condensed table-striped table-primary table-vertical-center checkboxs js-table-sortable" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th width="1%" class="center">Cod</th>
				<th>Producto</th>
				<?php if($mostrarmodelo>0){ echo "<th>Modelo</th>";}?>
				<th>Color</th>
				<?php if($mostrartalla>0){ echo "<th>Talla</th>";}?>
				<th>Precio</th>
				<th>%desc</th>
				<th>Cantidad</th>
				<th class="center" >Acciones</th>
			</tr>
		</thead>

		<tbody>
			<?php

			if($agrupador==0){
				if($prodinv>0){
					$consulta="select a.idunicoregi,a.idunicop,b.codigo,b.nombrep,b.pmostrador,b.iva,b.marca,b.color,a.modelo,a.talla,a.lote,a.cantidad,b.descuento,a.tipo
							from inventario as a left join productos as b on a.idunicoe=b.idunicoe and a.idunicop=b.idunicop
							where a.idunicoe='$idunicoe' and a.cantidad>0 and a.idunicop='$prodinv' and a.idunicos='$idunicos'";
				}else{

					// $consulta="select a.idunicoregi,a.idunicop,b.codigo,b.nombrep,b.pmostrador,b.iva,b.marca,b.color,a.modelo,a.talla,a.lote,a.cantidad,b.descuento,a.tipo
					// 		from inventario as a left join productos as b on a.idunicoe=b.idunicoe and a.idunicop=b.idunicop
					// 		where a.idunicoe='$idunicoe' and  a.cantidad>0 and (b.nombrep like '%".$describusca."%' or a.modelo like '%".$describusca."%' or a.talla like '%".$describusca."%' or b.color like '%".$describusca."%' or b.descrip like '%".$describusca."%') and a.idunicos='$idunicos'
					// union
					// select a.idunicoregi,a.idunicop,b.codigo,b.nombrep,b.pmostrador,b.iva,b.marca,b.color,a.modelo,a.talla,a.lote,a.cantidad,b.descuento,a.tipo from inventario as a left join productos as b on a.idunicoe=b.idunicoe and a.idunicop=b.idunicop where a.idunicoe='$idunicoe' and (b.nombrep like '%".$describusca."%' or a.modelo like '%".$describusca."%' or a.talla like '%".$describusca."%' or b.color like '%".$describusca."%' or b.descrip like '%".$describusca."%')  and a.tipo='1'";
					$consulta="select a.idunicoregi,a.idunicop,b.codigo,b.nombrep,b.pmostrador,b.iva,b.marca,b.color,a.modelo,a.talla,a.lote,a.cantidad,b.descuento,a.tipo
							from inventario as a left join productos as b on a.idunicoe=b.idunicoe and a.idunicop=b.idunicop
							where a.idunicoe='$idunicoe' and  a.cantidad>0 and (b.nombrep like '%".$describusca."%' or a.modelo like '%".$describusca."%' or a.talla like '%".$describusca."%' or b.color like '%".$describusca."%' or b.descrip like '%".$describusca."%')";

				}
			}else{
				// $consulta="select a.idunicoregi,a.idunicop,b.codigo,b.nombrep,b.pmostrador,b.iva,b.marca,b.color,a.modelo,a.talla,a.lote,a.cantidad,b.descuento,a.tipo
				// 			from inventario as a left join productos as b on a.idunicoe=b.idunicoe and a.idunicop=b.idunicop
				// 			inner join detprodagrup as c on b.idunicoe=c.idunicoe and b.idunicop=c.idunicop
				// 			where c.idunicoe='$idunicoe' and c.idunicoa in $cadagru and  a.cantidad>0 and (b.nombrep like '%".$describusca."%' or a.modelo like '%".$describusca."%' or a.talla like '%".$describusca."%' or b.color like '%".$describusca."%' or b.descrip like '%".$describusca."%') and a.idunicos='$idunicos'
				// union
				// 	select a.idunicoregi,a.idunicop,b.codigo,b.nombrep,b.pmostrador,b.iva,b.marca,b.color,a.modelo,a.talla,a.lote,a.cantidad,b.descuento,a.tipo from inventario as a left join productos as b on a.idunicoe=b.idunicoe and a.idunicop=b.idunicop where a.idunicoe='$idunicoe' and (b.nombrep like '%".$describusca."%' or a.modelo like '%".$describusca."%' or a.talla like '%".$describusca."%' or b.color like '%".$describusca."%' or b.descrip like '%".$describusca."%')  and a.tipo='1'";
				$consulta="select a.idunicoregi,a.idunicop,b.codigo,b.nombrep,b.pmostrador,b.iva,b.marca,b.color,a.modelo,a.talla,a.lote,a.cantidad,b.descuento,a.tipo
							from inventario as a left join productos as b on a.idunicoe=b.idunicoe and a.idunicop=b.idunicop
							inner join detprodagrup as c on b.idunicoe=c.idunicoe and b.idunicop=c.idunicop
							where c.idunicoe='$idunicoe' and c.idunicoa in $cadagru and  a.cantidad>0 and (b.nombrep like '%".$describusca."%' or a.modelo like '%".$describusca."%' or a.talla like '%".$describusca."%' or b.color like '%".$describusca."%' or b.descrip like '%".$describusca."%') ";
			}
			$cons=$consulta;
			//echo $cons;
			$recordset = mysqli_query($link,$consulta);
			while($registro = mysqli_fetch_array($recordset)){
				$idunicoregi=$registro["idunicoregi"];
				$idunicop=$registro["idunicop"];
				$codigo=$registro["codigo"];
				$nombrep=utf8_encode($registro["nombrep"]);
				$pmostrador=$registro["pmostrador"];
				$iva=$registro["iva"];
				$descuento=$registro["descuento"];
				//$descuento=10;
				$tipo=$registro["tipo"];//0 producto 1 servicio
				if($iva>0){
					$iva=$pmostrador*($iva/100);
					$iva=round($iva,2);
					$pmostrador=$pmostrador+$iva;
				}

				$pmostrador=number_format($pmostrador,2);

				if(!isset($registro["marca"])){$marca="";}else{$marca=$registro["marca"];}
				if(!isset($registro["talla"])){$talla="";}else{$talla=$registro["talla"];}
				if(!isset($registro["color"])){$color="";}else{$color=$registro["color"];}
				if(!isset($registro["modelo"])){$modelo="";}else{$modelo=$registro["modelo"];}
				if(!isset($registro["lote"])){$lote="";}else{$lote=$registro["lote"];}
				if(!isset($registro["cantidad"])){$existencia=0;}else{$existencia=$registro["cantidad"];}


				$idicono="id_".$idunicoregi;

				$nombrenumber="numer_".$idunicoregi;
				$cantidad=1;


				$disponible=1;// para servicios
				if($tipo==0){ // es un producto verificar disponibilidad
					//verificar si hay disponibilidad del producto
					$consulta="select sum(cantidad) as cantidad from tmpventas where idunicoe='$idunicoe' and idunicop='$idunicop'";
					$recordset2 = mysqli_query($link,$consulta);
					while($registro2 = mysqli_fetch_array($recordset2)){$cantidadv=$registro2["cantidad"];}
					if(!isset($cantidadv)){$cantidadv=0;}
					//cantidad disponible
					$disponible=$existencia-$cantidadv;
					$disponible=1;
				}

				if($disponible>0){

					echo'<tr class="selectable">';
					//codigo
					echo'<td class="center">
								<a href="#" onClick="addarti('.$idunicoregi.');" title="seleccionar"> <font color="FF8000">'.$codigo.'</font></a>
							</td>';
					//producto
					echo'<td class="center"><strong><a href="#" onClick="addarti('.$idunicoregi.');" title="seleccionar"><font color="FF0000">'.$nombrep.'</font></a></strong></td>';
					//marca

					//modelo
					if($mostrarmodelo>0){
						echo'<td class="center"><strong><a href="#" onClick="addarti('.$idunicoregi.');" title="seleccionar"><font color="FF0000">'.$modelo.'</font></a></strong></td>';
					}

					//color
					echo'<td class="center"><strong><a href="#" onClick="addarti('.$idunicoregi.');" title="seleccionar"><font color="0174DF">'.$color.'</font></a></strong></td>';
					//serie


					if($mostrartalla>0){
						echo'<td class="center"><strong><a href="#" onClick="addarti('.$idunicoregi.');" title="seleccionar"><font color="FF0000">'.$talla.'</font></a></strong></td>';
					}
					//talla

					echo'<td class="center"><strong><a href="#" onClick="addarti('.$idunicoregi.');" title="seleccionar"><font color="0174DF">$'.$pmostrador.'</font></a></strong></td>';

					echo'<td class="center"><strong><a href="#" onClick="addarti('.$idunicoregi.');" title="seleccionar"><font color="0174DF">'.$descuento.'</font></a></strong></td>';

					echo '<td style="font-size: 8.5pt;text-align:center">
			                    <input type="number" class="input-mini" onchange="actualizacarrito(this.name,this.value);" min="1" max="'.$disponible.'" size="2" step="1" value="'.$cantidad.'" id="'.$nombrenumber.'" name="'.$nombrenumber.'" >
			                </td>';

					echo'
							<td class="center" >
								<div id="'.$idicono.'">
									<a href="#" onClick="addarti('.$idunicoregi.');" title="seleccionar" class="btn-action glyphicons hand_up btn-success"><i></i></a>
								</div>
							</td>';
					echo'</tr>';
				}

			}
			?>




		</tbody>
	</table>
