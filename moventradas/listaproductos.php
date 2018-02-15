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
				<th width="1%" class="center">Cod</th>
				<th>Producto</th>									
				<?php if($mostrarmarca>0){ echo "<th>Marca</th>";}?>
				<?php if($mostrarmodelo>0){ echo "<th>Mod</th>";}?>
				<th>Color</th>						
				<?php if($mostrartalla>0){ echo "<th>Talla</th>";}?>
				<?php if($mostrarserie>0){ echo "<th>Serie</th>";}?>
				<?php if($mostrarlote>0){ echo "<th>Lote</th>";}?>
				<?php if($mostrarfcaducidad>0){ echo "<th>Cad</th>";}?>
				<th>Precio</th>				
				<th class="center"></th>
			</tr>
		</thead>

		<tbody>
			<?php
			
			if($agrupador==0){	
				if($prodinv>0){					
					//$consulta="select b.idunicoregi,a.idunicop,a.codigo,a.nombrep,a.pmostrador,a.iva,a.marca,a.color,b.modelo,b.talla,b.talla,b.lote,b.cantidad,a.descuento,a.serie,b.fcaducidad from productos as a left join inventario as b on a.idunicoe=b.idunicoe and a.idunicop=b.idunicop where a.idunicoe='$idunicoe' and a.idunicop='$prodinv' and a.tipo='0'";
					$consulta="select idunicop,codigo,nombrep,pmostrador,iva,marca,color,descuento,serie from productos where idunicoe='$idunicoe' and idunicop='$prodinv' and tipo='0'";

				}else{
					//$consulta="select b.idunicoregi,a.idunicop,a.codigo,a.nombrep,a.pmostrador,a.iva,a.marca,a.color,b.modelo,b.talla,b.lote,b.cantidad,a.descuento,a.serie,b.fcaducidad from productos as a left join inventario as b on a.idunicoe=b.idunicoe and a.idunicop=b.idunicop where a.idunicoe='$idunicoe' and a.nombrep like '%".$describusca."%' and a.tipo='0'";
					$consulta="select idunicop,codigo,nombrep,pmostrador,iva,marca,color,descuento,serie from productos where idunicoe='1' and nombrep like '%".$describusca."%' and tipo='0'";
				}
			}else{	
				//$consulta="select c.idunicoregi,a.idunicop,a.codigo,a.nombrep,a.pmostrador,a.iva,a.marca,a.color,c.modelo,c.talla,c.lote,c.cantidad,a.descuento,a.serie,c.fcaducidad 					from productos as a left join detprodagrup as b on a.idunicop=b.idunicop and a.idunicoe=b.idunicoe left join inventario as c on a.idunicop=c.idunicop where a.idunicoe='$idunicoe' and b.idunicoa in $cadagru and a.nombrep like '%".$describusca."%' and a.tipo='0'";
				$consulta="select a.idunicop,a.codigo,a.nombrep,a.pmostrador,a.iva,a.marca,a.color,a.descuento,a.serie from productos as a left join detprodagrup as b on a.idunicop=b.idunicop and a.idunicoe=b.idunicoe  where a.idunicoe='$idunicoe' and b.idunicoa in $cadagru and a.nombrep like '%".$describusca."%' and a.tipo='0'";
			}



			$cons=$consulta;
			$fila=1;
			$recordset = mysqli_query($link,$consulta);
			while($registro = mysqli_fetch_array($recordset)){				
				

				if(!isset($registro["idunicoregi"])){$idunicoregi=0;}else{$idunicoregi=$registro["idunicoregi"];}
				$idunicop=$registro["idunicop"];
				$codigo=$registro["codigo"];
				$nombrep=utf8_encode($registro["nombrep"]);	
				$pmostrador=$registro["pmostrador"];			
				$iva=$registro["iva"];
				$descuento=$registro["descuento"];
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
				if(!isset($registro["serie"])){$serie="";}else{$serie=$registro["serie"];}
				if(!isset($registro["fcaducidad"])){
					$fcaducidad="";
				}else{
					$fcaducidad=$registro["fcaducidad"];
					$fcaducidad=substr($fcaducidad,8,2).'/'.substr($fcaducidad,5,2).'/'.substr($fcaducidad,0,4);
					
				}
				if(!isset($registro["cantidad"])){$existencia=0;}else{$existencia=$registro["cantidad"];}
				
				
				$idicono="id_".$fila;

				$nombrenumber="numer_".$fila;
				$cantidad=1;
			
								
		

					echo'<tr class="selectable">';
					//codigo
					echo'<td class="center">							
								<a href="#" onClick="addarti('.$fila.','.$idunicop.','.$idunicoregi.');" title="seleccionar"> <font color="FF8000">'.$codigo.'</font></a>
							</td>';
					//producto
					echo'<td class="center"><strong><a href="#" onClick="addarti('.$fila.','.$idunicop.','.$idunicoregi.');" title="seleccionar"><font color="FF0000">'.$nombrep.'</font></a></strong></td>';		
					//marca
					if($mostrarmarca>0){ 
						echo'<td class="center"><strong><a href="#" onClick="addarti('.$fila.','.$idunicop.','.$idunicoregi.');" title="seleccionar"><font color="FF0000">'.$marca.'</font></a></strong></td>';
					}

					//modelo
					if($mostrarmodelo>0){ 
						echo'<td class="center"><strong><a href="#" onClick="addarti('.$fila.','.$idunicop.','.$idunicoregi.');" title="seleccionar"><font color="FF0000">'.$modelo.'</font></a></strong></td>';
					}
						
					//color
					echo'<td class="center"><strong><a href="#" onClick="addarti('.$fila.','.$idunicop.','.$idunicoregi.');" title="seleccionar"><font color="0174DF">'.$color.'</font></a></strong></td>';		
					
					//talla
					if($mostrartalla>0){ 
						echo'<td class="center"><strong><a href="#" onClick="addarti('.$fila.','.$idunicop.','.$idunicoregi.');" title="seleccionar"><font color="FF0000">'.$talla.'</font></a></strong></td>';
					}

					//serie
					if($mostrarserie>0){ 
						echo'<td class="center"><strong><a href="#" onClick="addarti('.$fila.','.$idunicop.','.$idunicoregi.');" title="seleccionar"><font color="FF0000">'.$serie.'</font></a></strong></td>';
					}

					//lote
					if($mostrarlote>0){ 
						echo'<td class="center"><strong><a href="#" onClick="addarti('.$fila.','.$idunicop.','.$idunicoregi.');" title="seleccionar"><font color="FF0000">'.$lote.'</font></a></strong></td>';
					}
					//fcaducidad
					if($mostrarfcaducidad>0){ 
						echo'<td class="center"><strong><a href="#" onClick="addarti('.$fila.','.$idunicop.','.$idunicoregi.');" title="seleccionar"><font color="FF0000">'.$fcaducidad.'</font></a></strong></td>';
					}
					//precio
					echo'<td class="center"><strong><a href="#" onClick="addarti('.$fila.','.$idunicop.','.$idunicoregi.');" title="seleccionar"><font color="0174DF">$'.$pmostrador.'</font></a></strong></td>';                                                          		
					//seleccion	
					echo'
							<td class="center" >
								<div id="'.$idicono.'">
									<a href="#" onClick="addarti('.$fila.','.$idunicop.','.$idunicoregi.');" title="seleccionar" class="btn-action glyphicons hand_up btn-success"><i></i></a>
								</div>
							</td>';
					echo'</tr>';

					$fila++;
				
				
			}    	
			?>

			
				

		</tbody>
	</table>
