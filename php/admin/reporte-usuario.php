<?php
    session_start();

    if(!isset($_SESSION['admin'])){
        header('Location: ../../admin/admin.php' );
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Insertar Titulo de la página -->
    <title>Reporte-usuario</title>

    <!--Códigos fuentes externos -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Exo+2" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- Estilos propios -->
    <link rel="stylesheet" href="../../css/main.css"> 
    <link rel="stylesheet" href=""> 


    <style type = "text/css">
        .tipo-usuario{
            height: 150px;
            
        }

        a:link {
            text-decoration:none;
        }
    </style>
    
</head>
<body>
    
    <!-- Barra de navegación -->
    <nav class="navbar navbar-dark bg-dark justify-content-between">
            <a href="#" class="navbar-brand ml-3">Administrador</a>
            <form action="" class="form-inline">
                <a href="cerrarSesion.php" class="btn btn-outline-dark letra_nav btn_cerrarSesion" type="button" id="btn_cerrar_sesion">CERRAR SESIÓN</a>
            </form>

            
    </nav>


    <!-- Contenido de la página -->

    <div class="container">

        <div class="row d-flex justify-content-center">
                <div class="col-xl-6 col-sm-12">
                    <h4 class="d-flex justify-content-center mt-4 "><b>Constancias</b></h4>
                </div> 
        </div>

        <div class="row mt-4">
            <div class="col-12">
                <p class = "text-center"> Presiona cualquiera de los siguientes botones para generar la constancia correspondiente</p>
            </div>
        </div>

        <div class="row mt-5 d-flex justify-content-center">
            
                <a href="reporte-usuario/asistente" class= "col-6 col-lg-2 my-1"><button class="btn btn-primary tipo-usuario col-12">Asistente</button></a>
                <a href="reporte-usuario/colaborador" class= "col-6 col-lg-2 my-1"><button class="btn btn-success tipo-usuario col-12">Colaborador</button></a>
                <a href="reporte-usuario/editar" class= "col-6 col-lg-2 my-1"><button class="btn btn-dark tipo-usuario col-12">Editar</button></a>
                <a href="reporte-usuario/personalizar.php" class= "col-6 col-lg-2 my-1"><button class="btn btn-warning tipo-usuario col-12">Personalizar</button></a>                
                
            
        </div>

        <div class="row mt-1 d-flex justify-content-center">
                <a href="reporte-usuario/profesor" class= "col-6 col-lg-4 my-1"><button class="btn btn-secondary tipo-usuario col-12">Profesor</button></a>                
                <a href="reporte-usuario/configurar.php" class= "col-6 col-lg-4 my-1"><button class="btn btn-danger tipo-usuario col-12">Configurar</button></a>
            
        </div>

        
    </div>


</body>
</html>