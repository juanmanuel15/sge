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
            'id' => $datosCurso['id_curso'],
            'titulo' => $datosCurso['titulo'],
            'id_tActividad' => $datosCurso['id_tipo_actividad'],
            'desc' => $datosCurso['descripcion'],
            'pre' => $datosCurso['prerrequisitos'],
            'dirigido' => $datosCurso['dirigido'],
            'lugares' => $datosCurso['lugares'],
            'tActividad'=>$datosCurso['tActividad'] 
        ];
    }


    $query_req = $consulta->leer_requerimientos_curso($id);
    $res_req = leerDatos($conexion,$query_req);

    foreach ($res_req as $key ) {
        $req[] = [
            'id' => $key['id'],
            'nombre' => $key['nombre']
        ];
    }

    $query_mat = $consulta->leer_material_curso($id);
    $res_mat = leerDatos($conexion,$query_mat);

    if($res_mat->num_rows>0){
        foreach ($res_mat as $key ) {
            $material[] = [
                'id' => $key['id'],
                'nombre' => $key['nombre'],
                'cantidad' => $key['cantidad']
            ];
        }
    }else{
        $material = '';
    }

    $query_horario = $consulta->leer_horario_curso($id);
    $res_horario = leerDatos($conexion,$query_horario);
    
    
    foreach ($res_horario as $key) {
        $horario[] = [
            'id' => $key['id_horario'],
            'fecha' => $key['fecha'],
            'HI' => $key['hora_inicio'],
            'HF' => $key['hora_final'],
            'idLugar' => $key['id_lugar'],
            'nombreLugar' => $key['nombre_lugar'],
            'espacios' => $key['lugares']
        ];
    }

    $query_profesor = $consulta->leer_profesor_curso($id);
    $res_profesor = leerDatos($conexion,$query_profesor);

    foreach ($res_profesor as $key) {
        $profesor[] = [
            'cuenta' => $key['nCuenta'],
            'nombre' => $key['nombre'],
            'apellidoP' => $key['apellidoP'],
            'apellidoM' => $key['apellidoM']
        ];
    }

    $query_resp = $consulta->leer_responsable_curso($id);
    $res_resp = leerDatos($conexion,$query_resp);

    foreach ($res_resp as $key) {
        $resp[] = [
            'cuenta' => $key['nCuenta'],
            'nombre' => $key['nombre'],
            'apellidoP' => $key['apellidoP'],
            'apellidoM' => $key['apellidoM']
        ];
    }

    //print_r($datosGenerales);


    $respuesta = [

        'datosGenerales' => $datosGenerales,
        'req' => $req,
        'material' => $material,
        'horario' => $horario,
        'resp' => $resp,
        'profesor' => $profesor       

    ];

    echo json_encode($respuesta);
    

?>