<?php 
    
    session_start();

    if(!isset($_SESSION['admin'])){
        header('Location: ../../../admin/admin.php' );
    }
    require ('../../base.php');
    require ('../../consulta.php');
    header('Content-Type: application/json');
    
    $conexion = abrirConexion();

    $query = "SELECT * FROM hora ORDER BY TIME(hora)";

    $resultado = leerDatos($conexion, $query);
    

    $hora = [];
    while($row = $resultado->fetch_array()){
        
        $hora []  = [
            'id' => $row[0],
            'hora' => $row[1]
        ];
    }

    

    echo json_encode($hora);

?>