-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2023 at 08:33 PM
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
(2, 'Jihlava', '', 45, 58862),
(6, 'Jihlava', 'U pivovaru', 13, 58601),
(7, 'Sedlejov', '', 128, 58862),
(8, 'Třebíč', 'U polanky', 45, 67401),
(9, 'Sedlejov', '', 123, 58862);

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
(18, 'Display Iphone 7', 1, 'ks', 987654321, 24, 1200.000, 1500.000, '2023-11-15', 'obchudek.cz', 21, ''),
(19, 'Display Iphone SE', 1, 'ks', 654987321, 24, 890.000, 1100.000, '2023-11-18', '', 21, ''),
(20, 'Baterie Iphone 11', 3, 'ks', 321654987, 24, 830.000, 960.000, '2023-11-17', 'neim.cz', 21, ''),
(21, 'Flex kabel tlačítek Iphone 11', 0, 'ks', 963852741, 24, 432.000, 521.000, '2023-10-05', 'test-shop.cz', 21, ''),
(22, 'Ochranné sklo Samsung Galaxy S22', 4, 'ks', 159847236, 24, 120.000, 135.000, '2023-09-07', 'obchudek.cz', 21, ''),
(23, 'Baterie IPhone 12 mini', 1, 'ks', 321456987, 24, 1600.000, 1780.000, '2023-07-06', 'apple.com', 21, 'Originál');

-- --------------------------------------------------------

--
-- Table structure for table `stav`
--

CREATE TABLE `stav` (
  `id` int(11) NOT NULL,
  `nazev` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stav`
--

INSERT INTO `stav` (`id`, `nazev`) VALUES
(1, 'Čeká na zboží'),
(2, 'Probíhá'),
(3, 'Dokončena'),
(4, 'Informován'),
(5, 'Uzavřena');

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
  `zakaznik` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `uzivatel`
--

INSERT INTO `uzivatel` (`id`, `jmeno`, `login`, `heslo`, `role`, `zakaznik`) VALUES
(1, 'Administátor', 'admin', '7eaf9d7ab9e3fe91c079ef9c6a52702cf6d851ffad4a0d23bd0f7097428496ca', 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `zakazka`
--

CREATE TABLE `zakazka` (
  `id` int(11) NOT NULL,
  `datum_zac` date NOT NULL,
  `datum_konec` date DEFAULT NULL,
  `zakaznik` int(11) DEFAULT NULL,
  `cena` double(10,3) NOT NULL,
  `dph` int(11) NOT NULL,
  `stav` int(11) DEFAULT NULL,
  `pozn1` varchar(70) NOT NULL,
  `pozn2` varchar(70) NOT NULL,
  `heslo` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `zakazka`
--

INSERT INTO `zakazka` (`id`, `datum_zac`, `datum_konec`, `zakaznik`, `cena`, `dph`, `stav`, `pozn1`, `pozn2`, `heslo`) VALUES
(696976, '2023-11-20', '0000-00-00', 9, 1500.000, 21, 1, '', 'Čeká na tlačítka pro Iphone 14', 'e8a3edce'),
(696977, '2023-11-20', '2023-11-20', 13, 2300.000, 21, 3, '', '', 'f7c9d2ea'),
(696978, '2023-11-07', '2023-11-20', 11, 400.000, 21, 3, '', '', '4bc27a3d'),
(696979, '2023-11-20', '0000-00-00', 10, 123.000, 21, 2, '', '', 'a1cf8fe3');

-- --------------------------------------------------------

--
-- Table structure for table `zakazka_zbo`
--

CREATE TABLE `zakazka_zbo` (
  `zak_id` int(11) NOT NULL,
  `zbo_id` int(11) NOT NULL,
  `mnozstvi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `zakazka_zbo`
--

INSERT INTO `zakazka_zbo` (`zak_id`, `zbo_id`, `mnozstvi`) VALUES
(696978, 22, 2),
(696977, 18, 1),
(696977, 21, 1);

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
(9, 'Ondřej', 'Boček', '', 0, 0, 984778974, 'ondrejbocik@seznam.cz', ''),
(10, 'Tomáš', 'Lédl', 'Firmeros', 2147483647, 6, 852147963, '', ''),
(11, 'Karel', 'Valenta', '', 0, 7, 321789645, '', ''),
(12, 'Jakub', 'Milota', 'Sněmovna', 2147483647, 8, 751486321, 'kubikmil@gmail.com', ''),
(13, 'Jarda', 'Bagr', '', 0, 9, 997465345, '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adresa`
--
ALTER TABLE `adresa`
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `uzivatel_1` (`role`);

--
-- Indexes for table `zakazka`
--
ALTER TABLE `zakazka`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zakazka_zbo`
--
ALTER TABLE `zakazka_zbo`
  ADD KEY `obj_id` (`zak_id`),
  ADD KEY `zbo_id` (`zbo_id`);

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
-- AUTO_INCREMENT for table `sklad`
--
ALTER TABLE `sklad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `t_role`
--
ALTER TABLE `t_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `uzivatel`
--
ALTER TABLE `uzivatel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `zakazka`
--
ALTER TABLE `zakazka`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=696980;

--
-- AUTO_INCREMENT for table `zakaznik`
--
ALTER TABLE `zakaznik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `uzivatel`
--
ALTER TABLE `uzivatel`
  ADD CONSTRAINT `uzivatel_1` FOREIGN KEY (`role`) REFERENCES `t_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `zakazka_zbo`
--
ALTER TABLE `zakazka_zbo`
  ADD CONSTRAINT `zakazka_zbo_ibfk_1` FOREIGN KEY (`zak_id`) REFERENCES `zakazka` (`id`),
  ADD CONSTRAINT `zakazka_zbo_ibfk_2` FOREIGN KEY (`zbo_id`) REFERENCES `sklad` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
