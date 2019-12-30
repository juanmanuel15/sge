$(document).ready(function(){
	vista_mostrarConstancias();

	var id;
	$(document).on('click','#btn_editar', function(){
		quitarClases();
		id = $(this).attr('valor');
		var dato =  {'id': id};
		$('#editarContancias').modal('show');
		$.post('editar.php', dato, function(respuesta){
			respuesta = JSON.parse(respuesta);
			if(!respuesta.serv){
				if(!respuesta.conn){
					if(respuesta.success != false){
						$('#edit_nombreAsistente').val(respuesta.success.nombre);
						$('#edit_apellidoPAsistente').val(respuesta.success.apellidoP);
						$('#edit_apellidoMAsistente').val(respuesta.success.apellidoM);

						error('', '');
					}
				}else{
					error('e', "No se pude conectar, intente más tarde");
				}
			}else{
				error('e', "No se pude establecer conexión, intente más tarde");
			}
		});

		
	});

	$(document).on('click','#btn_eliminar', function(){
		$('#dialogoEliminar').modal('show');
		$('#div-dialogoSuccess').hide();
		id = {'id' : $(this).parent().parent().attr('valor')};

	});

	$('#btn_aceptarEliminar').click(function(){

		//console.log(id);
		$.post('eliminar.php', id, function(respuesta){
			respuesta = JSON.parse(respuesta);
			console.log(respuesta);
			if(respuesta['serv'] == false){
				if(respuesta['conn'] == false){
					if(respuesta['success']){
						vista_mostrarConstancias();
						$('#div-dialogoEliminar').hide();
						$('#div-dialogoSuccess').show();

					}
				}
			}
		});
	});

	$('#btn_aceptarSuccess').click(function(){
		$('#dialogoEliminar').modal('hide');
	});

	$('#btn_cancelarEliminar').click(function(){
		$('#dialogoEliminar').modal('hide');
	});


	/*$('#form_buscarConstancia').submit(function(e){
		e.preventDefault();
		console.log('Hola');
	});*/

	$('#form_editarConstancia').submit(function(e){
		e.preventDefault();

		vacio(nombre = $('#edit_nombreAsistente'));
		vacio(apellidoP = $('#edit_apellidoPAsistente'));
		apellidoM = $('#edit_apellidoMAsistente');

		if(vacio(nombre) || vacio(apellidoP)){
			error('e', "Campo(s) vacío(s)");
		}else{
			var datos = {
				'id': id,
				'nombre': nombre.val(),
				'apellidoP': apellidoP.val(),
				'apellidoM': apellidoM.val()
			};

			$.post('actualizar.php', datos, function(respuesta){
				var respuesta = JSON.parse(respuesta);
				console.log(respuesta);

				if(!respuesta.serv){
					if(!respuesta.conn){
						if(respuesta.success){
							error('c', 'Datos modificados correctamente');
							vista_mostrarConstancias();
							vaciar(nombre);
							vaciar(apellidoP);
							vaciar(apellidoM);
						}
					}
				}
			});

			//error('c', '');
		}

	});

	$('#edit_btnCancelar').click(function(){
		$('#editarContancias').modal('hide');
	});

	$(document).on('submit', '#form_buscarConstancia', function(e){
        e.preventDefault();

        var buscar_constancia = $('#buscar_constancia').val();
        buscar_constancia = {'dato' : buscar_constancia}; 

        if(buscar_constancia === ''){
            vista_mostrarConstancias();
        } else {
            $.post('buscar.php', buscar_constancia, function(respuesta){
                respuesta = JSON.parse(respuesta);
                console.log(respuesta);
                
    
                    if(respuesta['serv']){
                        console.log("Error al procesar información");
                        vista_mostrarConstancias();
                    }else if(respuesta['conn']){
                        vista_mostrarConstancias();
                    }else if(respuesta['res'] != false){
                        vista_mostrarConstancias();           
                    }else if(respuesta['success'] != false){
                         buscarConstancia(respuesta['success']);
                    }else{
                    	$('#tablaEditarConstancia').empty();
                    }
                    
                });
        }
    });


});