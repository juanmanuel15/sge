function vista_panelPrincipal(datos){
    //console.log(datos);
    $('#tablaUsuario').empty();
    var texto = '';
    for(var i = 0; i< datos.length; i++){
        texto += `
            <tr>
                <td>${datos[i]['usuario']}</td> 
                <td>${datos[i]['nombre']}</td>
                <td>${datos[i]['tipo_usuario']}</td>         
                <td>${datos[i]['carrera']}</td>
                <td><span id = "btn_editar" valor = ${datos[i]['id']}><i class="fas fa-edit i_editar" ></i></span></td>
                <td><span id = "btn_eliminar" valor = "${datos[i]['id']}"><i class="fas fa-trash i_eliminar" ></i></span></td>
            </tr>
        `;
    }

    $('#tablaUsuario').append(texto);
}


function vista_select_tipoUsuario(datos){
    $('#select_tipo').empty();

    var texto  = '';

    for(i = 0; i<datos.length; i++){
        texto += `
        <option value = "${datos[i]['id']}"  valor = "${datos[i]['nombre']}">${datos[i]['nombre']} </option>
        `;
    }

    $('#select_tipo').append(texto);
}


function vista_select_carrera(datos){
    $('#select_carrera').empty();

    var texto  = '';

    for(i = 0; i<datos.length; i++){
        texto += `
        <option value = "${datos[i]['id']}" valor = "${datos[i]['nombre']}">${datos[i]['nombre']} </option>
        `;
    }

    $('#select_carrera').append(texto);    

}

function vista_select_carrera_editar(datos, area){
    $('#select_carrera').empty();

    var texto  = '';

    for(i = 0; i<datos.length; i++){

        //console.log(`${datos[i]['nombre']} == ${area}`);
        if(datos[i]['nombre'] == area){
            texto += `
            <option selected value = "${datos[i]['id']}" valor = "${datos[i]['nombre']}" >${datos[i]['nombre']} </option>
        `;
        
        
        }else{
            texto += `
                <option value = "${datos[i]['id']}" valor = "${datos[i]['nombre']}">${datos[i]['nombre']} </option>
            `;
        }
    }

    $('#select_carrera').append(texto);
}

function vista_select_tipoUsuario_editar(datos, tipo_usuario){
    $('#select_tipo').empty();
    

    var texto  = '';

    for(i = 0; i<datos.length; i++){
        
        if(datos[i]['nombre'] == tipo_usuario){
            texto += `
            
            <option selected  value = "${datos[i]['id']}" valor = "${datos[i]['nombre']}">${datos[i]['nombre']}</option>
        `;
        }else{
            texto += `
                <option value = "${datos[i]['id']}" valor = "${datos[i]['nombre']}">${datos[i]['nombre']}</option>
            `;
        }
        
    }

    $('#select_tipo').append(texto);
}




function vista_usuario_eliminado(valor){
    $('#msg_label').empty();
    $('#msg_label').removeClass('mensaje-error');
    $('#msg_label').removeClass('mensaje-success');

    if(valor == true){
    $('#msg_label').addClass('mensaje-success');
        texto = `<label>Usuario Eliminado Correctamente</label>`;
    }else  if(valor == false){
        $('#msg_label').addClass('mensaje-error');
        texto = `<label>No se pudo eliminar el usuario, intente más tarde</label>`;
        
    }

    $('#msg_label').append(texto);
    vistasModal(0,0,0,1);

}

function vista_editarUsuario(usuario){
    //console.log(usuario);
    

    $('#formUsuario_interno')[0].reset();
    $('#txt_ncuenta').val(usuario['cuenta']);
    $('#txt_nombre').val(usuario['nombre']);
    $('#txt_apellidoP').val(usuario['apellidoP']);
    $('#txt_apellidoM').val(usuario['apellidoM']);
    $('#txt_correo').val(usuario['correo']);
    $('#txt_usuario').val(usuario['usuario']);
    $('#txt_pass').val(usuario['pass']);
    $('#txt_pass2').val(usuario['pass']);
    $('#txt_telefono').val(usuario['telefono']);
    
    $('#modal_AgregarUsuario').modal('show');
    var area = usuario['area'];
    var tipo_usuario = usuario['tipoUsuario'];

    $.post('elemento-usuario/select_carrera.php', function(respuesta){
        respuesta = JSON.parse(respuesta);
        var carrera = respuesta['resultado'];
        vista_select_carrera_editar(carrera, area);        
    });

    $.post('elemento-usuario/select_tipoUsuario.php', function(respuesta){
        respuesta = JSON.parse(respuesta);
        var usuario = respuesta['resultado'];
        vista_select_tipoUsuario_editar(usuario, tipo_usuario);      
    });

    vistasModal(0,1,0,0);

}

function vista_actualizar_usuario(respuesta){
    $('#msg_agregarUsuario').empty();
    $('#msg_agregarUsuario').removeClass('mensaje-error');
    $('#msg_agregarUsuario').removeClass('mensaje-success');
    if(!respuesta['servidor']){
        if(!respuesta['vacio']){
            if(!respuesta['conn']){
                if(respuesta['conf'] != false){
                    $('#msg_agregarUsuario').addClass('mensaje-error');
                    msg = "<ul>";

                    if(respuesta['conf']['correo'] == true){                        
                        msg += "<li>Correo ya existente</li>"; 
                    }
                    if(respuesta['conf']['usuario'] == true){
                        msg += "<li>Usuario ya existente</li>";
                    }

                    if(respuesta['conf']['cuenta'] == true){
                        msg += "<li>Cuenta ya existente</li>";
                    }

                    msg += "</ul>" 
                    
                }else{
                    if(respuesta['success']){
                        $('#msg_agregarUsuario').addClass('mensaje-success');
                        msg = "<label>Usuario actualizado correctamnete</label>"
                    }else{
                        $('#msg_agregarUsuario').addClass('mensaje-error');
                        msg = "<label>El usuario no se modifico</label>"
                    }
                }
            }
        }
    }

    $('#msg_agregarUsuario').append(msg);
    leerUsuario();
}


function btn_agregarUsuario(){
    $('#btns_Usuario').empty();
    botones = `
    <input type="submit" value="Agregar" class = "btn btn-danger col-lg-3 col-4 " id = "agregar_usuario">

    <button type = "button" class = "btn btn-info col-lg-3 col-4" id = "atras_usuario">Atrás</button>

    <input type="reset" value="Cancelar" class = "btn btn-secondary col-lg-3 col-4 mx-2" id= "cancelar_usuario">`; 

    $('#btns_Usuario').append(botones);
}

function btn_editarUsuario(){

    $('#btns_Usuario').empty();

    botones = `
    <input type="submit" value="Actualizar" class = "btn btn-danger col-lg-3 col-4 " id = "editar_usuario">

    <input type="reset" value="Cancelar" class = "btn btn-secondary col-lg-3 col-4 mx-2" id= "cancelar_usuario">`; 

    $('#btns_Usuario').append(botones);
}