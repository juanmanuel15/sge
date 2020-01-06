function vista_selects(){
    $.post('personalizar/configurar.php', function(respuesta){
        respuesta = JSON.parse(respuesta);
        console.log(respuesta);
        if(respuesta['conn'] == false){
            if(respuesta['resp'] != false){


                /* Select Titulo del evento*/
                evento =  respuesta['resp']['evento'];
                var texto = '';

                for(i = 0; i< evento.length; i++){

                    texto += `
                        <option value = "${evento[i]['evento']}">${evento[i]['evento']}</option>
                    `; 
                }

                $('#select_tituloEvento').append(texto);

                /* Select Tipo de Documento*/
                texto = '';


                for(i = 0; i< evento.length; i++){

                    texto += `
                        <option value = "${evento[i]['tipo_documento']}">${evento[i]['tipo_documento']}</option>
                    `; 
                }

                $('#select_tipoDocumento').append(texto);

                /* Select Tipo de Actividad

                texto = '';
                tActividad =  respuesta['resp']['tActividad'];

                for(i = 0; i< tActividad.length; i++){

                    texto += `
                        <option value = "${tActividad[i]['tActividad']}">${tActividad[i]['tActividad']}</option>
                    `; 
                }

                $('#select_tActividad').append(texto);*/

                /* Select Titulo del Curso */
                texto = '';
                curso =  respuesta['resp']['tituloCurso'];

                for(i = 0; i< curso.length; i++){

                    texto += `
                        <option value = "${curso[i]['id_curso']}">${curso[i]['tituloCurso']}</option>
                    `; 
                }

                $('#select_nombreCurso').append(texto);


                var texto = '';
                var user = '';

                var tipo_usuario = respuesta['resp']['tipoUsuario'];
                for(var i= 0; i<tipo_usuario.length; i++){
                    console.log(tipo_usuario[i].id_tipoUsuario);
                    switch(tipo_usuario[i].id_tipoUsuario){
                        case '0': user = "col"; break;
                        case '1': user = "admin"; break;
                        case '2': user = "pon"; break;
                        case '3': user = "asis"; break;
                        default: user = "nOption"; break;
                    }
                    texto += `
                        <option value = ${user}>${tipo_usuario[i]['tipoUsuario']}</option>
                    `; 
                }

                $('#select_personalizarContancia').append(texto);



            }else {
                console.log('Error');
            }

        }
    });
}


function vista_btn(btn_generar, btn_verificar){
    if(btn_generar == 1){        
        $('#btn_generarConstancia').show();
    }else{
        $('#btn_generarConstancia').hide();
    }


    if(btn_verificar == 1){
        $('#btn_verficar').show();
    }else{
        $('#btn_verficar').hide();
    }
    
}