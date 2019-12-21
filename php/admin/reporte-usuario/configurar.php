<?php
   session_start();

   if(!isset($_SESSION['admin'])){
       header('Location: ../../../admin/admin.php' );
   } 
?>

<!-- Modal -->
<div class="modal fade" id="actualizarContancias" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header d-flex justify-content-center">
        <h5 class="modal-title" id="exampleModalLabel"><b>Actualizar datos de constancia</h5></b>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
            <form id = "form_configurarConstancia">
                <!--Nombre de la Universidad-->
                <div class="row d-flex-row justify-content-center my-2">
                    <div class="col-sm-12 col-lg-4 d-flex justify-content-center">
                        <label for="conf_nombreUniversidad" class="label-form-control">Nombre de la Universidad:</label>
                    </div>
                    <div class="col-sm-12 col-lg-8 justify-content-center">
                        <input type="text" class="form-control" id="conf_nombreUniversidad">
                    </div>
                </div>
                <!--Nombre del Campus-->
                <div class="row d-flex-row justify-content-center my-2">
                    <div class="col-sm-12 col-lg-4 d-flex justify-content-center">
                        <label for="conf_nombreCampus" class="label-form-control">Nombre del Campus:</label>
                    </div>
                    <div class="col-sm-12 col-lg-8 justify-content-center">
                        <input type="text" class="form-control" id="conf_nombreCampus">
                    </div>
                </div>
                <!--Nombre del director-->
                <div class="row d-flex-row justify-content-center my-2">
                    <div class="col-sm-12 col-lg-4 d-flex justify-content-center">
                        <label for="conf_nombreDirector" class="label-form-control">Nombre del Director</label>
                    </div>
                    <div class="col-sm-12 col-lg-8 justify-content-center">
                        <input type="text" class="form-control" id="conf_nombreDirector">
                    </div>
                </div>
                <!--Tipo de reconocimiento-->
                <div class="row d-flex-row justify-content-center my-2">
                    <div class="col-sm-12 col-lg-4 d-flex justify-content-center">
                        <label for="conf_tipoReconocimiento" class="label-form-control">Tipo de reconocimiento:</label>
                    </div>
                    <div class="col-sm-12 col-lg-8 justify-content-center">
                        <select name="" id="conf_tipoReconocimiento" class="form-control">
                            <option value="rec">Reconocimiento</option>
                            <option value="const">Constancia</option>
                        </select>
                    </div>
                </div>
                <!--Título del evento-->
                <div class="row d-flex-row justify-content-center my-2">
                    <div class="col-sm-12 col-lg-4 d-flex justify-content-center">
                        <label for="conf_tituloEvento" class="label-form-control">Título del evento:</label>
                    </div>
                    <div class="col-sm-12 col-lg-8 justify-content-center">
                        <input type="text" class="form-control" id="conf_tituloEvento">
                    </div>
                </div>
                <!--Dias en los que se lleva acabo-->
                <div class="row d-flex-row justify-content-center my-2">
                    <div class="col-sm-12 col-lg-4 d-flex justify-content-center">
                        <label for="conf_tituloEvento" class="label-form-control">Fechas: </label>
                    </div>
                    <div class="col-sm-1 col-lg-1 justify-content-center">
                        <label for="" class="align-center">Del</label>
                    </div>
                    <div class="col-sm-5 col-lg-3 justify-content-center">
                        <input type="date" name="" id="conf_FI" class="form-control">
                    </div>
                    <div class="col-sm-1 col-lg-1 justify-content-center">
                        <label for="" class="align-center">al</label>
                    </div>
                    <div class="col-sm-5 col-lg-3 justify-content-center">
                        <input type="date" name="" id="conf_FF" class="form-control">
                    </div>
                </div>
                <!--Lugar del evento-->
                <div class="row d-flex-row justify-content-center my-2">
                    <div class="col-sm-12 col-lg-4 d-flex justify-content-center">
                        <label for="conf_lugarEvento" class="label-form-control">Lugar del evento:</label>
                    </div>
                    <div class="col-sm-12 col-lg-8 justify-content-center">
                        <input type="text" class="form-control" id="conf_lugarEvento">
                    </div>
                </div>
                <!--Lema de la Universidad-->
                <div class="row d-flex-row justify-content-center my-2">
                    <div class="col-sm-12 col-lg-4 d-flex justify-content-center">
                        <label for="conf_lemaUniversidad" class="label-form-control">Lema de la universidad:</label>
                    </div>
                    <div class="col-sm-12 col-lg-8 justify-content-center">
                        <input type="text" class="form-control" id="conf_lemaUniversidad">
                    </div>
                </div>
                <!--Asistencias-->
                <div class="row d-flex-row justify-content-center my-2">
                    <div class="col-sm-12 col-lg-4 d-flex justify-content-center">
                        <label for="conf_asistencia" class="label-form-control">Asistencia:</label>
                    </div>
                    <div class="col-sm-10 col-lg-6 justify-content-center">
                        <input type="range" min="0" max="100" value="50" step = "5" class="form-control-range" id="conf_porcentaje">
                    </div>
                    <div class="col-sm-2 col-lg-2 justify-content-center" id = "div_conf_porcentaje">
                    </div>
                </div>
                <!--MSG de correcto/error-->
                <div class="row d-flex justify-content-center my-2" id= "div_msg_config">              
                </div>
                <!-- Botones Guardar/Cancelar Actualización -->
                <div class="row d-flex-row justify-content-between mt-4">
                    <div class="col-sm-6 col-lg-6 d-flex justify-content-center">
                        <input type="submit" value="Guardar" class="col-10 btn btn-primary">
                    </div>
                    <div class="col-sm-6 col-lg-6 d-flex justify-content-center">
                        <input type="reset" value="Cancelar" class="btn btn-secondary col-10" id= "conf_btnCancelar">
                    </div>
                </div>


            </form>
        </div>
                
        </div>
    </div>
  </div>
</div>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Configurar</title>

    <!--Códigos fuentes externos -->
    <!--link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"-->
    <link rel="stylesheet" href="../../../bibliotecas/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../css/main.css"> 
    <!--link href="https://fonts.googleapis.com/css?family=Exo+2" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous"-->

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
                <h5><b>Configurar constancias</b></h5>
                
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

            <div class="row d-flex justify-content-center my-4" id = "div_msg_base">  
            </div>   

            <div class="row d-flex justify-content-center">
                
                <div class="col-lg-3 col-sm d-flex justify-content-center"><label for="txt_uniNombre">Nombre de la universidad: </label></div>   
                <div class="col-lg-8 col-sm d-flex justify-content-center"><input type="text" name="" id="txt_uniNombre" class = "form-control"readonly></div>                   
            </div>

            <div class="row d-flex justify-content-center mt-2 mb-2">
                <div class="col-lg-3 col-sm d-flex justify-content-center"><label for="txt_uniCampus">Campus: </label></div>   
                <div class="col-lg-8 col-sm d-flex justify-content-center"><input type="text" name="" id="txt_uniCampus" class = "form-control"readonly></div>   
            </div> 
            <div class="row d-flex justify-content-center mt-2 mb-2">
                <div class="col-lg-3 col-sm d-flex justify-content-center"><label for="txt_nombreDirector">Nombre del director: </label></div>   
                <div class="col-lg-8 col-sm d-flex justify-content-center"><input type="text" name="" id="txt_nombreDirector" class = "form-control" readonly></div>   
            </div> 
            <!-- Tipo de reconociminto-->
            <div class="row d-flex justify-content-center mt-2 mb-2">
                <div class="col-lg-3 col-sm d-flex justify-content-center"><label for="txt_tipoReconocimiento">Tipo de reconocimiento: </label></div>   
                <div class="col-lg-8 col-sm d-flex justify-content-center"><input type="text" name="" id="txt_tipoReconocimiento" class = "form-control"readonly></div>   
            </div> 

            <!-- Título del evento-->
            <div class="row d-flex justify-content-center mt-2 mb-2">
                <div class="col-lg-3 col-sm d-flex justify-content-center"><label for="txt_tituloEvento">Título del evento: </label></div>   
                <div class="col-lg-8 col-sm d-flex justify-content-center"><input type="text" name="" id="txt_tituloEvento" class = "form-control" readonly></div>   
            </div> 

            <!-- Fecha del evento-->
            <div class="row d-flex justify-content-center mt-2 mb-2">
                <div class="col-lg-3 col-sm-5  d-flex justify-content-center"><label for="txt_fechaEvento" class = "text-rigth">Fechas del Evento: </label></div>   
                <div class="col-lg-3 col-sm-2 d-flex justify-content-center"><input type="date" name="" id="txt_fechaEventoInicial" class = "form-control" readonly></div>
                <div class="col-lg-2 col-sm-1 d-flex justify-content-center mr-0 ml-0"><label for="">al </label></div>
                <div class="col-lg-3 col-sm-2 d-flex justify-content-center"><input type="date" name="" id="txt_fechaEventoFinal" class = "form-control" readonly></div>     
            </div> 

            <div class="row d-flex justify-content-center mt-2 mb-2">
                <div class="col-lg-3 col-sm d-flex justify-content-center"><label for="txt_lugarEvento"  class = "col-form-label">Lugar del evento: </label></div>   
                <div class="col-lg-8 col-sm d-flex justify-content-center"><input type="text" name="" id="txt_lugarEvento" class = "form-control" readonly></div>   
            </div> 

            <div class="row d-flex justify-content-center mt-2 mb-2">
                <div class="col-lg-3 col-sm d-flex justify-content-center"><label for="txt_lugarEvento" class = "col-form-label">Lema de la universidad: </label></div>   
                <div class="col-lg-8 col-sm d-flex justify-content-center"><input type="text" name="" id="txt_lema" class = "form-control" readonly></div>   
            </div>


            <div class="row d-flex justify-content-center mt-2 mb-2">
                <div class="col-lg-3 col-sm d-flex justify-content-center"><label for="txt_lugarEvento" class = "col-form-label">Asistencia (%):</label></div>   
                <div class="col-lg-8 col-sm d-flex justify-content-center"><input type="text" name="" id="txt_asistencia" class = "form-control" readonly></div>   
            </div> 

            <div class="row d-flex justify-content-center mt-4 mb-2">
                <div class="col-lg-6 col-sm-12 d-flex justify-content-center mt-1">
                    <button class="btn btn-primary col-lg-8 col-sm-12" id="btn_actualizar" data-toggle="modal" data-target="#actualizarContancias">Actualizar</button>
                </div>
            </div>

             

        </div>
        
    </main>

    
    <script src="../../../bibliotecas/js/jquery-3.4.1.js"></script>
    <!--script src="../../../bibliotecas/js/popper.min.js"></script-->
    <script src="../../../bibliotecas/js/bootstrap.min.js"></script>    
    <script src="../../../js/admin/reporte-usuario/configurar/funciones.js"></script>
    <script src="../../../js/admin/reporte-usuario/configurar/vistas.js"></script>
    <script src="../../../js/admin/reporte-usuario/configurar/main.js"></script>


    
</body>
</html>