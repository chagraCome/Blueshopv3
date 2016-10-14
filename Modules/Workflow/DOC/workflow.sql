-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Lun 12 Novembre 2012 à 16:04
-- Version du serveur: 5.5.16
-- Version de PHP: 5.3.8

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT=0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de données: `amhshoppro`
--

-- --------------------------------------------------------

--
-- Structure de la table `workflow`
--

DROP TABLE IF EXISTS `workflow`;
CREATE TABLE IF NOT EXISTS `workflow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `eventname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `state` tinyint(1) DEFAULT NULL,
  `modelname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Structure de la table `workflow_condition`
--

DROP TABLE IF EXISTS `workflow_condition`;
CREATE TABLE IF NOT EXISTS `workflow_condition` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `condition_left` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `condition_right` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `condition_op` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` tinyint(1) DEFAULT NULL,
  `workflow_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_workflow_condition_workflow1` (`workflow_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Structure de la table `workflow_lang`
--

DROP TABLE IF EXISTS `workflow_lang`;
CREATE TABLE IF NOT EXISTS `workflow_lang` (
  `workflow_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lang` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  KEY `fk_workflow_lang_workflow1` (`workflow_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `workflow_mail_action`
--

DROP TABLE IF EXISTS `workflow_mail_action`;
CREATE TABLE IF NOT EXISTS `workflow_mail_action` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `to` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bcc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` tinyint(1) DEFAULT NULL,
  `workflow_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_workflow_mail_action_workflow1` (`workflow_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Structure de la table `workflow_mail_action_lang`
--

DROP TABLE IF EXISTS `workflow_mail_action_lang`;
CREATE TABLE IF NOT EXISTS `workflow_mail_action_lang` (
  `workflow_mail_action_id` int(11) NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `body` longtext COLLATE utf8_unicode_ci,
  `lang` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  KEY `fk_workflow_mail_action_lang_workflow_mail_action1` (`workflow_mail_action_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `workflow_sms_action`
--

DROP TABLE IF EXISTS `workflow_sms_action`;
CREATE TABLE IF NOT EXISTS `workflow_sms_action` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` tinyint(1) DEFAULT NULL,
  `workflow_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_workflow_sms_action_workflow1` (`workflow_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Structure de la table `workflow_sms_action_lang`
--

DROP TABLE IF EXISTS `workflow_sms_action_lang`;
CREATE TABLE IF NOT EXISTS `workflow_sms_action_lang` (
  `workflow_sms_action_id` int(11) NOT NULL,
  `body` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lang` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  KEY `fk_workflow_sms_action_lang_workflow_sms_action1` (`workflow_sms_action_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `workflow_condition`
--
ALTER TABLE `workflow_condition`
  ADD CONSTRAINT `fk_workflow_condition_workflow1` FOREIGN KEY (`workflow_id`) REFERENCES `workflow` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `workflow_lang`
--
ALTER TABLE `workflow_lang`
  ADD CONSTRAINT `fk_workflow_lang_workflow1` FOREIGN KEY (`workflow_id`) REFERENCES `workflow` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `workflow_mail_action`
--
ALTER TABLE `workflow_mail_action`
  ADD CONSTRAINT `fk_workflow_mail_action_workflow1` FOREIGN KEY (`workflow_id`) REFERENCES `workflow` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `workflow_mail_action_lang`
--
ALTER TABLE `workflow_mail_action_lang`
  ADD CONSTRAINT `fk_workflow_mail_action_lang_workflow_mail_action1` FOREIGN KEY (`workflow_mail_action_id`) REFERENCES `workflow_mail_action` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `workflow_sms_action`
--
ALTER TABLE `workflow_sms_action`
  ADD CONSTRAINT `fk_workflow_sms_action_workflow1` FOREIGN KEY (`workflow_id`) REFERENCES `workflow` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `workflow_sms_action_lang`
--
ALTER TABLE `workflow_sms_action_lang`
  ADD CONSTRAINT `fk_workflow_sms_action_lang_workflow_sms_action1` FOREIGN KEY (`workflow_sms_action_id`) REFERENCES `workflow_sms_action` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;
