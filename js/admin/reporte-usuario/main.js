$(document).ready(function(){
    leer();
    confIniciales_reporteUsuario();
    var id_asistenciaCurso;
    var id_registro;
    


    $(document).on('click', '#btn_asistencia', function(){
        id_asistenciaCurso = { 'id' : $(this).attr("valor")};        
        vista_modal_horarioCurso(id_asistenciaCurso);
        $('#asistencia_usuario').modal('show');
        $('#msg_asistencia').empty();

        
    });


    $(document).on('click', '#btn_modal_aceptarEliminarRegistro',function(){  
        $.post('reporte-usuario/eliminar_registroAsistencia.php', id_registro, function(respuesta){
            respuesta = JSON.parse(respuesta); 
            obj_mensaje = $('#msg_asistencia');           
            control_errores(obj_mensaje, respuesta, "Error al eliminar el registro", "Se elimino el registro correctamente");  
            vista_modal_horarioCurso(id_asistenciaCurso);          
            $('#modal_eliminarRegistroAsistencia').hide();
            $('#modal_mostrarAsistencia').show();
        });



    });

    $(document).on('click', '#btn_modal_cancelarEliminarRegistro',function(){
        $('#msg_asistencia').empty();
        $('#modal_eliminarRegistroAsistencia').hide();
        $('#modal_mostrarAsistencia').show()
    });


    $(document).on('click', '#btn_eliminarRegistroAsistencia', function(respuesta){
        id_registro = {'id': $(this).attr('valor')};
        $('#modal_eliminarRegistroAsistencia').show();
        $('#modal_mostrarAsistencia').hide();
        
    });


    $(document).on('click', '#agregar_registroAsistencia', function(){
        vista_agregar_RegistroAsistencia(id_asistenciaCurso);        
        mensaje_limpiar($('#msg_agregarRegistroAsistencia'));
        
    });

    $(document).on('submit', '#form_agregarRegistroAsistencia', function(e){
        e.preventDefault();

        var entrada = $('#cbox1').prop('checked');
        var salida = $('#cbox2').prop('checked');

        var fecha = $('#date_fechaRegistro').val();

        if(fecha == ''){

            mensaje_limpiar($('#msg_agregarRegistroAsistencia'));

            msg = '<label>Rellene el campo de la fecha</label>';
            mensaje_error($('#msg_agregarRegistroAsistencia'), msg);

        }else { 
            var datos  = {'entrada' : entrada, 'salida' : salida, 'fecha': fecha, 'id': id_asistenciaCurso['id']};
            $('#msg_agregarRegistroAsistencia').removeClass('mensaje-error');
            obj_msg_agregarRegistro = $('#msg_agregarRegistroAsistencia');

            mensaje_limpiar($('#msg_asistencia'));

            $.post('reporte-usuario/registrarAsistencia.php', datos, function(respuesta){
                respuesta = JSON.parse(respuesta);
                control_errores(obj_msg_agregarRegistro, respuesta, "Error al insertar el registro", "Registro insertado exitosamente");
                vista_modal_horarioCurso(id_asistenciaCurso);
                
            });

            $('#form_agregarRegistroAsistencia')[0].reset();

        }


        
    });


    $(document).on('click', '#btn_cancelarAgregarRegistro', function(){
        $('#modal_agregarRegistroAsistencia').hide();
        $('#modal_mostrarAsistencia').show();
        mensaje_limpiar($('#msg_asistencia'));
    });


    $(document).on('submit', '#form_buscarRegistroAsistencia', function(e){
        e.preventDefault();

        var txt_buscarCursoUsuario = $('#buscar_Asistencia').val();
        txt_buscarCursoUsuario = {'txt' : txt_buscarCursoUsuario}; 

        if(txt_buscarCursoUsuario === ''){
            leer();
        } else {
            $.post('reporte-usuario/buscarUsuarioCursoAsistencia.php', txt_buscarCursoUsuario, function(respuesta){
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


$(document).on('submit', '#form_actualizarAsistencia', function(e){
    e.preventDefault();

    var obj_check = $("input[name = 'check']");
    var check = array(obj_check);

    vista_msg_actualizarAsistencia(check);
    
});





$(document).on('click', '#btn_salir', function(){
    $('#asistencia_usuario').modal('hide');
});


    



function leer(){
    $('#tablaReporteUsuario').empty();

    $.get('reporte-usuario/leer.php',function(respuesta) {
            //console.log(respuesta);
            var usuario = JSON.parse(respuesta);
            //console.log(usuario[0].numeroCuenta);
            var fila = '';

            for(var i =0; i<usuario.length; i++){

                fila += "<tr id=\"" + usuario[i].numeroCuenta + "\">";
                fila += "<td>" + usuario[i].numeroCuenta + "</td>";   
                fila += "<td>" + usuario[i].nombreCompleto+ "</td>";
                fila += "<td>" +usuario[i].titulo + "</td>";
                fila += `<td><span class = "i_asistencia"><i class="fas fa-book-open" valor = "${usuario[i]['usuario']}&${usuario[i]['curso']}" id = "btn_asistencia"></i></span></td>`;           
                fila += `<td><span class = "i_mostrar"><a href = "reporte-usuario/constancia.php?curso='${usuario[i]['curso']}'&usuario='${usuario[i]['usuario']}'"><i class="fas fa-share"></a></i></span></td>`;
                fila += "</tr>";
            }
            
            
            

		$('#tablaReporteUsuario').append(fila);
	


	});
}


function confIniciales_reporteUsuario(){
    $('#msg_asistencia').empty();
    $('#modal_eliminarRegistroAsistencia').hide();
    $('#modal_mostrarAsistencia').show();
    $('#modal_agregarRegistroAsistencia').hide();

}


function array(lectura){

	var  array= [];

	for (var i = 0; i < lectura.length; i++) {
            var valor = `chk${i+1}`;
			array.push(valor);
        }        
        
        return obtenerSeleccion(array);
}


function obtenerSeleccion(array){
    asistencia = []; 
    id = []; 

    for(var i=0; i<array.length; i++){
        
        seleccion = $(`#${array[i]}`).prop('checked');
        curso = $(`#${array[i]}`).attr('valor');

        asistencia.push(seleccion);
        id.push(curso);        
    }


    return datos = {'asistencia' : asistencia, 'id' : id};
}


function control_errores(obj_mensaje,datos, msg_e, msg_s){
    obj_mensaje.empty();
    msg = "<label>";  

    if(datos['servidor'] != true){
        if(datos['vacio'] != true){
            if(datos['conn'] != true){
                if(datos['success'] == true){
                    obj_mensaje.addClass('mensaje-success');
                    msg += msg_s;
                }else{
                    obj_mensaje.addClass('mensaje-error');
                    msg += msg_e;
                }
            }else{
                obj_mensaje.addClass('mensaje-error');
                msg += msg_e;
            }
        }else{
            obj_mensaje.addClass('mensaje-error');
            msg += msg_e;
        }
    }else{
        obj_mensaje.addClass('mensaje-error');
        msg += msg_e;
    }
    
    msg += "</label>"

    obj_mensaje.append(msg);    
    

}

function mensaje_error(obj,msg){
    obj.empty();
    obj.removeClass('mensaje-success');
    obj.addClass('mensaje-error');
    obj.append(msg);
}

function mensaje_success(obj, msg){
    obj.empty();
    obj.addClass('mensaje-success');
    obj.removeClass('mensaje-error');
    obj.append(msg);
}


function mensaje_limpiar(obj){
    obj.empty();
    obj.removeClass('mensaje-success');
    obj.removeClass('mensaje-error');
}


function seleccionadorVentanas(asist, eliminar, mostrar, agregar){
    
}





