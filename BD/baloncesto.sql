-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-11-2020 a las 00:46:58
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `baloncesto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `arbitros`
--

CREATE TABLE `arbitros` (
  `Identificacion` int(12) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Apellido` varchar(21) NOT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Imagen` varchar(50) DEFAULT NULL,
  `TipoArbitro` varchar(13) DEFAULT NULL,
  `Direccion` varchar(100) DEFAULT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `Disponible` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `arbitros`
--

INSERT INTO `arbitros` (`Identificacion`, `Nombre`, `Apellido`, `Email`, `Imagen`, `TipoArbitro`, `Direccion`, `Telefono`, `Disponible`) VALUES
(43588253, 'Astrid ', 'Toro', 'Atoro@gmail.com', NULL, 'principal', 'crra 20 36-87', '9862578', 'Si'),
(98594940, 'Dorian', 'Garcia', 'dor7418@gmail.com', NULL, 'principal', 'crra 80 20-96', '3008795671', 'Si');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `escenarios`
--

CREATE TABLE `escenarios` (
  `Id` int(12) NOT NULL,
  `Nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `Aforo` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `Disponible` tinyint(1) NOT NULL,
  `Techo_movible` tinyint(1) NOT NULL,
  `Observaciones` varchar(500) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `escenarios`
--

INSERT INTO `escenarios` (`Id`, `Nombre`, `direccion`, `Aforo`, `Disponible`, `Techo_movible`, `Observaciones`) VALUES
(6, 'POLIDEPORTIVO DE BELLO', 'CRRA 89 54-63', '600', 0, 1, 'EN PERFECTAS CONDICIONES'),
(7, 'POLIDEPORTIVO DE MANRIQUE', 'CRRA 45 98-36', '900', 0, 1, 'EN BUEN ESTADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `color` varchar(7) DEFAULT NULL,
  `arbitro` int(12) NOT NULL,
  `escenario` int(12) NOT NULL,
  `hora` time NOT NULL DEFAULT current_timestamp(),
  `start` datetime NOT NULL DEFAULT current_timestamp(),
  `end` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `events`
--

INSERT INTO `events` (`id`, `title`, `color`, `arbitro`, `escenario`, `hora`, `start`, `end`) VALUES
(29, 'envigado vs copacabana', NULL, 43588253, 7, '10:00:00', '2020-11-01 00:00:00', '2020-11-01 21:02:55');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `arbitros`
--
ALTER TABLE `arbitros`
  ADD PRIMARY KEY (`Identificacion`),
  ADD UNIQUE KEY `Identificacion` (`Identificacion`);

--
-- Indices de la tabla `escenarios`
--
ALTER TABLE `escenarios`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `arbitro` (`arbitro`),
  ADD KEY `escenario` (`escenario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `escenarios`
--
ALTER TABLE `escenarios`
  MODIFY `Id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`arbitro`) REFERENCES `arbitros` (`Identificacion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `events_ibfk_2` FOREIGN KEY (`escenario`) REFERENCES `escenarios` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
