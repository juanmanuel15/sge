$(document).ready(function(){
    leer();
    confIniciales_reporteUsuario();


    $(document).on('click', '#btn_asistencia', function(){
        var id = { 'id' : $(this).attr("valor")};
        console.log(id);
        vista_modal_horarioCurso(id);
        $('#asistencia_usuario').modal('show');
        
    });
});


function leer(){
    $('#tablaReporteUsuario').empty();

    $.get('reporte-usuario/leer.php',function(respuesta) {
            //console.log(respuesta);
            var usuario = JSON.parse(respuesta);
            //console.log(usuario[0].numeroCuenta);
            var fila = '';

            for(var i =0; i<usuario.length; i++){

                fila += "<tr id=\"" + usuario[i].numeroCuenta + "\">";
                fila += "<td>" + usuario[i].numeroCuenta + "</td>";   
                fila += "<td>" + usuario[i].nombreCompleto+ "</td>";
                fila += "<td>" +usuario[i].titulo + "</td>";
                fila += `<td><span class = "i_asistencia"><i class="fas fa-book-open" valor = "${usuario[i]['usuario']}&${usuario[i]['curso']}" id = "btn_asistencia"></i></span></td>`;           
                fila += `<td><span class = "i_mostrar"><a href = "reporte-usuario/constancia.php?curso='${usuario[i]['curso']}'&usuario='${usuario[i]['usuario']}'"><i class="fas fa-share"></a></i></span></td>`;
                fila += "</tr>";
            }
            
            
            

		$('#tablaReporteUsuario').append(fila);
	


	});
}


function confIniciales_reporteUsuario(){
    $('#msg_asistencia').empty();
}



