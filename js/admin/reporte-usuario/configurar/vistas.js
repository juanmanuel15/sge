function vista_cargarDatos(){
	$.post('configurar/leer.php', function(respuesta){
		var respuesta = JSON.parse(respuesta);
		//console.log(respuesta.consulta);
		
		if(respuesta.conexion === false || respuesta.base === false){
			$('#div_msg_base').empty();
			msg = "Error al consultar los datos, por favor recargue la página. Si el problema persiste intente más tarde.";
			mensaje(msg, 'e', $('#div_msg_base'));
		}else{
			respuesta = respuesta.consulta;
			$('#txt_uniNombre').val(respuesta.nombreUniversidad);
			$('#txt_uniCampus'). val(respuesta.nombreCampus);
			$('#txt_tituloEvento').val(respuesta.nombreEvento);
			$('#txt_tipoReconocimiento').val(respuesta.tipoReconocimiento);
			$('#txt_fechaEventoInicial').val(respuesta.FI);
			$('#txt_fechaEventoFinal').val(respuesta.FF);
			$('#txt_lugarEvento').val(respuesta.lugarEvento);
			$('#txt_lema').val(respuesta.slogan);
			$('#txt_asistencia').val(respuesta.porcentaje);
			$('#txt_nombreDirector').val(respuesta.nombreDirector);
		}
		

	});
}