$(document).ready(function(){
    leer();


    $(document).on('click', '#btn_generar', function(){
        var id = { 'id' : $(this).parent().parent().attr("id")};
    });

    $(document).on('click', '#btn_ver', function(){
        var id = { 'id' : $(this).parent().parent().attr("id")};

        $.post('cursos/reporte-curso/')
        
    });
});


function leer(){
    $('#tablaReporteCurso').empty();

    $.post('cursos/reporte-curso/mostrar.php',function(respuesta) {            
            var respuesta = JSON.parse(respuesta);
            //console.log(respuesta[0]);            
            //console.log(respuesta[0].lugar['lugares']);
            $('#tablaReporteCurso').empty();
            
            var fila = '';

            for(var i =0; i<respuesta.length; i++){

                var id =respuesta[i].curso['id'];
                var titulo = respuesta[i].curso['titulo'];
                var inscritos = respuesta[i].lugar[0]['inscritos'];
                var lugares = respuesta[i].lugar[0]['lugares'];

               
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
	


	});
}

