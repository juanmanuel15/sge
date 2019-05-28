
function mostrar(){
	$.get('cursos/display/mostrar.php', function(respuesta){
	

	respuesta = JSON.parse(respuesta);

	console.log(respuesta);
	//console.log(respuesta[0].horario[0]['HI']);
	var texto  = '';
	$('#tablaCurso').empty();
	var id, titulo, horario, profesor, id_resp, nombre_resp;
	
	for (var i = 0; i < respuesta.length; i++) {
		
		id =respuesta[i].curso['id'];
		titulo = respuesta[i].curso['titulo'];

		

		var sizeHorario = respuesta[i].horario.length
		horario = '';

		for (var j = 0; j < sizeHorario; j++) {
			HI = respuesta[i].horario[j]['HI'];
			HF = respuesta[i].horario[j]['HF'];
			fecha = respuesta[i].horario[j]['fecha'];
			lugar = respuesta[i].horario[j]['lugar'];

			if (j == sizeHorario-1){
				horario += fecha + " [ " + HI + "-" + HF + " ( " + lugar + ") ]. <br>";

			}else {
				horario += fecha + " [ " + HI + "-" + HF + " ( " + lugar + ") ], <br> ";
			}


		}


		var sizeProf = respuesta[i].prof.length;
		//console.log(respuesta[i].prof);
		var profesor = '';
		for (var k = 0; k < sizeProf; k++) {
			profesor += respuesta[i].prof[k]['nombre'];


			if (k == sizeProf-1){
				profesor += ". <br>";

			}else {
				profesor += ", <br> ";
			}



			


		}
		var sizeResp = respuesta[i].resp.length;
		var resp = '';

		for (var l = 0; l < sizeResp; l++) {
			resp += respuesta[i].resp[l]['nombre'];


			if (l == sizeResp-1){
				resp += ". <br>";

			}else {
				resp += ", <br> ";
			}
			
			
			
		}


		texto += `
			<tr id = ${id}>
				<td>${titulo}</td>
				<td>${profesor}</td>
				<td>${resp}</td>
				<td>${horario}</td>
				<td><span id = "btn_editar" class = "i_editar"><i class="fas fa-edit"></i></span></td>
				<td><span id = "btn_eliminar" class = "i_eliminar"><i class="fas fa-trash"></i></span>
			</tr>
		`;




		


	}


	$('#tablaCurso').append(texto);

	});
}