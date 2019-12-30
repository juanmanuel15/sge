$(document).ready(function(){
    leer();
    var id_asistenciaCurso;
    var id_registro;
    




    $(document).on('submit', '#form_buscarRegistroAsistencia', function(e){
        e.preventDefault();

        var txt_buscarCursoUsuario = $('#buscar_Asistencia').val();

        txt_buscarCursoUsuario = {'dato' : txt_buscarCursoUsuario}; 

        if(txt_buscarCursoUsuario === ''){
            leer();
        } else {
            $.post('buscar.php', txt_buscarCursoUsuario, function(respuesta){
                respuesta = JSON.parse(respuesta);
                console.log(respuesta);                
    
                    if(respuesta['serv']){
                        console.log("Error al procesar información");
                        leer();
                    }else if(respuesta['conn']){
                        leer();
                    }else if(respuesta['res'] != false){
                        leer();           
                    }else if(respuesta['success'] != false){
                         vista_principalBuscarCurso(respuesta['success']);
                    }else{
                        $('#tablaEditarConstancia').empty();
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

