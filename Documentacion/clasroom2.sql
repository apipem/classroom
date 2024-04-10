-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 10-04-2024 a las 17:16:42
-- Versión del servidor: 5.7.33
-- Versión de PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `clasroom`
--
CREATE DATABASE IF NOT EXISTS `clasroom` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `clasroom`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_assignment`
--

DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `auth_assignment_user_id_idx` (`user_id`)
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
CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`)
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
CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
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
CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
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
CREATE TABLE IF NOT EXISTS `contenido` (
  `idcontenido` int(11) NOT NULL AUTO_INCREMENT,
  `contenido` text NOT NULL,
  `descripcion` text NOT NULL,
  `materia` int(11) NOT NULL,
  `proyecto` int(11) NOT NULL,
  PRIMARY KEY (`idcontenido`),
  KEY `fk_contenido_materia1_idx` (`materia`),
  KEY `fk_contenido_Proyecto1_idx` (`proyecto`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Truncar tablas antes de insertar `contenido`
--

TRUNCATE TABLE `contenido`;
--
-- Volcado de datos para la tabla `contenido`
--

INSERT INTO `contenido` (`idcontenido`, `contenido`, `descripcion`, `materia`, `proyecto`) VALUES
(9, 'recurso/1-b.jpg', 'a', 22, 20),
(10, 'recurso/2-b.jpg', 'a', 22, 20),
(11, 'recurso/3-b.jpg', 'a', 22, 20),
(12, 'recurso/2-b.jpg', '2', 23, 20),
(13, 'recurso/3-b.jpg', '2', 23, 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

DROP TABLE IF EXISTS `curso`;
CREATE TABLE IF NOT EXISTS `curso` (
  `idcurso` int(11) NOT NULL AUTO_INCREMENT,
  `estudiante` int(11) NOT NULL,
  `materia` int(11) NOT NULL,
  `profesor` int(11) NOT NULL,
  `nota` double DEFAULT NULL,
  `notificacion` tinyint(4) DEFAULT NULL,
  `notas` int(11) NOT NULL,
  PRIMARY KEY (`idcurso`),
  KEY `fk_curso_usuario1_idx` (`estudiante`),
  KEY `fk_curso_materia1_idx` (`materia`),
  KEY `fk_curso_usuario2_idx` (`profesor`),
  KEY `fk_curso_notas1_idx` (`notas`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

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
(19, 33, 22, 20, 3, NULL, 19),
(21, 29, 22, 20, 0, NULL, 21),
(22, 36, 22, 35, 0, NULL, 23),
(23, 36, 23, 35, 0, NULL, 24),
(24, 37, 22, 35, 0, NULL, 25),
(25, 37, 23, 35, 0, NULL, 26);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia`
--

DROP TABLE IF EXISTS `materia`;
CREATE TABLE IF NOT EXISTS `materia` (
  `idmateria` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `codigo` varchar(45) DEFAULT NULL,
  `vcorte1` varchar(45) DEFAULT NULL,
  `vcorte2` varchar(45) DEFAULT NULL,
  `vcorte3` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idmateria`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

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
(22, 'pg1', 'BSFG25', '0', '50', '50'),
(23, 'materia1', 'SHBCA50 ', '20', '20', '60');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas`
--

DROP TABLE IF EXISTS `notas`;
CREATE TABLE IF NOT EXISTS `notas` (
  `idnotas` int(11) NOT NULL AUTO_INCREMENT,
  `corte1` double DEFAULT NULL,
  `corte2` double DEFAULT NULL,
  `corte3` double DEFAULT NULL,
  `proyecto` int(11) NOT NULL,
  PRIMARY KEY (`idnotas`),
  KEY `fk_notas_Proyecto1_idx` (`proyecto`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Truncar tablas antes de insertar `notas`
--

TRUNCATE TABLE `notas`;
--
-- Volcado de datos para la tabla `notas`
--

INSERT INTO `notas` (`idnotas`, `corte1`, `corte2`, `corte3`, `proyecto`) VALUES
(11, 0, 0, 0, 8),
(12, 4, 4, 3, 19),
(13, 0, 0, 0, 8),
(14, 0, 0, 0, 8),
(15, 0, 0, 0, 19),
(16, 0, 0, 0, 19),
(19, 3, 3, 3, 8),
(20, 3.5, 2.8, 2, 8),
(21, 0, 0, 0, 8),
(22, 0, 0, 0, 8),
(23, 0, 0, 0, 20),
(24, 0, 0, 0, 20),
(25, 0, 0, 0, 20),
(26, 0, 0, 0, 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto`
--

DROP TABLE IF EXISTS `proyecto`;
CREATE TABLE IF NOT EXISTS `proyecto` (
  `idProyecto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `descripcion` text NOT NULL,
  `fechaIncio` date NOT NULL,
  `fechaFin` date NOT NULL,
  PRIMARY KEY (`idProyecto`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

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
(19, 'ClassRoom', 'Proyecto interno', '2024-04-01', '2024-04-02'),
(20, 'pnuevo', 'pnuevo pnuevo', '2024-04-09', '2024-04-11'),
(21, 'Semilleros', 'proyectop interno', '2024-04-10', '2024-04-10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `cc` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `correo` text NOT NULL,
  `contrasena` text NOT NULL,
  `rol` enum('estudiante','profesor') NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

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
(30, 1052415816, 'a', 'v', '2', '$2y$13$S8XjAg6CIq10mbXP9gL3jun1gXD/NPar1GDAr1qvAZmZyKnmLQ60G', 'profesor', 1),
(32, 5050, 'Ana maria', 'Perez', 'qd@gmail.com', '$2y$13$tE5GVg2iFBXXbVGgXeEqDeS9H/MWKUpCGUayFLxW7Jicr2LmoSVGa', 'profesor', 1),
(33, 369, 'Diana', 'Mendez', 'dm@gmail.com', '$2y$13$CmBjMvqoFestogr9hqJJ7Ojda7uT15p5n1oSrbYJu6AyqnH/UmzDq', 'estudiante', 1),
(34, 1007358160, 'jonnathan ruiz ', 'rara', 'aeras1232@gmailcom', '$2y$13$UX88pw3bh1CJVSlsxsC7eODab5D./AZczL/T.4SWwQraaq0i2bpQe', 'profesor', 1),
(35, 100, 'Profe', 'Profe', 'Profe', '$2y$13$Lc5WOB.e.cVGxop1DWT.N.6Fkgm/vgb6WLEpjWuUbRR.b404hOFgm', 'profesor', 1),
(36, 101, '101', '101', '101', '$2y$13$TnwQzvtYHJaBtFs5PD9nu.WlBeBmZU3hT1JJx2Rdy0ncHu65sVOKG', 'estudiante', 1),
(37, 102, '102', '102', '102', '$2y$13$PdeZ7f61qKq1fW1lEkaV7ud50iMBlelWmnmqsiScQESxM/07dAWIC', 'estudiante', 1);

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
