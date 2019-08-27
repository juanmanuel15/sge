function obtenerDatos(){

    obj_alumno = $('#txt_alumno');
    obj_fechaCurso = $('#txt_fechaCurso');
    obj_lugar = $('#txt_lugarCurso');
    obj_fechaGeneracion = $('#txt_fechaGeneracion');
    obj_slogan = $('#txt_slogan');
    obj_director = $('#txt_director');
    obj_nombreCurso = $('#select_nombreCurso');
    obj_tipo_Documento = $('#select_tipoDocumento');
    obj_tituloEvento = $('#select_tituloEvento');
    obj_tipoActividad = $('#select_tActividad');

    alumno = vacio(obj_alumno);
    fechaCurso = vacio(obj_fechaCurso);
    lugar = vacio(obj_lugar);
    fechaGeneracion = vacio(obj_fechaGeneracion);
    slogan = vacio(obj_slogan);
    director = vacio(obj_director);
    
    if(alumno != true && fechaCurso != true && lugar != true &&  fechaGeneracion != true && slogan != true && director != true ){
        success('');
        datos = {
            'alumno' :  alumno,
            'fechaCurso' :  fechaCurso,
            'lugar' :  lugar,
            'fechaGeneracion' :  fechaGeneracion,
            'slogan' :  slogan,
            'director':  director,
            'tActividad' : obj_tipoActividad.val(),
            'tipoDocumento' :  obj_tipo_Documento.val(),
            'nombreCurso' :  obj_nombreCurso.val(),
            'tituloEvento' : obj_tituloEvento.val() 
        };

        var link = `personalizar/constancia.php?alumno=${alumno}&fechaCurso=${fechaCurso}&lugar=${lugar}&fechaGeneracion=${fechaGeneracion}&slogan=${slogan}&director=${director}&tActividad=${obj_tipoActividad.val()}&tipoDocumento=${obj_tipoActividad.val()}&tipoDocumento=${obj_tipo_Documento.val()}&nombreCurso=${obj_nombreCurso.val()}&tituloEvento=${obj_tituloEvento.val()}`;

        $('#btn_generarConstancia').attr('href', link);



    }else{

        error('Rellene todos los campos');
        datos = false;
        
    }


    return datos;



    
}


function vacio(obj){
    valor = obj.val();
    if(valor == ''){
        obj.addClass('input-vacio');        
        respuesta =  true;
    }else{
        obj.removeClass('input-vacio');
        respuesta =  obj.val();
    }   

    return respuesta;



}

function error(msg){
    $('#msg_Constancia').empty();
    $('#msg_Constancia').removeClass('mensaje-success');
    $('#msg_Constancia').addClass('mensaje-error');
    msg = `<label> ${msg} </label>`
    $('#msg_Constancia').append(msg);
}

function success(msg){
    $('#msg_Constancia').empty();
    $('#msg_Constancia').removeClass('mensaje-error');
    msg = `<label> ${msg} </label>`
    $('#msg_Constancia').append(msg);
}