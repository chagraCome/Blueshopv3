-- phpMyAdmin SQL Dump
-- version 4.0.5
-- http://www.phpmyadmin.net
--
-- Client: rdbms
-- Généré le: Mer 04 Décembre 2013 à 23:46
-- Version du serveur: 5.5.31-log
-- Version de PHP: 5.2.17

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de données: `DB1458605`
--

-- --------------------------------------------------------

--
-- Structure de la table `coupon`
--

DROP TABLE IF EXISTS `coupon`;
CREATE TABLE IF NOT EXISTS `coupon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type_id` int(11) NOT NULL,
  `amount` double(12,3) DEFAULT NULL,
  `percent` int(11) DEFAULT NULL,
  `minum_shopping_cart_amount` int(11) DEFAULT NULL,
  `enabled` tinyint(1) DEFAULT NULL,
  `insert_date_time` datetime DEFAULT NULL,
  `update_time_time` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `physical` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `type_id` (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `coupon_code`
--

DROP TABLE IF EXISTS `coupon_code`;
CREATE TABLE IF NOT EXISTS `coupon_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `coupon_id` int(11) NOT NULL,
  `code` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `insert_date_time` datetime NOT NULL,
  `expire_date` date NOT NULL,
  `delivery_date_time` datetime DEFAULT NULL,
  `state_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `coupon_id` (`coupon_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `coupon_code_has_account`
--

DROP TABLE IF EXISTS `coupon_code_has_account`;
CREATE TABLE IF NOT EXISTS `coupon_code_has_account` (
  `coupon_code_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  KEY `coupon_code_id` (`coupon_code_id`,`account_id`),
  KEY `account_id` (`account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `coupon_code_has_saleorder`
--

DROP TABLE IF EXISTS `coupon_code_has_saleorder`;
CREATE TABLE IF NOT EXISTS `coupon_code_has_saleorder` (
  `coupon_code_id` int(11) NOT NULL,
  `saleorder_id` int(11) NOT NULL,
  KEY `coupon_code_id` (`coupon_code_id`),
  KEY `saleorder_id` (`saleorder_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `coupon_code_state`
--

DROP TABLE IF EXISTS `coupon_code_state`;
CREATE TABLE IF NOT EXISTS `coupon_code_state` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `coupon_code_state_lang`
--

DROP TABLE IF EXISTS `coupon_code_state_lang`;
CREATE TABLE IF NOT EXISTS `coupon_code_state_lang` (
  `coupon_code_state_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lang` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  KEY `coupon_state_id` (`coupon_code_state_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `coupon_type`
--

DROP TABLE IF EXISTS `coupon_type`;
CREATE TABLE IF NOT EXISTS `coupon_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

INSERT INTO `coupon_type` (`id`) VALUES ('1');
INSERT INTO `coupon_type` (`id`) VALUES ('2');
--
-- Structure de la table `coupon_type_lang`
--

DROP TABLE IF EXISTS `coupon_type_lang`;
CREATE TABLE IF NOT EXISTS `coupon_type_lang` (
  `coupon_type_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lang` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  KEY `coupon_id` (`coupon_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO `coupon_type_lang` (`coupon_type_id`, `name`, `lang`) VALUES
(1, 'Free Shipping', 'en'),
(1, 'Free Shipping', 'ar'),
(2, 'Discount', 'en'),
(2, 'Discount', 'ar');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `coupon`
--
ALTER TABLE `coupon`
  ADD CONSTRAINT `coupon_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `coupon_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `coupon_code`
--
ALTER TABLE `coupon_code`
  ADD CONSTRAINT `coupon_code_ibfk_1` FOREIGN KEY (`coupon_id`) REFERENCES `coupon` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `coupon_code_has_account`
--
ALTER TABLE `coupon_code_has_account`
  ADD CONSTRAINT `coupon_code_has_account_ibfk_1` FOREIGN KEY (`coupon_code_id`) REFERENCES `coupon_code` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `coupon_code_has_account_ibfk_2` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `coupon_code_has_saleorder`
--
ALTER TABLE `coupon_code_has_saleorder`
  ADD CONSTRAINT `coupon_code_has_saleorder_ibfk_1` FOREIGN KEY (`coupon_code_id`) REFERENCES `coupon_code` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `coupon_code_has_saleorder_ibfk_2` FOREIGN KEY (`saleorder_id`) REFERENCES `sale_order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `coupon_code_state_lang`
--
ALTER TABLE `coupon_code_state_lang`
  ADD CONSTRAINT `coupon_code_state_lang_ibfk_1` FOREIGN KEY (`coupon_code_state_id`) REFERENCES `coupon_code_state` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;
