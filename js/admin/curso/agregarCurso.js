$(document).ready(function(){
	
	confIniciales();
	mostrar();



	var titulo;
	var requisitos;
	var description;
	var dirigido;
	var cantidad;
	var material;
	var cantidadMaterial;
	var profesor;
	var responsable;
	var req;
	var tActividad;
	var fecha;
	var horaI;
	var horaF;
	var lugar;
	var vacioConfMaterial;


	$('input[name = "confMaterial"]').change(function(){
		var confMaterial = $(this).val();

		if(confMaterial === 'true'){
			
			$('#divMaterialConf').show();
		}else {
			$('#divMaterialConf').hide();
		}
	});





	//Botones para aceptar cada uno de los formularios

	$('#btn_AceptarDatosCurso').on('click', function(){

		$('#divMensajeDatosCurso').empty();

		var obj_titulo = $('#txt_titulo');
		var obj_requisitos = $('#txt_requisitos');		
		var obj_dirigido = $('#txt_dirigido');
		var obj_description = $('#txt_description');
		var obj_cantidad = $('#txt_cantidad');		
		var obj_req = $('select[name = "selectReq"]');
		var obj_tactividad = $('select[name = "select_tActividad"]');

		tActividad = array(obj_tactividad);
		req = array(obj_req);
		var vacioTitulo = vacio(obj_titulo);
		var vacioReq = vacio(obj_requisitos);
		var vacioDesc = vacio(obj_description);
		var vacioDiri = vacio(obj_dirigido);
		var vacioCanti = vacio(obj_cantidad);

		var mensaje = '<ul>';
		var repetidoReq = [];
		

		if(req.length === 1 ){
			repetidoReq.push(0);
		}else {
			for (var i = 0; i<req.length-1; i++) {
				for (var j = i+1; j < req.length; j++) {
					req[i] == req[j] ? repetidoReq.push(1) : repetidoReq.push(0);
				}
			}
		}


		/*
			Verificamos si no hay Requerimientos Duplicados, almacenamos la variable en repetido
			repetido = true (si hay elementos repetidos)
			repetido = false 
		*/

		var repetido;

		repetidoReq.indexOf(1) >= 0 ? repetido = true :  repetido = false;
		
		/*
			Agregamos un texto a la variable mensaje que muestra los requerimientos Repetidos.
		*/


		if(repetido){
			
		}

		console.log(repetidoReq.indexOf(1));
		console.log(repetido);

		/*
			Verificamos si esta seleccionado el material, casos: 
			vacioConfMaterial = true (no esta seleeccionado)
			vacioConfMateiral = false
		*/


		$('input[name = "confMaterial"]').is(':checked') ? vacioConfMaterial = false : vacioConfMaterial = true;

		

		/*
			Verificamos cada uno de los elementos del formulario, casos: 
				vacio(obj) = true (campo vacio)
				vacio(obj) = false

			Agregamos un mensaje en el caso de que se encuentren vacíos.
		*/

        if(vacio(obj_titulo) || vacio(obj_description) || vacio(obj_requisitos) || vacio(obj_dirigido) || vacio(obj_cantidad) || vacioConfMaterial || repetido){
			$('#divMensajeDatosCurso').addClass("mensaje-error");
			if (repetido) {
				mensaje += "<li>Requerimientos Repetidos.</li>";
			} else {
				mensaje += "<li>Campos vacíos. </li>";	
			}

			

		}else {

			
			$('input[name = "confMaterial"]:checked').val() === 'true' ? verificarRadio = true : verificarRadio = false;
			//console.log($('input[name = "confMaterial"]').val());
			if(verificarRadio){

				var campoVacioMaterial;
				var campoVacioCantidadMaterial;

				/*	Calculamos si hay algún campo vacío en Material (cantidad o descripcion), es decir 
					-1  -> Si hay
					0-n -> No hay
				*/

				var obj_material = $('input[name = "txt_material"]');
				var obj_cantidadMaterial = $('input[name = "txt_materialCantidad"]');

				material = array(obj_material);
				cantidadMaterial = array(obj_cantidadMaterial);

				campoVacioMaterial = valorArray(obj_material, material).indexOf(0);
				campoVacioCantidadMaterial = valorArray(obj_cantidadMaterial, cantidadMaterial).indexOf(0);				

				campoVacioMaterial != -1 ? campoVacioMaterial = true : campoVacioMaterial = false;
				campoVacioCantidadMaterial != -1 ? campoVacioCantidadMaterial = true : campoVacioCantidadMaterial = false;

				if(campoVacioMaterial || campoVacioCantidadMaterial) {
					$('#divMensajeDatosCurso').addClass("mensaje-error");			
					mensaje += "<li>Campos vacíos</li>";
				}else {
					$('#divMensajeDatosCurso').removeClass("mensaje-error");
					$('#divHorarioConf').show();
					$('#divDatosCurso').hide();

				}

			} else {
				console.log("No se selecciono");
				$('#divMensajeDatosCurso').removeClass("mensaje-error");
				material = '';
				cantidadMaterial = '';

				$('#divHorarioConf').show();
				$('#divDatosCurso').hide();
				
			}



			/*
				Obtenemos el valor de las variables para material y cantidadMaterial
			*/

			

			titulo = valor(obj_titulo);
			requisitos = valor(obj_requisitos);
			description= valor(obj_description);
			dirigido= valor(obj_dirigido);
			cantidad = valor(obj_cantidad);



			var datos = {
				titulo, 
				requisitos,
				description, 
				dirigido,
				cantidad,
				material,
				cantidadMaterial

			};


			




		}


		mensaje += "</ul>" 

			
			$('#divMensajeDatosCurso').append(mensaje);
	});

	$('#btn_AceptarHorario').on('click', function(){
		
		var obj_fecha = $('input[name = "selectFecha"]');
		var obj_horaI = $('input[name = "selectHoraI"]');
		var obj_horaF = $('input[name = "selectHoraF"]');
		var obj_lugar = $('select[name = "selectLugar"]');


		fecha = array(obj_fecha);
		horaI = array(obj_horaI);
		horaF = array(obj_horaF);
		lugar = array(obj_lugar);


		$('#divProfesorConf').show();
		$('#divHorarioConf').hide();
		leerProfesor(datosHorario());
		leerResp(datosHorario());
	});


	$('#btn_AceptarProfesor').on('click', function(){

		$('#divMensajeProfesor').empty();
		
		var obj_profesor = $('select[name = "selectProfesor"]');
		profesor = array(obj_profesor);
		

		if(valoresRepetidos(profesor).indexOf(1) === -1){
			$('#divMensajeProfesor').removeClass('mensaje-error');
			$('#divProfesorConf').hide();
			$('#divRespConf').show();

		}else {

			$('#divMensajeProfesor').addClass("mensaje-error");
			$('#divMensajeProfesor').append("Profesores Repetidos");

		}



		
	});

	$('#btn_AceptarResp').click(function(){

		$('#divMensajeResp').empty();
		var obj_responsable = $('select[name = "selectResponsable"]');
		var obj_profesor = $('select[name = "selectProfesor"]');
		profesor = array(obj_profesor);
		responsable = array(obj_responsable);

		var valor = [];
		var mensaje = '<ul>';

		for(var i = 0; i< responsable.length; i++){
			for (var j = 0; j<profesor.length; j++){
				responsable[i] === profesor[j] ? valor.push(1) : valor.push(0);
			}
		}

		console.log(valor);

		if(valor.indexOf(1) === -1 && valoresRepetidos(responsable).indexOf(1) === -1){
			$('#divMensajeResp').removeClass('mensaje-error');
			$('#divRespConf').hide();
			$('#divConfirmarCurso').show();
		}else {

			if(valor.indexOf(1) != -1){
				mensaje += "<li>Usuario ya asignado en Profesor</li>";
			}if(valoresRepetidos(responsable).indexOf(1) != -1){
				mensaje += "<li>Responsables Repetidos</li>"
			}

			mensaje += '</ul>';

			
			$('#divMensajeResp').addClass('mensaje-error');
			$('#divMensajeResp').append(mensaje);

		}



	
	});


	//Botones para regresar al menú anterior

	$('#btn_regresarHorario').click(function(){
		$('#divHorarioConf').hide();
		$('#divDatosCurso').show();
	});


	$(document).on('click', '#btn_RegresarCalcularHorario', function(){
		$('#divHorarioConf').hide();
		$('#divDatosCurso').show();
	});


	$('#btn_regresarProfesor').click(function(){
		$('#divProfesorConf').hide();
		$('#divHorarioConf').show();
	});

	$('#btn_regresarResp').click(function(){
		$('#divProfesorConf').show();
		$('#divRespConf').hide();
	});

	$('#btn_regresarGuardarCurso').click(function(){
		$('#divRespConf').show();
		$('#divConfirmarCurso').hide();
	});


	//Botones para salir.

	$('#btn_salirDatos').click(cerrarModal);
	$('#btn_salirHorario').click(cerrarModal);
	$('#btn_salirProfesor').click(cerrarModal);
	$('#btn_salirResp').click(cerrarModal);
	$('#btn_cancelar').click(cerrarModal);

	
	$('#formCurso').submit(function(e){
		e.preventDefault();


		var enviar = {

			'titulo' : titulo,
			'descripcion': description,
			'requisitos': requisitos,
			'tActividad' : tActividad,
			'profesor' : profesor,
			'responsable' : responsable,
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
			'cantidad': cantidad,
			'radioMaterial' : vacioConfMaterial
			};


			console.log(enviar);


			$.post('cursos/insertar1.php',enviar, function(respuesta){	

				$('#divMensajeFinal').removeClass('mensaje-error');
				$('#divMensajeFinal').empty();
				
				var respuesta = JSON.parse(respuesta);

				if(typeof respuesta.curso !== 'undefined'){
					if(respuesta.curso === false ){

					}else {
						
					}
						
				}else {
					if(respuesta[0].curso){						
						mostrar();
						cerrarModal();
					}else {
						$('#divMensajeFinal').addClass('mensaje-error');
						$('#divMensajeFinal').append('No se pudo Insertar el curso, por favor verifique sus datos');
					}
				}

							

			});



	});


	//Al presionar el botón agregar se crean los archivos

	$('#btn_agregar').click(function(){
		confIniciales();
		$('#divBotonCalcularHorario').show();
		$('#formCurso')[0].reset();
		selectHorario();
		leerRequerimientos();
		leerTipoActividad();
		leerHora();
		leerFecha();
		incluirCamposMaterial();
	});

	$(document).on('click', '#btn_CalcularHorario', function(){


		var obj_fecha = $('select[name = "selectFecha"]');
		var obj_horaI = $('select[name = "selectHoraI"]');
		var obj_horaF = $('select[name = "selectHoraF"]');


		

		fecha = array(obj_fecha);
		horaI = array(obj_horaI);
		horaF = array(obj_horaF);
		

		var datosLugar = {
			'fecha': fecha,
			'horaI': horaI,
			'horaF' : horaF,
			'cantidad' : parseInt(cantidad, 10)
		};


		$.post('cursos/lugar.php', datosLugar, function(respuesta){
			respuesta = JSON.parse(respuesta);
			$('#msg_error_horario').empty();
			
			if(respuesta != false){

				//Colocamos los valores que corresponden al SELECT de los lugares
				//Desabilitamos los valores para de fechas y horas
				$('#div_btn_agregarHorario').empty();
				$('#tablaHorario').empty();
				var texto = "";

				texto +=  `
					
					<table class="table">
	                        <thead class="titulo-tabla" id="tableHeadHorario">
	                            <tr class="text-center">
	                                <th>Fecha</th>
	                                <th>Hora de Inicio</th>
	                                <th>Hora de Termino</th>
	                                <th>Lugares Disponibles</th>    
	                            </tr>
	                        </thead>

	                        <tbody id = "tableBodyHorario"> `;			

				
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
								<select class = "form-control" name = "selectLugar" id = "selectLugar">
	
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

				$('#divBotonCalcularHorario').empty();
				var btn_reiniciar = `<div class="col-12 col-lg-12 d-flex justify-content-center">
									<span id ="btn_aceptarLugar" class ="btn btn-danger col-sm-12 col-lg-4 mx-2" > Aceptar </span>
									<span id ="btn_reiniciarLugar" class ="btn btn-secondary col-sm-12 col-lg-4 mx-2" > Reiniciar </span>
									</div>
									`;
					

				$('#divBotonCalcularHorario').append(btn_reiniciar);


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


	

});

$(document).on('click', '#btn_aceptarLugar', function(){
	$('#divBotonesHorario').show();
	$('#divBotonCalcularHorario').hide();
	$('select[name = "selectLugar"]').prop('disabled', true);


});


$(document).on('click', '#btn_reiniciarLugar', function(){
	reiniciar();
});

$(document).on('click', '#btn_ReiniciarHorario', function(){
	reiniciar();
	$('#divBotonesHorario').hide();
	$('#divBotonCalcularHorario').show();
});

function reiniciar(){

	k = 1;
		$('#divBotonCalcularHorario').empty();
		btnCalcularHorario();
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

                        <tbody id = "tableBodyHorario">
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
		leerHora();
		leerFecha();
}	




function confIniciales(){

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
	
}

function cerrarModal(){
	$('#divMensajeFinal').empty();
	$('#modalCurso').modal('hide');
	$('#formCurso')[0].reset();	
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


function vacio(obj){

	var respuesta;

	if(obj.val().length>0){
		obj.removeClass('input-vacio');
		respuesta = false;
	}else {
		obj.addClass('input-vacio');
		respuesta = true;
	}

	return respuesta;
}


function array(lectura){

	var  array= [];

	for (var i = 0; i < lectura.length; i++) {
			array.push(lectura[i].value);
		}

		return array;

}

function valor(obj){
	return obj.val();
}


function valorArray(obj,array){

	var respuesta = [];
	for (var i = 0; i < array.length; i++) {

		if(array[i] == ''){
			obj.addClass('input-vacio');
			respuesta.push(0);
		}else {
			obj.removeClass('input-vacio');
			respuesta.push (1);
		}
		
	}

	return respuesta;
}


function valoresRepetidos(array){
	var igual = [];
	for (var i = 0 ; i < array.length;  i++) {
		for (var j = i+1 ; j < array.length; j++) {
			if(array[i] === array[j]){
				igual.push(1);
			}else {
				igual.push(0);
			}
		}		
	}

	return igual;
}