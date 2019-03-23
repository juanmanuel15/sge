$(document).ready(function(){

	leerUsuario();


	$('#btn_agregar').on('click', function(){
		
		vaciarFormulario();
		vaciarMensaje();
		$('#select_tipo').empty();
		$('#exampleModalLabel').text('Agregar usuario');
		$('#btn_aceptar').val('Aceptar');

		selector();
		removerAttr();

		$('#formUsuario').attr("accion", "agregar");
	});


	$('#btn_cancelar').on('click', function(){
		vaciarFormulario();
		vaciarMensaje();
		$('#divMensaje').empty();
	})




	$('#formBuscar').submit(function(e){
		e.preventDefault();
		var buscar = $('#txt_buscar').val();
		if(buscar == ''){
			leerUsuario();
		}
		else {
			var dato = {'buscar': buscar};
			buscarUsuario(dato);
		}
	});

	
	$('#formUsuario').submit(function(e){
		
		e.preventDefault();
		vaciarMensaje();

		var accion = $(this).attr("accion"); //realizamos la accion a realizar
		var nCuenta_actual = $(this).attr("nCuenta_actual");
		var correo_actual = $(this).attr("correo_actual");
		var usuario_actual = $(this).attr("usuario_actual");

		var nCuenta = $('#txt_ncuenta').val();
		var nombre = $('#txt_nombre').val();
		var apellidoP = $('#txt_apellidoP').val();
		var apellidoM = $('#txt_apellidoM').val();
		var correo = $('#txt_correo').val();
		var usuario = $('#txt_usuario').val();
		var pass = $('#txt_pass').val();
		var pass2 = $('#txt_pass2').val();
		var telefono = $('#txt_telefono').val();
		var tipoUser= $('#select_tipo').val();


		var datosConsultar = {
			'cuenta': nCuenta,
			'correo' : correo,
			'usuario': usuario
		};


		//Verificamos que los campos se encuentren llenos
		if(nombre ==  '' || apellidoP == '' || apellidoM == '' || correo == '' || usuario ==  ''  || pass == '' ||  pass2 == '' || telefono == '' || tipoUser == '' || nCuenta == ''){
			$('#divMensaje').addClass('mensaje-error');			
            $('#divMensaje').append('<label>No se han llenado los datos</label>');

         //Se verifica que las contraseñas correspondan

		} else  if(pass != pass2){
				$('#divMensaje').addClass('mensaje-pswd');
				$('#divMensaje').append('<label>La contraseña no es la misma</label>')
		}

		else {

				
				var datosUsuario = {
						'nCuenta_actual': nCuenta_actual,
						'nCuenta' : nCuenta,
						'nombre': nombre,
						'apellidoP': apellidoP,
						'apellidoM': apellidoM,
						'correo': correo,
						'usuario': usuario,
						'pass': pass,
						'telefono': telefono,
						'tipoUser': tipoUser
				};



				if (accion == 'agregar'){

					

					var datosComprobar = {
						'cuenta': nCuenta,
						'correo': correo,
						'usuario': usuario
					};

					$.post('usuario/consultar.php', datosComprobar, function(respuesta){						
						respuesta = JSON.parse(respuesta);
						console.log(respuesta);

						if (verificarFormulario(respuesta.Verificar_correo, respuesta.Verificar_cuenta, respuesta.Verificar_usuario)){
							$('#divMensaje').addClass('mensaje-success');
							$('#divMensaje').append('<label>Datos llenados correctamente</label>');
							crearUsuario(datosUsuario);
							leerUsuario();
							vaciarFormulario();
						}
						
									
					});

			
				}else if(accion == 'editar'){



					var nCuenta_nuevo = '';
					var usuario_nuevo = '';
					var correo_nuevo= '';

					if(nCuenta != nCuenta_actual){
						nCuenta_nuevo = nCuenta;
						
						
					}

					if(correo != correo_actual){
						correo_nuevo = correo;
					}

					if(usuario != usuario_actual){
						usuario_nuevo = usuario;
						
					}



					var datosComprobarNuevo = {
						'cuenta': nCuenta_nuevo,
						'correo': correo_nuevo,
						'usuario': usuario_nuevo
					};

					console.log(datosComprobarNuevo);


					$.post('usuario/consultar.php', datosComprobarNuevo, function(respuesta){
						respuesta = JSON.parse(respuesta);
						if (verificarFormulario(respuesta.Verificar_correo, respuesta.Verificar_cuenta, respuesta.Verificar_usuario)){
							actualizar(datosUsuario);
							leerUsuario();
							vaciarFormulario();
						}


					});

					
				
				}

				

				

			
			
			//$('#divMensaje').addClass('mensaje-success');
			//$('#divMensaje').append('<label>Datos llenados correctamente</label>');
			
		}
	});

	$(document).on('click', '#btn_editar', function(){

		vaciarFormulario();
		vaciarMensaje();
		cargarEditar();
		$('#select_tipo').empty();
		

		var id = { 'id' : $(this).parent().parent().attr("id")};
		
		
		$.post('usuario/editar.php', id, function(respuesta){			

			$('#modal_AgregarUsuario').modal('show');
			respuesta = JSON.parse(respuesta);

			var nCuenta_actual = respuesta[0].nCuenta;
			var usuario_actual = respuesta[0].usuario;
			var correo_actual = respuesta[0].correo;

			$('#txt_ncuenta').val(respuesta[0].nCuenta);
			$('#txt_nombre').val(respuesta[0].nombre);
			$('#txt_apellidoP').val(respuesta[0].apellidoP);
			$('#txt_apellidoM').val(respuesta[0].apellidoM);
			$('#txt_correo').val(respuesta[0].correo);
			$('#txt_usuario').val(respuesta[0].usuario);
			$('#txt_telefono').val(respuesta[0].telefono);
			$('#txt_pass').val(respuesta[0].pass);
			$('#txt_pass2').val(respuesta[0].pass);
			selector();

			removerAttr();
			$('#formUsuario').attr("accion", "editar");
			$('#formUsuario').attr('nCuenta_actual', nCuenta_actual);
			$('#formUsuario').attr('usuario_actual', usuario_actual);
			$('#formUsuario').attr('correo_actual', correo_actual);			

		});
	});

	$(document).on('click', '#btn_eliminar', function(){

		var id = { 'id' : $(this).parent().parent().attr("id")};

		if(confirm('¿Desea eliminarlo?')){
            eliminar(id);
            leerUsuario();
        }
	});
	
});

function buscarUsuario(dato){

	$.ajax({

				url: 'usuario/buscar.php',
				method: 'post',
				data : dato,
				dataType: 'json',
				success: function(respuesta){
					$('#tablaUsuario').empty();	
					var fila = '';
	            	respuesta.forEach(function (element) {
	                fila += "<tr id=\"" + element['numeroCuenta'] + "\">";
	                fila += "<td >" + element['numeroCuenta'] + "</td>";   
	                fila += "<td >" + element['nombreCompleto'] + "</td>";
	                fila += "<td >" + element['usuario'] + "</td>";
	                fila += "<td><button type=\"button\" id = \"btn_editar\" class= \"btn btn-editar\" >Editar</button>";
                	fila += "<td><button type=\"button\" id = \"btn_eliminar\" class= \"btn btn-eliminar\" >Eliminar</button>";
	                fila += "</tr>";
			
			});


			$('#tablaUsuario').append(fila);
				}

			});
}

function leerUsuario(){
	$('#tablaUsuario').empty();


	$.ajax({

		url: 'usuario/leerUsuario.php',
		method :'GET',
		dataType: 'json',

		success: function(respuesta){
			var fila = '';
            respuesta.forEach(function (element) {
                fila += "<tr id=\"" + element['numeroCuenta'] + "\">";
                fila += "<td >" + element['numeroCuenta'] + "</td>";   
                fila += "<td >" + element['nombreCompleto'] + "</td>";
				fila += "<td >" + element['usuario'] + "</td>";           
				fila += "<td >" + element['tipo_usuario'] + "</td>";           
                fila += "<td><button type=\"button\" id = \"btn_editar\" class= \"btn btn-editar\" >Editar</button>";
                fila += "<td><button type=\"button\" id = \"btn_eliminar\" class= \"btn btn-eliminar\" >Eliminar</button>";
                fila += "</tr>";
		
		});


		$('#tablaUsuario').append(fila);
	}


	});
}

function crearUsuario(datosUsuario){

	$.post('usuario/crear.php', datosUsuario);
}

function eliminar (id){
	$.post('usuario/eliminar.php', id, function(respuesta){
		console.log(respuesta);
	});
}


function mostrarUsuario(id){
	$.post('usuario/mostrar.php', id, function(respuesta){
		console.log(respuesta);
	}

	);
}


function vaciarFormulario(){
	$('#txt_nombre').val('');
	$('#txt_apellidoP').val('');
	$('#txt_apellidoM').val('');
	$('#txt_correo').val('');
	$('#txt_usuario').val('');
	$('#txt_pass').val('');
	$('#txt_pass2').val('');
	$('#txt_telefono').val('');
	$('#select_tipo').val('');
	$('#txt_ncuenta').val('');
}

function vaciarMensaje(){
	$('#divMensaje').removeClass('mensaje-error');
	$('#divMensaje').removeClass('mensaje-success');
	$('#divMensaje').removeClass('mensaje-pswd');
	$('#divMensaje').removeClass('mensaje-update');
	$('#divMensaje').empty();

}

function selector(){
	$.ajax({
			url: 'usuario/selector.php',
			method:'get',
			success: function(respuesta){
				var fila ='';
				var array_respuesta = JSON.parse(respuesta);

				for (var i = 0; i < array_respuesta.length; i++) {
					fila += "<option value = \"" + array_respuesta[i].id+ " \">" + array_respuesta[i].tipoUsuario+ "</option>";
				}

				$('#select_tipo').append(fila);
				
			}
		
		});
}

function cargarEditar(){
	$('#exampleModalLabel').text('Modificar Usuario');
	$('#btn_aceptar').val('Actualizar');
}

function removerAttr(){
	$('#formUsuario').removeAttr('accion');
	$('#formUsuario').removeAttr('nCuenta_actual');
	$('#formUsuario').removeAttr('usuario_actual');
	$('#formUsuario').removeAttr('correo_actual');	
}


function verificarFormulario(correo, cuenta, usuario){

	if(!usuario && !correo && !cuenta){
		
		

		return true;
	}

	else {


		var msg = "<p>Los siguientes valores ya existen: </p>";
			msg += "<ul>";
		if(usuario){
			msg += "<li>Usuario</li>";
		}
		if(cuenta){
			msg += " <li>N° Cuenta </li>";
		}
		if(correo){
			msg += " <li>Correo </li>";
		}

		msg += "</ul>"
			

		$('#divMensaje').append(msg);
		$('#divMensaje').addClass('mensaje-pswd');

		return false;
	}
}

function actualizar(datosUsuario){

	$.post('usuario/actualizar.php', datosUsuario, function(respuesta){
		//$('#formUsuario').removerAttr('nCuenta_actual');
		$('#formUsuario').attr('nCuenta_actual', datosUsuario.nCuenta_actual);
		$('#divMensaje').append('<label>Datos actualizados correctamente</label>');
		$('#divMensaje').addClass('mensaje-update');
		leerUsuario();
		//vaciarFormulario();
	});
}










