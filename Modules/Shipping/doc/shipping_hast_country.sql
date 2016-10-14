-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 15. Dezember 2012 um 10:28
-- Server Version: 5.1.44
-- PHP-Version: 5.3.1

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT=0;
START TRANSACTION;

--
-- Datenbank: `motorssouq`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `shipping_has_country`
--

DROP TABLE IF EXISTS `shipping_has_country`;
CREATE TABLE IF NOT EXISTS `shipping_has_country` (
  `shipping_id` int(11) NOT NULL,
  `country_code` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  KEY `country_code` (`country_code`),
  KEY `shipping_id` (`shipping_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `shipping_has_country`
--
ALTER TABLE `shipping_has_country`
  ADD CONSTRAINT `shipping_has_country_ibfk_1` FOREIGN KEY (`shipping_id`) REFERENCES `shipping` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;
