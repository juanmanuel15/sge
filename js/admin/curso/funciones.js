function leerRequerimientos(req){
	
	$.get('cursos/req.php', function(respuesta){
		$('#divReq').empty();
		var array_respuesta = JSON.parse(respuesta);

		if(typeof req ==  'undefined'){
			valor_final = 1;
			l = valor_final;
			
		}else {
			valor_final = req.length;
			l = valor_final;
		}

		for(x = 0; x < valor_final; x++){
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
			
			if(typeof req !==  'undefined'){
				$('#selectReq').val(req[x].id);
			}
		}
	});
}


function leerTipoActividad(id){

	
	$.get('cursos/tactividad.php', function(respuesta){
		$('#divselect_tActividad').empty();
		var array_respuesta = JSON.parse(respuesta);

		var fila = `<select id="select_tActividad" name = "select_tActividad" class="form-control">`;

		for (var i = 0; i < array_respuesta.length; i++) {
					fila += "<option value = \"" + array_respuesta[i].id+ "\">" + array_respuesta[i].nombre+ "</option>";
				}
			fila += '</select>';

				$('#divselect_tActividad').append(fila);

				if(id != ''){
					$('#select_tActividad').val(id);
				}
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


function leerProfesor(datos, accion, prof){

	$.post('cursos/profesor.php', datos, function(respuesta){

		$('#divProfesor').empty();
		var array_respuesta = JSON.parse(respuesta);
		//console.log(array_respuesta[0].length);

		var fila = ` <tr id="tableProfesor">
                        <td class="col-lg-11 col-sm-11">
                            <select id="selectProfesor" name = "selectProfesor"  class="form-control">
                   `;

				   console.log(valor_final);
		for (var i = 0; i < array_respuesta[0].length; i++) {					
			fila += `<option value = "${array_respuesta[0][i].nCuenta}">${array_respuesta[0][i].nombre}</option>`;
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

	btnCalcularHorario();



}


function btnCalcularHorario(){
	var texto  = ` 
		<div class="col-12 col-lg-12 d-flex justify-content-center">
            <span class = " btn btn-secondary mx-2 col-4" id="btn_CalcularHorario" > Verificar Lugar </span>
            <span class = " btn btn-primary mx-2 col-4" id="btn_RegresarCalcularHorario" > Regresar </span>
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

function radioStatus(estado,material){
	//console.log(estado);
	if(estado == 1){
		$('#cbox1').prop('checked', true); //true/false: Esta habilitado/deshabilitado el radioButton
		//incluirCamposMaterial(material.length);
		

		$('#divMaterial').empty();
		var texto ='';
		for(x = 0; x<material.length; x++){
			texto += `
				<tr id="tableMaterial" id_material = "${material[x].id}">
					<td >
						<input type="text" name="txt_material"  class="form-control" value = "${material[x].nombre}">
		
					</td>
		
					<td>
						<input type="number" name="txt_materialCantidad" id="txt_materialCantidad" class="form-control" value = "${material[x].cantidad}">
		
					</td>
		
					<td >
						<button class="btn" type="button" id="btn_quitarMaterial"><i class="fas fa-minus"></i>
					</td>                        
				</tr>
			`;
		}
		m = material.length;
		$('#divMaterial').append(texto);
		$('#divMaterialConf').show();
	} 


	
	if(estado == 0){
		$('#cbox2').prop('checked', true); 
		$('#divMaterialConf').hide();
	}
}

function reiniciarValoresEditar(){
	i = 1;
	k = 1;
	j = 1;
	l = 1;
	m = 1;

	$('#divDatosCurso').show();
	$('#divMaterialConf').hide();
	$('#divProfesorConf').hide();
	$('#divRespConf').hide();
	$('#divHorarioConf').hide();
	$('#divConfirmarCurso').hide();
	$('#divBotonesHorario').hide();

	//$('#divMaterialConf').empty();
	//incluirCamposMaterial();



	
	selectHorario();
	leerRequerimientos();
	leerTipoActividad();
	leerHora();
	leerFecha();
	incluirCamposMaterial();
}

function btn_AceptarDatosGenerales_Editar(){
	
}

function confInicialesEditar(){
	$('#divBotonCalcularHorario').hide();
	$('#divBotonesHorario').show();

}

function horarioSeleccionadoEditar(horario){
	$('#tableBodyHorario').empty();
	texto = '';

	for(x = 0; x<horario.length; x++){
		texto += `
			<tr class = "text-center">
				<td>
					<input name="selectFecha" value="${horario[x].fecha}" disabled="" class="form-control align-center">
				</td>			
				<td>
					<input name="selectHoraI" value="${horario[x].HI}" disabled="" class="form-control align-center ">
				</td>
				<td>
					<input name="selectHoraF" value="${horario[x].HF}" disabled="" class="form-control align-center">
				</td>
				<td>
					<select class="form-control" name="selectLugar" id="selectLugar" disabled="">
						<option value = "${horario
							[x].idLugar}">${horario[x].nombreLugar}</option>
					</select>
				</td>
			</tr>		
		`;		
	}

	$('#tableBodyHorario').append(texto);

}


function datosHorario(){
	
	var obj_fecha = $('input[name = "selectFecha"]');
	var obj_horaI = $('input[name = "selectHoraI"]');
	var obj_horaF = $('input[name = "selectHoraF"]');
	var obj_lugar = $('select[name = "selectLugar"]');


	var fecha = array(obj_fecha);
	var horaI = array(obj_horaI);
	var horaF = array(obj_horaF);
	var lugar = array(obj_lugar);


	return datos = {
		'fecha': fecha,
		'horaI' : horaI,
		'horaF': horaF
	};

	
}

function leerProfesorEditar(datos, prof){
	j = prof.length;
	$.post('cursos/profesor.php', datos, function(respuesta){

		$('#divProfesor').empty();
		var array_respuesta = JSON.parse(respuesta);
		
		//console.log(prof.length);

		for(y = 0; y<prof.length; y++){

			
			var fila  = ` <tr id="tableProfesor">
					<td class="col-lg-11 col-sm-11">
						<select id="selectProfesor" name = "selectProfesor"  class="form-control">
				`;			
			
				for (var i = 0; i < array_respuesta[0].length; i++) {					
					fila += `<option value = "${array_respuesta[0][i].nCuenta}">${array_respuesta[0][i].nombre}</option>`;
				}


				for(x = 0; x < prof.length; x++){
					
					if(x == y){
						fila += `<option value = "${prof[x].cuenta}" selected>${prof[x].nombre + " " + prof[x].apellidoP + " " +prof[x].apellidoM}</option>`;
					}else {
						fila += `<option value = "${prof[x].cuenta}" >${prof[x].nombre + " " + prof[x].apellidoP + " " +prof[x].apellidoM}</option>`;
					}
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

		}
		
	});
	
}



function leerRespEditar(datos, resp){
	i = resp.length;
	$.post('cursos/resp.php', datos, function(respuesta){

		$('#divResponsable').empty();
		var array_respuesta = JSON.parse(respuesta);
		
		for(var y= 0; y < resp.length; y++){
		
			var fila = `
					<tr id="tableResponsable">
						<td class="col-lg-11 col-sm-11">
							<select id="selectResponsable" name = "selectResponsable"  class="form-control">
			`;

			for (var i = 0; i < array_respuesta[0].length; i++) {					
						fila += "<option value = \"" + array_respuesta[0][i].nCuenta+ "\">" + array_respuesta[0][i].nombre+ "</option>";
					}

			for(x = 0; x < resp.length; x++){
				
				if(x == y){
					fila += `<option value = "${resp[x].cuenta}" selected>${resp[x].nombre + " " + resp[x].apellidoP + " " +resp[x].apellidoM}</option>`;
				}else {
					fila += `<option value = "${resp[x].cuenta}" >${resp[x].nombre + " " + resp[x].apellidoP + " " +resp[x].apellidoM}</option>`;
				}
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
		}
	});
}


