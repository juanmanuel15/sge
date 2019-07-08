<?php

    include('../../base1.php');
    include('../../Consultas.php');

    header("Content-Type: text/html;charset=utf-8");

    $base = new ConexionBase();
    $consulta = new Consultas();

    if(isset($_POST['nCuenta'], $_POST['nombre'], $_POST['apellidoP'], $_POST['apellidoM'], $_POST['correo'], $_POST['usuario'], $_POST['pass'], $_POST['telefono'], $_POST['tipoUser'], $_POST['area'], $_POST['id'])){
        $servidor = false;

        $cuenta = htmlspecialchars($_POST['nCuenta']); 
        $nombre = htmlspecialchars($_POST['nombre']); 
        $apellidoP = htmlspecialchars($_POST['apellidoP']); 
        $apellidoM = htmlspecialchars($_POST['apellidoM']); 
        $correo = htmlspecialchars($_POST['correo']); 
        $usuario = htmlspecialchars($_POST['usuario']); 
        $pass = htmlspecialchars($_POST['pass']); 
        $telefono = htmlspecialchars($_POST['telefono']); 
        $tipoUser = htmlspecialchars($_POST['tipoUser']); 
        $area = htmlspecialchars($_POST['area']);
        $id = htmlspecialchars($_POST['id']);

        if(!empty($_POST['nombre']) && !empty($_POST['apellidoP'])  && !empty($_POST['correo']) && !empty($_POST['usuario']) && !empty($_POST['pass']) && !empty($_POST['telefono']) && !empty($_POST['tipoUser']) && !empty($_POST['area']) &&!empty($id)){
            $vacio = false;
            $conexion = $base->conectar();

            if($conexion != false){
                $conn = false;           


                $query = $consulta->leer_usuario($id);

                $resultado = $base->leer($query);
            
            

                foreach ($resultado as $datos ) {
                    $dato = [
                        'id' => $datos['nCuenta'],
                        'cuenta' => $datos['cuenta'],                    
                        'correo' => $datos['correo'],
                        'usuario' => $datos['usuario'],                    
                    ];
                }

                $resultado->free();

                
                #echo $dato['usuario'] ."!=" . $usuario . "<br>";
                #echo $dato['correo'] ."!=" . $correo . "<br>";
                #echo $dato['cuenta'] ."!=" . $cuenta . "<br>";
                
                if($dato['usuario'] != $usuario){
                     $conf_usuario = verificar_usuario($usuario, $consulta, $base); 
                }else {
                    $conf_usuario = false;
                }

                if($dato['correo'] != $correo){
                    $conf_correo = verificar_correo($correo, $consulta, $base);
                }else{
                    $conf_correo = false;
                }

                if($dato['cuenta'] != $cuenta){
                    $conf_cuenta = verificar_cuenta($cuenta, $consulta, $base);
                }else {
                    $conf_cuenta = false;
                }





                if(!$conf_correo && !$conf_cuenta && !$conf_usuario){
                    $conf = false;


                    $query = $consulta->actualizar_usuario($cuenta, $nombre, $apellidoP, $apellidoM, $correo, $usuario, $pass, $telefono, $tipoUser, $area,  $id);


                    $resultado = $base->actualizar($query);

                    if($resultado !=  false){
                        $success = true;
                    }else{
                        $success = false;
                    }


                }else{
                    $conf = [
                        'correo' => $conf_correo,
                        'usuario' => $conf_usuario,
                        'cuenta' => $conf_cuenta
                    ];
                    $success = false;
                }

                



        }else {
            $conn = true;
            $conf  = false;
            $success = false;
        }
            


        }else {
            $vacio = true;
            $conn = false;
            $conf = false;
            $success = false;

        }


    }else{
        $servidor = true;
        $conn = false;
        $vacio = false;
        $conf = false;
        $success = false;
    }

    $respuesta = [
        'servidor' => $servidor,
        'vacio' => $vacio,
        'conn' => $conn,
        'conf' => $conf,
        'success' => $success
    ];

    echo json_encode($respuesta);




    function verificar_correo($correo, $consulta, $base){
        
        $query = $consulta->consultar_correo($correo);
        $resultado = $base->leer($query);

        if($resultado->num_rows>0){
            $correo = true;
        }else{
            $correo = false;
        }

        $resultado->free();

        return $correo;

    }

    function verificar_usuario($usuario, $consulta, $base){
        
        $query = $consulta->consultar_usuario($usuario);
        $resultado = $base->leer($query);
    
        if($resultado->num_rows>0){
            $usuario = true;
        }else{
            $usuario = false;
        }

        $resultado->free();

        return $usuario;

    }


    function verificar_cuenta($cuenta, $consulta, $base){
        if($cuenta != ''){

            $query = $consulta->consultar_cuenta($cuenta);
            $resultado = $base->leer($query);

            if($resultado->num_rows>0){
                $cuenta = true;
            }else{
                $cuenta = false;
            }

            $resultado->free();
        }else{
            $cuenta = false;
        }

        return $cuenta;
    }


    
?>