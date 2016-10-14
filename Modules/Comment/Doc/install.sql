
-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 27. Februar 2013 um 13:13
-- Server Version: 5.1.44
-- PHP-Version: 5.3.1

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT=0;
START TRANSACTION;

--
-- Datenbank: `telesouq`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `comment_item`
--

DROP TABLE IF EXISTS `comment_item`;
CREATE TABLE IF NOT EXISTS `comment_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` text COLLATE utf8_unicode_ci,
  `subject` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `entity_id` int(11) NOT NULL,
  `entity` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `insertat` date DEFAULT NULL,
  `author_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_seen` tinyint(1) DEFAULT '0',
  `public_seen` tinyint(1) DEFAULT '0',
  `public` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `comment_item`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `comment_item_replay`
--

DROP TABLE IF EXISTS `comment_item_replay`;
CREATE TABLE IF NOT EXISTS `comment_item_replay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_item_id` int(11) NOT NULL,
  `comment` text COLLATE utf8_unicode_ci,
  `insertat` datetime DEFAULT NULL,
  `author_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comment_item_id` (`comment_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `comment_item_replay`
--


--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `comment_item_replay`
--
ALTER TABLE `comment_item_replay`
  ADD CONSTRAINT `comment_item_replay_ibfk_1` FOREIGN KEY (`comment_item_id`) REFERENCES `comment_item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;
