$(document).ready(function(){
    leer();


    $(document).on('click', '#btn_generar', function(){
        var id = { 'id' : $(this).parent().parent().attr("id")};
        console.log(id);
    });
});


function leer(){
    $('#tablaReporteCurso').empty();

    $.get('reporte-curso/leer.php',function(respuesta) {            
            var usuario = JSON.parse(respuesta);            
            console.log(usuario);
            
            /*var fila = '';

            for(var i =0; i<usuario.length; i++){
                fila += "<tr id=\"" + usuario[i].numeroCuenta + "\">";
                fila += "<td >" + usuario[i].numeroCuenta + "</td>";   
                fila += "<td >" + usuario[i].nombreCompleto+ "</td>";
                fila += "<td >" +usuario[i].titulo + "</td>";           
                fila += "<td><button type=\"button\" id = \"btn_generar\" class= \"btn btn-generar\" >Generar</button>";
                fila += "</tr>";
            }
            
            

		$('#tablaReporteCurso').append(fila);*/
	


	});
}

