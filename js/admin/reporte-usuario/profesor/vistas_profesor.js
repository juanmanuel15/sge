
function vista_principalBuscarCurso(usuario){
   
    $('#tablaReporteUsuario').empty();
    var fila ='';

    for(var i =0; i<usuario.length; i++){

        fila += "<tr id=\"" + usuario[i].numeroCuenta + "\">";
        fila += "<td>" + usuario[i].numeroCuenta + "</td>";   
        fila += "<td>" + usuario[i].nombreCompleto+ "</td>";
        fila += "<td>" +usuario[i].titulo + "</td>";          
        fila += `<td><span class = "i_mostrar"><a href = "constancia.php?curso=${usuario[i]['curso']}&usuario=${usuario[i]['usuario']}"><i class="fas fa-share"></a></i></span></td>`;
        fila += "</tr>";
    }


    $('#tablaReporteUsuario').append(fila);
}