-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Sam 30 Mars 2013 à 13:09
-- Version du serveur: 5.5.16
-- Version de PHP: 5.3.8

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT=0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de données: `telesouq`
--

-- --------------------------------------------------------


--
-- Base de données: `telesouq`
--

-- --------------------------------------------------------

--
-- Structure de la table `account`
--
ALTER TABLE  `quotation_comment` DROP FOREIGN KEY  `fk_quotation_comment_person1` ;

ALTER TABLE  `quotation_comment` CHANGE  `person_id`  `account_id` INT( 11 ) NULL DEFAULT NULL;

ALTER TABLE  `lead` DROP FOREIGN KEY  `fk_person_account1` ;

DROP TABLE IF EXISTS `person`;
DROP TABLE IF EXISTS `person_group`;
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
  PRIMARY KEY (`id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1227 ;

--
-- Contenu de la table `account`
--

INSERT INTO `account` (`id`, `name`, `password`, `number`, `telefon`, `mobile`, `email1`, `email2`, `country`, `province`, `city`, `street`, `zipcode`, `register_date_time`, `dealer`, `group_id`, `activation_code`, `state`) VALUES
(601, 'Muneera', '7c4a8d09ca3762af61e59520943dc26494f8941b', NULL, NULL, '3333333333', 'montassar@amhsoft.com', NULL, 'Bahrain', 'Muharraq ', 'Muharraq', NULL, NULL, '2012-12-07 00:00:00', 1, 24, '', 1);
-- --------------------------------------------------------

--
-- Structure de la table `account_group`
--

DROP TABLE IF EXISTS `account_group`;
CREATE TABLE IF NOT EXISTS `account_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `as_default` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=30 ;

--
-- Contenu de la table `account_group`
--

INSERT INTO `account_group` (`id`, `name`, `alias`, `as_default`) VALUES
(24, 'Customers12', 'CUSTOMERS', 0),
(25, 'montassar', 'about twitter', 0),
(28, '111111', 'about twitter', 0),
(29, 'montassar', 'bookmarked', 1);

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

--
-- Contenu de la table `account_has_email`
--


-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`id`),
  KEY `fk_contact_account1` (`account_id`),
  KEY `fk_person_person_group1` (`contact_group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=678 ;

--
-- Contenu de la table `contact`
--

INSERT INTO `contact` (`id`, `company`, `firstname`, `lastname`, `date_of_birth`, `phone`, `email`, `mobile`, `fax`, `state`, `create_date_time`, `update_date_time`, `notice`, `account_id`, `contact_group_id`) VALUES
(677, 'AMHSOFT', 'Montassar', NULL, NULL, '58312752', 'montassar@amhsoft.com', NULL, NULL, NULL, NULL, NULL, 'Important Contact', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `contact_group`
--

DROP TABLE IF EXISTS `contact_group`;
CREATE TABLE IF NOT EXISTS `contact_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=325 ;

--
-- Contenu de la table `contact_group`
--

INSERT INTO `contact_group` (`id`, `name`, `alias`) VALUES
(324, 'Motorssouq ', 'MOTO');

-- --------------------------------------------------------

--
-- Structure de la table `lead`
--

DROP TABLE IF EXISTS `lead`;
CREATE TABLE IF NOT EXISTS `lead` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `lead_group_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_person_account1` (`account_id`),
  KEY `fk_person_person_group1` (`lead_group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=677 ;

--
-- Contenu de la table `lead`
--


-- --------------------------------------------------------

--
-- Structure de la table `lead_group`
--

DROP TABLE IF EXISTS `lead_group`;
CREATE TABLE IF NOT EXISTS `lead_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=324 ;

--
-- Contenu de la table `lead_group`
--

INSERT INTO `lead_group` (`id`, `name`, `alias`) VALUES
(1, 'Developper Team', 'DEV_GRP');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `account_has_email`
--
ALTER TABLE `account_has_email`
  ADD CONSTRAINT `account_has_email_ibfk_1` FOREIGN KEY (`webmail_email_id`) REFERENCES `webmail_email` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `account_has_email_ibfk_2` FOREIGN KEY (`crm_account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `contact_ibfk_1` FOREIGN KEY (`contact_group_id`) REFERENCES `contact_group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_contact_account1` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `lead`
--
ALTER TABLE `lead`
  ADD CONSTRAINT `fk_person_account1` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `lead_ibfk_1` FOREIGN KEY (`lead_group_id`) REFERENCES `lead_group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;


ALTER TABLE  `quotation_comment` ADD INDEX (  `account_id` );
ALTER TABLE  `quotation_comment` ADD FOREIGN KEY (  `account_id` ) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE ;

SET FOREIGN_KEY_CHECKS=1;
COMMIT;

