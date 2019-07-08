<?php
	
	class Consultas{

		

		function buscarUsuario($inf){
			
			$busqueda = explode(" ", $inf);



			$query = "SELECT usuario.nCuenta, usuario.usuario, usuario.nombre, usuario.apellidoP, usuario.apellidoM, usuario.cuenta, area.nombre as carrera,  tipo_usuario.usuario as tipo_usuario  FROM usuario, area, tipo_usuario WHERE (usuario.id_area = area.id_area AND usuario.tipo_usuario = tipo_usuario.id_tipoUsuario) AND (";

			for($i=0; $i<sizeof($busqueda); $i++){
				


				$query .= "usuario.usuario 		LIKE 	'%$busqueda[$i]%'	OR 
						   usuario.nombre		LIKE	'%$busqueda[$i]%'	OR
						   usuario.apellidoP	LIKE	'%$busqueda[$i]%'	OR
						   usuario.apellidoM	LIKE	'%$busqueda[$i]%'	OR
						   usuario.correo 		LIKE 	'%$busqueda[$i]%' 	OR 
						   usuario.ncuenta 		LIKE 	'%$busqueda[$i]%'	";

				if($i != sizeof($busqueda)-1){
					$query .= ")AND(";
				}

				if($i == sizeof($busqueda)-1){
					$query .= ")";
				}
			}

			

			return  $query;

		}

		function buscarCurso($curso){
			$busqueda = explode(" ", $curso);
			$query = "SELECT id_curso, titulo FROM curso WHERE (";

			for($i=0; $i<sizeof($busqueda); $i++){	

					$query .= "titulo 		LIKE 	'%$busqueda[$i]%'	OR 
							   descripcion	LIKE	'%$busqueda[$i]%'	OR
							   id_curso		LIKE	'%$busqueda[$i]%'	";

					if($i != sizeof($busqueda)-1){
						$query .= ")AND(";
					}

					if($i == sizeof($busqueda)-1){
						$query .= ")";
					}
				}

				return $query;
		}


		function disponibilidadCurso($curso){
			return $query = "SELECT  COUNT(curso_usuario_insc.id_curso) AS inscritos, curso.lugares  FROM curso_usuario_insc, curso WHERE curso_usuario_insc.id_curso = '$curso' AND curso.id_curso = curso_usuario_insc.id_curso";
		}

		function comprobarInscrito($usuario, $curso){


			$query = "SELECT * FROM curso_usuario_insc WHERE curso_usuario_insc.nCuenta = (SELECT nCuenta FROM usuario WHERE usuario = '$usuario') AND curso_usuario_insc.id_curso = '$curso';";
			
			return $query;

		}

		function horarioCursosImpartidos($usuario){
			return $query = "SELECT horario.fecha, horario.hora_inicio, horario.hora_final FROM horario, curso_usuario_org, usuario, curso WHERE curso_usuario_org.nCuenta = (SELECT nCuenta FROM usuario WHERE usuario = '$usuario') AND usuario.nCuenta = curso_usuario_org.nCuenta AND horario.id_curso = curso.id_curso AND curso_usuario_org.id_curso = curso.id_curso";
		}

		function horarioCursosResponsable($usuario){
			return $query = "SELECT horario.fecha, horario.hora_inicio, horario.hora_final FROM horario, curso_usuario_resp, usuario, curso WHERE curso_usuario_resp.nCuenta = (SELECT nCuenta FROM usuario WHERE usuario = '$usuario') AND usuario.nCuenta = curso_usuario_resp.nCuenta AND horario.id_curso = curso.id_curso AND curso_usuario_resp.id_curso = curso.id_curso";
		}



		function horarioOcupadosInscritos($usuario){
			return $query = "SELECT horario.fecha, horario.hora_inicio, horario.hora_final FROM horario, curso_usuario_insc, usuario, curso WHERE curso_usuario_insc.nCuenta = (SELECT nCuenta FROM usuario WHERE usuario = '$usuario') AND usuario.nCuenta = curso_usuario_insc.nCuenta AND horario.id_curso = curso.id_curso AND curso_usuario_insc.id_curso = curso.id_curso";
		}


		function horarioCurso($id_curso){
			return $query = "SELECT horario.fecha, horario.hora_inicio, horario.hora_final FROM horario, curso WHERE curso.id_curso = '$id_curso' AND  horario.id_curso = curso.id_curso";
		}

		

		function lugares($id_curso){
			return $query = "SELECT IF( (SELECT  COUNT(id_curso) AS inscritos FROM curso_usuario_insc WHERE curso_usuario_insc.id_curso = '$id_curso') < ( SELECT lugares  FROM curso WHERE id_curso = '$id_curso') , 1, 0) AS cupo FROM curso WHERE id_curso = '$id_curso'; ";
		}


		function insertarUsuarioCurso($curso, $usuario){
			return $query = "INSERT INTO curso_usuario_insc (nCuenta, id_curso) VALUES ( (SELECT nCuenta FROM usuario WHERE usuario = '$usuario') , '$curso');";
		}

		function buscarHorarioCurso($usuario, $curso){
			return $query = "SELECT horario.fecha, horario.hora_inicio, horario.hora_final 
			FROM horario, curso_usuario_insc, usuario, curso WHERE curso.id_curso = curso_usuario_insc.id_curso  AND usuario.nCuenta = curso_usuario_insc.nCuenta 
			AND usuario.nCuenta = (SELECT nCuenta FROM usuario WHERE usuario = '$usuario') AND curso_usuario_insc.id_curso = '$curso' 
			AND horario.id_curso = curso.id_curso ORDER BY DATE(horario.fecha);";

		}


		function buscarAsistenciaUsuario($usuario,$curso){
			return $query = "SELECT id_asistencia, hora_e, hora_s, fecha_e, fecha_s, check_in, check_out FROM asistencia WHERE id_usuario = (SELECT nCuenta FROM usuario WHERE usuario = '$usuario' ) AND id_curso = '$curso'; ";
		}


		function actualizarAsistenciaUsuario($id, $entrada, $salida){
			return $query = "UPDATE asistencia SET check_in = $entrada, check_out = $salida WHERE id_asistencia = '$id'";
		}


		function eliminarRegistroAsistencia($id){
			return $query = "DELETE FROM asistencia where id_asistencia = '$id'"; 
		}

		function insertarRegistroAsistencia($id, $fecha, $hora_e, $id_usuario, $id_curso, $entrada, $salida){
			return $query = "INSERT INTO asistencia (id_asistencia, fecha_e, fecha_s, hora_e, hora_s, id_usuario, id_curso, check_in, check_out) VALUES ('$id', '$fecha', '$fecha', '$hora_e', '$hora_e', (SELECT ncuenta FROM usuario WHERE usuario = '$id_usuario'), '$id_curso', $entrada, $salida)";
		}


		function buscar_RegistroAsistencia($txt){
			$busqueda = explode(" ", $txt);

			
			$query = "SELECT DISTINCT usuario.usuario, usuario.nombre, usuario.apellidoP, usuario.apellidoM, usuario.nCuenta, curso.id_curso, curso.titulo FROM curso, usuario, asistencia WHERE  asistencia.id_usuario = usuario.nCuenta AND asistencia.id_curso = curso. id_curso AND (";

			for($i=0; $i<sizeof($busqueda); $i++){
				


				$query .= "usuario.usuario 		LIKE 	'%$busqueda[$i]%'	OR 
						   usuario.nombre		LIKE	'%$busqueda[$i]%'	OR
						   usuario.apellidoP	LIKE	'%$busqueda[$i]%'	OR
						   usuario.apellidoM	LIKE	'%$busqueda[$i]%'	OR						   
						   usuario.ncuenta 		LIKE 	'%$busqueda[$i]%'	OR
						   curso.titulo			LIKE	'%$busqueda[$i]%'	";

				if($i != sizeof($busqueda)-1){
					$query .= ")AND(";
				}

				if($i == sizeof($busqueda)-1){
					$query .= ")  ORDER BY usuario.apellidoP ASC";
				}
			}

			return $query;
		}


		function porcentajeAsistencia(){
			return $query = "SELECT porcentaje_asistencia,universidad, campus, tipo_documento,slogan, nombre_director, evento, director FROM conf WHERE id ='conf_alumnos'";
		}


		function leer_ConstanciasProfesor(){
			return $query = "SELECT usuario.nCuenta, usuario.nombre, usuario.apellidoP, usuario.apellidoM, curso.titulo, curso.id_curso, usuario.usuario FROM curso, usuario, curso_usuario_org WHERE curso_usuario_org.id_curso = curso.id_curso AND curso_usuario_org.nCuenta = usuario.nCuenta";
		}



		function mostrar_elementoUsuario(){
			return $query = "SELECT usuario.nCuenta, usuario.nombre, usuario.apellidoP, usuario.apellidoM, usuario.usuario, tipo_usuario.usuario , area.nombre, usuario.cuenta FROM usuario, tipo_usuario, AREA WHERE usuario.tipo_usuario = tipo_usuario.id_tipoUsuario AND usuario.id_area = area.id_area order by usuario.apellidoP;";
			//return return $query = "SELECT usuario.nCuenta, usuario.nombre, usuario.apellidoP, usuario.apellidoM, usuario.usuario, tipo_usuario.usuario , area.nombre, usuario.cuenta FROM usuario, tipo_usuario, AREA WHERE usuario.tipo_usuario = tipo_usuario.id_tipoUsuario AND usuario.id_area = area.id_area order by usuario.apellidoP;";
		}

		function select_tipoUsuario(){
			return $query = "SELECT * FROM tipo_usuario ORDER BY usuario ASC";
		}


		function select_usuario_carrera(){
			return $query = "SELECT id_area, nombre FROM area ORDER  BY nombre ASC";
		}


		function consultar_correo($correo){
			return $query = "SELECT * FROM usuario WHERE correo = '$correo'; ";
		}

		function consultar_usuario($usuario){
			return $query = "SELECT * FROM usuario WHERE usuario = '$usuario'; ";
		}

		function consultar_cuenta($cuenta){
			return $query = "SELECT * FROM usuario WHERE cuenta = '$cuenta'; ";
		}

		
		function insertar_usuario($nCuenta, $nombre,$apellidoP,$apellidoM,$correo, $usuario,$pass,$telefono,$tipoUser, $area,$id){
			return $query = "INSERT INTO usuario (nCuenta, id_area, cuenta, nombre, apellidoP, apellidoM, correo, usuario, pass, tipo_usuario, telefono) VALUES ('$id', $area, '$nCuenta', '$nombre', '$apellidoP', '$apellidoM', '$correo', '$usuario', '$pass', $tipoUser, '$telefono') ";
		}

		function eliminar_usuario($id){
			return $query = "DELETE FROM usuario WHERE nCuenta = '$id'";
		}

		function leer_usuario($id){
			return $query = "SELECT usuario.nCuenta, AREA.nombre AS area, usuario.cuenta, usuario.nombre, usuario.apellidoP, usuario.apellidoM, usuario.correo, usuario.pass, usuario.telefono, tipo_usuario.usuario AS tipo_usuario, usuario.usuario FROM usuario, AREA, tipo_usuario WHERE nCuenta = '$id' AND usuario.id_area = AREA.id_area AND tipo_usuario.id_tipoUsuario = usuario.tipo_usuario;";
		}

		function actualizar_usuario($cuenta, $nombre, $apellidoP, $apellidoM, $correo, $usuario, $pass, $telefono, $tipoUser, $area,  $id){

			return "UPDATE usuario SET usuario = '$usuario', cuenta = '$cuenta', nombre = '$nombre', apellidoP = '$apellidoP', apellidoM = '$apellidoM', correo = '$correo', pass = '$pass', telefono = '$telefono', tipo_usuario = $tipoUser, id_area = $area WHERE nCuenta = '$id'";
		}

		

		

	}



?>

