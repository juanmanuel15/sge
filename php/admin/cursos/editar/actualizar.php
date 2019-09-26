<?php

    require ('../../../base1.php');
    require ('../../../consulta.php');
    require ('../../../Consultas.php');

    $titulo = $_POST['titulo'];
    $descripcion= $_POST['descripcion'];
    $requisitos= $_POST['requisitos'];
    $tActividad = $_POST['tActividad'];
    $profesor = $_POST['profesor'];
    $responsable = $_POST['responsable'];
    $dirigido = $_POST['dirigido']; 
    $profesor = $_POST['profesor'];
    $responsable = $_POST['responsable'];
    $fecha= $_POST['fecha'];
    $horaI = $_POST['horaI'];
    $horaF= $_POST['horaF'];
    $lugar = $_POST['lugar'];
    $req = $_POST['req'];
    $material = $_POST['material'];
    $cantidadMaterial = $_POST['cantidadMaterial'];
    $cantidad = $_POST['cantidad'];
    $radioMaterial = $_POST['radioMaterial'];
    $id = $_POST['id_curso'];

    $id_tActividad = $tActividad[0];

    $base = new ConexionBase();
    $consulta = new Consultas();

    $conexion = $base->conectar();
    
    $query_curso = $consulta->actualizar_curso($id, $titulo, $id_tActividad, $descripcion, $requisitos, $dirigido, $cantidad);
    $respuesta_curso = $base->actualizar($query_curso);
    
    $query_horario = $consulta->actualizar_horario($id);    
    $respuesta_horario_eliminar = $base->eliminar($query_horario);

    $query_horario_insertar = $consulta->agregarHorario($fecha, $horaI, $horaF, $lugar, $id);
    $respuesta_horario_insertar = $base->insertar($query_horario_insertar);

    $query_prof_eliminar = $consulta->actualizar_prof($id);
    $respuesta_prof = $base->eliminar($query_prof_eliminar);
   
    
    $query_prof_insertar = $consulta->agregar_prof($id, $profesor);
    $respuesta_prof = $base->insertar($query_horario_insertar);

    $query_prof_eliminar = $consulta->actualizar_resp($id);
    $respuesta_resp = $base->eliminar($query_prof_eliminar);
   
    
    $query_resp_insertar = $consulta->agregar_resp($id, $resp);
    $respuesta_resp = $base->insertar($query_resp_insertar);


    
    
?>