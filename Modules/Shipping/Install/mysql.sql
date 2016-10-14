-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Lun 21 Octobre 2013 à 12:56
-- Version du serveur: 5.5.16
-- Version de PHP: 5.3.8

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT=0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Module : Shipping
--

-- --------------------------------------------------------

--
-- Structure de la table `shipping`
--

CREATE TABLE IF NOT EXISTS `shipping` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `min_order_amount` double(12,4) DEFAULT NULL,
  `sortid` int(11) DEFAULT NULL,
  `cost` double(12,3) DEFAULT NULL,
  `cost_type` int(1) DEFAULT NULL,
  `packaging_cost` decimal(8,3) DEFAULT NULL,
  `packaging_cost_type` int(1) DEFAULT NULL,
  `shipping_type_id` int(11) DEFAULT NULL,
  `state` tinyint(1) NOT NULL,
  `image_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_shipping_shipping_type1` (`shipping_type_id`),
  KEY `fk_shipping_document1` (`image_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `shipping_has_country`
--

CREATE TABLE IF NOT EXISTS `shipping_has_country` (
  `shipping_id` int(11) NOT NULL,
  `country_code` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  KEY `country_code` (`country_code`),
  KEY `shipping_id` (`shipping_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `shipping_lang`
--

CREATE TABLE IF NOT EXISTS `shipping_lang` (
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `error_message` longtext COLLATE utf8_unicode_ci,
  `shipping_id` int(11) NOT NULL,
  `lang` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  KEY `fk_table1_shipping1` (`shipping_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `shipping_type`
--

CREATE TABLE IF NOT EXISTS `shipping_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Contenu de la table `shipping_type`
--

INSERT INTO `shipping_type` (`id`) VALUES
(1),
(2);


-- --------------------------------------------------------

--
-- Structure de la table `shipping_type_lang`
--

CREATE TABLE IF NOT EXISTS `shipping_type_lang` (
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `shipping_type_id` int(11) NOT NULL,
  `lang` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  KEY `fk_shipping_type_lang_shipping_type1` (`shipping_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `shipping_type_lang`
--

INSERT INTO `shipping_type_lang` (`name`, `shipping_type_id`, `lang`) VALUES
('Free Shipping', 1, 'en'),
('Flatrate Shipping', 2, 'en'),
('شحن مجاني', 1, 'ar'),
('شحن بمقابل', 2, 'ar'),
('Kostenloser Versand', 1, 'de'),
('Pauschaler Versand', 2, 'de');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `shipping`
--
ALTER TABLE `shipping`
  ADD CONSTRAINT `fk_shipping_document1` FOREIGN KEY (`image_id`) REFERENCES `document` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_shipping_image1` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_shipping_shipping_type1` FOREIGN KEY (`shipping_type_id`) REFERENCES `shipping_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `shipping_has_country`
--
ALTER TABLE `shipping_has_country`
  ADD CONSTRAINT `shipping_has_country_ibfk_1` FOREIGN KEY (`shipping_id`) REFERENCES `shipping` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `shipping_lang`
--
ALTER TABLE `shipping_lang`
  ADD CONSTRAINT `fk_table1_shipping1` FOREIGN KEY (`shipping_id`) REFERENCES `shipping` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `shipping_type_lang`
--
ALTER TABLE `shipping_type_lang`
  ADD CONSTRAINT `fk_shipping_type_lang_shipping_type1` FOREIGN KEY (`shipping_type_id`) REFERENCES `shipping_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;
