$(document).ready(function(){
	var curso = {
                'curso' : "<?php echo $curso;?> "
            };

            console.log(curso);

            var curso1 = "<?php echo $curso; ?> ";

            var usuario = "<?php echo $usuario?>";

            var datos = {
                    'curso' : curso1, 
                    'usuario' : usuario
                };


             botonInscribir(datos, curso, usuario);

           


            


            $('#btn_inscribir_CS').on('click', function(){

                $.post('php/usuario/curso/inscribir.php', datos, function(respuesta){
                    respuesta = JSON.parse(respuesta);
                    if(respuesta){
                       alert("Ya tienes un curso inscrito en el mismo horario");

                    }else {
                        alert("Curso inscrito correctamente");
                        $('#btn_inscribir_CS').text("Ticket");
                        var cadena = 'ticket.php?curso=' + curso1 + '&usuario=' + usuario; 
                        $("a[id = btn_inscribir_CS]").attr('href', cadena);


                    }
                });
            });

             vista_datosCurso(curso1);

});