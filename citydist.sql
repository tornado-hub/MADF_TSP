-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2023 at 11:06 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tsp`
--

-- --------------------------------------------------------

--
-- Table structure for table `citydist`
--

CREATE TABLE `citydist` (
  `city` varchar(50) NOT NULL,
  `panaji` int(11) DEFAULT 0,
  `margao` int(11) DEFAULT 0,
  `chennai` int(11) DEFAULT 0,
  `vellore` int(11) DEFAULT 0,
  `trivandrum` int(11) DEFAULT 0,
  `kochi` int(11) DEFAULT 0,
  `bangalore` int(11) DEFAULT 0,
  `mysore` int(11) DEFAULT 0,
  `hyderabad` int(11) DEFAULT 0,
  `vishakhapatnam` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `citydist`
--

INSERT INTO `citydist` (`city`, `panaji`, `margao`, `chennai`, `vellore`, `trivandrum`, `kochi`, `bangalore`, `mysore`, `hyderabad`, `vishakhapatnam`) VALUES
('bangalore', 591, 574, 336, 212, 732, 548, 0, 143, 576, 991),
('chennai', 948, 930, 0, 139, 774, 692, 336, 483, 626, 795),
('hyderabad', 696, 693, 626, 622, 1307, 1123, 576, 724, 0, 618),
('kochi', 1148, 746, 692, 575, 199, 0, 548, 394, 1123, 1432),
('margao', 36, 0, 930, 802, 1310, 746, 574, 703, 693, 1369),
('mysore', 675, 703, 483, 346, 674, 394, 143, 0, 724, 1141),
('panaji', 0, 36, 948, 813, 1327, 1148, 591, 675, 696, 1137),
('trivandrum', 1327, 1310, 774, 760, 0, 199, 732, 674, 1307, 1561),
('vellore', 813, 802, 139, 0, 760, 575, 212, 346, 622, 860),
('vishakhapatnam', 1137, 1369, 795, 860, 1561, 1432, 991, 1141, 618, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `citydist`
--
ALTER TABLE `citydist`
  ADD PRIMARY KEY (`city`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
