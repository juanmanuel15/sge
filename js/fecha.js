$(document).ready(function (){

    leerFecha();

    $('#btn_agregarFecha').on('click', function(){
        quitarClases(); 
        $('#exampleModalLabel').text('Agregar Fecha');
        $('#btn_aceptarFecha').val('Agregar');
    });

    $('#btn_agregarFecha').on('click', function(){
        quitarClases(); 
        $('#exampleModalLabel').text('Agregar Fecha');
        $('#btn_aceptarFecha').val('Agregar');
    });

    $(document).on('click', '#btn_editarFecha',function(){
         
        quitarClases();
        $('#exampleModalLabel').text('Actualizar Fecha');
        $('#btn_aceptar').val('Actualizar');

        var id = { 'id' : $(this).parent().parent().attr("id")};

         $.ajax({
                
            url:'horario/editarFecha.php',
            data: id,
            dataType: 'json',
            type: 'post',
            success: function(respuesta){
                
                $('#txt_fecha').val(respuesta[0].fecha);
                
               var campoID = "<label  hidden for = \" txt_id\"  class=\"col-form-label\">id: </label>" ;
               var campoInput = "<input  hidden id =\"txt_id\" value = \""+ respuesta[0].id + "\"  class=\"form-control\"></input>";
               $('#divInputId').append(campoInput);
               $('#divLabelId').append(campoID);                
               $('#modal_agregar_fecha').modal('show');
            }


        });

        });

    
    $('#formFecha').submit(function(e){

        e.preventDefault();


        $('#divMensajeFecha').empty();
              

        var fecha = $('#txt_fecha').val();
        var id = $('#txt_id').val();


        
        if(fecha == '' ){

            $('#divMensajeFecha').removeClass('mensaje-success');
            $('#divMensajeFecha').removeClass('mensaje-update');
            $('#divMensajeFecha').addClass('mensaje-error');
            $('#divMensajeFecha').append('<label>No se han llenado los datos</label>');
            $('#txt_fecha').addClass('input-vacio');

        }else {
            
            if(id === undefined){
                crear(fecha);
                vaciarFormulario();
                $('#divMensajeFecha').append('<label> Datos guardados correctamente</label>');
                $('#divMensajeFecha').addClass('mensaje-success'); 

            }else {

                actualizar(id,fecha); 
                $('#divMensajeFecha').append('<label> Datos actualizados correctamente</label>');
                $('#divMensajeFecha').addClass('mensaje-update'); 

            }

                
                $('#divMensajeFecha').removeClass('mensaje-error');                
                $('#txt_fecha').removeClass('input-vacio');
        }
        
    });

    $('#btn_cancelar').on('click',quitarClases);
    
    $(document).on('click','#btn_eliminarFecha', function(){
        var id = { 'id' : $(this).parent().parent().attr("id")};
        if(confirm('¿Desea eliminarlo?')){
            eliminar(id);
        }
        
    });
    
    
    function crear(fecha){
        var datos = {
            'fecha': fecha           
        };


        $.ajax({
            url: 'horario/insertarFecha.php',
            type: 'post',
            data: datos,
            success : function(respuesta){
                leerFecha();
            
            }
            });

        
    }


    function actualizar(id,fecha){
        
        var datos = {
            'fecha': fecha,
            'id': id
        };

        $.ajax({
            url: 'horario/actualizarFecha.php',
            type: 'post',
            dataType: 'json',
            data: datos,
            success : function(respuesta){
                
                vaciarFormulario();
                leerFecha();


            }
       });

    }
    
    
    function leerFecha(){
        $('#tablaFecha').empty();

        $.ajax({
            url: 'Horario/leerFecha.php',
            dataType: 'JSON', 
            type:'GET', 
            success : function(respuesta){
                var fila = '';
                respuesta.forEach(function (element) {
                    fila += "<tr id=\"" + element['id'] + "\">";
                    fila += "<td >" + element['fecha'] + "</td>";
                    fila += "<td><button type=\"button\" id = \"btn_editarFecha\" class= \"btn btn-editar\">Editar</button>";
                    fila += "<td><button type=\"button\" id = \"btn_eliminarFecha\" class= \"btn btn-eliminar\">Eliminar</button>";
                    fila += "</tr>";
                    
                    
                });

                $('#tablaFecha').append(fila);

                
            }
    
        });
    }

    
    function quitarClases(){
        $('#divMensajeFecha').empty();
        $('#divMensajeFecha').removeClass('mensaje-error');
        $('#divMensajeFecha').removeClass('mensaje-sucess');
        $('#divMensajeFecha').removeClass('mensaje-update');
        $('#txt_fecha').removeClass('input-vacio');
        $().removeClass('input-vacio');
        $('#txt_fecha').val('');
        $().val('');
        $('#divInputId').empty();
        $('#divLabelId').empty();
        


    }

    function eliminar (id){
       
        
        $.ajax({
            url: 'horario/eliminarFecha.php',
            data: id,
            dataType: 'json',
            type:'post',
            success : function(respuesta){
                leerFecha();
            }
        }); 
    }

    function vaciarFormulario(){
        $('#txt_fecha').val('');
        $('#txt_id').val('');
    }



    


});

