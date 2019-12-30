<?php
    session_start();

    if(!isset($_SESSION['admin'])){
        header('Location: ../../admin/admin.php' );
    }
?>
<!-- Modal -->
<div class="modal fade" id="editarContancias" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header d-flex justify-content-center">
        <h5 class="modal-title" id="exampleModalLabel"><b>Actualizar datos de constancia</h5></b>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
            <form id = "form_editarConstancia">
                <!--Nombre del asistente-->
                <div class="row d-flex-row justify-content-center my-2">
                    <div class="col-sm-12 col-lg-4 d-flex justify-content-center">
                        <label for="edit_nombreAsistente" class="label-form-control">Nombre:</label>
                    </div>
                    <div class="col-sm-12 col-lg-8 justify-content-center">
                        <input type="text" class="form-control" id="edit_nombreAsistente">
                    </div>
                </div>

                <div class="row d-flex-row justify-content-center my-2">
                    <div class="col-sm-12 col-lg-4 d-flex justify-content-center">
                        <label for="edit_nombreAsistente" class="label-form-control">Apellido Paterno</label>
                    </div>
                    <div class="col-sm-12 col-lg-8 justify-content-center">
                        <input type="text" class="form-control" id="edit_apellidoPAsistente">
                    </div>
                </div>

                <div class="row d-flex-row justify-content-center my-2">
                    <div class="col-sm-12 col-lg-4 d-flex justify-content-center">
                        <label for="edit_nombreAsistente" class="label-form-control">Apellido Materno</label>
                    </div>
                    <div class="col-sm-12 col-lg-8 justify-content-center">
                        <input type="text" class="form-control" id="edit_apellidoMAsistente">
                    </div>
                </div>


                
                <!--MSG de correcto/error-->
                <div class="row d-flex justify-content-center mt-4" id= "div_msg_config">              
                </div>
                <!-- Botones Guardar/Cancelar Actualización -->
                <div class="row d-flex-row justify-content-between mt-4">
                    <div class="col-sm-6 col-lg-6 d-flex justify-content-center">
                        <input type="submit" value="Guardar" class="col-10 btn btn-primary">
                    </div>
                    <div class="col-sm-6 col-lg-6 d-flex justify-content-center">
                        <input type="reset" value="Cancelar" class="btn btn-secondary col-10" id= "edit_btnCancelar">
                    </div>
                </div>


            </form>
        </div>
                
        </div>
    </div>
  </div>
</div>

<div class="modal fade" id="dialogoEliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="main">
            
            <div class="row d-flex-row" id = "div-dialogoEliminar">
                <div class="col-12">
                    <div class="row mt-4">
                        <div class="col-12 d-flex justify-content-center">
                            <p><b>¿Desea eliminar la constancia?</b></p>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12 d-flex justify-content-around">
                            <button class="btn btn-danger col-lg-4 col-sm-6 mx-1" id = "btn_aceptarEliminar">Aceptar</button>
                            <button class="btn btn-secondary col-lg-4 col-sm-6" id = "btn_cancelarEliminar">Cancelar</button>
                         </div>
                    </div>
                </div>
            </div>

            <div class="row d-flex-row" id = "div-dialogoSuccess">
                <div class="col-12">
                    <div class="row mt-4">
                        <div class="col-12 d-flex justify-content-center">
                            <p><b>Eliminado Exitosamente</b></p>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12 d-flex justify-content-center">
                            <button class="btn btn-danger col-lg-6 col-sm-12 mx-1" id = "btn_aceptarSuccess">Aceptar</button>
                         </div>
                    </div>
                </div>
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
    <title> Editar constancias</title>

    <!--Códigos fuentes externos -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Exo+2" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    
   <link rel="stylesheet" href="../../../../bibliotecas/css/bootstrap.min.css">
    <!-- Estilos propios -->
    <link rel="stylesheet" href="../../../../css/main.css"> 
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
                    <h4 class="d-flex justify-content-center mt-4 "><b>Editar constancias</b></h4>
                </div>  
        </div>

        <!--div class="row d-flex justify-content-around mt-4">
           
            <div class="col-lg-3 col-sm-4 d-flex justify-content-center">
                <a href="../admin" class="btn btn-salir">Salir</a>
            </div>

            
        </div-->

        <div class="row mt-4 d-flex justify-content-center">
            <div class="col-lg-8 col-sm-10">
                <form id="form_buscarConstancia">
                    <div class="input-group d-flex justify-content-center">
                        <input id="buscar_constancia" type="text" class="form-control col-sm-auto" name="txt_buscar" placeholder="Buscar">
                        <button class="btn btn-outline-secondary input-group-append" type="submit" id="btn_buscar"><i class="fas fa-search"></i></button>
                    </div>                        
                </form>
            </div>
        </div>

        <div class="row mt-5">
                <div class="col-lg-12 col-sm-12">
                    <!--form method="post" action = "usuario/plantillaUsuario.php"-->
                        <table class="table align-center text-center">
                            <thead>
                                <tr class="texto-tabla">
                                    <th>id</th>
                                    <th>Nombre</th>
                                    <th>Curso</th>
                                    <th>Editar</th>
                                    <th>Generar</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody id="tablaEditarConstancia">

                            </tbody>
                        </table>
                    <!--/form-->  
                </div>
        </div>

        <!-- Es el footer>
        <footer class="mt-4">            
            <div class="footer"> 
            </div>                  
        </footer-->
        
        


    </div>
    <script src="../../../../bibliotecas/js/jquery-3.4.1.js"></script>
    <!--script src="../../../bibliotecas/js/popper.min.js"></script-->
    <script src="../../../../bibliotecas/js/bootstrap.min.js"></script>
    <script src="../../../../js/admin/reporte-usuario/editarConstancias/funciones.js"></script>
    <script src="../../../../js/admin/reporte-usuario/editarConstancias/vistas.js"></script>
    <script src="../../../../js/admin/reporte-usuario/editarConstancias/main.js"></script>

</body>
</html>