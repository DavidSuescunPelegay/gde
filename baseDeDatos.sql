-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-10-2016 a las 09:56:37
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `menus`
--

INSERT INTO `menus` (`id_Opcion`, `texto`, `url`, `id_Padre`, `orden`) VALUES
(1, 'Usuarios', 'app.php?c=Usuarios', 0, 10),
(2, 'Menus', 'app.php?c=Menus', 0, 20),
(3, 'Permisos', 'app.php?c=Permisos', 0, 60),
(4, 'Personal', '#', 0, 40),
(5, 'Contratos', '#', 4, 10),
(6, 'Nominas', '#', 4, 20),
(7, 'Administracion', '#', 0, 50),
(8, 'Facturas', '#', 7, 20),
(9, 'Informes', '#', 7, 20),
(10, 'Pedidos', '#', 0, 30),
(11, 'Pruebas', 'index.php', 0, 9999);

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
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id_Permiso`, `id_Opcion`, `num_Permiso`, `permiso`) VALUES
(1, 1, 1, 'Consultar Usuario'),
(2, 1, 2, 'Insertar Usuario'),
(3, 1, 3, 'Modificar Usuario'),
(4, 1, 4, 'Eliminar Usuario'),
(5, 2, 1, 'Consultar Menu'),
(6, 2, 2, 'Insertar Menu'),
(7, 2, 3, 'Modificar Menu'),
(8, 2, 4, 'Eliminar Menu'),
(9, 11, 1, 'Consultar Pruebas'),
(10, 11, 2, 'Insertar Pruebas'),
(11, 11, 3, 'Modificar Pruebas'),
(12, 11, 4, 'Eliminar Pruebas'),
(13, 11, 5, 'Lorem Ipsum');

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id_Rol` int(11) NOT NULL,
  `rol` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_Rol`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rolesusuario`
--

DROP TABLE IF EXISTS `rolesusuario`;
CREATE TABLE IF NOT EXISTS `rolesusuario` (
  `id_Rol` int(11) NOT NULL,
  `id_Usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_Rol`,`id_Usuario`),
  KEY `id_Usuario` (`id_Usuario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

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
  `login` varchar(40) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `pass` varchar(32) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `activo` char(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id_Usuario`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=497 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_Usuario`, `nombre`, `apellido_1`, `apellido_2`, `login`, `pass`, `activo`) VALUES
(1, 'Administrador', 'Administrador', 'Administrador', 'admin', '202cb962ac59075b964b07152d234b70', 'S'),
(2, 'Javier', 'jj', 'jj', 'javier', '202cb962ac59075b964b07152d234b70', 'S'),
(5, 'Fernando', 'ff', 'ff', 'fernando', '202cb962ac59075b964b07152d234b70', 'N'),
(6, 'Juan', 'Froilan', 'De todos los Santos', 'jfroi', '202cb962ac59075b964b07152d234b70', 'S'),
(7, 'prueba', 'p', 'p', 'p', '202cb962ac59075b964b07152d234b70', 'S'),
(103, 'Carine ', 'Schmitt', '', 'Schmitt', '202cb962ac59075b964b07152d234b70', 'S'),
(112, 'Jean', 'King', '', 'King', '202cb962ac59075b964b07152d234b70', 'S'),
(114, 'Peter', 'Ferguson', '', 'Ferguson', '202cb962ac59075b964b07152d234b70', 'S'),
(119, 'Janine ', 'Labrune', '', 'Labrune', '202cb962ac59075b964b07152d234b70', 'S'),
(121, 'Jonas ', 'Bergulfsen', '', 'Bergulfsen', '202cb962ac59075b964b07152d234b70', 'S'),
(124, 'Susan', 'Nelson', '', 'Nelson', '202cb962ac59075b964b07152d234b70', 'S'),
(125, 'Zbyszek ', 'Piestrzeniewicz', '', 'Piestrzeniewicz', '202cb962ac59075b964b07152d234b70', 'S'),
(128, 'Roland', 'Keitel', '', 'Keitel', '202cb962ac59075b964b07152d234b70', 'S'),
(129, 'Julie', 'Murphy', '', 'Murphy', '202cb962ac59075b964b07152d234b70', 'S'),
(131, 'Kwai', 'Lee', '', 'Lee', '202cb962ac59075b964b07152d234b70', 'S'),
(141, 'Diego ', 'Freyre', '', 'Freyre', '202cb962ac59075b964b07152d234b70', 'S'),
(144, 'Christina ', 'Berglund', '', 'Berglund', '202cb962ac59075b964b07152d234b70', 'S'),
(145, 'Jytte ', 'Petersen', '', 'Petersen', '202cb962ac59075b964b07152d234b70', 'S'),
(146, 'Mary ', 'Saveley', '', 'Saveley', '202cb962ac59075b964b07152d234b70', 'S'),
(148, 'Eric', 'Natividad', '', 'Natividad', '202cb962ac59075b964b07152d234b70', 'S'),
(151, 'Jeff', 'Young', '', 'Young', '202cb962ac59075b964b07152d234b70', 'S'),
(157, 'Kelvin', 'Leong', '', 'Leong', '202cb962ac59075b964b07152d234b70', 'S'),
(161, 'Juri', 'Hashimoto', '', 'Hashimoto', '202cb962ac59075b964b07152d234b70', 'S'),
(166, 'Wendy', 'Victorino', '', 'Victorino', '202cb962ac59075b964b07152d234b70', 'S'),
(167, 'Veysel', 'Oeztan', '', 'Oeztan', '202cb962ac59075b964b07152d234b70', 'S'),
(168, 'Keith', 'Franco', '', 'Franco', '202cb962ac59075b964b07152d234b70', 'S'),
(169, 'Isabel ', 'de Castro', '', 'de Castro', '202cb962ac59075b964b07152d234b70', 'S'),
(171, 'Martine ', 'Ranc', '', 'Ranc', '202cb962ac59075b964b07152d234b70', 'S'),
(172, 'Marie', 'Bertrand', '', 'Bertrand', '202cb962ac59075b964b07152d234b70', 'S'),
(173, 'Jerry', 'Tseng', '', 'Tseng', '202cb962ac59075b964b07152d234b70', 'S'),
(175, 'Julie', 'King2', '', 'King2', '202cb962ac59075b964b07152d234b70', 'S'),
(177, 'Mory', 'Kentary', '', 'Kentary', '202cb962ac59075b964b07152d234b70', 'S'),
(181, 'Michael', 'Frick', '', 'Frick4', '202cb962ac59075b964b07152d234b70', 'S'),
(186, 'Matti', 'Karttunen', '', 'Karttunen', '202cb962ac59075b964b07152d234b70', 'S'),
(187, 'Rachel', 'Ashworth', '', 'Ashworth', '202cb962ac59075b964b07152d234b70', 'S'),
(189, 'Dean', 'Cassidy', '', 'Cassidy', '202cb962ac59075b964b07152d234b70', 'S'),
(198, 'Leslie', 'Taylor', '', 'Taylor', '202cb962ac59075b964b07152d234b70', 'S'),
(201, 'Elizabeth', 'Devon', '', 'Devon', '202cb962ac59075b964b07152d234b70', 'S'),
(202, 'Yoshi ', 'Tamuri', '', 'Tamuri', '202cb962ac59075b964b07152d234b70', 'S'),
(204, 'Miguel', 'Barajas', '', 'Barajas', '202cb962ac59075b964b07152d234b70', 'S'),
(205, 'Julie', 'Young', '', 'Young2', '202cb962ac59075b964b07152d234b70', 'S'),
(206, 'Brydey', 'Walker', '', 'Walker', '202cb962ac59075b964b07152d234b70', 'S'),
(209, 'Fr?d?rique ', 'Citeaux', '', 'Citeaux', '202cb962ac59075b964b07152d234b70', 'S'),
(211, 'Mike', 'Gao', '', 'Gao', '202cb962ac59075b964b07152d234b70', 'S'),
(216, 'Eduardo ', 'Saavedra', '', 'Saavedra', '202cb962ac59075b964b07152d234b70', 'S'),
(219, 'Mary', 'Young', '', 'Young3', '202cb962ac59075b964b07152d234b70', 'S'),
(223, 'Horst ', 'Kloss', '', 'Kloss', '202cb962ac59075b964b07152d234b70', 'S'),
(227, 'Palle', 'Ibsen', '', 'Ibsen', '202cb962ac59075b964b07152d234b70', 'S'),
(233, 'Jean ', 'Fresni?re', '', 'Fresni?re', '202cb962ac59075b964b07152d234b70', 'S'),
(237, 'Alejandra ', 'Camino', '', 'Camino', '202cb962ac59075b964b07152d234b70', 'S'),
(239, 'Valarie', 'Thompson', '', 'Thompson2', '202cb962ac59075b964b07152d234b70', 'S'),
(240, 'Helen ', 'Bennett', '', 'Bennett', '202cb962ac59075b964b07152d234b70', 'S'),
(242, 'Annette ', 'Roulet', '', 'Roulet', '202cb962ac59075b964b07152d234b70', 'S'),
(247, 'Renate ', 'Messner', '', 'Messner', '202cb962ac59075b964b07152d234b70', 'S'),
(249, 'Paolo ', 'Accorti', '', 'Accorti', '202cb962ac59075b964b07152d234b70', 'S'),
(250, 'Daniel', 'Da Silva', '', 'Da Silva', '202cb962ac59075b964b07152d234b70', 'S'),
(256, 'Daniel ', 'Tonini', '', 'Tonini', '202cb962ac59075b964b07152d234b70', 'S'),
(259, 'Henriette ', 'Pfalzheim', '', 'Pfalzheim', '202cb962ac59075b964b07152d234b70', 'S'),
(260, 'Elizabeth ', 'Lincoln', '', 'Lincoln', '202cb962ac59075b964b07152d234b70', 'S'),
(273, 'Peter ', 'Franken', '', 'Franken', '202cb962ac59075b964b07152d234b70', 'S'),
(276, 'Anna', 'O''Hara', '', 'O''Hara', '202cb962ac59075b964b07152d234b70', 'S'),
(278, 'Giovanni ', 'Rovelli', '', 'Rovelli', '202cb962ac59075b964b07152d234b70', 'S'),
(282, 'Adrian', 'Huxley', '', 'Huxley', '202cb962ac59075b964b07152d234b70', 'S'),
(286, 'Marta', 'Hernandez', '', 'Hernandez3', '202cb962ac59075b964b07152d234b70', 'S'),
(293, 'Ed', 'Harrison', '', 'Harrison', '202cb962ac59075b964b07152d234b70', 'S'),
(298, 'Mihael', 'Holz', '', 'Holz', '202cb962ac59075b964b07152d234b70', 'S'),
(299, 'Jan', 'Klaeboe', '', 'Klaeboe', '202cb962ac59075b964b07152d234b70', 'S'),
(303, 'Bradley', 'Schuyler', '', 'Schuyler', '202cb962ac59075b964b07152d234b70', 'S'),
(307, 'Mel', 'Andersen', '', 'Andersen', '202cb962ac59075b964b07152d234b70', 'S'),
(311, 'Pirkko', 'Koskitalo', '', 'Koskitalo', '202cb962ac59075b964b07152d234b70', 'S'),
(314, 'Catherine ', 'Dewey', '', 'Dewey', '202cb962ac59075b964b07152d234b70', 'S'),
(319, 'Steve', 'Frick', '', 'Frick2', '202cb962ac59075b964b07152d234b70', 'S'),
(320, 'Wing', 'Huang', '', 'Huang', '202cb962ac59075b964b07152d234b70', 'S'),
(321, 'Julie', 'Brown', '', 'Brown', '202cb962ac59075b964b07152d234b70', 'S'),
(323, 'Mike', 'Graham', '', 'Graham', '202cb962ac59075b964b07152d234b70', 'S'),
(324, 'Ann ', 'Brown', '', 'Brown2', '202cb962ac59075b964b07152d234b70', 'S'),
(328, 'William', 'Brown', '', 'Brown3', '202cb962ac59075b964b07152d234b70', 'S'),
(333, 'Ben', 'Calaghan', '', 'Calaghan', '202cb962ac59075b964b07152d234b70', 'S'),
(334, 'Kalle', 'Suominen', '', 'Suominen', '202cb962ac59075b964b07152d234b70', 'S'),
(335, 'Philip ', 'Cramer', '', 'Cramer', '202cb962ac59075b964b07152d234b70', 'S'),
(339, 'Francisca', 'Cervantes', '', 'Cervantes', '202cb962ac59075b964b07152d234b70', 'S'),
(344, 'Jesus', 'Fernandez', '', 'Fernandez', '202cb962ac59075b964b07152d234b70', 'S'),
(347, 'Brian', 'Chandler', '', 'Chandler', '202cb962ac59075b964b07152d234b70', 'S'),
(348, 'Patricia ', 'McKenna', '', 'McKenna', '202cb962ac59075b964b07152d234b70', 'S'),
(350, 'Laurence ', 'Lebihan', '', 'Lebihan', '202cb962ac59075b964b07152d234b70', 'S'),
(353, 'Paul ', 'Henriot', '', 'Henriot', '202cb962ac59075b964b07152d234b70', 'S'),
(356, 'Armand', 'Kuger', '', 'Kuger', '202cb962ac59075b964b07152d234b70', 'S'),
(357, 'Wales', 'MacKinlay', '', 'MacKinlay', '202cb962ac59075b964b07152d234b70', 'S'),
(361, 'Karin', 'Josephs', '', 'Josephs', '202cb962ac59075b964b07152d234b70', 'S'),
(362, 'Juri', 'Yoshido', '', 'Yoshido', '202cb962ac59075b964b07152d234b70', 'S'),
(363, 'Dorothy', 'Young', '', 'Young4', '202cb962ac59075b964b07152d234b70', 'S'),
(369, 'Lino ', 'Rodriguez', '', 'Rodriguez', '202cb962ac59075b964b07152d234b70', 'S'),
(376, 'Braun', 'Urs', '', 'Urs', '202cb962ac59075b964b07152d234b70', 'S'),
(379, 'Allen', 'Nelson', '', 'Nelson2', '202cb962ac59075b964b07152d234b70', 'S'),
(381, 'Pascale ', 'Cartrain', '', 'Cartrain', '202cb962ac59075b964b07152d234b70', 'S'),
(382, 'Georg ', 'Pipps', '', 'Pipps', '202cb962ac59075b964b07152d234b70', 'S'),
(385, 'Arnold', 'Cruz', '', 'Cruz', '202cb962ac59075b964b07152d234b70', 'S'),
(386, 'Maurizio ', 'Moroni', '', 'Moroni', '202cb962ac59075b964b07152d234b70', 'S'),
(398, 'Akiko', 'Shimamura', '', 'Shimamura', '202cb962ac59075b964b07152d234b70', 'S'),
(406, 'Dominique', 'Perrier', '', 'Perrier', '202cb962ac59075b964b07152d234b70', 'S'),
(409, 'Rita ', 'M?ller', '', 'M?ller', '202cb962ac59075b964b07152d234b70', 'S'),
(412, 'Sarah', 'McRoy', '', 'McRoy', '202cb962ac59075b964b07152d234b70', 'S'),
(415, 'Michael', 'Donnermeyer', '', 'Donnermeyer', '202cb962ac59075b964b07152d234b70', 'S'),
(424, 'Maria', 'Hernandez', '', 'Hernandez2', '202cb962ac59075b964b07152d234b70', 'S'),
(443, 'Alexander ', 'Feuer', '', 'Feuer', '202cb962ac59075b964b07152d234b70', 'S'),
(447, 'Dan', 'Lewis', '', 'Lewis', '202cb962ac59075b964b07152d234b70', 'S'),
(448, 'Martha', 'Larsson', '', 'Larsson', '202cb962ac59075b964b07152d234b70', 'S'),
(450, 'Sue', 'Frick', '', 'Frick3', '202cb962ac59075b964b07152d234b70', 'S'),
(452, 'Roland ', 'Mendel', '', 'Mendel', '202cb962ac59075b964b07152d234b70', 'S'),
(455, 'Leslie', 'Murphy', '', 'Murphy2', '202cb962ac59075b964b07152d234b70', 'S'),
(456, 'Yu', 'Choi', '', 'Choi', '202cb962ac59075b964b07152d234b70', 'S'),
(458, 'Mart?n ', 'Sommer', '', 'Sommer', '202cb962ac59075b964b07152d234b70', 'S'),
(459, 'Sven ', 'Ottlieb', '', 'Ottlieb', '202cb962ac59075b964b07152d234b70', 'S'),
(462, 'Violeta', 'Benitez', '', 'Benitez', '202cb962ac59075b964b07152d234b70', 'S'),
(465, 'Carmen', 'Anton', '', 'Anton', '202cb962ac59075b964b07152d234b70', 'S'),
(471, 'Sean', 'Clenahan', '', 'Clenahan', '202cb962ac59075b964b07152d234b70', 'S'),
(473, 'Franco', 'Ricotti', '', 'Ricotti', '202cb962ac59075b964b07152d234b70', 'S'),
(475, 'Steve', 'Thompson', '', 'Thompson3', '202cb962ac59075b964b07152d234b70', 'S'),
(477, 'Hanna ', 'Moos', '', 'Moos', '202cb962ac59075b964b07152d234b70', 'S'),
(480, 'Alexander ', 'Semenov', '', 'Semenov', '202cb962ac59075b964b07152d234b70', 'S'),
(481, 'Raanan', 'Altagar,G M', '', 'Altagar,G M', '202cb962ac59075b964b07152d234b70', 'S'),
(484, 'Jos? Pedro ', 'Roel', '', 'Roel', '202cb962ac59075b964b07152d234b70', 'S'),
(486, 'Rosa', 'Salazar', '', 'Salazar', '202cb962ac59075b964b07152d234b70', 'S'),
(487, 'Sue', 'Taylor', '', 'Taylor2', '202cb962ac59075b964b07152d234b70', 'S'),
(489, 'Thomas ', 'Smith', '', 'Smith', '202cb962ac59075b964b07152d234b70', 'S'),
(495, 'Valarie', 'Franco', '', 'Franco2', '202cb962ac59075b964b07152d234b70', 'S'),
(496, 'Tony', 'Snowden', '', 'Snowden', '202cb962ac59075b964b07152d234b70', 'S');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
