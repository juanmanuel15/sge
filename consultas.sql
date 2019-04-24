SELECT curso.id_curso, curso.titulo FROM curso;


SELECT usuario.nCuenta, usuario.nombre, usuario.apellidoP, usuario.apellidoM
FROM curso_usuario_org, curso, usuario
WHERE curso_usuario_org.id_curso = curso.id_curso AND curso.id_curso = '1004195sdsa5df4s' AND usuario.nCuenta = curso_usuario_org.nCuenta; 

SELECT horario.hora_inicio, horario.hora_final, horario.fecha, lugar.nombre_lugar FROM horario, lugar, curso WHERE horario.id_lugar = lugar.id_lugar AND curso.id_curso = horario.id_curso AND curso.id_curso = '1004195sdsa5df4s';


SELECT usuario.nCuenta, usuario.nombre, usuario.apellidoP, usuario.apellidoM FROM curso_usuario_org, curso, usuario WHERE curso_usuario_org.id_curso = curso.id_curso AND curso.id_curso = '1004195sdsa5df4s' AND usuario.nCuenta = curso_usuario_org.nCuenta