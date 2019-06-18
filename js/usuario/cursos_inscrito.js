function vista_cursoInscrito(respuesta){
	//console.log(respuesta);
	$('#cursoInscrito').empty();
	

	for(var i = 0; i<respuesta.length; i++){
		var rowInicio = `<div class = "row d-flex justify-content-center mt-4">`;
		var imagen = `  <div class="col-1 col-lg-1 usuario-curso-imagen curso-inscrito">                
        				</div>`;
        var datos = `
		<div class="col-7 col-lg-3  usuario-curso-description curso-inscrito">
	        <div class="row">
	                <div class="col-12 text-center texto-entradas">
	                	${respuesta[i].curso['titulo']}	                    
	                </div>
	        </div>
	        <div class="row">
	        		<div class="col-12 text-center texto-entradas ">
	                       ${respuesta[i].profesor[0]['nombre']}
	                </div>
	        </div>
	        <div class="row">
	            <div class="col-12 text-center texto-entradas">
	            		${respuesta[i].horario[0]['fecha']}
	        	</div>
	        </div>
	    </div>
	`; 


	var botones = `
		<div class="col-3 col-lg-1 align-self-center p-1 curso-inscrito">
                <div class="row mb-2">
                    <div class="col-12">
                        <a href="/sge/curso.php?curso=${respuesta[i].curso['id']}" class = "btn btn-primary btn-verCurso col-12">Ver</a>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12" id = "${respuesta[i].curso['id']}">
                        <button class="btn-cancelarCurso btn btn-danger col-12" id = "btn_eliminarCurso" valor = "${respuesta[i].curso['id']}">Eliminar</button>
                    </div>  
                </div>
         </div>
	`;

	var rowFinal = `</div>`;



	var texto = rowInicio + imagen + datos + botones;
	$('#cursoInscrito').append(texto);
}


	

}


function vista_constancias(datos){

}	