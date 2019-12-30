function obtenerDatos(){

    var obj_nombre = $('#txt_nombre');
    var obj_apellidoP = $('#txt_apellidoP');
    var obj_apellidoM = $('#txt_apellidoM');
    var obj_nombreCurso = $('#select_nombreCurso');
    var obj_tituloEvento = $('#select_tituloEvento');
    var obj_tipoUsuario = $('#select_personalizarContancia');

    nombre = vacio(obj_nombre);
    apellidoP = vacio(obj_apellidoP);
    
    if(!nombre  && !apellidoP){

        var nombre =  `${obj_nombre.val()}-${obj_apellidoP.val()}-${obj_apellidoM.val()}`;
        var nombreCurso =  obj_nombreCurso.val();
        var tituloEvento = obj_tituloEvento.val(); 
        var tipoUsuario = obj_tipoUsuario.val();

        datos = {
            'nombre' :  nombre,
            'nombreCurso' :  nombreCurso,
            'tituloEvento' : tituloEvento, 
            'tipoUsuario' : tipoUsuario
        };


        var link = `personalizar/constancia.php?nombre=${nombre}&nombreCurso=${nombreCurso}&tituloEvento=${tituloEvento}&tipoUsuario=${tipoUsuario}`;

        $('#btn_generarConstancia').attr('href', link);
        success('');


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
        respuesta = false;
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