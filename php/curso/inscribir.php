<?php

    require('../base.php');
    require('../consulta.php');

    $conexion = abrirConexion();

    if(!$_SERVER['REQUEST_METHOD'] == 'POST'){
        $respuesta = false;

    } else {

        $curso = filter_var(trim($_POST['curso']),FILTER_SANITIZE_STRING);
        $usuario = filter_var($_POST['usuario'],FILTER_SANITIZE_STRING);

        $query = "SELECT nCuenta FROM usuario WHERE usuario = '$usuario'";
        
        $resultado = $conexion->query($query);
        $nCuenta = $resultado->fetch_array();
        
        $nCuenta = $nCuenta[0];

        $resultado->free();

    

        $query = "SELECT COUNT(id) FROM curso_usuario_insc WHERE nCuenta = '$nCuenta' AND id_curso = '$curso'";
        $resultado = $conexion->query($query);
        $inscrito = $resultado->fetch_array();
        $inscrito = $inscrito[0];
        $resultado->free();

        if($inscrito == 0){
            $query = "INSERT INTO curso_usuario_insc (id, nCuenta, id_curso) VALUES (NULL, '$nCuenta', '$curso')";
            $resultado = $conexion->query($query);

            if(!$resultado){
                $respuesta = false;
            }else {
                $respuesta = true;
            }


        }else {

            $respuesta = false;

        }



        echo json_encode($respuesta);





    }


?>