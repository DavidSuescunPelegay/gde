-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2017 at 03:24 PM
-- Server version: 5.7.11
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gde`
--
CREATE DATABASE IF NOT EXISTS `gde` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `gde`;

-- --------------------------------------------------------

--
-- Table structure for table `ficheros`
--

DROP TABLE IF EXISTS `ficheros`;
CREATE TABLE `ficheros` (
  `id_Fichero` int(11) UNSIGNED NOT NULL,
  `id_Usuario` int(11) NOT NULL,
  `sysdate_Subida` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `parametros` varchar(256) NOT NULL,
  `url` varchar(256) NOT NULL,
  `nombre` varchar(256) NOT NULL,
  `nombre_Original` varchar(256) NOT NULL,
  `ext` varchar(256) NOT NULL,
  `activo` char(1) NOT NULL DEFAULT 'S'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus` (
  `id_Opcion` int(11) UNSIGNED NOT NULL,
  `texto` varchar(40) NOT NULL,
  `url` varchar(100) NOT NULL,
  `id_Padre` int(11) UNSIGNED NOT NULL,
  `orden` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id_Opcion`, `texto`, `url`, `id_Padre`, `orden`) VALUES
(1, 'Usuarios', 'app.php?c=Usuarios', 0, 10),
(2, 'Menus', 'app.php?c=Menus', 0, 20),
(3, 'Permisos', 'app.php?c=Permisos', 0, 30),
(4, 'Roles', 'app.php?c=Roles', 0, 40),
(5, 'Administracion', 'app.php?c=Administracion', 0, 50),
(6, 'Ficheros', 'app.php?c=Ficheros', 0, 60);

-- --------------------------------------------------------

--
-- Table structure for table `permisorol`
--

DROP TABLE IF EXISTS `permisorol`;
CREATE TABLE `permisorol` (
  `id_Permiso` int(11) NOT NULL,
  `id_Rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permisorol`
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
-- Table structure for table `permisos`
--

DROP TABLE IF EXISTS `permisos`;
CREATE TABLE `permisos` (
  `id_Permiso` int(11) NOT NULL,
  `id_Opcion` int(11) NOT NULL,
  `num_Permiso` int(2) NOT NULL,
  `permiso` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permisos`
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
(26, 6, 1, 'Consultar Ficheros'),
(27, 6, 2, 'Insertar Ficheros'),
(28, 6, 3, 'Modificar Ficheros'),
(29, 6, 4, 'Eliminar Ficheros'),
(30, 6, 5, 'Eliminar Ficheros');

-- --------------------------------------------------------

--
-- Table structure for table `permisousuario`
--

DROP TABLE IF EXISTS `permisousuario`;
CREATE TABLE `permisousuario` (
  `id_Usuario` int(11) NOT NULL,
  `id_Permiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permisousuario`
--

INSERT INTO `permisousuario` (`id_Usuario`, `id_Permiso`) VALUES
(1, 1),
(497, 1),
(1, 2),
(497, 2),
(1, 3),
(497, 3),
(1, 4),
(497, 4),
(1, 5),
(497, 5),
(1, 6),
(497, 6),
(1, 7),
(497, 7),
(1, 8),
(497, 8),
(1, 9),
(497, 9),
(1, 10),
(497, 10),
(1, 11),
(497, 11),
(1, 12),
(497, 12),
(1, 13),
(497, 13),
(1, 14),
(497, 14),
(1, 15),
(497, 15),
(1, 16),
(497, 16),
(1, 17),
(497, 17),
(1, 18),
(497, 18),
(1, 19),
(497, 19),
(1, 20),
(497, 20),
(1, 21),
(497, 21),
(1, 22),
(497, 22),
(1, 23),
(497, 23),
(1, 24),
(497, 24),
(1, 25),
(497, 25),
(1, 26),
(497, 26),
(1, 27),
(497, 27),
(1, 28),
(497, 28),
(1, 29),
(497, 29),
(1, 30),
(497, 30);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id_Rol` int(11) NOT NULL,
  `rol` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
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
-- Table structure for table `rolusuario`
--

DROP TABLE IF EXISTS `rolusuario`;
CREATE TABLE `rolusuario` (
  `id_Rol` int(11) NOT NULL,
  `id_Usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rolusuario`
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
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id_Usuario` int(11) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `apellido_1` varchar(40) NOT NULL,
  `apellido_2` varchar(40) NOT NULL,
  `login` varchar(40) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `activo` char(1) NOT NULL,
  `foto_de_Perfil` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id_Usuario`, `nombre`, `apellido_1`, `apellido_2`, `login`, `pass`, `activo`, `foto_de_Perfil`) VALUES
(1, 'Administrador', 'Administrador', 'Administrador', 'admin', '15db101259572cb1115f1b9bc5851236', 'S', NULL),
(2, 'Javier', 'jj', 'jj', 'javier', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(5, 'Fernando', 'ff', 'ff', 'fernando', '202cb962ac59075b964b07152d234b70', 'N', NULL),
(6, 'Juan', 'Froilan', 'De todos los Santos', 'jfroi', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(7, 'prueba', 'p', 'p', 'p', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(103, 'Carine ', 'Schmitt', '', 'Schmitt', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(112, 'Jean', 'King', '', 'King', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(114, 'Peter', 'Ferguson', '', 'Ferguson', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(119, 'Janine ', 'Labrune', '', 'Labrune', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(121, 'Jonas ', 'Bergulfsen', '', 'Bergulfsen', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(124, 'Susan', 'Nelson', '', 'Nelson', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(125, 'Zbyszek ', 'Piestrzeniewicz', '', 'Piestrzeniewicz', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(128, 'Roland', 'Keitel', '', 'Keitel', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(129, 'Julie', 'Murphy', '', 'Murphy', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(131, 'Kwai', 'Lee', '', 'Lee', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(141, 'Diego ', 'Freyre', '', 'Freyre', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(144, 'Christina ', 'Berglund', '', 'Berglund', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(145, 'Jytte ', 'Petersen', '', 'Petersen', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(146, 'Mary ', 'Saveley', '', 'Saveley', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(148, 'Eric', 'Natividad', '', 'Natividad', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(151, 'Jeff', 'Young', '', 'Young', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(157, 'Kelvin', 'Leong', '', 'Leong', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(161, 'Juri', 'Hashimoto', '', 'Hashimoto', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(166, 'Wendy', 'Victorino', '', 'Victorino', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(167, 'Veysel', 'Oeztan', '', 'Oeztan', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(168, 'Keith', 'Franco', '', 'Franco', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(169, 'Isabel ', 'de Castro', '', 'de Castro', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(171, 'Martine ', 'Ranc', '', 'Ranc', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(172, 'Marie', 'Bertrand', '', 'Bertrand', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(173, 'Jerry', 'Tseng', '', 'Tseng', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(175, 'Julie', 'King2', '', 'King2', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(177, 'Mory', 'Kentary', '', 'Kentary', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(181, 'Michael', 'Frick', '', 'Frick4', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(186, 'Matti', 'Karttunen', '', 'Karttunen', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(187, 'Rachel', 'Ashworth', '', 'Ashworth', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(189, 'Dean', 'Cassidy', '', 'Cassidy', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(198, 'Leslie', 'Taylor', '', 'Taylor', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(201, 'Elizabeth', 'Devon', '', 'Devon', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(202, 'Yoshi ', 'Tamuri', '', 'Tamuri', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(204, 'Miguel', 'Barajas', '', 'Barajas', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(205, 'Julie', 'Young', '', 'Young2', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(206, 'Brydey', 'Walker', '', 'Walker', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(209, 'Fr?d?rique ', 'Citeaux', '', 'Citeaux', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(211, 'Mike', 'Gao', '', 'Gao', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(216, 'Eduardo ', 'Saavedra', '', 'Saavedra', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(219, 'Mary', 'Young', '', 'Young3', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(223, 'Horst ', 'Kloss', '', 'Kloss', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(227, 'Palle', 'Ibsen', '', 'Ibsen', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(233, 'Jean ', 'Fresni?re', '', 'Fresni?re', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(237, 'Alejandra ', 'Camino', '', 'Camino', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(239, 'Valarie', 'Thompson', '', 'Thompson2', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(240, 'Helen ', 'Bennett', '', 'Bennett', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(242, 'Annette ', 'Roulet', '', 'Roulet', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(247, 'Renate ', 'Messner', '', 'Messner', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(249, 'Paolo ', 'Accorti', '', 'Accorti', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(250, 'Daniel', 'Da Silva', '', 'Da Silva', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(256, 'Daniel ', 'Tonini', '', 'Tonini', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(259, 'Henriette ', 'Pfalzheim', '', 'Pfalzheim', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(260, 'Elizabeth ', 'Lincoln', '', 'Lincoln', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(273, 'Peter ', 'Franken', '', 'Franken', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(276, 'Anna', 'O\'Hara', '', 'O\'Hara', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(278, 'Giovanni ', 'Rovelli', '', 'Rovelli', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(282, 'Adrian', 'Huxley', '', 'Huxley', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(286, 'Marta', 'Hernandez', '', 'Hernandez3', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(293, 'Ed', 'Harrison', '', 'Harrison', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(298, 'Mihael', 'Holz', '', 'Holz', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(299, 'Jan', 'Klaeboe', '', 'Klaeboe', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(303, 'Bradley', 'Schuyler', '', 'Schuyler', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(307, 'Mel', 'Andersen', '', 'Andersen', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(311, 'Pirkko', 'Koskitalo', '', 'Koskitalo', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(314, 'Catherine ', 'Dewey', '', 'Dewey', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(319, 'Steve', 'Frick', '', 'Frick2', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(320, 'Wing', 'Huang', '', 'Huang', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(321, 'Julie', 'Brown', '', 'Brown', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(323, 'Mike', 'Graham', '', 'Graham', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(324, 'Ann ', 'Brown', '', 'Brown2', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(328, 'William', 'Brown', '', 'Brown3', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(333, 'Ben', 'Calaghan', '', 'Calaghan', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(334, 'Kalle', 'Suominen', '', 'Suominen', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(335, 'Philip ', 'Cramer', '', 'Cramer', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(339, 'Francisca', 'Cervantes', '', 'Cervantes', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(344, 'Jesus', 'Fernandez', '', 'Fernandez', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(347, 'Brian', 'Chandler', '', 'Chandler', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(348, 'Patricia ', 'McKenna', '', 'McKenna', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(350, 'Laurence ', 'Lebihan', '', 'Lebihan', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(353, 'Paul ', 'Henriot', '', 'Henriot', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(356, 'Armand', 'Kuger', '', 'Kuger', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(357, 'Wales', 'MacKinlay', '', 'MacKinlay', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(361, 'Karin', 'Josephs', '', 'Josephs', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(362, 'Juri', 'Yoshido', '', 'Yoshido', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(363, 'Dorothy', 'Young', '', 'Young4', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(369, 'Lino ', 'Rodriguez', '', 'Rodriguez', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(376, 'Braun', 'Urs', '', 'Urs', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(379, 'Allen', 'Nelson', '', 'Nelson2', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(381, 'Pascale ', 'Cartrain', '', 'Cartrain', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(382, 'Georg ', 'Pipps', '', 'Pipps', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(385, 'Arnold', 'Cruz', '', 'Cruz', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(386, 'Maurizio ', 'Moroni', '', 'Moroni', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(398, 'Akiko', 'Shimamura', '', 'Shimamura', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(406, 'Dominique', 'Perrier', '', 'Perrier', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(409, 'Rita ', 'M?ller', '', 'M?ller', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(412, 'Sarah', 'McRoy', '', 'McRoy', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(415, 'Michael', 'Donnermeyer', '', 'Donnermeyer', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(424, 'Maria', 'Hernandez', '', 'Hernandez2', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(443, 'Alexander ', 'Feuer', '', 'Feuer', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(447, 'Dan', 'Lewis', '', 'Lewis', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(448, 'Martha', 'Larsson', '', 'Larsson', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(450, 'Sue', 'Frick', '', 'Frick3', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(452, 'Roland ', 'Mendel', '', 'Mendel', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(455, 'Leslie', 'Murphy', '', 'Murphy2', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(456, 'Yu', 'Choi', '', 'Choi', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(458, 'Mart?n ', 'Sommer', '', 'Sommer', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(459, 'Sven ', 'Ottlieb', '', 'Ottlieb', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(462, 'Violeta', 'Benitez', '', 'Benitez', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(465, 'Carmen', 'Anton', '', 'Anton', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(471, 'Sean', 'Clenahan', '', 'Clenahan', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(473, 'Franco', 'Ricotti', '', 'Ricotti', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(475, 'Steve', 'Thompson', '', 'Thompson3', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(477, 'Hanna ', 'Moos', '', 'Moos', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(480, 'Alexander ', 'Semenov', '', 'Semenov', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(481, 'Raanan', 'Altagar,G M', '', 'Altagar,G M', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(484, 'Jos? Pedro ', 'Roel', '', 'Roel', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(486, 'Rosa', 'Salazar', '', 'Salazar', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(487, 'Sue', 'Taylor', '', 'Taylor2', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(489, 'Thomas ', 'Smith', '', 'Smith', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(495, 'Valarie', 'Franco', '', 'Franco2', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(496, 'Tony', 'Snowden', '', 'Snowden', '202cb962ac59075b964b07152d234b70', 'S', NULL),
(497, 'SOCIAL11', 'SOCIAL11', 'SOCIAL11', 'social11', '666df04c9bd0876b0f36943d75983161', 'S', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ficheros`
--
ALTER TABLE `ficheros`
  ADD PRIMARY KEY (`id_Fichero`),
  ADD KEY `fk_ficheros_usuarios1_idx` (`id_Usuario`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id_Opcion`);

--
-- Indexes for table `permisorol`
--
ALTER TABLE `permisorol`
  ADD PRIMARY KEY (`id_Permiso`,`id_Rol`),
  ADD KEY `fk_permisos_has_roles_roles1_idx` (`id_Rol`),
  ADD KEY `fk_permisos_has_roles_permisos1_idx` (`id_Permiso`);

--
-- Indexes for table `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id_Permiso`);

--
-- Indexes for table `permisousuario`
--
ALTER TABLE `permisousuario`
  ADD PRIMARY KEY (`id_Usuario`,`id_Permiso`),
  ADD KEY `fk_usuarios_has_permisos_permisos1_idx` (`id_Permiso`),
  ADD KEY `fk_usuarios_has_permisos_usuarios_idx` (`id_Usuario`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_Rol`);

--
-- Indexes for table `rolusuario`
--
ALTER TABLE `rolusuario`
  ADD PRIMARY KEY (`id_Rol`,`id_Usuario`),
  ADD KEY `fk_usuarios_has_roles_roles1_idx` (`id_Rol`),
  ADD KEY `fk_usuarios_has_roles_usuarios1_idx` (`id_Usuario`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_Usuario`),
  ADD UNIQUE KEY `login_UNIQUE` (`login`),
  ADD KEY `fk_usuarios_ficheros1_idx` (`foto_de_Perfil`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ficheros`
--
ALTER TABLE `ficheros`
  MODIFY `id_Fichero` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id_Opcion` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id_Permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id_Rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=498;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `ficheros`
--
ALTER TABLE `ficheros`
  ADD CONSTRAINT `fk_ficheros_usuarios1` FOREIGN KEY (`id_Usuario`) REFERENCES `usuarios` (`id_Usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `permisorol`
--
ALTER TABLE `permisorol`
  ADD CONSTRAINT `fk_permisos_has_roles_permisos1` FOREIGN KEY (`id_Permiso`) REFERENCES `permisos` (`id_Permiso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_permisos_has_roles_roles1` FOREIGN KEY (`id_Rol`) REFERENCES `roles` (`id_Rol`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `permisousuario`
--
ALTER TABLE `permisousuario`
  ADD CONSTRAINT `fk_usuarios_has_permisos_permisos1` FOREIGN KEY (`id_Permiso`) REFERENCES `permisos` (`id_Permiso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuarios_has_permisos_usuarios` FOREIGN KEY (`id_Usuario`) REFERENCES `usuarios` (`id_Usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `rolusuario`
--
ALTER TABLE `rolusuario`
  ADD CONSTRAINT `fk_usuarios_has_roles_roles1` FOREIGN KEY (`id_Rol`) REFERENCES `roles` (`id_Rol`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuarios_has_roles_usuarios1` FOREIGN KEY (`id_Usuario`) REFERENCES `usuarios` (`id_Usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_ficheros1` FOREIGN KEY (`foto_de_Perfil`) REFERENCES `ficheros` (`id_Fichero`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
