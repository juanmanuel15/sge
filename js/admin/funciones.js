function leerRequerimientos(){
	$.get('cursos/req.php', function(respuesta){
		$('#divReq').empty();
		var array_respuesta = JSON.parse(respuesta);
		var fila = `<tr id="tableReq">
                        <td class="col-lg-11 col-sm-11">                        	
							<select id="selectReq" name = "selectReq"  class="form-control">`;

		for (var i = 0; i < array_respuesta.length; i++) {
					fila += "<option value = \"" + array_respuesta[i].id+ "\">" + array_respuesta[i].nombre+ "</option>";
				}
		fila += `		</select>
					</td>
					<td class="col-lg-1 col-sm-1">
						<button class="btn" type="button" id="btn_quitarReq"><i class="fas fa-minus"></i>
	                </td>                        
                </tr> 
					`;
		$('#divReq').append(fila);
	});
}


function leerTipoActividad(){
	$.get('cursos/tactividad.php', function(respuesta){
		$('#divselect_tActividad').empty();
		var array_respuesta = JSON.parse(respuesta);

		var fila = `<select id="select_tActividad" name = "select_tActividad" class="form-control">`;

		for (var i = 0; i < array_respuesta.length; i++) {
					fila += "<option value = \"" + array_respuesta[i].id+ " \">" + array_respuesta[i].nombre+ "</option>";
				}
			fila += '</select>';

				$('#divselect_tActividad').append(fila);
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

		$('#divProfesor').empty();
		var array_respuesta = JSON.parse(respuesta);
		//console.log(array_respuesta[0].length);

		var fila = ` <tr id="tableProfesor">
                        <td class="col-lg-11 col-sm-11">
                            <select id="selectProfesor" name = "selectProfesor"  class="form-control">
                   `;

		for (var i = 0; i < array_respuesta[0].length; i++) {					
					fila += "<option value = \"" + array_respuesta[0][i].nCuenta+ "\">" + array_respuesta[0][i].nombre+ "</option>";
				}

				fila += `
						</select>
                   </td>
                   <td class="col-lg-1 col-sm-1" id="Ocultar_btnProfesor">
                        <button class="btn" type="button" id="btn_quitarProfesor"><i class="fas fa-minus"></i>
                    </td>                        
                </tr>  
				`;

		$('#divProfesor').append(fila);
	});
}


function leerResp(datos){
	//console.log(datos);
	$.post('cursos/resp.php', datos, function(respuesta){

		$('#divResponsable').empty();
		var array_respuesta = JSON.parse(respuesta);
		//console.log(array_respuesta[0].length);

		var fila = `
				<tr id="tableResponsable">
                    <td class="col-lg-11 col-sm-11">
                        <select id="selectResponsable" name = "selectResponsable"  class="form-control">
		`;

		for (var i = 0; i < array_respuesta[0].length; i++) {					
					fila += "<option value = \"" + array_respuesta[0][i].nCuenta+ "\">" + array_respuesta[0][i].nombre+ "</option>";
				}

		fila += `
			</select>
			</td>

            <td class="col-lg-1 col-sm-1">
            	<button class="btn" type="button" id="btn_quitarResponsable"><i class="fas fa-minus"></i>
            </td>                        
         </tr>  
		`;
		$('#divResponsable').append(fila);
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


	/* = `
		
		<div class="col-12 col-lg-12 d-flex justify-content-center">
            <span class = " btn btn-secondary mx-2 col-4" id="btn_CalcularHorario" > Calcular </span>
            <span class = " btn btn-secondary mx-2 col-4" id="btn_RegresarHorario" > Regresar </span>
        </div>
	`;

	$('#divBotonCalcularHorario').append(texto);*/

	btnCalcularHorario();



}


function btnCalcularHorario(){
	var texto  = ` 
		<div class="col-12 col-lg-12 d-flex justify-content-center">
            <span class = " btn btn-secondary mx-2 col-4" id="btn_CalcularHorario" > Verificar Lugar </span>
            <span class = " btn btn-primary mx-2 col-4" id="btn_RegresarHorario" > Regresar </span>
        </div>
     `;

     $('#divBotonCalcularHorario').append(texto);
}

function incluirCamposMaterial(){

	$('#divMaterial').empty();

	var texto = `
		<tr id="tableMaterial">
	        <td>
	            <input type="text" name="txt_material"  class="form-control">

	        </td>

	        <td>
	            <input type="number" name="txt_materialCantidad" id="txt_materialCantidad" class="form-control">

	        </td>

	        <td >
	            <button class="btn" type="button" id="btn_quitarMaterial"><i class="fas fa-minus"></i>
	        </td>                        
	    </tr>
	`;

	$('#divMaterial').append(texto);

}


function array(lectura){

	var  array= [];

	for (var i = 0; i < lectura.length; i++) {
			array.push(lectura[i].value);
		}

		return array;

}