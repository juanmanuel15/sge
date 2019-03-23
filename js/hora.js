$(document).ready(function (){

    leerHora();

    $('#btn_agregarHora').on('click', function(){
        quitarClases(); 
        $('#exampleModalLabel').text('Agregar Hora');
        $('#btn_aceptarHora').val('Agregar');
    });

    $('#btn_agregarFecha').on('click', function(){
        quitarClases(); 
        $('#exampleModalLabel').text('Agregar Fecha');
        $('#btn_aceptarFecha').val('Agregar');
    });

    $(document).on('click', '#btn_editarHora',function(){
         
        quitarClases();
        $('#exampleModalLabel').text('Actualizar Lugar');
        $('#btn_aceptar').val('Actualizar');

        var id = { 'id' : $(this).parent().parent().attr("id")};

         $.ajax({
                
            url:'horario/editarHora.php',
            data: id,
            dataType: 'json',
            type: 'post',
            success: function(respuesta){
                
                $('#txt_hora').val(respuesta[0].hora);
                
               var campoID = "<label  hidden for = \" txt_id\"  class=\"col-form-label\">id: </label>" ;
               var campoInput = "<input  hidden id =\"txt_id\" value = \""+ respuesta[0].id + "\"  class=\"form-control\"></input>";
               $('#divInputId').append(campoInput);
               $('#divLabelId').append(campoID);                
               $('#modal_agregar_hora').modal('show');
            }


        });

        });

    
    $('#formHora').submit(function(e){

        e.preventDefault();


        $('#divMensajeHora').empty();
              

        var hora = $('#txt_hora').val();
        var id = $('#txt_id').val();


        
        if(hora == '' ){

            $('#divMensajeHora').removeClass('mensaje-success');
            $('#divMensajeHora').removeClass('mensaje-update');
            $('#divMensajeHora').addClass('mensaje-error');
            $('#divMensajeHora').append('<label>No se han llenado los datos</label>');
            $('#txt_hora').addClass('input-vacio');

        }else {
            
            if(id === undefined){
                crear(hora);
                vaciarFormulario();
                $('#divMensajeHora').append('<label> Datos guardados correctamente</label>');
                $('#divMensajeHora').addClass('mensaje-success'); 

            }else {

                actualizar(id,hora); 
                $('#divMensajeHora').append('<label> Datos actualizados correctamente</label>');
                $('#divMensajeHora').addClass('mensaje-update'); 

            }

                
                $('#divMensajeHora').removeClass('mensaje-error');                
                $('#txt_hora').removeClass('input-vacio');
        }
  
    });

    $('#btn_cancelar').on('click',quitarClases);
    
    $(document).on('click','#btn_eliminarHora', function(){
        var id = { 'id' : $(this).parent().parent().attr("id")};
        if(confirm('¿Desea eliminarlo?')){
            eliminar(id);
        }
        
    });
    
    
    function crear(hora){
        var datos = {
            'hora': hora           
        };


        $.ajax({
            url: 'horario/insertarHora.php',
            type: 'post',
            data: datos,
            success : function(respuesta){
                leerHora();
            
            }
            });

        
    }


    function actualizar(id,hora){
        
        var datos = {
            'hora': hora,
            'id': id
        };

        $.ajax({
            url: 'horario/actualizarHora.php',
            type: 'post',
            dataType: 'json',
            data: datos,
            success : function(respuesta){
                
                vaciarFormulario();
                leerHora();


            }
       });

    }
    
    
    function leerHora(){
        $('#tablaHora').empty();

        $.ajax({
            url: 'horario/leerHora.php',
            dataType: 'JSON', 
            type:'GET', 
            success : function(respuesta){
                var fila = '';
                respuesta.forEach(function (element) {
                    fila += "<tr id=\"" + element['id'] + "\">";
                    fila += "<td >" + element['hora'] + "</td>";
                    fila += "<td><button type=\"button\" id = \"btn_editarHora\" class= \"btn btn-editar\">Editar</button>";
                    fila += "<td><button type=\"button\" id = \"btn_eliminarHora\" class= \"btn btn-eliminar\">Eliminar</button>";
                    fila += "</tr>";
                    
                    
                });

                $('#tablaHora').append(fila);

                
            }
    
        });
    }

    
    function quitarClases(){
        $('#divMensajeHora').empty();
        $('#divMensajeHora').removeClass('mensaje-error');
        $('#divMensajeHora').removeClass('mensaje-sucess');
        $('#divMensajeHora').removeClass('mensaje-update');
        $('#txt_hora').removeClass('input-vacio');
        $().removeClass('input-vacio');
        $('#txt_hora').val('');
        $().val('');
        $('#divInputId').empty();
        $('#divLabelId').empty();
        


    }

    function eliminar (id){
       
        
        $.ajax({
            url: 'Horario/eliminarHora.php',
            data: id,
            dataType: 'json',
            type:'post',
            success : function(respuesta){
                leerHora();
            }
        }); 
    }

    function vaciarFormulario(){
        $('#txt_hora').val('');
        $('#txt_id').val('');
    }




});

