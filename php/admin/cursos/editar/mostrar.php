<?php 
	
	require ('../../../base1.php');
    require ('../../../consulta.php');
    require ('../../../Consultas.php');

    $id = $_POST['id'];
    $consulta = new Consultas;
    $base = new ConexionBase;
    $conexion = $base->conectar();
    $query_datosGeneralesCurso = $consulta->leer_Curso($id); 
    $rest_datosGeneralesCurso = leerDatos($conexion, $query_datosGeneralesCurso); 

    foreach ($rest_datosGeneralesCurso as $datosCurso) {
        $datosGenerales = [
            'titulo' => $datosCurso['titulo'],
            'id_tActividad' => $datosCurso['id_tipo_actividad'],
            'desc' => $datosCurso['descripcion'],
            'pre' => $datosCurso['prerrequisitos'],
            'dirigido' => $datosCurso['dirigido'],
            'lugares' => $datosCurso['lugares'] 
        ];
    }

    $id_tActividad = $datosGenerales['id_tActividad'];


    $query_tActividad = $consulta->leer_tActividad_Curso($id_tActividad);
    
    $res_tActividad = leerDatos($conexion, $query_tActividad);

    foreach ($res_tActividad as $key ) {
        $tActividad = [
            'id' => $key['id'],
            'nombre' => $key ['nombre']
        ];
    }


    $query_req = $consulta->leer_requerimientos_curso($id);
    $res_req = leerDatos($conexion,$query_req);

    foreach ($res_req as $key ) {
        $req [] = [
            'id' => $key['id'],
            'nombre' => $key['nombre']
        ];
    }

    $query_mat = $consulta->leer_material_curso($id);
    #echo $query_mat;
    $res_mat = leerDatos($conexion,$query_mat);

    foreach ($res_mat as $key ) {
        $material [] = [
            'id' => $key['id'],
            'nombre' => $key['nombre'],
            'cantidad' => $key['cantidad']
        ];
    }

    

    
    
    

?>