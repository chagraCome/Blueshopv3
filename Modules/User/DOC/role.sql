-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Mar 06 Novembre 2012 à 11:21
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
-- Structure de la table `rbac_role`
--

DROP TABLE IF EXISTS `rbac_role`;
CREATE TABLE IF NOT EXISTS `rbac_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `parent_id` varchar(45) DEFAULT NULL,
  `state` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `rbac_role_lang`
--

DROP TABLE IF EXISTS `rbac_role_lang`;
CREATE TABLE IF NOT EXISTS `rbac_role_lang` (
  `name` varchar(255) NOT NULL,
  `rbac_role` int(11) NOT NULL,
  `lang` varchar(3) NOT NULL,
  KEY `fk_table1_rbac_role1` (`rbac_role`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `rbac_role_lang`
--
ALTER TABLE `rbac_role_lang`
  ADD CONSTRAINT `fk_table1_rbac_role1` FOREIGN KEY (`rbac_role`) REFERENCES `rbac_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;
