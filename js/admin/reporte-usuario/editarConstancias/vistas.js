function vista_mostrarConstancias(){
	$('#tablaEditarConstancia').empty();
	$.post('leer.php', function(respuesta){
		var respuesta = JSON.parse(respuesta);
		//console.log(respuesta);

		if(!respuesta.conn){
			if (!respuesta.res) {
				if (!respuesta.tamano) {					
						var success = respuesta.success;
						var texto;
						for(var i= 0; i<success.length; i++){
							texto += `
								<tr valor = ${success[i].id}>
									<td>${success[i].id}</td>
									<td>${success[i].nombreCompleto}</td>
									<td>${success[i].titulo}</td>
									<td>
										<span id="btn_editar" class="i_ver" valor = ${success[i].id}>
											<i class="fas fa-edit i_editar"></i>
										</span>	
									</td>
									<td>
										<span class="i_mostrar">
											<a href = 'constancia.php?id=${success[i].id}'>
												<i class="fas fa-share"> 
												</i>
											</a>
										</span>
									</td>
									<td>
										<span id="btn_eliminar"><i class="fas fa-trash i_eliminar"></i></span>
									</td>		
								</tr>
							`;
						}

						$('#tablaEditarConstancia').append(texto);
				}
			}
		}
	});
}


function buscarConstancia(success){
	console.log(success);	
	var texto = '';
	$('#tablaEditarConstancia').empty();

	for (var i = 0;  i<success.length; i++) {
		texto += `
		<tr valor = ${success[i].id}>
			<td>${success[i].id}</td>
			<td>${success[i].nombreCompleto}</td>
			<td>${success[i].titulo}</td>
			<td>
				<span id="btn_editar" class="i_ver" valor = ${success[i].id}>
					<i class="fas fa-edit i_editar"></i>
				</span>	
			</td>
			<td>
				<span class="i_mostrar">
					<a>
						<i class="fas fa-share"> 
						</i>
					</a>
				</span>
			</td>
			<td>
				<span id="btn_eliminar"><i class="fas fa-trash i_eliminar"></i></span>
			</td>		
		</tr>
	`;
		
	}
			
	
	$('#tablaEditarConstancia').append(texto);						
}

						
				
			
	
	



function error(t, msg){
	$('#div_msg_config').empty();
	$('#div_msg_config').removeClass('alert-danger');
	$('#div_msg_config').removeClass('alert-success');
	var texto = "<label>" + msg + "<label>";
	if(t == 'e'){
		$('#div_msg_config').addClass('alert-danger');
		$('#div_msg_config').append(texto);
	}
	else if(t == '') {		
	}else if(t == 'c'){
		$('#div_msg_config').append(texto);
		$('#div_msg_config').addClass('alert-success');		
	}

}