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
    
    <form action = "" method="post" id ="formLugar">
        <div class="form-group row mt-2 mb-4 d-flex justify-content-center" id= "divActualizar">
            <div class="col-md-2 col-sm-12 modal_estilo" id = "divLabelId">

            </div>

            <div class="col-md-10 col-sm-12" id ="divInputId">

            </div>
        </div>

                    
        <div class="form-group row d-flex justify-content-center">
            <div class="col-md-2 col-sm-12 modal_estilo">
                <label for="txt_nombreLugar" class="col-form-label">Nombre:</label>                
            </div>
            <div class="col-md-10 col-sm-12">
                <input type="text" class="form-control" id="txt_nombreLugar">
            </div>
            
        </div>
        <div class="form-group row d-flex justify-content-center">
            <div class="col-md-2 col-sm-12 modal_estilo">
                <label for="txt_cantidadLugar" class="col-form-label">Cantidad:</label>
            </div>
            <div class="col-md-10 col-sm-12">
                <input type="number" class="form-control" id="txt_cantidadLugar">
            </div>

            <div class="form-group row mt-5 mb-0">

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
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Exo+2" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../css/main.css"> 
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <style>
        .modal_estilo{
            font-size:14px;
            font-weight: bold;
            font-family: 'Montserrat', sans-serif;
            text-align:left;

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
                <h3 class="d-flex justify-content-center mt-4">Lugar</h3>
        </div>  
    </div>

    <div class="row mt-5">
        <div class="col-lx-4 col-sm-2"></div>
        <div class="col-lx-4 col-sm-8 d-flex justify-content-around">
            <button type="button" class="btn btn-agregar" data-toggle="modal" data-target="#modal_agregar" id ="btn_agregar">Agregar</button>
            <a href="../admin" class="btn btn-salir">Salir</a>
        </div>
        <div class="col-lx-4 col-sm-2"></div>
    </div>

    <div class="row mt-5">
        <div class="col-lx-4 col-sm-1"></div>
        <div class="col-lx-4 col-sm-10">
            
            <table class="table">
                <thead class = "text_tabla">
                                        <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope = "col"># Lugares </th>
                    </tr>
                
                </thead>
                <tbody class="text_tabla " id="tablaLugar">
                </tbody>
                
            </table>
        </div>
        <div class="col-lx-4 col-sm-1"></div>
    </div>
    
    </div>

    

      <script src="../../js/lugar.js"></script>
    
    
</body>
</html>   
