<?php
    session_start();

    if(!isset($_SESSION['admin'])){
        header('Location: ../../admin/admin.php' );
    }
?>

<!-- Modal -->
<div class="modal fade" id="asistencia_usuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_usuarioAsistencia"><b>Asistencia</b></h5>
      </div>
      <div class="modal-body">      

            <div class="row" id = "modal_mostrarAsistencia">
                <div class="col-12">
                        <div class="row mt-2">
                            
                                <div class="col-10 col-lg-11 d-flex justify-content-end">
                                    <label><b>Agregar Registro</b></label>
                                </div>


                                <div class="col-2 col-lg-1 d-flex justify-content-center">
                                    <span id= "agregar_registroAsistencia"><i class="fas fa-plus i_mostrar"></i></span>
                                </div>
                            
                        </div>  

                        <div class="row">
                            <div class="col-12 d-flex justify-content-center" id = "msg_asistencia">
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-12 d-flex justify-content-center">
                                <table id = "table_asistenciaUsuario" class = "table text-center">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Fecha de Entrada</th>
                                            <th>Fecha de Salida</th>
                                            <th>Hora de Entrada</th>
                                            <th>Hora de Salida</th>
                                            <th>Entrada</th>
                                            <th>Salida</th>
                                        </tr>
                                    </thead>
                                    <form id ="form_actualizarAsistencia">
                                        <tbody id = "tableBody_asistenciaUsuario">
                                        
                                            <!--tr>
                                                <td>1</td>
                                                <td>2019-05-21</td>
                                                <td><input type="checkbox" id="cbox1" value="first_checkbox"></td>
                                                <td><input type="checkbox" id="cbox1" value="first_checkbox"></td>

                                            </tr-->
                                        </tbody>                        
                                    
                                    
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 d-flex justify-content-center">
                                <button type = "submit" class="btn btn-danger mx-1 col-lg-4 col-6" id = "btn_registros">Actualizar</button>
                                <button type = "button" class="btn btn-secondary mx-1 col-lg-4 col-6" id = "btn_salir">Salir</button>
                            </div>
                        </div>
                        </form>

                </div>
            </div>

            



            <div class="row" id = "modal_eliminarRegistroAsistencia">
                <div class="col-12">
                        <div class="row">
                            <div class="col-12 d-flex justify-content-center text-center">
                                <h6><b>¿Desea eliminar el registro?</b></h6>
                            </div>                    
                        </div>

                        <div class="row mt-4 mb-4">
                            <div class="col-12 d-flex justify-content-center">
                                <button class="btn btn-danger mx-2 col-lg-2 col-6" id= "btn_modal_aceptarEliminarRegistro">Aceptar</button>
                                <button class="btn btn-secondary mx-2 col-lg-2 col-6" id = "btn_modal_cancelarEliminarRegistro">Cancelar</button>
                            </div>
                        </div>

                        <div class="row">
                        
                        </div>
                </div>
            </div>


            <div class="row" id = "modal_agregarRegistroAsistencia">
                <div class="col-12">                     

                    <div class="row" >
                        <div class="col-12 d-flex justify-content-center" id = "msg_agregarRegistroAsistencia">
                                                                
                        </div>
                    </div>              
                    <form id = "form_agregarRegistroAsistencia">
                        <div class="row">
                            <div class="col-12">
                                <table class = "table text-center">
                                    <thead>
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Entrada</th>
                                            <th>Salida</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="date" class = "form-control" name="" id="date_fechaRegistro" min ></td>
                                            <td><input type="checkbox" name="" id="cbox1" checked = "false" class ="form-check-input"></td>
                                            <td><input type="checkbox" name="" id="cbox2" checked = "false" class = "form-check-input"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>                      
                        
                        </div>

                       
                        <div class="row mt-2 mb-2">
                            <div class="col-12 d-flex justify-content-center">
                                <button type="submit" class = "btn btn-danger col-lg-3 col-6 mx-2">Agregar</button>
                                <button type="reset" class = "btn btn-secondary col-lg-3 col-6 mx-2" id = "btn_cancelarAgregarRegistro">Cancelar</button>  
                            </div>
                            
                        </div>                        
                    </form>


                    
                </div>
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
                    <h4 class="d-flex justify-content-center mt-4 "><b>Constancias</b></h4>
                </div>  
        </div>

        <!--div class="row d-flex justify-content-around mt-4">
           
            <div class="col-lg-3 col-sm-4 d-flex justify-content-center">
                <a href="../admin" class="btn btn-salir">Salir</a>
            </div>

            
        </div-->

        <div class="row mt-4 d-flex justify-content-center">
            <div class="col-lg-8 col-sm-10">
                <form id="formBuscar">
                    <div class="input-group d-flex justify-content-center">
                        <input id="buscar_Asistencia" type="text" class="form-control col-sm-auto" name="txt_buscar" placeholder="Buscar">
                        <button class="btn btn-outline-secondary input-group-append" type="submit" id="btn_buscar"><i class="fas fa-search"></i></button>
                    </div>                        
                </form>
            </div>
        </div>

        <div class="row mt-5">
                <div class="col-lg-1 col-sm-0"></div>
                <div class="col-lg-10 col-sm-12">
                    <!--form method="post" action = "usuario/plantillaUsuario.php"-->
                        <table class="table align-center text-center">
                            <thead>
                                <tr class="texto-tabla">
                                    <th>N° Cuenta</th>
                                    <th>Nombre</th>
                                    <th>Curso</th>    
                                    <th>Asistencia</th>
                                    <th>Generar</th>
                                </tr>
                            </thead>
                            <tbody id="tablaReporteUsuario">

                            </tbody>
                        </table>
                    <!--/form-->  
                </div>
                <div class="col-lg-1 col-sm-0"></div>
        </div>

        <!-- Es el footer>
        <footer class="mt-4">            
            <div class="footer"> 
            </div>                  
        </footer-->
        <script src = "../../js/admin/reporte-usuario/main.js"></script>
        <script src = "../../js/admin/reporte-usuario/vistas.js"></script>
        <!--script src = "../../js/admin/reporte-usuario/eliminar.js"></script-->
    </div>


</body>
</html>