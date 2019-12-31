<?php
    session_start();

    if(!isset($_SESSION['admin'])){
        header('Location: ../../../admin/admin.php' );
    }

    include ('../../../Buscar.php');
    include ('../../../Consultas.php');
    include ('../../../base1.php');

    header("Content-Type: text/html;charset=utf-8");
    $base = new ConexionBase();
    $consulta = new Consultas();

    if(isset($_POST['id'])){
        $id = $_POST['id'];
        if($id != ''){
            $conn = $base->conectar();
            if($conn != false){
                $query = $consulta->eliminarRegistroAsistencia($id);
                $respuesta = $base->eliminar($query);

                if($respuesta == true){
                    $success = true;
                }else {
                    $success = false;
                }
            }

            $servidor = false;
            $vacio = false;
            $conn = false;
        }
    }else{
        $servidor = true;
        $vacio = true;
        $conn = true;
        $success = false;
    }



    $respuesta = [
        'servidor' => $servidor,
        'vacio' => $vacio,
        'conn' => $conn,
        'success' => $success
    ];

    echo json_encode($respuesta);


?>