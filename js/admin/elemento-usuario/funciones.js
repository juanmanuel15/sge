function agregarUsuario(){    
    
    $('#msg_agregarUsuario').empty();

    //Comprobar que todos los campos esten llenos (los que tienen *)

    var obj_nCuenta = $('#txt_ncuenta');
    var obj_nombre = $('#txt_nombre');
    var obj_apellidoP = $('#txt_apellidoP');
    var obj_apellidoM = $('#txt_apellidoM');
    var obj_correo = $('#txt_correo');
    var obj_usuario = $('#txt_usuario');
    var obj_pass = $('#txt_pass');
    var obj_pass2 = $('#txt_pass2');
    var obj_telefono = $('#txt_telefono');
    var tipo_usuario =  parseInt($('#select_tipo').val(),10);
    
    
    campoVacio(obj_nombre);
    campoVacio(obj_apellidoP);
    campoVacio(obj_correo);
    campoVacio(obj_usuario);
    campoVacio(obj_pass);
    campoVacio(obj_pass2);
    campoVacio(obj_telefono);

    radio = $('input:radio[name = nCuenta]:checked').val();
    

    if(radio ==  'si'){
        campoVacio(obj_nCuenta);        
        
        if(campoVacio(obj_nCuenta)|| campoVacio(obj_nombre)|| campoVacio(obj_apellidoP)||  campoVacio(obj_correo)|| campoVacio(obj_usuario)|| campoVacio(obj_pass)|| campoVacio(obj_pass2)|| campoVacio(obj_telefono)){
            msg_error_campos('<label>No se han llenado todos los campos</label>');
            
        }else{
            msg_success_campos();        
            if(password(valorDelCampo(obj_pass), valorDelCampo(obj_pass2))){
                msg_error_campos('<label>Contraseñas diferentes</label>');
            }else{

                var datosUsuario = obtenerDatosSensibles(obj_correo, obj_nCuenta, obj_usuario);
                $.post('elemento-usuario/consultar.php', datos, function(respuesta){
                    respuesta = JSON.parse(respuesta)
                    var error = control_errores(respuesta);

                    if (!error){
                        var duplicado = consultarDatosUnicos(respuesta['success']);

                        if(!duplicado){
                            enviarDatos();
                        }
                    }

                });
                
            }
        }
    }else if(radio == 'no'){
        
        if( campoVacio(obj_nombre)|| campoVacio(obj_apellidoP)|| campoVacio(obj_correo)|| campoVacio(obj_usuario)|| campoVacio(obj_pass)|| campoVacio(obj_pass2)|| campoVacio(obj_telefono)){
            msg_error_campos('<label>No se han llenado todos los campos</label>');
            
        }else{
            msg_success_campos();
            if(password(valorDelCampo(obj_pass), valorDelCampo(obj_pass2))){
                msg_error_campos('<label>Contraseñas diferentes</label>');
            }else{
                var datosUsuario = obtenerDatosSensibles(obj_correo, obj_nCuenta, obj_usuario);
                $.post('elemento-usuario/consultar.php', datos, function(respuesta){
                    respuesta = JSON.parse(respuesta)
                    var error = control_errores(respuesta);

                    if (!error){
                        var duplicado = consultarDatosUnicos(respuesta['success']);

                        if(!duplicado){
                            enviarDatos();
                        }
                    }

                });
            }
        }
    }    

}


function eliminarUsuario(id){
    id = {'id': id};
    $('#msg_label').empty();
    $.post('elemento-usuario/eliminar.php', id, function(respuesta){
        respuesta = JSON.parse(respuesta);
        
        if(respuesta['servidor'] == false){
            if(respuesta['vacio'] == false){
                if(respuesta['conn'] == false){
                    if(respuesta['success'] == true){
                        vista_usuario_eliminado(true);
                    }else{
                        vista_usuario_eliminado(false);
                    }
                }
            }
        }

        leerUsuario();
        
    });
    

}

function mostrar_datos_usuario(id){
    id = {'id': id};

    $.post('elemento-usuario/usuario.php', id, function(respuesta){
        respuesta = JSON.parse(respuesta);
        console.log(respuesta);
        if(respuesta['servidor'] == false){
            if(respuesta['vacio'] == false){
                if(respuesta['conn'] == false){
                    if(respuesta['success'] != false){
                        vista_editarUsuario(respuesta['success']);
                    }
                }
            }
        }
    });
    
}

function editarUsuario(id){ 
    var datosUsuario = obtenerDatos(id);
    //console.log(datosUsuario);

    $.post('elemento-usuario/editar.php', datosUsuario, function(respuesta){
        respuesta = JSON.parse(respuesta);

        vista_actualizar_usuario(respuesta);
        
        
    });
}


function valorDelCampo(obj){    
    return obj.val();
}

function campoVacio(obj){
    var  respuesta;
    if(valorDelCampo(obj) == ''){
        obj.addClass('input-vacio');
        respuesta = true;    
    }else{
        obj.removeClass('input-vacio');
        respuesta = false;
    }

    return respuesta;
    
}

function msg_error_campos(texto){
    $('#msg_agregarUsuario').addClass('mensaje-error');
    $('#msg_agregarUsuario').removeClass('mensaje-success');
    $('#msg_agregarUsuario').append(texto);
}


function msg_success_campos(){
    $('#msg_agregarUsuario').removeClass('mensaje-error');
    $('#msg_agregarUsuario').empty();
}

function input_vacio(){
    $('#msg_agregarUsuario').empty();
    $('#txt_ncuenta').removeClass('input-vacio');
    $('#txt_nombre').removeClass('input-vacio');
    $('#txt_apellidoP').removeClass('input-vacio');
    $('#txt_apellidoM').removeClass('input-vacio');
    $('#txt_correo').removeClass('input-vacio');
    $('#txt_usuario').removeClass('input-vacio');
    $('#txt_pass').removeClass('input-vacio');
    $('#txt_pass2').removeClass('input-vacio');
    $('#txt_telefono').removeClass('input-vacio');
}

function password(pass1, pass2){
    var respuesta;
    pass1 != pass2 ? respuesta = true : respuesta = false;
    return respuesta;
}

function obtenerDatosSensibles(correo, cuenta, usuario){
    datos = {'correo' : correo.val(), 'cuenta' : cuenta.val(), 'usuario' : usuario.val()};
    return datos;
}

function consultarDatosUnicos(success){
    var respuesta;

    if(!success['correo'] && !success['cuenta'] && !success['usuario']){
        respuesta = false;
    }else {
        respuesta = true;

        var texto  = `<ul>`;

        if(success['correo']){
            texto += `<li>Correo ya existente</li>`;
        } 
        
        if(success['cuenta']){
            texto += `<li>N° de Cuenta o trabajador ya existente</li>`
        }

        if(success['usuario']){
            texto += `<li>Usuario ya existente</li>`;
        }

        texto += `</ul>`;
        
        msg_error_campos(texto);
        
    }
    
    
    return respuesta;

}

function quitarCaracteresEspeciales(cadena){
    
}

function control_errores(datos){
    
    respuesta = true;

    if(datos['servidor']){
        texto = `<label> No se puede agregar usuario, intente más tarde</label>`;
        msg_error_campos(texto);
    }else if(datos['vacio']){
        texto = `<label> Campos llenados incorrectamente, vuelva a intentar </label>`;
        msg_error_campos(texto);
    }else if(datos['conn']){
        texto = `<label> Error al conectar al servidor, intente más tarde</label>`;
        msg_error_campos(texto);
    }else{
        respuesta = false;
    }


    return respuesta;
}


function enviarDatos(){ 
    
    var datosUsuario = obtenerDatos();

    $.post('elemento-usuario/agregar.php', datosUsuario, function(respuesta){
        respuesta = JSON.parse(respuesta);
        //console.log(respuesta);

        var error = control_errores(respuesta);

        if(!error){
            msg_success_insertar(`<label>Usuario registrado correctamente</label>`); 
            leerUsuario();
            $('#formUsuario_interno')[0].reset();

        }

        

        
    });

}

function msg_success_insertar(texto){
    $('#msg_agregarUsuario').addClass('mensaje-success');
    $('#msg_agregarUsuario').removeClass('mensaje-error');
    $('#msg_agregarUsuario').append(texto);
};

function obtenerDatos(id){

    
    var datosUsuario = {
        'id' : id,
        'nCuenta' : $('#txt_ncuenta').val(),
        'nombre': $('#txt_nombre').val(),
        'apellidoP': $('#txt_apellidoP').val(),
        'apellidoM': $('#txt_apellidoM').val(),
        'correo': $('#txt_correo').val(),
        'usuario': $('#txt_usuario').val(),
        'pass': $('#txt_pass').val(),
        'telefono': $('#txt_telefono').val(),
        'tipoUser': parseInt($('#select_tipo').val(),10),
        'area' : $('#select_carrera').val(),
        'area_nombre' : $('#select_carrera option:selected').attr('valor')
    };

    //console.log(datosUsuario);
    return datosUsuario;

}