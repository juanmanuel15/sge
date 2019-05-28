$(document).ready(function (){

    leer();

    $('#btn_agregar').on('click', function(){
        quitarClases(); 
        $('#exampleModalLabel').text('Agregar Tipo de Actividad');
        $('#btn_aceptar').val('Agregar');
    });

    $(document).on('click', '#btn_editar', function(){
         
        quitarClases();
        $('#exampleModalLabel').text('Actualizar Tipo de Actividad');
        $('#btn_aceptar').val('Actualizar');

        var id = { 'id' : $(this).parent().parent().attr("id")};

         $.ajax({
                
            url:'tActividad/editartActividad.php',
            data: id,
            dataType: 'json',
            type: 'post',
            success: function(respuesta){
                
                $('#txt_tActividad').val(respuesta[0].nombre);
                
               var campoID = "<label  hidden for = \" txt_id\"  class=\"col-form-label\">id: </label>" ;
               var campoInput = "<input  hidden id =\"txt_id\" value = \""+ respuesta[0].id + "\"  class=\"form-control\"></input>";
               $('#divInputId').append(campoInput);
               $('#divLabelId').append(campoID);                
               $('#modal_agregar').modal('show');
            }


        });

        });

    
    $('#formtActividad').submit(function(e){

        e.preventDefault();

        $('#divMensaje').empty();
       

        var nombreActividad = $('#txt_tActividad').val();
        var id = $('#txt_id').val();


        
        if(nombreActividad == ''){

            $('#divMensaje').removeClass('mensaje-success');
            $('#divMensaje').addClass('mensaje-error');
            $('#divMensaje').append('<label>No se han llenado los datos</label>');
            $('#txt_tActividad').addClass('input-vacio');

        }else {
            
            if(id === undefined){
                crear(nombreActividad);
                vaciarFormulario();
                $('#divMensaje').append('<label> Datos guardados correctamente</label>');
                $('#divMensaje').addClass('mensaje-success'); 
            }else {

                actualizar(id,nombreActividad); 
                $('#divMensaje').append('<label> Datos actualizados correctamente</label>');
                $('#divMensaje').addClass('mensaje-update'); 
            }

                
                $('#divMensaje').removeClass('mensaje-error');                
                $('#txt_tActividad').removeClass('input-vacio'); 
        }

               

        
    });

    $('#btn_cancelar').on('click',quitarClases);
    
    $(document).on('click','#btn_eliminar', function(){
        var id = { 'id' : $(this).parent().parent().attr("id")};
        if(confirm('¿Desea eliminarlo?')){
            eliminar(id);
        }
        
    });
    
    
    function crear(nombreActividad){
        var datos = {
            'nombre': nombreActividad
        };


        $.ajax({
            url: 'tActividad/insertartActividad.php',
            type: 'post',
            data: datos,
            success : function(respuesta){
                leer();
            
            }
            });

        
    }


    function actualizar(id,nombreActividad){
        
        var datos = {
            'nombre': nombreActividad,
            'id': id
        };

        $.ajax({
            url: 'tActividad/actualizartActividad.php',
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
        $('#tablaTActividad').empty();

        $.ajax({
            url: 'tActividad/leertActividad.php',
            dataType: 'JSON', 
            type:'GET', 
            success : function(respuesta){
                var fila = '';
                respuesta.forEach(function (element) {
                    fila += "<tr id=\"" + element['id'] + "\">";
                    //fila += "<td >" + element['id'] + "</td>";
                    fila += `<td class = "text-center">${element['nombre_act']}</td>`;                    
                    fila += `<td ><span id = btn_editar ><i class="fas fa-edit i_editar"></i></span>`;
                    fila += `<td><span id = btn_eliminar><i class="fas fa-trash i_eliminar"></i></span>`;
                    fila += "</tr>";
                    
                    
                });

                $('#tablaTActividad').append(fila);

                
            }
    
        });
    }


    function quitarClases(){
        $('#divMensaje').empty();
        $('#divMensaje').removeClass('mensaje-error');
        $('#divMensaje').removeClass('mensaje-sucess');
        $('#divMensaje').removeClass('mensaje-update');
        $('#txt_tActividad').removeClass('input-vacio');
        $('#txt_tActividad').val('');
        $('#divInputId').empty();
        $('#divLabelId').empty();
        


    }

    function eliminar (id){
       
        
        $.ajax({
            url: 'tActividad/eliminartActividad.php',
            data: id,
            dataType: 'json',
            type:'post',
            success : function(respuesta){
                leer();
            }
        }); 
    }

    function vaciarFormulario(){
        $('#txt_tActividad').val('');
        $('#txt_id').val('');
    }


});

