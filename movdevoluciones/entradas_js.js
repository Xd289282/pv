$.validator.setDefaults(
{
	submitHandler: function() {
		
		 acciones_sql();
	},
	showErrors: function(map, list)
	{
		this.currentElements.parents('label:first, .controls:first').find('.error').remove();
		this.currentElements.parents('.control-group:first').removeClass('error');

		$.each(list, function(index, error)
		{
			var ee = $(error.element);
			var eep = ee.parents('label:first').length ? ee.parents('label:first') : ee.parents('.controls:first');

			ee.parents('.control-group:first').addClass('error');
			eep.find('.error').remove();
			eep.append('<p class="error help-block"><span class="label label-important">' + error.message + '</span></p>');
		});
		//refreshScrollers();
	}
});

	function acciones_sql(){	
	var id=$("#id").val();			
	var codigo=$("#codigo").val();
	var fechae=$("#datepicker").val();	
	var cantidad=$("#cantidad").val();	
	var pcompra=$("#precioc").val();
	var folio=$("#folio").val();	
	var pmostrador=$("#preciom").val();
	var modelo=$("#modelo").val();
    var talla=$("#talla").val();
    var lote=$("#lote").val();
    var fcaducidad=$("#datepicker2").val();
	var opcion=$("#opcion").val();

	$.post("entradas_sql.php",{id:id,codigo:codigo,fechae:fechae,cantidad:cantidad,pcompra:pcompra,folio:folio,pmostrador:pmostrador,opcion:opcion,modelo:modelo,talla:talla,lote:lote,fcaducidad:fcaducidad},function(resultado){
		//alert(resultado);
						
		if(resultado==1){alert('Registro Almacenado');}
		if(resultado==2){alert('Registro Modificado');}
		if(resultado==3){alert('Registro Eliminado');}
		if(resultado==0){alert('Registro Almacenado');}
		if(resultado==4){alert('Codigo de Producto No existe');}
		$(location).attr('href','moventradas.php');
	}
	);
	}



	function cancelar(){
	$(location).attr('href','moventradas.php');
     }

function acciones(opcion,id){ // 1 agregar 2 modificar 3 eliminar
	$.post("opciones.php",{id:id,opcion:opcion},function(resultado){
		$(location).attr('href','entradas_add.php');

	}
	);



}

$(function()
{
	// validate signup form on keyup and submit
	$("#validaempresa").validate({
		rules: {
			codigo: "required",
			dateRangeFrom: "required",
			//modelo: "required",
			talla: "required",
			lote: "required",
			cantidad: "required",
			precioc: "required",
			folio: "required",
			preciom: "required"

/*aqui te falta hacer las validaciones*/

		},
		messages: {
			codigo: "Porfavor agregue el nombre del producto",
			dateRangeFrom: "Porfavor agregue la fecha de entrada",
			//modelo:"Porfavor agregue el modelo del producto",
			talla: "Porfavor agrege la talla del producto",
			lote: "Porfavor agregue el lote del producto",
			cantidad: "Porfavor agregue la cantidad",
			precioc: "Porfavor agregue el precio de compra",
			folio: "Porfavor agregue el folio",
			preciom: "Porfavor agregue el precio de mostrador",

		}
	});

	// propose username by combining first- and lastname
	$("#username").focus(function() {
		var firstname = $("#firstname").val();
		var lastname = $("#lastname").val();
		if(firstname && lastname && !this.value) {
			this.value = firstname + "." + lastname;
		}
	});

	//code to hide topic selection, disable for demo
	var newsletter = $("#newsletter");
	// newsletter topics are optional, hide at first
	var inital = newsletter.is(":checked");
	var topics = $("#newsletter_topics")[inital ? "removeClass" : "addClass"]("gray");
	var topicInputs = topics.find("input").attr("disabled", !inital);
	// show when newsletter is checked
	newsletter.click(function() {
		topics[this.checked ? "removeClass" : "addClass"]("gray");
		topicInputs.attr("disabled", !this.checked);
	});
});




/*
firstname: "required",
			lastname: "required",
			username: {
				required: true,
				minlength: 2
			},
			password: {
				required: true,
				minlength: 5
			},
			confirm_password: {
				required: true,
				minlength: 5,
				equalTo: "#password"
			},
			email: {
				required: true,
				email: true
			},
			topic: {
				required: "#newsletter:checked",
				minlength: 2
			},
			agree: "required"


			username: {
				required: "Please enter a username",
				minlength: "Your username must consist of at least 2 characters"
			},
			password: {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long"
			},
			confirm_password: {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long",
				equalTo: "Please enter the same password as above"
			},
			email: "Please enter a valid email address",
*/

function btnbuscar(){
	
	var noticket=$('#noticket').val();
	if (isNaN(noticket)){noticket=0;}		        
		       
	if($("#noticket").val().length < 1){
		abrirbusqueda();
	}else{					
		buscarcodigo(noticket);					
	}
}

function btnlimpiar(){	
	$('#noticket').val("");
	$('#descrip').val("");
	$('#noticket').focus();
}

/*
$('#ventana1').click(function(e){			
				e.preventDefault();
				//themerGetCode();				
		        var codigo=$('#codigo').val();
		        if (isNaN(codigo)){codigo=0;}		        
		       
		        if($("#codigo").val().length < 1){
		        	abrirbusqueda();
					
				}else{					
					buscarcodigo(codigo);					
				}
		});
*/
function abrirbusqueda(){
		
		var videobox = bootbox.dialog('<iframe width="100%" height="100%" src="buscar.php" frameborder="0" ></iframe>', {       
				        label: 'Seleccionar Producto',
				        "callback": function cerr() {
				            //console.log("closing...");
				            //console.log(videobox);
				            //$("#descripciones").load("cargabuscador.php");
				           $("#descripciones").load("cargabuscador.php");
				            videobox.find('iframe').remove();
				        }
				    }, {"backdrop" : true,
				        "keyboard": true,        
				            "show": true,
				            "class":"class-with-width"
				    }).addClass('ventana1');

	}
		
	// function buscarcodigo(noticket){
		
	// 	$.post("buscarcodigo.php",{noticket:noticket},function(resultado){	
	// 			if(resultado==0){// no se encontro el codigo mostrar ventana
	// 					abrirbusqueda();
	// 			}else{// se agrego producto actualizar listado
	// 					$("#descripciones").load("cargabuscador.php");
	// 			}
				
				
	// 		}
	// 	);
		
	// }
	function addarti(fila,ticket,idunicodetsal){	
		//alert(fila);
		$.post("guardaprod.php",{ticket:ticket,idunicodetsal:idunicodetsal},function(resultado){		
				//alert(resultado);
				var id="#id_"+fila;
				$(id).html('<a href="#" onClick="deletearti('+fila+','+ticket+','+idunicodetsal+');" title="seleccionar" class="btn-action glyphicons ok_2 btn-danger"><i></i></a>');
				
			}
		);

	
		
	}

	function deletearti(fila,ticket,idunicodetsal){
		$.post("guardaprod.php",{ticket:ticket,idunicodetsal:idunicodetsal},function(resultado){
				var id="#id_"+fila;
				$(id).html('<a href="#" onClick="addarti('+fila+','+ticket+','+idunicodetsal+');" title="seleccionar" class="btn-action glyphicons hand_up btn-success"><i></i></a>');
				
				
			}
		);

		
		
	}