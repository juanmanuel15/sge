$(document).ready(function(){
	
	var i=1;
	var j=1;
	var k =1;
	var l = 1;
	var m = 1;





	leer();
	
	$('#btn_agregar').on('click', function(){
		selectores();
		quitarClases();
		document.getElementById("formCurso").reset();

	});

	$('#btn_cancelar').on('click', function(){
	});


	$('#formCurso').submit(function(e){
		e.preventDefault();
		quitarClases();		

		var obj_titulo = $('#txt_titulo');
		var obj_requisitos = $('#txt_requisitos');		
		var obj_dirigido = $('#txt_dirigido');
		var obj_description = $('#txt_description');
		var obj_cantidad = $('#txt_cantidad');
		


		var titulo = valor(obj_titulo);
		var requisitos = valor(obj_requisitos);
		var description= valor(obj_description);
		var dirigido= valor(obj_dirigido);
		var cantidad = valor(obj_cantidad);

		vacio(obj_titulo);
		vacio(obj_requisitos);
		vacio(obj_description);
		vacio(obj_dirigido);
		vacio(obj_cantidad);



	

		if(vacio(obj_titulo) || vacio(obj_description) || vacio(obj_requisitos) || vacio(obj_dirigido) || vacio(obj_cantidad)){
			//Procedimiento cuando estan vacíos
			
			$('#divMensaje').addClass("mensaje-error");
			$('#divMensaje').append("<label>Campos vacíos</label>");

		}else {

			var obj_profesor = $('select[name = "selectProfesor"]');
			var obj_responsable = $('select[name = "selectResponsable"]');
			var obj_fecha = $('input[name = "selectFecha"]');
			var obj_horaI = $('input[name = "selectHoraI"]');
			var obj_horaF = $('input[name = "selectHoraF"]');
			var obj_lugar = $('select[name = "selectLugar"]');
			var obj_req = $('select[name = "selectReq"]');
			var obj_tactividad = $('select[name = "select_tActividad"]');
			var obj_material = $('input[name = "txt_material"]');
			var obj_cantidadMaterial = $('input[name = "txt_materialCantidad"]');

			
			var profesor = array(obj_profesor);
			var responsable = array(obj_responsable);
			var fecha = array(obj_fecha);
			var horaI = array(obj_horaI);
			var horaF = array(obj_horaF);
			var lugar = array(obj_lugar);
			var req = array(obj_req);
			var tActividad = array(obj_tactividad);
			var material = array(obj_material);
			var cantidadMaterial = array(obj_cantidadMaterial);
			
			
			var enviar = {
			'titulo' : titulo,
			'descripcion' : description,
			'requisitos': requisitos,
			'tActividad' : tActividad,
			'dirigido' : dirigido,
			'profesor' : profesor,
			'responsable' : responsable,
			'fecha': fecha,
			'horaI' : horaI,
			'horaF': horaF,
			'lugar' : lugar,
			'req' :req,
			'material' : material,
			'cantidadMaterial': cantidadMaterial,
			'cantidad': cantidad  
			};

			
			
			
			
			$.post('cursos/insertar.php',enviar, function(respuesta){
				var respuesta = JSON.parse(respuesta);

				

				if(typeof respuesta.curso !== 'undefined'){
					if(!respuesta.curso){
						$('#divMensaje').addClass('mensaje-error');
						$('#divMensaje').append("<label>Curso no creado</label>");
					}
					
				}else{
					//console.log("No existe");					

					if(respuesta[0].curso){
						$('#divMensaje').addClass('mensaje-success');
						$('#divMensaje').append("<label>Curso creado correctamente</label>");

					}else {			
						$('#divMensaje').addClass('mensaje-error');

						var dupProfesor =false;
						var dupResponsable = false;
						var dupMaterial = false;
						var dupReq = false;
						var dupHorario = false;

						var listaErrores = "";

						if(respuesta[1].profesor.length>1){
							for(var i= 0; i<respuesta[1].profesor.length; i++){						
								if(respuesta[1].profesor[i]){
									dupProfesor = true;
								}
							}
						}else {
							if (respuesta[1].profesor){
								dupProfesor = true;
							}else{
								dupProfesor = false;
							}
						}
						
						if(respuesta[2].responsable.length>1){
							for(var i= 0; i<respuesta[2].responsable.length; i++){
								if(respuesta[2].responsable[i]){
									dupResponsable = true;
								}
							}
						}else {
							if (respuesta[2].responsable){
								dupResponsable = true;
							}else{
								dupResponsable = false;
							}
						}
						
						if(respuesta[5].material.length > 1){
							for(var i= 0; i<respuesta[5].material.length; i++){		
								if(respuesta[5].material[i]){
									dupMaterial = true;
								}
							}
						}else {
							if(respuesta[5].material){
								dupMaterial = true;
							}
						}

						if(respuesta[4].req.length > 1){
							for(var i= 0; i<respuesta[4].req.length; i++){
								if(respuesta[4].req[i]){
									dupReq = true;
								}
							}
						}else {
							if (respuesta[4].req) {
								dupReq = true;
							}else{
								dupReq = false;
							}
						}

						if(respuesta[3].horario.lengt > 1){
							for(var i= 0; i<respuesta[3].horario.length; i++){
								if(respuesta[3].horario[i]){
									dupHorario = true;
								}
							}
						}else {
							if(respuesta[3].horario){
								dupHorario = true;
							}else {
								dupHorario = false;
							}
						}



						

						if(!dupHorario){
							listaErrores += "<li>Horario llenado incorrectamente</li>";
						}if(!dupReq){
							listaErrores += "<li>Requerimientos duplicados</li>";
						}if (!dupMaterial){
							listaErrores += "<li>Material y/o Cantidad vacio o duplicado</li>";
						}if(!dupProfesor){
							listaErrores += "<li>Profesores duplicados</li>";
						}if(!dupResponsable){
							listaErrores += "<li>Responsable duplicados</li>";
						}

						console.log(listaErrores);


						$("#divMensaje").append("<ul>" + listaErrores + "</ul>");


				
						
					}
				
				}

				
				
			});
				
				
		}	
	});

	$('#btn_agregarProfesor').on('click', function(){

		if(j == 10){
			j = j;
		}else {
			$('#tableProfesor').clone().appendTo("#divProfesor");
			j++;
		}
	});

	$('#btn_agregarResponsable').on('click', function(){

		if(i == 5){
			i = i;
		}else {
			$('#tableResponsable').clone().appendTo("#divResponsable");
			i++;
		}
	});

	$(document).on('click', '#btn_agregarHorario', function(){
		//console.log(i);
		if(k == 10){
			k = k;
		}else {
			$('#tableHorario').clone().appendTo("#divHorario");			
			k++;
		}

	});

	$('#btn_agregarReq').on('click', function(){
		
		if(l == 5){
			l = l;
		}else {
			$('#tableReq').clone().appendTo("#divReq");			
			l++;
		}
	});

	$('#btn_agregarMaterial').on('click', function(){
		
		if(m == 5){
			m = m;
		}else {
			$('#tableMaterial').clone().appendTo("#divMaterial");			
			m++;
		}
	});


	$(document).on('click', '#btn_lugar', function(){

		
		var obj_fecha = $('select[name = "selectFecha"]');
		var obj_horaI = $('select[name = "selectHoraI"]');
		var obj_horaF = $('select[name = "selectHoraF"]');
		

		var fecha = array(obj_fecha);
		var horaI = array(obj_horaI);
		var horaF = array(obj_horaF);
		

		var datosLugar = {
			'fecha': fecha,
			'horaI': horaI,
			'horaF' : horaF
		};

		$.post('cursos/lugar.php', datosLugar, function(respuesta){
			respuesta = JSON.parse(respuesta);
			$('#msg_error_horario').empty();

			//console.log(respuesta.lugar[0][0].id);
			
			if(respuesta != false){

				//Colocamos los valores que corresponden al SELECT de los lugares
				//Desabilitamos los valores para de fechas y horas
				$('#div_btn_agregarHorario').empty();
				$('#tablaHorario').empty();
				var texto = "";

				texto +=  `
					
					<table class="table">
	                        <thead class="titulo-tabla">
	                            <tr class="text-center">
	                                <th>Fecha</th>
	                                <th>Hora de Inicio</th>
	                                <th>Hora de Termino</th>
	                                <th>Lugares Disponibles</th>    
	                            </tr>
	                        </thead>

	                        <tbody id = "divHorario"> `;			

				
				for (var i = 0; i < respuesta.HF.length; i++) {

						texto += `
							<tr class = "text-center ">
							<td>
								<input name = "selectFecha" value = "${respuesta.fecha[i]}" disabled class = "form-control align-center">
							</td>
							<td>
								<input name = "selectHoraI" value = "${respuesta.HI[i]}" disabled class = "form-control align-center ">
							</td>
							<td>
								<input name = "selectHoraF" value = "${respuesta.HF[i]}" disabled class = "form-control align-center">
							</td>

							<td>
								<select class = "form-control" name = "selectLugar">
	
						`;
					for (var j = 0; j < respuesta.lugar[i].length; j++) {
						texto += `
							<option value = " ${respuesta.lugar[i][j].id}">
								${respuesta.lugar[i][j].nombre}	
							</option>
							`;
					}

					texto += `
								</select>
							</td>
							</tr>`;
					
				}

				texto += `
					
					</tbody>
                    </table>

				`; 
				
				$('#tablaHorario').append(texto);

				$('#div_btn_lugar').empty();
				var btn_reiniciar = `<span id ="btn_reiniciarLugar" class ="btn btn-outline-primary col-sm-12 col-lg-12" >
					Reiniciar
				</span>`;

				$('#div_btn_lugar').append(btn_reiniciar);


			}else {
				//Coloreamos los valores de fecha y hora_inicio y hora_final
				var mensaje = `
					<div class ="col-sm-12 mensaje-error d-flex justify-content-center mt-3 mb-1">
					<label>Error al llenar los horarios</label>
					</div>
				`;

				$('#msg_error_horario').append(mensaje);
				$('#eliminar_lugar').text('Lugares Disponibles');


			}


			
			//$('#btn_lugar').text('Reiniciar');
			//$('#btn_lugar').attr('id', 'btn_reiniciar');

		});

		
	});


	$(document).on('click', '#btn_reiniciarLugar', function(){

		k = 1;
		$('#div_btn_lugar').empty();
			var btn_reiniciar = `<span id ="btn_lugar" class ="btn btn-outline-primary col-sm-12 col-lg-12" >
				Lugar
			</span>`;
		$('#div_btn_lugar').append(btn_reiniciar);
		$('#tablaHorario').empty();
		 var btn_agregarHorario = `			
			<button class="btn" type="button" id="btn_agregarHorario"><i class="fas fa-plus"></i>
		 `;

		 $('#div_btn_agregarHorario').append(btn_agregarHorario);


		var tabla = `			
			 <table class="table">
                        <thead class="titulo-tabla">
                            <tr class="text-center">
                                <th>Fecha</th>
                                <th>Hora de Inicio</th>
                                <th>Hora de Termino</th>
                                <th>Eliminar</th>    
                            </tr>
                        </thead>

                        <tbody id = "divHorario">
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
                        </tbody>
                    </table>

		`;
		$('#tablaHorario').append(tabla);
		selectores();

	});


	$(document).on('click', '#btn_quitarProfesor', function(){
		//
		if(j == 1){
			j = j;
		}else {

			$(this).parent('td').parent('tr').remove()	;
			j--;
		}
	});

	$(document).on('click', '#btn_quitarResponsable', function(){
		//
		if(i == 1){
			i = i;
		}else {

			$(this).parent('td').parent('tr').remove();

			i--;
		}
	});

	$(document).on('click', '#btn_quitarHorario', function(){
		
		if(k == 1){
			k = k;

		}else {

			$(this).parent('td').parent('tr').remove();
			k--;
		}
	});

	$(document).on('click', '#btn_quitarReq', function(){
		
		if(l == 1){
			l = l;

		}else {

			$(this).parent('td').parent('tr').remove();
			l--;
		}
	});

	$(document).on('click', '#btn_quitarMaterial', function(){
		
		if(m == 1){
			m = m;

		}else {

			$(this).parent('td').parent('tr').remove();
			m--;
		}
	});


});



function leer(){

	/*$.get('cursos/leer.php', function(respuesta){
		console.log(respuesta);
	});*/
	
}


function selectores () {

	//Obtenermos el Selector para el tipo de Actividad
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

	//Obtenemos el selector para los profesores

	$.get('cursos/profesor.php', function(respuesta){
		$('#selectProfesor').empty();
		var array_respuesta = JSON.parse(respuesta);

		var fila = '';

		for (var i = 0; i < array_respuesta.length; i++) {
					fila += "<option value = \"" + array_respuesta[i].id+ "\">" + array_respuesta[i].nombre+ "</option>";
				}

		$('#selectProfesor').append(fila);
	});

	//Obtenemos el selector para los responsables

	$.get('cursos/resp.php', function(respuesta){
		$('#selectResponsable').empty();
		var array_respuesta = JSON.parse(respuesta);
		

		var fila = '';

		for (var i = 0; i < array_respuesta.length; i++) {
					fila += "<option value = \"" + array_respuesta[i].id+ "\">" + array_respuesta[i].nombre+ "</option>";
				}

				$('#selectResponsable').append(fila);
	});


	//Obtenemos el selector para la fecha 

	$.get('cursos/fecha.php', function(respuesta){
		$('#selectFecha').empty();
		var array_respuesta = JSON.parse(respuesta);

		var fila = '';

		for (var i = 0; i < array_respuesta.length; i++) {
					fila += "<option value = \"" + array_respuesta[i].nombre+ "\">" + array_respuesta[i].nombre+ "</option>";
				}

		$('#selectFecha').append(fila);
	});

	//Obtenemos el selector para la hora

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

	//Obtenemos el selector para el lugar

	/*$.get('cursos/lugar.php', function(respuesta){
		$('#selectLugar').empty();
		var array_respuesta = JSON.parse(respuesta);
		var fila = '';

		for (var i = 0; i < array_respuesta.length; i++) {
					fila += "<option value = \"" + array_respuesta[i].id+ "\">" + array_respuesta[i].nombre+ "</option>";
				}

		$('#selectLugar').append(fila);
	});*/

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

function array(lectura){

	var  array= [];

	for (var i = 0; i < lectura.length; i++) {
			array.push(lectura[i].value);
		}

		return array;

}


function vacio(obj){

	var respuesta;

	if(obj.val().length>1){
		obj.removeClass('input-vacio');
		respuesta = false;
	}else {
		obj.addClass('input-vacio');
		respuesta = true;
	}

	return respuesta;
}

function valor(obj){
	return obj.val();
}

function quitarClases(){
        $('#divMensaje').empty();
        $('#divMensaje').removeClass('mensaje-error');
        $('#divMensaje').removeClass('mensaje-sucess');
        $('#divMensaje').removeClass('mensaje-update');
 }

