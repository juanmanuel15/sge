<?php 
	
	require ('../../base.php');
    require ('../../consulta.php');

    //header('Content-Type: application/json');
    header("Content-Type: text/html;charset=utf-8");
    
    $conexion = abrirConexion();

     $query = "SELECT usuario.nCuenta, usuario.nombre, usuario.apellidoP, usuario.apellidoM, usuario.usuario, tipo_usuario.usuario
                FROM usuario, tipo_usuario
                WHERE usuario.tipo_usuario = tipo_usuario.id_tipoUsuario;";

   $resultado = leerDatos($conexion, $query);
    

    $user = [];
    while($row = $resultado->fetch_array()){
        
        $user []  = [
            'numeroCuenta' => $row[0],
            'nombreCompleto' => $row[1]. " " . $row[2] . " " . $row[3], 
            'usuario' => $row[4],
            'tipo_usuario' => $row[5]
        ];
    }

    
    

    echo json_encode($user);
?>