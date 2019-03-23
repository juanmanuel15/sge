<?php 
    require ('../../base.php');
    require ('../../consulta.php');

    //header('Content-Type: application/json');
    header("Content-Type: text/html;charset=utf-8");
    
    $conexion = abrirConexion();

     $query = "SELECT * FROM tipo_actividad";

   $resultado = leerDatos($conexion, $query);
    

    $act = [];
    while($row = $resultado->fetch_array()){
        
        $act []  = [
            'id' => $row[0],
            'nombre_act' => $row[1]
        ];
    }

    
    

    echo json_encode($act);

?>