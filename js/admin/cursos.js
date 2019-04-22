$(document).ready(function(){


	

	confIniciales();

	

	$('input[name= "confMaterial"]').change(function(){
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


	

});


function confIniciales(){
	$('#divMaterialConf').hide();
	$('#divProfesorConf').hide();
	$('#divRespConf').hide();
	$('#divHorarioConf').hide();
	$('#divConfirmarCurso').hide();
	$('#divBotonesHorario').hide();
	leerRequerimientos();
	leerTipoActividad();
}

function cerrarModal(){
	$('#modalCurso').modal('hide');
	$('#formCurso')[0].reset();	
}