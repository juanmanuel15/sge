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

    <title>Personalizar Asistencia</title>

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
    <link rel="stylesheet" href="">


    <style>
        .txt_notas{
            font-size : 75%;
            color:red;
        }
    </style>



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
                <h5><b>Personalizar Constancias</b></h5>
            </div>   


            

            
            
                <div class="row d-flex-row justify-content-center my-2">            
                    <div class="col-12 col-lg-8 d-flex justify-content-center">
                        <label for="" class ="col-lg-4 col-6 col-form-label d-flex justify-content-end">Nombre del alumno: </label>
                        <input type="text" value ="" id = "txt_alumno" class = "col-lg-4 col-6 form-control">
                    </div>
                </div>

                <div class="row d-flex-row justify-content-center my-2">            
                    <div class="col-12 col-lg-8 d-flex justify-content-center">
                        <label for="" class ="col-lg-4 col-6 col-form-label d-flex justify-content-end">Tipo de Documento: </label>
                        <select name="select_tipoDocumento" id="select_tipoDocumento" class = "form-control col-lg-4 col-6"></select>                    
                    </div>
                </div>

                <div class="row d-flex-row justify-content-center my-2">            
                    <div class="col-12 col-lg-8 d-flex justify-content-center">
                        <label for="" class ="col-lg-4 col-6 col-form-label d-flex justify-content-end">Nombre del Curso: </label>
                        <select name="select_nombreCurso" id="select_nombreCurso" class = "form-control col-lg-4 col-6"></select>                    
                    </div>
                </div>

                <div class="row d-flex-row justify-content-center my-2">            
                    <div class="col-12 col-lg-8 d-flex justify-content-center">
                        <label for="" class ="col-lg-4 col-6 col-form-label d-flex justify-content-end">Titulo del evento: </label>
                        <select name="select_tituloEvento" id="select_tituloEvento" class = "form-control col-lg-4 col-6"></select>                    
                    </div>
                </div>

                <div class="row d-flex-row justify-content-center my-2">            
                    <div class="col-12 col-lg-8 d-flex justify-content-center">
                        <label for="" class ="col-lg-4 col-6 col-form-label d-flex justify-content-end">Tipo de Actividad: </label>
                        <select name="select_tActividad" id="select_tActividad" class = "form-control col-lg-4 col-6"></select>                    
                    </div>
                </div>


                <div class="row d-flex-row justify-content-center mt-2">            
                    <div class="col-12 col-lg-8 d-flex justify-content-center">
                        <label for="" class ="col-lg-4 col-6 col-form-label d-flex justify-content-end">Fechas de la actividad: </label>
                        <input type="text" id = "txt_fechaCurso" class = "form-control col-lg-4 col-6">                           
                    </div>
                </div>

                <div class="row">
                <label for="" class ="col-lg-12 col-12 col-form-label d-flex justify-content-center txt_notas"> <b>Ejemplo : 29, 30 de abril y 1 de mayo </b></label>
                </div>

                <div class="row d-flex-row justify-content-center mt-2">            
                    <div class="col-12 col-lg-8 d-flex justify-content-center">
                        <label for="" class ="col-lg-4 col-6 col-form-label d-flex justify-content-end">Lugar del evento: </label>
                        <input type="text" id = "txt_lugarCurso" class = "form-control col-lg-4 col-6">                    
                    </div>
                </div>

                <div class="row d-flex justify-content-center">
                    <div class="col-8 ">
                        <label for="" class ="col-lg-12 col-12 col-form-label d-flex justify-content-center txt_notas"> <b>Ejemplo : Ecatepec de Morelos, Estado de México </b></label>
                    </div>                
                </div>

                <div class="row d-flex-row justify-content-center my-2">            
                    <div class="col-12 col-lg-8 d-flex justify-content-center">
                        <label for="" class ="col-lg-4 col-6 col-form-label d-flex justify-content-end">Fecha de generación : </label>
                        <input type="date" id = "txt_fechaGeneracion" class = "form-control col-lg-4 col-6">                    
                    </div>
                </div>

                <div class="row d-flex-row justify-content-center my-2">            
                    <div class="col-12 col-lg-8 d-flex justify-content-center">
                        <label for="" class ="col-lg-4 col-6 col-form-label d-flex justify-content-end">Slogan : </label>
                        <input type="text" id = "txt_slogan" class = "form-control col-lg-4 col-6">                    
                    </div>
                </div>



                <div class="row d-flex-row justify-content-center my-2">            
                    <div class="col-12 col-lg-8 d-flex justify-content-center">
                        <label for="" class ="col-lg-4 col-6 col-form-label d-flex justify-content-end">Nombre del Director : </label>
                        <input type="text" id = "txt_director" class = "form-control col-lg-4 col-6">                    
                    </div>
                </div>



                <div class = "row my-4 d-flex justify-content-center" >
                    <div class="col-12 col-lg-6 d-flex justify-content-center" id = "msg_Constancia">

                    </div>
                </div>



                <div class="row my-4" id = "btns_ConstanciaPersonalizar">
                    <div class="col-12 d-flex justify-content-center">
                        <input type="button" value="Verificar" id = "btn_verficar" class = "btn btn-danger col-lg-2 col-6 mx-1">

                        <a href="" class = "mx-1 col-lg-2 col-6"  id = "btn_generarConstancia" >
                            <button value = "Generar" class = "btn btn-danger">Generar</button></a>
                        <input type="reset" value="Borrar" class = "btn btn-secondary mx-1 col-6 col-lg-2">
                    </div>      
                </div>


                

            

        </div>

    
    
    </main>
    

    <!--Fin del contenido -->
    <script src = "../../../js/admin/reporte-usuario/personalizar/main.js"></script>
    <script src = "../../../js/admin/reporte-usuario/personalizar/vistas.js"></script>
    <script src = "../../../js/admin/reporte-usuario/personalizar/funciones.js"></script>
</body>
</html>