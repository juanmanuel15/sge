function vista_modal_horarioCurso(datos){
    
    $('#tableBody_asistenciaUsuario').empty();
    $.post('horarioCurso.php', datos,function(respuesta){
        respuesta = JSON.parse(respuesta);
        console.log(respuesta);
        msg = "";
        if(respuesta['servidor'] != true){
            if(respuesta['vacio'] != true){
                if(respuesta['conn'] != true){
                    if(respuesta['asistencia'] != true){                        
                            var asistencia = respuesta['asistencia'];
                            
                                msg = "Son iguales";
                                var texto = ``;

                                console.log(asistencia);
                                
                                
                                
                                for(var i = 0; i < asistencia.length; i++){

                                    texto += `

                                    <tr>
                                        <td>${i+1}</td>
                                        <td>${asistencia[i]['fecha_e']}</td>
                                        <td>${asistencia[i]['fecha_s']}</td>
                                        <td>${asistencia[i]['hora_e']}</td>
                                        <td>${asistencia[i]['hora_s']}</td>
                                        <td>
                                    `;

                                    if(asistencia[i]['check_in'] == '1'){
                                        texto +=  `<input type = "checkbox" name = "check" valor = '${asistencia[i]['id']}_in' id = "chk${2*i+1}" value = "${asistencia[i]['check_in']}" checked>`;
                                    }else{
                                        texto +=  `<input type = "checkbox" name = "check" valor = '${asistencia[i]['id']}_in' id = "chk${2*i+1}" value = "${asistencia[i]['check_in']}" >`;
                                    }

                                    texto += `</td><td>`


                                    if(asistencia[i]['check_out'] == '1'){
                                        texto +=  `<input type = "checkbox" name = "check" valor = '${asistencia[i]['id']}_out' id = "chk${2*i+2}" value = "${asistencia[i]['check_out']}" checked >`;
                                    }else{
                                        texto +=  `<input type = "checkbox" name = "check" valor = '${asistencia[i]['id']}_out' id = "chk${2*i+2}" value = "${asistencia[i]['check_out']}" >`;
                                    }                                        
                                    
                                    texto += `
                                    </td>
                                    <td><span valor = "${asistencia[i]['id']}" id = "btn_eliminarRegistroAsistencia"><i class="fas fa-trash i_eliminar"></i></span></td>
                                    
                                      
                                        
                                    </tr>                                    
                                    `;  
                                    
                                    
                                    
                                }


                                texto += ``;
                                //console.log(texto);
                                $('#tableBody_asistenciaUsuario').append(texto); 
                            
                        
                    }else {
                        msg += "No tienes asistencias registradas";
                    }
                }else {
                    msg += "Falló la conexión, intenta más tarde";
                }
            }else {
                msg += "Campo Vacio";
            }
        }else{
            msg += "Error al procesar la petición";
        }

    });

}


function vista_msg_actualizarAsistencia(datos){
    $('#msg_asistencia').empty();
    $.post('actualizarAsistencia.php', datos, function(respuesta){
        var error  = 1;
        respuesta = JSON.parse(respuesta);
        if(respuesta['servidor'] != true){
            if(respuesta['vacio'] != true){
                if(respuesta['conn'] != true){
                    if(respuesta['asistencia'] != true){
                        error = 0;
                        msg = "<label>Asistencia actualizada</label>";
                    }else{
                        msg = "<label>La asistencia no se pudo actualizar</label>";
                    }
                }else{
                    msg = "<label>Conexión fallida</label>";
                }

            }else{
                msg = "<label>Campos vacíos</label>";
            }
        }else{
            msg = "<label>Conexión fallida</label>";
        }

        if(error == 0){
            $('#msg_asistencia').removeClass('mensaje-error');
            $('#msg_asistencia').addClass('mensaje-success');  
        
        }else if(error == 1){            
            $('#msg_asistencia').removeClass('mensaje-success');
            $('#msg_asistencia').addClass('mensaje-error');
        }
        

        $('#msg_asistencia').append(msg);
    });
}


function vista_agregar_RegistroAsistencia(id){
    $('#modal_mostrarAsistencia').hide();
    $('#modal_agregarRegistroAsistencia').show();

}


function vista_principalBuscarCurso(usuario){
   
    $('#tablaReporteUsuario').empty();
    var fila ='';

    for(var i =0; i<usuario.length; i++){

        fila += "<tr id=\"" + usuario[i].numeroCuenta + "\">";
        fila += "<td>" + usuario[i].numeroCuenta + "</td>";   
        fila += "<td>" + usuario[i].nombreCompleto+ "</td>";
        fila += "<td>" +usuario[i].titulo + "</td>";
        fila += `<td><span class = "i_asistencia"><i class="fas fa-book-open" valor = "${usuario[i]['usuario']}&${usuario[i]['curso']}" id = "btn_asistencia"></i></span></td>`;           
        fila += `<td><span class = "i_mostrar"><a href = "constancias.php?curso=${usuario[i]['curso']}&usuario=${usuario[i]['usuario']}"><i class="fas fa-share"></a></i></span></td>`;
        fila += "</tr>";
    }


    $('#tablaReporteUsuario').append(fila);
}