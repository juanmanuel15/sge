function leerRequerimientos(){
	$.get('cursos/req.php', function(respuesta){
		$('#selectReq').empty();
		var array_respuesta = JSON.parse(respuesta);
		var fila = '';

		for (var i = 0; i < array_respuesta.length; i++) {
					fila += "<option value = \"" + array_respuesta[i].id+ "\">" + array_respuesta[i].nombre+ "</option>";
				}

		$('#selectReq').append(fila);
	});
}


function leerTipoActividad(){
	$.get('cursos/tactividad.php', function(respuesta){
		$('#select_tActividad').empty();
		var array_respuesta = JSON.parse(respuesta);

		var fila = '';

		for (var i = 0; i < array_respuesta.length; i++) {
					fila += "<option value = \"" + array_respuesta[i].id+ " \">" + array_respuesta[i].nombre+ "</option>";
				}

				$('#select_tActividad').append(fila);
	});
}