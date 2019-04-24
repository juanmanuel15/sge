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

function leerHora(){
	$.get('cursos/hora.php', function(respuesta){

		$('#selectHoraI').empty();
		$('#selectHoraF').empty();

		var array_respuesta = JSON.parse(respuesta);

		var fila = '';

		for (var i = 0; i < array_respuesta.length; i++) {
					fila += "<option value = \"" + array_respuesta[i].nombre+ "\">" + array_respuesta[i].nombre+ "</option>";
				}

		$('#selectHoraI').append(fila);
		$('#selectHoraF').append(fila);
	});
}

function leerFecha(){
	$.get('cursos/fecha.php', function(respuesta){
		$('#selectFecha').empty();
		var array_respuesta = JSON.parse(respuesta);

		var fila = '';

		for (var i = 0; i < array_respuesta.length; i++) {
					fila += "<option value = \"" + array_respuesta[i].nombre+ "\">" + array_respuesta[i].nombre+ "</option>";
				}

		$('#selectFecha').append(fila);
	});
}


function leerProfesor(datos){
	//console.log(datos);
	$.post('cursos/profesor.php', datos, function(respuesta){

		$('#selectProfesor').empty();
		var array_respuesta = JSON.parse(respuesta);
		//console.log(array_respuesta[0].length);

		var fila = '';

		for (var i = 0; i < array_respuesta[0].length; i++) {					
					fila += "<option value = \"" + array_respuesta[0][i].nCuenta+ "\">" + array_respuesta[0][i].nombre+ "</option>";
				}

		$('#selectProfesor').append(fila);
	});
}


function leerResp(datos){
	//console.log(datos);
	$.post('cursos/resp.php', datos, function(respuesta){

		$('#selectResponsable').empty();
		var array_respuesta = JSON.parse(respuesta);
		//console.log(array_respuesta[0].length);

		var fila = '';

		for (var i = 0; i < array_respuesta[0].length; i++) {					
					fila += "<option value = \"" + array_respuesta[0][i].nCuenta+ "\">" + array_respuesta[0][i].nombre+ "</option>";
				}

		$('#selectResponsable').append(fila);
	});
}

function selectHorario(){
	$('#divBotonCalcularHorario').empty();
	$('#tableBodyHorario').empty();
	$('#tableHeadHorario').empty();
	$('#msg_error_horario').empty();


	var texto = `
         <button class="btn" type="button" id="btn_agregarHorario"><i class="fas fa-plus"></i>
	`;


	$('#div_btn_agregarHorario').append(texto);

	 texto = `
            <tr class="text-center">
                <th>Fecha</th>
                <th>Hora de Inicio</th>
                <th>Hora de Termino</th>
                <th>Eliminar</th>    
            </tr>
	`;

	$('#tableHeadHorario').append(texto);

	texto = `
		<tr id="tableHorario">
         	<td>
	            <select id="selectFecha" class="form-control" name="selectFecha">                                        
	            </select>                           
	        </td>
	        <td>
	            <select id="selectHoraI" class="form-control" name="selectHoraI">
	            </select> 
	        </td>
	        <td>
	            <select id="selectHoraF" class="form-control" name="selectHoraF">                            
	            </select>
	        </td>

	        <td>
	            <button class="btn" type="button" id="btn_quitarHorario"><i class="fas fa-minus"></i>
	        </td>

	    </tr>

	`;



	$('#tableBodyHorario').append(texto);


	texto = `
		
		<div class="col-12 col-lg-12 d-flex justify-content-center">
            <span class="btn btn-secondary mx-2 col-4" id="btn_CalcularHorario">Calcular</span>
        </div>
	`;

	$('#divBotonCalcularHorario').append(texto);



}


function array(lectura){

	var  array= [];

	for (var i = 0; i < lectura.length; i++) {
			array.push(lectura[i].value);
		}

		return array;

}











