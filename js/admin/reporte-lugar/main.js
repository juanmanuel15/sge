$(document).ready(function(){
	leer();
});

//
$(document).on('click', '#btn_ver', function(){
	var id = $(this).parent().parent().attr('id');
	

	
});



function leer(){
	$.get('reporte-lugar/leer.php', function(respuesta){
		respuesta = JSON.parse(respuesta);
		console.log(respuesta);

		var texto = '';
 
		for (var i = 0; i < respuesta.length; i++) {
			id = respuesta[i].id;
			nombre = respuesta[i].nombre;
			lugares = respuesta[i].lugares;

			texto += `
				<tr id = "${id}">
					<td>${nombre}</td>
					<td><span id = "btn_ver"><i class="fas fa-eye"></i></span></td>					
				</tr>	
			`; 

		}


		$('#tablaReporteLugar').append(texto);



	});
}

