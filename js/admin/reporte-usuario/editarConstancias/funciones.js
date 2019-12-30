function vacio(campo){

	if(campo.val() == ''){
		campo.addClass('input-vacio');
		respuesta = true;
	}else{
		campo.removeClass('input-vacio');
		respuesta = false;
	}

	return respuesta;

}

function vaciar(campo){
	campo.val('');
}

function quitarClases(){
	$('#edit_nombreAsistente').removeClass('input-vacio');
	$('#edit_apellidoPAsistente').removeClass('input-vacio');
	$('#edit_apellidoMAsistente').removeClass('input-vacio');
}