<?php

require ('../../base.php');
require ('../../consulta.php');
header("Content-Type: text/html;charset=utf-8");

$conexion = abrirConexion();

$query = "SELECT curso.id_curso, curso.titulo, usuario.nombre, usuario.apellidoP, usuario.apellidoM
          FROM curso, usuario, curso_usuario_org
          WHERE curso.id_curso = curso_usuario_org.id_curso AND usuario.nCuenta = curso_usuario_org.nCuenta ORDER BY curso.id_curso";


$resultado = $conexion->query($query);

$var = [];
    while($row = $resultado->fetch_array()){
        
        $var [] = [
            'id' => $row[0],
            'titulo' =>  $row[1],
            'nombre' => $row[2]. " " . $row[3] . " " . $row[4]            
        ];
    }
    
    $resultado = array_diff($var[0], $var[1]);


    

    /*for ($i=0; $i <count($var) ; $i++) { 

        if($i == 0){
            $resultado [] = $var[$i];
        }else {
            $resultado[] = array_intersect($var[$i], $var[$i-1]);
        }
    }*/
   

    //$resultado = array_intersect($var[0], $var[1]);
    
    print_r($resultado);

/*for($i = 0; $i < count($var); $i++){

}*/
//$row= $respuesta->fetch_assoc();
//foreach($respuesta as $key){
    //echo count($respuesta->fecth_assoc());
/*for($i = 0; $i<count($respuesta); i++){
    echo "<pre>";

    //print_r($key);

    $resultado = array_diff($respuesta[$i], $respuesta[$i+1]);
    
    /*$titulo [] = $key['titulo'];
    $fecha [] = $key['fecha'];
    $hora_inicio [] = $key['hora_inicio'];
    $hora_final [] = $key['hora_final'];
    $nombre_lugar [] = $key['nombre_lugar'];
    $nombreCompleto [] = $key['nombre'] . " " . $key['apellidoP'] . " " . $key['apellidoM'];*/

    //echo "</pre>";
//}

    /*if(count($titulo) > count(array_unique($titulo))){
        $titulo = array_unique($titulo);
    }
    if(count($nombreCompleto)> count(array_unique($nombreCompleto))){
        $nombreCompleto = array_unique($titulo);
    }

    */
    /*$respuesta = [
        'titulo' => $titulo,
        'fecha' => $fecha,
        'hora_inicio' => $hora_inicio

    ];*/







/*cerrarConexion($conexion);

echo  json_encode($respuesta);*/


?>