$(document).ready(function (){

    leer();

    $('#btn_agregar').on('click', function(){
        quitarClases(); 
        $('#exampleModalLabel').text('Agregar Lugar');
        $('#btn_aceptar').val('Agregar');
    });

    $(document).on('click', '#btn_editar',function(){
         
        quitarClases();
        $('#exampleModalLabel').text('Actualizar Lugar');
        $('#btn_aceptar').val('Actualizar');

        var id = { 'id' : $(this).parent().parent().attr("id")};

         $.ajax({
                
            url:'lugar/editarLugar.php',
            data: id,
            dataType: 'json',
            type: 'post',
            success: function(respuesta){
                
                $('#txt_nombreLugar').val(respuesta[0].nombreLugar);
                $('#txt_cantidadLugar').val(respuesta[0].cantidadLugar);
                
               var campoID = "<label  hidden for = \" txt_id\"  class=\"col-form-label\">id: </label>" ;
               var campoInput = "<input  hidden id =\"txt_id\" value = \""+ respuesta[0].id + "\"  class=\"form-control\"></input>";
               $('#divInputId').append(campoInput);
               $('#divLabelId').append(campoID);                
               $('#modal_agregar').modal('show');
            }


        });

        });

    
    $('#formLugar').submit(function(e){

        e.preventDefault();

        $('#divMensaje').empty();
       

        var nombreLugar = $('#txt_nombreLugar').val();
        var cantidadLugar = $('#txt_cantidadLugar').val();
        var id = $('#txt_id').val();


        
        if(nombreLugar == '' || cantidadLugar ==''){

            $('#divMensaje').removeClass('mensaje-success');
            $('#divMensaje').addClass('mensaje-error');
            $('#divMensaje').append('<label>No se han llenado los datos</label>');
            $('#txt_nombreLugar').addClass('input-vacio');
            $('#txt_cantidadLugar').addClass('input-vacio');

        }else {
            
            if(id === undefined){
                crear(nombreLugar, cantidadLugar);
                vaciarFormulario();
                $('#divMensaje').append('<label> Datos guardados correctamente</label>');
                $('#divMensaje').addClass('mensaje-success'); 
            }else {

                actualizar(id,nombreLugar,cantidadLugar); 
                $('#divMensaje').append('<label> Datos actualizados correctamente</label>');
                $('#divMensaje').addClass('mensaje-update'); 
            }

                
                $('#divMensaje').removeClass('mensaje-error');                
                $('#txt_nombreLugar').removeClass('input-vacio');
                $('#txt_cantidadLugar').removeClass('input-vacio');
                
                

        
        }

               

        
    });

    $('#btn_cancelar').on('click',quitarClases);
    
    $(document).on('click','#btn_eliminar', function(){
        var id = { 'id' : $(this).parent().parent().attr("id")};
        if(confirm('¿Desea eliminarlo?')){
            eliminar(id);
        }
        
    });
    
    
    function crear(nombreLugar, cantidadLugar){
        var datos = {
            'nombreLugar': nombreLugar,
            'cantidadLugar' : cantidadLugar            
        };


        $.ajax({
            url: 'lugar/insertarLugar.php',
            type: 'post',
            data: datos,
            success : function(respuesta){
                leer();
            
            }
            });

        
    }


    function actualizar(id,nombreLugar, cantidadLugar){
        
        var datos = {
            'nombreLugar': nombreLugar,
            'cantidadLugar': cantidadLugar,
            'id': id
        };

        $.ajax({
            url: 'lugar/actualizarLugar.php',
            type: 'post',
            dataType: 'json',
            data: datos,
            success : function(respuesta){
                
                vaciarFormulario();
                leer();


            }
       });

    }
    
    
    function leer(){
        $('#tablaLugar').empty();

        $.ajax({
            url: 'lugar/leerLugar.php',
            dataType: 'JSON', 
            type:'GET', 
            success : function(respuesta){
                var fila = '';
                respuesta.forEach(function (element) {
                    fila += "<tr id=\"" + element['id'] + "\">";
                    fila += "<td>" + element['nombreLugar'] + "</td>";
                    fila += "<td>" + element['cantidadLugar'] + "</td>";
                    fila += "<td><button type=\"button\" id = \"btn_editar\" class= \"btn btn-editar\">Editar</button>";
                    fila += "<td><button type=\"button\" id = \"btn_eliminar\" class= \"btn btn-eliminar\">Eliminar</button>";
                    fila += "</tr>";
                    
                    
                });

                $('#tablaLugar').append(fila);

                
            }
    
        });
    }


    function quitarClases(){
        $('#divMensaje').empty();
        $('#divMensaje').removeClass('mensaje-error');
        $('#divMensaje').removeClass('mensaje-sucess');
        $('#divMensaje').removeClass('mensaje-update');
        $('#txt_nombreLugar').removeClass('input-vacio');
        $('#txt_cantidadLugar').removeClass('input-vacio');
        $('#txt_nombreLugar').val('');
        $('#txt_cantidadLugar').val('');
        $('#divInputId').empty();
        $('#divLabelId').empty();
        


    }

    function eliminar (id){
       
        
        $.ajax({
            url: 'lugar/eliminarLugar.php',
            data: id,
            dataType: 'json',
            type:'post',
            success : function(respuesta){
                leer();
            }
        }); 
    }

    function vaciarFormulario(){
        $('#txt_cantidadLugar').val('');
        $('#txt_nombreLugar').val('');
        $('#txt_id').val('');
    }


});

