-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2021 at 02:31 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tfg_bd`
--

-- --------------------------------------------------------

--
-- Table structure for table `pacientes`
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
-- Table structure for table `prediciones`
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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `surname_1` varchar(20) NOT NULL,
  `surname_2` varchar(20) NOT NULL DEFAULT '""',
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(5) NOT NULL DEFAULT 'user',
  `accepted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `surname_1`, `surname_2`, `email`, `password`, `type`, `accepted`) VALUES
(9, 'Pepe', 'Manolito', 'Pepito', 'pepe@ucm.es', '$2y$10$LzKnjC44vrYBkn0H7gQ4Auh', 'user', 0),
(10, 'Richard', 'Correa', 'Mercado', 'admin@admin.es', '$2y$10$.VNItdxIcM32r.pnGBuYy.p', 'user', 0),
(19, 'Test2', 'Test', 'Valido', 'test@valido.com', '$2y$10$wBpiPcQm5GGR5Ua4wcFEyeyVxNaz5.rxiokYTdWxTo4gjqe3q/I1W', 'user', 0),
(21, 'Richard Junior', 'Correa', 'Mercado', 'richardcorrea306@gmail.com', '$2y$10$YdL4P7d9lNfzzgdY.xFdRuTXwRujGzWqEm4NrqIQbSUD4CCahENLu', 'user', 0),
(25, 'Richard Junior d', 'Correa', 'Mercado', 'rirea2306@gmail.com', '$2y$10$PQ.nUBVdwJtRHxvJRb2BruT8Yu00b7qMsZ1WXneNSlLmUBH0dnkke', 'user', 0),
(27, 'Richard Junior d', 'Correa', 'Mercado', 'richardca2306@gmail.com', '$2y$10$9pXPTGtykPA..BPgORWj4uhlgqkI6pQA7FgQfIDxRxzEtxBvyyOie', 'user', 0),
(45, 'Richard', 'Test', 'werwer', 'ricrea2306@gmail.com', '$2y$10$eCqdPw7X9xFpLL8aNTqUO.B5yVMWQQnsJg5oqmn7vrrDYxfmIP5cO', 'user', 0),
(47, 'Richard', 'Test', 'Test', 'richardcorrea2306@gmail.com', '$2y$10$TrIKileYQgwiTUBwU0YQf..5D2aYIeXFfm7qUCIeSv8SqjGybpPb.', 'user', 0),
(68, 'Richard', 'Test', '', 'richard@gmail.com', '$2y$10$HNxIxvTcmBe/H4ZRkpMJMeTg0Bk2pwQUrjOm5TyN7v5yJtcQuKhU6', 'user', 1),
(69, 'Richard', 'Test', 'werwerw', 'richardcorrea2306@yahoo.com', '$2y$10$qdwFfpCE1SxLZGzh9GazoOJwyvwaMbouXSDUUmkn.GOmlWzhUV1Em', 'user', 0),
(73, 'Richard', 'Test', '', 'richa@gmail.com', '$2y$10$qjYcrY7ve.2rOFz22d3UoO7PAdcFbZX5bieNSHRgdpMKjsu2aT0ve', 'user', 0),
(74, 'Pedro', 'Pedro', 'Pedro', 'pedro@ucm.es', '$2b$12$.9Woy37gzrBkG/CCTE/erekEZ1VS177TDI.tyMdh9fEQn4dJbESx2', 'admin', 1),
(78, 'User', 'No Admin', 'admin', 'user@ucm.es', '$2b$12$X6Z0KKFDnqsRAYLPdkzJvOxrF0fsu635LBUMol.l/DFOGWtesqNjO', 'user', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id_paciente`),
  ADD KEY `id_doctor` (`id_doctor`);

--
-- Indexes for table `prediciones`
--
ALTER TABLE `prediciones`
  ADD PRIMARY KEY (`id_predic`),
  ADD KEY `id_paciente` (`id_paciente`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pacientes`
--
ALTER TABLE `pacientes`
  ADD CONSTRAINT `fk_pacientes` FOREIGN KEY (`id_doctor`) REFERENCES `users` (`id`);

--
-- Constraints for table `prediciones`
--
ALTER TABLE `prediciones`
  ADD CONSTRAINT `fk_predicciones` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id_paciente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
