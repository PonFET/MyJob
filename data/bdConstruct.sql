-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 12-11-2021 a las 21:18:47
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accounts`
--

DROP TABLE IF EXISTS `accounts`;
CREATE TABLE IF NOT EXISTS `accounts` (
  `accountId` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `password` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `privilegeId` int(11) NOT NULL,
  PRIMARY KEY (`accountId`),
  KEY `prvilegeId` (`privilegeId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `careers`
--

DROP TABLE IF EXISTS `careers`;
CREATE TABLE IF NOT EXISTS `careers` (
  `careerId` int(11) NOT NULL,
  `description` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `active` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`careerId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `companies`
--

DROP TABLE IF EXISTS `companies`;
CREATE TABLE IF NOT EXISTS `companies` (
  `companyId` int(11) NOT NULL AUTO_INCREMENT,
  `companyName` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `location` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `description` varchar(500) COLLATE latin1_spanish_ci NOT NULL,
  `email` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `phoneNumber` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `cuit` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`companyId`),
  KEY `companyId` (`companyId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `joboffers`
--

DROP TABLE IF EXISTS `joboffers`;
CREATE TABLE IF NOT EXISTS `joboffers` (
  `offerId` int(11) NOT NULL AUTO_INCREMENT,
  `companyId` int(11) NOT NULL,
  `offerDescription` varchar(1000) COLLATE latin1_spanish_ci NOT NULL,
  `startDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `endDate` datetime DEFAULT NULL,
  `offerImg` varchar(1000),
  `enable` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`offerId`),
  KEY `offerId` (`offerId`,`companyId`),
  KEY `offerId_2` (`offerId`,`companyId`),
  KEY `companyId` (`companyId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobposition`
--

DROP TABLE IF EXISTS `jobposition`;
CREATE TABLE IF NOT EXISTS `jobposition` (
  `jobPositionId` int(11) NOT NULL,
  `careerId` int(11) NOT NULL,
  `description` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`jobPositionId`),
  KEY `jobPositionId` (`jobPositionId`,`careerId`),
  KEY `careerId` (`careerId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobxacc`
--

DROP TABLE IF EXISTS `jobxacc`;
CREATE TABLE IF NOT EXISTS `jobxacc` (
  `offerId` int(11) NOT NULL,
  `accountId` int(11) NOT NULL,
  KEY `offerId` (`offerId`,`accountId`),
  KEY `accountId` (`accountId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `offersxposition`
--

DROP TABLE IF EXISTS `offersxposition`;
CREATE TABLE IF NOT EXISTS `offersxposition` (
  `offerId` int(11) NOT NULL,
  `jobPositionId` int(11) NOT NULL,
  KEY `offerId` (`offerId`,`jobPositionId`),
  KEY `jobPositionId` (`jobPositionId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `privileges`
--

DROP TABLE IF EXISTS `privileges`;
CREATE TABLE IF NOT EXISTS `privileges` (
  `privilegeId` int(11) NOT NULL AUTO_INCREMENT,
  `privilegeName` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `privilegeDescription` varchar(300) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`privilegeId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `studentId` int(11) NOT NULL,
  `careerId` int(11) NOT NULL,
  `firstName` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `lastName` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `dni` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `fileNumber` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `gender` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `birthdate` date NOT NULL,
  `email` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `phoneNumber` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `active` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`studentId`),
  KEY `careerId` (`careerId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `accounts_ibfk_1` FOREIGN KEY (`privilegeId`) REFERENCES `privileges` (`privilegeId`);

--
-- Filtros para la tabla `joboffers`
--
ALTER TABLE `joboffers`
  ADD CONSTRAINT `joboffers_ibfk_1` FOREIGN KEY (`companyId`) REFERENCES `companies` (`companyId`);

--
-- Filtros para la tabla `jobposition`
--
ALTER TABLE `jobposition`
  ADD CONSTRAINT `jobposition_ibfk_1` FOREIGN KEY (`careerId`) REFERENCES `careers` (`careerId`);

--
-- Filtros para la tabla `jobxacc`
--
ALTER TABLE `jobxacc`
  ADD CONSTRAINT `jobxacc_ibfk_1` FOREIGN KEY (`offerId`) REFERENCES `joboffers` (`offerId`),
  ADD CONSTRAINT `jobxacc_ibfk_2` FOREIGN KEY (`accountId`) REFERENCES `accounts` (`accountId`);

--
-- Filtros para la tabla `offersxposition`
--
ALTER TABLE `offersxposition`
  ADD CONSTRAINT `offersxposition_ibfk_1` FOREIGN KEY (`offerId`) REFERENCES `joboffers` (`offerId`),
  ADD CONSTRAINT `offersxposition_ibfk_2` FOREIGN KEY (`jobPositionId`) REFERENCES `jobposition` (`jobPositionId`);

--
-- Filtros para la tabla `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`careerId`) REFERENCES `careers` (`careerId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
