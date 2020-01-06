<?php
    

	require ('../../base.php');
    require ('../../consulta.php');

    $id = (int) $_POST['id'];

    $conexion = abrirConexion();

    $query = "SELECT * FROM fecha WHERE id_fecha = " .$id;

    $resultado = leerDatos($conexion, $query);
    
    $fecha = [];
    while($row = $resultado->fetch_array()){
        
        $fecha []  = [
            'id' => $row[0],
            'fecha' => $row[1]
        ];
    }
    echo json_encode($fecha);

    cerrarConexion($conexion);  

?>