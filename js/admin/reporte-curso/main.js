$(document).ready(function(){
    leer();
    confIniciales();



     var id_curso; 
     var usuarioEliminar;


     $(document).on('submit', '#formBuscar', function(e){
        e.preventDefault();

        var txt_buscarCurso = $('#txt_buscarCurso').val();
        txt_buscarCurso = {'txt' : txt_buscarCurso}; 

        if(txt_buscarCurso === ''){
            leer();
        } else {

            $.post('cursos/reporte-curso/buscarCurso.php', txt_buscarCurso, function(respuesta){
            respuesta = JSON.parse(respuesta);

                if(respuesta['servidor']){
                    console.log("Error al procesar información");
                    leer();
                }else if(respuesta['vacio']){
                    leer();
                }else if(respuesta['cursos'] != false){
                    console.log(respuesta['cursos']);
                    vista_leerCursos(respuesta['cursos']);                    
                }else {
                     $('#tablaReporteCurso').empty();
                }
                
            });

        }

     });


    $(document).on('click', '#btn_generar', function(){
        var id = { 'id' : $(this).parent().parent().attr("id")};
    });

    $(document).on('click', '#btn_ver', function(){
        confIniciales();
        limpiar_BuscarUsuario();
        id_curso = $(this).parent().parent().attr("id");
       var datos = { 'id' : $(this).parent().parent().attr("id")};
       $('#modal_admin_reporte_usuario').modal('show');
        CRUD_modal(datos);
    });


    $(document).on('click', '#btn_Aceptar', function(){
        $('#modal_admin_reporte_usuario').modal('hide');

    });

    $(document).on('click', '#btn_eliminarUsuarioCurso', function(){
        $('#contenedor_msgEliminarUsuario').show();
        $('#contenedorUsuarioInscrito').hide();

        var usuario =  $(this).attr('valor');
        usuarioEliminar = {'usuario': usuario , 'id': id_curso};
        

    });


    $(document).on('click', '#btn_aceptarEliminar', function(){
        eliminarUsuario(usuarioEliminar);
        $('#contenedor_msgEliminarUsuario').hide();
        $('#contenedor_agregarUsuarioCurso').hide();
        $('#contenedorUsuarioInscrito').show();

    });

    $(document).on('click', '#btn_cancelarEliminar', function(){
        $('#contenedor_msgEliminarUsuario').hide();
        $('#contenedorUsuarioInscrito').show();
    });

    $(document).on('click', '#bnt_agregarUsuario', function(){
        $('#contenedorUsuarioInscrito').hide();
        $('#contenedor_agregarUsuarioCurso').show();
    });


    $(document).on('submit', '#formBuscarUsuarioCurso', function(e){
        e.preventDefault();

        var txt_buscar = $('#txt_buscarUsuarioCurso').val();
        txt_buscar = {'txt' : txt_buscar};

        if(txt_buscar === ''){
            $('#tablaBuscarUsuario').empty();
            $('#msg_UsuarioInsertado').empty();
            $('#msg_UsuarioInsertado').removeClass('mensaje-error');
            $('#msg_UsuarioInsertado').removeClass('mensaje-success');

        }else {
            $.post('cursos/reporte-curso/buscarUsuarioCurso.php', txt_buscar, function(respuesta){
            respuesta = JSON.parse(respuesta);

                if(respuesta['servidor']){
                    console.log("Error al procesar información");
                    $('#tablaBuscarUsuario').empty();
                }else if(respuesta['vacio']){
                    console.log("Cadena Vacia");
                    $('#tablaBuscarUsuario').empty();
                }else {
                    vista_contenedor_agregarUsuarioCurso(respuesta['usuarios']);
                }
                
            });
        }

        
    });


    $(document).on('click', '#btn_inscribirUsuarioCurso', function(){
        var id = $(this).attr('valor');

        datos = {'id_usuario' : id, 'id_curso' : id_curso};
        $.post('cursos/reporte-curso/inscribirUsuario.php', datos, function(respuesta){
            respuesta = JSON.parse(respuesta);
            vista_msg_CursoUsuario(respuesta);
            leer();
        });
    });



    $(document).on('click', '#btn_regresarBuscarUsuario', function(){
        $('#contenedorUsuarioInscrito').show();
        $('#contenedor_agregarUsuarioCurso').hide();
        var datos = {'id': id_curso};
        limpiar_BuscarUsuario();
        CRUD_modal(datos);

    });



});


function leer(){
    $('#tablaReporteCurso').empty();
    $.post('cursos/reporte-curso/mostrar.php',function(respuesta) {            
            var respuesta = JSON.parse(respuesta);
            //console.log(respuesta[0]);            
            //console.log(respuesta[0].lugar['lugares']);
            $('#tablaReporteCurso').empty();
            
            var fila = '';

            for(var i =0; i<respuesta.length; i++){

                var id =respuesta[i].curso['id'];
                var titulo = respuesta[i].curso['titulo'];
                var inscritos = respuesta[i].lugar[0]['inscritos'];
                var lugares = respuesta[i].lugar[0]['lugares'];

               
               fila += `
                    <tr id = ${id}>
                        <td>${id}</td>
                        <td>${titulo}</td>
                        <td>${inscritos}/${lugares}</td>
                        <td><span id = "btn_ver" class = "i_ver"><i class="fas fa-eye"></i></td>                
                        <td><span id = "btn_generar" class = "i_mostrar"><a href = "reporte-curso/reporte.php?id=${id}"><i class="fas fa-share"></i></i></a></i></span></td>
                    </tr>
               `;
            }
            
            

		$('#tablaReporteCurso').append(fila);

	});



}

function CRUD_modal(datos){
    
     $.post('cursos/reporte-curso/lista.php', datos, function(respuesta){
            respuesta = JSON.parse(respuesta);

            

            if(respuesta.length === 0){
                $('#modalBody_usuariosInscritos').empty();
            }else {
                vista_body_usuariosInscritos(respuesta);
            }
            
    });      
}




function eliminarUsuario(datos){
    console.log(datos)
    curso = {'id' : datos['id']};


    usuario = datos['usuario'];
    $.post('cursos/reporte-curso/eliminar_curso.php', datos, function(respuesta){
        respuesta=JSON.parse(respuesta);
        
        if(respuesta != true){
            if(typeof respuesta['base'] === undefined){
                if(typeof respuesta['metodo'] === undefined){
                    console.log(respuesta);
                }else {
                    console.log("Error en el metodo");
                }
            }else {
                console.log("Error en la base");
            }

        }else {
            CRUD_modal(curso);
            leer();
        }
    });
}


function confIniciales(){
    $('#contenedor_msgEliminarUsuario').hide();
    $('#contenedorUsuarioInscrito').show();
    $('#contenedor_agregarUsuarioCurso').hide();
}


function limpiar_BuscarUsuario(){
    $('#formBuscarUsuarioCurso')[0].reset();
    $('#tablaBuscarUsuario').empty();
    $('#msg_UsuarioInsertado').empty();
    $('#msg_UsuarioInsertado').removeClass('mensaje-error');
    $('#msg_UsuarioInsertado').removeClass('mensaje-success');
}

