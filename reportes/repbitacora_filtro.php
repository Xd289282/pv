<div class="span3">
<div class="widget widget-2 primary widget-body-white">
    <div class="widget-head">
        <h4 class="heading glyphicons cogwheel"><i></i> Filtro</h4>
    </div>
    <div class="widget-body list list-2 fluid js-filters form-inline small">
        <ul>

            <?php
            include "../conexion/conexion.php";
            $tipouser=$_SESSION["pvtacommand_tipouser"];//0 vendedor 1 supervisor 2 administrador 3 creador de empresa
            $idunicoe=$_SESSION["pvtacommand_idunicoe"];// id unico de la empresa del usuario

            if($tipouser==3){
                $idregistro=$_SESSION["pvtacommand_idregistro"];
            ?>
            <li>
                <label>Sucursal:</label>
                <div class="right">
                    <select class="selectpicker span6" data-style="btn-success" id="sucursal" name="sucursal">
                    <?php
                    $consulta="select a.idunicos,a.nombre from sucursal as a left join empresa as b on a.idunicoe=b.idunicoe where b.idregistro='$idregistro' ";    
                    $recordset = mysqli_query($link,$consulta);
                    while($registro = mysqli_fetch_array($recordset)){
                        $idunicos=$registro["idunicos"];
                        $nombre=$registro["nombre"];
                        echo'<option value="'.$idunicos.'"/>'.$nombre;
                    }
                    ?>                                      
                    </select>
                </div>
            </li>

            <?php    
            }
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

            <li>
                <label>Inicio:</label>
                <div class="right">
                    <div class="input-append">
                        <input type="text" name="from" id="dateRangeFrom" class="input-mini" value="01/01/17" style="width: 85px;" />
                        <span class="add-on glyphicons calendar"><i></i></span>
                    </div>
                </div>
            </li>
            <li>
                <label>Termino:</label>
                <div class="right">
                    <div class="input-append">
                        <input type="text" name="to" id="dateRangeTo" class="input-mini" value="12/12/17" style="width: 85px;" />
                        <span class="add-on glyphicons calendar"><i></i></span>
                    </div>
                </div>
            </li>
            <li>
                <label>Movimiento:</label>
                <div class="right">
                    <select class="selectpicker span6" data-style="btn-success" id="tipom" name="tipom">
                    <?php

                        $tipo="0";
                        $movimiento="Alta";
                        echo'<option value="'.$tipo.'"/>'.$movimiento;
                        $tipo="1";
                        $movimiento="Modificacion";
                        echo'<option value="'.$tipo.'"/>'.$movimiento;
                        $tipo="2";
                        $movimiento="Entrada";
                        echo'<option value="'.$tipo.'"/>'.$movimiento;
                        $tipo="3";
                        $movimiento="SAlida";
                        echo'<option value="'.$tipo.'"/>'.$movimiento;
                        $tipo="4";
                        $movimiento="Traspaso";
                        echo'<option value="'.$tipo.'"/>'.$movimiento;
                        $tipo="5";
                        $movimiento="Baja";
                        echo'<option value="'.$tipo.'"/>'.$movimiento;
                        $tipo="6";
                        $movimiento="Baja x devolucion";
                        echo'<option value="'.$tipo.'"/>'.$movimiento;
                        $tipo="7";
                        $movimiento="Entrada x Devolucion";
                        echo'<option value="'.$tipo.'"/>'.$movimiento;


                    ?>                                      
                    </select>
                </div>
            </li>  
        </ul>
    </div>
    <div class="widget-body list list-2">
        <ul>
            <li class="active"><a href="#" class="glyphicons link" onClick="repsalidas();"><i></i>Procesar Reporte</a></li>
<!--													<li><a href="" class="glyphicons link"><i></i>Show inactive products</a></li>-->
        </ul>
    </div>
</div>
</div>

    <script type="text/javascript" charset="utf-8">			


  function repsalidas(){//generacion de reporte de entradas
    var fechaini=$("#dateRangeFrom").val();
    var fechafin=$("#dateRangeTo").val();
    var tipo=$("#tipom").val();
 
   
    window.open("../reportes/bitacora.php?fecha1="+fechaini+"&fecha2="+fechafin+"&tipo="+tipo);
	jAlert('Reporte de Bitacora Generado', 'Atención!!');
	

  }
	</script>