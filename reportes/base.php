<?php
header("Content-Type: text/html;charset=utf-8");
set_time_limit(0);
session_start();
session_name("ssdpvccmm");
	if (!isset($_SESSION["pvtacommand_ingsisv"])){echo"<SCRIPT>window.location='../index.php';</SCRIPT>";}
error_reporting(E_ALL & ~E_NOTICE);
require_once('tcpdf/config/lang/eng.php');
require_once('tcpdf/tcpdf.php');
include("../conexion/conexion.php");
//carga de variables de session
//$anioactual=$_SESSION["sadm_anio"];

session_name("ssdpvccmm");
if (!isset($_SESSION["pvtacommand_ingsisv"])){echo"<SCRIPT>window.location='../index.php';</SCRIPT>";}	

$idunicoe=$_SESSION["pvtacommand_idunicoe"];
$idunicos=$_SESSION["pvtacommand_idunicos"];
$idunicoe=1;
$idunicos=1;
$fecha=date("d/m/Y");
///carga de variables constantes
$pagenumber = 1;
//inicializa variables en cero
//$empleado=0;
$importetotal=0;
$piezastotal=0;
/////////////////////////////
$pdf = new TCPDF(P, PDF_UNIT, PDF_PAGE_FORMA, true, 'UTF-8', false); //orientacion L horizontal P vertical
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
if ($idunicos<>0)
   {$consulta="select * from sucursal where idunicos='$idunicos'";}
else
   {$consulta="select * from empresa where idunicoe='$idunicoe'";}
$recordset = mysqli_query($link,$consulta);
while($registro = mysqli_fetch_array($recordset)){
  $nombreempresa=$registro["nombre"];
 // $rutalogo="img/".$registro["rutalogo"];
 // $piedepagina="img/".$registro["piedepagina"];
  //if(!isset($registro["rutalogo"])){$rutalogo="img/".$registro["rutalogo"];}else{$rutalogo="img/logopventa.jpg";}
  if(!isset($registro["piedepagina"])){$piedepagina="img/".$registro["piedepagina"];}else{$piedepagina="img/piedepagina2.png";}
  if($registro["rutalogo"]=== NULL || isset($registro["rutalogo"])){$rutalogo="img/logopventa.jpg";}else{$rutalogo="img/".$registro["rutalogo"];}
  
}
//echo $rutalogo;
//cuenta registros totales de la consulta principal
$consulta="select a.fecha,c.codigo,c.nombrep,b.cantidad,b.pfinal from mtosalidas as a left join detsalidas as b on a.idunicosal=b.idunicosal left join productos as c on b.idunicop=c.idunicop";
$recordset = mysqli_query($link,$consulta);
$cuentaregistros=0;
while($registro = mysqli_fetch_array($recordset)){$cuentaregistros=$cuentaregistros+1;}
//

////////////////////////////carga de encabezados****************************************
$html1='<table border="0" align="center">          

 <tr>
    <td width="20%" align="left" valign="top"><img src="'.$rutalogo.'" width="80" height="80" alt="er" /></td>
	<td class="tds1" width="60%"align="center"><font style="font-size:40px" face="Arial, Helvetica, sans-serif" ><strong><br>SISTEMA DE PUNTO DE VENTA <BR> '.$nombreempresa.'</strong></font>
   </td>


     <td  width="20%" align="center" valign="top"><img src="" width="80" height="80" alt="er" />      </td>
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
        <td width="12%" align="center"><strong>Fecha</strong></td>
		 <th width="10%" align="center"><strong>Codigo</strong></th>
		  <th width="32%" align="center"><strong>nombre</strong></th>
        <th width="18%" align="center"><strong>Cantidad</strong></th>
        <th width="28%" align="center"><strong>Importe</strong></th>        
    </tr>
    </thead>
    <tbody>';
                               
'</tbody>';
'</table>';

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


$html7='<table border="0">          

 <tr>
    <td  width="100%" align="center" valign="top"><img src="'.$piedepagina.'" width="400" height="70" alt="er" /></td>
 </tr>             
        <tbody>


        </tbody>
    </table>';

////////////////////////////////////////////////////detalles

/////////////////////////carga de datos a mostrar principales*********************************************
     $consulta="select a.fecha,c.codigo,c.nombrep,b.cantidad,b.pfinal from mtosalidas as a left join detsalidas as b on a.idunicosal=b.idunicosal left join productos as c on b.idunicop=c.idunicop";
	
    $recordset = mysqli_query($link,$consulta);
	$total=0;
	$cuentadiez=1;
	$bloque=0;
    while($registro = mysqli_fetch_array($recordset)){
        $fecha=$registro["fecha"];
        $codigo=$registro["codigo"];
        $nombrep=utf8_encode($registro["nombrep"]);
        $cantidad=$registro["cantidad"];
		$pfinal=$registro["pfinal"];

			if ($total==$bloque){
				$fila1=$fila1.'<table  sTYLE="table-layout:fixed" border="1" cellspacing="0" width="100%" height="220"> ';
			}

			$fila1=$fila1.'    <tr bgcolor="#CCCCCC" bordercolor="#FFFFFF">
				<td  width="12%" height="20" class="tdb" align="left" ><font face="Arial, Helvetica, sans-serif"size="8">'.$fecha.'</font></td>
				<td  width="10%" height="20" align="left"><font face="Arial, Helvetica, sans-serif"size="8">'.$codigo.'</font></td>
				<td  width="32%" height="20" align="justify" ><font face="Arial, Helvetica, sans-serif"size="8">'.$nombrep.'</font></td>
				<td  width="18%" height="20" align="justify" ><font face="Arial, Helvetica, sans-serif"size="8">'.$cantidad.'</font></td>
				<td  width="28%" height="20" align="justify" ><font face="Arial, Helvetica, sans-serif"size="8">'.$pfinal.'</font></td>
			  </tr>';
			$piezastotal=$piezastotal+1;
			$importetotal=$importetotal+$pfinal;
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
						<td width="12%" align="center"><strong></strong></td>
						 <th width="10%" align="center"><strong></strong></th>
						  <th width="32%" align="center"><strong>Totales:</strong></th>
						<th width="18%" align="center"><strong>'.$piezastotal.'</strong></th>
						<th width="28%" align="center"><strong>'.$importetotal.'</strong></th>        
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
				<td width="12%" align="center"><strong></strong></td>
				 <th width="10%" align="center"><strong></strong></th>
				  <th width="32%" align="center"><strong>Totales:</strong></th>
				<th width="18%" align="center"><strong>'.$piezastotal.'</strong></th>
				<th width="28%" align="center"><strong>'.$importetotal.'</strong></th>        
			</tr>
			</thead>
			<tbody>';
									   
		'</tbody>';
		'</table>';
	 
	 
	 $fila1=$fila1.$html4.$html5.$html6.$html7;
	}




$final=$html1.$html2.$html3.$fila1;
//echo $final;
$pdf->writeHTML($final, true, false, false, false, '');



//Close and output PDF document
$pdf->Output('Reporteventas.pdf', 'I');



?>