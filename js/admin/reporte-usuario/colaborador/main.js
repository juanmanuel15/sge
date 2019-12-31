$(document).ready(function(){
    leer();
    var id_asistenciaCurso;
    var id_registro;
    




    $(document).on('submit', '#form_buscarColaborador', function(e){
        e.preventDefault();

        var txt_buscar_Colaborador = $('#buscar_Colaborador').val();

        txt_buscar_Colaborador = {'dato' : txt_buscar_Colaborador}; 

        if(txt_buscar_Colaborador === ''){
            leer();
        } else {
            $.post('buscar.php', txt_buscar_Colaborador, function(respuesta){
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
                        $('#tablaColaborador').empty();
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

