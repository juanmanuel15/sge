$(document).ready(function(){

	$(document).on('click', '#btn_asistencia', function(){
		$('#modal_asistenciaUsuario').modal('show');
		var id_curso = $('#btn_asistencia').attr('valor');
		asistencia_Alumnos(id_curso);
	});




	
	
});