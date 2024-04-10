-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 08-04-2024 a las 05:36:39
-- Versión del servidor: 5.7.33
-- Versión de PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_assignment`
--

DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Truncar tablas antes de insertar `auth_assignment`
--

TRUNCATE TABLE `auth_assignment`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Truncar tablas antes de insertar `auth_item`
--

TRUNCATE TABLE `auth_item`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_item_child`
--

DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Truncar tablas antes de insertar `auth_item_child`
--

TRUNCATE TABLE `auth_item_child`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_rule`
--

DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Truncar tablas antes de insertar `auth_rule`
--

TRUNCATE TABLE `auth_rule`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contenido`
--

DROP TABLE IF EXISTS `contenido`;
CREATE TABLE `contenido` (
  `idcontenido` int(11) NOT NULL,
  `contenido` text NOT NULL,
  `descripcion` text NOT NULL,
  `materia` int(11) NOT NULL,
  `proyecto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncar tablas antes de insertar `contenido`
--

TRUNCATE TABLE `contenido`;
--
-- Volcado de datos para la tabla `contenido`
--

INSERT INTO `contenido` (`idcontenido`, `contenido`, `descripcion`, `materia`, `proyecto`) VALUES
(1, 'recurso/pr.html', '1', 17, 19),
(3, 'recurso/1-b.jpg', '1', 22, 19),
(4, 'recurso/2-b.jpg', '2', 21, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

DROP TABLE IF EXISTS `curso`;
CREATE TABLE `curso` (
  `idcurso` int(11) NOT NULL,
  `estudiante` int(11) NOT NULL,
  `materia` int(11) NOT NULL,
  `profesor` int(11) NOT NULL,
  `nota` double DEFAULT NULL,
  `notificacion` tinyint(4) DEFAULT NULL,
  `notas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncar tablas antes de insertar `curso`
--

TRUNCATE TABLE `curso`;
--
-- Volcado de datos para la tabla `curso`
--

INSERT INTO `curso` (`idcurso`, `estudiante`, `materia`, `profesor`, `nota`, `notificacion`, `notas`) VALUES
(11, 29, 17, 20, 0, NULL, 11),
(13, 29, 21, 24, 0, NULL, 13),
(14, 29, 22, 24, 0, NULL, 14),
(15, 23, 20, 20, 0, NULL, 15),
(16, 23, 21, 24, 0, NULL, 16),
(17, 25, 20, 20, 0, NULL, 17),
(18, 25, 21, 24, 0, NULL, 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia`
--

DROP TABLE IF EXISTS `materia`;
CREATE TABLE `materia` (
  `idmateria` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `codigo` varchar(45) DEFAULT NULL,
  `vcorte1` varchar(45) DEFAULT NULL,
  `vcorte2` varchar(45) DEFAULT NULL,
  `vcorte3` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncar tablas antes de insertar `materia`
--

TRUNCATE TABLE `materia`;
--
-- Volcado de datos para la tabla `materia`
--

INSERT INTO `materia` (`idmateria`, `nombre`, `codigo`, `vcorte1`, `vcorte2`, `vcorte3`) VALUES
(17, 'Psicologia', 'ASCV56', '40', '40', '20'),
(20, 'ingles', 'AB369', '20', '20', '60'),
(21, 'Criminalistica', '258FSJ', '30', '30', '40'),
(22, 'pg1', 'BSFG25', '0', '50', '50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas`
--

DROP TABLE IF EXISTS `notas`;
CREATE TABLE `notas` (
  `idnotas` int(11) NOT NULL,
  `corte1` double DEFAULT NULL,
  `corte2` double DEFAULT NULL,
  `corte3` double DEFAULT NULL,
  `proyecto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncar tablas antes de insertar `notas`
--

TRUNCATE TABLE `notas`;
--
-- Volcado de datos para la tabla `notas`
--

INSERT INTO `notas` (`idnotas`, `corte1`, `corte2`, `corte3`, `proyecto`) VALUES
(11, 0, 0, 0, 19),
(12, 4, 4, 3, 19),
(13, 0, 0, 0, 19),
(14, 0, 0, 0, 19),
(15, 0, 0, 0, 19),
(16, 0, 0, 0, 19),
(17, 0, 0, 0, 17),
(18, 0, 0, 0, 17);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto`
--

DROP TABLE IF EXISTS `proyecto`;
CREATE TABLE `proyecto` (
  `idProyecto` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` text NOT NULL,
  `fechaIncio` date NOT NULL,
  `fechaFin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncar tablas antes de insertar `proyecto`
--

TRUNCATE TABLE `proyecto`;
--
-- Volcado de datos para la tabla `proyecto`
--

INSERT INTO `proyecto` (`idProyecto`, `nombre`, `descripcion`, `fechaIncio`, `fechaFin`) VALUES
(8, 'Proyecto3', 'Descripcion Proyecto3', '2024-03-05', '2024-03-05'),
(11, 'Sennova', 'Proyecto con convenio', '2024-02-02', '2024-02-20'),
(16, 'p1', 'p1', '2024-04-17', '2024-04-18'),
(17, 'p2', 'p2', '2024-04-08', '2024-04-09'),
(18, 'p3', 'p3', '2024-04-02', '2024-04-03'),
(19, 'ClassRoom', 'Proyecto interno', '2024-04-01', '2024-04-02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `cc` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `correo` text NOT NULL,
  `contrasena` text NOT NULL,
  `rol` enum('estudiante','profesor') NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncar tablas antes de insertar `usuario`
--

TRUNCATE TABLE `usuario`;
--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `cc`, `nombre`, `apellido`, `correo`, `contrasena`, `rol`, `estado`) VALUES
(2, 1052, 'andres', 'mayo', 'amayorga3@udi.edu.co', '$2y$10$waK2McV.wV99XJ53QA5gru.EFN53lreUL/YfrSsKDDJ6xnBVeWPia', 'estudiante', 1),
(20, 1, 'Luisa', 'Mendez', 'lm@g', '$2y$13$EVr.fOGex3buRWbmoKCoYeqkoapW/upex8Blk.Xt6V3TNsBGmbEKm', 'profesor', 1),
(21, 2, 'Estiven', 'Cigal', 'EC@g', '$2y$13$.lFHKo7BupgzM4/L9OP3kuM2BqbQdOvKILUWT/1Rozw/EO/dMOxq6', 'estudiante', 1),
(22, 3, 'Yadis', 'levil', 'yv@', '$2y$13$eMKwm0mWSSdxEkC6wNsaOOt3BkRnm0xvV0bjzPfKOe7KoAk8sod8.', 'estudiante', 1),
(23, 4, 'James', 'Gomez', 'jg@', '$2y$10$waK2McV.wV99XJ53QA5gru.EFN53lreUL/YfrSsKDDJ6xnBVeWPia', 'estudiante', 1),
(24, 5, 'Leila', 'Graciela', 'lg@', '$2y$13$e4E/kPwmSEGpwNuauSjw.uiG79tWEpLI0lSxmE49mkH7/OWZ3xymm', 'profesor', 1),
(25, 6, 'Camila', 'Vargas', 'cm@', '$2y$10$waK2McV.wV99XJ53QA5gru.EFN53lreUL/YfrSsKDDJ6xnBVeWPia', 'estudiante', 1),
(28, 11, 'once', 'once apellido', '11', '$2y$13$EbQVukEuyCDBZXWBRWdsteaq/JRStBx5DXR.KIkEnMHA.0WtwO07G', 'estudiante', 1),
(29, 20, 'Darwen', 'Zenmed', '20', '$2y$13$ErojvfLjNykZZpRAIkoo4eYfVUdYHxxOgdwG9wy.TtfD4cbRBEjwy', 'estudiante', 1),
(30, 1052415816, 'a', 'v', '2', '$2y$13$S8XjAg6CIq10mbXP9gL3jun1gXD/NPar1GDAr1qvAZmZyKnmLQ60G', 'profesor', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `auth_assignment_user_id_idx` (`user_id`);

--
-- Indices de la tabla `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indices de la tabla `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indices de la tabla `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indices de la tabla `contenido`
--
ALTER TABLE `contenido`
  ADD PRIMARY KEY (`idcontenido`),
  ADD KEY `fk_contenido_materia1_idx` (`materia`),
  ADD KEY `fk_contenido_Proyecto1_idx` (`proyecto`);

--
-- Indices de la tabla `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`idcurso`),
  ADD KEY `fk_curso_usuario1_idx` (`estudiante`),
  ADD KEY `fk_curso_materia1_idx` (`materia`),
  ADD KEY `fk_curso_usuario2_idx` (`profesor`),
  ADD KEY `fk_curso_notas1_idx` (`notas`);

--
-- Indices de la tabla `materia`
--
ALTER TABLE `materia`
  ADD PRIMARY KEY (`idmateria`);

--
-- Indices de la tabla `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`idnotas`),
  ADD KEY `fk_notas_Proyecto1_idx` (`proyecto`);

--
-- Indices de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD PRIMARY KEY (`idProyecto`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `contenido`
--
ALTER TABLE `contenido`
  MODIFY `idcontenido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `curso`
--
ALTER TABLE `curso`
  MODIFY `idcurso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `materia`
--
ALTER TABLE `materia`
  MODIFY `idmateria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `notas`
--
ALTER TABLE `notas`
  MODIFY `idnotas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  MODIFY `idProyecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `contenido`
--
ALTER TABLE `contenido`
  ADD CONSTRAINT `fk_contenido_Proyecto1` FOREIGN KEY (`proyecto`) REFERENCES `proyecto` (`idProyecto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_contenido_materia1` FOREIGN KEY (`materia`) REFERENCES `materia` (`idmateria`) ON DELETE CASCADE;

--
-- Filtros para la tabla `curso`
--
ALTER TABLE `curso`
  ADD CONSTRAINT `fk_curso_materia1` FOREIGN KEY (`materia`) REFERENCES `materia` (`idmateria`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_curso_notas1` FOREIGN KEY (`notas`) REFERENCES `notas` (`idnotas`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_curso_usuario1` FOREIGN KEY (`estudiante`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_curso_usuario2` FOREIGN KEY (`profesor`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `notas`
--
ALTER TABLE `notas`
  ADD CONSTRAINT `fk_notas_Proyecto1` FOREIGN KEY (`proyecto`) REFERENCES `proyecto` (`idProyecto`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
