function botonInscribir(datos, curso1, usuario){

            var id_curso = curso1.replace(" ","");            

            $.post('php/usuario/curso/verificar.php', datos, function(respuesta){
                respuesta = JSON.parse(respuesta);


                if(!respuesta.inscrito){
                   $('#btn_inscribir_CS').text("Inscribir");


                }else {

                    var cadena = `ticket.php?curso=${id_curso}&usuario=${usuario}`; 
                    $('#btn_inscribir_CS').text('Ticket');
                    $("a[id = btn_inscribir_CS]").attr('href', cadena);
                    
                }
                

            });

                
}