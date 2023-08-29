SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `t_role` (
  `id` int(11) PRIMARY KEY,
  `nazev` varchar(40) NOT NULL UNIQUE
);

INSERT INTO `t_role` (`id`, `nazev`) VALUES
(2, 'Administrátor'),
(3, 'Uživatel');

CREATE TABLE `uzivatel` (
  `id` int(11) PRIMARY KEY,
  `jmeno` varchar(30) NOT NULL,
  `login` varchar(40) NOT NULL UNIQUE,
  `heslo` varchar(150) NOT NULL,
  `role` int NOT NULL DEFAULT 3,
  `email` varchar(50) NOT NULL UNIQUE
);

INSERT INTO `uzivatel` (`id`, `jmeno`, `login`, `heslo`, `role`, `email`) VALUES
(1, 'Administátor', 'admin', '7eaf9d7ab9e3fe91c079ef9c6a52702cf6d851ffad4a0d23bd0f7097428496ca', 2, 'admin@uzivatel.cz'),
(2, 'Uživatel', 'user', '48fad24c28a5a5960606fe6f1429090a1f998a29e1ef0e9eccae15d116474678', 3, 'user@uzivatel.cz');

CREATE TABLE `adresa` (
  `id` int PRIMARY KEY,
  `mesto` varchar(30) NOT NULL,
  `ulice` varchar(30),
  `CP` int(3) NOT NULL,
  `PSC` int(5) NOT NULL
);

ALTER TABLE adresa
  ADD CONSTRAINT PSC CHECK (PSC>9999 AND PSC<100000);

CREATE TABLE `zakaznik` (
  `id` int PRIMARY KEY,
  `jmeno` varchar(30) NOT NULL,
  `prijmeni` varchar(30) NOT NULL,
  `firma` varchar(50),
  `ICO` int(8),
  `adr` int REFERENCES adresa(id),
  `tel` bigint NOT NULL,
  `email` varchar(50) NOT NULL,
  `pozn` varchar(70)
);

CREATE TABLE `sklad` (
  `id` int PRIMARY KEY,
  `nazev` varchar(50) NOT NULL,
  `mnozstvi` int NOT NULL,
  `jednotka` varchar(30),
  `sercis` bigint,
  `zaruka` int,
  `cena1` double(12,3) NOT NULL,
  `cena2` double(12,3) NOT NULL,
  `datum` date NOT NULL,
  `obchod` varchar(50),
  `DPH` int,
  `pozn` varchar(70)
);

CREATE TABLE `stav` (
  `id` int PRIMARY KEY,
  `nazev` varchar(30) NOT NULL
);

CREATE TABLE `objednavka` (
  `id` int PRIMARY KEY,
  `datum_zac` date NOT NULL,
  `datum_konec` date NOT NULL,
  `zakaznik` int REFERENCES zakaznik(id),
  `cena` double(10,3) NOT NULL,
  `dph` int NOT NULL,
  `stav` int REFERENCES stav(id),
  `pozn1` varchar(70) NOT NULL,
  `pozn2` varchar(70) NOT NULL,
  `heslo` varchar(150) NOT NULL
);

ALTER TABLE `t_role`
MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `uzivatel`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3,
ADD CONSTRAINT `uzivatel_1` FOREIGN KEY (`role`) REFERENCES `t_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

ALTER TABLE `adresa`
MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `zakaznik`
MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `sklad`
MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `objednavka`
MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

CREATE TABLE `obj_zbo` (
  `obj_id` int NOT NULL, 
  `zbo_id` int NOT NULL,
  FOREIGN KEY(obj_id) REFERENCES objednavka(id),
  FOREIGN KEY(zbo_id) REFERENCES sklad(id),
  `mnozstvi` int NOT NULL
);
