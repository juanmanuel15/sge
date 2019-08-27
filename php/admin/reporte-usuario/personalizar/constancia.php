<?php

    include('../Constancias/Constancia.php');
    include('../comprobacion.php');

    session_start();
    if(!isset($_SESSION['admin'])){
        header('Location: ../../../../admin/admin.php' );
    }


    $constancia = new Constancia();
    if(isset($_GET['alumno'], $_GET['fechaCurso'], $_GET['lugar'], $_GET['fechaGeneracion'], $_GET['slogan'], $_GET['director'], $_GET['director'], $_GET['tActividad'], $_GET['nombreCurso'], $_GET['tituloEvento'])){

        


        $alumno= $_GET['alumno']; 
        $fechaCurso = $_GET['fechaCurso']; 
        $lugar = $_GET['lugar']; 
        $fechaGeneracion = $_GET['fechaGeneracion']; 
        $slogan= $_GET['slogan']; 
        $director = $_GET['director']; 
        $tActividad= $_GET['tActividad']; 
        $tipo_documento= $_GET['tipoDocumento']; 
        $nombreCurso= $_GET['nombreCurso']; 
        $tituloEvento = $_GET['tituloEvento'];




        $datos = [
            //'universidad' => $universidad,
            //'campus' => $campus,
            'alumno' => $alumno,
            'fechaCurso' => $fechaCurso,
            'lugar' => $lugar,
            'fechaGeneracion' => $fechaGeneracion,
            'slogan' => $slogan,
            'director' => $director,
            'tActividad' => $tActividad,
            'tipoDocumento' => $tipo_documento,
            'nombreCurso' => $nombreCurso,
            'tituloEvento' => $tituloEvento
        ];


        $constancia->personalizar($datos);




    }else {

        echo "false";

    }




?>