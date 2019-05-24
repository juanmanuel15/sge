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
    <title>  </title>

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
                    <h4 class="d-flex justify-content-center mt-4">Reporte Lugar</h4>
                </div>  
        </div>

        

        
        <div class="mt-4 d-flex justify-content-center mb-0" >
            <div class="row">
                <div class="col-12">
                    <p class="text-justify">Por favor seleccione el <b>lugar</b> que desea ver la disponibilidad de horario</p>
                </div>
            </div>
            
        </div>

        <div class="row  d-flex justify-content-center mt-1"> 
            <div class="col-sm-12 col-lg-4 mx-0" id="idSelectLugar">
                <select name="" id="selectLugar" class="form-control">
                    <option>
                </select>
            </div>
        </div>

        

       

        <!-- Es el footer>
        <footer class="mt-4">            
            <div class="footer"> 
            </div>                  
        </footer-->
    </div>

    <script src= "../../js/admin/reporte-lugar/main.js"></script>


</body>
</html>