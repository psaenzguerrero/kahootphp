-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-12-2024 a las 11:02:21
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `kahoot`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `cod` int(11) NOT NULL,
  `pregunta` varchar(500) NOT NULL,
  `correcta` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`cod`, `pregunta`, `correcta`) VALUES
(1, '¿De que color es el oso polar?', 'blanco'),
(2, '¿Cuál es el resultado de 5 x 5?', '25'),
(3, '¿Dónde esta Murcia?', 'No existe'),
(4, '¿Cuándo se descubrió américa?', '1492'),
(5, '¿Quién descubrió américa?', 'cristobal colon'),
(6, '¿Qué es inmutable aparte de la muerte?', 'hacienda'),
(7, '¿Cuál es el mejor país?', 'espana'),
(8, '¿A quien odias mas a los nini o a los franceses?', 'a los franceses'),
(9, '¿Cuantos topitos suman 100 topitos mas 2 topitos? ', '102 topitos'),
(10, '¿Cuál es la mejor profesora del curso?', 'erica, chari');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `nombreUsuario` varchar(200) NOT NULL,
  `tiempoInicio` timestamp NOT NULL DEFAULT current_timestamp(),
  `tiempoFinal` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`nombreUsuario`, `tiempoInicio`, `tiempoFinal`) VALUES
('p1', '2024-12-13 09:15:09', '2024-12-13 09:15:47'),
('p2', '2024-12-13 09:15:55', '2024-12-13 09:16:25'),
('p3', '2024-12-13 09:16:59', '2024-12-13 09:16:59'),
('p4', '2024-12-13 09:20:31', '2024-12-13 09:20:31'),
('p5', '2024-12-13 09:52:27', '2024-12-13 09:52:27'),
('p6', '2024-12-13 09:53:25', '2024-12-13 09:53:25');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`cod`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`nombreUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
