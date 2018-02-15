<div class="span3">
<div class="widget widget-2 primary widget-body-white">
    <div class="widget-head">
        <h4 class="heading glyphicons cogwheel"><i></i> Filtro</h4>
    </div>
    <div class="widget-body list list-2 fluid js-filters form-inline small">
        <ul>
          

          
        </ul>
    </div>
    <div class="widget-body list list-2">
        <ul>
          <li class="active"><a href="#" class="glyphicons link" onClick="repinventario();"><i></i>Procesar Reporte</a></li>  
<!--													<li><a href="" class="glyphicons link"><i></i>Show inactive products</a></li>-->
        </ul>
    </div>
</div>
</div>

    <script type="text/javascript" charset="utf-8">			


  function repinventario(){//generacion de reporte de entradas
    
    window.open("../reportes/productos.php");
		jAlert('Reporte de Productos Generado', 'Atención!!');
	

  }
	</script>