function vista_modal_horarioCurso(datos){
    $('#tableBody_asistenciaUsuario').empty();
    $.post('reporte-usuario/horarioCurso.php', datos,function(respuesta){

        respuesta = JSON.parse(respuesta);

        if(respuesta['servidor'] != false){
            if(respuesta['vacio'] != false){
                if(respuesta['conn'] != false){
                    if(respuesta['horario'] != false){
                        var horario = respuesta['horario'];
                        for(var i = 0; i < horario.length; i++){
                            
                            <tr>
                                <td>${i+1}</td>
                                <td>${horario['fecha']}</td>
                                <td></td>
                            </tr>

                        }
                    }else {
                        msg = "No tienes cursos inscritos";
                    }
                }else {
                    msg = "Falló la conexión, intenta más tarde";
                }
            }else {
                msg = "Campo Vacio";
            }
        }else{
            msg = "Erroe al procesar la petición";
        }
        

    });

}