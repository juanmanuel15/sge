$(document).on('click', '#btn_editar', function(){

	var id = $(this).parent().parent().attr('id');

	var dato =  {
		'id' : id
	};


	$.post('cursos/editar/mostrar.php', dato, function(respuesta){
		console.log(respuesta);
	});


});