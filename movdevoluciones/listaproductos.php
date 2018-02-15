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
	$idunicos=$_SESSION["pvtacommand_idunicos"];// id unico de la empresa del usuario


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
				<th width="1%" class="center">Ticket</th>
				<th>Fecha</th>									
				<th>Codigo</th>									
				<th>Nombre</th>									
				<th>Cantidad</th>									
				<th>Precio Venta</th>	
				<?php if($mostrarmodelo>0){ echo "<th>Modelo</th>";}?>
				<?php if($mostrartalla>0){ echo "<th>Talla</th>";}?>
				<?php if($mostrarlote>0){ echo "<th>Lote</th>";}?>
				<?php if($mostrarfcaducidad>0){ echo "<th>FCaducidad</th>";}?>							
				<th class="center"></th>
			</tr>
		</thead>

		<tbody>
			<?php
			
//consulta buscadotr de ticket de venta

			$consulta="select b.idunicodetsal,a.ticket,a.fecha,c.codigo,c.nombrep,b.cantidad,b.pfinal,b.modelo,b.talla,b.lote,b.fcaducidad from mtosalidas as a left join detsalidas as b on a.idunicosal=b.idunicosal left join productos as c on b.idunicop=c.idunicop where a.ticket<>0 and a.idunicoe='$idunicoe' and a.idunicos='$idunicos'";
			$fila=1;
			$recordset = mysqli_query($link,$consulta);
			while($registro = mysqli_fetch_array($recordset)){				
				
				$idunicodetsal=$registro["idunicodetsal"];
				$ticket=$registro["ticket"];
				$fecha=$registro["fecha"];
				$codigo=$registro["codigo"];
				$nombrep=utf8_encode($registro["nombrep"]);	
				$cantidad=$registro["cantidad"];	
				$pfinal=$registro["pfinal"];			
				$pfinal=number_format($pfinal,2);
				$modelo=$registro["modelo"];
				$talla=$registro["talla"];
				$lote=$registro["lote"];
				$fcaducidad=$registro["fcaducidad"];

				
				
				$idicono="id_".$fila;

				$nombrenumber="numer_".$fila;
				$cantidad=1;
			
								
		

					echo'<tr class="selectable">';
					//codigo
					echo'<td class="center">							
								<a href="#" onClick="addarti('.$fila.','.$ticket.','.$idunicodetsal.');" title="seleccionar"> <font color="FF8000">'.$ticket.'</font></a>
							</td>';
					//producto
					echo'<td class="center"><strong><a href="#" onClick="addarti('.$fila.','.$ticket.','.$idunicodetsal.');" title="seleccionar"><font color="FF0000">'.$fecha.'</font></a></strong></td>';		
					//marca
					
					//precio
					echo'<td class="center"><strong><a href="#" onClick="addarti('.$fila.','.$ticket.','.$idunicodetsal.');" title="seleccionar"><font color="0174DF">'.$codigo.'</font></a></strong></td>';                                                          		
					//seleccion	
					echo'<td class="center"><strong><a href="#" onClick="addarti('.$fila.','.$ticket.','.$idunicodetsal.');" title="seleccionar"><font color="0174DF">'.$nombrep.'</font></a></strong></td>';                                                          		
					//seleccion	
					echo'<td class="center"><strong><a href="#" onClick="addarti('.$fila.','.$ticket.','.$idunicodetsal.');" title="seleccionar"><font color="0174DF">'.$cantidad.'</font></a></strong></td>';                                                          		
					//seleccion	
					echo'<td class="center"><strong><a href="#" onClick="addarti('.$fila.','.$ticket.','.$idunicodetsal.');" title="seleccionar"><font color="0174DF">'.$pfinal.'</font></a></strong></td>';         
					if($mostrarmodelo>0){ 
					    echo'<td class="center"><strong><a href="#" onClick="addarti('.$fila.','.$ticket.','.$idunicodetsal.');" title="seleccionar"><font color="0174DF">'.$modelo.'</font></a></strong></td>';         
					}
					if($mostrartalla>0){ 
					   echo'<td class="center"><strong><a href="#" onClick="addarti('.$fila.','.$ticket.','.$idunicodetsal.');" title="seleccionar"><font color="0174DF">'.$talla.'</font></a></strong></td>';         
					}
					if($mostrarlote>0){ 
					   echo'<td class="center"><strong><a href="#" onClick="addarti('.$fila.','.$ticket.','.$idunicodetsal.');" title="seleccionar"><font color="0174DF">'.$lote.'</font></a></strong></td>';         
					}
					if($mostrarfcaducidad>0){ 
					   echo'<td class="center"><strong><a href="#" onClick="addarti('.$fila.','.$ticket.','.$idunicodetsal.');" title="seleccionar"><font color="0174DF">'.$fcaducidad.'</font></a></strong></td>';                                                          		
					}
					//seleccion	
					echo'
							<td class="center" >
								<div id="'.$idicono.'">
									<a href="#" onClick="addarti('.$fila.','.$ticket.','.$idunicodetsal.');" title="seleccionar" class="btn-action glyphicons hand_up btn-success"><i></i></a>
								</div>
							</td>';
					echo'</tr>';

					$fila++;
				
				
			}    	
			?>

			
				

		</tbody>
	</table>
