function leer_actividades(usuario){
	var usuario = {'user': usuario};
	console.log(usuario);
	$.post('actividades/leer.php',usuario, function(respuesta){
		respuesta = JSON.parse(respuesta);
		if(!respuesta.serv){
			if(!respuesta.conn){
				if(respuesta.success != false){
					console.log(curso = respuesta.success);
					var texto = '';
					for(var i = 0; i < curso.cursos.length; i++){
						texto += `
						<tr>
							<td>${i+1}</td>
							<td>${curso.cursos[i]['titulo']}</td>
							<td>
							${curso.relacion[i]['inscritos']}/${curso.relacion[i]['lugares']}
							</td>	
							<td><span class="i_asistencia" ><i class="fas fa-book-open" id="btn_asistencia" valor = "${curso.cursos[i].id_curso}"> </i></span>
							</td>
							<td><span id="btn_generar" class="i_mostrar"><a href="lista.php?id=${curso.cursos[i].id_curso}"><i class="fas fa-share"></i></a></span></td>
						</tr>
						`;
					}


					$('#table_actividadesProfesor').append(texto);
				}
			}
		}
	});
}

function asistencia_Alumnos(curso){
	curso = {'curso': curso};
	$.post('actividades/inscritos.php', curso,  function(respuesta){
		var respuesta = JSON.parde(respuesta);
		console.log(respuesta);
	});
}