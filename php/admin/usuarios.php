<?php
    session_start();

    if(!isset($_SESSION['admin'])){
        header('Location: ../../admin/admin.php' );
    }
?>
<!-- Modal Agregar Usuario-->
<div class="modal fade" id="modal_AgregarUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header d-flex justify-content-start" id ="">
        <h5 class="modal-title text-center font-weight-bold" id="titulo_modal" >Agregar Usuario</h5>
      </div>
      <div class="modal-body">

        <div class="row" id = "msg_eliminar_usuario">
            <div class="col-12">

                <div class="row">
                    <div class="col-12 d-flex justify-content-center">                  
                        <label for=""><b>¿Desea eliminar a este usuario?</b></label>
                    </div>
                </div>
                <div class="row my-4">
                    <div class="col-12 d-flex justify-content-center">
                    <button class=" btn btn-danger col-lg-2 col-6 mx-2" id = "btn_aceptar_eliminarUsuario">Aceptar</button>
                    <button class="btn btn-secondary col-lg-2 col-6 mx-2" id = "btn_cancelar_eliminarUsuario">Cancelar</button> 
                    </div>
                </div>
                  
            </div>
         </div>

        <div class="row" id = "msg_respuesta">
            <div class="col-12">
                <div class="row">
                    <div class="col-12 d-flex justify-content-center" id = "msg_label">

                    </div>
                </div>
                <div class="row my-2">
                    <div class="col-12 d-flex justify-content-center">
                        <button class=" btn btn-danger col-lg-4 col-6" id = "btn_msg_aceptar">Aceptar</button>                    
                    </div>
                </div>
                
            </div>                
        </div>

        
        <!--div class="row mb-2 mt-2" id = "seleccionarUsuario">
            <div class="col-12" >

                <div class="row">
                    <div class="col-12 d-flex justify-content-center">
                        <label>Seleccione el usuario que desea agregar:</label>
                    </div>                    
                </div>
                <div class="row mt-2">
                    <div class="col-12">
                    <select name="select_tipo" id="select_tipo" class = "form-control"></select>
                    </div>                    
                </div>

                <div class="row mt-4">
                    <div class="col-12 d-flex justify-content-center">
                        <button class="btn btn-danger col-lg-4 col-6 mx-1" id = "aceptar_tipoUsuario">Aceptar</button
                        ><button class="btn btn-secondary col-lg-4 col-6 mx-1" id = "cancelar_tipoUsuario"> Cancelar</button>
                    </div>
                </div>
                
            </div>
        </div-->

        <!-- RadioButton para ver el numero de cuenta !-->
        <div class="row mt-2 mb-2" id = "radio_cuenta">
            <div class="col-12 d-flex justify-content-center">
                <label for="" class = "col-6 d-flex justify-content-end"> <b>¿Tiene número de Cuenta/Trabajador? </b></label>
                <input type="radio" name="nCuenta" value = "si" class= "col-1">Si
                <input type="radio" name="nCuenta" value = "no" class = "col-1">No    
            </div>
         </div>


         <!-- Fin del radio Buuton !-->

        <!-- Inicio del formulario para alumno !-->
        <div class="row" id = "formularioUsuario">
            <div class="col-12">

                <div class="row my-2 d-flex justify-content-center">
                    <div class="col-12 d-flex justify-content-center" id = "msg_agregarUsuario">

                    </div>
                </div>
                <form  id ="formUsuario_interno">

                <div class="row" id = "seleccionarUsuario">
                    <div class="col-4 d-flex justify-content-end">
                        <label for=""><b>Tipo de Usuario : </b></label>
                    </div>

                    <div class="col-8">
                        <select name="select_tipo" id="select_tipo" class = "form-control">
                        </select>                     
                    </div>
                </div>       

                    <div class="row mt-2" id = "campo_nCuenta">
                        <div class="col-4 d-flex justify-content-end">
                            <label for="txt_ncuenta" class="form-label"><b>N° de Cuenta o empleado*:</b></label>
                        </div>

                        <div class="col-8">
                            <input type="number" class="form-control d-flex justify-content-start" id="txt_ncuenta">
                        </div> 
                    </div>

                    <div class="row mt-2">
                        <div class="col-4 d-flex justify-content-end">
                            <label for="txt_nombre" class="form-label"><b>Nombre*</b>:</label>
                        </div>

                        <div class="col-8">
                            <input type="text" class="form-control d-flex justify-content-start" id="txt_nombre">
                        </div> 
                    </div>


                    <div class="row mt-2">
                        <div class="col-4 d-flex justify-content-end">
                            <label for="txt_apellidoP" class="form-label"><b>Apellido Paterno*:</b></label>
                        </div>

                        <div class="col-8">
                            <input type="text" class="form-control d-flex justify-content-start" id="txt_apellidoP">
                        </div> 
                    </div>


                    <div class="row mt-2">
                        <div class="col-4 d-flex justify-content-end">
                            <label for="txt_apellidoM" class="form-label"><b>Apellido Materno:</b></label>
                        </div>

                        <div class="col-8">
                            <input type="text" class="form-control" id="txt_apellidoM">
                        </div> 
                    </div>

                    <div class="row mt-2">
                        <div class="col-4 d-flex justify-content-end">
                            <label for="txt_correo" class="form-label"><b>Correo*:</b></label>
                        </div>

                        <div class="col-8">
                            <input type="email" class="form-control" id="txt_correo">
                        </div> 
                    </div>


                    <div class="row mt-2">
                        <div class="col-4 d-flex justify-content-end">
                            <label for="txt_usuario" class="form-label"><b>Usuario*:</b></label>
                        </div>

                        <div class="col-8">
                            <input type="text" class="form-control" id="txt_usuario">
                        </div> 
                    </div>

                    <div class="row mt-2">
                        <div class="col-4 d-flex justify-content-end">
                            <label for="txt_pass" class="form-label"><b>Contraseña*:</b></label>
                        </div>

                        <div class="col-8">
                            <input type="password" class="form-control" id="txt_pass">
                        </div> 
                    </div>

                    <div class="row mt-2">
                        <div class="col-4 d-flex justify-content-end">
                            <label for="txt_pass2" class="form-label"><b>Repetir contraseña*:</b></label>
                        </div>

                        <div class="col-8">
                            <input type="password" class="form-control" id="txt_pass2">
                        </div> 
                    </div>

                    <div class="row mt-2">
                        <div class="col-4 d-flex justify-content-end">
                            <label for="txt_telefono" class="form-label"><b>Teléfono*:</b></label>
                        </div>

                        <div class="col-8">
                            <input type="number" class="form-control" id="txt_telefono">
                        </div> 
                    </div>


                    <div class="row mt-2" id = "row_select_carrera">
                        <div class="col-4 d-flex justify-content-end">
                            <label for="select_carrera" class="form-label"><b>Carrera*:</b></label>
                        </div>

                        <div class="col-8">
                            <select id = "select_carrera"  name = "select_carrera" class = "form-control">

                            </select>
                        </div> 
                    </div>


                    <div class="row mt-4 " id = "">
                        <div class="col-12 d-flex justify-content-around" id = "btns_Usuario">
                            <!--input type="submit" value="Agregar" class = "btn btn-danger col-lg-3 col-4 " id = "agregar_usuario">
                            <button type = "button" class = "btn btn-info col-lg-3 col-4" id = "atras_usuario">Atrás</button>
                            <input type="reset" value="Cancelar" class = "btn btn-secondary col-lg-3 col-4 mx-2" id= "cancelar_usuario"-->
                            
                        </div>
                    </div>
                
                </form>
            
            </div>
        </div>
        <!-- Fin del formulario para alumno !-->

        
        <!-- Inicio del formulario para externo!-->
        <!--div class="row" id = "formulario_externo">
            <div class="col-12">

                <div class="row">
                    <div class="col-12" id = "msg_agregar_externo">

                    </div>
                </div>
                <form  id ="formUsuario_externo">
                    
                    <div class="row mt-2">
                        <div class="col-4 d-flex justify-content-end">
                            <label for="txt_nombre_externo" class="form-label"><b>Nombre*</b>:</label>
                        </div>

                        <div class="col-8">
                            <input type="text" class="form-control d-flex justify-content-start" id="txt_nombre_externo">
                        </div> 
                    </div>


                    <div class="row mt-2">
                        <div class="col-4 d-flex justify-content-end">
                            <label for="txt_apellidoP_externo" class="form-label"><b>Apellido Paterno*:</b></label>
                        </div>

                        <div class="col-8">
                            <input type="text" class="form-control d-flex justify-content-start" id="txt_apellidoP_externo">
                        </div> 
                    </div>


                    <div class="row mt-2">
                        <div class="col-4 d-flex justify-content-end">
                            <label for="txt_apellidoM_externo" class="form-label"><b>Apellido Materno:</b></label>
                        </div>

                        <div class="col-8">
                            <input type="text" class="form-control" id="txt_apellidoM_externo">
                        </div> 
                    </div>

                    <div class="row mt-2">
                        <div class="col-4 d-flex justify-content-end">
                            <label for="txt_correo_externo" class="form-label"><b>Correo*:</b></label>
                        </div>

                        <div class="col-8">
                            <input type="mail" class="form-control" id="txt_correo_externo">
                        </div> 
                    </div>


                    <div class="row mt-2">
                        <div class="col-4 d-flex justify-content-end">
                            <label for="txt_usuario_externo" class="form-label"><b>Usuario*:</b></label>
                        </div>

                        <div class="col-8">
                            <input type="text" class="form-control" id="txt_usuario_externo">
                        </div> 
                    </div>

                    <div class="row mt-2">
                        <div class="col-4 d-flex justify-content-end">
                            <label for="txt_pass_externo" class="form-label"><b>Contraseña*:</b></label>
                        </div>

                        <div class="col-8">
                            <input type="password" class="form-control" id="txt_pass_externo">
                        </div> 
                    </div>

                    <div class="row mt-2">
                        <div class="col-4 d-flex justify-content-end">
                            <label for="txt_pass2_externo" class="form-label"><b>Repetir contraseña*:</b></label>
                        </div>

                        <div class="col-8">
                            <input type="password" class="form-control" id="txt_pass2_externo">
                        </div> 
                    </div>

                    <div class="row mt-2">
                        <div class="col-4 d-flex justify-content-end">
                            <label for="txt_telefono_externo" class="form-label"><b>Teléfono*:</b></label>
                        </div>

                        <div class="col-8">
                            <input type="number" class="form-control" id="txt_telefono_externo">
                        </div> 
                    </div>

                    <div class="row mt-4 ">
                        <div class="col-12 d-flex justify-content-center">
                            <input type="submit" value="Agregar" class = "btn btn-danger col-lg-4 col-6 mx-1" id = "agregar_externo">
                            <input type="reset" value="Cancelar" class = "btn btn-secondary col-lg-4 col-6 mx-1" id= "cancelar_externo">
                        </div>
                    </div>
                
                </form>
            
            </div>
        </div-->
        <!-- Fin del formulario para externo!-->
        
        
        
        
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
                                    <th>Usuario</th>
                                    <th>Nombre</th>                                    
                                    <th>Tipo de usuario</th>
                                    <th>Área</th>
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


    <script src="../../js/admin/elemento-usuario/main.js"></script>
    <script src="../../js/admin/elemento-usuario/vistas.js"></script>
    <script src="../../js/admin/elemento-usuario/funciones.js"></script>
</body>
</html>