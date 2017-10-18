-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-12-2016 a las 12:00:48
-- Versión del servidor: 5.7.9
-- Versión de PHP: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gde`
--
CREATE DATABASE IF NOT EXISTS `gde` DEFAULT CHARACTER SET latin1 COLLATE latin1_spanish_ci;
USE `gde`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menus`
--

DROP TABLE IF EXISTS `menus`;
CREATE TABLE IF NOT EXISTS `menus` (
  `id_Opcion` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `texto` varchar(40) COLLATE latin1_spanish_ci NOT NULL,
  `url` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `id_Padre` int(11) UNSIGNED NOT NULL,
  `orden` int(4) NOT NULL,
  PRIMARY KEY (`id_Opcion`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `menus`
--

INSERT INTO `menus` (`id_Opcion`, `texto`, `url`, `id_Padre`, `orden`) VALUES
(1, 'Usuarios', 'app.php?c=Usuarios', 0, 10),
(2, 'Menus', 'app.php?c=Menus', 0, 20),
(3, 'Permisos', 'app.php?c=Permisos', 0, 30),
(4, 'Roles', 'app.php?c=Roles', 0, 40),
(5, 'Administracion', 'app.php?c=Administracion', 0, 50);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisorol`
--

DROP TABLE IF EXISTS `permisorol`;
CREATE TABLE IF NOT EXISTS `permisorol` (
  `id_Permiso` int(11) NOT NULL,
  `id_Rol` int(11) NOT NULL,
  PRIMARY KEY (`id_Permiso`,`id_Rol`),
  KEY `id_Rol` (`id_Rol`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `permisorol`
--

INSERT INTO `permisorol` (`id_Permiso`, `id_Rol`) VALUES
(1, 15),
(2, 15),
(3, 15),
(4, 15),
(5, 15),
(6, 15),
(7, 15),
(8, 15),
(9, 15),
(10, 15),
(11, 15),
(12, 15),
(13, 15),
(14, 15),
(15, 15),
(16, 15),
(17, 15),
(18, 15),
(19, 15),
(20, 15),
(21, 15),
(22, 15),
(23, 15),
(24, 15),
(25, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

DROP TABLE IF EXISTS `permisos`;
CREATE TABLE IF NOT EXISTS `permisos` (
  `id_Permiso` int(11) NOT NULL AUTO_INCREMENT,
  `id_Opcion` int(11) NOT NULL,
  `num_Permiso` int(2) NOT NULL,
  `permiso` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_Permiso`),
  KEY `id_Opcion` (`id_Opcion`)
) ENGINE=MyISAM AUTO_INCREMENT=192 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id_Permiso`, `id_Opcion`, `num_Permiso`, `permiso`) VALUES
(1, 1, 1, 'Consultar Usuarios'),
(2, 1, 2, 'Insertar Usuarios'),
(3, 1, 3, 'Modificar Usuarios'),
(4, 1, 4, 'Eliminar Usuarios'),
(5, 1, 5, 'Pruebas Usuarios'),
(6, 2, 1, 'Consultar Menu'),
(7, 2, 2, 'Insertar Menu'),
(8, 2, 3, 'Modificar Menu'),
(9, 2, 4, 'Eliminar Menu'),
(10, 2, 5, 'Pruebas Menu'),
(11, 3, 1, 'Consultar Permiso'),
(12, 3, 2, 'Insertar Permiso'),
(13, 3, 3, 'Modificar Permiso'),
(14, 3, 4, 'Eliminar Permiso'),
(15, 3, 5, 'Pruebas Permiso'),
(16, 4, 1, 'Consultar Rol'),
(17, 4, 2, 'Insertar Rol'),
(18, 4, 3, 'Modificar Rol'),
(19, 4, 4, 'Eliminar Rol'),
(20, 4, 5, 'Pruebas Rol'),
(21, 5, 1, 'Consultar Administracion'),
(22, 5, 2, 'Insertar Administracion'),
(23, 5, 3, 'Modificar Administracion'),
(24, 5, 4, 'Eliminar Administracion'),
(25, 5, 5, 'Pruebas Administracion'),
(187, 6, 1, 'Consultar Texto'),
(188, 6, 2, 'Insertar Texto'),
(189, 6, 3, 'Modificar Texto'),
(190, 6, 4, 'Eliminar Texto'),
(191, 6, 5, 'Eliminar Texto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisousuario`
--

DROP TABLE IF EXISTS `permisousuario`;
CREATE TABLE IF NOT EXISTS `permisousuario` (
  `id_Permiso` int(11) NOT NULL,
  `id_Usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_Permiso`,`id_Usuario`),
  KEY `id_Usuario` (`id_Usuario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `permisousuario`
--

INSERT INTO `permisousuario` (`id_Permiso`, `id_Usuario`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id_Rol` int(11) NOT NULL AUTO_INCREMENT,
  `rol` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_Rol`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_Rol`, `rol`) VALUES
(1, 'Administrativo'),
(2, 'Almacenero'),
(3, 'Autonomo'),
(4, 'Asistente Personal'),
(5, 'Auxiliar de Servicios'),
(6, 'Becario'),
(7, 'Consejo de Administracion'),
(8, 'CSO'),
(9, 'Director Comercial'),
(10, 'Director de Comunicacion'),
(11, 'Director de Finanzas'),
(12, 'Director de Recursos Humanos'),
(13, 'Director de Riesgos'),
(14, 'Director de Seguridad'),
(15, 'Director de Tecnologia'),
(16, 'Director Ejecutivo'),
(17, 'Director General'),
(18, 'Director Tecnico'),
(19, 'Ejecutivo'),
(20, 'Empresario'),
(21, 'Gerente'),
(22, 'Jefe de Marca'),
(23, 'Jefe de Operaciones'),
(24, 'Junta de Directores'),
(25, 'Product Manager'),
(26, 'Recepcionista'),
(27, 'Secretario'),
(28, 'Secretario General'),
(29, 'Vendedor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rolusuario`
--

DROP TABLE IF EXISTS `rolusuario`;
CREATE TABLE IF NOT EXISTS `rolusuario` (
  `id_Rol` int(11) NOT NULL,
  `id_Usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_Rol`,`id_Usuario`),
  KEY `id_Usuario` (`id_Usuario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `rolusuario`
--

INSERT INTO `rolusuario` (`id_Rol`, `id_Usuario`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_Usuario` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(40) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `apellido_1` varchar(40) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `apellido_2` varchar(40) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `login` varchar(40) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `pass` varchar(32) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `activo` char(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id_Usuario`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=497 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_Usuario`, `nombre`, `apellido_1`, `apellido_2`, `img`, `login`, `pass`, `activo`) VALUES
(1, 'Administrador', 'Administrador', 'Administrador', NULL, 'admin', '15db101259572cb1115f1b9bc5851236', 'S'),
(2, 'Javier', 'jj', 'jj', NULL, 'javier', '202cb962ac59075b964b07152d234b70', 'S'),
(5, 'Fernando', 'ff', 'ff', NULL, 'fernando', '202cb962ac59075b964b07152d234b70', 'N'),
(6, 'Juan', 'Froilan', 'De todos los Santos', NULL, 'jfroi', '202cb962ac59075b964b07152d234b70', 'S'),
(7, 'prueba', 'p', 'p', NULL, 'p', '202cb962ac59075b964b07152d234b70', 'S'),
(103, 'Carine ', 'Schmitt', '', NULL, 'Schmitt', '202cb962ac59075b964b07152d234b70', 'S'),
(112, 'Jean', 'King', '', NULL, 'King', '202cb962ac59075b964b07152d234b70', 'S'),
(114, 'Peter', 'Ferguson', '', NULL, 'Ferguson', '202cb962ac59075b964b07152d234b70', 'S'),
(119, 'Janine ', 'Labrune', '', NULL, 'Labrune', '202cb962ac59075b964b07152d234b70', 'S'),
(121, 'Jonas ', 'Bergulfsen', '', NULL, 'Bergulfsen', '202cb962ac59075b964b07152d234b70', 'S'),
(124, 'Susan', 'Nelson', '', NULL, 'Nelson', '202cb962ac59075b964b07152d234b70', 'S'),
(125, 'Zbyszek ', 'Piestrzeniewicz', '', NULL, 'Piestrzeniewicz', '202cb962ac59075b964b07152d234b70', 'S'),
(128, 'Roland', 'Keitel', '', NULL, 'Keitel', '202cb962ac59075b964b07152d234b70', 'S'),
(129, 'Julie', 'Murphy', '', NULL, 'Murphy', '202cb962ac59075b964b07152d234b70', 'S'),
(131, 'Kwai', 'Lee', '', NULL, 'Lee', '202cb962ac59075b964b07152d234b70', 'S'),
(141, 'Diego ', 'Freyre', '', NULL, 'Freyre', '202cb962ac59075b964b07152d234b70', 'S'),
(144, 'Christina ', 'Berglund', '', NULL, 'Berglund', '202cb962ac59075b964b07152d234b70', 'S'),
(145, 'Jytte ', 'Petersen', '', NULL, 'Petersen', '202cb962ac59075b964b07152d234b70', 'S'),
(146, 'Mary ', 'Saveley', '', NULL, 'Saveley', '202cb962ac59075b964b07152d234b70', 'S'),
(148, 'Eric', 'Natividad', '', NULL, 'Natividad', '202cb962ac59075b964b07152d234b70', 'S'),
(151, 'Jeff', 'Young', '', NULL, 'Young', '202cb962ac59075b964b07152d234b70', 'S'),
(157, 'Kelvin', 'Leong', '', NULL, 'Leong', '202cb962ac59075b964b07152d234b70', 'S'),
(161, 'Juri', 'Hashimoto', '', NULL, 'Hashimoto', '202cb962ac59075b964b07152d234b70', 'S'),
(166, 'Wendy', 'Victorino', '', NULL, 'Victorino', '202cb962ac59075b964b07152d234b70', 'S'),
(167, 'Veysel', 'Oeztan', '', NULL, 'Oeztan', '202cb962ac59075b964b07152d234b70', 'S'),
(168, 'Keith', 'Franco', '', NULL, 'Franco', '202cb962ac59075b964b07152d234b70', 'S'),
(169, 'Isabel ', 'de Castro', '', NULL, 'de Castro', '202cb962ac59075b964b07152d234b70', 'S'),
(171, 'Martine ', 'Ranc', '', NULL, 'Ranc', '202cb962ac59075b964b07152d234b70', 'S'),
(172, 'Marie', 'Bertrand', '', NULL, 'Bertrand', '202cb962ac59075b964b07152d234b70', 'S'),
(173, 'Jerry', 'Tseng', '', NULL, 'Tseng', '202cb962ac59075b964b07152d234b70', 'S'),
(175, 'Julie', 'King2', '', NULL, 'King2', '202cb962ac59075b964b07152d234b70', 'S'),
(177, 'Mory', 'Kentary', '', NULL, 'Kentary', '202cb962ac59075b964b07152d234b70', 'S'),
(181, 'Michael', 'Frick', '', NULL, 'Frick4', '202cb962ac59075b964b07152d234b70', 'S'),
(186, 'Matti', 'Karttunen', '', NULL, 'Karttunen', '202cb962ac59075b964b07152d234b70', 'S'),
(187, 'Rachel', 'Ashworth', '', NULL, 'Ashworth', '202cb962ac59075b964b07152d234b70', 'S'),
(189, 'Dean', 'Cassidy', '', NULL, 'Cassidy', '202cb962ac59075b964b07152d234b70', 'S'),
(198, 'Leslie', 'Taylor', '', NULL, 'Taylor', '202cb962ac59075b964b07152d234b70', 'S'),
(201, 'Elizabeth', 'Devon', '', NULL, 'Devon', '202cb962ac59075b964b07152d234b70', 'S'),
(202, 'Yoshi ', 'Tamuri', '', NULL, 'Tamuri', '202cb962ac59075b964b07152d234b70', 'S'),
(204, 'Miguel', 'Barajas', '', NULL, 'Barajas', '202cb962ac59075b964b07152d234b70', 'S'),
(205, 'Julie', 'Young', '', NULL, 'Young2', '202cb962ac59075b964b07152d234b70', 'S'),
(206, 'Brydey', 'Walker', '', NULL, 'Walker', '202cb962ac59075b964b07152d234b70', 'S'),
(209, 'Fr?d?rique ', 'Citeaux', '', NULL, 'Citeaux', '202cb962ac59075b964b07152d234b70', 'S'),
(211, 'Mike', 'Gao', '', NULL, 'Gao', '202cb962ac59075b964b07152d234b70', 'S'),
(216, 'Eduardo ', 'Saavedra', '', NULL, 'Saavedra', '202cb962ac59075b964b07152d234b70', 'S'),
(219, 'Mary', 'Young', '', NULL, 'Young3', '202cb962ac59075b964b07152d234b70', 'S'),
(223, 'Horst ', 'Kloss', '', NULL, 'Kloss', '202cb962ac59075b964b07152d234b70', 'S'),
(227, 'Palle', 'Ibsen', '', NULL, 'Ibsen', '202cb962ac59075b964b07152d234b70', 'S'),
(233, 'Jean ', 'Fresni?re', '', NULL, 'Fresni?re', '202cb962ac59075b964b07152d234b70', 'S'),
(237, 'Alejandra ', 'Camino', '', NULL, 'Camino', '202cb962ac59075b964b07152d234b70', 'S'),
(239, 'Valarie', 'Thompson', '', NULL, 'Thompson2', '202cb962ac59075b964b07152d234b70', 'S'),
(240, 'Helen ', 'Bennett', '', NULL, 'Bennett', '202cb962ac59075b964b07152d234b70', 'S'),
(242, 'Annette ', 'Roulet', '', NULL, 'Roulet', '202cb962ac59075b964b07152d234b70', 'S'),
(247, 'Renate ', 'Messner', '', NULL, 'Messner', '202cb962ac59075b964b07152d234b70', 'S'),
(249, 'Paolo ', 'Accorti', '', NULL, 'Accorti', '202cb962ac59075b964b07152d234b70', 'S'),
(250, 'Daniel', 'Da Silva', '', NULL, 'Da Silva', '202cb962ac59075b964b07152d234b70', 'S'),
(256, 'Daniel ', 'Tonini', '', NULL, 'Tonini', '202cb962ac59075b964b07152d234b70', 'S'),
(259, 'Henriette ', 'Pfalzheim', '', NULL, 'Pfalzheim', '202cb962ac59075b964b07152d234b70', 'S'),
(260, 'Elizabeth ', 'Lincoln', '', NULL, 'Lincoln', '202cb962ac59075b964b07152d234b70', 'S'),
(273, 'Peter ', 'Franken', '', NULL, 'Franken', '202cb962ac59075b964b07152d234b70', 'S'),
(276, 'Anna', 'O''Hara', '', NULL, 'O''Hara', '202cb962ac59075b964b07152d234b70', 'S'),
(278, 'Giovanni ', 'Rovelli', '', NULL, 'Rovelli', '202cb962ac59075b964b07152d234b70', 'S'),
(282, 'Adrian', 'Huxley', '', NULL, 'Huxley', '202cb962ac59075b964b07152d234b70', 'S'),
(286, 'Marta', 'Hernandez', '', NULL, 'Hernandez3', '202cb962ac59075b964b07152d234b70', 'S'),
(293, 'Ed', 'Harrison', '', NULL, 'Harrison', '202cb962ac59075b964b07152d234b70', 'S'),
(298, 'Mihael', 'Holz', '', NULL, 'Holz', '202cb962ac59075b964b07152d234b70', 'S'),
(299, 'Jan', 'Klaeboe', '', NULL, 'Klaeboe', '202cb962ac59075b964b07152d234b70', 'S'),
(303, 'Bradley', 'Schuyler', '', NULL, 'Schuyler', '202cb962ac59075b964b07152d234b70', 'S'),
(307, 'Mel', 'Andersen', '', NULL, 'Andersen', '202cb962ac59075b964b07152d234b70', 'S'),
(311, 'Pirkko', 'Koskitalo', '', NULL, 'Koskitalo', '202cb962ac59075b964b07152d234b70', 'S'),
(314, 'Catherine ', 'Dewey', '', NULL, 'Dewey', '202cb962ac59075b964b07152d234b70', 'S'),
(319, 'Steve', 'Frick', '', NULL, 'Frick2', '202cb962ac59075b964b07152d234b70', 'S'),
(320, 'Wing', 'Huang', '', NULL, 'Huang', '202cb962ac59075b964b07152d234b70', 'S'),
(321, 'Julie', 'Brown', '', NULL, 'Brown', '202cb962ac59075b964b07152d234b70', 'S'),
(323, 'Mike', 'Graham', '', NULL, 'Graham', '202cb962ac59075b964b07152d234b70', 'S'),
(324, 'Ann ', 'Brown', '', NULL, 'Brown2', '202cb962ac59075b964b07152d234b70', 'S'),
(328, 'William', 'Brown', '', NULL, 'Brown3', '202cb962ac59075b964b07152d234b70', 'S'),
(333, 'Ben', 'Calaghan', '', NULL, 'Calaghan', '202cb962ac59075b964b07152d234b70', 'S'),
(334, 'Kalle', 'Suominen', '', NULL, 'Suominen', '202cb962ac59075b964b07152d234b70', 'S'),
(335, 'Philip ', 'Cramer', '', NULL, 'Cramer', '202cb962ac59075b964b07152d234b70', 'S'),
(339, 'Francisca', 'Cervantes', '', NULL, 'Cervantes', '202cb962ac59075b964b07152d234b70', 'S'),
(344, 'Jesus', 'Fernandez', '', NULL, 'Fernandez', '202cb962ac59075b964b07152d234b70', 'S'),
(347, 'Brian', 'Chandler', '', NULL, 'Chandler', '202cb962ac59075b964b07152d234b70', 'S'),
(348, 'Patricia ', 'McKenna', '', NULL, 'McKenna', '202cb962ac59075b964b07152d234b70', 'S'),
(350, 'Laurence ', 'Lebihan', '', NULL, 'Lebihan', '202cb962ac59075b964b07152d234b70', 'S'),
(353, 'Paul ', 'Henriot', '', NULL, 'Henriot', '202cb962ac59075b964b07152d234b70', 'S'),
(356, 'Armand', 'Kuger', '', NULL, 'Kuger', '202cb962ac59075b964b07152d234b70', 'S'),
(357, 'Wales', 'MacKinlay', '', NULL, 'MacKinlay', '202cb962ac59075b964b07152d234b70', 'S'),
(361, 'Karin', 'Josephs', '', NULL, 'Josephs', '202cb962ac59075b964b07152d234b70', 'S'),
(362, 'Juri', 'Yoshido', '', NULL, 'Yoshido', '202cb962ac59075b964b07152d234b70', 'S'),
(363, 'Dorothy', 'Young', '', NULL, 'Young4', '202cb962ac59075b964b07152d234b70', 'S'),
(369, 'Lino ', 'Rodriguez', '', NULL, 'Rodriguez', '202cb962ac59075b964b07152d234b70', 'S'),
(376, 'Braun', 'Urs', '', NULL, 'Urs', '202cb962ac59075b964b07152d234b70', 'S'),
(379, 'Allen', 'Nelson', '', NULL, 'Nelson2', '202cb962ac59075b964b07152d234b70', 'S'),
(381, 'Pascale ', 'Cartrain', '', NULL, 'Cartrain', '202cb962ac59075b964b07152d234b70', 'S'),
(382, 'Georg ', 'Pipps', '', NULL, 'Pipps', '202cb962ac59075b964b07152d234b70', 'S'),
(385, 'Arnold', 'Cruz', '', NULL, 'Cruz', '202cb962ac59075b964b07152d234b70', 'S'),
(386, 'Maurizio ', 'Moroni', '', NULL, 'Moroni', '202cb962ac59075b964b07152d234b70', 'S'),
(398, 'Akiko', 'Shimamura', '', NULL, 'Shimamura', '202cb962ac59075b964b07152d234b70', 'S'),
(406, 'Dominique', 'Perrier', '', NULL, 'Perrier', '202cb962ac59075b964b07152d234b70', 'S'),
(409, 'Rita ', 'M?ller', '', NULL, 'M?ller', '202cb962ac59075b964b07152d234b70', 'S'),
(412, 'Sarah', 'McRoy', '', NULL, 'McRoy', '202cb962ac59075b964b07152d234b70', 'S'),
(415, 'Michael', 'Donnermeyer', '', NULL, 'Donnermeyer', '202cb962ac59075b964b07152d234b70', 'S'),
(424, 'Maria', 'Hernandez', '', NULL, 'Hernandez2', '202cb962ac59075b964b07152d234b70', 'S'),
(443, 'Alexander ', 'Feuer', '', NULL, 'Feuer', '202cb962ac59075b964b07152d234b70', 'S'),
(447, 'Dan', 'Lewis', '', NULL, 'Lewis', '202cb962ac59075b964b07152d234b70', 'S'),
(448, 'Martha', 'Larsson', '', NULL, 'Larsson', '202cb962ac59075b964b07152d234b70', 'S'),
(450, 'Sue', 'Frick', '', NULL, 'Frick3', '202cb962ac59075b964b07152d234b70', 'S'),
(452, 'Roland ', 'Mendel', '', NULL, 'Mendel', '202cb962ac59075b964b07152d234b70', 'S'),
(455, 'Leslie', 'Murphy', '', NULL, 'Murphy2', '202cb962ac59075b964b07152d234b70', 'S'),
(456, 'Yu', 'Choi', '', NULL, 'Choi', '202cb962ac59075b964b07152d234b70', 'S'),
(458, 'Mart?n ', 'Sommer', '', NULL, 'Sommer', '202cb962ac59075b964b07152d234b70', 'S'),
(459, 'Sven ', 'Ottlieb', '', NULL, 'Ottlieb', '202cb962ac59075b964b07152d234b70', 'S'),
(462, 'Violeta', 'Benitez', '', NULL, 'Benitez', '202cb962ac59075b964b07152d234b70', 'S'),
(465, 'Carmen', 'Anton', '', NULL, 'Anton', '202cb962ac59075b964b07152d234b70', 'S'),
(471, 'Sean', 'Clenahan', '', NULL, 'Clenahan', '202cb962ac59075b964b07152d234b70', 'S'),
(473, 'Franco', 'Ricotti', '', NULL, 'Ricotti', '202cb962ac59075b964b07152d234b70', 'S'),
(475, 'Steve', 'Thompson', '', NULL, 'Thompson3', '202cb962ac59075b964b07152d234b70', 'S'),
(477, 'Hanna ', 'Moos', '', NULL, 'Moos', '202cb962ac59075b964b07152d234b70', 'S'),
(480, 'Alexander ', 'Semenov', '', NULL, 'Semenov', '202cb962ac59075b964b07152d234b70', 'S'),
(481, 'Raanan', 'Altagar,G M', '', NULL, 'Altagar,G M', '202cb962ac59075b964b07152d234b70', 'S'),
(484, 'Jos? Pedro ', 'Roel', '', NULL, 'Roel', '202cb962ac59075b964b07152d234b70', 'S'),
(486, 'Rosa', 'Salazar', '', NULL, 'Salazar', '202cb962ac59075b964b07152d234b70', 'S'),
(487, 'Sue', 'Taylor', '', NULL, 'Taylor2', '202cb962ac59075b964b07152d234b70', 'S'),
(489, 'Thomas ', 'Smith', '', NULL, 'Smith', '202cb962ac59075b964b07152d234b70', 'S'),
(495, 'Valarie', 'Franco', '', NULL, 'Franco2', '202cb962ac59075b964b07152d234b70', 'S'),
(496, 'Tony', 'Snowden', '', NULL, 'Snowden', '202cb962ac59075b964b07152d234b70', 'S');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
