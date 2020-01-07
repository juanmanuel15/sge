<?php

	require('../../base1.php');
	require('../../Consultas.php');

	if(!$_SERVER['REQUEST_METHOD'] == 'POST'){
        $servidor = true;
     }else {
     	$servidor = false;
     	$consulta = new Consultas();
     	$base = new ConexionBase();
     	
     	$conexion = $base->conectar();
     	if($conexion != false){
     		$conn = false;
     		$query = $consulta->leer_configurarConstancia();
     		$resultado = $base->leer($query);

	     	foreach ($resultado as $rw) {
	     		$conf = [
	     			'FI' => $rw['fecha_inicial'],
	     			'FF' => $rw['fecha_final']
	     		];
	     	}

	     	$fechas = fechas_select($conf);

     	}else{
     		$conn = true;

     	}
     		


     	$respuesta = [
               'serv' => $servidor,
               'conn' => $conn,
               'success' => $fechas
          ];

          echo json_encode($respuesta);

     }


     function fechas_select($conf){

     	$FI = $conf['FI'];
     	$FF = $conf['FF'];

     	$FI = explode("-", $FI);
     	$FF = explode("-", $FF);

     	$anoFI = (int)$FI[0];
     	$anoFF = (int)$FF[0];

     	$mesFI = (int)$FI[1];
     	$mesFF = (int)$FF[1];

     	$diaFI = (int)$FI[2];
     	$diaFF = (int)$FF[2];


     	/*if($anoFF == $anoFI){*/
     		if($mesFI == $mesFF){
     			if($diaFF == $diaFI){
     				$fecha [] = "$anoFF-$mesFF-$diaFF";
     			}elseif ($diaFI > $diaFF) {
     				for($i = $diaFF; $i<= $diaFI; $i++){
     					$fecha [] = "$anoFF-$mesFF-$i";
     				}
     			}else {
     				for($i = $diaFI; $i<= $diaFF; $i++){
     					$fecha [] = "$anoFF-$mesFF-$i";
     				}
     			}
     		}else{

     			if($mesFI > $mesFF){
     				for($i = $mesFF; $i<=$mesFI; $i++){
     					if($diaFF < $diaFI){
                                   for($j = $diaFF; $i <= 31; $i++){
                                        if($diaFF = 31){
                                             $diaFF = 1;
                                        }
                                        $fecha [] = "$anoFF-$i-$j";
                                   }
                              }else{
                                   for($j = $diaFI; $j <= $diaFF; $j++){
                                        $fecha [] = "$anoFF-$i-$j";
                                   }
                              }
     				}
     			}else{

                         for($i = $mesFI; $i<= $mesFF; $i++){
                              if($diaFF < $diaFI){
                                   for($j = $diaFF; $i <= 31; $i++){
                                        if($diaFF = 31){
                                             $diaFF = 1;
                                        }
                                        $fecha [] = "$anoFF-$i-$j";
                                   }
                              }else{
                                   for($j = $diaFI; $j <= $diaFF; $j++){
                                        $fecha [] = "$anoFF-$i-$j";
                                   }
                              }
                         }

     			}
     		}
     	


          return $fecha;


     }


?>