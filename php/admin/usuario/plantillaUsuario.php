<?php

    session_start();

    if(!isset($_SESSION['admin'])){
        header('Location: ../../../admin/admin.php' );
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Insertar Titulo de la página -->
    <title>  </title>

    <!--Códigos fuentes externos -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Exo+2" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <!-- Estilos propios -->
    <link rel="stylesheet" href=""> 
    
</head>
<body>
    
    


    <!-- Contenido de la página -->

    <div class="container">

        <div class="row">
            
            <div class="row mt-3">
                <div class="d-flex justify-content-center col-lg-12 col-sm-12">
                    <span>Nombre: </span>
                    <span>{{Nombre del usuario}}</span>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-sm-12 col-md-6 d-flex justify-content-center">
                    <span>Numero de Cuenta: </span>
                    <span><?php echo $_GET['numeroCuenta']?></span>
                </div>
                <div class="col-sm-12 col-md-6 d-flex justify-content-center"></div>
                    <span>Usuario: </span>
                    <span>{{Usuario}}</span>
            </div>


        </div>
        
        
    </div>


</body>
</html>