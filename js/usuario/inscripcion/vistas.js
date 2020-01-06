function vista_datosCurso(curso){

    $.post('php/usuario/curso/leer.php', curso, function(respuesta){
        respuesta = JSON.parse(respuesta);
        console.log(respuesta);
        $('#titulo_curso').text(respuesta.curso[0].titulo);
        $('#descripcion').text(respuesta.curso[0].descripcion);
        $('#tipo_Actividad').text(respuesta.curso[0].tipo_actividad);
        $('#requisitos').text(respuesta.curso[0].requisitos);
        $('#dirigido').text(respuesta.curso[0].dirigido);

        var profesor = "";
        for(var i=0; i<respuesta.profesor.length; i++){
            profesor += respuesta.profesor[i].nombre + "\n";
        }


        var resp = "";
        for(var i=0; i<respuesta.resp.length; i++){
            resp += respuesta.resp[i].nombre + "\n";
        }

        var material = "";

        for(var i=0; i<respuesta.material.length; i++){
            material += respuesta.material[i].nombreMaterial + " : " + respuesta.material[i].cantidadMaterial+ ",\n";
        }

        var horario = "";

        for(var i=0; i<respuesta.horario.length; i++){
            horario += respuesta.horario[i].fecha + " : " + respuesta.horario[i].HI + "-" + respuesta.horario[i].HF + ", " + respuesta.horario[i].lugar + ".\n";
        }

        $('#profesor').text(profesor);
        $('#colaborador').text(resp);
        $('#material').text(material);
        $('#horario').text(horario);
        
    });

}