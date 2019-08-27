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

                /* Select Tipo de Actividad*/

                texto = '';
                tActividad =  respuesta['resp']['tActividad'];

                for(i = 0; i< tActividad.length; i++){

                    texto += `
                        <option value = "${tActividad[i]['tActividad']}">${tActividad[i]['tActividad']}</option>
                    `; 
                }

                $('#select_tActividad').append(texto);

                /* Select Titulo del Curso */
                texto = '';
                tituloCurso =  respuesta['resp']['tituloCurso'];

                for(i = 0; i< tituloCurso.length; i++){

                    texto += `
                        <option value = "${tituloCurso[i]['tituloCurso']}">${tituloCurso[i]['tituloCurso']}</option>
                    `; 
                }

                $('#select_nombreCurso').append(texto);



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