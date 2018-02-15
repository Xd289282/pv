<div class="span3">
<div class="widget widget-2 primary widget-body-white">
    <div class="widget-head">
        <h4 class="heading glyphicons cogwheel"><i></i> Utilidad</h4>
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
                <label>Porcentaje de Utilidad:</label>
                <div class="right">
                <div class="controls"><input class="span12" id="utilidad" name="utilidad" type="text" maxlength="2" value="" /></div>
                </div>
            </li>  




            <li class="active"><a href="#" class="glyphicons link" onClick="utlidadfun();"><i></i>Procesar Cambio</a></li>
<!--                          <li><a href="" class="glyphicons link"><i></i>Show inactive products</a></li>-->
        </ul>
    </div>
    <div class="widget-body list list-2">
        
    </div>
</div>
</div>

    <script type="text/javascript" charset="utf-8">			


  function utlidadfun(){//generacion de reporte de entradas
    var utilidad=$("#utilidad").val();    
     if (utilidad>0){


       $.post("utilidad_sql.php",{utilidad:utilidad},function(resultado){
        if(resultado==1){alert('Registros Almacenados');}

    }
    );
   }else{alert ('Valor Invalido');}

  }
	</script>