<?php

    session_start();

    if(!isset($_SESSION['usuario'])){
        header('Location: login.php');
    }

    
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        $usuario = $_GET['usuario'];
    }
    
?>

<!-- Modal Agregar Usuario-->
<div class="modal fade" id="modal_AgregarUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header" id ="titulo_modal">
              <h5 class="modal-title" id="exampleModalLabel" >Editar Usuario</h5>
            </div>
            <div class="modal-body">
              
          
              <form  id ="formUsuario">
                  <div class="form-group row mt-0 mb-0 d-flex justify-content-center">
                      <div class="col-md-2 col-sm-12 modal_estilo" id = "divLabelId"></div>
                      <div class="col-md-10 col-sm-12" id ="divInputId"></div>
                  </div>
                                    
                  <div class="form-group row d-flex justify-content-center">     
            
      
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
                  </div>
      
                  <div class="row mt-0 mb-3">
                        <div class="col-12 d-flex justify-content-center" id="divMensaje"></div>
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
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

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
    <nav class="navbar d-flex justify-content-between p-2">
            <div class="col-3 col-sm-4 col-md-3 col-lg-3 d-flex justify-content-center">
                <a class="" href="index.php">SGE</a>
            </div>
            <div class="col-3 col-sm-4 col-md-3 col-lg-3 d-flex justify-content-center">
                <a href="cursos.php" class="">Cursos</a>
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-lg-3 d-flex justify-content-center">

                <?php if($_SESSION['usuario'] != "" ) :?> 
                    
                    <a href="#" class=""><i class="fas fa-user mx-2 "></i>
                        <span> 
                            <?php echo $_SESSION['usuario']; ?>
                        </span>
                    </a>

                    <?php else : ?>
                    <a href="#" class=""><i class="fas fa-user mx-2 "></i>
                        <span>Iniciar Sesión</span>
                    </a>                   
        
                    <?php endif; ?>
            </div>
    
    </nav>

    <div class="container">
        
        <div class="row mt-3 d-flex justify-content-end">
            <div class="col-4 col-sm-4 col-md-3 col-lg-3">
              <a href="cerrarSesion.php" class="btn btn-outline-primary btn-sm">Cerrar Sesión</a>
            </div>
        </div>

        <hr>

        <div class="row mt-4 d-flex justify-content-center">
            <div class="col-sm-12 col-12 col-md-8 col-lg-6 d-flex justify-content-center">
                <h5>Información del usuario</h5>
            </div>
        </div>
        
        <hr>

        <div class="row d-flex justify-content-center mt-4 mb-4">
                <div class="col-sm-12 col-12 col-md-8 col-lg-6 d-flex justify-content-center">
                        <input type="button" id = "btn-usuario-editar" value="Editar" class="col-sm-2 col-2 col-md-4 col-lg-4 mx-2 p-1 btn btn-secondary btn-usuario-editar" id="btn-editar" data-toggle="modal" data-target="#modal_AgregarUsuario">                    
                </div>                
        </div>

        <div class="row mt-6 d-flex justify-content-center">
                <div class="col-6 col-sm-6 col-md-6 col-lg-6 d-flex justify-content-end texto-usuario-2">
                    Número de Cuenta:
                </div>
                <div class="col-6 col-sm-6 col-md-6 col-lg- d-flex justify-content-start texto-usuario-1">
                    <span id="nCuenta"></span>
                </div>
        </div>

        <div class="row mt-2 d-flex justify-content-center">
            <div class="col-6 col-sm-6 col-md-6 col-lg-6 d-flex justify-content-end texto-usuario-2">
                Nombre:
            </div>
            <div class="col-6 col-sm-6 col-md-6 col-lg-6 d-flex justify-content-start texto-usuario-1">
                <span id="nombre"></span>
            </div>
        </div>

        <div class="row mt-2 d-flex justify-content-center">
                <div class="col-6 col-sm-6 col-md-3 col-lg-6 d-flex justify-content-end texto-usuario-2">
                    Correo:
                </div>
                <div class="col-6 col-sm-6 col-md-9 col-lg-6 d-flex justify-content-start texto-usuario-1">
                    <span id="correo"></span>
                </div>
        </div>


        <div class="row mt-2 d-flex justify-content-center mb-4">
                <div class="col-6 col-sm-6 col-md-6 col-lg-6 d-flex justify-content-end texto-usuario-2">
                    Usuario:
                </div>
                <div class="col-6 col-sm-6 col-md-6 col-lg-6 d-flex justify-content-start texto-usuario-1">
                    <span id="usuario"></span>
                </div>
        </div>

        <hr>

        

        <div class="row mt-4 d-flex justify-content-center">
            <div class="col-sm-12 col-12 col-md-8 col-lg-6 d-flex justify-content-center">
                <h5>Cursos inscritos</h5>
            </div>
        </div>
        <hr>
        

        <div class="row d-flex justify-content-center mb-4" >
          <div class="col-12" id = "cursoInscrito">

            
          </div>
            <!--div class="col-4 col-lg-2 usuario-curso-imagen curso-inscrito">                
            </div>
            <div class="col-5 col-lg-3  usuario-curso-description curso-inscrito">
                <div class="row">
                    <div class="col-12">
                        Título
                    </div>
                </div>
                <div class="row">
                        <div class="col-12">
                            Profesor
                        </div>
                </div>
                <div class="row">
                        <div class="col-12">
                            Fecha de inicio
                        </div>
                </div>
            </div>
            <div class="col-2 col-lg-1 align-self-center p-1 curso-inscrito">
                <div class="row mb-2">
                    <div class="col-12 ">
                        <a href=""class = "btn btn-primary btn-verCurso col-12">Ver</a>
                    </div>
                </div>
                <div class="row mt-2">
                        <div class="col-12 ">
                            <button class="btn-cancelarCurso btn btn-danger col-12">Eliminar</button>
                        </div>  
                    </div>
            </div-->
        </div>

        

       

    </div>
    <script src="js/usuario/cursos_inscrito.js"></script>
    <script>
        $(document).ready(function(){

            var usuario = "<?php echo $usuario;?>";

            var datos = {
                'usuario' : usuario
            };

            $('#usuario').text(usuario);
            leer();
            leerCursosInscritos();
            leerConstancias();
            

            var nombreI, apellidoMI, apellidoPI, correoI, passI;


            $(document).on('click', '#btn_eliminarCurso', function(respuesta){
              var id = $(this).attr('valor');

              var dato = {'id': id}
              var eliminar = confirm('¿Está seguro que desea eliminarlo?');

              if(eliminar){

                  $.post('php/usuario/eliminar_curso.php', dato, function(respuesta){
                  
                    respuesta = JSON.parse(respuesta);

                    console.log(respuesta);

                    if(respuesta){
                      alert('Curso eliminado');
                      leerCursosInscritos();
                    }

                  });

              }
            });
            

            $('#btn-usuario-editar').on('click', function(){               
                $('#divMensaje').empty();
                removerEstilos($('#divMensaje'), 'mensaje-error');
                removerEstilos($('#divMensaje'), 'mensaje-update');
                

               $.post("php/usuario/datos.php", datos, function (respuesta) {
                respuesta = JSON.parse(respuesta);
                
                nombreI = respuesta.nombre;
                apellidoPI = respuesta.apellidoP;
                apellidoMI= respuesta.apellidoM;
                correoI = respuesta.correo;
                passI = respuesta.pass;
                telI = respuesta.telefono;

                $('#txt_nombre').val(nombreI);
                $('#txt_apellidoP').val(apellidoPI);
                $('#txt_apellidoM').val(apellidoMI);
                $('#txt_correo').val(correoI);
                $('#txt_pass').val(passI);
                $('#txt_pass2').val(passI);
                $('#txt_telefono').val(telI);

                });
            });


            $('#formUsuario').submit(function (e){
                e.preventDefault();                 
                
                $('#divMensaje').empty();
                removerEstilos($('#divMensaje'), 'mensaje-error');
                removerEstilos($('#divMensaje'), 'mensaje-update');

               var vacioNombre = vacio($('#txt_nombre'));
               var vacioApellidoP = vacio($('#txt_apellidoP'));
               var vacioApellidoM = vacio($('#txt_apellidoM'));
               var vacioCorreo = vacio($('#txt_correo'));
               //var vacioCorreo2 = vacio($('#txt_correo2'));                 
               var vacioPass = vacio($('#txt_pass'));
               var vacioPass2 = vacio($('#txt_pass2'));
               var vacioTelefono = vacio($('#txt_telefono'));

                

              var nombreC= $('#txt_nombre').val();
              var apellidoPC = $('#txt_apellidoP').val();
              var apellidoMC= $('#txt_apellidoM').val();
              var correoC= $('#txt_correo').val();
              var passC= $('#txt_pass').val();
              var pass2C= $('#txt_pass2').val();
              var telefonoC= $('#txt_telefono').val();

                if(!vacioNombre || !vacioApellidoP || !vacioApellidoM || !vacioCorreo ||  !vacioPass2 || !vacioPass || !vacioTelefono ){
                      $('#divMensaje').addClass('mensaje-error');
                      $('#divMensaje').append('<li>Campos vacíos</li>');

                }else {                

                      if(correoI != correoC){
                          var verificarCorreo =  {
                          'mail' : correoC,
                          'usuario' : '',
                          'nCuenta' : ''

                          };                  

                          $.post('php/usuario/comprobar.php', verificarCorreo, function(respuesta){
                              respuesta = JSON.parse(respuesta);
                              if(respuesta.correo) {
                                  $('#divMensaje').addClass('mensaje-error');
                                  $('#divMensaje').append('<label>El correo ya existe </label>');
                              }else {
                                  if(passC != pass2C){
                                      $('#divMensaje').addClass('mensaje-error');
                                      $('#divMensaje').append('<label>Las contraseñas no son iguales </label>');

                                      }else {
                                          var datos = {
                                          'nombre' : nombreC,
                                          'apellidoP' : apellidoPC,
                                          'apellidoM' : apellidoMC,
                                          'mail': correoC,
                                          'pass' :passC,
                                          'telefono' : telefonoC,
                                          'usuario' :usuario
                                          };

                                          $.post('php/usuario/actualizar.php', datos, function(respuesta){
                                              mensajeActualizar();
                                              vaciarCampos();
                                              leer();
                                          });
                                      }
                              }
                          });



                      }else {

                          if(passC != pass2C){

                              $('#divMensaje').addClass('mensaje-error');
                              $('#divMensaje').append('<label>Las contraseñas no son iguales </label>');
                          
                          }else {

                              var datos = {
                              'nombre' : nombreC,
                              'apellidoP' : apellidoPC,
                              'apellidoM' : apellidoMC,
                              'mail': correoC,
                              'pass' :passC,
                              'telefono' : telefonoC,
                              'usuario' :usuario
                              };

                              $.post('php/usuario/actualizar.php', datos, function(respuesta){
                                  mensajeActualizar();
                                  vaciarCampos();
                                  leer();
                              });
                          }
                          
                      }

                    }
                
                
                
            });

            function vacio(obj){

              if(obj.val() == ''){
                  obj.addClass('input-vacio');
                  return false;
              }else {
                  obj.removeClass('input-vacio');
                  return true;
                  }
              }

              function removerEstilos(obj, clase){
                obj.removeClass(clase)
            }

            function mensajeActualizar(){
              $('#divMensaje').addClass('mensaje-update');
              $('#divMensaje').append('<label>Datos actualizados</label>');
            }

            function vaciarCampos(){
              document.getElementById("formUsuario").reset();
            }

            function leer(){
              $.post('php/usuario/datos.php', datos, function(respuesta){
                respuesta = JSON.parse(respuesta);
                $('#nombre').text(respuesta.nombre + " " + respuesta.apellidoP + " "  +respuesta.apellidoM);
                $('#nCuenta').text(respuesta.nCuenta);
                $('#correo').text(respuesta.correo);

            });
            }

            function leerCursosInscritos(){
              $.post('php/usuario/cursos_inscritos.php', datos, function(respuesta){
                respuesta = JSON.parse(respuesta);

                if(respuesta.datos != false){
                  vista_cursoInscrito(respuesta);
                }else {
                  $('#cursoInscrito').empty();
                }
                
                  
              });

            }


            function leerConstancias(){
                $.post('php/usuario/constancia.php', datos, function(respuesta){
                  respuesta = JSON.parse(respuesta);
                  console.log(respuesta);
                  vista_constancias(respuesta);
                });
              }
            



            
            
            
        });
    </script>
</body>
</html>