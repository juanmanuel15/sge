$(document).ready(function(){
	$('#formBuscar').submit(function(e){
		e.preventDefault();
		console.log("Hola Mundo");
		var buscar = $('#txt_buscar').val();
		if(buscar == ''){
			mostrar();
		}
		else {
			var dato = {'buscar': buscar};
			buscarCurso(dato);
		}
	});
});


function buscarCurso(dato){
	$.post('admin/cursos/buscar/main.php', dato, function(respuesta){
		console.log(respuesta);
	});

}
