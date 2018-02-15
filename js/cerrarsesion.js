
function cerrarsesion(nivel){
	

	if (nivel==1){
		$.post("./conexion/cerrarsesion.php",{},function(resultado){ 			
				$(location).attr('href',resultado);
			}
		);	
	}else{
		$.post("../conexion/cerrarsesion.php",{},function(resultado){ 			
				$(location).attr('href',resultado);
			}
		);	
	}
	
}