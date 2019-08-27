<?php

    require ('../../../base1.php');
    require ('../../../Consultas.php');   
    header("Content-Type: text/html;charset=utf-8");

    session_start();

    if(!isset($_SESSION['admin'])){
        header('Location: ../../../../admin/admin.php' );
    }


    $base = new ConexionBase();
    $consulta = new Consultas();


    $conexion = $base->conectar();


    if($conexion != false){
        $conn = false;

        $query = $consulta->select_tipoDocumento();
        $resultado = $base->leer($query);

        while($row = $resultado->fetch_array()){
            $evento []= [
                'evento' => $row[1],
                'tipo_documento' => $row[0]
            ];
        }

        $resultado->free();

        $query = $consulta->select_tipoActividad();
        $resultado = $base->leer($query);

        while($row = $resultado->fetch_array()){
            $tActividad []= [
                'tActividad' =>$row[0]
            ];
        }


        $resultado->free();



        $query = $consulta->select_cursos();
        $resultado = $base->leer($query);

        while($row = $resultado->fetch_array()){
            $tituloCurso []= [
                'tituloCurso' => $row[0]
            ];
        }


        $resultado->free();




    }else{
        $conn = true;
        $resp = false;

    }



    $respuesta = [
       'conn' => $conn,
       'resp' => [
           'evento' => $evento,
           'tituloCurso' => $tituloCurso,
           'tActividad' => $tActividad
           ]
    ];



    echo json_encode($respuesta);

?>