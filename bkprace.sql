-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2022 at 09:22 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bkprace`
--

-- --------------------------------------------------------

--
-- Table structure for table `adresa`
--

CREATE TABLE `adresa` (
  `id` int(11) NOT NULL,
  `mesto` varchar(30) NOT NULL,
  `ulice` varchar(30) DEFAULT NULL,
  `CP` int(3) NOT NULL,
  `PSC` int(5) NOT NULL
) ;

--
-- Dumping data for table `adresa`
--

INSERT INTO `adresa` (`id`, `mesto`, `ulice`, `CP`, `PSC`) VALUES
(1, 'Sedlejov', '', 12, 58862),
(2, 'Jihlava', '', 45, 58862),
(3, 'Jihlava', 'Legionářů', 45, 58862),
(4, 'Sedlejov', '', 13, 58862),
(6, 'Sedlejov', '', 56, 58862);

-- --------------------------------------------------------

--
-- Table structure for table `objednavka`
--

CREATE TABLE `objednavka` (
  `id` int(11) NOT NULL,
  `datum_zac` date NOT NULL,
  `datum_konec` date NOT NULL,
  `zakaznik` int(11) DEFAULT NULL,
  `cena` double(10,3) NOT NULL,
  `dph` int(11) NOT NULL,
  `stav` int(11) DEFAULT NULL,
  `heslo` varchar(150) NOT NULL,
  `pozn1` varchar(70) NOT NULL,
  `pozn2` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `obj_zbo`
--

CREATE TABLE `obj_zbo` (
  `obj_id` int(11) NOT NULL,
  `zbo_id` int(11) NOT NULL,
  `mnozstvi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sklad`
--

CREATE TABLE `sklad` (
  `id` int(11) NOT NULL,
  `nazev` varchar(50) NOT NULL,
  `mnozstvi` int(11) NOT NULL,
  `jednotka` varchar(30) DEFAULT NULL,
  `sercis` bigint(20) DEFAULT NULL,
  `zaruka` int(11) DEFAULT NULL,
  `cena1` double(12,3) NOT NULL,
  `cena2` double(12,3) NOT NULL,
  `datum` date NOT NULL,
  `obchod` varchar(50) DEFAULT NULL,
  `DPH` int(11) DEFAULT NULL,
  `pozn` varchar(70) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sklad`
--

INSERT INTO `sklad` (`id`, `nazev`, `mnozstvi`, `jednotka`, `sercis`, `zaruka`, `cena1`, `cena2`, `datum`, `obchod`, `DPH`, `pozn`) VALUES
(2, 'Baterie Iphone 11', 2, 'ks', 4534553, 11, 1234.000, 4563.000, '2022-09-29', 'shop.cz', 12, ''),
(3, 'Display Iphone SE', 10, 'ks', 111111, 11, 1234.000, 4566.000, '2022-11-28', 'shop.cz', 12, ''),
(4, 'Flex kabel tlačítek', 3, 'ks', 123456, 12, 9999.000, 99999.000, '2022-10-31', 'shop.cz', 15, ''),
(6, 'Geforce GTX 3060', 1, 'ks', 69969, 12, 888.000, 666.000, '2022-11-27', 'shop.cz', 12, 'grafika'),
(7, 'Intel Core i7', 5, 'ks', 777, 42, 4456.000, 8886.000, '2022-11-03', 'neim.cz', 15, 'procak');

-- --------------------------------------------------------

--
-- Table structure for table `stav`
--

CREATE TABLE `stav` (
  `id` int(11) NOT NULL,
  `nazev` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `t_role`
--

CREATE TABLE `t_role` (
  `id` int(11) NOT NULL,
  `nazev` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_role`
--

INSERT INTO `t_role` (`id`, `nazev`) VALUES
(2, 'Administrátor'),
(3, 'Uživatel');

-- --------------------------------------------------------

--
-- Table structure for table `uzivatel`
--

CREATE TABLE `uzivatel` (
  `id` int(11) NOT NULL,
  `jmeno` varchar(30) NOT NULL,
  `login` varchar(40) NOT NULL,
  `heslo` varchar(150) NOT NULL,
  `role` int(11) NOT NULL DEFAULT 3,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `uzivatel`
--

INSERT INTO `uzivatel` (`id`, `jmeno`, `login`, `heslo`, `role`, `email`) VALUES
(1, 'Administátor', 'admin', '7eaf9d7ab9e3fe91c079ef9c6a52702cf6d851ffad4a0d23bd0f7097428496ca', 2, 'admin@uzivatel.cz'),
(2, 'Uživatel', 'user', '48fad24c28a5a5960606fe6f1429090a1f998a29e1ef0e9eccae15d116474678', 3, 'user@uzivatel.cz');

-- --------------------------------------------------------

--
-- Table structure for table `zakaznik`
--

CREATE TABLE `zakaznik` (
  `id` int(11) NOT NULL,
  `jmeno` varchar(30) NOT NULL,
  `prijmeni` varchar(30) NOT NULL,
  `firma` varchar(50) DEFAULT NULL,
  `ICO` int(8) DEFAULT NULL,
  `adr` int(11) DEFAULT NULL,
  `tel` bigint(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pozn` varchar(70) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `zakaznik`
--

INSERT INTO `zakaznik` (`id`, `jmeno`, `prijmeni`, `firma`, `ICO`, `adr`, `tel`, `email`, `pozn`) VALUES
(1, 'Prokop', 'Buben', 'Selitech', 99999999, 1, 984778974, 'testik@testik.cz', ''),
(2, 'Sulik', 'Chuj', 'Sněmovna', 54653051, 3, 984778555, 'joj@trouba.cz', 'joj'),
(3, 'Sulik', 'Sulda', 'Selitech', 0, 4, 984778974, 'testik@testik.cz', ''),
(4, 'Ondřej', 'Trouba', 'Sněmovna', 0, 0, 984778974, 'testik@testik.cz', ''),
(5, 'Prokop', 'Buben', 'Selitech', 99999999, 0, 984778974, 'testik@testik.cz', ''),
(7, 'Prokop', 'Včera Dveře', 'Selitech', 99999999, 6, 984778974, 'testik@testik.cz', ''),
(8, 'Prokop', 'Boček', 'Selitech', 99999999, 0, 984778974, 'testik@testik.cz', ''),
(9, 'Ondra', 'Chuj', 'Sněmovna', 99999999, 4, 984778974, 'testik@testik.cz', 'Pozn');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adresa`
--
ALTER TABLE `adresa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `objednavka`
--
ALTER TABLE `objednavka`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `obj_zbo`
--
ALTER TABLE `obj_zbo`
  ADD KEY `obj_id` (`obj_id`),
  ADD KEY `zbo_id` (`zbo_id`);

--
-- Indexes for table `sklad`
--
ALTER TABLE `sklad`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stav`
--
ALTER TABLE `stav`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_role`
--
ALTER TABLE `t_role`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nazev` (`nazev`);

--
-- Indexes for table `uzivatel`
--
ALTER TABLE `uzivatel`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `uzivatel_1` (`role`);

--
-- Indexes for table `zakaznik`
--
ALTER TABLE `zakaznik`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adresa`
--
ALTER TABLE `adresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `objednavka`
--
ALTER TABLE `objednavka`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sklad`
--
ALTER TABLE `sklad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `t_role`
--
ALTER TABLE `t_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `uzivatel`
--
ALTER TABLE `uzivatel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `zakaznik`
--
ALTER TABLE `zakaznik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `obj_zbo`
--
ALTER TABLE `obj_zbo`
  ADD CONSTRAINT `obj_zbo_ibfk_1` FOREIGN KEY (`obj_id`) REFERENCES `objednavka` (`id`),
  ADD CONSTRAINT `obj_zbo_ibfk_2` FOREIGN KEY (`zbo_id`) REFERENCES `sklad` (`id`);

--
-- Constraints for table `uzivatel`
--
ALTER TABLE `uzivatel`
  ADD CONSTRAINT `uzivatel_1` FOREIGN KEY (`role`) REFERENCES `t_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
