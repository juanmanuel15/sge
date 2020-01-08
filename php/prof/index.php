<?php
    session_start();

    if(!isset($_SESSION['prof'])){
        header('Location: ../../profesor/index.php' );
    }
?>

<!-- Modal -->
<div class="modal fade" id="modal_asistenciaUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_usuarioAsistencia"><b>Asistencia</b></h5>
      </div>
      <div class="modal-body">  
        <main>
            <div class="row d-flex justify-content-center my-3">
                <div class="col-lg-6 col-sm-12">
                    <div class="row">
                        
                        <div class="col-4 d-flex justify-content-center">
                            <b><label for="select_fechaActividad">Fecha :</label class = ""></b>
                        </div>
                        <div class="col-8 d-flex justify-content-center">
                            <select name="select_fechaActividad" id="select_fechaActividad" class="form-control mx-2"></select>
                        </div>
                    </div>                    
                </div>                
            </div>
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th class="text-center">Fecha</th>
                            </tr>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>

                            </tr>
                        </thead>
                        <tbody id = "table_asistentesInscritos">
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal_agregarCurso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Asistencia</h5>
      </div>
      <div class="modal-body">
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
    <title>Inicio</title>
    <!--link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Exo+2" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    
    <link rel="stylesheet" href="../../css/prof.css">
    <link rel="stylesheet" href="../../css/main.css">

    <link rel="stylesheet" type="text/css" href="../../bibliotecas/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../bibliotecas/css/bootstrap-grid.min.css">
    <link rel="stylesheet" type="text/css" href="../../bibliotecas/css/bootstrap-reboot.min.css">
    
    
    
        
    
</head>
<body>
    <!-- Barra de navegación -->
    <nav class="navbar navbar-dark bg-dark justify-content-between p-2">
            <a href="#" class="navbar-brand ml-4"><small class="">Profesor</small></a>
            <a href="cerrarSesion.php"><span class="btn btn-outline-light px-3 py-1">Cerrar Sesión</span></a>            
    </nav>

    <div class="container-fluid">
    	<div class="row mt-4">
    		<div class="col-lg-6 col-sm-12">
    			<div class="row">
    				<div class="col-12 d-flex justify-content-center">
    					<span><h3><b>Actividades</b></h3></span>
    				</div>
    			</div>

    			<div class="row mt-4">
    				<div class="col-lg-12">
    					<table class="table">
    						<thead class="text-center">
    							<tr>
                                    <th>#</th>
    								<th>Nombre</th>
    								<th>Inscritos</th>
    								<th>Asistencia</th>
    								<th>Lista</th>
    							</tr>
    						</thead>
    						<tbody class = "text-center" id = "table_actividadesProfesor">
    							
    						</tbody>
    					</table>
    				</div>
    			</div>
    		</div>
    		<div class="col-lg-6 col-sm-12">
    			
    		</div>
    </div>

    <!--footer class="mt-4" >
            
        <div class="footer"> 
        </div>
                  
    </footer-->

    
    
    <script src="../../bibliotecas/js/jquery-3.4.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="../../js/prof/index/funciones.js"></script>
	<script src="../../js/prof/index/vistas.js"></script>
    <script src="../../js/prof/index/main.js"></script>

	<script>
		var usuario = "<?php  echo $_GET['usuario'];   ?>";
		leer_actividades(usuario);
	</script>
    




</body>
</html>   
