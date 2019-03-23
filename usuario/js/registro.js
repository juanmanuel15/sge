$(document).ready(function() {

    $('#registro').submit(function(e){
        
        e.preventDefault();
        $('#divMensaje').empty();
        removerClases();

        var objNombre = $('#nombre');
        var objApellidoP = $('#apellidoP');
        var objApellidoM = $('#apellidoM');
        var objCorreo = $('#correo');
        var objCorreo2 = $('#correo2');
        var objUsuario = $('#usuario');
        var objPass = $('#pass');
        var objPass2 = $('#pass2');
        var objtelefono = $('#telefono');

        var vacioNombre = vacio(objNombre);
        var vacioApellidoP = vacio(objApellidoP);
        var vacioApellidoM = vacio(objApellidoM);
        var vacioCorreo = vacio(objCorreo);
        var vacioCorreo2 = vacio(objCorreo2);
        var vacioUsuario = vacio(objUsuario);
        var vacioPass = vacio(objPass);
        var vacioPass2 = vacio(objPass2);
        var vacioTelefono = vacio(objtelefono);

   
        

        if(!vacioNombre || !vacioApellidoP || !vacioApellidoM || !vacioCorreo || !vacioCorreo2 || !vacioUsuario || !vacioPass2 || !vacioPass || !vacioTelefono){
            $('#divMensaje').addClass('mensaje-error');
            $('#divMensaje').append('<li>Campos vacíos</li>');
        }else {
            $('#divMensaje').addClass('mensaje-error');
            var lista = "<ul>";
            if(objCorreo.val() != objCorreo2.val()){
               lista += "<li>Correo diferente</li>";
            }
            if(objPass.val() != objPass2.val()){
                lista += "<li>Contraseña diferente</li>";
            }            
            lista += "</ul>";
            $('#divMensaje').append(lista);


        }
    });
});


function vacio(obj){
    if(obj.val() == ''){
        obj.addClass('input-vacio');
        return false;
    }else {
        obj.removeClass('input-vacio');
        return true;
    }
}

function comprobar(usuario, nCuenta){

    $.get('php/comprobar.php', function(respuesta){
        console.log(respuesta);
    });
}

function removerClases(){
    $('#divMensaje').removeClass('mensaje-error');
}