<?php 

    session_start();

    if(!isset($_SESSION['admin'])){
        header('Location: ../../../admin/admin.php' );
    }
	
	require ('../../base.php');
    require ('../../consulta.php');

    //header('Content-Type: application/json');
    header("Content-Type: text/html;charset=utf-8");
    
    $conexion = abrirConexion();

     $query = "SELECT usuario.nCuenta, usuario.nombre, usuario.apellidoP, usuario.apellidoM, usuario.usuario, tipo_usuario.usuario FROM usuario, tipo_usuario WHERE usuario.tipo_usuario = tipo_usuario.id_tipoUsuario order by usuario.apellidoP;";

   $resultado = leerDatos($conexion, $query);
    

    $user = [];
    while($row = $resultado->fetch_array()){
        
        $user []  = [
            'numeroCuenta' => $row[0],
            'nombreCompleto' => $row[2]. " " . $row[3] . " " . $row[1], 
            'usuario' => $row[4],
            'tipo_usuario' => $row[5]
        ];
    }

    
    //print_r($user);
    
    echo json_encode($user);
    //echo json_encode($user);
?>