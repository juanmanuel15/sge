<?php  session_start();

    require ('../php/base.php');
    require ('../php/consulta.php'); 

    if(isset($_SESSION['admin'])){
        header('Location: admin.php');
    }
    
    $error = "";
    if($_SERVER['REQUEST_METHOD']== 'POST'){
        $usuario = filter_var($_POST['usuario'],FILTER_SANITIZE_STRING);
        $password = $_POST['pass'];

        if(empty($usuario) || empty($password)){
            $error .=  "<li>Usuario y/o Contraseña Vacíos</li>";            
        }else {
            $conexion = abrirConexion();
            $query = "SELECT usuario, pass FROM usuario WHERE usuario = '$usuario' AND pass = '$password' AND tipo_usuario = 1";

            $resultado = leerDatos($conexion, $query);


            if(!$resultado){
                $error .= "<li>Datos incorrectos</li>" ;
            }
            else if($resultado->num_rows == 1){

               $_SESSION['admin'] = $usuario;
               header('Location: ../php/admin');
               
            }if($resultado->num_rows>1 || $resultado->num_rows==0){
                $error .= "<li>Datos Incorrectos</li>";
            }
        }
        
    }

    require('../admin.php');




?>