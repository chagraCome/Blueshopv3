-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 16. April 2013 um 17:15
-- Server Version: 5.1.44
-- PHP-Version: 5.3.1

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT=0;
START TRANSACTION;

--
-- Datenbank: `shop1`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `portlet`
--

DROP TABLE IF EXISTS `portlet`;
CREATE TABLE IF NOT EXISTS `portlet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `callback` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `portlet`
--

INSERT INTO `portlet` (`id`, `module`, `callback`, `name`) VALUES
(1, 'Crm', 'getLast5Accounts', 'Last 5 Accounts'),
(2, 'Saleorder', 'getLastSalesOrders', 'Last Sales Orders');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `portlet_user`
--

DROP TABLE IF EXISTS `portlet_user`;
CREATE TABLE IF NOT EXISTS `portlet_user` (
  `portlet_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `position` varchar(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'L',
  `sortid` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  KEY `portlet_id` (`portlet_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `portlet_user`
--

INSERT INTO `portlet_user` (`portlet_id`, `user_id`, `position`, `sortid`, `status`) VALUES
(2, 1, 'L', 0, 1),
(1, 1, 'C', 0, 1);

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `portlet_user`
--
ALTER TABLE `portlet_user`
  ADD CONSTRAINT `portlet_user_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `portlet_user_ibfk_1` FOREIGN KEY (`portlet_id`) REFERENCES `portlet` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

