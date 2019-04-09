<?php
    session_start();

    if(!isset($_SESSION['admin'])){
        header('Location: ../../admin/admin.php' );
    }
?>

<!-- Modal Agregar Curso -->
<div class="modal fade" id="modalCurso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitulo">Agregar Curso</h5>
      </div>
      <div class="modal-body">
            <div class="container-fluid">
                <div class="row mt-0 mb-3">
                     <div class="col-12 d-flex justify-content-center" id="divMensaje"></div>
                </div>

                <form id="formCurso">
                <div class="row mt-3"> 
                    
                    <div class="col-lg-3">
                        <label for="txt_titulo" class="col-form-label">Título: </label>
                    </div>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" id="txt_titulo">
                    </div>
                 </div>
                
                <div class="row mt-2">
                    <div class="col-lg-3">
                        <label for="txt_description" class="col-form-label">Descripción: </label>
                    </div>
                    <div class="col-lg-9">
                        <textarea name="" id="txt_description"  rows="2" class="form-control"></textarea>
                    </div>
                </div>

                <div class="row mt-2">                     
                    <div class="col-lg-3">
                        <label for="txt_cantidad" class="col-form-label">Cantidad: </label>
                    </div>
                    <div class="col-lg-9">
                        <input type="number" class="form-control" id="txt_cantidad">
                    </div>
                 </div>
                

                <div class="row mt-2">                     
                    <div class="col-lg-3">
                        <label for="txt_requisitos" class="col-form-label">Requisitos: </label>
                    </div>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" id="txt_requisitos">
                    </div>
                 </div>
                
                <div class="row mt-2">                     
                    <div class="col-lg-3 col-sm-12">
                        <label for="select_tActividad" class="col-form-label">Tipo de Actividad: </label>
                    </div>
                    <div class="col-lg-9 col-sm-12">
                        <select id="select_tActividad" name = "select_tActividad" class="form-control">
                        </select>
                    </div>
                 </div>

                 <div class="row mt-2">
                    <div class="col-lg-3">
                        <label for="txt_dirigido" class="col-form-label">Dirigído: </label>
                    </div>
                    <div class="col-lg-9">
                        <textarea name="" id="txt_dirigido"  rows="2" class="form-control"></textarea>
                    </div>
                </div>

                <!--Parte del seleccionador del profesor -->

                <div class="row mt-4">
                    <div class="col-sm-11 col-lg-11 d-flex justify-content-center">
                        <h6 class="text-center">Profesor(res)</h6>                        
                    </div>

                    <div class="col-sm-1 col-lg-1 d-flex justify-content-center" >
                        <button class="btn" type="button" id="btn_agregarProfesor"><i class="fas fa-plus"></i>
                    </div>    
                </div>


                <div class="row mt-2">
                    <table class="table">
                        <thead>
                            
                        </thead>
                        <tbody id="divProfesor">

                            <tr id="tableProfesor">
                                <td class="col-lg-11 col-sm-11">
                                    <select id="selectProfesor" name = "selectProfesor"  class="form-control">
                                    </select>
                                </td>

                                <td class="col-lg-1 col-sm-1" id="Ocultar_btnProfesor">
                                    <button class="btn" type="button" id="btn_quitarProfesor"><i class="fas fa-minus"></i>
                                </td>                        
                            </tr>  
                        </tbody>

                    </table>
                         
                </div>

                <!--Parte del seleccionador del Responsable -->
                <div class="row mt-4" id="">
                    <div class="col-sm-11 col-lg-11 d-flex justify-content-center">
                        <h6 class="text-center">Responsable(s)</h6>                        
                    </div>

                    <div class="col-sm-1 col-lg-1 d-flex justify-content-center" >
                        <button class="btn" type="button" id="btn_agregarResponsable"><i class="fas fa-plus"></i>
                    </div>    
                </div>

                <div class="row mt-2">
                    <table class="table">
                        <thead>
                            
                        </thead>
                        <tbody id="divResponsable">
                            <tr id="tableResponsable">
                                <td class="col-lg-11 col-sm-11">
                                    <select id="selectResponsable" name = "selectResponsable"  class="form-control">
                                    </select>
                                </td>

                                <td class="col-lg-1 col-sm-1">
                                    <button class="btn" type="button" id="btn_quitarResponsable"><i class="fas fa-minus"></i>
                                </td>                        
                            </tr>  
                        </tbody>

                    </table>
                </div>

                
                <div id="msg_error_horario" class="row d-flex justify-content-center">
                                            
                </div>

                <div class="row mt-4">
                    <div class="col-sm-8 col-lg-8 d-flex justify-content-center">
                        <h6 class="text-center pl-1">Horario(s)</h6>                        
                    </div>

                    <div class="col-sm-3 col-3 col-lg-3" id="div_btn_lugar" >
                        <span id ="btn_lugar" class ="btn btn-outline-primary col-sm-12 col-lg-12" >Lugar</span>
                    </div>

                    <div class="col-sm-1 col-lg-1 d-flex justify-content-center" id="div_btn_agregarHorario">
                        <button class="btn" type="button" id="btn_agregarHorario"><i class="fas fa-plus"></i>
                    </div>    
                </div>

                <div class="row mt-2 d-flex justify-content-center" id="tablaHorario">
                    <table class="table">
                        <thead class="titulo-tabla">
                            <tr class="text-center">
                                <th>Fecha</th>
                                <th>Hora de Inicio</th>
                                <th>Hora de Termino</th>
                                <th>Eliminar</th>    
                            </tr>
                        </thead>

                        <tbody id = "divHorario">
                            <tr id="tableHorario">
                                <td>
                                    <select id="selectFecha" class="form-control" name="selectFecha">                                        
                                    </select>                           
                                </td>
                                <td>
                                    <select id="selectHoraI" class="form-control" name="selectHoraI">
                                    </select> 
                                </td>
                                <td>
                                    <select id="selectHoraF" class="form-control" name="selectHoraF">                            
                                    </select>
                                </td>

                                <td>
                                    <button class="btn" type="button" id="btn_quitarHorario"><i class="fas fa-minus"></i>
                                </td>

                            </tr>
                        </tbody>
                    </table>
                    
                    
                </div>

                <!--Parte del seleccionador del Responsable -->
                <div class="row mt-2" id="">
                    <div class="col-sm-11 col-lg-11 d-flex justify-content-center">
                        <h6 class="text-center">Requerimiento(s)</h6>                        
                    </div>

                    <div class="col-sm-1 col-lg-1 d-flex justify-content-center" >
                        <button class="btn" type="button" id="btn_agregarReq"><i class="fas fa-plus"></i>
                    </div>    
                </div>

                <div class="row mt-2">
                    <table class="table">
                        <thead>
                            
                        </thead>
                        <tbody id="divReq">
                            <tr id="tableReq">
                                <td class="col-lg-11 col-sm-11">
                                    <select id="selectReq" name = "selectReq"  class="form-control">
                                    </select>
                                </td>

                                <td class="col-lg-1 col-sm-1">
                                    <button class="btn" type="button" id="btn_quitarReq"><i class="fas fa-minus"></i>
                                </td>                        
                            </tr>  
                        </tbody>

                    </table>
                </div>

                <!--Parte del seleccionador del Responsable -->
                <div class="row mt-2" id="">
                    <div class="col-sm-11 col-lg-11 d-flex justify-content-center">
                        <h6 class="text-center">Material(s)</h6>                        
                    </div>

                    <div class="col-sm-1 col-lg-1 d-flex justify-content-center" >
                        <button class="btn" type="button" id="btn_agregarMaterial"><i class="fas fa-plus"></i>
                    </div>    
                </div>

                <div class="row mt-2">
                    <table class="table">
                        <thead>
                            <tr class="text-center titulo-tabla">
                                <th>Material</th>
                                <th>Cantidad</th>
                            </tr>
                        </thead>
                        <tbody id="divMaterial">
                            <tr id="tableMaterial">
                                <td>
                                    <input type="text" name="txt_material"  class="form-control">

                                </td>

                                <td>
                                    <input type="number" name="txt_materialCantidad" id="txt_materialCantidad" class="form-control">

                                </td>

                                <td >
                                    <button class="btn" type="button" id="btn_quitarMaterial"><i class="fas fa-minus"></i>
                                </td>                        
                            </tr>  
                        </tbody>

                    </table>
                </div>



                <div class="row mt-4 form-inline">
                    <div class="col-lg-6 col-sm-12 mt-2 d-flex justify-content-center">
                        <button type="submit" class="btn btn-danger col-sm-5 col-lg-6" id="btn_aceptar">Agregar</button>
                    </div>
                    <div class="col-lg-6 col-sm-12 mt-2 d-flex justify-content-center">
                        <button type="button" class="btn btn-secondary col-sm-5 col-lg-6" data-dismiss="modal" id="btn_cancelar">Cancelar</button>
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

    <!-- Insertar Titulo de la página -->
    <title> Cursos </title>

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
            <div class="col-lg-6 col-md-8 col-sm-12">
                <h4 class="d-flex justify-content-center mt-4 linea-arriba linea-abajo">Cursos</h4>
            </div>  
        </div>


        <div class="row d-flex justify-content-around mt-2">


            <div class="col-lg-3 col-sm-0"></div>
            <div class="col-lg-3 col-sm-4 d-flex justify-content-center mt-2">
                <a href="#" class="btn btn-agregar" data-toggle="modal" data-target="#modalCurso" id ="btn_agregar">Agregar</a>
            </div>

            <div class="col-lg-3 col-sm-4 d-flex justify-content-center mt-2">
                <a href="../admin" class="btn btn-salir">Salir</a>
            </div>

            <div class="col-lg-3 col-sm-0"></div>
        </div>


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
                <div class="col-lg-2 col-sm-0"></div>
                <div class="col-lg-8 col-sm-12">
                    <!--form method="post" action = "usuario/plantillaUsuario.php"-->
                        <table class="table align-center text-center">
                            <thead>
                                <tr class="texto-tabla">
                                    <th>Título</th>
                                    <th>Ponente</th>
                                    <th hidden="">Editar</th>
                                    <th hidden="">Eliminar</th>
                                </tr>
                            </thead>
                            <tbody id="tablaCurso">

                            </tbody>
                        </table>
                    <!--/form-->  
                </div>
                <div class="col-lg-2 col-sm-0"></div>
        </div>

        
    </div>

    <script src= "../../js/cursos.js"></script>
</body>
</html>