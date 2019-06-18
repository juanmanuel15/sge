-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-06-2019 a las 17:32:57
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sam`
--
CREATE DATABASE IF NOT EXISTS `sam` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `sam`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area`
--
-- Creación: 14-06-2019 a las 21:12:15
--

CREATE TABLE `area` (
  `id_area` varchar(20) NOT NULL,
  `nombre_area` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELACIONES PARA LA TABLA `area`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--
-- Creación: 14-06-2019 a las 21:10:54
--

CREATE TABLE `curso` (
  `id_curso` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `id_area` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `titulo` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `id_tipo_actividad` int(11) NOT NULL,
  `descripcion` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `prerrequisitos` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `dirigido` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `lugares` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `curso`:
--   `id_tipo_actividad`
--       `tipo_actividad` -> `id_tipo_actividad`
--

--
-- Volcado de datos para la tabla `curso`
--

INSERT INTO `curso` (`id_curso`, `id_area`, `titulo`, `id_tipo_actividad`, `descripcion`, `prerrequisitos`, `dirigido`, `lugares`) VALUES
('220319javap', '', 'Java para principiantes', 11, 'En este curso se verÃ¡n los conceptos bÃ¡sicos de Java', 'Ninguno', 'A cualquier persona interesada en el Ã¡rea de java', 45),
('2905190238android', '', 'Android: ProgramaciÃ³n bÃ¡sica', 1, 'En este curso aprenderÃ¡s a realizar tus primeras aplicaciones mÃ³viles', 'Ninguno', 'A cualquier estudiante Interesado en programar', 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso_usuario_insc`
--
-- Creación: 12-06-2019 a las 16:58:01
--

CREATE TABLE `curso_usuario_insc` (
  `id` int(11) NOT NULL,
  `nCuenta` varchar(20) NOT NULL,
  `id_curso` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `asistencia_entrada` smallint(6) NOT NULL,
  `asistencia_salida` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `curso_usuario_insc`:
--   `id_curso`
--       `curso` -> `id_curso`
--   `nCuenta`
--       `usuario` -> `nCuenta`
--

--
-- Volcado de datos para la tabla `curso_usuario_insc`
--

INSERT INTO `curso_usuario_insc` (`id`, `nCuenta`, `id_curso`, `asistencia_entrada`, `asistencia_salida`) VALUES
(24, '1730709', '220319javap', 0, 0),
(30, '17307111', '220319javap', 0, 0),
(31, '123462', '220319javap', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso_usuario_org`
--
-- Creación: 14-06-2019 a las 21:13:05
--

CREATE TABLE `curso_usuario_org` (
  `id` int(11) NOT NULL,
  `nCuenta` varchar(20) NOT NULL,
  `id_area` varchar(20) NOT NULL,
  `id_curso` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `asistencia` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `curso_usuario_org`:
--   `id_curso`
--       `curso` -> `id_curso`
--   `nCuenta`
--       `usuario` -> `nCuenta`
--

--
-- Volcado de datos para la tabla `curso_usuario_org`
--

INSERT INTO `curso_usuario_org` (`id`, `nCuenta`, `id_area`, `id_curso`, `asistencia`) VALUES
(112, '1830700', '', '220319javap', 0),
(117, '17307111', '', '2905190238android', 0),
(118, '1830700', '', '2905190238android', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso_usuario_resp`
--
-- Creación: 29-05-2019 a las 16:19:12
--

CREATE TABLE `curso_usuario_resp` (
  `id` int(11) NOT NULL,
  `nCuenta` varchar(20) NOT NULL,
  `id_curso` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `curso_usuario_resp`:
--   `id_curso`
--       `curso` -> `id_curso`
--   `nCuenta`
--       `usuario` -> `nCuenta`
--

--
-- Volcado de datos para la tabla `curso_usuario_resp`
--

INSERT INTO `curso_usuario_resp` (`id`, `nCuenta`, `id_curso`) VALUES
(80, '1730709', '220319javap'),
(83, '123462', '2905190238android');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fecha`
--
-- Creación: 29-05-2019 a las 16:19:12
--

CREATE TABLE `fecha` (
  `id_fecha` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `fecha`:
--

--
-- Volcado de datos para la tabla `fecha`
--

INSERT INTO `fecha` (`id_fecha`, `fecha`) VALUES
(1, '2019-05-28'),
(2, '2019-05-27'),
(3, '2019-05-29'),
(4, '2019-05-30'),
(5, '2019-05-31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_invitado`
--
-- Creación: 29-05-2019 a las 16:19:12
--

CREATE TABLE `grupo_invitado` (
  `id_grupo` int(11) NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `id_curso` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `grupo_invitado`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hora`
--
-- Creación: 29-05-2019 a las 16:19:12
--

CREATE TABLE `hora` (
  `id_hora` int(11) NOT NULL,
  `hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `hora`:
--

--
-- Volcado de datos para la tabla `hora`
--

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--
-- Creación: 29-05-2019 a las 16:19:12
--

CREATE TABLE `horario` (
  `id_horario` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_final` time NOT NULL,
  `id_curso` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `id_lugar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `horario`:
--   `id_curso`
--       `curso` -> `id_curso`
--   `id_lugar`
--       `lugar` -> `id_lugar`
--

--
-- Volcado de datos para la tabla `horario`
--

INSERT INTO `horario` (`id_horario`, `fecha`, `hora_inicio`, `hora_final`, `id_curso`, `id_lugar`) VALUES
(84, '2019-05-28', '07:00:00', '09:00:00', '220319javap', 1),
(85, '2019-05-29', '07:00:00', '09:00:00', '220319javap', 1),
(93, '2019-05-27', '09:00:00', '11:00:00', '2905190238android', 8),
(94, '2019-05-27', '07:00:00', '11:00:00', '2905190238android', 8),
(95, '2019-05-29', '09:00:00', '11:00:00', '2905190238android', 8),
(96, '2019-05-30', '09:00:00', '11:00:00', '2905190238android', 8),
(97, '2019-05-31', '09:00:00', '11:00:00', '2905190238android', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lugar`
--
-- Creación: 29-05-2019 a las 16:19:12
--

CREATE TABLE `lugar` (
  `id_lugar` int(11) NOT NULL,
  `nombre_lugar` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `lugares` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `lugar`:
--

--
-- Volcado de datos para la tabla `lugar`
--

INSERT INTO `lugar` (`id_lugar`, `nombre_lugar`, `lugares`) VALUES
(1, 'Sala de computo 1', 25),
(2, 'Sala de computo 2', 25),
(3, 'Sala de computo 3', 25),
(4, 'Sala de computo 4', 25),
(5, 'Sala de computo 5', 25),
(6, 'Auditorio', 120),
(7, 'Aula Magna', 60),
(8, 'Sala de Redes', 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `material`
--
-- Creación: 29-05-2019 a las 16:19:12
--

CREATE TABLE `material` (
  `id_mat` int(11) NOT NULL,
  `nombre_material` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `cantidad` int(11) NOT NULL,
  `id_curso` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `material`:
--   `id_curso`
--       `curso` -> `id_curso`
--

--
-- Volcado de datos para la tabla `material`
--

INSERT INTO `material` (`id_mat`, `nombre_material`, `cantidad`, `id_curso`) VALUES
(72, 'led', 10, '220319javap');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `requerimientos`
--
-- Creación: 29-05-2019 a las 16:19:12
--

CREATE TABLE `requerimientos` (
  `id_req` int(11) NOT NULL,
  `nombre_req` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `requerimientos`:
--

--
-- Volcado de datos para la tabla `requerimientos`
--

INSERT INTO `requerimientos` (`id_req`, `nombre_req`) VALUES
(3, 'Equipo de audio'),
(4, 'Presente institucional'),
(5, 'Mesas'),
(8, 'CaÃ±Ã³n'),
(9, 'Agua'),
(10, 'Computadora');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `req_curso`
--
-- Creación: 29-05-2019 a las 16:19:12
--

CREATE TABLE `req_curso` (
  `id` int(11) NOT NULL,
  `id_req` int(11) NOT NULL,
  `id_curso` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `req_curso`:
--   `id_curso`
--       `curso` -> `id_curso`
--   `id_req`
--       `requerimientos` -> `id_req`
--

--
-- Volcado de datos para la tabla `req_curso`
--

INSERT INTO `req_curso` (`id`, `id_req`, `id_curso`) VALUES
(69, 8, '220319javap'),
(70, 8, '2905190238android'),
(71, 10, '2905190238android');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_actividad`
--
-- Creación: 29-05-2019 a las 16:19:12
--

CREATE TABLE `tipo_actividad` (
  `id_tipo_actividad` int(11) NOT NULL,
  `nombre_tipo_actividad` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `tipo_actividad`:
--

--
-- Volcado de datos para la tabla `tipo_actividad`
--

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--
-- Creación: 29-05-2019 a las 16:19:12
--

CREATE TABLE `tipo_usuario` (
  `id_tipoUsuario` int(1) NOT NULL,
  `usuario` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `tipo_usuario`:
--

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id_tipoUsuario`, `usuario`) VALUES
(0, 'Colaborador'),
(1, 'Administrador'),
(2, 'Profesor'),
(3, 'Alumno');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--
-- Creación: 29-05-2019 a las 16:19:12
--

CREATE TABLE `usuario` (
  `nCuenta` varchar(20) NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `apellidoP` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `apellidoM` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `usuario` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `pass` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `tipo_usuario` int(1) NOT NULL,
  `telefono` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `usuario`:
--   `tipo_usuario`
--       `tipo_usuario` -> `id_tipoUsuario`
--

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`nCuenta`, `nombre`, `apellidoP`, `apellidoM`, `correo`, `usuario`, `pass`, `tipo_usuario`, `telefono`) VALUES
('123462', 'Karina de JesÃºs ', 'Torres ', 'Cruz', 'karina.torres.cruz97@hotmail.com', 'karis', 'juanito', 1, '12345697'),
('1730709', 'Alejandro', 'Islas', 'Moreno', 'alejandroMoreno151@gmail.com', 'aim8585', '1234', 2, '57157933'),
('17307111', 'Juan Manuel', 'HernÃ¡ndez', 'Contreras', 'juanmanuelhern158@outlook.com', 'jmhc1508', 'juan.manuel', 1, '5571438433'),
('1830678', 'IvÃ¡n ', 'Mireles', 'Lucas', 'lucas@gmail.com', 'lucas1234', 'lucas1234', 1, '5571438433'),
('1830700', 'Oscar Alejandro', 'Delgadillo', 'MartÃ­nez', 'oscar_alejandro@gmail.com', 'oscar16', '1234', 3, '57157932');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id_area`);

--
-- Indices de la tabla `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id_curso`),
  ADD KEY `FK_curso_tipo_actividad` (`id_tipo_actividad`);

--
-- Indices de la tabla `curso_usuario_insc`
--
ALTER TABLE `curso_usuario_insc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_curso_usuario_insc_usuario` (`nCuenta`),
  ADD KEY `FK_curso_usuario_insc_curso` (`id_curso`);

--
-- Indices de la tabla `curso_usuario_org`
--
ALTER TABLE `curso_usuario_org`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_curso_usuario_org_usuario` (`nCuenta`),
  ADD KEY `FK_curso_usuario_org_curso` (`id_curso`);

--
-- Indices de la tabla `curso_usuario_resp`
--
ALTER TABLE `curso_usuario_resp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_curso_usuario_resp_usuario` (`nCuenta`),
  ADD KEY `FK_curso_usuario_resp_curso` (`id_curso`);

--
-- Indices de la tabla `fecha`
--
ALTER TABLE `fecha`
  ADD PRIMARY KEY (`id_fecha`);

--
-- Indices de la tabla `grupo_invitado`
--
ALTER TABLE `grupo_invitado`
  ADD PRIMARY KEY (`id_grupo`);

--
-- Indices de la tabla `hora`
--
ALTER TABLE `hora`
  ADD PRIMARY KEY (`id_hora`);

--
-- Indices de la tabla `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`id_horario`),
  ADD KEY `FK_horario_curso` (`id_curso`),
  ADD KEY `FK_horario_lugar` (`id_lugar`);

--
-- Indices de la tabla `lugar`
--
ALTER TABLE `lugar`
  ADD PRIMARY KEY (`id_lugar`);

--
-- Indices de la tabla `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`id_mat`),
  ADD KEY `FK_material_curso` (`id_curso`);

--
-- Indices de la tabla `requerimientos`
--
ALTER TABLE `requerimientos`
  ADD PRIMARY KEY (`id_req`);

--
-- Indices de la tabla `req_curso`
--
ALTER TABLE `req_curso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_req_curso_requerimientos` (`id_req`),
  ADD KEY `FK_req_curso_curso` (`id_curso`);

--
-- Indices de la tabla `tipo_actividad`
--
ALTER TABLE `tipo_actividad`
  ADD PRIMARY KEY (`id_tipo_actividad`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`id_tipoUsuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`nCuenta`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD KEY `FK_usuario_tipo_usuario` (`tipo_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `curso_usuario_insc`
--
ALTER TABLE `curso_usuario_insc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `curso_usuario_org`
--
ALTER TABLE `curso_usuario_org`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT de la tabla `curso_usuario_resp`
--
ALTER TABLE `curso_usuario_resp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT de la tabla `fecha`
--
ALTER TABLE `fecha`
  MODIFY `id_fecha` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `grupo_invitado`
--
ALTER TABLE `grupo_invitado`
  MODIFY `id_grupo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `hora`
--
ALTER TABLE `hora`
  MODIFY `id_hora` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `horario`
--
ALTER TABLE `horario`
  MODIFY `id_horario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT de la tabla `lugar`
--
ALTER TABLE `lugar`
  MODIFY `id_lugar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `material`
--
ALTER TABLE `material`
  MODIFY `id_mat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT de la tabla `requerimientos`
--
ALTER TABLE `requerimientos`
  MODIFY `id_req` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `req_curso`
--
ALTER TABLE `req_curso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT de la tabla `tipo_actividad`
--
ALTER TABLE `tipo_actividad`
  MODIFY `id_tipo_actividad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `curso`
--
ALTER TABLE `curso`
  ADD CONSTRAINT `FK_curso_tipo_actividad` FOREIGN KEY (`id_tipo_actividad`) REFERENCES `tipo_actividad` (`id_tipo_actividad`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `curso_usuario_insc`
--
ALTER TABLE `curso_usuario_insc`
  ADD CONSTRAINT `FK_curso_usuario_insc_curso` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_curso_usuario_insc_usuario` FOREIGN KEY (`nCuenta`) REFERENCES `usuario` (`nCuenta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `curso_usuario_org`
--
ALTER TABLE `curso_usuario_org`
  ADD CONSTRAINT `FK_curso_usuario_org_curso` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_curso_usuario_org_usuario` FOREIGN KEY (`nCuenta`) REFERENCES `usuario` (`nCuenta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `curso_usuario_resp`
--
ALTER TABLE `curso_usuario_resp`
  ADD CONSTRAINT `FK_curso_usuario_resp_curso` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_curso_usuario_resp_usuario` FOREIGN KEY (`nCuenta`) REFERENCES `usuario` (`nCuenta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `horario`
--
ALTER TABLE `horario`
  ADD CONSTRAINT `FK_horario_curso` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_horario_lugar` FOREIGN KEY (`id_lugar`) REFERENCES `lugar` (`id_lugar`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `material`
--
ALTER TABLE `material`
  ADD CONSTRAINT `FK_material_curso` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `req_curso`
--
ALTER TABLE `req_curso`
  ADD CONSTRAINT `FK_req_curso_curso` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_req_curso_requerimientos` FOREIGN KEY (`id_req`) REFERENCES `requerimientos` (`id_req`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `FK_usuario_tipo_usuario` FOREIGN KEY (`tipo_usuario`) REFERENCES `tipo_usuario` (`id_tipoUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
