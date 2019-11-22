<?php
   session_start();

   if(!isset($_SESSION['admin'])){
       header('Location: ../../../admin/admin.php' );
   } 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Configurar</title>

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
     <link rel="stylesheet" href="../../../css/main.css"> 
    
    <!-- Barra de navegación -->
    <nav class="navbar navbar-dark bg-dark justify-content-between">
        <a href="../../admin/" class="navbar-brand ml-3">Administrador</a>
            <form action="" class="form-inline">
                <a href="../cerrarSesion.php" class="btn btn-outline-dark letra_nav btn_cerrarSesion" type="button" id="btn_cerrar_sesion">CERRAR SESIÓN</a>
            </form>            
    </nav>
    <!-- Fin de la barra de navegación -->

</head>
<body>
    <!-- Contenido de la página -->
    <main> 
        <div class="container">
            <div class="row mb-4 mt-4 d-flex justify-content-center">
                <h5><b>Configurar Constancias</b></h5>
                
                <!-- 
                    Ruta imagen
                    Nombre de la Universidad
                    Nombre del Centro Universitario
                    Tipo de Reconocimiento
                    Título del evento
                    Días en los que se llevo acabo
                    Lugar donde se lleva acabo
                    Lema, slogan de la universidad
                    Firma de quien lo avala
                    Porcentaje de Asistencia
                    Ruta sello
                -->
            </div>     

            <div class="row d-flex justify-content-center">
                
                <div class="col-lg-3 col-sm d-flex justify-content-center"><label for="txt_uniNombre">Nombre de la universidad: </label></div>   
                <div class="col-lg-8 col-sm d-flex justify-content-center"><input type="text" name="" id="txt_uniNombre" class = "form-control"></div>   
                
            </div>

            <div class="row d-flex justify-content-center mt-2 mb-2">
                <div class="col-lg-3 col-sm d-flex justify-content-center"><label for="txt_uniCampus">Campus: </label></div>   
                <div class="col-lg-8 col-sm d-flex justify-content-center"><input type="text" name="" id="txt_uniCampus" class = "form-control"></div>   
            </div> 

            <div class="row d-flex justify-content-center mt-2 mb-2">
                <div class="col-lg-3 col-sm d-flex justify-content-center"><label for="txt_tipoReconocimiento">Tipo de reconocimiento: </label></div>   
                <div class="col-lg-8 col-sm d-flex justify-content-center"><input type="text" name="" id="txt_tipoReconocimiento" class = "form-control"></div>   
            </div> 

            <div class="row d-flex justify-content-center mt-2 mb-2">
                <div class="col-lg-3 col-sm d-flex justify-content-center"><label for="txt_tituloEvento">Título del evento: </label></div>   
                <div class="col-lg-8 col-sm d-flex justify-content-center"><input type="text" name="" id="txt_tituloEvento" class = "form-control"></div>   
            </div> 


            <div class="row d-flex justify-content-center mt-2 mb-2">
                <div class="col-lg-3 col-sm-5  d-flex justify-content-center"><label for="txt_fechaEvento" class = "text-rigth">Fechas del Evento: </label></div>   
                <div class="col-lg-3 col-sm-2 d-flex justify-content-center"><input type="date" name="" id="txt_fechaEventoInicial" class = "form-control"></div>
                <div class="col-lg-2 col-sm-1 d-flex justify-content-center mr-0 ml-0"><label for="">al </label></div>
                <div class="col-lg-3 col-sm-2 d-flex justify-content-center"><input type="date" name="" id="txt_fechaEventoFinal" class = "form-control"></div>     
            </div> 

            <div class="row d-flex justify-content-center mt-2 mb-2">
                <div class="col-lg-3 col-sm d-flex justify-content-center"><label for="txt_lugarEvento"  class = "col-form-label">Lugar del evento: </label></div>   
                <div class="col-lg-8 col-sm d-flex justify-content-center"><input type="text" name="" id="txt_lugarEvento" class = "form-control"></div>   
            </div> 

            <div class="row d-flex justify-content-center mt-2 mb-2">
                <div class="col-lg-3 col-sm d-flex justify-content-center"><label for="txt_lugarEvento" class = "col-form-label">Lema de la universidad: </label></div>   
                <div class="col-lg-8 col-sm d-flex justify-content-center"><input type="text" name="" id="txt_lugarEvento" class = "form-control"></div>   
            </div>


            <div class="row d-flex justify-content-center mt-2 mb-2">
                <div class="col-lg-3 col-sm d-flex justify-content-center"><label for="txt_lugarEvento" class = "col-form-label">Asistencia (%):</label></div>   
                <div class="col-lg-8 col-sm d-flex justify-content-center"><input type="text" name="" id="txt_lugarEvento" class = "form-control"></div>   
            </div> 

             

        </div>
        
    </main>
</body>
</html>