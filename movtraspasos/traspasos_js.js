		$('#ventana1').click(function(e){			
				e.preventDefault();
				//themerGetCode();				
		        //var codigo=$('#codigo').val();
		        //if (isNaN(codigo)){codigo=0;}
		        //alert(codigo);
		        var codigo=$("#codigo").val();
		        var cantidad=$("#cantidad").val();
		        if (isNaN(cantidad)){cantidad=1;}
		       

		        if($("#codigo").val().length < 1){
		        	abrirbusqueda();
					
				}else{
					buscarcodigo(codigo,cantidad);
					/*
					var existe=buscarcodigo(codigo);
					//alert(existe);
					if(existe==0){// no se encontro el codigo mostrar ventana
						abrirbusqueda();
					}else{// se agrego producto actualizar listado
						$("#listadoventas").load("listadoventas.php");
				        $("#totales").load("totales.php");
					}
					*/
				}
		});

	function abrirbusqueda(){
		var videobox = bootbox.dialog('<iframe width="100%" height="100%" src="buscar.php" frameborder="0" ></iframe>', {       
				        label: 'Cerrar',
				        "callback": function cerr() {
				            //console.log("closing...");
				            //console.log(videobox);
				            $("#listadoventas").load("listadoventas.php");
				            $("#totales").load("totales.php");
				            videobox.find('iframe').remove();
				        }
				    }, {"backdrop" : true,
				        "keyboard": true,        
				            "show": true,
				            "class":"class-with-width"
				    }).addClass('ventana1');

	}
		
	function buscarcodigo(codigo,cantidad){
		
		$.post("buscarcodigo.php",{codigo:codigo,cantidad:cantidad},function(resultado){													
				$("#codigo").val('');
				//alert(resultado);

				if(resultado==0){// no se encontro el codigo mostrar ventana
						abrirbusqueda();
				}else{// se agrego producto actualizar listado
						$("#listadoventas").load("listadoventas.php");
				        $("#totales").load("totales.php");
				}
				
				
			}
		);
		
	}

	function deletearti(fila,idunicop,idunicoregi){
		$.post("guardaprod.php",{idunicop:idunicop,idunicoregi:idunicoregi},function(resultado){
				var id="#id_"+fila;
				$(id).html('<a href="#" onClick="addarti('+fila+','+idunicop+','+idunicoregi+');" title="seleccionar" class="btn-action glyphicons hand_up btn-success"><i></i></a>');	
			}
		);

		
		
	}

	function addarti(fila,idunicop,idunicoregi){	
		
		var objval="#numer_"+fila;
        var cantidad=$(objval).val();
        if (isNaN(cantidad)){cantidad=0;}
		

		$.post("guardaprod.php",{idunicop:idunicop,idunicoregi:idunicoregi,cantidad:cantidad},function(resultado){		
				//alert(resultado);
				var id="#id_"+fila;
				$(id).html('<a href="#" onClick="deletearti('+fila+','+idunicop+','+idunicoregi+');" title="seleccionar" class="btn-action glyphicons ok_2 btn-danger"><i></i></a>');
				
			}
		);

	
		
	}

	function deletearti(fila,idunicop,idunicoregi){
		$.post("guardaprod.php",{idunicop:idunicop,idunicoregi:idunicoregi},function(resultado){
				var id="#id_"+fila;
				$(id).html('<a href="#" onClick="addarti('+fila+','+idunicop+','+idunicoregi+');" title="seleccionar" class="btn-action glyphicons hand_up btn-success"><i></i></a>');
				
				
			}
		);

		
		
	}

	function delprodventa(idsesion,idunicoregi){
		jConfirm('¿Desea Eliminar el Producto?', 'Confirmar', function(resultado) {
                if (resultado){                	
                	
                    $.post("delprodventa.php",{idsesion:idsesion,idunicoregi:idunicoregi},function(resultado){
                        $("#listadoventas").load("listadoventas.php");
                        $("#totales").load("totales.php");
                      }
                    );
                    
                }


         });

	}


	$( "#selecantidad").click(function() {
		$.post("btonsele.php",{boton:0},function(resultado){
          		$("#selecantidad").css("background-color", "green");		   
          		$("#selecodigo").css("background-color", "#da4c4c");   
          		$("#calc").load("calc.php");       		
            }
        );

		  
	});

	$( "#selecodigo").click(function() {
		$.post("btonsele.php",{boton:1},function(resultado){
          		$("#selecodigo").css("background-color", "green");		   
          		$("#selecantidad").css("background-color", "#da4c4c");          		
          		$("#calc").load("calc.php");       		
            }
        );

		  
	});

	
	function calc(boton,valor){
		if(boton==0){//cantidad
			var actual=$('#cantidad').val();
			if (isNaN(actual)){actual=0;}
			actual=actual+valor;
			$("#cantidad").val(actual);
		}else{//codigo
			var actual=$('#codigo').val();
			if (isNaN(actual)){actual=0;}
			actual=actual+valor;
			$("#codigo").val(actual);
		}
		
	}

	function calcb(boton){		
		$('#cantidad').val('');
		$("#codigo").val('');
		if(boton==0){
			$("#cantidad").focus();
		}else{
			$("#codigo").focus();	
		}
		
	}

	function fenter(){						
		$("#ventana1").trigger("click");
	}

	var videobox2;

	$('#ventana2').click(function(e){			
			e.preventDefault();
			//themerGetCode();
			videobox2 = bootbox.dialog('<iframe width="100%" height="100%" src="cobrar.php" frameborder="0" ></iframe>', {       
				        label: 'Generar Traspaso',
				        "callback": function cerr2() {
				            //console.log("closing...");
				            //console.log(videobox);
				            //$("#listadoventas").load("listadoventas.php");
				            //$("#totales").load("totales.php");
				            generatraspaso();
				            videobox2.find('iframe').remove();
				        }
				    }, {"backdrop" : true,
				        "keyboard": true,        
				            "show": true,
				            "class":"class-with-width"
				    }).addClass('ventana1');
		});



	function generatraspaso(){		
		
		var sucursal=$("#sucursal").val();
		if (isNaN(sucursal)){sucursal=0;}
		if(sucursal>0){

			$.post("generatraspaso.php",{sucursal:sucursal},function(resultado){
          			if(resultado==0){
          				alert("Seleccione Productos a Traspasar");
          			}else{
          				if(resultado==1){
          					$("#listadoventas").load("listadoventas.php");
				            $("#totales").load("totales.php");
          					alert("Traspaso Realizado");		
          				}
          			}         			
	          		
	            }
	        );
		}else{
			alert("Seleccione Sucursal a Traspasar");
		}
	}

	$( "#generatraspaso" ).click(function() {
	  	generatraspaso();
	});
	