
-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Mar 01 Octobre 2013 à 08:06
-- Version du serveur: 5.5.16
-- Version de PHP: 5.3.8

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT=0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de données: `clean_braun`
--

-- --------------------------------------------------------

--
-- Structure de la table `contact_has_email`
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
-- Structure de la table `lead_has_email`
--

DROP TABLE IF EXISTS `lead_has_email`;
CREATE TABLE IF NOT EXISTS `lead_has_email` (
  `webmail_email_id` int(11) DEFAULT NULL,
  `crm_lead_id` int(11) DEFAULT NULL,
  KEY `webmail_email_id` (`webmail_email_id`,`crm_lead_id`),
  KEY `crm_lead_id` (`crm_lead_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Structure de la table `account_source`
--

DROP TABLE IF EXISTS `account_source`;
CREATE TABLE IF NOT EXISTS `account_source` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Structure de la table `account_source_lang`
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
-- Structure de la table `account_stage`
--

DROP TABLE IF EXISTS `account_stage`;
CREATE TABLE IF NOT EXISTS `account_stage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Structure de la table `account_stage_lang`
--

DROP TABLE IF EXISTS `account_stage_lang`;
CREATE TABLE IF NOT EXISTS `account_stage_lang` (
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lang` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_stage_id` int(11) DEFAULT NULL,
  KEY `account_stage_id` (`account_stage_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `contact_source`
--

DROP TABLE IF EXISTS `contact_source`;
CREATE TABLE IF NOT EXISTS `contact_source` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Structure de la table `contact_source_lang`
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
-- Structure de la table `contact_stage`
--

DROP TABLE IF EXISTS `contact_stage`;
CREATE TABLE IF NOT EXISTS `contact_stage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Structure de la table `contact_stage_lang`
--

DROP TABLE IF EXISTS `contact_stage_lang`;
CREATE TABLE IF NOT EXISTS `contact_stage_lang` (
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lang` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_stage_id` int(11) DEFAULT NULL,
  KEY `contact_stage_id` (`contact_stage_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Modification of all columns
--

ALTER TABLE  `contact` ADD  `number` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL AFTER  `id`;
ALTER TABLE  `lead` ADD  `number` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL AFTER  `id`;


ALTER TABLE  `contact` ADD  `contact_source_id` INT( 11 ) NULL AFTER  `contact_group_id` ,
ADD  `contact_stage_id` INT( 11 ) NULL AFTER  `contact_source_id` ,
ADD INDEX (  `contact_source_id` );
ALTER TABLE  `contact` ADD INDEX (  `contact_stage_id` );

ALTER TABLE  `contact` ADD FOREIGN KEY (  `contact_source_id` ) REFERENCES  `saudisub`.`contact_source` (
`id`
) ON DELETE CASCADE ON UPDATE CASCADE ;

ALTER TABLE  `contact` ADD FOREIGN KEY (  `contact_stage_id` ) REFERENCES  `saudisub`.`contact_stage` (
`id`
) ON DELETE CASCADE ON UPDATE CASCADE ;


ALTER TABLE  `account` ADD  `account_source_id` INT( 11 ) NULL,
ADD  `account_stage_id` INT( 11 ) NULL AFTER  `account_source_id` ,
ADD INDEX (  `account_source_id` )
ALTER TABLE  `account` ADD INDEX (  `account_stage_id` );

ALTER TABLE  `account` ADD FOREIGN KEY (  `account_source_id` ) REFERENCES  `saudisub`.`account_source` (
`id`
) ON DELETE CASCADE ON UPDATE CASCADE ;

ALTER TABLE  `account` ADD FOREIGN KEY (  `account_stage_id` ) REFERENCES  `saudisub`.`account_stage` (
`id`
) ON DELETE CASCADE ON UPDATE CASCADE ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `contact_has_email`
--
ALTER TABLE `contact_has_email`
  ADD CONSTRAINT `contact_has_email_ibfk_1` FOREIGN KEY (`webmail_email_id`) REFERENCES `webmail_email` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contact_has_email_ibfk_2` FOREIGN KEY (`crm_contact_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `lead_has_email`
--
ALTER TABLE `lead_has_email`
  ADD CONSTRAINT `lead_has_email_ibfk_1` FOREIGN KEY (`webmail_email_id`) REFERENCES `webmail_email` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lead_has_email_ibfk_2` FOREIGN KEY (`crm_lead_id`) REFERENCES `lead` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;


--
-- Contraintes pour la table `account_source_lang`
--
ALTER TABLE `account_source_lang`
  ADD CONSTRAINT `account_source_lang_ibfk_1` FOREIGN KEY (`account_source_id`) REFERENCES `account_source` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `account_stage_lang`
--
ALTER TABLE `account_stage_lang`
  ADD CONSTRAINT `account_stage_lang_ibfk_1` FOREIGN KEY (`account_stage_id`) REFERENCES `account_stage` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `contact_source_lang`
--
ALTER TABLE `contact_source_lang`
  ADD CONSTRAINT `contact_source_lang_ibfk_1` FOREIGN KEY (`contact_source_id`) REFERENCES `contact_source` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `contact_stage_lang`
--
ALTER TABLE `contact_stage_lang`
  ADD CONSTRAINT `contact_stage_lang_ibfk_1` FOREIGN KEY (`contact_stage_id`) REFERENCES `contact_stage` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

SET FOREIGN_KEY_CHECKS=1;
COMMIT;
