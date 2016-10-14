-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 06. November 2012 um 12:16
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
-- Tabellenstruktur für Tabelle `rbac_privilege`
--

DROP TABLE IF EXISTS `rbac_privilege`;
CREATE TABLE IF NOT EXISTS `rbac_privilege` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=25 ;

--
-- Daten für Tabelle `rbac_privilege`
--

INSERT INTO `rbac_privilege` (`id`, `name`, `role_id`) VALUES
(22, 'Bike_Add2_Controller', 3),
(23, 'Cms', 3),
(24, 'Cms_Add_Controller', 3);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rbac_role`
--

DROP TABLE IF EXISTS `rbac_role`;
CREATE TABLE IF NOT EXISTS `rbac_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `rbac_role`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rbac_role_lang`
--

DROP TABLE IF EXISTS `rbac_role_lang`;
CREATE TABLE IF NOT EXISTS `rbac_role_lang` (
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lang` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `rbac_role_id` int(11) NOT NULL,
  KEY `fk_rbac_role_lang_rbac_role_idx` (`rbac_role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `rbac_role_lang`
--


--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `rbac_role_lang`
--
ALTER TABLE `rbac_role_lang`
  ADD CONSTRAINT `fk_rbac_role_lang_rbac_role` FOREIGN KEY (`rbac_role_id`) REFERENCES `rbac_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;
