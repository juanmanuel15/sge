<?php  session_start();

    require ('../php/base1.php');
    require ('../php/Consultas.php'); 

    if(isset($_SESSION['prof'])){
        header('Location: admin.php');
    }
    
    $error = "";
    if($_SERVER['REQUEST_METHOD']== 'POST'){
        $usuario = filter_var($_POST['usuario'],FILTER_SANITIZE_STRING);
        $password = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);

        if(empty($usuario) || empty($password)){
            $error .=  "<li>Usuario y/o Contraseña Vacíos</li>";            
        }else {
            $base = new ConexionBase();
            $consulta = new Consultas();

            $conexion = $base->conectar();

            if($conexion != false){
                $query = $consulta->ingresoProf($usuario, $password);
                $resultado = $base->leer($query);

                if($resultado != false){
                    if($resultado->num_rows == 1){
                        $_SESSION['prof'] = $usuario;
                        setcookie('user', $usuario);
                        header('Location: ../php/prof/index.php?usuario=' . $usuario);
                    }else{
                        $error .= "<li>Datos incorrectos</li>" ;
                    }
                }else{
                    $error .= "<li>Datos Incorrectos</li>";
                }
            }else{
                $error .= "<li>Conexion fallida, intente más tarde</li>";
            }
            

           
        }
        
    }

    require('../profesor.php');




?>