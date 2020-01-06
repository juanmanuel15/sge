$(document).ready(function() {

    select_area();
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
        var objCuenta = $('#nCuenta');
        var objCarrera = $('#select_carrera');
        var  objNombreCarrera = $('#select_carrera option:selected').attr('valor')
        console.log(objNombreCarrera);

        removerEstilos(objCuenta, 'input-vacio');
        removerEstilos(objCorreo, 'input-vacio');
        removerEstilos(objUsuario, 'input-vacio');
        removerEstilos($('#divMensaje'), 'mensaje-success');

        var vacioNombre = vacio(objNombre);
        var vacioApellidoP = vacio(objApellidoP);
        //var vacioApellidoM = vacio(objApellidoM);
        var vacioCorreo = vacio(objCorreo);
        var vacioCorreo2 = vacio(objCorreo2);
        var vacioUsuario = vacio(objUsuario);
        var vacioPass = vacio(objPass);
        var vacioPass2 = vacio(objPass2);
        var vacioTelefono = vacio(objtelefono);
        var vacioCuenta = vacio(objCuenta);

   
        

        if(!vacioNombre || !vacioApellidoP || !vacioCorreo || !vacioCorreo2 || !vacioUsuario || !vacioPass2 || !vacioPass || !vacioTelefono){
            $('#divMensaje').addClass('mensaje-error');
            $('#divMensaje').append('<li>Campos vacíos</li>');
        }else {
            var lista = "<ul>";

            if(objCorreo.val() !=  objCorreo2.val() || objCorreo.val() != objCorreo2.val()){
                $('#divMensaje').addClass('mensaje-error');
                

                if(objCorreo.val() != objCorreo2.val()){
                lista += "<li>Correo diferente</li>";
                }

                if(objPass.val() != objPass2.val()){
                    lista += "<li>Contraseña diferente</li>";
                }            
                lista += "</ul>";
                $('#divMensaje').append(lista); 

            }else {
                
                var datosComprobar = {
                    'usuario' : objUsuario.val(),
                    'nCuenta' : objCuenta.val(),
                    'mail' : objCorreo.val()
                };

                $.post('php/usuario/comprobar.php', datosComprobar, function(respuesta){
                    respuesta = JSON.parse(respuesta);
                    console.log(respuesta);

                    if(respuesta.cuenta || respuesta.correo || respuesta.usuario){                

                        if(respuesta.cuenta){
                            lista += "<li> Cuenta ya existente </li>";
                            objCuenta.addClass('input-vacio');
                        }

                        if(respuesta.correo){
                            lista += "<li> Correo ya existente </li>";
                            objCorreo.addClass('input-vacio');
                            
                        }

                        if(respuesta.usuario){

                            lista += "<li>Usuario ya existente </li>";
                            objUsuario.addClass('input-vacio');
                        }

                        lista += "</ul>";
                        $('#divMensaje').addClass('mensaje-error');
                        $('#divMensaje').append(lista);

                    }else {
                        var datosEnviar = {
                            'cuenta' : objCuenta.val(),
                            'nombre' : objNombre.val(),
                            'apellidoP' : objApellidoP.val(),
                            'apellidoM' : objApellidoM.val(), 
                            'correo' : objCorreo.val(),
                            'usuario' : objUsuario.val(),
                            'pass' : objPass.val(),
                            'tel' : objtelefono.val(),
                            'area': objCarrera.val(),
                            'area_nombre': objNombreCarrera
                        };

                        $.post('php/usuario/insertar.php', datosEnviar, function(respuesta){
                            respuesta = JSON.parse(respuesta);
                            console.log(respuesta);
                            if(!respuesta.conn && !respuesta.servidor && !respuesta.vacio){
                                $('#divMensaje').addClass('mensaje-success');
                                $('#divMensaje').append("<label>Usuario Agregado, por favor ingresa </label>");
                                 vaciar();
                            }else {
                                $('#divMensaje').addClass('mensaje-error');
                                $('#divMensaje').append("<label>El usuario no se ha podido agregar </label>")
                            }
                        });
                        
                    }
                });
            }
            

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



function removerClases(){
    $('#divMensaje').removeClass('mensaje-error');
}

function removerEstilos(obj, clase){
    obj.removeClass(clase)
}

function select_area(){
    $.post('../sge/php/admin/elemento-usuario/select_carrera.php', function(respuesta){
        respuesta = JSON.parse(respuesta);
        console.log(respuesta);

        if(respuesta.conn == false){
            
            var select_carrera = "";
            var carrera = respuesta.resultado;          
            console.log(carrera);

        
            for( i=0; i<carrera.length; i++) {
                select_carrera += `
                    <option value = ${carrera[i].id} valor = "${carrera[i].nombre}">${carrera[i].nombre}</option>
                `;
            }

            //console.log(select_carrera);

            $('#select_carrera').append(select_carrera);

            
        }else{
            console.log("error al encontrar la dirección");
        }
    });
}

function vaciar(){
    
$('#nombre').val('');
$('#apellidoP').val('');
$('#apellidoM').val('');
$('#correo').val('');
$('#correo2').val('');
$('#usuario').val('');
$('#pass').val('');
$('#pass2').val('');
$('#telefono').val('');
$('#nCuenta').val('');
}