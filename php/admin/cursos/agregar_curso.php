<?php
    session_start();

    if(!isset($_SESSION['admin'])){
        header('Location: ../../admin/admin.php' );
    }
?>


<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title></title>
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
    <link rel="stylesheet" href="../../../css/main.css"> 
</head>
<body>
	<div class="container ">
		<form id="formCurso">
			<div class="row mt-4" id="divHorario">
				<div class="col-12">
					<div class="row">
						<div class="col-sm-8 col-lg-8">
	                        <h6 class="text-center pl-1">Horario(s)</h6>                        
	                    </div>

	                    <div class="col-sm-3 col-3 col-lg-3" id="div_btn_lugar" >
	                        <span id ="btn_lugar" class ="btn btn-outline-primary col-sm-12 col-lg-12" >Lugar</span>
	                    </div>

	                    <div class="col-sm-1 col-lg-1">
	                        <button class="btn" type="button" id="btn_agregarHorario"><i class="fas fa-plus"></i>
	                    </div>
					</div>

					<div class="row">
						<button>Aceptar</button>
					</div>
					 
				</div>
						 	
             </div>
		</form>
	</div>
	<script src= "../../../js/curso/agregarCurso.js"></script>
</body>
</html>