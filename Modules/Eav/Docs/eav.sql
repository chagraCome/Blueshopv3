-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 01. Dezember 2012 um 09:57
-- Server Version: 5.1.44
-- PHP-Version: 5.3.1

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT=0;
START TRANSACTION;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `motorssouq`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `entity_attribute`
--

DROP TABLE IF EXISTS `entity_attribute`;
CREATE TABLE IF NOT EXISTS `entity_attribute` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `defaultvalue` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `searchable` tinyint(1) DEFAULT '0',
  `validator` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `required` tinyint(1) DEFAULT NULL,
  `entity_attribute_type_backend_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  KEY `fk_entity_attribute_entity_attribute_type1` (`entity_attribute_type_backend_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `entity_attribute`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `entity_attribute_datasource`
--

DROP TABLE IF EXISTS `entity_attribute_datasource`;
CREATE TABLE IF NOT EXISTS `entity_attribute_datasource` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entity_attribute_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_attribute_id` (`entity_attribute_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `entity_attribute_datasource`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `entity_attribute_datasource_lang`
--

DROP TABLE IF EXISTS `entity_attribute_datasource_lang`;
CREATE TABLE IF NOT EXISTS `entity_attribute_datasource_lang` (
  `value` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lang` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `entity_attribute_datasource_id` int(11) NOT NULL,
  KEY `fk_product_attribute_datasource_lang_product_attribute_dataso1` (`entity_attribute_datasource_id`),
  KEY `lang` (`lang`),
  KEY `value` (`value`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `entity_attribute_datasource_lang`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `entity_attribute_lang`
--

DROP TABLE IF EXISTS `entity_attribute_lang`;
CREATE TABLE IF NOT EXISTS `entity_attribute_lang` (
  `entity_attribute_id` int(11) NOT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `datasource` text COLLATE utf8_unicode_ci,
  `lang` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `errormessage` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  KEY `fk_entity_attribute_lang_entity_attribute1` (`entity_attribute_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `entity_attribute_lang`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `entity_attribute_type`
--

DROP TABLE IF EXISTS `entity_attribute_type`;
CREATE TABLE IF NOT EXISTS `entity_attribute_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `typename` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

--
-- Daten für Tabelle `entity_attribute_type`
--

INSERT INTO `entity_attribute_type` (`id`, `name`, `typename`) VALUES
(1, 'Input', 'Text'),
(2, 'ListBox', 'Drop Down'),
(3, 'DateControl', 'Date'),
(4, 'CheckBox', 'Check Box'),
(5, 'CurrencyInput', 'Currency'),
(6, 'WysiwygTextArea', 'Editor'),
(7, 'TextArea', 'Big Text'),
(8, 'Label', 'label'),
(9, 'YesNoListBox', 'YesNoListBox'),
(10, 'Kilometer Input', 'KMInput'),
(11, 'Mile Input', 'MileInput'),
(12, 'Gramm Input', 'GrammInput'),
(13, 'Kliogramm Input', 'KlioGrammInput'),
(14, 'Meter Input', 'MeterInput'),
(15, 'Feed', 'FeedInput'),
(16, 'Minute', 'MinuteInput'),
(17, 'Second', 'SecondInput'),
(18, 'Centiliter', 'CentiliterInput'),
(19, 'Milliliter', 'MilliliterInput'),
(20, 'Hour', 'HourInput'),
(21, 'Color', 'ColorInput');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `entity_attribute_value`
--

DROP TABLE IF EXISTS `entity_attribute_value`;
CREATE TABLE IF NOT EXISTS `entity_attribute_value` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entity_attribute_id` int(11) DEFAULT NULL,
  `entity_id` int(11) NOT NULL,
  `entity_table_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_attribute_value_product_attribute1` (`entity_attribute_id`),
  KEY `fk_product_attribute_value_product1` (`entity_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `entity_attribute_value`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `entity_attribute_value_lang`
--

DROP TABLE IF EXISTS `entity_attribute_value_lang`;
CREATE TABLE IF NOT EXISTS `entity_attribute_value_lang` (
  `value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lang` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `entity_attribute_value_id` int(11) NOT NULL,
  KEY `fk_product_attribute_value_lang_product_attribute_value1` (`entity_attribute_value_id`),
  KEY `lang` (`lang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `entity_attribute_value_lang`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `entity_set`
--

DROP TABLE IF EXISTS `entity_set`;
CREATE TABLE IF NOT EXISTS `entity_set` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `entity_table_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `entity_set`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `entity_set_has_entity_attribute`
--

DROP TABLE IF EXISTS `entity_set_has_entity_attribute`;
CREATE TABLE IF NOT EXISTS `entity_set_has_entity_attribute` (
  `entity_set_id` int(11) NOT NULL,
  `entity_attribute_id` int(11) NOT NULL,
  `sortid` int(11) DEFAULT NULL,
  `entity_set_view_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`entity_set_id`,`entity_attribute_id`),
  KEY `fk_product_set_has_product_attribute_product_attribute1` (`entity_attribute_id`),
  KEY `fk_product_set_has_product_attribute_product_set1` (`entity_set_id`),
  KEY `product_set_view_id` (`entity_set_view_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `entity_set_has_entity_attribute`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `entity_set_view`
--

DROP TABLE IF EXISTS `entity_set_view`;
CREATE TABLE IF NOT EXISTS `entity_set_view` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `frontendvisible` tinyint(1) DEFAULT NULL,
  `entity_set_id` int(11) NOT NULL,
  `sortid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_set_view_product_set1` (`entity_set_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `entity_set_view`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `entity_set_view_lang`
--

DROP TABLE IF EXISTS `entity_set_view_lang`;
CREATE TABLE IF NOT EXISTS `entity_set_view_lang` (
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lang` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `entity_set_view_id` int(11) NOT NULL,
  KEY `fk_product_set_view_lang_product_set_view1` (`entity_set_view_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `entity_set_view_lang`
--


--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `entity_attribute_datasource`
--
ALTER TABLE `entity_attribute_datasource`
  ADD CONSTRAINT `entity_attribute_datasource_ibfk_1` FOREIGN KEY (`entity_attribute_id`) REFERENCES `entity_attribute` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `entity_attribute_datasource_lang`
--
ALTER TABLE `entity_attribute_datasource_lang`
  ADD CONSTRAINT `entity_attribute_datasource_lang_ibfk_1` FOREIGN KEY (`entity_attribute_datasource_id`) REFERENCES `entity_attribute_datasource` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `entity_attribute_lang`
--
ALTER TABLE `entity_attribute_lang`
  ADD CONSTRAINT `fk_entity_attribute_lang_entity_attribute1` FOREIGN KEY (`entity_attribute_id`) REFERENCES `entity_attribute` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `entity_attribute_value`
--
ALTER TABLE `entity_attribute_value`
  ADD CONSTRAINT `entity_attribute_value_ibfk_1` FOREIGN KEY (`entity_attribute_id`) REFERENCES `entity_attribute` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `entity_attribute_value_lang`
--
ALTER TABLE `entity_attribute_value_lang`
  ADD CONSTRAINT `entity_attribute_value_lang_ibfk_1` FOREIGN KEY (`entity_attribute_value_id`) REFERENCES `entity_attribute_value` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `entity_set_has_entity_attribute`
--
ALTER TABLE `entity_set_has_entity_attribute`
  ADD CONSTRAINT `entity_set_has_entity_attribute_ibfk_1` FOREIGN KEY (`entity_set_id`) REFERENCES `entity_set` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `entity_set_has_entity_attribute_ibfk_2` FOREIGN KEY (`entity_attribute_id`) REFERENCES `entity_attribute` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `entity_set_has_entity_attribute_ibfk_3` FOREIGN KEY (`entity_set_view_id`) REFERENCES `entity_set_view` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `entity_set_view`
--
ALTER TABLE `entity_set_view`
  ADD CONSTRAINT `entity_set_view_ibfk_1` FOREIGN KEY (`entity_set_id`) REFERENCES `entity_set` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `entity_set_view_lang`
--
ALTER TABLE `entity_set_view_lang`
  ADD CONSTRAINT `entity_set_view_lang_ibfk_1` FOREIGN KEY (`entity_set_view_id`) REFERENCES `entity_set_view` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;
