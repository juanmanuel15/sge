<?php
    session_start();

    if(!isset($_SESSION['admin'])){
        header('Location: ../../admin/admin.php' );
    }
?>


<!-- Modal -->
<div class="modal fade" id="modal_admin_reporte_usuario">
  <div class="modal-dialog modal-lg " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Usuarios inscritos</h5>
      </div>
      <div class="modal-body">
            <div class="container" id = "contenedorUsuarioInscrito">
                <div class="row">
                    <div class="col-10 d-flex justify-content-end">
                        <label for="">Agregar usuario</label>
                    </div>
                    <div class="col-1 d-flex justify-content-end">
                        <span id="bnt_agregarUsuario"><i class="fas fa-plus i_mostrar"></i></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Eliminar</th>
                                </tr>                                
                            </thead>
                            <tbody id="modalBody_usuariosInscritos">

                                
                            </tbody>
                        </table>
                        
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-12 d-flex justify-content-end">
                        <button class="btn btn-primary col-sm-12 col-lg-3" id="btn_Aceptar">Aceptar</button>
                    </div>
                </div>
            </div>


            <div class="container" id="contenedor_msgEliminarUsuario">
                <div class="row">
                    <div class="col-12 d-flex justify-content-center">
                        <label for="">¿Está seguro que desea eliminar al usuario?</label>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12 d-flex justify-content-center">
                        <button class="btn btn-danger mx-2 col-lg-3 col-6" id = "btn_aceptarEliminar">Aceptar</button>
                        <button class="btn btn-secondary mx-2 col-lg-3 col-6" id = "btn_cancelarEliminar">Cancelar</button>
                    </div>
                </div>
            </div>

            <div class="container" id="contenedor_agregarUsuarioCurso">
                <div class="row">
                    <div class="col-12 ">
                        <form id="formBuscarUsuarioCurso">
                            <div class="input-group d-flex justify-content-center">
                                <input id="txt_buscarUsuarioCurso" type="text" class="form-control col-sm-auto" name="txt_buscar" placeholder="Buscar por nombre, usuario, correo o número de Cuenta">
                                <button class="btn btn-outline-secondary input-group-append" type="submit" id="btn_buscarUsuarioCurso"><i class="fas fa-search"></i></button>
                            </div>                        
                        </form>
                    </div>
                    
                </div>

                <div class="row">
                    <div class="col-12 d-flex justify-content-center" id="tablaBuscarUsuario">
                        
                    </div>
                </div>  

                <div class="row">
                     <div class="col-12 d-flex-justify-content-center text-center" id="msg_UsuarioInsertado">
                         
                     </div>
                 </div> 


                <div class="row mt-4">
                    <div class="col-12 d-flex justify-content-end">
                        <button class="btn btn-secondary mx-2 col-lg-3 col-9" id = "btn_regresarBuscarUsuario">Regresar</button>
                    </div>
                </div>
            </div>

      </div>
      
    </div>
  </div>
</div>


<!-- Mensaje Eliminar a usuario de la actividad -->
<div class="modal fade" id="eliminarUsuarioCurso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Confirmación</h5>        
        </div>
      
      <div class="modal-body">
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <label for="">¿Está seguro que desea eliminar al usuario?</label>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12 d-flex justify-content-center">
                <button class="btn btn-danger mx-2 col-lg-4 col-6" id = "btn_aceptarEliminar">Aceptar</button>
                <button class="btn btn-secondary mx-2 col-lg-4 col-6" id = "btn_aceptarCancelar">Cancelar</button>
            </div>
        </div>
        
      </div>
      
    </div>
  </div>
</div>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Insertar Titulo de la página -->
    <title>Reporte Curso</title>

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
                    <h4 class="d-flex justify-content-center mt-4"><b>Reporte Cursos</b></h4>
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
                        <input id="txt_buscarCurso" type="text" class="form-control col-sm-auto" name="txt_buscar" placeholder="Buscar">
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
                                    <th>id</th>
                                    <th>Nombre del Curso</th>
                                    <th>Inscritos</th>
                                    <th>Ver usuarios</th>
                                    <th>Generar lista</th>
                                </tr>
                            </thead>
                            <tbody id="tablaReporteCurso">

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
        <script src="../../js/admin/reporte-curso/main.js"></script>
        <script src="../../js/admin/reporte-curso/vistas.js"></script>
    </div>


</body>
</html>