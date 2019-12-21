$(document).ready(function() {



	vista_cargarDatos();



	// *------ btn Actualizar -------*//

	$('#btn_actualizar').click(function (){	
		$('#div_conf_porcentaje').empty();	
		$.post('configurar/leer.php', function(respuesta){
			var respuesta = JSON.parse(respuesta);
			console.log(respuesta);
			if(respuesta.conexion === false || respuesta.base === false){
				$('#div_msg_config').empty();
				msg = "Error al consultar los datos, por favor recargue la página. Si el problema persiste intente más tarde.";
				mensaje(msg, 'e', $('#div_msg_config'));
			}else{
				respuesta = respuesta.consulta;
				$('#conf_nombreUniversidad').val(respuesta.nombreUniversidad);
				$('#conf_nombreCampus').val(respuesta.nombreCampus);
				$('#conf_tituloEvento').val(respuesta.nombreEvento);
				$('#conf_FI').val(respuesta.FI);
				$('#conf_FF').val(respuesta.FF);
				$('#conf_lugarEvento').val(respuesta.lugarEvento);
				$('#conf_lemaUniversidad').val(respuesta.slogan);
				$('#conf_porcentaje').val(respuesta.porcentaje);
				$('#conf_nombreDirector').val(respuesta.nombreDirector);
				respuesta.tipoReconocimiento.toLowerCase()== 'constancia' ? $('#conf_tipoReconocimiento option[value="const"]').attr("selected",true) : $('#conf_tipoReconocimiento option[value="rec"]').attr("selected",true); 
				

				var texto = `<label for = "conf_asistencia" class = "label-form-control">${respuesta.porcentaje}%</label>`;
				$('#div_conf_porcentaje').append(texto);

			}


		});
	});


	// * ----- Cambio del Porcentaje ------ *//

	$('#conf_porcentaje').change(function(){
		var porcentaje = $('#conf_porcentaje').val();
		$('#div_conf_porcentaje').empty();

		var texto = `<label for = "conf_asistencia" class = "label-form-control">${porcentaje}%</label>`;
		$('#div_conf_porcentaje').append(texto);

	});
    
    $('#form_configurarConstancia').submit(function(e){
    	e.preventDefault();    	

    	var nombreUniversidad = $('#conf_nombreUniversidad');
    	var nombreCampus = $('#conf_nombreCampus');
    	var tipoReconocimiento = $('#conf_tipoReconocimiento');
    	var tituloEvento= $('#conf_tituloEvento');
    	var FI = $('#conf_FI');
    	var FF = $('#conf_FF');
    	var lugarEvento= $('#conf_lugarEvento');
    	var lemaUniversidad = $('#conf_lemaUniversidad');
    	var porcentaje = $('#conf_porcentaje');
    	var nombreDirector = $('#conf_nombreDirector');


    	if(vacio(nombreUniversidad) || vacio(nombreCampus) || vacio(nombreDirector) || vacio(tipoReconocimiento) || vacio(tituloEvento) || vacio(FI) || vacio(FF) || vacio(lugarEvento) || vacio(lemaUniversidad) || porcentaje.val() === '0' ){
    		mensaje("Campos vacíos y/o mal llenados", 'e', $('#div_msg_config'));
    	}else{
    		
    		var datos = procesarDatos(nombreUniversidad, nombreCampus, tipoReconocimiento, tituloEvento, FI, FF, lugarEvento, lemaUniversidad, porcentaje, nombreDirector);

    			$.post('configurar/guardar.php', datos, function(respuesta){
					var respuesta = JSON.parse(respuesta);
					console.log(respuesta);

					if(!respuesta.servidor){
						mensaje("No se puede conectar con el servidor", 'e',$('#div_msg_config'));
					}else{
						if(!respuesta.lleno){
							mensaje("Campos vacíos y/o mal llenados", 'e', $('#div_msg_config'));
						}else{
							if(!respuesta.conn){
								mensaje("No se puede ejecutar la consulta - 1", 'e',$('#div_msg_config'));
							}else{
								if(!respuesta.success){
									mensaje("No se puede ejecutar la consulta - 2", 'e',$('#div_msg_config'));
								}else{
									mensaje("Información guardada correctamente", 'c',$('#div_msg_config'));
    								vista_cargarDatos();
								}
							}
						}
					}


				});    			
    	}

    });


    $('#conf_btnCancelar').click(function(){
    $('#actualizarContancias').modal('hide');
    quitarClases();

    });


});
