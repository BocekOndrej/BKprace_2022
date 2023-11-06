-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2023 at 06:49 PM
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
(3, 'Jihlava', 'Legionářů', 13, 58862),
(4, 'Sedlejov', '', 13, 58862),
(5, 'Třebíč', 'Nevim', 69, 58862);

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
(1, 'Baterie Iphone 11', 1, 'ks', 4534553, 11, 1234.000, 4563.000, '0000-00-00', 'shop.cz', 12, 'poznamka'),
(2, 'Display Iphone SE', 3, 'ks', 111111, 11, 1234.000, 4566.000, '2022-11-28', 'shop.cz', 12, ''),
(3, 'Flex kabel tlačítek', 0, 'ks', 123456, 12, 9999.000, 99999.000, '0000-00-00', 'shop.cz', 15, 'poznamkos'),
(4, 'Geforce GTX 3060', 0, 'ks', 69969, 12, 888.000, 666.000, '2022-11-27', 'shop.cz', 12, 'grafika'),
(5, 'Intel Core i7', 0, 'ks', 123459486, 35, 446.000, 998.000, '2022-11-27', 'shop.cz', 15, ''),
(6, 'NewZbozi', 4, 'ks', 6, 2, 1.000, 2.000, '0000-00-00', 'shop.cz', 12, '654'),
(7, 'Novy Zbozi 2', 6, 'ks', 8, 1, 6.000, 6.000, '0000-00-00', 's', 1, ''),
(8, 'Novy Zbozi 3', 4, 'ks', 777777, 24, 300.000, 500.000, '0000-00-00', 'shop.cz', 15, ''),
(9, 'Nove Zbozi 5', 0, 'ks', 962161, 12, 123.000, 234.000, '2023-11-01', 'obchod.cz', 12, ''),
(10, 'Nove Zbozi 4', 0, 'ks', 765165, 12, 123.000, 234.000, '2023-11-01', 'shop.cz', 12, ''),
(11, 'Zbozi ze zakazky', 0, 'ks', 3753123, 12, 35.000, 453.000, '2023-10-31', 'obchudek.cz', 12, ''),
(15, 'Test modal', 2, 'm', 32516613, 3, 453.000, 678.000, '2023-10-30', 'test-shop.cz', 12, 'Testik vkladani pres modal');

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
(1, 'Čeká'),
(2, 'Probíhá'),
(3, 'Dokončena');

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
(1, 'Administátor', 'admin', '7eaf9d7ab9e3fe91c079ef9c6a52702cf6d851ffad4a0d23bd0f7097428496ca', 2, NULL),
(2, 'Uživatel', 'user', '48fad24c28a5a5960606fe6f1429090a1f998a29e1ef0e9eccae15d116474678', 3, NULL),
(4, 'Ondra', 'testik@testik.cz', '123456', 3, NULL),
(7, 'Sulik Chuj', 'joj@trouba.cz', 'dc1d706043401bdca54747e34de51484f8426a8e8bcbc6d727dfa0edc527f006', 3, 2),
(8, 'Novej Zakaznik', 'novejtrouba@seznam.cz', 'dc1d706043401bdca54747e34de51484f8426a8e8bcbc6d727dfa0edc527f006', 3, 6);

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
(1, '2023-01-01', '2023-01-07', 1, 123.000, 15, 3, '', '', '123456789'),
(69420, '2023-10-22', '2023-11-03', 6, 999.000, 12, 3, 'joj', 'test', '123456789'),
(568745, '2023-10-09', '2023-10-29', 1, 12355.000, 15, 2, 'Nevim kemi jooooj', 'Ser na to', '123456789'),
(696971, '2023-10-31', '0000-00-00', 2, 28000.000, 15, 2, 'jooj', 'asdf', '123456789'),
(696972, '0000-00-00', NULL, 7, 35364.000, 12, 1, '', '', '123456789'),
(696973, '0000-00-00', NULL, 8, 123.000, 15, 2, '', '', 'a7aed16f'),
(696974, '0000-00-00', NULL, 3, 28000.000, 15, 1, 'poznamkos', '', 'c9ef121e'),
(696975, '0000-00-00', NULL, 6, 45364.000, 15, 2, 'Zkouska index', '', '6c8fe643');

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
(1, 1, 2),
(1, 2, 1),
(568745, 9, 2),
(568745, 10, 3),
(568745, 7, 3),
(568745, 3, 2),
(696972, 11, 2),
(696973, 3, 1),
(696973, 6, 2),
(696971, 2, 2),
(696971, 3, 1),
(69420, 5, 1),
(69420, 15, 2);

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
(2, 'Sulik', 'Chuj', 'Sněmovna', 0, 3, 984778555, 'joj@trouba.cz', 'joj'),
(3, 'Sulik', 'Sulda', 'Selitech', 0, 4, 984778974, 'testik@testik.cz', ''),
(4, 'Prokop', 'Buben', 'Selitech', 99999999, 0, 984778974, 'testik@testik.cz', ''),
(5, 'Jakub', 'Zelinka', '', 0, 5, 984778974, 'kuba@email.com', 'Zdar'),
(6, 'Novej', 'Zakaznik', '', 0, 0, 999888777, 'novejtrouba@seznam.cz', ''),
(7, 'Novej', 'Zakaznik', '', 0, 0, 312433456, 'fejkovitch@blbec.blb', ''),
(8, 'Zakaznik', 'Testik', '', 0, 0, 312234896, 'testos@seznam.cz', '');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `t_role`
--
ALTER TABLE `t_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `uzivatel`
--
ALTER TABLE `uzivatel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `zakazka`
--
ALTER TABLE `zakazka`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=696976;

--
-- AUTO_INCREMENT for table `zakaznik`
--
ALTER TABLE `zakaznik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
