-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Ven 22 Février 2013 à 16:09
-- Version du serveur: 5.5.16
-- Version de PHP: 5.3.8

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
-- Base de données: `telesouq`
--

-- --------------------------------------------------------

--
-- Structure de la table `account_has_email`
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
-- Structure de la table `webmail_attchment`
--

DROP TABLE IF EXISTS `webmail_attchment`;
CREATE TABLE IF NOT EXISTS `webmail_attchment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webmail_email_id` int(11) DEFAULT NULL,
  `binary` longblob,
  `ext` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `webmail_email_id` (`webmail_email_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `account_has_email`
--
ALTER TABLE `account_has_email`
  ADD CONSTRAINT `account_has_email_ibfk_2` FOREIGN KEY (`crm_account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `account_has_email_ibfk_1` FOREIGN KEY (`webmail_email_id`) REFERENCES `webmail_email` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `webmail_attchment`
--
ALTER TABLE `webmail_attchment`
  ADD CONSTRAINT `webmail_attchment_ibfk_1` FOREIGN KEY (`webmail_email_id`) REFERENCES `webmail_email` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
