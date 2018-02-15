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
	$consulta="select idunicoe from sucursal where idunicos='$idunicos'";
	$recordset = mysqli_query($link,$consulta);
	while($registro = mysqli_fetch_array($recordset)){
  		$idunicoe=$registro["idunicoe"]; 
  	}
}
$ctipo="";
if(!isset($_GET["tipo"])){
	$tipo="";
	$ctipo="";
}
else{
		$tipo=$_GET["tipo"];
		if (strlen($tipo)<>0) {$ctipo="and a.tipo ='$tipo'";}
    }



//$idunicoe=1;
//$idunicos=1;
$fecha=date("d/m/Y");
$fecha1=$_GET["fecha1"];
$fecha2=$_GET["fecha2"];

$fechai=substr($fecha1,6,4).'-'.substr($fecha1,3,2).'-'.substr($fecha1,0,2)." 00:00:00";
$fechaf=substr($fecha2,6,4).'-'.substr($fecha2,3,2).'-'.substr($fecha2,0,2)." 23:59:59";

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
//echo $rutalogo;
//cuenta registros totales de la consulta principal
$consulta="select * from bitacora as a left join productos as b on a.idunicop=b.idunicop left join catusuarios as c on a.idunicou=c.idunicou where a.fechahora>='$fechai' and a.fechahora<='$fechaf' and a.idunicoe='$idunicoe' and a.idunicos='$idunicos'";
$consulta=$consulta.$ctipo."order by a.fechahora";
$recordset = mysqli_query($link,$consulta);
$cuentaregistros=0;
while($registro = mysqli_fetch_array($recordset)){$cuentaregistros=$cuentaregistros+1;}
//

////////////////////////////carga de encabezados****************************************
$html1='<table border="0" align="center">          

 <tr>
    <td width="20%" align="left" valign="top"><img src="'.$rutalogo.'" width="80" height="80" alt="er" /></td>
	<td class="tds1" width="60%"align="center"><font style="font-size:40px" face="Arial, Helvetica, sans-serif" ><strong><br>SISTEMA DE PUNTO DE VENTA <BR> '.$nombreempresa.'<br>Reporte de Bitacora</strong></font>
   </td>


     <td  width="20%" align="center" valign="top"></td>
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
		<th width="20%" align="center"><strong>Producto</strong></th>
		<th width="10%" align="center"><strong>Cantidad</strong></th>
        <th width="30%" align="center"><strong>usuario</strong></th>
        <th width="15%" align="center"><strong>Fecha-Hora</strong></th>  
        <th width="15%" align="center"><strong>Movimiento</strong></th>        
       												
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
if($cuentaregistros>0){
/////////////////////////carga de datos a mostrar principales*********************************************
 $consulta="select * from bitacora as a left join productos as b on a.idunicop=b.idunicop left join catusuarios as c on a.idunicou=c.idunicou where a.fechahora>='$fechai' and a.fechahora<='$fechaf' and a.idunicoe='$idunicoe' and a.idunicos='$idunicos'";
    $consulta=$consulta.$ctipo."order by a.fechahora";
    $recordset = mysqli_query($link,$consulta);
	$total=0;
	$cuentadiez=1;
	$bloque=0;
	$mostradortotal=0;
	$descuentototal=0;
	$ivatotal=0;
    while($registro = mysqli_fetch_array($recordset)){
	    if ($tipo==0){$tiposaln="Alta";}
		if ($tipo==1){$tiposaln="Modificacion";}
		if ($tipo==2){$tiposaln="Entrada";}
		if ($tipo==3){$tiposaln="Salida";}
		if ($tipo==4){$tiposaln="traspaso";}
		if ($tipo==5){$tiposaln="Baja";}
		if ($tipo==6){$tiposaln="Baja x Dev";}
		if ($tipo==7){$tiposaln="Ent x Dev";}

		$nombre=$registro["nombre"];
        $codigo=$registro["codigo"];
        $nombrep=utf8_encode($registro["nombrep"]);		
        $fecha=$registro["fechahora"];		
        $cantidad=$registro["cantidad"];		

			if ($total==$bloque){
				$fila1=$fila1.'<table  sTYLE="table-layout:fixed" border="1" cellspacing="0" width="100%" height="220"> ';
			}

			$fila1=$fila1.'    <tr bgcolor="#CCCCCC" bordercolor="#FFFFFF">
				<td  width="10%" height="20" class="tdb" align="left" ><font face="Arial, Helvetica, sans-serif"size="8">'.$codigo.'</font></td>
				<td  width="20%" height="20" align="left"><font face="Arial, Helvetica, sans-serif"size="8">'.$nombrep.'</font></td>
				<td  width="10%" height="20" align="justify" ><font face="Arial, Helvetica, sans-serif"size="8">'.$cantidad.'</font></td>
				<td  width="30%" height="20" align="justify" ><font face="Arial, Helvetica, sans-serif"size="8">'.$nombre.'</font></td>
				<td  width="15%" height="20" align="justify" ><font face="Arial, Helvetica, sans-serif"size="8">'.$fecha.'</font></td>
				<td  width="15%" height="20" align="justify" ><font face="Arial, Helvetica, sans-serif"size="8">'.$tiposaln.'</font></td>
				

			  </tr>';

            $total=$total+1;
			$cuentadiez=$cuentadiez+1;
			if ($cuentadiez>=20){$cuentadiez=1;$bloque=$bloque+19;}
    	    $cierre=0;
            // verifica si es el ultimo registro total
			
			if ($total==$bloque){
				$fila1=$fila1.'</table>';
				
				$html4='<br><table border="1" cellspacing="0" width="100%">                     
				 
				
					<tr>
						<td width="10%" align="center"><strong></strong></td>
						<td width="10%" align="center"><strong></strong></td>
						<td width="10%" align="center"><strong></strong></td>
						<td width="10%" align="center"><strong></strong></td>
						<td width="10%" align="center"><strong></strong></td>
						<td width="10%" align="center"><strong></strong></td>
						<td width="10%" align="center"><strong></strong></td>
					    <td width="10%" align="center"><strong></strong></td>
						<td width="10%" align="center"><strong></strong></td>
						<td width="10%" align="center"><strong></strong></td>        
					</tr>
				

			</table>';
				
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
		 
					<tr>
						<td width="40%" align="center" colspan="4"><strong></strong></td>
						<td width="10%" align="center"><strong></strong></td>
						<td width="10%" align="center"><strong></strong></td>
						<td width="10%" align="center"><strong></strong></td>
					    <td width="10%" align="center"><strong></strong></td>
						<td width="10%" align="center"><strong></strong></td>
						<td width="10%" align="center"><strong></strong></td>        
					</tr>
		</table>';
	 
	 
	 $fila1=$fila1.$html4.$html5.$html6.$html7;
	}

}


$final=$html1.$html2.$html3.$fila1;
//echo $final;
$pdf->writeHTML($final, true, false, false, false, '');
$pdf->Output('RepBitacora.pdf', 'I');



?>