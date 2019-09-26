<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrar usuario</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Exo+2" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Titillium+Web|ZCOOL+XiaoWei" rel="stylesheet">
  <link rel="stylesheet" href="css/main.css"> 
  <link rel="stylesheet" href="css/usuario.css">
  
</head>
<body>
    <nav class="navbar d-flex justify-content-between p-2 mb-5">
            <div class="col-3 col-sm-4 col-md-3 col-lg-3 d-flex justify-content-center">
                <a class="" href="index.php">SGE</a>
            </div>
            <div class="col-3 col-sm-4 col-md-3 col-lg-3 d-flex justify-content-center">
                <a href="cursos.php" class="">Cursos</a>
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-lg-3 d-flex justify-content-center">
            <a href="#" class=""><i class="fas fa-user mx-2 "></i><span>Iniciar Sesión</span></a>
            </div>
    
    </nav>

    <div class="container">
        <div class="row mt-4 d-flex justify-content-center mb-2">
            <div class="col-sm-12 col-12 col-md-6 col-lg-4 d-flex justify-content-center">
                    <h4>Registro</h4>
            </div>
        </div>

        <!--div class="row d-flex justify-content-center mt-4">
            <div class="col-4 col-sm-4 col-lg-4 col-md-4 d-flex justify-content-center">
                <img src="img/bloquear.svg" alt="" width="100px" height="100px">
            </div>
        </div-->
        <form id="registro">

            <div class="row d-flex justify-content-center mt-4">
                    <div class="col-lg-5 col-sm-12 col-12 col-md-8">                                         
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-sort-numeric-up"></i></span>
                            </div>
                            <input type="number" class="form-control" placeholder="Número de Cuenta" name="nCuenta" id = "nCuenta" maxlength = "10"> 
                        </div>                            
                    </div>                
                </div>

            <div class="row d-flex justify-content-center mt-2">
                 <div class="col-lg-5 col-sm-12 col-12 col-md-8">                                         
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Nombre" name="nombre" id = "nombre" maxlength = "50"> 
                    </div>                            
                </div>                
            </div>

            <div class="row d-flex justify-content-center mt-2">
                    <div class="col-lg-5 col-sm-12 col-12 col-md-8">                                         
                       <div class="input-group">
                           <div class="input-group-prepend">
                               <span class="input-group-text"><i class="fas fa-user"></i></span>
                           </div>
                           <input type="text" class="form-control" placeholder="Apellido Paterno" name="apellidoP" id="apellidoP">
                       </div>                            
                   </div>                
            </div>

            <div class="row d-flex justify-content-center mt-2">
                    <div class="col-lg-5 col-sm-12 col-12 col-md-8">                                         
                       <div class="input-group">
                           <div class="input-group-prepend">
                               <span class="input-group-text"><i class="fas fa-user"></i></span>
                           </div>
                           <input type="text" class="form-control" placeholder="Apellido Materno" name="apellidoM" id="apellidoM">
                       </div>                            
                   </div>                
            </div>

            <div class="row d-flex justify-content-center mt-2">
                    <div class="col-lg-5 col-sm-12 col-12 col-md-8">                                         
                       <div class="input-group">
                           <div class="input-group-prepend">
                               <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                           </div>
                           <input type="text" class="form-control" placeholder="Correo" name="correo" id="correo">
                       </div>                            
                   </div>                
            </div>

            <div class="row d-flex justify-content-center mt-2">
                    <div class="col-lg-5 col-sm-12 col-12 col-md-8">                                         
                       <div class="input-group">
                           <div class="input-group-prepend">
                               <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                           </div>
                           <input type="text" class="form-control"  placeholder="Repetir Correo" name="correo2" id="correo2">
                       </div>                            
                   </div>                
            </div>

            <div class="row d-flex justify-content-center mt-2">
                    <div class="col-lg-5 col-sm-12 col-12 col-md-8">                                         
                       <div class="input-group">
                           <div class="input-group-prepend">
                               <span class="input-group-text"><i class="fas fa-user"></i></span>
                           </div>
                           <input type="text" class="form-control" placeholder="Usuario" name="usuario" id="usuario">
                       </div>                            
                   </div>                
            </div>
            
            


            <div class="row d-flex justify-content-center mt-2">
                <div class="col-lg-5 col-sm-12 col-12 col-md-8">                                         
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Contraseña" name="pass" id="pass">
                    </div>                            
                </div>                
            </div>

            <div class="row d-flex justify-content-center mt-2">
                    <div class="col-lg-5 col-sm-12 col-12 col-md-8">                                         
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Repetir Contraseña" name="pass2" id="pass2">
                        </div>                            
                    </div>                
            </div>

            <div class="row d-flex justify-content-center mt-2">
                    <div class="col-lg-5 col-sm-12 col-12 col-md-8">                                         
                       <div class="input-group">
                           <div class="input-group-prepend">
                               <span class="input-group-text"><i class="fas fa-phone"></i></span>
                           </div>
                           <input type="number" class="form-control" placeholder="Teléfono" name="telefono" id="telefono">
                       </div>                            
                   </div>                
            </div>

            <div class="row d-flex justify-content-center mt-2">
                    <div class="col-lg-5 col-sm-12 col-12 col-md-8">                                         
                       <div class="input-group">
                           <div class="input-group-prepend">
                               <span class="input-group-text"><i class="fas fa-chalkboard-teacher"></i></span>
                           </div>
                           <select name="select_carrera" id="select_carrera" class = " form-control"></select>                           
                       </div>                            
                   </div>                
            </div>



            <div class="row mt-4 mb-2 d-flex justify-content-center">
                <div class="col-12 d-flex justify-content-center">
                    <span>¿Ya estas registrado? <a href="login.php">Ingresa</a></span>
                </div>        
            </div>

            <div class="row mt-2 mb-2 d-flex justify-content-center p-0">
                <div class="col-12 col-sm-12 col-md-8 col-lg-8 d-flex justify-content-center" id ="divMensaje">
                    
                </div>
            </div>

            <div class="row d-flex justify-content-center mt-4 mb-4">
                <div class="col-sm-12 col-12 col-md-8 col-lg-6 d-flex justify-content-center">
                    <input type="submit" value="Registrarse" class="col-sm-5 col-6 col-md-4 col-lg-3 mx-2 p-1 btn btn-primary" id = "btn_registrar">
                    <a  href ="login.php" value="Regresar" class="col-sm-5 col-6 col-md-4 col-lg-3 mx-2 btn btn-secondary p-1">Regresar</a>
                    
                </div>
                
            </div>
            
        </form>
    </div>
    <script src="js/usuario/registro.js"></script>
</body>
</html>