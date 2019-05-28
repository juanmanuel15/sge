<?php
    session_start();

    if(!isset($_SESSION['admin'])){
        header('Location: ../../admin/admin.php' );
    }
?>
<!-- Modal Agregar Hora-->
<div class="modal fade" id="modal_agregar_hora" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" id ="titulo_modal">
        <h5 class="modal-title" id="exampleModalLabel" >Agregar Hora</h5>
      </div>
      <div class="modal-body">
        <div class="row mt-0 mb-3">
            <div class="col-12 d-flex justify-content-center" id="divMensajeHora"></div>
        </div>
    
        <form action = "" method="post" id ="formHora">
            <div class="form-group row mt-0 mb-0 d-flex justify-content-center">
                <div class="col-md-2 col-sm-12 modal_estilo" id = "divLabelId"></div>
                <div class="col-md-10 col-sm-12" id ="divInputId"></div>
            </div>

                        
            <div class="form-group row d-flex justify-content-center">
                <div class="col-md-3 col-sm-12 modal_estilo">
                    <label for="txt_hora" class="col-form-label">Hora:</label>
                </div>
                <div class="col-md-9 col-sm-12">
                    <input type="time" class="form-control" id="txt_hora">
                </div>            
            </div>

            

            <div class="d-flex">
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


<div class="modal fade" id="modal_agregar_fecha" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" id ="titulo_modal">
        <h5 class="modal-title" id="exampleModalLabel" >Agregar Fecha</h5>
      </div>
      <div class="modal-body">
        <div class="row mt-0 mb-3">
            <div class="col-12 d-flex justify-content-center" id="divMensajeFecha"></div>
        </div>
    
        <form action = "" method="post" id ="formFecha">
            <div class="form-group row mt-0 mb-0 d-flex justify-content-center">
                <div class="col-md-2 col-sm-12 modal_estilo" id = "divLabelId"></div>
                <div class="col-md-10 col-sm-12" id ="divInputId"></div>
            </div>

                        
            <div class="form-group row d-flex justify-content-center">
                <div class="col-md-3 col-sm-12 modal_estilo">
                    <label for="txt_fecha" class="col-form-label">Fecha:</label>
                </div>
                <div class="col-md-9 col-sm-12">
                    <input type="date" class="form-control" id="txt_fecha">
                </div>            
            </div>

            

            <div class="d-flex">
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
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Horario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Exo+2" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../css/main.css"> 
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <style>
        .modal_estilo{
            font-size:14px;
            font-weight: bold;
            font-family: 'Montserrat', sans-serif;
            text-align:left;

        }

        .espacio-tabla {
            margin-left: 10px;
            margin-right: 10px;
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
                <h3 class="d-flex justify-content-center mt-4"><b>Horario</b></h3>
            </div>  
        </div>


        <!--div class="row mt-4">
            <div class="col-12 d-flex justify-content-center">
                <a href="../admin" class="btn btn-salir">Salir</a>
            </div>
        </div-->


        <div class="row mt-4">
            
            <div class="col-lg-5 col-sm-12">
                <!--div class="row">
                     <div class="col-lx-4 col-sm-12 d-flex justify-content-center">
                        <button type="button" class="btn btn-agregar" data-toggle="modal" data-target="#modal_agregar_hora" id ="btn_agregarHora">Agregar</button>            
                     </div>
                </div-->

                <div class="row mt-5">
                    <table class="table text-center">
                        <thead class = "text_tabla">
                            <tr>
                                <th scope="col">Hora</th>
                                <th class="text-right">Agregar</th>
                                <th class="text-left"><span data-toggle="modal" data-target="#modal_agregar_hora" id ="btn_agregarHora"><i class="fas fa-plus i_mostrar"></i></span></th>
                            </tr>                
                        </thead>

                        <tbody class="text-center" id="tablaHora">
                        </tbody>               
                    </table>
                </div>
            </div>
            
            <div class="col-lg-1 col-sm-0"></div>

            <div class="col-lg-5 col-sm-12 ">
                <div class="row">
                     <!--div class="col-lx-4 col-sm-12 d-flex justify-content-center">
                        <button type="button" class="btn btn-agregar" data-toggle="modal" data-target="#modal_agregar_fecha" id ="btn_agregarFecha">Agregar</button>            
                     </div-->
                </div>

                <div class="row mt-5">
                    <table class="table text-center">
                        <thead class = "text_tabla">
                            <tr>
                                <th scope="col">Fecha</th>
                                <th class="text-right">Agregar</th>
                                <th class="text-left"><span data-toggle="modal" data-toggle="modal" data-target="#modal_agregar_fecha" id ="btn_agregarFecha"><i class="fas fa-plus i_mostrar"></i></span></th>
                            </tr>                
                        </thead>

                        <tbody class="text-center" id="tablaFecha">
                        </tbody>               
                    </table>
                </div>
            </div>
    </div>

        

      <script src="../../js/hora.js"></script>
      <script src="../../js/fecha.js"></script>

    
</body>
</html>   
