<?php
    session_start();

    if(!isset($_SESSION['admin'])){
        header('Location: ../../admin/admin.php' );
    }
?>
<!-- Modal Agregar Usuario-->
<div class="modal fade" id="modal_AgregarUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" id ="titulo_modal">
        <h5 class="modal-title" id="exampleModalLabel" >Agregar Usuario</h5>
      </div>
      <div class="modal-body">
        <div class="row mt-0 mb-3">
            <div class="col-12 d-flex justify-content-center" id="divMensaje"></div>
        </div>
    
        <form  id ="formUsuario">
            <div class="form-group row mt-0 mb-0 d-flex justify-content-center">
                <div class="col-md-2 col-sm-12 modal_estilo" id = "divLabelId"></div>
                <div class="col-md-10 col-sm-12" id ="divInputId"></div>
            </div>

                        
            <div class="form-group row d-flex justify-content-center">

                <div class="col-md-4 col-sm-12 modal_estilo">
                    <label for="txt_ncuenta" class="col-form-label">N° de Cuenta:</label>
                </div>
                <div class="col-md-8 col-sm-12">
                    <input type="number" class="form-control" id="txt_ncuenta">
                </div>

                <div class="col-md-4 col-sm-12 modal_estilo mt-2">
                    <label for="txt_nombre" class="col-form-label">Nombre:</label>
                </div>
                <div class="col-md-8 col-sm-12 mt-2">
                    <input type="text" class="form-control" id="txt_nombre">
                </div>

                <div class="col-md-4 col-sm-12 modal_estilo mt-2">
                    <label for="txt_apellidoP" class="col-form-label">Apellido Paterno: </label>
                </div>
                <div class="col-md-8 col-sm-12 mt-2">
                    <input type="text" class="form-control" id="txt_apellidoP">
                </div>            


                <div class="col-md-4 col-sm-12 modal_estilo mt-2">
                    <label for="txt_apellidoM" class="col-form-label">Apellido Materno: </label>
                </div>
                <div class="col-md-8 col-sm-12 mt-2">
                    <input type="text" class="form-control" id="txt_apellidoM">
                </div>

                <div class="col-md-4 col-sm-12 modal_estilo mt-2">
                    <label for="txt_correo" class="col-form-label">Correo: </label>
                </div>
                <div class="col-md-8 col-sm-12 mt-2">
                    <input type="mail" class="form-control" id="txt_correo">
                </div>

                <div class="col-md-4 col-sm-12 modal_estilo mt-2">
                    <label for="txt_usuario" class="col-form-label">Usuario: </label>
                </div>
                <div class="col-md-8 col-sm-12 mt-2">
                    <input type="text" class="form-control" id="txt_usuario">
                </div>

                <div class="col-md-4 col-sm-12 modal_estilo mt-2">
                    <label for="txt_pass" class="col-form-label">Password: </label>
                </div>
                <div class="col-md-8 col-sm-12 mt-2">
                    <input type="password" class="form-control" id="txt_pass">
                </div>

                <div class="col-md-4 col-sm-12 modal_estilo mt-2">
                    <label for="txt_pass2" class="col-form-label">Repetir Password: </label>
                </div>
                <div class="col-md-8 col-sm-12 mt-2">
                    <input type="password" class="form-control" id="txt_pass2">
                </div>

                <div class="col-md-4 col-sm-12 modal_estilo mt-2">
                    <label for="txt_telefono" class="col-form-label">Teléfono: </label>
                </div>
                <div class="col-md-8 col-sm-12 mt-2">
                    <input type="number" class="form-control" id="txt_telefono">
                </div>

                <div class="col-md-4 col-sm-12 modal_estilo mt-2">
                    <label for="select_tipo" class="col-form-label">Tipo de Usuario: </label>
                </div>
                <div class="col-md-8 col-sm-12 mt-2">
                    <select name="" id="select_tipo" class="form-control">
                        
                    </select>
                </div>
            </div>

            

            <div class="row d-flex-row mt-4">
                
                <div class="form-group row mt-0 mb-0 ml-5">

                <div class="col-6">
                    <input type="submit" value="Aceptar" class = "btn btn-danger" id="btn_aceptar">
                </div>

                <div class="col-6">
                    <input type="button" value="Cancelar" class = "btn btn-secondary" data-dismiss="modal" id= "btn_cancelar">
                </div>

            </div> 
            </div>
            
                
            
        </form>
      </div>
    </div>
  </div>
</div>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Insertar Titulo de la página -->
    <title> Usuarios </title>

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
                <h4 class="d-flex justify-content-center mt-4 "><b>Usuarios</b></h4>
            </div>  
        </div>

        <!--div class="row d-flex justify-content-around mt-4">


            <div class="col-lg-3 col-sm-0"></div>
            <div class="col-lg-3 col-sm-4 d-flex justify-content-center">
                <a href="../" class="btn btn-agregar" data-toggle="modal" data-target="#modal_AgregarUsuario" id ="btn_agregar">Agregar</a>
            </div>

            <div class="col-lg-3 col-sm-4 d-flex justify-content-center">
                <a href="../admin" class="btn btn-salir">Salir</a>
            </div>

            <div class="col-lg-3 col-sm-0"></div>
        </div-->

        <div class="row mt-4 d-flex justify-content-center">
            <div class="col-lg-8 col-sm-10">
                <form id="formBuscar">
                    <div class="input-group d-flex justify-content-center">
                        <input id="txt_buscar" type="text" class="form-control col-sm-auto" name="txt_buscar" placeholder="Buscar">
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
                                    <th>Usuario</th>
                                    <th>Tipo de usuario</th>
                                    <th class="text-right">Agregar</th>
                                    <th class="text-left" data-toggle="modal" data-target="#modal_AgregarUsuario" id ="btn_agregar"><i class="fas fa-plus i_mostrar"></i></th>
                                </tr>
                            </thead>
                            <tbody id="tablaUsuario">

                            </tbody>
                        </table>
                    <!--/form-->  
                </div>
                <div class="col-lg-1 col-sm-0"></div>
        </div>



    </div>



    <!-- Es el footer>
    <footer class="mt-4">            
        <div class="footer"> 
        </div>                  
    </footer-->


    <script src="../../js/usuario.js"></script>    
</body>
</html>