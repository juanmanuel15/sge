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

-- Volcando datos para la tabla sam.curso: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `curso` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla sam.curso_usuario_insc: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `curso_usuario_insc` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=130 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla sam.curso_usuario_org: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `curso_usuario_org` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla sam.curso_usuario_resp: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `curso_usuario_resp` DISABLE KEYS */;
/*!40000 ALTER TABLE `curso_usuario_resp` ENABLE KEYS */;

-- Volcando estructura para tabla sam.fecha
CREATE TABLE IF NOT EXISTS `fecha` (
  `id_fecha` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla sam.fecha: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `fecha` DISABLE KEYS */;
INSERT INTO `fecha` (`id_fecha`, `fecha`) VALUES
	(7, '2019-03-18'),
	(8, '2019-03-19'),
	(9, '2019-03-20'),
	(10, '2019-03-21'),
	(11, '2019-03-22');
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla sam.hora: ~7 rows (aproximadamente)
/*!40000 ALTER TABLE `hora` DISABLE KEYS */;
INSERT INTO `hora` (`id_hora`, `hora`) VALUES
	(1, '07:00:00'),
	(2, '08:00:00'),
	(3, '09:00:00'),
	(4, '11:00:00'),
	(5, '13:00:00'),
	(6, '08:30:00'),
	(7, '10:30:00');
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
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla sam.horario: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `horario` DISABLE KEYS */;
/*!40000 ALTER TABLE `horario` ENABLE KEYS */;

-- Volcando estructura para tabla sam.lugar
CREATE TABLE IF NOT EXISTS `lugar` (
  `id_lugar` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_lugar` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `lugares` int(11) NOT NULL,
  PRIMARY KEY (`id_lugar`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla sam.lugar: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `lugar` DISABLE KEYS */;
INSERT INTO `lugar` (`id_lugar`, `nombre_lugar`, `lugares`) VALUES
	(1, 'Sala de computo 1', 25),
	(2, 'Sala de computo 2', 25),
	(3, 'Sala de computo 3', 25),
	(4, 'Sala de computo 4', 25),
	(5, 'Sala de computo 5', 25),
	(6, 'Auditorio', 120);
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
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla sam.material: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `material` DISABLE KEYS */;
/*!40000 ALTER TABLE `material` ENABLE KEYS */;

-- Volcando estructura para tabla sam.requerimientos
CREATE TABLE IF NOT EXISTS `requerimientos` (
  `id_req` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_req` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_req`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla sam.requerimientos: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `requerimientos` DISABLE KEYS */;
INSERT INTO `requerimientos` (`id_req`, `nombre_req`) VALUES
	(1, 'Computadora'),
	(3, 'Equipo de audio'),
	(4, 'Presente institucional'),
	(5, 'Mesas'),
	(8, 'CaÃ±on'),
	(9, 'Agua');
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
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla sam.req_curso: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `req_curso` DISABLE KEYS */;
/*!40000 ALTER TABLE `req_curso` ENABLE KEYS */;

-- Volcando estructura para tabla sam.tipo_actividad
CREATE TABLE IF NOT EXISTS `tipo_actividad` (
  `id_tipo_actividad` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_tipo_actividad` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_tipo_actividad`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla sam.tipo_actividad: ~10 rows (aproximadamente)
/*!40000 ALTER TABLE `tipo_actividad` DISABLE KEYS */;
INSERT INTO `tipo_actividad` (`id_tipo_actividad`, `nombre_tipo_actividad`) VALUES
	(1, 'Taller'),
	(2, 'Conferencia'),
	(3, 'Ponencia'),
	(8, 'Feria'),
	(9, 'Campamento'),
	(10, 'Kermes'),
	(11, 'Curso'),
	(12, 'Torneo'),
	(13, 'Concurso'),
	(14, 'Rally');
/*!40000 ALTER TABLE `tipo_actividad` ENABLE KEYS */;

-- Volcando estructura para tabla sam.tipo_usuario
CREATE TABLE IF NOT EXISTS `tipo_usuario` (
  `id_tipoUsuario` int(1) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  PRIMARY KEY (`id_tipoUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla sam.tipo_usuario: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `tipo_usuario` DISABLE KEYS */;
INSERT INTO `tipo_usuario` (`id_tipoUsuario`, `usuario`) VALUES
	(1, 'Administrador'),
	(2, 'Profesor'),
	(3, 'Alumno');
/*!40000 ALTER TABLE `tipo_usuario` ENABLE KEYS */;

-- Volcando estructura para tabla sam.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `nCuenta` varchar(20) NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `apellidoP` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `apellidoM` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `usuario` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `pass` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `tipo_usuario` int(1) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  PRIMARY KEY (`nCuenta`),
  UNIQUE KEY `correo` (`correo`),
  UNIQUE KEY `usuario` (`usuario`),
  KEY `FK_usuario_tipo_usuario` (`tipo_usuario`),
  CONSTRAINT `FK_usuario_tipo_usuario` FOREIGN KEY (`tipo_usuario`) REFERENCES `tipo_usuario` (`id_tipoUsuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla sam.usuario: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`nCuenta`, `nombre`, `apellidoP`, `apellidoM`, `correo`, `usuario`, `pass`, `tipo_usuario`, `telefono`) VALUES
	('1730709', 'Alejandro', 'Islas ', 'Moreno', 'alejandroMoreno151@gmail.com', 'aim8585', '1234', 1, '57157933'),
	('17307111', 'Juan Manuel', 'HernÃ¡ndez', 'Contreras', 'juanmanuelhern158@outlook.com', 'jmhc1508', 'juan.manuel', 1, '5571438433'),
	('1830710', 'Oscar Alejandro', 'Delgadillo', 'Martinez', 'oscar_alejandro@gmail.com', 'oscar16', '1234', 2, '57157932'),
	('1830711', 'Ivan', 'Mireles', 'Lucas', 'lucasiki@hotmail.com', 'lucas15', '1515', 2, '57157932');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
