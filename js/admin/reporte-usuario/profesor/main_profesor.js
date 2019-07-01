$(document).ready(function(){
    leer();
    var id_asistenciaCurso;
    var id_registro;
    




    $(document).on('submit', '#form_buscarRegistroAsistencia', function(e){
        e.preventDefault();

        var txt_buscarCursoUsuario = $('#buscar_Asistencia').val();
        txt_buscarCursoUsuario = {'txt' : txt_buscarCursoUsuario}; 

        if(txt_buscarCursoUsuario === ''){
            leer();
        } else {
            $.post('buscarUsuarioCursoAsistencia.php', txt_buscarCursoUsuario, function(respuesta){
                respuesta = JSON.parse(respuesta);
                
    
                    if(respuesta['servidor']){
                        console.log("Error al procesar información");
                        leer();
                    }else if(respuesta['vacio']){
                        leer();
                    }else if(respuesta['usuarios'] != false){
                        //console.log(respuesta['usuarios']);
                        vista_principalBuscarCurso(respuesta['usuarios']);                    
                    }else {
                         $('#tablaReporteUsuario').empty();
                    }
                    
                });
        }
    });

    


});











    



function leer(){
    $.get('leer.php',function(respuesta) {            
            var respuesta = JSON.parse(respuesta);
            usuario = respuesta['success'];
            vista_principalBuscarCurso(usuario);
	});
}