SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(2, 'Administrátor'),
(3, 'Uživatel');

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `user_sname` varchar(30) NOT NULL,
  `user_login` varchar(40) NOT NULL,
  `user_passwd` varchar(150) NOT NULL,
  `user_role` int NOT NULL DEFAULT 3,
  `user_email` varchar(50) NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` (`user_id`, `user_name`, `user_sname`, `user_login`, `user_passwd`, `user_role`, `user_email`) VALUES
(1, 'Administátor', 'Systému', 'admin', '7eaf9d7ab9e3fe91c079ef9c6a52702cf6d851ffad4a0d23bd0f7097428496ca', 2, 'admin@uzivatel.cz'),
(2, 'Uživatel', 'Systému', 'user', '48fad24c28a5a5960606fe6f1429090a1f998a29e1ef0e9eccae15d116474678', 3, 'user@uzivatel.cz');

ALTER TABLE `roles`
ADD PRIMARY KEY (`role_id`),
ADD UNIQUE KEY `role_name` (`role_name`),
MODIFY `role_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `users`
ADD PRIMARY KEY (`user_id`),
ADD UNIQUE KEY `user_login` (`user_login`),
ADD UNIQUE KEY `user_email` (`user_email`),
ADD KEY `user_role` (`user_role`),
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3,
ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`user_role`) REFERENCES `roles` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;


CREATE TABLE `adresa` (
  `adr_id` int PRIMARY KEY,
  `adr_mesto` varchar(30) NOT NULL,
  `adr_ulice` varchar(30),
  `adr_CP` int(3) NOT NULL,
  `adr_PSC` int(5) NOT NULL
);

ALTER TABLE adresa
  ADD CONSTRAINT PSC CHECK (adr_PSC>9999 AND adr_PSC<100000);

CREATE TABLE `zakaznik` (
  `zak_id` int PRIMARY KEY,
  `zak_name` varchar(30) NOT NULL,
  `zak_sname` varchar(30) NOT NULL,
  `zak_fir_name` varchar(50),
  `zak_ICO` int(8),
  `zak_adr` int REFERENCES adresa(adr_id),
  `zak_tel` bigint NOT NULL,
  `zak_email` varchar(50) NOT NULL,
  `zak_note` varchar(70)
);

CREATE TABLE `sklad` (
  `zbo_id` int PRIMARY KEY,
  `zbo_name` varchar(50) NOT NULL,
  `zbo_amount` int NOT NULL,
  `zbo_unit` varchar(30),
  `zbo_sercis` bigint,
  `zbo_zaruka` int,
  `zbo_price1` double(12,3) NOT NULL,
  `zbo_price2` double(12,3) NOT NULL,
  `zbo_date` date NOT NULL,
  `zbo_shop` varchar(50),
  `zbo_DPH` int,
  `zbo_note` varchar(70)
);

CREATE TABLE `states` (
  `stt_id` int PRIMARY KEY,
  `stt_name` varchar(30) NOT NULL
);

CREATE TABLE `objednavka` (
  `obj_id` int PRIMARY KEY,
  `obj_date_beg` date NOT NULL,
  `obj_date_end` date NOT NULL,
  `obj_zak` int REFERENCES zakaznik(zak_id),
  `obj_price` double(10,3) NOT NULL,
  `obj_dph` int NOT NULL,
  `obj_state` int REFERENCES states(stt_id),
  `obj_passwd` varchar(150) NOT NULL,
  `obj_note1` varchar(70) NOT NULL,
  `obj_note2` varchar(70) NOT NULL
);

ALTER TABLE `adresa`
MODIFY `adr_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `zakaznik`
MODIFY `zak_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `sklad`
MODIFY `zbo_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `objednavka`
MODIFY `obj_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

CREATE TABLE `obj_zbo` (
  `obj_id` int NOT NULL, 
  `zbo_id` int NOT NULL,
  FOREIGN KEY(obj_id) REFERENCES objednavka(obj_id),
  FOREIGN KEY(zbo_id) REFERENCES sklad(zbo_id),
  `obj_amount` int NOT NULL
);
