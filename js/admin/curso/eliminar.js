$(document).on('click', '#btn_eliminar', function(){
	var id = $(this).parent().parent().attr('id');

	var dato = {'id' : id}

	var eliminar = confirm('¿Está seguro que desea eliminarlo?');

	if(eliminar){

		$.post('cursos/display/eliminar.php', dato, function(respuesta){
		
			respuesta = JSON.parse(respuesta);

			console.log(respuesta);

			if(respuesta){
				alert('Curso eliminado');
				mostrar();
			}

		});

	}
	
	

});