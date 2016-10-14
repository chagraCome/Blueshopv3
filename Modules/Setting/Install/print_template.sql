-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Jeu 13 Décembre 2012 à 11:13
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
-- Structure de la table `print_template`
--

DROP TABLE IF EXISTS `print_template`;
CREATE TABLE IF NOT EXISTS `print_template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=33 ;

-- --------------------------------------------------------

--
-- Structure de la table `print_template_lang`
--

DROP TABLE IF EXISTS `print_template_lang`;
CREATE TABLE IF NOT EXISTS `print_template_lang` (
  `content` text COLLATE utf8_unicode_ci,
  `print_template_id` int(11) DEFAULT NULL,
  `lang` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  KEY `print_template_id` (`print_template_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `print_template_lang`
--
ALTER TABLE `print_template_lang`
  ADD CONSTRAINT `print_template_lang_ibfk_1` FOREIGN KEY (`print_template_id`) REFERENCES `print_template` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;
