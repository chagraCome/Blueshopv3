-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 25. Mrz 2014 um 13:40
-- Server Version: 5.5.31
-- PHP-Version: 5.4.19

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Datenbank: `blueshop_sample`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `account`
--

DROP TABLE IF EXISTS `account`;
CREATE TABLE IF NOT EXISTS `account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `number` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefon` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email1` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email2` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `notice` longtext COLLATE utf8_unicode_ci,
  `country` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `province` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `street` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zipcode` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `register_date_time` datetime NOT NULL,
  `dealer` tinyint(1) DEFAULT '0',
  `group_id` int(11) DEFAULT NULL,
  `activation_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` int(11) DEFAULT '0',
  `token` text COLLATE utf8_unicode_ci,
  `account_source_id` int(11) DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `group_id` (`group_id`),
  KEY `account_source_id` (`account_source_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=770 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `account_group`
--

DROP TABLE IF EXISTS `account_group`;
CREATE TABLE IF NOT EXISTS `account_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `as_default` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `account_has_document`
--

DROP TABLE IF EXISTS `account_has_document`;
CREATE TABLE IF NOT EXISTS `account_has_document` (
  `account_id` int(11) NOT NULL,
  `document_id` int(11) NOT NULL,
  PRIMARY KEY (`account_id`,`document_id`),
  KEY `fk_account_has_document_document1` (`document_id`),
  KEY `fk_account_has_document_account1` (`account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `account_has_email`
--

DROP TABLE IF EXISTS `account_has_email`;
CREATE TABLE IF NOT EXISTS `account_has_email` (
  `webmail_email_id` int(11) DEFAULT NULL,
  `crm_account_id` int(11) DEFAULT NULL,
  KEY `webmail_email_id` (`webmail_email_id`,`crm_account_id`),
  KEY `crm_account_id` (`crm_account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `account_source`
--

DROP TABLE IF EXISTS `account_source`;
CREATE TABLE IF NOT EXISTS `account_source` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `account_source_lang`
--

DROP TABLE IF EXISTS `account_source_lang`;
CREATE TABLE IF NOT EXISTS `account_source_lang` (
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lang` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_source_id` int(11) DEFAULT NULL,
  KEY `account_source_id` (`account_source_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `address`
--

DROP TABLE IF EXISTS `address`;
CREATE TABLE IF NOT EXISTS `address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `street` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zipcode` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `province` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `account_id` (`account_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=770 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `firstname` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `phone` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` tinyint(1) DEFAULT NULL,
  `create_date_time` datetime DEFAULT NULL,
  `update_date_time` datetime DEFAULT NULL,
  `notice` text COLLATE utf8_unicode_ci,
  `account_id` int(11) DEFAULT NULL,
  `contact_group_id` int(11) DEFAULT NULL,
  `contact_source_id` int(11) DEFAULT NULL,
  `company_website` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_contact_account1` (`account_id`),
  KEY `fk_person_person_group1` (`contact_group_id`),
  KEY `contact_source_id` (`contact_source_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `contact_group`
--

DROP TABLE IF EXISTS `contact_group`;
CREATE TABLE IF NOT EXISTS `contact_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `contact_has_document`
--

DROP TABLE IF EXISTS `contact_has_document`;
CREATE TABLE IF NOT EXISTS `contact_has_document` (
  `contact_id` int(11) NOT NULL,
  `document_id` int(11) NOT NULL,
  PRIMARY KEY (`contact_id`,`document_id`),
  KEY `fk_contact_has_document_document1` (`document_id`),
  KEY `fk_contact_has_document_contact1` (`contact_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `contact_has_email`
--

DROP TABLE IF EXISTS `contact_has_email`;
CREATE TABLE IF NOT EXISTS `contact_has_email` (
  `webmail_email_id` int(11) DEFAULT NULL,
  `crm_contact_id` int(11) DEFAULT NULL,
  KEY `webmail_email_id` (`webmail_email_id`,`crm_contact_id`),
  KEY `crm_contact_id` (`crm_contact_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `contact_source`
--

DROP TABLE IF EXISTS `contact_source`;
CREATE TABLE IF NOT EXISTS `contact_source` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `contact_source_lang`
--

DROP TABLE IF EXISTS `contact_source_lang`;
CREATE TABLE IF NOT EXISTS `contact_source_lang` (
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lang` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_source_id` int(11) DEFAULT NULL,
  KEY `contact_source_id` (`contact_source_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lead`
--

DROP TABLE IF EXISTS `lead`;
CREATE TABLE IF NOT EXISTS `lead` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `firstname` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `phone` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` tinyint(1) DEFAULT NULL,
  `create_date_time` datetime DEFAULT NULL,
  `update_date_time` datetime DEFAULT NULL,
  `notice` text COLLATE utf8_unicode_ci,
  `lead_group_id` int(11) DEFAULT NULL,
  `lead_source_id` int(11) DEFAULT NULL,
  `company_website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_person_person_group1` (`lead_group_id`),
  KEY `lead_source_id` (`lead_source_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lead_group`
--

DROP TABLE IF EXISTS `lead_group`;
CREATE TABLE IF NOT EXISTS `lead_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lead_has_email`
--

DROP TABLE IF EXISTS `lead_has_email`;
CREATE TABLE IF NOT EXISTS `lead_has_email` (
  `webmail_email_id` int(11) DEFAULT NULL,
  `crm_lead_id` int(11) DEFAULT NULL,
  KEY `webmail_email_id` (`webmail_email_id`,`crm_lead_id`),
  KEY `crm_lead_id` (`crm_lead_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lead_source`
--

DROP TABLE IF EXISTS `lead_source`;
CREATE TABLE IF NOT EXISTS `lead_source` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lead_source_lang`
--

DROP TABLE IF EXISTS `lead_source_lang`;
CREATE TABLE IF NOT EXISTS `lead_source_lang` (
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lang` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lead_source_id` int(11) DEFAULT NULL,
  KEY `lead_source_id` (`lead_source_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `account_ibfk_1` FOREIGN KEY (`account_source_id`) REFERENCES `account_source` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `account_has_document`
--
ALTER TABLE `account_has_document`
  ADD CONSTRAINT `fk_account_has_document_account1` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_account_has_document_document1` FOREIGN KEY (`document_id`) REFERENCES `document` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `account_has_email`
--
ALTER TABLE `account_has_email`
  ADD CONSTRAINT `account_has_email_ibfk_1` FOREIGN KEY (`webmail_email_id`) REFERENCES `webmail_email` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `account_has_email_ibfk_2` FOREIGN KEY (`crm_account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `account_source_lang`
--
ALTER TABLE `account_source_lang`
  ADD CONSTRAINT `account_source_lang_ibfk_1` FOREIGN KEY (`account_source_id`) REFERENCES `account_source` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `account_source_lang_ibfk_2` FOREIGN KEY (`account_source_id`) REFERENCES `account_source` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `contact_ibfk_1` FOREIGN KEY (`contact_group_id`) REFERENCES `contact_group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contact_ibfk_2` FOREIGN KEY (`contact_source_id`) REFERENCES `contact_source` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_contact_account1` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints der Tabelle `contact_has_document`
--
ALTER TABLE `contact_has_document`
  ADD CONSTRAINT `fk_contact_has_document_contact1` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_contact_has_document_document1` FOREIGN KEY (`document_id`) REFERENCES `document` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `contact_has_email`
--
ALTER TABLE `contact_has_email`
  ADD CONSTRAINT `contact_has_email_ibfk_1` FOREIGN KEY (`webmail_email_id`) REFERENCES `webmail_email` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contact_has_email_ibfk_2` FOREIGN KEY (`crm_contact_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `contact_source_lang`
--
ALTER TABLE `contact_source_lang`
  ADD CONSTRAINT `contact_source_lang_ibfk_1` FOREIGN KEY (`contact_source_id`) REFERENCES `contact_source` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contact_source_lang_ibfk_2` FOREIGN KEY (`contact_source_id`) REFERENCES `contact_source` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `lead`
--
ALTER TABLE `lead`
  ADD CONSTRAINT `lead_ibfk_1` FOREIGN KEY (`lead_group_id`) REFERENCES `lead_group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lead_ibfk_2` FOREIGN KEY (`lead_source_id`) REFERENCES `lead_source` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints der Tabelle `lead_has_email`
--
ALTER TABLE `lead_has_email`
  ADD CONSTRAINT `lead_has_email_ibfk_1` FOREIGN KEY (`webmail_email_id`) REFERENCES `webmail_email` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lead_has_email_ibfk_2` FOREIGN KEY (`crm_lead_id`) REFERENCES `lead` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `lead_source_lang`
--
ALTER TABLE `lead_source_lang`
  ADD CONSTRAINT `lead_source_lang_ibfk_1` FOREIGN KEY (`lead_source_id`) REFERENCES `lead_source` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;
