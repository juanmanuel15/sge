$(document).ready(function (){

    leer();

    $('#btn_agregar').on('click', function(){
        quitarClases(); 
        $('#exampleModalLabel').text('Agregar Material');
        $('#btn_aceptar').val('Agregar');
    });

    $(document).on('click', '#btn_editar',function(){
         
        quitarClases();
        $('#exampleModalLabel').text('Actualizar Material');
        $('#btn_aceptar').val('Actualizar');

        var id = { 'id' : $(this).parent().parent().attr("id")};

         $.ajax({
                
            url:'req/editarReq.php',
            data: id,
            dataType: 'json',
            type: 'post',
            success: function(respuesta){
                
                $('#txt_nombreReq').val(respuesta[0].nombreReq);
                
               var campoID = "<label  hidden for = \" txt_id\"  class=\"col-form-label\">id: </label>" ;
               var campoInput = "<input  hidden id =\"txt_id\" value = \""+ respuesta[0].id + "\"  class=\"form-control\"></input>";
               $('#divInputId').append(campoInput);
               $('#divLabelId').append(campoID);                
               $('#modal_agregar').modal('show');
            }


        });

        });

    
    $('#formReq').submit(function(e){

        e.preventDefault();

        $('#divMensaje').empty();
       

        var nombreReq = $('#txt_nombreReq').val();
        console.log(nombreReq);
        var id = $('#txt_id').val();


        
        if(nombreReq == ''){

            $('#divMensaje').removeClass('mensaje-success');
            $('#divMensaje').addClass('mensaje-error');
            $('#divMensaje').append('<label>No se han llenado los datos</label>');
            $('#txt_nombreReq').addClass('input-vacio');

        }else {
            
            if(id === undefined){
                crear(nombreReq);
                vaciarFormulario();
                $('#divMensaje').append('<label> Datos guardados correctamente</label>');
                $('#divMensaje').addClass('mensaje-success'); 
            }else {

                actualizar(id,nombreReq); 
                $('#divMensaje').append('<label> Datos actualizados correctamente</label>');
                $('#divMensaje').addClass('mensaje-update'); 
            }

                
                $('#divMensaje').removeClass('mensaje-error');                
                $('#txt_nombreReq').removeClass('input-vacio');
                
                

        
        }

               

        
    });

    $('#btn_cancelar').on('click',quitarClases);
    
    $(document).on('click','#btn_eliminar', function(){
        var id = { 'id' : $(this).parent().parent().attr("id")};
        if(confirm('¿Desea eliminarlo?')){
            eliminar(id);
        }
        
    });
    
    
    function crear(nombreReq){
        var datos = {
            'nombreReq': nombreReq
        };


        $.ajax({
            url: 'req/insertarReq.php',
            type: 'post',
            data: datos,
            success : function(respuesta){
                leer();
            
            }
            });

        
    }


    function actualizar(id,nombreReq){
        
        var datos = {
            'nombreReq': nombreReq,
            'id': id
        };

        $.ajax({
            url: 'req/actualizarReq.php',
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
        $('#tablaReq').empty();

        $.ajax({
            url: 'req/leerReq.php',
            dataType: 'JSON', 
            type:'GET', 
            success : function(respuesta){
                var fila = '';
                respuesta.forEach(function (element) {
                    console.log(element);
                    fila += "<tr id=\"" + element['id_req'] + "\">";
                    fila += "<td>" + element['nombre_req'] + "</td>";                    
                    fila += "<td><button type=\"button\" id = \"btn_editar\" class= \"btn btn-editar\">Editar</button>";
                    fila += "<td><button type=\"button\" id = \"btn_eliminar\" class= \"btn btn-eliminar\">Eliminar</button>";
                    fila += "</tr>";
                    
                    
                });

                $('#tablaReq').append(fila);

                
            }
    
        });
    }


    function quitarClases(){
        $('#divMensaje').empty();
        $('#divMensaje').removeClass('mensaje-error');
        $('#divMensaje').removeClass('mensaje-sucess');
        $('#divMensaje').removeClass('mensaje-update');
        $('#txt_nombreReq').removeClass('input-vacio');
        $('#txt_nombreReq').val('');
        $('#divInputId').empty();
        $('#divLabelId').empty();
        


    }

    function eliminar (id){
       
        
        $.ajax({
            url: 'req/eliminarReq.php',
            data: id,
            dataType: 'json',
            type:'post',
            success : function(respuesta){
                leer();
            }
        }); 
    }

    function vaciarFormulario(){
        $('#txt_nombreReq').val('');
        $('#txt_id').val('');
    }


});

