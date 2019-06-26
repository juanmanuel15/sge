function vista_body_usuariosInscritos(usuarios){
    //console.log(usuarios);
    
    $('#modalBody_usuariosInscritos').empty();


    var body ="";
    for(var i = 0 ; i< usuarios.length; i++){
        body += `
            <tr>
                <td>${usuarios[i]['nombre']}</td>
                <td><span class = "i_eliminar" id = "btn_eliminarUsuarioCurso" valor = "${usuarios[i]['usuario']}"><i class="fas fa-trash"></i></span></td>
            </tr>
        `;
    }

    $('#modalBody_usuariosInscritos').append(body);


}


function vista_msg_eliminarUsuario(){
	//$('#contenedorUsuarioInscrito').empty();
	$('#contenedorUsuarioInscrito').empty();


	texto = `
		
		<div class="row">
            <div class="col-12 d-flex justify-content-center">
                <label for="">¿Está seguro que desea eliminar al usuario?</label>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12 d-flex justify-content-center">
                <button class="btn btn-danger mx-2 col-lg-4 col-6" id = "btn_aceptarEliminar">Aceptar</button>
                <button class="btn btn-secondary mx-2 col-lg-4 col-6" id = "btn_cancelarEliminar">Cancelar</button>
            </div>
        </div>

	`;


	$('#contenedorUsuarioInscrito').append(texto);


}

function vista_contenedor_agregarUsuarioCurso(usuario){
    //console.log(respuesta);
    $('#tablaBuscarUsuario').empty();

    var tabla = `
        <table class="table">
            <thead class="text-center">
                <th>N° Cuenta</th>
                <th>Nombre</th>
                <th>Inscribir</th>
            </thead>
            <tbody class="text-center">`;
                

        for(var i = 0; i< usuario.length; i++){
            tabla += `<tr>
                        <td>${usuario[i]['nCuenta']}</td>
                        <td>${usuario[i]['nombre']}</td>
                        <td><span valor = "${usuario[i]['usuario']}" id = 'btn_inscribirUsuarioCurso'><i class="fas fa-pen"></i></span></td></tr>`
        }


        tabla +=
                 `</tbody>
            </table>`;

    $('#tablaBuscarUsuario').append(tabla);

}


function vista_msg_CursoUsuario(respuesta){
    msg = '';
    if(!respuesta['servidor']){
                if(!respuesta['conn']){
                    if(!respuesta['vacio']){
                        if(!respuesta['inscrito']){
                            if(!respuesta['traslape']){
                                if(!respuesta['lugar']){
                                    if(respuesta['success']){
                                        msg = "Insertado correctamente";
                                        error = 1;
                                    }else{
                                        msg = "No se ha podido insertar, intente más tarde";
                                        error = 0;
                                    }                                    
                                }else{
                                    msg = "No hay lugares disponibles";
                                    error = 0;
                                }
                            }else{
                                msg = "Tienes otro curso inscrito";
                                error = 0;
                            }
                        }else{
                            msg = "Ya tienes inscrito este curso";
                            error = 0;
                        }
                    }else {
                        msg = "No se inserto valor en el buscador";
                        error = 0;
                    }
                }else {
                    msg = "No se pudo insertar la información";
                    error = 0;
                }
            }else {
                msg = "No se pudo procesar la información";
                error = 0;
            }

    $('#msg_UsuarioInsertado').empty();

    //console.log(msg);

    if(error == 1){
        $('#msg_UsuarioInsertado').removeClass('mensaje-error');
        $('#msg_UsuarioInsertado').addClass('mensaje-success');
    }else if(error == 0){
        $('#msg_UsuarioInsertado').addClass('mensaje-error');
        $('#msg_UsuarioInsertado').removeClass('mensaje-success');
    }


    $('#msg_UsuarioInsertado').append(msg);



}


function vista_leerCursos(respuesta){
    
    $('#tablaReporteCurso').empty();
            
            
            var fila = '';

            for(var i =0; i<respuesta.length; i++){

                var id =respuesta[i]['id'];
                var titulo = respuesta[i]['titulo'];
                var inscritos = respuesta[i]['inscritos'];
                var lugares = respuesta[i]['lugares'];

               
               fila += `
                    <tr id = ${id}>
                        <td>${id}</td>
                        <td>${titulo}</td>
                        <td>${inscritos}/${lugares}</td>
                        <td><span id = "btn_ver" class = "i_ver"><i class="fas fa-eye"></i></td>                
                        <td><span id = "btn_generar" class = "i_mostrar"><a href = "reporte-curso/reporte.php?id=${id}"><i class="fas fa-share"></i></i></a></i></span></td>
                    </tr>
               `;
            }
            
            

        $('#tablaReporteCurso').append(fila);

}

