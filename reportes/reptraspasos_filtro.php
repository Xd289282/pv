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
                        <input type="text" name="from" id="dateRangeFrom" class="input-mini" value="01/01/16" style="width: 85px;" />
                        <span class="add-on glyphicons calendar"><i></i></span>
                    </div>
                </div>
            </li>
            <li>
                <label>Termino:</label>
                <div class="right">
                    <div class="input-append">
                        <input type="text" name="to" id="dateRangeTo" class="input-mini" value="12/12/16" style="width: 85px;" />
                        <span class="add-on glyphicons calendar"><i></i></span>
                    </div>
                </div>
            </li>
            <?php
            if($mostrarmodelo>0){ ?>
                 <li>
                <label>Modelo:</label>
                <div class="right">
                <div class="controls"><input class="span12" id="modelo" name="modelo" type="text" maxlength="50" value=""  /></div>
                </div>
            </li>  
            <?php  
            }
           if($mostrartalla>0){ ?>
                 <li>
                <label>Talla:</label>
                <div class="right">
                <div class="controls"><input class="span12" id="talla" name="talla" type="text" maxlength="50" value=""  /></div>
                </div>
            </li>  
            <?php  
            }
            if($mostrarlote>0){ ?>
                 <li>
                <label>Lote:</label>
                <div class="right">
                <div class="controls"><input class="span12" id="lote" name="lote" type="text" maxlength="50" value=""  /></div>
                </div>
            </li>  
            <?php  
            }

            ?>

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
    var id=$("#sucursal").val();
    var modelo=$("#modelo").val();
    var talla=$("#talla").val();
    var lote=$("#lote").val();
    if(lote == null){
        lote="";
    };
    if(modelo == null){
        modelo="";
    };
    if(talla == null){
        talla="";
    };    
    
    window.open("../reportes/traspaso.php?fecha1="+fechaini+"&fecha2="+fechafin+"&id="+id+"&modelo="+modelo+"&talla="+talla+"&lote="+lote);
	jAlert('Reporte de Salida Generado', 'Atención!!');	

  }
	</script>