-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 20. Jul 2024 um 15:20
-- Server-Version: 10.4.27-MariaDB
-- PHP-Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `Emvicy1x`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `AccountModelTableGroup`
--

CREATE TABLE `AccountModelTableGroup` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `active` int(1) NOT NULL DEFAULT 0,
  `uuid` varchar(36) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'uuid permanent',
  `stampChange` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `stampCreate` timestamp NOT NULL DEFAULT '2024-02-11 11:06:18'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Daten für Tabelle `AccountModelTableGroup`
--

INSERT INTO `AccountModelTableGroup` (`id`, `name`, `active`, `uuid`, `stampChange`, `stampCreate`) VALUES
(1, 'admin', 1, 'e27d0317-905e-11ee-9bb6-2cf05d0841fd', '2023-12-01 14:35:54', '2023-11-30 14:52:16');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `AccountModelTableUser`
--

CREATE TABLE `AccountModelTableUser` (
  `id` int(11) NOT NULL,
  `id_TableGroup` int(11) DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `active` int(1) NOT NULL DEFAULT 0,
  `uuid` varchar(36) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'uuid permanent',
  `uuidtmp` varchar(36) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'uuid; changes on create|login',
  `password` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nickname` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `forename` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `lastname` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `stampChange` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `stampCreate` timestamp NOT NULL DEFAULT '2024-02-11 11:06:18'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Daten für Tabelle `AccountModelTableUser`
--

INSERT INTO `AccountModelTableUser` (`id`, `id_TableGroup`, `email`, `active`, `uuid`, `uuidtmp`, `password`, `nickname`, `forename`, `lastname`, `stampChange`, `stampCreate`) VALUES
(48, NULL, 'foo@example.com', 1, '1ba42b18-b48c-4026-a83d-9519af898b36', '6473548b-6c7a-4207-a17c-37600780c04b', '$2y$10$3XvgMdhYBH9AOl8iiLaRZuk4scPk/nWGY.UdYjM4Jao8wnFh/ONfW', 'foo', 'foo', 'bar', '2024-07-20 13:20:36', '2023-12-03 11:03:48'),
(50, NULL, 'foo2@example.com', 1, '2ba42b18-b48c-4026-a83d-9519af898b36', '1473548b-6c7a-4207-a17c-37600780c04b', '$2y$10$OD4NTG8.g7eFSM4eZp4gEOokyisoTdvfznitOn3k9P2kNNl7dVEpK', 'foo2', 'foo2', 'bar', '2024-07-20 13:20:47', '2023-12-03 11:03:48');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `FooModelTableFoo`
--

CREATE TABLE `FooModelTableFoo` (
  `id` int(11) NOT NULL,
  `id_TableGroup` int(11) DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `active` int(1) NOT NULL DEFAULT 0,
  `stampChange` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `stampCreate` timestamp NOT NULL DEFAULT '2024-03-17 11:15:45'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `FooModelTableGroup`
--

CREATE TABLE `FooModelTableGroup` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `active` int(1) NOT NULL DEFAULT 0,
  `uuid` varchar(36) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'uuid permanent',
  `stampChange` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `stampCreate` timestamp NOT NULL DEFAULT '2023-11-30 15:52:16'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Daten für Tabelle `FooModelTableGroup`
--

INSERT INTO `FooModelTableGroup` (`id`, `name`, `active`, `uuid`, `stampChange`, `stampCreate`) VALUES
(1, 'admin', 1, 'e27d0317-905e-11ee-9bb6-2cf05d0841fd', '2023-12-01 15:35:54', '2023-11-30 15:52:16');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `FooModelTableGroup2`
--

CREATE TABLE `FooModelTableGroup2` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `active` int(1) NOT NULL DEFAULT 0,
  `uuid` varchar(36) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'uuid permanent',
  `stampChange` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `stampCreate` timestamp NOT NULL DEFAULT '2023-11-30 15:52:16'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Daten für Tabelle `FooModelTableGroup2`
--

INSERT INTO `FooModelTableGroup2` (`id`, `name`, `active`, `uuid`, `stampChange`, `stampCreate`) VALUES
(1, 'admin', 1, 'e27d0317-905e-11ee-9bb6-2cf05d0841fd', '2023-12-01 15:35:54', '2023-11-30 15:52:16');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `FooModelTableUser`
--

CREATE TABLE `FooModelTableUser` (
  `id` int(11) NOT NULL,
  `id_TableGroup` int(11) DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `lastname` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `active` int(1) NOT NULL DEFAULT 0,
  `uuid` varchar(36) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'uuid permanent',
  `uuidtmp` varchar(36) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'uuid; changes on create|login',
  `password` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nickname` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `forename` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `stampChange` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `stampCreate` timestamp NOT NULL DEFAULT '2023-12-01 15:00:51'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Daten für Tabelle `FooModelTableUser`
--

INSERT INTO `FooModelTableUser` (`id`, `id_TableGroup`, `email`, `lastname`, `active`, `uuid`, `uuidtmp`, `password`, `nickname`, `forename`, `stampChange`, `stampCreate`) VALUES
(48, NULL, 'foo@example.com', 'bar', 0, '1ba42b18-b48c-4026-a83d-9519af898b36', '6473548b-6c7a-4207-a17c-37600780c04b', '$2y$10$8ZasBj6Lw1RW0.xxHLDVZekJx8l0mBglFwPPRZxnF9aOz/zMpw5Mi', 'foo', 'foo', '2024-02-24 12:52:55', '2023-12-03 12:03:48'),
(50, NULL, 'foo2@example.com', 'bar', 1, '2ba42b18-b48c-4026-a83d-9519af898b36', '1473548b-6c7a-4207-a17c-37600780c04b', '$1y$10$8ZasBj6Lw1RW0.xxHLDVZekJx8l0mBglFwPPRZxnF9aOz/zMpw5Mi', 'foo2', 'foo2', '2023-12-12 07:34:36', '2023-12-03 12:03:48');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `AccountModelTableGroup`
--
ALTER TABLE `AccountModelTableGroup`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `uuid` (`uuid`);

--
-- Indizes für die Tabelle `AccountModelTableUser`
--
ALTER TABLE `AccountModelTableUser`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `uuid` (`uuid`),
  ADD UNIQUE KEY `uuidtmp` (`uuidtmp`),
  ADD KEY `id_TableGroup` (`id_TableGroup`);

--
-- Indizes für die Tabelle `FooModelTableFoo`
--
ALTER TABLE `FooModelTableFoo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_TableGroup` (`id_TableGroup`);

--
-- Indizes für die Tabelle `FooModelTableGroup`
--
ALTER TABLE `FooModelTableGroup`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `uuid` (`uuid`);

--
-- Indizes für die Tabelle `FooModelTableGroup2`
--
ALTER TABLE `FooModelTableGroup2`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `uuid` (`uuid`);

--
-- Indizes für die Tabelle `FooModelTableUser`
--
ALTER TABLE `FooModelTableUser`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`),
  ADD UNIQUE KEY `uuidtmp` (`uuidtmp`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password` (`password`),
  ADD KEY `id_TableGroup` (`id_TableGroup`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `AccountModelTableGroup`
--
ALTER TABLE `AccountModelTableGroup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `AccountModelTableUser`
--
ALTER TABLE `AccountModelTableUser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT für Tabelle `FooModelTableFoo`
--
ALTER TABLE `FooModelTableFoo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `FooModelTableGroup`
--
ALTER TABLE `FooModelTableGroup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT für Tabelle `FooModelTableGroup2`
--
ALTER TABLE `FooModelTableGroup2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `FooModelTableUser`
--
ALTER TABLE `FooModelTableUser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `AccountModelTableUser`
--
ALTER TABLE `AccountModelTableUser`
  ADD CONSTRAINT `AccountModelTableUser_ibfk_1` FOREIGN KEY (`id_TableGroup`) REFERENCES `AccountModelTableGroup` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `FooModelTableFoo`
--
ALTER TABLE `FooModelTableFoo`
  ADD CONSTRAINT `FooModelTableFoo_ibfk_1` FOREIGN KEY (`id_TableGroup`) REFERENCES `FooModelTableGroup` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `FooModelTableUser`
--
ALTER TABLE `FooModelTableUser`
  ADD CONSTRAINT `FooModelTableUser_ibfk_1` FOREIGN KEY (`id_TableGroup`) REFERENCES `FooModelTableGroup` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
