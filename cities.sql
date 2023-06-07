-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 07, 2023 at 08:43 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Goa`
--

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `city` varchar(50) DEFAULT NULL,
  `mapusa` int(11) DEFAULT NULL,
  `bicholim` int(11) DEFAULT NULL,
  `usgao` int(11) DEFAULT NULL,
  `valpoi` int(11) DEFAULT NULL,
  `panjim` int(11) DEFAULT NULL,
  `vasco` int(11) DEFAULT NULL,
  `ponda` int(11) DEFAULT NULL,
  `benaulim` int(11) DEFAULT NULL,
  `margao` int(11) DEFAULT NULL,
  `sanvordem` int(11) DEFAULT NULL,
  `sanguem` int(11) DEFAULT NULL,
  `chinchinim` int(11) DEFAULT NULL,
  `cancona` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`city`, `mapusa`, `bicholim`, `usgao`, `valpoi`, `panjim`, `vasco`, `ponda`, `benaulim`, `margao`, `sanvordem`, `sanguem`, `chinchinim`, `cancona`) VALUES
('mapusa', 0, 20, 0, 0, 14, 0, 0, 0, 0, 0, 0, 0, 0),
('bicholim', 20, 0, 26, 0, 28, 51, 0, 0, 0, 0, 0, 0, 0),
('usgao', 0, 26, 0, 17, 0, 0, 11, 0, 0, 0, 0, 0, 0),
('valpoi', 0, 0, 17, 0, 0, 0, 27, 0, 0, 0, 0, 0, 0),
('panjim', 14, 28, 0, 0, 0, 29, 0, 0, 0, 0, 0, 0, 0),
('vasco', 0, 51, 0, 0, 29, 0, 34, 33, 0, 0, 0, 0, 0),
('ponda', 0, 0, 11, 27, 0, 34, 0, 23, 18, 28, 0, 0, 0),
('benaulim', 0, 0, 0, 0, 0, 33, 23, 0, 9, 0, 0, 7, 0),
('margao', 0, 0, 0, 0, 0, 0, 18, 9, 0, 19, 0, 10, 0),
('sanvordem', 0, 0, 0, 0, 0, 0, 28, 0, 19, 0, 8, 0, 0),
('sanguem', 0, 0, 0, 0, 0, 0, 0, 0, 0, 8, 0, 24, 43),
('chinchinim', 0, 0, 0, 0, 0, 0, 0, 7, 10, 0, 24, 0, 30),
('cancona', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 43, 30, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
