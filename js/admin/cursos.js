$(document).ready(function(){
	
	confIniciales();

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
		$("#divDatosCurso").hide();
		$('#divHorarioConf').show();
	});

	$('#btn_AceptarHorario').on('click', function(){
		$('#divProfesorConf').show();
		$('#divHorarioConf').hide();
		leerProfesor(datosHorario());
		leerResp(datosHorario());

	});


	$('#btn_AceptarProfesor').on('click', function(){
		$('#divProfesorConf').hide();
		$('#divRespConf').show();




	});

	$('#btn_AceptarResp').click(function(){
		$('#divConfirmarCurso').show();
		$('#divRespConf').hide();
	});


	//Botones para regresar al menú anterior

	$('#btn_regresarHorario').click(function(){
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


	//Botones para salir.

	$('#btn_salirDatos').click(cerrarModal);
	$('#btn_salirHorario').click(cerrarModal);
	$('#btn_salirProfesor').click(cerrarModal);
	$('#btn_salirResp').click(cerrarModal);
	$('#btn_cancelar').click(cerrarModal);

	
	$('#formCurso').submit(function(e){
		e.preventDefault();
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
	});

	$(document).on('click', '#btn_CalcularHorario', function(){

		
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

	k = 1;
		$('#divBotonCalcularHorario').empty();
			var btn_reiniciar = `
			<div class="col-12 col-lg-12 d-flex justify-content-center">
                <span class="btn btn-secondary mx-2 col-4" id="btn_CalcularHorario">Calcular</span>
            </div>
			`;
		$('#divBotonCalcularHorario').append(btn_reiniciar);
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
});	




function confIniciales(){

	$('#divDatosCurso').show();
	$('#divMaterialConf').hide();
	$('#divProfesorConf').hide();
	$('#divRespConf').hide();
	$('#divHorarioConf').hide();
	$('#divConfirmarCurso').hide();
	$('#divBotonesHorario').hide();
	
}

function cerrarModal(){
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