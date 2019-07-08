$(document).ready(function(){
    var tipo_usuario;
    var id_eliminar;
    var id_editar;
    leerUsuario();
    
    
    
    $(document).on('click', '#btn_agregar', function(){
        $('#titulo_modal').text('Agregar usuario');
        btn_agregarUsuario();   
        vistasModal(1,0,0,0);
        select_tipoUsuario();
        select_carreraUsuario();
        input_vacio();
        $('#formUsuario_interno')[0].reset();
        $('#seleccionarUsuario').attr('accion', 'agregar'); 

            
    });

    /*$(document).on('click', '#aceptar_tipoUsuario', function(){
        tipo_usuario =  $('#select_tipo').val();

        vistasModal(0,1,0,0);
    });*/


    $(document).on('change', 'input:radio[name = nCuenta]', function(){
        radio = $('input:radio[name = nCuenta]:checked').val();
        
        if(radio == 'si'){
            $('#campo_nCuenta').show();
            
            
        }else if(radio == 'no'){
            $('#campo_nCuenta').hide();
            
        }

        vistasModal(0,1,0,0);
    });


    $(document).on('click', '#btn_eliminar', function(){
        id_eliminar = $(this).attr('valor');
        $('#modal_AgregarUsuario').modal('show');
        $('#titulo_modal').text('Eliminar usuario');
        vistasModal(0,0,1,0);
        
    });

    $(document).on('click', '#btn_aceptar_eliminarUsuario', function(){
        eliminarUsuario(id_eliminar);
    });

    $(document).on('click', '#btn_cancelar_eliminarUsuario', function(){
        $('#modal_AgregarUsuario').modal('hide');
        
    });

    $(document).on('click', '#btn_msg_aceptar', function(){
        $('#modal_AgregarUsuario').modal('hide');
        
    });

    $(document).on('click', '#btn_editar', function(){
        $('#seleccionarUsuario').attr('accion', 'editar');
        $('#titulo_modal').text('Editar usuario'); 
        btn_editarUsuario();
        input_vacio();
        id_editar = $(this).attr('valor');
        $('#campo_nCuenta').show();
        mostrar_datos_usuario(id_editar);
    });

    
    $('#formularioUsuario').submit(function(e){
        e.preventDefault();
        var accion = $('#seleccionarUsuario').attr('accion');        
        
        if(accion == 'agregar'){
            agregarUsuario();
        }else if(accion == 'editar'){
            editarUsuario(id_editar);
        }
    });


    $(document).on('click','#cancelar_usuario',function(){
        input_vacio();
        $('input:radio[name = nCuenta]:checked').prop('checked', false);
        $('#modal_AgregarUsuario').modal('hide');
        
    });
    
    $(document).on('click', '#atras_usuario', function(){
        vistasModal(1,0,0,0);
    });


    $(document).on('submit', '#formBuscar', function(e){
        e.preventDefault();
        var txt = $('#txt_buscar').val();

        if(txt == ''){
            leerUsuario();
        }else{        
            txt = {'txt' : txt};
            $.post('reporte-curso/buscarUsuarioCurso.php', txt, function(respuesta){
                respuesta = JSON.parse(respuesta);
                vista_panelPrincipal(respuesta['usuarios']);
            });
        }
    });


    /*$('#cancelar_tipoUsuario').click(function(){
        $('#modal_AgregarUsuario').modal('hide');

    });¨*/




});




function msg_error(obj, msg){
    obj.empty();
    obj.addClass('mensaje-error');
    obj.append(msg)
}


function leerUsuario(){
    $.post('elemento-usuario/mostrar.php', function(respuesta){
        respuesta = JSON.parse(respuesta);
        if(respuesta['conn'] != true){            
            vista_panelPrincipal(respuesta['resultado']);
        }
    });
}

function select_tipoUsuario(){
    $.post('elemento-usuario/select_tipoUsuario.php', function(respuesta){
        respuesta = JSON.parse(respuesta);
        if(respuesta['conn'] != true){
            vista_select_tipoUsuario(respuesta['resultado']);
        }
    });
}


function select_carreraUsuario(){
    $.post('elemento-usuario/select_carrera.php', function(respuesta){
        respuesta = JSON.parse(respuesta);
        if(respuesta['conn'] != true){
            vista_select_carrera(respuesta['resultado']);
        }
    });
}

function vistasModal(radio, form, conf_eliminado, msg){
     
    if(form ==1){
        $('#formularioUsuario').show();
    }else{
        $('#formularioUsuario').hide();
    }

    
    
    if(radio == 1){
        $('#radio_cuenta').show();
    }else{
        $('#radio_cuenta').hide();
    }

    if(conf_eliminado == 1){
        $('#msg_eliminar_usuario').show();
        
    }else{
        $('#msg_eliminar_usuario').hide();
    }
    

    if(msg == 1){
        $('#msg_respuesta').show();
    }else {
        $('#msg_respuesta').hide();
    }
}

function msg_limpio(){
    $('#msg_agregarUsuario').removeClass('mensaje-error');
    $('#msg_agregarUsuario').empty();
}