$(document).ready(function() {

	leer();


	function leer(){
		$.post('php/curso/leerCursos.php', function(respuesta){
			respuesta = JSON.parse(respuesta);
			Math.trunc(respuesta.length/3);
			
				

					$('#contenedor').append(curso);

					
					console.log(largo);
					largo = respuesta.length-largo;
					console.log(largo);

					var curso = `<div class="row d-flex justify-content-center mt-4">`;

					for (var i = ; i < largo; i++) {

						if(i)
						  curso += `							
								<div class="col-3 col-sm-3 col-md-3 col-lg-3 mt-4 mx-1">
									<div class="row">
										<div class="col-12  a">
										</div>
									</div>

									 <div class="row">
									 	<div class="col-12 b d-flex justify-content-center">
									 		<label>${respuesta[i].titulo}</label>
									 	</div>
									 </div>

									<div class="row">
										<div class="col-12 c d-flex justify-content-end p-1">
											<a href="curso.php?curso=${respuesta[i].id}" class="btn btn-outline-primary btn-sm btn-detalles p-1">Detalles</a>
										</div>
									</div> 
							
	
								`;


						

					}

					curso = `</div>`;
					$('#contenedor').append(curso);


				

			

		});
	}
});