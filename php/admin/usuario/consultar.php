<?php 
  session_start();

    if(!isset($_SESSION['admin'])){
        header('Location: ../../../admin/admin.php' );
    }
	  require ('../../base.php');
    require ('../../consulta.php');

    //header('Content-Type: application/json');
    header("Content-Type: text/html;charset=utf-8");

  $cuenta = (int) $_POST['cuenta'];
	$correo = $_POST['correo'];
	$usuario = $_POST['usuario'];
    
    $respuesta = [];
    $conexion = abrirConexion();

     # Consulta para nCuenta

    if($cuenta != ''){

      $query = "SELECT * FROM usuario WHERE nCuenta = $cuenta";

      $resultado = leerDatos($conexion, $query);

      $rowCuenta = $resultado->num_rows;

      if($rowCuenta<1){
        $respCuenta =  false;
      } else {
        $respCuenta = true;
      }

      $resultado->free();

    }else {
      $respCuenta = false; 
    }

   

   	# Consulta para correo 

    if($correo !=  ''){

        $query = "SELECT * FROM usuario WHERE correo = '$correo'";

        $resultado = leerDatos($conexion, $query);

        $rowCorreo = $resultado->num_rows;

        if($rowCorreo<1){
          $respCorreo  = false ;
        } else {
          $respCorreo = true;       
        }

        $resultado->free();

    }else {
      $respCorreo = false;
    }

   	

   	#Consulta para usuario

    if($usuario != ''){

      $query = "SELECT * FROM usuario WHERE usuario = '$usuario'";

      $resultado = leerDatos($conexion, $query);

      $rowUsuario = $resultado->num_rows;

      if($rowUsuario<1){

        $respUsuario = false;

      } else {
        $respUsuario  = true;
      }

      $resultado->free();


    }else {
      $respUsuario = false;
    }


   	cerrarConexion($conexion);

    $respuesta = [
      'Verificar_usuario' => $respUsuario,
      'Verificar_correo' => $respCorreo,
      'Verificar_cuenta' => $respCuenta
    ];

    

    echo json_encode($respuesta);

?>