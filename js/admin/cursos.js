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


	$('#btn_AceptarDatosCurso').on('click', function(){
		$("#divDatosCurso").hide();
		$('#divHorarioConf').show();
	});

	$('#btn_AceptarHorario').on('click', function(){
		$('#divProfesorConf').show();
		$('#divHorarioConf').hide();
	});


	$('#btn_AceptarHorario').on('click', function(){
		$('#divProfesorConf').show();
		$('#divHorarioConf').hide();
	});




	$('#btn_regresarHorario').click(function(){
		$('#divHorarioConf').hide();
		$('#divDatosCurso').show();
	});


	$('#btn_salirDatos').click(function(){
		cerrarModal();
	});

	$('#btn_salirHorario').click(function(){
		 cerrarModal();	
	});

	$('#btn_salirDatos').click(function(){
		cerrarModal();
	});

	$('#btn_salirHorario').click(function(){
		 cerrarModal();	
	});


	


	
});


function confIniciales(){
	$('#divMaterialConf').hide();
	$('#divProfesorConf').hide();
	$('#divRespConf').hide();
	$('#divHorarioConf').hide();
	$('#divbtnAgregar').hide();
}

function cerrarModal(){
	$('#modalCurso').modal('hide');
}