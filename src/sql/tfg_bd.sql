-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-12-2021 a las 17:10:24
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------
--
-- Database: `tfg_db`
--
CREATE DATABASE IF NOT EXISTS `tfg_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `tfg_db`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `id_paciente` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellido1` varchar(20) NOT NULL,
  `apellido2` varchar(20) NOT NULL,
  `patologia` varchar(100) NOT NULL,
  `id_doctor` int(10) UNSIGNED NOT NULL,
  `indices` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prediciones`
--

CREATE TABLE `prediciones` (
  `id_predic` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `id_paciente` int(10) UNSIGNED NOT NULL,
  `indices` varchar(500) NOT NULL,
  `fecha` date NOT NULL,
  `informe` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `surname_1` varchar(20) NOT NULL,
  `surname_2` varchar(20) NOT NULL DEFAULT '""',
  `email` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL,
  `type` varchar(5) NOT NULL DEFAULT 'user',
  `accepted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `surname_1`, `surname_2`, `email`, `password`, `type`, `accepted`) VALUES
(1, 'Richard', 'Correa', 'Mercado', 'admin@ucm.es', 'admin', 'admin', 1),
(9, 'Pepe', 'Manolito', 'Pepito', 'pepe@ucm.es', '$2y$10$LzKnjC44vrYBkn0H7gQ4Auh', 'user', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id_paciente`),
  ADD KEY `id_doctor` (`id_doctor`);

--
-- Indices de la tabla `prediciones`
--
ALTER TABLE `prediciones`
  ADD PRIMARY KEY (`id_predic`),
  ADD KEY `id_paciente` (`id_paciente`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD CONSTRAINT `fk_pacientes` FOREIGN KEY (`id_doctor`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `prediciones`
--
ALTER TABLE `prediciones`
  ADD CONSTRAINT `fk_predicciones` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id_paciente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
