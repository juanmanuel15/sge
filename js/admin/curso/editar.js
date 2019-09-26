$(document).on('click', '#btn_editar', function(){
	var id = $(this).parent().parent().attr('id');

	$('#btn_AceptarHorario').attr('accion', 'editar');
	
	reiniciarValoresEditar();
	confInicialesEditar();
	
	var dato =  {
		'id' : id
	};



	$.post('cursos/editar/editar.php', dato, function(respuesta){
		$('#modalCurso').modal();
		respuesta = JSON.parse(respuesta);
		
		
		//console.log(respuesta);
		datosGenerales = respuesta.datosGenerales;
		$('#btn_AceptarHorario').attr('id_curso', id);
		
		//Se agregan todos los Datos Generales del Curso
		$('#modalTitulo').text('Editar Curso');
		$('#txt_titulo').val(datosGenerales.titulo);
		$('#txt_description').val(datosGenerales.desc);
		$('#txt_cantidad').val(datosGenerales.lugares);
		$('#txt_dirigido').val(datosGenerales.dirigido);
		$('#txt_requisitos').val(datosGenerales.pre);

		
		leerTipoActividad(datosGenerales.id_tActividad);
		req = respuesta.req;

		leerRequerimientos(req);

		material = respuesta.material;
		material == "" ? radioStatus(0, '') : radioStatus(1, material);		
		horarioSeleccionadoEditar(respuesta.horario);
		var datos = datosHorario();

		leerProfesorEditar(datos, respuesta.profesor);
		leerRespEditar(datos,respuesta.resp)
		//agregarProfesoresCurso(respuesta.profesor);
		



		
		
		
	});


});