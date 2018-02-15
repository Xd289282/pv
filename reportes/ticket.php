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
$noticket=$_SESSION["pvtacommand_idunicosal"];



//$noticket=$_GET[ticket];
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
if ($idunicos<>0)
   {$consulta="select * from sucursal where idunicos='$idunicos'";}
else
   {$consulta="select * from empresa where idunicoe='$idunicoe'";}
$recordset = mysqli_query($link,$consulta);
while($registro = mysqli_fetch_array($recordset)){
  $nombreempresa=utf8_encode($registro["nombre"]);
  $calle=utf8_encode($registro["calle"]);
  $colonia=utf8_encode($registro["colonia"]);
  $estado=utf8_encode($registro["estado"]);
  $municipio=utf8_encode($registro["municipio"]);
  $telefono=$registro["telefono"];
  if(!isset($registro["piedepagina"])){
  	$piedepagina="img/piedepagina2.png";  	
  }else{
  	$piedepagina="img/".$registro["piedepagina"];
  }
  
  if(!isset($registro["rutalogo"])){
  	$rutalogo="img/logopventa.jpg";
  }else{
  	$rutalogo="img/".$registro["rutalogo"];
  }
 }
  
//obtener leyenda del ticket  
$consulta="select * from empresa where idunicoe='$idunicoe'";  
$recordset = mysqli_query($link,$consulta);
while($registro = mysqli_fetch_array($recordset)){
	$leyendaticket=utf8_encode($registro["leyendaticket"]);
}


$consulta="select * from configuraciones where idunicoe='$idunicoe'";
$recordset = mysqli_query($link,$consulta);
while($registro = mysqli_fetch_array($recordset)){
  $modelo=$registro["modelo"];
  $talla=$registro["talla"];
  $lote=$registro["lote"];
  $fcaducidad=$registro["fcaducidad"];
}


//echo $rutalogo;
//cuenta registros totales de la consulta principal

if ($idunicos<>0)
   {$consulta="select a .ticket, a.fecha ,c. codigo,c.nombrep,b.cantidad,b.descuento,b.iva,b.pfinal,a.pago,a.cambio,a.idunicou from mtosalidas as a left join detsalidas as b on a. idunicosal=b.idunicosal left join productos as c on b .idunicop= c.idunicop where a.idunicosal='$noticket'";
   }
else
   {$consulta="select a .ticket, a.fecha ,c. codigo,c.nombrep,b.cantidad,b.descuento,b.iva,b.pfinal,a.pago,a.cambio,a.idunicou from mtosalidas as a left join detsalidas as b on a. idunicosal=b.idunicosal left join productos as c on b .idunicop= c.idunicop where a.idunicosal='$noticket' ";
   }
$recordset = mysqli_query($link,$consulta);
$cuentaregistros=0;
while($registro = mysqli_fetch_array($recordset)){
	  $cuentaregistros=$cuentaregistros+1;
	  $ticket=$registro["ticket"];
	  $pago=$registro["pago"];
	  $cambio=$registro["cambio"];
	  $idunicou=$registro["idunicou"];
	}

$consulta="select nombre as usuario from catusuarios where idunicou='$idunicou' ";	
$recordset = mysqli_query($link,$consulta);
while($registro = mysqli_fetch_array($recordset)){
	  $usuario=$registro["usuario"];

	}

//

////////////////////////////carga de encabezados****************************************
$html1='<table border="0" align="left">          

 <tr>
	<td class="tds1" width="30%"align="left"><font style="font-size:20px" face="Arial, Helvetica, sans-serif" ><strong>'.$nombreempresa.'</strong></font></td>
</tr>
<tr>
	<td class="tds1" width="30%"align="left"><font style="font-size:20px" face="Arial, Helvetica, sans-serif" ><strong>'.$calle.'</strong></font></td>
</tr>
<tr>
	<td class="tds1" width="30%"align="left"><font style="font-size:20px" face="Arial, Helvetica, sans-serif" ><strong>'.$colonia.'</strong></font></td>
</tr>
<tr>
	<td class="tds1" width="30%"align="left"><font style="font-size:20px" face="Arial, Helvetica, sans-serif" ><strong>'.$estado.'</strong></font></td>
</tr>
<tr>
	<td class="tds1" width="30%"align="left"><font style="font-size:20px" face="Arial, Helvetica, sans-serif" ><strong>'.$municipio.'</strong></font></td>
</tr>
<tr>
	<td class="tds1" width="30%"align="left"><font style="font-size:20px" face="Arial, Helvetica, sans-serif" ><strong>'.$telefono.'</strong></font></td>
</tr>
	    <tr>
            <td  width="30%" align="left"><font style="font-size:20px" face="Arial, Helvetica, sans-serif" >Fecha: '.$fecha.'</font></td>
        </tr>
              
	    <tr>
            <td  width="30%" align="left"><font style="font-size:20px" face="Arial, Helvetica, sans-serif" >Ticket: '.$ticket.'</font></td>
        </tr>			  
        <tbody>


        </tbody>
    </table>';
	


/////////////////////////carga de tabla de detalles********************************
$html3='<table border="0" cellspacing="0" width="40%">
    

    <tr>
        <td width="40%" align="left" colspan="2"><font face="Arial, Helvetica, sans-serif"size="8"><strong>Artículo</strong></font></td>
		<th width="60%" align="left"><font face="Arial, Helvetica, sans-serif"size="8"><strong>Descripción</strong></font></th>              
    </tr>

</table>';

$html3=$html3.'<table border="0" cellspacing="0" width="40%">
    

    <tr>
        <td width="20%" align="center"><font face="Arial, Helvetica, sans-serif"size="8"><strong>Cantidad</strong></font></td>
		<th width="55%" align="left" colspan="2"><font face="Arial, Helvetica, sans-serif"size="8"><strong>   Precio</strong></font></th>
        <th width="25%" align="center"><font face="Arial, Helvetica, sans-serif"size="8"><strong>Importe</strong></font></th>               
    </tr>
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



////////////////////////////////////////////////////detalles

/////////////////////////carga de datos a mostrar principales*********************************************
	if ($idunicos<>0)
	   {$consulta="select a .ticket, a.fecha ,c. codigo,c.nombrep,b.cantidad,b.descuento,b.iva,b.pfinal from mtosalidas as a left join detsalidas as b on a. idunicosal=b.idunicosal left join productos as c on b .idunicop= c.idunicop where a.idunicosal='$noticket'";
	   }
	else
	   {$consulta="select a .ticket, a.fecha ,c. codigo,c.nombrep,b.cantidad,b.descuento,b.iva,b.pfinal from mtosalidas as a left join detsalidas as b on a. idunicosal=b.idunicosal left join productos as c on b .idunicop= c.idunicop where a.idunicosal='$noticket'";
	   }
		
    $recordset = mysqli_query($link,$consulta);
	$total=0;
	$cuentadiez=100;
	$bloque=0;
	$fila1='';
	$descuentototal=0;
	$subtotal=0;
    while($registro = mysqli_fetch_array($recordset)){
        $ticket=$registro["ticket"];
        $nombrep=utf8_encode($registro["nombrep"]);
        $fecha=$registro["fecha"];
		$codigo=$registro["codigo"];
		$cantidad=$registro["cantidad"];
		$descuento=$registro["descuento"];
		$pfinal=$registro["pfinal"];

			if ($total==$bloque){
				$fila1=$fila1.'<table border="0" cellspacing="0" width="40%" height="220"> ';
			}

			$fila1=$fila1.'    <tr >
				<td  width="40%" align="left" colspan="2"><font face="Arial, Helvetica, sans-serif"size="8">'.$codigo.'</font></td>
				<td  width="60%" align="left" colspan="2"><font face="Arial, Helvetica, sans-serif"size="8">'.$nombrep.'</font></td>

			  </tr>';
			  $precio=$pfinal/$cantidad;
			$fila1=$fila1.'    <tr >
				<td  width="20%" align="left" ><font face="Arial, Helvetica, sans-serif"size="8">'.$cantidad.'</font></td>
				<td  width="55%" aling="left" colspan="2"><font face="Arial, Helvetica, sans-serif"size="8">'.$precio.'</font></td>
				<td  width="25%" ><font face="Arial, Helvetica, sans-serif"size="8">'.$pfinal.'</font></td>				

			  </tr>';			  
			//$piezastotal=$piezastotal+$cantidad;
			$descuentototal=$descuentototal+$descuento;
			$subtotal=$subtotal+($pfinal+$descuento);
			$importetotal=$importetotal+$pfinal;
            //$total=$total+1;
			$cuentadiez=$cuentadiez+1;
			if ($cuentadiez>=101){$cuentadiez=1;$bloque=$bloque+100;}
    	    $cierre=0;
            // verifica si es el ultimo registro total
	
    }    

///////////////////////termina carga de ticket
				$fila1=$fila1.'</table>';
				
				$html4='<br><table border="0" cellspacing="0" width="40%">                     
					<tr>
						 <th width="40%" align="left" colspan="2">Subtotal:<strong></strong></th>
						 <th width="35%" align="center"><strong></strong>'.$subtotal.'</th>
						 <th width="25%" align="center"><strong></strong></th>        
					</tr>
					<tr>
						 <th width="40%" align="left" colspan="2">- Descuento:<strong></strong></th>
						 <th width="35%" align="center"><strong></strong>'.$descuentototal.'</th>
						 <th width="25%" align="center"><strong></strong></th>        
					</tr>

					<tr>
						 <th width="40%" align="left" colspan="2">Total a Pagar:<strong></strong></th>
						 <th width="35%" align="center"><strong></strong>'.$importetotal.'</th>
						 <th width="25%" align="center"><strong></strong></th>        
					</tr>

                    <br><tr>
						 <th width="40%" align="left" colspan="3">Su Pago:<strong></strong></th>
						 <th width="35%" align="center"><strong></strong>'.$pago.'</th>     
						  <th width="25%" align="center"><strong></strong></th>     
					</tr>
                    <br><tr>
						 <th width="40%" align="left" colspan="3">Su Cambio:<strong></strong></th>
						 <th width="35%" align="center"><strong></strong>'.$cambio.'</th>    
						  <th width="25%" align="center"><strong></strong></th>      
					</tr>

					<br><tr>
						 <th width="75%" align="left" colspan="3">Gracias por su Compra...<strong></strong></th>
						 <th width="25%" align="center"><strong></strong></th>        
					</tr>
 					<br><tr>
						 <th width="40%" align="left" colspan="3">Le Atendio:<strong></strong></th>
						 <th width="35%" align="center"><strong></strong>'.utf8_decode($usuario).'</th>    
						  <th width="25%" align="center"><strong></strong></th>      
					</tr>					
					<br><tr>
						 <th width="75%" align="left" colspan="3">'.utf8_decode($leyendaticket).'<strong></strong></th>
						 <th width="25%" align="center"><strong></strong></th>        
					</tr>
                            </table>';
				
				 $fila1=$fila1.$html4.$html5.$html6;
				 $fila1=$fila1.'<br>';
				 $pagenumber = $pagenumber+1;







$final=$html1.$html3.$fila1;
//echo $final;
$pdf->writeHTML($final, true, false, false, false, '');
$pdf->Output('Ticket.pdf', 'I');



?>