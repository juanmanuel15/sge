$(document).ready(function(){
	mostrar();
});



function mostrar(){
	$.get('cursos/display/mostrar.php', function(respuesta){
		console.log(respuesta);
	});
}