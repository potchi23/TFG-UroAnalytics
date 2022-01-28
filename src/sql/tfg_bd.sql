-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2022 at 08:55 AM
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
(9, 'Pepe', 'Manolito', 'Pepito', 'pepe@ucm.es', '$2y$10$LzKnjC44vrYBkn0H7gQ4Auh', 'user', 1),
(10, 'Richard', 'Correa', 'Mercado', 'admin@admin.es', '$2y$10$.VNItdxIcM32r.pnGBuYy.p', 'user', 0),
(21, 'Richard Junior', 'Correa', 'Mercado', 'richardcorrea306@gmail.com', '$2y$10$YdL4P7d9lNfzzgdY.xFdRuTXwRujGzWqEm4NrqIQbSUD4CCahENLu', 'user', 0),
(69, 'Richard', 'Test', 'werwerw', 'richardcorrea2306@yahoo.com', '$2y$10$qdwFfpCE1SxLZGzh9GazoOJwyvwaMbouXSDUUmkn.GOmlWzhUV1Em', 'user', 0),
(74, 'Pedro', 'Pedro', 'Pedro', 'pedro@ucm.es', '$2b$12$sGzLdDmlOD8Cso0ywpcVIO.kbQDPtwYIwm5YxwJcD3dPqVITMihi6', 'admin', 1),
(78, 'User', 'No Admin', 'Usuario', 'user@ucm.es', '$2b$12$u.WkBMVeW6PArHAuZlrXMO1HzA/3Ix7t/iQkvVpcq3ZaX4jgoM09S', 'user', 0),
(80, 'test', 'test', 'test', 'test@test.es', '$2b$12$PuwM7.ZO/zV3w7lLY0D9Z.vrcmhytaHW2zBaU0MK02F4e7ddLlGO2', 'admin', 0),
(84, 'popo', 'popo', 'popo', 'popo@popo.es', '$2b$12$Y5z.sWLYUHUKPl/5xQsOreh3kQ2TZ/pP8oisp6WEilDLEBbwl.E8K', 'user', 0),
(86, 'Richard', 'Correa', 'Mercado', 'richard@correa.es', '$2b$12$rWeWvdsnUNs16PmZog816uc4GUstlEvXwx2Vrc.oabj60JgLGYO9q', 'user', 0),
(87, 'Prueba', 'Prueba', 'Prueba', 'prueba@prueba.es', '$2b$12$qUhARH/DhNW0xjKEdVpYYOtvDxvdYIG8HXY3TQealJ5LTtR5UcKKO', 'user', 0),
(89, 'marcos', 'marcos', 'marcos', 'marcos@marcos.es', '$2b$12$.Aoqh2u3MI1rnLndZGY7OOPJV24tsEi.vrvpa3msuhF/q1GnbawJm', 'user', 1),
(90, 'fdsfsdf', 'dfsdfsd', 'sdfsdf', 'dfds@fdfeee.es', '$2b$12$YbkxEcH1d/cvMvs2bXM/8OJDVBBavBNo4/DhqookYuECrCteD6X8G', 'user', 1),
(92, 'sdfsdfds', 'dsfsdfsdf', 'dsfsdfsdf', 'fsdfsdfsdf@fsdf.com', '$2b$12$9UycJm/ZJ4Y9Qs8QNw8gv.Yk.fC4126fkmqux3LTiQqXZTi03lIpS', 'user', 1),
(93, 'pepe', 'pepe', 'pepe', 'pepe@pepe.es', '$2b$12$M3jXqkmvxqNQXdwpE.dhcOxkQ9FhBOXNHumT5zuY56ekaZ0lLvCVq', 'user', 1),
(94, 'pepepe', 'pepepep', 'gdgdfgfdg', 'richardcorrea2306@gmail.com', '$2b$12$019D4PEgaYu/0I5oj6CcBO/i8/w9bDLn18.SqXabYkY4ScJ7u4j2S', 'user', 0),
(95, 'fsdfsd', 'sdfsdf', 'sdfsdf', 'erwrwer@sdf.es', '$2b$12$8VrxuqS.9910xn1MzJSU1.1HL3VZrmyDTa01hzLx.Do.4Uu/ifxaC', 'user', 0),
(96, 'dfsfsd', 'sdfsdf', 'sdfsdfsdf', 'richardcorrea2306@gmail.co', '$2b$12$kErLjcwr6XzI/vRzDy2X6eiHTF761.7vf3a126AOq9uY01kaxl.am', 'user', 0),
(97, 'werwerw', 'erwerwer', 'werwer', 'richarrea2306@gmail.com', '$2b$12$gj7yjMDS.MiT8YErO3TSXOBocH83iiFPqFt8RXQqEgJMubQSsofye', 'user', 0),
(98, 'wrwer', 'werwe', 'werwer', 'richardcorrea2306+hola@gmail.com', '$2b$12$t0rGF/fG4SdDo1dynvNOP.pMujp71ebz816jfssb1saPNYVvL1kri', 'user', 0),
(99, 'werwerw', 'werwerewwer', 'werwerwerwerwer', 'lala@lala.com', '$2b$12$9pLMmnNH1r09QgZ5qa0iMety1hEySxmyrvbB.k7cpg75uRPBhE2Xe', 'user', 0),
(100, 'werwerwe', 'fhsjkfh', 'kjhrw', 'teew@ff.co', '$2b$12$57qfRW/YrHXbcgJV2SZjJ.F0f5PG6PWT4YZidyLakS4tu8d7JO1Du', 'user', 0),
(101, 'qweqwe', 'qwewqewq', 'qweqwewqe', 'ppoporwer@ede.cl', '$2b$12$jg7n7GJ8PigdtbG/WEGDXu9wnGJdQ2vWUtzzeRGFMMaz9kl2SGM6S', 'user', 0),
(102, 'ertert', 'ertert', 'ertr', 'richardcorrea@gmail.com', '$2b$12$3hwukZya0s5cjkgI6Y/voOeDPd91CYOOapNL1HtF8dlQAZVnufY.m', 'user', 1);

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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

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
