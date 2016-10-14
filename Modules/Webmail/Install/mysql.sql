-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Lun 21 Octobre 2013 à 12:50
-- Version du serveur: 5.5.16
-- Version de PHP: 5.3.8

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT=0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Module: `Webmail`
--

-- --------------------------------------------------------

--
-- Structure de la table `webmail_attchment`
--

DROP TABLE IF EXISTS `webmail_attchment`;
CREATE TABLE IF NOT EXISTS `webmail_attchment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webmail_email_id` int(11) DEFAULT NULL,
  `binary` longblob,
  `ext` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `type` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `name` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `webmail_email_id` (`webmail_email_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `webmail_email`
--

DROP TABLE IF EXISTS `webmail_email`;
CREATE TABLE IF NOT EXISTS `webmail_email` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `from_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `to_emails` text COLLATE utf8_unicode_ci NOT NULL,
  `cc_emails` text COLLATE utf8_unicode_ci,
  `bcc_emails` text COLLATE utf8_unicode_ci,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `state` tinyint(4) NOT NULL,
  `createat` datetime DEFAULT NULL,
  `sendat` datetime DEFAULT NULL,
  `remote_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `webmail_server_setting`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `webmail_attchment`
--
ALTER TABLE `webmail_attchment`
  ADD CONSTRAINT `webmail_attchment_ibfk_1` FOREIGN KEY (`webmail_email_id`) REFERENCES `webmail_email` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;
