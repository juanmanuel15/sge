$(document).ready(function() {

	leer();


	function leer(){
		$.post('php/curso/leerCursos.php', function(respuesta){
			respuesta = JSON.parse(respuesta);
			console.log(respuesta);

			var curso = `<div class="row d-flex justify-content-center mt-2">`;
			var relacion = 2;

			for (var i = 0; i < respuesta.length; i++) {



				if((i)%4 == 0 ){
					curso += `</div>`;
					curso += `<div class="row d-flex justify-content-center mt-4">`;
				}


				  curso += `							
						<div class="col-${relacion} col-sm-${relacion} col-md-${relacion} col-lg-${relacion} mt-4 mx-1">
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
						</div>
					

						`;


				

			}

					curso += `</div>`;
					$('#contenedor').append(curso);
			

				

			

		});
	}
});