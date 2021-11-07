-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 07-11-2021 a las 22:39:28
-- Versión del servidor: 5.7.31
-- Versión de PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `myjob`
--

--
-- Volcado de datos para la tabla `careers`
--

INSERT INTO `careers` (`careerId`, `description`, `active`) VALUES
(1, 'Naval engineering', '1'),
(2, 'Fishing engineering', ''),
(3, 'University technician in programming', '1'),
(4, 'University technician in computer systems', '1'),
(5, 'University technician in textile production', '1'),
(6, 'University technician in administration', '1'),
(7, 'Bachelor in environmental management', ''),
(8, 'University technician in environmental procedures and technologies', '1');

--
-- Volcado de datos para la tabla `jobposition`
--

INSERT INTO `jobposition` (`jobPositionId`, `careerId`, `description`) VALUES
(1, 1, 'Jr naval engineer'),
(2, 1, 'Ssr naval engineer'),
(3, 1, 'Sr naval engineer'),
(4, 2, 'Jr fisheries engineer'),
(5, 2, 'Ssr fisheries engineer'),
(6, 2, 'Sr fisheries engineer'),
(7, 3, 'Java Jr developer'),
(8, 3, 'PHP Jr developer'),
(9, 3, 'Ssr developer'),
(10, 4, 'Full Stack developer'),
(11, 4, 'Sr developer'),
(12, 4, 'Project manager'),
(13, 4, 'Scrum Master'),
(14, 5, 'Jr textile operator'),
(15, 5, 'Textile production assistant manager'),
(16, 5, 'Textile design assistant'),
(17, 5, 'Textile production supervisor'),
(18, 6, 'Head of administration'),
(19, 6, 'Management analyst'),
(20, 6, 'Administration intern'),
(21, 7, 'Environmental management specialist'),
(22, 7, 'Environmental management coordinator'),
(23, 8, 'Received technician');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
