-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 13. Dezember 2012 um 11:28
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
-- Tabellenstruktur für Tabelle `setting`
--

DROP TABLE IF EXISTS `setting`;
CREATE TABLE IF NOT EXISTS `setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entity` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `settingkey` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Daten für Tabelle `setting`
--

INSERT INTO `setting` (`id`, `entity`, `settingkey`) VALUES
(2, 'saleorder', 'sale_order_state_accepted'),
(3, 'saleorder', 'sale_order_state_open'),
(4, 'saleorder', 'sale_order_state_created'),
(5, 'saleorder', 'sale_order_state_accepted'),
(6, 'saleorder', 'sale_order_state_open'),
(7, 'saleorder', 'sale_order_state_created'),
(8, 'saleorder', 'sale_order_state_accepted'),
(9, 'saleorder', 'sale_order_state_open'),
(10, 'saleorder', 'sale_order_state_created');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `setting_lang`
--

DROP TABLE IF EXISTS `setting_lang`;
CREATE TABLE IF NOT EXISTS `setting_lang` (
  `setting_id` int(11) NOT NULL,
  `settingvalue` text COLLATE utf8_unicode_ci,
  `lang` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  KEY `setting_id` (`setting_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `setting_lang`
--

INSERT INTO `setting_lang` (`setting_id`, `settingvalue`, `lang`) VALUES
(2, '2', 'en'),
(2, '2', 'ar'),
(3, '1', 'en'),
(3, '1', 'ar'),
(4, '', 'en'),
(4, '', 'ar'),
(5, '2', 'en'),
(5, '2', 'ar'),
(6, '1', 'en'),
(6, '1', 'ar'),
(7, '1', 'en'),
(7, '1', 'ar'),
(8, '2', 'en'),
(8, '2', 'ar'),
(9, '1', 'en'),
(9, '1', 'ar'),
(10, '1', 'en'),
(10, '1', 'ar');

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `setting_lang`
--
ALTER TABLE `setting_lang`
  ADD CONSTRAINT `setting_lang_ibfk_1` FOREIGN KEY (`setting_id`) REFERENCES `setting` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;
