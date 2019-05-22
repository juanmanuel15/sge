$(document).ready(function(){
    leer();


    $(document).on('click', '#btn_generar', function(){
        var id = { 'id' : $(this).parent().parent().attr("id")};
    });
});


function leer(){
    $('#tablaReporteCurso').empty();

    $.post('cursos/display/mostrar.php',function(respuesta) {            
            var respuesta = JSON.parse(respuesta);            
            console.log(respuesta);
            $('#tablaReporteCurso').empty();
            
            var fila = '';

            for(var i =0; i<respuesta.length; i++){

                id =respuesta[i].curso['id'];
                titulo = respuesta[i].curso['titulo'];
               
               fila += `
                    <tr id = ${id}>
                        <td>${i+1}</td>
                        <td>${titulo}</td>                
                        <td><span id = "btn_generar"><a href = "reporte-curso/reporte.php?id=${id}"><i class="fas fa-edit"></a></i></span></td>
                    </tr>
               `;
            }
            
            

		$('#tablaReporteCurso').append(fila);
	


	});
}

