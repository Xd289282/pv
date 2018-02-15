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
	var empresa=$("#empresa").val();
	var agrupador=$("#agrupador").val();
	var opcion=$("#opcion").val();
	$.post("../catalogos_sql/agrupadores_sql.php",{empresa:empresa,agrupador:agrupador,opcion:opcion},function(resultado){
		if(resultado==1){alert('Registro Almacenado');}
		if(resultado==2){alert('Registro Modificado');}
		if(resultado==3){alert('Registro Eliminado');}
		if(resultado==0){alert('Registro Almacenado');}
		$(location).attr('href','../catalogos/agrupadores.php');
	}
	);
}

function cancelar(){
	$(location).attr('href','../catalogos/agrupadores.php');
}

function acciones(opcion,id){ // 1 agregar 2 modificar 3 eliminar
	$.post("../catalogos_sql/opciones.php",{id:id,opcion:opcion},function(resultado){
		$(location).attr('href','../catalogos_add/agrupadores_add.php');

	}
	);



}

$(function()
{
	// validate signup form on keyup and submit
	$("#validaempresa").validate({
		rules: {
			nombre: "required",
			rfc: "required",
			calle: "required",
			colonia: "required",
			estado: "required",
			municipio: "required",
			telefono: "required"


		},
		messages: {
			nombre: "Porfavor agregue el nombre de la sucursal",
			rfc: "Porfavor agregue el rfc de la sucursal",
			calle: "Porfavor agregue la calle",
			colonia: "Porfavor agregue la colonia",
			estado: "Porfavor agregue el estado",
			municipio: "Porfavor agregue el municipio",
			telefono: "Porfavor agregue el telefono"
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
