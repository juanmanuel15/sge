-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.1.37-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win32
-- HeidiSQL Versión:             10.1.0.5464
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para sam
CREATE DATABASE IF NOT EXISTS `sam` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `sam`;

-- Volcando estructura para tabla sam.asistencia
CREATE TABLE IF NOT EXISTS `asistencia` (
  `id_asistencia` varchar(50) NOT NULL,
  `fecha_e` date NOT NULL,
  `fecha_s` date DEFAULT NULL,
  `hora_e` time NOT NULL,
  `hora_s` time DEFAULT NULL,
  `id_usuario` varchar(20) CHARACTER SET utf8 NOT NULL,
  `id_curso` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `check_in` tinyint(1) NOT NULL DEFAULT '1',
  `check_out` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_asistencia`),
  KEY `FK_asistencia_usuario` (`id_usuario`),
  KEY `FK_asistencia_curso` (`id_curso`),
  CONSTRAINT `FK_asistencia_curso` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_asistencia_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`nCuenta`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla sam.asistencia: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `asistencia` DISABLE KEYS */;
INSERT INTO `asistencia` (`id_asistencia`, `fecha_e`, `fecha_s`, `hora_e`, `hora_s`, `id_usuario`, `id_curso`, `check_in`, `check_out`) VALUES
	('20190624&oscar1234&2406191035javapara', '2019-06-24', '2019-06-24', '11:01:14', '11:01:14', '173007', '2406191035javapara', 1, 1),
	('20190624&uriel&2406191032arduinop', '2019-06-24', '2019-06-24', '09:44:34', '09:44:34', '173006', '2406191032arduinop', 1, 1),
	('20190626&oscar1234&2406191035javapara', '2019-06-26', '2019-06-26', '11:03:15', '11:03:15', '173007', '2406191035javapara', 1, 1),
	('20190626&uriel&2406191032arduinop', '2019-06-26', '2019-06-26', '10:23:31', '10:23:31', '173006', '2406191032arduinop', 1, 1),
	('20190628&uriel&2406191032arduinop', '2019-06-28', '2019-06-28', '10:25:27', '10:25:27', '173006', '2406191032arduinop', 1, 1),
	('20190629&uriel&2406191032arduinop', '2019-06-29', '2019-06-29', '10:25:48', '10:25:48', '173006', '2406191032arduinop', 1, 1);
/*!40000 ALTER TABLE `asistencia` ENABLE KEYS */;

-- Volcando estructura para tabla sam.curso
CREATE TABLE IF NOT EXISTS `curso` (
  `id_curso` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `titulo` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `id_tipo_actividad` int(11) NOT NULL,
  `descripcion` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `prerrequisitos` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `dirigido` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `lugares` int(11) NOT NULL,
  PRIMARY KEY (`id_curso`),
  KEY `FK_curso_tipo_actividad` (`id_tipo_actividad`),
  CONSTRAINT `FK_curso_tipo_actividad` FOREIGN KEY (`id_tipo_actividad`) REFERENCES `tipo_actividad` (`id_tipo_actividad`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla sam.curso: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `curso` DISABLE KEYS */;
INSERT INTO `curso` (`id_curso`, `titulo`, `id_tipo_actividad`, `descripcion`, `prerrequisitos`, `dirigido`, `lugares`) VALUES
	('2406191032arduinop', 'Arduino para principiantes', 1, 'En este curso se desarrollaran los conceptos principales de Electrónica así como como de la tarjeta desarrollo Arduino.', 'Ninguno', 'A cualquier persona interesada en el tema.', 15),
	('2406191035javapara', 'Java para principiantes', 2, 'Se verán los principales conceptos de POO', 'Ninguno', 'A cualquier persona interesada en iniciar a programar POO', 12);
/*!40000 ALTER TABLE `curso` ENABLE KEYS */;

-- Volcando estructura para tabla sam.curso_usuario_insc
CREATE TABLE IF NOT EXISTS `curso_usuario_insc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nCuenta` varchar(20) NOT NULL,
  `id_curso` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_curso_usuario_insc_usuario` (`nCuenta`),
  KEY `FK_curso_usuario_insc_curso` (`id_curso`),
  CONSTRAINT `FK_curso_usuario_insc_curso` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_curso_usuario_insc_usuario` FOREIGN KEY (`nCuenta`) REFERENCES `usuario` (`nCuenta`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla sam.curso_usuario_insc: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `curso_usuario_insc` DISABLE KEYS */;
INSERT INTO `curso_usuario_insc` (`id`, `nCuenta`, `id_curso`) VALUES
	(1, '173006', '2406191032arduinop'),
	(2, '173007', '2406191035javapara');
/*!40000 ALTER TABLE `curso_usuario_insc` ENABLE KEYS */;

-- Volcando estructura para tabla sam.curso_usuario_org
CREATE TABLE IF NOT EXISTS `curso_usuario_org` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nCuenta` varchar(20) NOT NULL,
  `id_curso` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_curso_usuario_org_usuario` (`nCuenta`),
  KEY `FK_curso_usuario_org_curso` (`id_curso`),
  CONSTRAINT `FK_curso_usuario_org_curso` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_curso_usuario_org_usuario` FOREIGN KEY (`nCuenta`) REFERENCES `usuario` (`nCuenta`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla sam.curso_usuario_org: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `curso_usuario_org` DISABLE KEYS */;
INSERT INTO `curso_usuario_org` (`id`, `nCuenta`, `id_curso`) VALUES
	(1, '1730711', '2406191032arduinop'),
	(2, '1730710', '2406191032arduinop'),
	(3, '1730708', '2406191035javapara');
/*!40000 ALTER TABLE `curso_usuario_org` ENABLE KEYS */;

-- Volcando estructura para tabla sam.curso_usuario_resp
CREATE TABLE IF NOT EXISTS `curso_usuario_resp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nCuenta` varchar(20) NOT NULL,
  `id_curso` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_curso_usuario_resp_usuario` (`nCuenta`),
  KEY `FK_curso_usuario_resp_curso` (`id_curso`),
  CONSTRAINT `FK_curso_usuario_resp_curso` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_curso_usuario_resp_usuario` FOREIGN KEY (`nCuenta`) REFERENCES `usuario` (`nCuenta`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla sam.curso_usuario_resp: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `curso_usuario_resp` DISABLE KEYS */;
INSERT INTO `curso_usuario_resp` (`id`, `nCuenta`, `id_curso`) VALUES
	(1, '1530711', '2406191032arduinop'),
	(2, '1730709', '2406191035javapara');
/*!40000 ALTER TABLE `curso_usuario_resp` ENABLE KEYS */;

-- Volcando estructura para tabla sam.fecha
CREATE TABLE IF NOT EXISTS `fecha` (
  `id_fecha` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id_fecha`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla sam.fecha: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `fecha` DISABLE KEYS */;
INSERT INTO `fecha` (`id_fecha`, `fecha`) VALUES
	(1, '2019-05-28'),
	(2, '2019-05-27'),
	(3, '2019-05-29'),
	(4, '2019-05-30'),
	(5, '2019-05-31');
/*!40000 ALTER TABLE `fecha` ENABLE KEYS */;

-- Volcando estructura para tabla sam.grupo_invitado
CREATE TABLE IF NOT EXISTS `grupo_invitado` (
  `id_grupo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `id_curso` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_grupo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla sam.grupo_invitado: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `grupo_invitado` DISABLE KEYS */;
/*!40000 ALTER TABLE `grupo_invitado` ENABLE KEYS */;

-- Volcando estructura para tabla sam.hora
CREATE TABLE IF NOT EXISTS `hora` (
  `id_hora` int(11) NOT NULL AUTO_INCREMENT,
  `hora` time NOT NULL,
  PRIMARY KEY (`id_hora`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla sam.hora: ~29 rows (aproximadamente)
/*!40000 ALTER TABLE `hora` DISABLE KEYS */;
INSERT INTO `hora` (`id_hora`, `hora`) VALUES
	(8, '07:00:00'),
	(9, '07:30:00'),
	(10, '08:00:00'),
	(11, '08:30:00'),
	(12, '09:00:00'),
	(13, '09:30:00'),
	(14, '10:00:00'),
	(15, '10:30:00'),
	(16, '11:00:00'),
	(17, '11:30:00'),
	(18, '12:00:00'),
	(19, '12:30:00'),
	(20, '13:00:00'),
	(21, '13:30:00'),
	(22, '14:00:00'),
	(23, '14:30:00'),
	(24, '15:00:00'),
	(25, '15:30:00'),
	(26, '16:00:00'),
	(27, '16:30:00'),
	(28, '17:00:00'),
	(29, '17:30:00'),
	(30, '18:00:00'),
	(31, '18:30:00'),
	(32, '19:00:00'),
	(33, '19:30:00'),
	(34, '20:00:00'),
	(35, '20:30:00'),
	(36, '21:00:00');
/*!40000 ALTER TABLE `hora` ENABLE KEYS */;

-- Volcando estructura para tabla sam.horario
CREATE TABLE IF NOT EXISTS `horario` (
  `id_horario` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_final` time NOT NULL,
  `id_curso` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `id_lugar` int(11) NOT NULL,
  PRIMARY KEY (`id_horario`),
  KEY `FK_horario_curso` (`id_curso`),
  KEY `FK_horario_lugar` (`id_lugar`),
  CONSTRAINT `FK_horario_curso` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_horario_lugar` FOREIGN KEY (`id_lugar`) REFERENCES `lugar` (`id_lugar`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla sam.horario: ~10 rows (aproximadamente)
/*!40000 ALTER TABLE `horario` DISABLE KEYS */;
INSERT INTO `horario` (`id_horario`, `fecha`, `hora_inicio`, `hora_final`, `id_curso`, `id_lugar`) VALUES
	(1, '2019-05-27', '10:00:00', '14:00:00', '2406191032arduinop', 1),
	(2, '2019-05-28', '10:00:00', '14:00:00', '2406191032arduinop', 1),
	(3, '2019-05-29', '10:00:00', '14:00:00', '2406191032arduinop', 1),
	(4, '2019-05-30', '10:00:00', '14:00:00', '2406191032arduinop', 1),
	(5, '2019-05-31', '10:00:00', '14:00:00', '2406191032arduinop', 1),
	(6, '2019-05-27', '09:00:00', '11:00:00', '2406191035javapara', 2),
	(7, '2019-05-28', '09:00:00', '11:00:00', '2406191035javapara', 2),
	(8, '2019-05-29', '09:00:00', '11:00:00', '2406191035javapara', 2),
	(9, '2019-05-30', '09:00:00', '11:00:00', '2406191035javapara', 2),
	(10, '2019-05-31', '09:00:00', '11:00:00', '2406191035javapara', 2);
/*!40000 ALTER TABLE `horario` ENABLE KEYS */;

-- Volcando estructura para tabla sam.lugar
CREATE TABLE IF NOT EXISTS `lugar` (
  `id_lugar` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_lugar` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `lugares` int(11) NOT NULL,
  PRIMARY KEY (`id_lugar`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla sam.lugar: ~7 rows (aproximadamente)
/*!40000 ALTER TABLE `lugar` DISABLE KEYS */;
INSERT INTO `lugar` (`id_lugar`, `nombre_lugar`, `lugares`) VALUES
	(1, 'Sala de computo 1', 25),
	(2, 'Sala de computo 2', 25),
	(3, 'Sala de computo 3', 25),
	(4, 'Sala de computo 4', 25),
	(5, 'Sala de computo 5', 25),
	(6, 'Auditorio', 120),
	(7, 'Aula Magna', 60);
/*!40000 ALTER TABLE `lugar` ENABLE KEYS */;

-- Volcando estructura para tabla sam.material
CREATE TABLE IF NOT EXISTS `material` (
  `id_mat` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_material` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `cantidad` int(11) NOT NULL,
  `id_curso` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_mat`),
  KEY `FK_material_curso` (`id_curso`),
  CONSTRAINT `FK_material_curso` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla sam.material: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `material` DISABLE KEYS */;
/*!40000 ALTER TABLE `material` ENABLE KEYS */;

-- Volcando estructura para tabla sam.requerimientos
CREATE TABLE IF NOT EXISTS `requerimientos` (
  `id_req` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_req` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_req`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla sam.requerimientos: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `requerimientos` DISABLE KEYS */;
INSERT INTO `requerimientos` (`id_req`, `nombre_req`) VALUES
	(1, 'Computadora'),
	(2, 'Cañon');
/*!40000 ALTER TABLE `requerimientos` ENABLE KEYS */;

-- Volcando estructura para tabla sam.req_curso
CREATE TABLE IF NOT EXISTS `req_curso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_req` int(11) NOT NULL,
  `id_curso` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_req_curso_requerimientos` (`id_req`),
  KEY `FK_req_curso_curso` (`id_curso`),
  CONSTRAINT `FK_req_curso_curso` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_req_curso_requerimientos` FOREIGN KEY (`id_req`) REFERENCES `requerimientos` (`id_req`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla sam.req_curso: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `req_curso` DISABLE KEYS */;
INSERT INTO `req_curso` (`id`, `id_req`, `id_curso`) VALUES
	(1, 1, '2406191032arduinop'),
	(2, 2, '2406191032arduinop'),
	(3, 1, '2406191035javapara'),
	(4, 2, '2406191035javapara');
/*!40000 ALTER TABLE `req_curso` ENABLE KEYS */;

-- Volcando estructura para tabla sam.tipo_actividad
CREATE TABLE IF NOT EXISTS `tipo_actividad` (
  `id_tipo_actividad` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_tipo_actividad` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_tipo_actividad`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla sam.tipo_actividad: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `tipo_actividad` DISABLE KEYS */;
INSERT INTO `tipo_actividad` (`id_tipo_actividad`, `nombre_tipo_actividad`) VALUES
	(1, 'Curso'),
	(2, 'Taller');
/*!40000 ALTER TABLE `tipo_actividad` ENABLE KEYS */;

-- Volcando estructura para tabla sam.tipo_usuario
CREATE TABLE IF NOT EXISTS `tipo_usuario` (
  `id_tipoUsuario` int(1) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  PRIMARY KEY (`id_tipoUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla sam.tipo_usuario: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `tipo_usuario` DISABLE KEYS */;
INSERT INTO `tipo_usuario` (`id_tipoUsuario`, `usuario`) VALUES
	(0, 'Colaborador'),
	(1, 'Administrador'),
	(2, 'Profesor'),
	(3, 'Alumno');
/*!40000 ALTER TABLE `tipo_usuario` ENABLE KEYS */;

-- Volcando estructura para tabla sam.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `nCuenta` varchar(20) CHARACTER SET utf8 NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `apellidoP` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `apellidoM` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `usuario` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `pass` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `tipo_usuario` int(1) NOT NULL,
  `telefono` varchar(15) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`nCuenta`),
  UNIQUE KEY `correo` (`correo`),
  UNIQUE KEY `usuario` (`usuario`),
  KEY `FK_usuario_tipo_usuario` (`tipo_usuario`),
  CONSTRAINT `FK_usuario_tipo_usuario` FOREIGN KEY (`tipo_usuario`) REFERENCES `tipo_usuario` (`id_tipoUsuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla sam.usuario: ~7 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`nCuenta`, `nombre`, `apellidoP`, `apellidoM`, `correo`, `usuario`, `pass`, `tipo_usuario`, `telefono`) VALUES
	('1530711', 'Karina de Jesús', 'Torres', 'Cruz', 'karina.torres.cruz97@hotmail.com', 'karis', 'karis', 3, '5571438433'),
	('173006', 'Uriel Martín', 'Ramírez', 'Martínez', 'uriel.puma@hotmail.com', 'uriel', 'uriel', 3, '5571438433'),
	('173007', 'Oscar Alejandro', 'Delgadillo', 'Martí­nez', 'oscar_alejandro@gmail.com', 'oscar1234', 'oscar1234', 3, '5571438433'),
	('1730708', 'Iván', 'Mireles', 'Lucas', 'lucasiki@hotmail.com', 'lucas', 'lucas', 2, '5571438433'),
	('1730709', 'Alejandro', 'Islas', 'Moreno', 'islas.moreno@gmail.com', 'islas', 'islas', 3, '5571438433'),
	('1730710', 'Alejandro Andrés', 'Serapio', 'Carmona', 'andreserapio@hotmail.com', 'andres', 'andres', 2, '5571438433'),
	('1730711', 'Juan Manuel', 'Hernández', 'Contreras', 'juanmanuelhc15@gmail.com', 'jmhc1508', 'juan.manuel', 1, '5571438433');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
