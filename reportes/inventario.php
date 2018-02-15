<?php
header("Content-Type: text/html;charset=utf-8");
set_time_limit(0);
session_start();
session_name("ssdpvccmm");
if (!isset($_SESSION["pvtacommand_ingsisv"])){echo"<SCRIPT>window.location='../index.php';</SCRIPT>";}	
//error_reporting(E_ALL & ~E_NOTICE);
require_once('tcpdf/config/lang/eng.php');
require_once('tcpdf/tcpdf.php');
include("../conexion/conexion.php");
//carga de variables de session
//$anioactual=$_SESSION["sadm_anio"];
$idunicoe=$_SESSION["pvtacommand_idunicoe"];
$idunicos=$_SESSION["pvtacommand_idunicos"];

if(!isset($_GET["id"]) or $_GET["id"]<=0){
	$idunicos=$_SESSION["pvtacommand_idunicos"];
}else{
	$idunicos=$_GET["id"];
	//actualizar la empresa a la que pertenece la sucursal
}
$cmodelo="";
$ctalla="";
$ctipo="";
$cusuario="";
if(!isset($_GET["modelo"])){
	$modelo="";
	$cmodelo="";
}
else{
		$modelo=$_GET["modelo"];
		if (strlen($modelo)<>0) {$cmodelo="and a.modelo like '%$modelo%'";}
    }

if(!isset($_GET["talla"])){
	$talla="";
	$ctalla="";
}
else{
		$talla=$_GET["talla"];
		if (strlen($talla)<>0) {$ctalla="and a.talla like '%$talla%'";}
    }

if(!isset($_GET["lote"])){
	$lote="";
}
else{
		$lote=$_GET["lote"];
    }


if(!isset($_GET["tipo"])){
	$tipo="";
	$ctipo="";
}
else{
		$tipo=$_GET["tipo"];
		if (strlen($tipo)<>0) {$ctipo=" and b.descrip like '%$tipo%'";}
    }    

  

$fecha=date("d/m/Y");

$cierre=1;
$consulta="select idunicoe from sucursal where idunicos='$idunicos'";
$recordset = mysqli_query($link,$consulta);
while($registro = mysqli_fetch_array($recordset)){
		$idunicoe=$registro["idunicoe"]; 
	}

//$idunicoe=1;
//$idunicos=1;
$fecha=date("d/m/Y");
///carga de variables constantes
$pagenumber = 1;
//inicializa variables en cero
//$empleado=0;
$importetotal=0;
$piezastotal=0;
/////////////////////////////
$pdf = new TCPDF('P', PDF_UNIT, 'PDF_PAGE_FORMA', true, 'UTF-8', false); //orientacion L horizontal P vertical
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->setLanguageArray($l);
$pdf->SetFont('helvetica', 'B', 20);
$pdf->AddPage();
$txt= $pdf->getAliasNumPage();
$pdf->SetFont('helvetica', '', 10);
//consultas para valores en encabezado
/*
if ($idunicos<>0)
   {$consulta="select * from sucursal where idunicos='$idunicos'";}
else
   {$consulta="select * from empresa where idunicoe='$idunicoe'";}
  */
$consulta="select * from empresa where idunicoe='$idunicoe'";
$recordset = mysqli_query($link,$consulta);
while($registro = mysqli_fetch_array($recordset)){
  $nombreempresa=$registro["nombre"]; 
 
  if(!isset($registro["piedepagina"])){
  	$piedepagina="img/".$registro["piedepagina"];
  }else{
  	$piedepagina="img/piedepagina2.png";
  }
  if($registro["rutalogo"]=== NULL || isset($registro["rutalogo"])){$rutalogo="img/logopventa.jpg";}else{$rutalogo="img/".$registro["rutalogo"];}
  
}

$consulta="select * from configuraciones where idunicoe='$idunicoe'";
$recordset = mysqli_query($link,$consulta);
while($registro = mysqli_fetch_array($recordset)){
  $mostrarmodelo=$registro["modelo"];
  $mostrartalla=$registro["talla"];
  $mostrarlote=$registro["lote"];
  $mostrarfcaducidad=$registro["fcaducidad"];
}


//echo $rutalogo;
//cuenta registros totales de la consulta principal

if ($idunicos<>0)
   {$consulta="select b.codigo ,b. nombrep,a .cantidad, b.ultpcompra ,b. pmostrador,a .modelo, a.talla ,a. lote,a .fcaducidad from inventario as a 
left join productos as b on a.idunicop=b.idunicop where a.idunicos='$idunicos' and a.idunicoe='$idunicoe'";
;

   }
else
   {$consulta="select b.codigo ,b. nombrep,a .cantidad, b.ultpcompra ,b. pmostrador,a .modelo, a.talla ,a. lote,a .fcaducidad from inventario as a 
left join productos as b on a.idunicop=b.idunicop where a.idunicoe='$idunicoe'";
   }
   $consulta=$consulta.$cmodelo.$ctalla.$ctipo." order by b.codigo";
  // echo $consulta;
$recordset = mysqli_query($link,$consulta);
$cuentaregistros=0;
while($registro = mysqli_fetch_array($recordset)){$cuentaregistros=$cuentaregistros+1;}
//

////////////////////////////carga de encabezados****************************************
$html1='<table border="0" align="center">          

 <tr>
    <td width="20%" align="left" valign="top"><img src="'.$rutalogo.'" width="80" height="80" alt="er" /></td>
	<td class="tds1" width="60%"align="center"><font style="font-size:40px" face="Arial, Helvetica, sans-serif" ><strong><br>SISTEMA DE PUNTO DE VENTA <BR> '.$nombreempresa.'<br>Reporte de Inventario</strong></font>
   </td>


     <td  width="20%" align="center" valign="top">     </td>
</tr>
              
        <tbody>


        </tbody>
    </table>';
	
$html2='<br><table border="0">                        
        <tbody>     
	    <tr>
            <td  width="80%"></td>            
        </tr>
        
        <tr>            
            <td  width="80%"></td>            
        </tr>
		<tr>            
            <td  width="40%">Fecha: '.$fecha.'</td>
			<td width="60%" align="right">Página: '.$txt.'</td>           
        </tr>
 
             
        </tbody>
    </table><br>';

/////////////////////////carga de tabla de detalles********************************
$html3='<table border="1" cellspacing="0" width="100%">
    
    <thead>
    <tr>
        <td width="10%" align="center"><strong>Codigo</strong></td>
		<th width="20%" align="center"><strong>Nombre</strong></th>
		<th width="10%" align="center"><strong>Cantidad</strong></th>
        <th width="10%" align="center"><strong>U.Costo</strong></th>
        <th width="10%" align="center"><strong>I.Venta</strong></th> ';  
		if ($mostrarmodelo==1){
			$html3.='<th width="10%" align="center"><strong>Modelo</strong></th>';
			}else{
			$html3.='<th width="10%" align="center"><strong></strong></th>';				
			}
		if ($mostrartalla==1){
			$html3.='<th width="10%" align="center"><strong>Talla</strong></th>';
			}else{
			$html3.='<th width="10%" align="center"><strong></strong></th>';				
			}
		if ($mostrarlote==1){
			$html3.='<th width="10%" align="center"><strong>lote</strong></th>';
			}else{
			$html3.='<th width="10%" align="center"><strong></strong></th>';				
			}
		if ($mostrarfcaducidad==1){
			$html3.='<th width="10%" align="center"><strong>Caducidad</strong></th>';
			}else{
			$html3.='<th width="10%" align="center"><strong></strong></th>';				
			}

        $html3.='               
    </tr>
    </thead>
    <tbody>
                               
</tbody>
</table>';

///////////////////carga de final de tabla o totales********************



$html5='<table border="0">          

 <tr>
  <br>

    <td width="100%" align="center"><font face="Arial, Helvetica, sans-serif"size="9"></font></td>
              
        <tbody>


        </tbody>
		</tr>
    </table>';


$html6='<table border="0" align="left">          

 <tr>
  <br>
    <td width="30%"  align="center"><font face="Arial, Helvetica, sans-serif"size="9"></font></td>
	<td class="tds1" width="30%"align="center">
   </td>
     <td  width="40%" align="center" valign="top"><font face="Arial, Helvetica, sans-serif"size="9"></font></td>
</tr>

    </table>';
///////////////////////carga del pie de pagina

$fila1="";
$html7='<table border="0">          

 <tr>
    <td  width="100%" align="center" valign="top"><img src="'.$piedepagina.'" width="400" height="70" alt="er" /></td>
 </tr>             
        <tbody>


        </tbody>
    </table>';

////////////////////////////////////////////////////detalles

/////////////////////////carga de datos a mostrar principales*********************************************
	if ($idunicos<>0)
   {$consulta="select b.codigo ,b. nombrep,a .cantidad, b.ultpcompra ,b. pmostrador,a .modelo, a.talla ,a. lote,a .fcaducidad from inventario as a 
left join productos as b on a.idunicop=b.idunicop where a.idunicos='$idunicos' and a.idunicoe='$idunicoe'";
;

   }
else
   {$consulta="select b.codigo ,b. nombrep,a .cantidad, b.ultpcompra ,b. pmostrador,a .modelo, a.talla ,a. lote,a .fcaducidad from inventario as a 
left join productos as b on a.idunicop=b.idunicop where a.idunicoe='$idunicoe'";
   }
   $consulta=$consulta.$cmodelo.$ctalla.$ctipo." order by b.codigo";
		
	//echo $consulta;
    $recordset = mysqli_query($link,$consulta);
	$total=0;
	$cuentadiez=1;
	$bloque=0;
    while($registro = mysqli_fetch_array($recordset)){
        $codigo=$registro["codigo"];
        $nombrep=utf8_encode($registro["nombrep"]);
        $cantidad=$registro["cantidad"];
		$ultpcompra=$registro["ultpcompra"];
		$pmostrador=$registro["pmostrador"];
		$modelo=$registro["modelo"];
		$talla=$registro["talla"];
		$lote=$registro["lote"];
		$fcaducidad=$registro["fcaducidad"];

			if ($total==$bloque){
				$fila1=$fila1.'<table  sTYLE="table-layout:fixed" border="1" cellspacing="0" width="100%" height="220"> ';
			}

			$fila1=$fila1.'    <tr bgcolor="#CCCCCC" bordercolor="#FFFFFF">
				<td  width="10%" height="20" class="tdb" align="left" ><font face="Arial, Helvetica, sans-serif"size="8">'.$codigo.'</font></td>
				<td  width="20%" height="20" align="left"><font face="Arial, Helvetica, sans-serif"size="8">'.$nombrep.'</font></td>
				<td  width="10%" height="20" align="justify" ><font face="Arial, Helvetica, sans-serif"size="8">'.$cantidad.'</font></td>
				<td  width="10%" height="20" align="justify" ><font face="Arial, Helvetica, sans-serif"size="8">'.$ultpcompra.'</font></td>
				<td  width="10%" height="20" align="justify" ><font face="Arial, Helvetica, sans-serif"size="8">'.$pmostrador.'</font></td>';
				if ($mostrarmodelo==1){
			        $fila1.='<td  width="10%" height="20" align="left"><font face="Arial, Helvetica, sans-serif"size="8">'.$modelo.'</font></td>';
			        }else{
			        $fila1.='<td  width="10%" height="20" align="left"><font face="Arial, Helvetica, sans-serif"size="8"></font></td>';				
			       }
				if ($mostrartalla==1){
			        $fila1.='<td  width="10%" height="20" align="left"><font face="Arial, Helvetica, sans-serif"size="8">'.$talla.'</font></td>';
			        }else{
			        $fila1.='<td  width="10%" height="20" align="left"><font face="Arial, Helvetica, sans-serif"size="8"></font></td>';				
			       }
				if ($mostrarlote==1){
			        $fila1.='<td  width="10%" height="20" align="left"><font face="Arial, Helvetica, sans-serif"size="8">'.$lote.'</font></td>';
			        }else{
			        $fila1.='<td  width="10%" height="20" align="left"><font face="Arial, Helvetica, sans-serif"size="8"></font></td>';				
			       }
				if ($mostrarfcaducidad==1){
			        $fila1.='<td  width="10%" height="20" align="left"><font face="Arial, Helvetica, sans-serif"size="8">'.$fcaducidad.'</font></td>';
			        }else{
			        $fila1.='<td  width="10%" height="20" align="left"><font face="Arial, Helvetica, sans-serif"size="8"></font></td>';				
			       }
                $fila1.='   				

			  </tr>';
			$piezastotal=$piezastotal+$cantidad;
			$importetotal=$importetotal+$ultpcompra;
            $total=$total+1;
			$cuentadiez=$cuentadiez+1;
			if ($cuentadiez>=20){$cuentadiez=1;$bloque=$bloque+19;}
    	    $cierre=0;
            // verifica si es el ultimo registro total
			
			if ($total==$bloque){
				$fila1=$fila1.'</table>';
				
				$html4='<br><table border="1" cellspacing="0" width="100%">                     
				 
				<thead>
					<tr>
						 <th width="10%" align="center"><strong></strong></th>
						 <th width="20%" align="center"><strong>Totales:</strong></th>
						 <th width="10%" align="center"><strong>'.$piezastotal.'</strong></th>
						 <th width="10%" align="center"><strong>'.$importetotal.'</strong></th>        
						 <th width="10%" align="center"><strong></strong></th>
						 <th width="10%" align="center"><strong></strong></th>
						 <th width="10%" align="center"><strong></strong></th>
						 <th width="10%" align="center"><strong></strong></th>
						 <th width="10%" align="center"><strong></strong></th>

					</tr>
					</thead>
					<tbody>';
											   
				'</tbody>';
				'</table>';
				
				 $fila1=$fila1.$html4.$html5.$html6.$html7;
				 $fila1=$fila1.'<br>';
				 $pagenumber = $pagenumber+1;
				 if($total<$cuentaregistros){
					 $fila1=$fila1.$html1.$html2.$html3;
				 }
				 $cierre=1;
				 
				}
    }    






//////////////calculos finales del reporte*****************************************************
$menosdediez=0;
if($cuentadiez==19){
	$cuentadiez--;
	$menosdediez=1;
}

if ($cierre==0)
   {
	$fila1=$fila1.'</table>';
	$fila1=$fila1.'<table  sTYLE="table-layout:fixed" border="0" cellspacing="0" width="100%" height="220"> ';
	if ($cuentadiez<20)
	   {
		//incrementa registros vacios
		$resta=19-$cuentadiez;
		if($menosdediez){
			$resta--;
		}
		
		for ($i = 0; $i <=$resta; $i++) 
		    {		
			$fila1=$fila1.'    <tr >
				<td  width="12%" height="20" class="tdb" align="left" ></td>
				<td  width="22%" height="20" align="left"><font face="Arial, Helvetica, sans-serif"size="8"></font></td>
				<td  width="38%" height="20" align="left" ><font face="Arial, Helvetica, sans-serif"size="8"></font></td>
				<td  width="28%" height="20" align="left" ></td>
			  </tr>';	
	        } 	
		}
	 $fila1=$fila1.'</table>';
	 
	 $html4='<br><table border="1" cellspacing="0" width="100%">                     
		 
		<thead>
			<tr>
						 <th width="10%" align="center"><strong></strong></th>
						 <th width="20%" align="center"><strong>Totales:</strong></th>
						 <th width="10%" align="center"><strong>'.$piezastotal.'</strong></th>
						 <th width="10%" align="center"><strong>'.$importetotal.'</strong></th>        
						 <th width="10%" align="center"><strong></strong></th>
						 <th width="10%" align="center"><strong></strong></th>
						 <th width="10%" align="center"><strong></strong></th>
						 <th width="10%" align="center"><strong></strong></th>
						 <th width="10%" align="center"><strong></strong></th>
			</tr>
			</thead>
			<tbody>
									   
		</tbody>
		</table>';
	 
	 
	 $fila1=$fila1.$html4.$html5.$html6.$html7;
	}




$final=$html1.$html2.$html3.$fila1;
//echo $final;
$pdf->writeHTML($final, true, false, false, false, '');



//Close and output PDF document
$pdf->Output('Reporteinventario.pdf', 'I');



?>