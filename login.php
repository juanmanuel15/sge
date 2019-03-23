<?php

    session_start();

    require('php/base.php');
    require('php/consulta.php');

    if(isset($_SESSION['usuario'])){
        header('Location: cursos.php');
    }

    $error = "";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $usuario = filter_var($_POST['usuario'], FILTER_SANITIZE_STRING);
        $password = $_POST['pass'];

        if(empty($usuario) || empty($password)){
            $error .= "<li>Usuario y/o Contraseña Vacíos</li>";
        } else {
            $conexion = abrirConexion();
            $query = "SELECT usuario, pass, nombre FROM usuario WHERE usuario = '$usuario' AND pass = '$password'";

            $resultado = $conexion->query($query);

            if(!$resultado){
                $error .= "<li> Datos Incorrectos";
            }else if($resultado->num_rows == 1){
                $_SESSION['usuario'] = $usuario;
                
                header('Location: cursos.php');
            }else {
                $error .= "<li>Usuarios duplicados<li>";
            }
        }
    }

    require('views/login.view.php');


?>