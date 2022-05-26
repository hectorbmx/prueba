-- phpMyAdmin SQL Dump
-- version 2.11.11
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 18-11-2017 a las 15:44:26
-- Versión del servidor: 5.0.91
-- Versión de PHP: 5.2.14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `paises`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista_paises`
--

CREATE TABLE IF NOT EXISTS `lista_paises` (
  `pais_id` int(11) NOT NULL auto_increment,
  `pais_nombre` varchar(150) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`pais_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=45 ;

--
-- Volcar la base de datos para la tabla `lista_paises`
--

INSERT INTO `lista_paises` (`pais_id`, `pais_nombre`) VALUES
(1, 'china'),
(2, 'united states'),
(3, 'india'),
(4, 'japan'),
(5, 'brazil'),
(6, 'russia'),
(7, 'germany'),
(8, 'nigeria'),
(9, 'united kingdom'),
(10, 'france'),
(11, 'mexico'),
(12, 'south korea'),
(13, 'indonesia'),
(14, 'philippines'),
(15, 'egypt'),
(16, 'vietnam'),
(17, 'turkey'),
(18, 'italy'),
(19, 'spain'),
(20, 'canada'),
(21, 'poland'),
(22, 'argentina'),
(23, 'colombia'),
(24, 'iran'),
(25, 'south africa'),
(26, 'malaysia'),
(27, 'pakistan'),
(28, 'australia'),
(29, 'thailand'),
(30, 'morocco'),
(31, 'taiwan'),
(32, 'netherlands'),
(33, 'ukraine'),
(34, 'saudi arabia'),
(35, 'kenya'),
(36, 'venezuela'),
(37, 'peru'),
(38, 'romania'),
(39, 'chile'),
(40, 'uzbekistan'),
(41, 'bangladesh'),
(42, 'kazakhstan'),
(43, 'belgium'),
(44, 'sweden');
