-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 06. Dez 2012 um 08:11
-- Server Version: 5.5.8
-- PHP-Version: 5.3.5

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT=0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `amhshoppro`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `shipping`
--

DROP TABLE IF EXISTS `shipping`;
CREATE TABLE IF NOT EXISTS `shipping` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `min_order_amount` double(12,4) DEFAULT NULL,
  `sortid` int(11) DEFAULT NULL,
  `price` double(12,4) DEFAULT NULL,
  `shipping_type_id` int(11) DEFAULT NULL,
  `state` tinyint(1) NOT NULL,
  `image_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_shipping_shipping_type1` (`shipping_type_id`),
  KEY `fk_shipping_document1` (`image_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=45 ;

--
-- Daten für Tabelle `shipping`
--

INSERT INTO `shipping` (`id`, `min_order_amount`, `sortid`, `price`, `shipping_type_id`, `state`, `image_id`) VALUES
(43, NULL, NULL, NULL, 1, 1, NULL),
(44, NULL, NULL, NULL, 2, 1, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `shipping_has_country`
--

DROP TABLE IF EXISTS `shipping_has_country`;
CREATE TABLE IF NOT EXISTS `shipping_has_country` (
  `shipping_id` int(11) NOT NULL,
  `country_code` varchar(4) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`shipping_id`,`country_code`),
  KEY `fk_shipping_has_country_country1` (`country_code`),
  KEY `fk_shipping_has_country_shipping` (`shipping_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `shipping_lang`
--

DROP TABLE IF EXISTS `shipping_lang`;
CREATE TABLE IF NOT EXISTS `shipping_lang` (
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `error_message` longtext COLLATE utf8_unicode_ci,
  `shipping_id` int(11) NOT NULL,
  `lang` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  KEY `fk_table1_shipping1` (`shipping_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `shipping_lang`
--

INSERT INTO `shipping_lang` (`title`, `error_message`, `shipping_id`, `lang`, `description`) VALUES
('ttttt', NULL, 43, 'AR', NULL),
('DHL International', NULL, 43, 'EN', NULL),
('Deutsche POST', NULL, 44, 'AR', NULL),
('Deutsche POST', NULL, 44, 'EN', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `shipping_type`
--

DROP TABLE IF EXISTS `shipping_type`;
CREATE TABLE IF NOT EXISTS `shipping_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `shipping_type`
--

INSERT INTO `shipping_type` (`id`) VALUES
(1),
(2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `shipping_type_lang`
--

DROP TABLE IF EXISTS `shipping_type_lang`;
CREATE TABLE IF NOT EXISTS `shipping_type_lang` (
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `shipping_type_id` int(11) NOT NULL,
  `lang` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  KEY `fk_shipping_type_lang_shipping_type1` (`shipping_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `shipping_type_lang`
--

INSERT INTO `shipping_type_lang` (`name`, `shipping_type_id`, `lang`) VALUES
('Free Shipping', 1, 'EN'),
('Flatrate Shipping', 2, 'en');

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `shipping`
--
ALTER TABLE `shipping`
  ADD CONSTRAINT `fk_shipping_document1` FOREIGN KEY (`image_id`) REFERENCES `document` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_shipping_image1` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_shipping_shipping_type1` FOREIGN KEY (`shipping_type_id`) REFERENCES `shipping_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `shipping_has_country`
--
ALTER TABLE `shipping_has_country`
  ADD CONSTRAINT `fk_shipping_has_country_country1` FOREIGN KEY (`country_code`) REFERENCES `country` (`code`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_shipping_has_country_shipping` FOREIGN KEY (`shipping_id`) REFERENCES `shipping` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `shipping_lang`
--
ALTER TABLE `shipping_lang`
  ADD CONSTRAINT `fk_table1_shipping1` FOREIGN KEY (`shipping_id`) REFERENCES `shipping` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `shipping_type_lang`
--
ALTER TABLE `shipping_type_lang`
  ADD CONSTRAINT `fk_shipping_type_lang_shipping_type1` FOREIGN KEY (`shipping_type_id`) REFERENCES `shipping_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
