
-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 25. Februar 2013 um 09:04
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
-- Tabellenstruktur für Tabelle `webmail_server_setting`
--

DROP TABLE IF EXISTS `webmail_server_setting`;
CREATE TABLE IF NOT EXISTS `webmail_server_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `type` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `host` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `port` int(11) NOT NULL,
  `encryption` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cert` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `global` tinyint(1) NOT NULL,
  `last_update_date_time` datetime DEFAULT NULL,
  `signature` text COLLATE utf8_unicode_ci,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hash` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;
