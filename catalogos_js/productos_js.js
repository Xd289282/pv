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
	var codigo=$("#codigo").val();	
	var nombrep=$("#nombrep").val();	
	//var descrip=$("#descrip").val();	
	var ultpcompra=$("#ultpcompra").val();	
	var pmostrador=$("#pmostrador").val();	
	var stock=$("#stock").val();	
	var iva=$("#iva").val();	
	var descuento=$("#descuento").val();	
	var marca=$("#marca").val();	
	var color=$("#color").val();
	var serie=$("#serie").val();
	var cvetip=$("#cvetip").val();
	var opcion=$("#opcion").val();		
	var talla1=0;		
	var talla2=0;		
	if ( $("#talla1") ) {talla1=$("#talla1").val();}
	if ( $("#talla2") ) {talla2=$("#talla2").val();}
	talla1=parseInt(talla1);
	talla2=parseInt(talla2);
	var modelo=$("#modelo").val();		
	var proveedor=$("#proveedor").val();

	if(talla1<=talla2){
		var tipo=$("input[name='radiotipo']:checked").val();
		$.post("../catalogos_sql/productos_sql.php",{codigo:codigo,nombrep:nombrep,ultpcompra:ultpcompra,pmostrador:pmostrador,stock:stock,iva:iva,descuento:descuento,marca:marca,color:color,serie:serie,opcion:opcion,tipo:tipo,talla1:talla1,talla2:talla2,modelo:modelo,proveedor:proveedor,cvetip:cvetip},function(resultado){  
			//alert (resultado);
			
			if(resultado==1){alert('Registro Almacenado');}
			if(resultado==2){alert('Registro Modificado');}
			if(resultado==3){alert('Registro Eliminado');}
			if(resultado==4){alert('Imposible Eliminar Producto con Inventario');}
			if(resultado==0){alert('Registro Almacenado');}
			if(resultado==5){alert('El codigo del Producto ya existe');}
			$(location).attr('href','../catalogos/productos.php');
			
			
		
							
		}
		);
	}else{
		alert("Valor de Talla Incorrecto, Talla 1 debe de ser menor o igual a Talla 2, Si no tiene Ingrese Tallas para continuar");
	}
	
}

function cancelar(){
	$(location).attr('href','../catalogos/productos.php'); 
}

function acciones(opcion,id){ // 1 agregar 2 modificar 3 eliminar

	$.post("../catalogos_sql/opciones.php",{id:id,opcion:opcion},function(resultado){  
				
		$(location).attr('href','../catalogos_add/productos_add.php'); 	
	
						
	}
	);


	
}

$(function()
{
	// validate signup form on keyup and submit
	$("#validaempresa").validate({
		rules: {
			codigo: "required",
			nombrep: "required",
			descrip: "required",
			ultpcompra: "required",
			pmostrador: "required",
			stock: "required",
			iva: "required",
			descuento: "required"

		},
		messages: {
			codigo: "Porfavor agregue el codigo del producto",
			nombrep: "Porfavor agregue el nombre del producto",
			descrip: "Porfavor agregue la descripción del producto",
			ultpcompra: "Porfavor agregue el precio de ultima compra",
			pmostrador: "Porfavor agregue el precio de mostrador",
			stock: "Porfavor agregue la cantidad de stock",
			iva: "Porfavor agregue el iva del producto",
			descuento: "Porfavor agregue % de descuento"
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

function guardaagrup(idunicoa,idunicop){

	$.post("../catalogos_sql/prod_ag_sql.php",{idunicoa:idunicoa,idunicop:idunicop},function(resultado){  
		
	}
	);
}

function calculaprecio(valor){
	var nvo=0;
	if (isNaN(valor)){
		nvo=0;
	}else{
		nvo=valor
	}
	
	nvo=(valor*1.5)+10;

	$("#pmostrador").val(nvo);

	.50+10
}


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