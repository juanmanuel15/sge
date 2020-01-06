<?php
	session_start();

    if(!isset($_SESSION['admin'])){
        header('Location: ../../../admin/admin.php' );
    }

		require("../../../Consultas.php");
		require("../../../base1.php");

		$conexion = new ConexionBase();
		$bd = new Consultas();

		$nU = $_POST['nU'];
		$nD = $_POST['nD'];
		$nC = $_POST['nC'];
		$tR = $_POST['tR'];
		$tE = $_POST['tE'];
		$FI = $_POST['FI'];
		$FF = $_POST['FF'];
		$lE = $_POST['lE'];
		$lU = $_POST['lU'];
		$p = $_POST['p'];

		$fecha_inicial = explode("-", $FI);
		$fecha_final = explode("-", $FF);

		$ano_inicial = (int)$fecha_inicial[0];
		$ano_final = (int)$fecha_final[0];
		$mes_inicial = (int)$fecha_inicial[1];
		$mes_final = (int)$fecha_final[1];
		$dia_inicial = (int)$fecha_inicial[2];
		$dia_final = (int)$fecha_final[2];

		if(!isset($nU, $nC, $tR, $tE, $FF, $FI, $lE, $lU,$p, $nD)){
			$servidor = false;
			$lleno = false;
			$conn = false;
			$success = false;
		}else{
			$servidor = true;

			if(empty($nU) || empty($nC) || !tipoDocumento($tR) || empty($tE) || empty($lE) || empty($lU) || empty($p) || !verificarFechas($dia_inicial, $dia_final, $ano_inicial, $ano_final, $mes_inicial, $mes_final)){

				$lleno = false;
				$conn = false;
				$success = false;
			}else{
				$lleno = true;

				if(!$conexion->conectar()){
					$conn = false;
					$success = false;
				}else{
					$conn = true;

					if($tR == 'const'){
						$tR = "Constancia";
					}elseif ($tR == 'rec') {
						$tR = "Reconocimiento";
					}

					$query = $bd->actualizar_configurarConstancia($nU, $nC, $tR, $tE,$FF, $FI, $lE, $lU,$p, $nD);

					if(!$conexion->actualizar($query)){
						$success = false;
					}
					else{
						$success = true;
					}
				}
			}
		}


		$respuesta = [
			'servidor' => $servidor,
			'lleno' => $lleno,
			'conn' => $conn,
			'success' => $success
		];

		echo json_encode($respuesta);



		function verificarFechas($dia1, $dia2, $mes1, $mes2, $ano1, $ano2){
			if($dia2>$dia1 && $ano2 >= $ano1 && $mes2>= $mes1){
				return true;
			}else{
				return false;
			}
		}

		function tipoDocumento($documento){
			if($documento == 'const' || $documento == 'rec'){
				return true;
			}else{
				return false;
			}
			
		}
			

?>