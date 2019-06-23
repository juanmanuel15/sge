<?php 
	
	require ('../../base.php');
    require ('../../consulta.php');

    //header('Content-Type: application/json');
    header("Content-Type: text/html;charset=utf-8");
    
    $conexion = abrirConexion();

    $query = "SELECT usuario.nCuenta, usuario.nombre, usuario.apellidoP, usuario.apellidoM, usuario.usuario,  curso.titulo, curso.id_curso, usuario.usuario FROM curso_usuario_insc, curso, usuario WHERE curso.id_curso = curso_usuario_insc.id_curso AND usuario.nCuenta = curso_usuario_insc.nCuenta";

   $resultado = leerDatos($conexion, $query);
    

    $user = [];
    while($row = $resultado->fetch_array()){
        
        $user []  = [
            'numeroCuenta' => $row[0],
            'nombreCompleto' => $row[1]. " " . $row[2] . " " . $row[3], 
            'usuario' => $row[4],
            'titulo' => $row[5],
            'curso' => $row[6],
            'usuario' => $row[7] 
        ];
    }

    
    

    echo json_encode($user);
?>