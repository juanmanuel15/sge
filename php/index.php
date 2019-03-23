
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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/main.css">
    
    
    
        
    
</head>
<body>
    <!-- Se crea la parte de la navegación -->
    <nav class="navbar navbar-dark bg-dark justify-content-between">
            <a href="#" class="navbar-brand ml-3">Administrador</a>
            <form action="" class="form-inline">
                <button class="btn btn-outline-dark letra_nav btn_cerrarSesion" type="button" id="btn_cerrar_sesion">CERRAR SESIÓN</button>
            </form>

            
    </nav>

    <div class="container">
            
       <!-- Es el contenedor principal de la ventana-->
       <div class="container mt-4 mb-4 align-items-center">
        
    
        <!-- Contiene la parte de variables del sistema -->
        <div class="row mt-0 ">
            <div class="col-12 d-flex justify-content-center linea_abajo">
                <span class="titulo-seccion">VARIABLES DEL SISTEMA</span>                
            </div>
        </div>
        
        <div class="row mt-3">
            <div class="col-3 d-flex justify-content-center">
                    <a href="admin/req.php" class="btn-sm btn-primary col-sm col-lg-5 txt-button d-flex justify-content-center p-3" id ="btn_ver_req">Requerimientos</a>
            </div>
            <div class="col-3 d-flex justify-content-center ">
                    <a href="admin/lugar.php"class="btn-sm btn-primary col-sm col-lg-5 txt-button text-center p-3" id ="btn_ver_lugar">Lugar</a>
                    
            </div>
            <div class="col-3 d-flex justify-content-center">
                    <a href="admin/tactividad.php" class="btn-sm btn-primary col-sm col-lg-5 txt-button " id ="btn_ver_tActividad">Tipo de Actividad</a>
            </div>
            <div class="col-3 d-flex justify-content-center linea">
                    <a href="admin/horario.php" class="btn-sm btn-primary col-sm col-lg-5 txt-button p-3" id ="btn_ver_horario">Horario</a>
                    
            </div>
        </div>

        <!-- Contiene los el botón de ver usuarios principales -->
        <div class="row mt-5 d-flex justify-content-center linea_abajo">
                <span class="titulo-seccion">ELEMENTOS</span>
            </div>
    
            <div class="row mt-3">
                <div class="col d-flex justify-content-center">
                    <a href="admin/usuarios.php"  class="btn-sm btn-success linea col-sm col-lg-3 txt-button p-3" id = "btn_usuarios">Usuarios</a>
                                   
                </div>
                
                <div class="col d-flex justify-content-center">
                    <a href="admin/cursos.php"   class="btn-sm btn-success linea col-sm col-lg-3 txt-button p-3" id ="btn_cursos"> Cursos</a>
                </div>
            </div>


        <!-- Reportes -->

        <div class="row mt-5 linea_abajo d-flex justify-content-center">
            <span class="titulo-seccion">REPORTES</span>
        </div>

        <div class="row mt-3 d-flex justify-content-center">
            <div class="col-4 d-flex justify-content-center">
                <a href="admin/reporte-curso.php" class="btn-sm btn-danger col-sm col-lg-4 txt-button p-3" id ="btn_reporteCurso">Cursos</a>
            </div>
            <div class="col-4 d-flex justify-content-center">
                <a href="admin/reporte-usuario.php" class="btn-sm btn-danger col-sm col-lg-4 txt-button p-3" id ="btn_reporteUsuario">Usuario</a>
            </div>
            <div class="col-4 d-flex justify-content-center">
                <a href="admin/reporte-lugar.php" class="btn-sm btn-danger col-sm col-lg-4 txt-button p-3" id ="btn_reporteLugar">Lugar</a>                    
            </div>
        </div>
         </div>
         <script src="../js/main.js"></script>
         
    </div>

    <footer class="mt-4" >
            
        <div class="footer"> 
        </div>
                  
    </footer>

    
    
    
</body>
</html>   
