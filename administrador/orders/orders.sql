-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-04-2020 a las 18:14:45
-- Versión del servidor: 10.4.8-MariaDB
-- Versión de PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tuto_orders`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `orders`
--

INSERT INTO `orders` (`id`, `name`, `location`, `date`, `status`, `total`) VALUES
(1, 'Leanne Graham', 'Berlin', '2020-04-24 10:00:00', 'Entregado', 9.99),
(2, 'Ervin Howell', 'Berlin', '2020-04-24 10:00:00', 'Entregado', 9.99),
(3, 'Clementine Bauch', 'Berlin', '2020-04-24 10:00:00', 'Entregado', 9.99),
(4, 'Patricia Lebsack', 'Berlin', '2020-04-24 10:00:00', 'Entregado', 9.99),
(5, 'Chelsey Dietrich', 'Berlin', '2020-04-24 10:00:00', 'Entregado', 9.99),
(6, 'Mrs. Dennis Schulist', 'Berlin', '2020-04-24 10:00:00', 'Entregado', 9.99),
(7, 'Kurtis Weissnat', 'Berlin', '2020-04-24 10:00:00', 'Entregado', 9.99),
(8, 'Nicholas Runolfsdottir V', 'Berlin', '2020-04-24 10:00:00', 'Entregado', 9.99),
(9, 'Glenna Reichert', 'Berlin', '2020-04-24 10:00:00', 'Entregado', 9.99),
(10, 'Clementina DuBuque', 'Berlin', '2020-04-24 10:00:00', 'Entregado', 9.99),
(11, 'Leanne Graham', 'London', '2020-04-24 10:00:00', 'Enviada', 12.99),
(12, 'Ervin Howell', 'London', '2020-04-24 10:00:00', 'Enviada', 12.99),
(13, 'Clementine Bauch', 'London', '2020-04-24 10:00:00', 'Enviada', 12.99),
(14, 'Patricia Lebsack', 'London', '2020-04-24 10:00:00', 'Enviada', 12.99),
(15, 'Chelsey Dietrich', 'London', '2020-04-24 10:00:00', 'Enviada', 12.99),
(16, 'Mrs. Dennis Schulist', 'London', '2020-04-24 10:00:00', 'Enviada', 12.99),
(17, 'Kurtis Weissnat', 'London', '2020-04-24 10:00:00', 'Enviada', 12.99),
(18, 'Nicholas Runolfsdottir V', 'London', '2020-04-24 10:00:00', 'Enviada', 12.99),
(19, 'Glenna Reichert', 'London', '2020-04-24 10:00:00', 'Enviada', 12.99),
(20, 'Clementina DuBuque', 'London', '2020-04-24 10:00:00', 'Enviada', 12.99),
(21, 'Leanne Graham', 'Madrid', '2020-04-24 10:00:00', 'Pendiente', 29.99),
(22, 'Ervin Howell', 'Madrid', '2020-04-24 10:00:00', 'Pendiente', 29.99),
(23, 'Clementine Bauch', 'Madrid', '2020-04-24 10:00:00', 'Pendiente', 29.99),
(24, 'Patricia Lebsack', 'Madrid', '2020-04-24 10:00:00', 'Pendiente', 29.99),
(25, 'Chelsey Dietrich', 'Madrid', '2020-04-24 10:00:00', 'Pendiente', 29.99),
(26, 'Mrs. Dennis Schulist', 'Madrid', '2020-04-24 10:00:00', 'Pendiente', 29.99),
(27, 'Kurtis Weissnat', 'Madrid', '2020-04-24 10:00:00', 'Pendiente', 29.99),
(28, 'Nicholas Runolfsdottir V', 'Madrid', '2020-04-24 10:00:00', 'Pendiente', 29.99),
(29, 'Glenna Reichert', 'Madrid', '2020-04-24 10:00:00', 'Pendiente', 29.99),
(30, 'Clementina DuBuque', 'Madrid', '2020-04-24 10:00:00', 'Pendiente', 29.99),
(31, 'Leanne Graham', 'Paris', '2020-04-24 10:00:00', 'Cancelado', 4.99),
(32, 'Ervin Howell', 'Paris', '2020-04-24 10:00:00', 'Cancelado', 4.99),
(33, 'Clementine Bauch', 'Paris', '2020-04-24 10:00:00', 'Cancelado', 4.99),
(34, 'Patricia Lebsack', 'Paris', '2020-04-24 10:00:00', 'Cancelado', 4.99),
(35, 'Chelsey Dietrich', 'Paris', '2020-04-24 10:00:00', 'Cancelado', 4.99),
(36, 'Mrs. Dennis Schulist', 'Paris', '2020-04-24 10:00:00', 'Cancelado', 4.99),
(37, 'Kurtis Weissnat', 'Paris', '2020-04-24 10:00:00', 'Cancelado', 4.99),
(38, 'Nicholas Runolfsdottir V', 'Paris', '2020-04-24 10:00:00', 'Cancelado', 4.99),
(39, 'Glenna Reichert', 'Paris', '2020-04-24 10:00:00', 'Cancelado', 4.99),
(40, 'Clementina DuBuque', 'Paris', '2020-04-24 10:00:00', 'Cancelado', 4.99);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
