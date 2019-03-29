<?php

    session_start();

    if(isset($_SESSION['usuario'])){
        $usuario = $_SESSION['usuario'];
    }else {
        $usuario = '';
    }

    $curso = $_GET['curso'];
    

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title id = "titulo"></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Exo+2" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Titillium+Web|ZCOOL+XiaoWei" rel="stylesheet">
  <link rel="stylesheet" href="css/main.css"> 
  <link rel="stylesheet" href="css/usuario.css">
       
</head>
<body>

    <nav class="navbar d-flex justify-content-between p-2">
            <div class="col-3 col-sm-4 col-md-3 col-lg-3 d-flex justify-content-center">
                <a class="" href="index.php">SGE</a>
            </div>
            <div class="col-3 col-sm-4 col-md-3 col-lg-3 d-flex justify-content-center">
                <a href="#" class="">Cursos</a>
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-lg-3 d-flex justify-content-center">

                <?php if(isset($_SESSION['usuario'])) :?> 
                    
                    <a href="usuario.php?usuario=<?php echo $_SESSION['usuario']?>" class=""><i class="fas fa-user mx-2 "></i>
                        <span> 
                            <?php echo $_SESSION['usuario']; ?>
                        </span>
                    </a>

                    <?php else : ?>
                    <a href="login.php" class=""><i class="fas fa-user mx-2 "></i>
                        <span>Iniciar Sesión</span>
                    </a>                   
        
                    <?php endif; ?>
            </div>
    
    </nav>

    <div class="container">
        <div class="row d-flex justify-content-center mt-4">
            <h4 id = "titulo_curso">Título del curso</h4>
        </div>

        <div class="row mt-4 d-flex justify-content-center">
            <label>Descripción: </label>
        </div>

        <div class="row mt-2 d-flex justify-content-center">
            <div class="col-sm-12 col-12 col-md-6 col-lg-6">
                <p id = "descripcion">Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis quam ipsa alias dignissimos iure, sapiente corporis, fugit fugiat similique voluptates consequatur molestiae repellendus magnam enim commodi repellat rerum. Ipsa, dolore.</p>
            </div>
        </div>

        <div class="row mt-2 d-flex justify-content-center">
            <div class="col-sm-5 col-5 col-md-5 col-lg-5 d-flex justify-content-end">
                <label>Tipo de Actividad: </label>
            </div>

            <div class="col-sm-7 col-7 col-md-7 col-lg-7">
                <label id = "tipo_Actividad" > Taller</label>
            </div>
        </div>

        <div class="row mt-2 d-flex justify-content-center">
            <div class="col-sm-5 col-5 col-md-5 col-lg-5 d-flex justify-content-end">
                <label>Dirigido: </label>
            </div>

            <div class="col-sm-7 col-7 col-md-7 col-lg-7">
                <label id = "dirigido" > Taller</label>
            </div>
        </div>

        <div class="row mt-2 d-flex justify-content-center">
            <div class="col-sm-5 col-5 col-md-5 col-lg-5 d-flex justify-content-end">
                <label>Profesor(es): </label>
            </div>

            <div class="col-sm-7 col-7 col-md-7 col-lg-7">
                <label id = "profesor" > Juan Manuel Hernández Contreras, Oscar Alejandro Delgadillo Martínez</label>
            </div>
        </div>

        <div class="row mt-2 d-flex justify-content-center">
            <div class="col-sm-5 col-5 col-md-5 col-lg-5 d-flex justify-content-end">
                <label>Colaborador(es): </label>
            </div>

            <div class="col-sm-7 col-7 col-md-7 col-lg-7">
                <label id = "colaborador" > Juan Manuel Hernández Contreras, Oscar Alejandro Delgadillo Martínez</label>
            </div>
        </div>

        <div class="row mt-2 d-flex justify-content-center">
            <div class="col-sm-5 col-5 col-md-5 col-lg-5 d-flex justify-content-end">
                <label>Requisito(s): </label>
            </div>

            <div class="col-sm-7 col-7 col-md-7 col-lg-7">
                <label id = "requisitos" > Ningúno</label>
            </div>
        </div>


        <div class="row mt-2 d-flex justify-content-center">
            <div class="col-sm-5 col-5 col-md-5 col-lg-5 d-flex justify-content-end">
                <label>Material(es): </label>
            </div>

            <div class="col-sm-7 col-7 col-md-7 col-lg-7">
                <label id = "material" >Materiales</label>
            </div>
        </div>

        <div class="row mt-2 d-flex justify-content-center">
            <div class="col-sm-5 col-5 col-md-5 col-lg-5 d-flex justify-content-end">
                <label>Horario(es): </label>
            </div>

            <div class="col-sm-7 col-7 col-md-7 col-lg-7">
                <label id = "horario" >Horario</label>
            </div>
        </div>

        <div class="row d-flex justify-content-center mt-4">
            <div class="col-sm-12 col-12 col-md-6 d-flex justify-content-center">
                

                <?php if(!isset($_SESSION['usuario'])) :?> 
                    
                    <a href="login.php" class="btn btn-primary mx-2" id = "btn_inscribir_SS">Inscribirse
                    </a>

                    <?php else : ?>
                    <a href="#" class="btn btn-primary mx-2 " id = "btn_inscribir_CS">Inscribirse</a>                   
        
                    <?php endif; ?>

                <a href="cursos.php" class = "btn btn-secondary mx-2">Atrás</a>
            </div>
            
        </div>

        
    </div>



    <script>
        

        $(document).ready(function(){
            var curso = {
                'curso' : "<?php echo $curso;?> "
            };

            var curso1 = "<?php echo $curso; ?> ";

            var usuario = "<?php echo $usuario?>";

            var datos = {
                    'curso' : curso1, 
                    'usuario' : usuario
                };


             botonInscribir(datos, curso1);

           


            


            $('#btn_inscribir_CS').on('click', function(){

                $.post('php/usuario/curso/inscribir.php', datos, function(respuesta){
                    respuesta = JSON.parse(respuesta);
                    if(respuesta){
                       alert("Ya tienes un curso inscrito en el mismo horario");

                    }else {
                        alert("Curso inscrito correctamente");
                        $('#btn_inscribir_CS').text("Ticket");
                        var cadena = 'ticket.php?curso=' + curso1; 
                        $("a[id = btn_inscribir_CS]").attr('href', cadena);


                    }
                });
            });
            
            
            $.post('php/usuario/curso/leer.php', curso, function(respuesta){
                respuesta = JSON.parse(respuesta);
                console.log(respuesta.material);
                $('#titulo_curso').text(respuesta.curso[0].titulo);
                $('#descripcion').text(respuesta.curso[0].descripcion);
                $('#tipo_Actividad').text(respuesta.curso[0].tipo_Actividad);
                $('#requisitos').text(respuesta.curso[0].requisitos);
                $('#dirigido').text(respuesta.curso[0].dirigido);

                var profesor = "";
                for(var i=0; i<respuesta.profesor.length; i++){
                    profesor += respuesta.profesor[i].nombre + "\n";
                }


                var resp = "";
                for(var i=0; i<respuesta.resp.length; i++){
                    resp += respuesta.resp[i].nombre + "\n";
                }

                var material = "";

                for(var i=0; i<respuesta.material.length; i++){
                    material += respuesta.material[i].nombreMaterial + " : " + respuesta.material[i].cantidadMaterial+ ",\n";
                }

                var horario = "";

                for(var i=0; i<respuesta.horario.length; i++){
                    horario += respuesta.horario[i].fecha + " : " + respuesta.horario[i].HI + "-" + respuesta.horario[i].HF + ", " + respuesta.horario[i].lugar + ".\n";
                }

                $('#profesor').text(profesor);
                $('#colaborador').text(resp);
                $('#material').text(material);
                $('#horario').text(horario);
                
            });






        });


        function botonInscribir(datos, curso1){

            var id_curso = curso1;
            

            $.post('php/usuario/curso/verificar.php', datos, function(respuesta){
                respuesta = JSON.parse(respuesta);


                if(!respuesta.inscrito){
                   $('#btn_inscribir_CS').text("Inscribir");


                }else {
                    var cadena = 'ticket.php?curso=' + id_curso; 
                    $('#btn_inscribir_CS').text('Ticket');
                    $("a[id = btn_inscribir_CS]").attr('href', cadena);
                    
                }
                

            });

                
         }




    </script>
    
</body>
</html>