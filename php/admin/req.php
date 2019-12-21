<?php
    session_start();

    if(!isset($_SESSION['admin'])){
        header('Location: ../../admin/admin.php' );
    }
?>
<!-- Modal -->
<div class="modal fade" id="modal_agregar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" id ="titulo_modal">
        <h5 class="modal-title" id="exampleModalLabel" >Agregar Lugar</h5>
      </div>
      <div class="modal-body">
        <div class="row mt-2 mb-2">
            <div class="col-12 d-flex justify-content-center" id="divMensaje">
            </div>
        </div>
    
    <form action = "" method="post" id ="formReq">       
        <div class="form-group row mb-4 d-flex justify-content-center" id= "divActualizar">
            <div class="col-md-2 col-sm-12 modal_estilo" id = "divLabelId">

            </div>

            <div class="col-md-10 col-sm-12" id ="divInputId">

            </div>
        </div>

                    
        <div class="form-group row d-flex justify-content-center">
            <div class="col-md-2 col-sm-12 modal_estilo">
                <label for="txt_nombreReq" class="col-form-label">Nombre:</label>                
            </div>
            <div class="col-md-10 col-sm-12">
                <input type="text" class="form-control" id="txt_nombreReq">
            </div>
            
        </div>
        <div class="form-group row d-flex justify-content-center">
          
                <div class="col">
                <input type="submit" value="Aceptar" class = "btn btn-danger" id="btn_aceptar">
                </div>

                <div class="col">
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
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Materiales</title>
    
    <link href="https://fonts.googleapis.com/css?family=Exo+2" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="../../bibliotecas/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/main.css"> 
    <!--link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <style>
        .modal_estilo{
            font-size:14px;
            font-weight: bold;
            font-family: 'Montserrat', sans-serif;
            text-align:left;

        }

        .svg_stilo {
            width: 20%;
        }
    </style>
    
        
    
</head>
<body>
    <!-- Se crea la parte de la navegación -->
    <nav class="navbar navbar-dark bg-dark justify-content-between">
            <a href="#" class="navbar-brand ml-3">Administrador</a>
            <form action="" class="form-inline">
                <a href="cerrarSesion.php" class="btn btn-outline-dark letra_nav btn_cerrarSesion" type="button" id="btn_cerrar_sesion">CERRAR SESIÓN</a>
            </form>

            
    </nav>

    <div class="container">
        

    <div class="row">
        <div class="col-xl-12 col-sm-12">
                <h3 class="d-flex justify-content-center mt-4"><b>Materiales</b></h3>
        </div>  
    </div>

    <!--div class="row mt-5">
        <div class="col-lx-4 col-sm-2"></div>
        <div class="col-lx-4 col-sm-8 d-flex justify-content-around">
            <button type="button" class="btn btn-agregar" data-toggle="modal" data-target="#modal_agregar" id ="btn_agregar">Agregar</button>
            <a href="../admin" class="btn btn-salir">Salir</a>
        </div>
        <div class="col-lx-4 col-sm-2"></div>
    </div-->

    <div class="row mt-5">
        <div class="col-lx-4 col-sm-1"></div>
        <div class="col-lx-4 col-sm-10">
            
            <table class="table text-center">
                <thead class = "">
                    <tr class="">                   
                        <th scope="col">Nombre</th>
                        <th class="text-right">Agregar</th>
                        <th class="text-left"><span type = "btn" class="" data-toggle="modal" data-target="#modal_agregar" id ="btn_agregar"><i class="fas fa-plus i_mostrar"></i><!--img src="../../img/plus-solid.svg" class = "svg_stilo"--></span></th>
                    </tr>
                
                </thead>
                <tbody class="text_tabla " id="tablaReq">
                </tbody>
                
            </table>
        </div>
        <div class="col-lx-4 col-sm-1"></div>
    </div>
    
    </div>

    

      
      <script src="../../bibliotecas/js/jquery-3.4.1.js"></script>
      <script src="../../bibliotecas/js/bootstrap.min.js"></script>   
      <script src="../../bibliotecas/js/popper.min.js"></script>
         
      <script src="../../js/req.js"></script>
    
    
</body>
</html>   
