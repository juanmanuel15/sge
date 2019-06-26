<?php 
	
	include ('../../Buscar.php');
	include ('../../Consultas.php');
	include ('../../ComprobarMetodo.php');
	include ('../../base1.php');
	include ('../../consulta.php');

	header("Content-Type: text/html;charset=utf-8");


	$cadena = new Buscar();
	$metodo = new ComprobarMetodo();
	$consulta = new Consultas();
	$base = new ConexionBase();

	$txt = $_POST['txt'];

	$definido = $metodo->Post($txt);

	if($definido){
		$respuesta = ['servidor' => true];
	}else {

		if($txt == ''){

			$respuesta = ['servidor' => false ,
						'vacio' => true, 'disp' => false];

		}else {

			$buscar = $cadena->quitarCaracteres($txt);
			
			$base->conectar();

			$query = $consulta->buscarCurso($buscar);
			
			$resultado = $base->leer($query);

			$cursos = [];

			foreach ($resultado as $curso ) {
				
				$cursos [] = [
					'id' => $curso['id_curso'],
					'titulo' => $curso['titulo']
				];
			}

			$resultado->free();

			if(sizeof($cursos)>0){

				for($i = 0; $i< sizeof($cursos); $i++){
					$id_curso = $cursos[$i]['id'];
					$titulo = $cursos[$i]['titulo'];

					$query = $consulta->disponibilidadCurso($id_curso);
					$resultado = $base->leer($query);


					while($row = $resultado->fetch_array()){
						$disp [] = [
							'id' => $id_curso,
							'titulo' => $titulo,
							'inscritos' => $row[0],
							'lugares' => $row[1]
						];
					}


					$resultado->free();
				}
			}else {
				$disp = false;
			}






			$respuesta = [
				'servidor' => false,
				'vacio' => false,
				'cursos' => $disp
			];
		}
		
	}
	

	echo json_encode($respuesta);

	

?>