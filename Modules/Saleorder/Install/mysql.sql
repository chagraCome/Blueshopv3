-- phpMyAdmin SQL Dump
-- version 4.0.5
-- http://www.phpmyadmin.net
--
-- Client: rdbms
-- Généré le: Mer 04 Décembre 2013 à 23:40
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
-- Structure de la table `saleorder_has_email`
--

DROP TABLE IF EXISTS `saleorder_has_email`;
CREATE TABLE IF NOT EXISTS `saleorder_has_email` (
  `saleorder_id` int(11) NOT NULL,
  `webmail_email_id` int(11) NOT NULL,
  KEY `saleorder_id` (`saleorder_id`,`webmail_email_id`),
  KEY `webmail_email_id` (`webmail_email_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `sale_order`
--

DROP TABLE IF EXISTS `sale_order`;
CREATE TABLE IF NOT EXISTS `sale_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_address_id` int(11) DEFAULT NULL,
  `shipping_address_id` int(11) DEFAULT NULL,
  `number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_price` double(12,3) DEFAULT NULL,
  `payment_log` text COLLATE utf8_unicode_ci,
  `sale_order_discount_type_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `person_id` int(11) DEFAULT NULL,
  `person_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `creator_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `payment_id` int(11) DEFAULT NULL,
  `insertat` datetime DEFAULT NULL,
  `updateat` datetime DEFAULT NULL,
  `discount` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `policy` text COLLATE utf8_unicode_ci,
  `account_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_mobile` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_cost` double(14,3) DEFAULT NULL,
  `shipping_id` int(11) DEFAULT NULL,
  `currency` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `base_currency` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `currency_set_id` int(11) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `sale_order_state_id` int(11) DEFAULT NULL,
  `sub_total` float(12,3) DEFAULT NULL,
  `handling_fee` float(12,3) DEFAULT NULL,
  `total_discount` double(12,3) DEFAULT NULL,
  `quotation_id` int(11) DEFAULT NULL,
  `contact_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sale_order_sale_order_discount_type1` (`sale_order_discount_type_id`),
  KEY `fk_sale_order_user1` (`user_id`),
  KEY `fk_sale_order_person1` (`person_id`),
  KEY `fk_sale_order_payment1` (`payment_id`),
  KEY `invoice_address_id` (`invoice_address_id`,`shipping_address_id`),
  KEY `shipping_address_id` (`shipping_address_id`),
  KEY `shipping_id` (`shipping_id`),
  KEY `currency_set_id` (`currency_set_id`),
  KEY `contact_id` (`contact_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=33 ;

-- --------------------------------------------------------

--
-- Structure de la table `sale_order_address`
--

DROP TABLE IF EXISTS `sale_order_address`;
CREATE TABLE IF NOT EXISTS `sale_order_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `street` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zipcode` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `province` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=66 ;

--
-- Structure de la table `sale_order_comment`
--

DROP TABLE IF EXISTS `sale_order_comment`;
CREATE TABLE IF NOT EXISTS `sale_order_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` text COLLATE utf8_unicode_ci,
  `user_id` int(11) DEFAULT NULL,
  `sale_order_id` int(11) NOT NULL,
  `insertat` date DEFAULT NULL,
  `author_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `admin_seen` tinyint(1) DEFAULT '0',
  `account_seen` tinyint(1) DEFAULT '0',
  `public` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_sale_order_comment_user1` (`user_id`),
  KEY `fk_sale_order_comment_sale_order1` (`sale_order_id`),
  KEY `account_id` (`account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `sale_order_discount_type`
--

DROP TABLE IF EXISTS `sale_order_discount_type`;
CREATE TABLE IF NOT EXISTS `sale_order_discount_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` enum('fixed','percent') COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `sale_order_has_document`
--

DROP TABLE IF EXISTS `sale_order_has_document`;
CREATE TABLE IF NOT EXISTS `sale_order_has_document` (
  `sale_order_id` int(11) NOT NULL,
  `document_id` int(11) NOT NULL,
  PRIMARY KEY (`sale_order_id`,`document_id`),
  KEY `fk_sale_order_has_document_document1` (`document_id`),
  KEY `fk_sale_order_has_document_sale_order1` (`sale_order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `sale_order_item`
--

DROP TABLE IF EXISTS `sale_order_item`;
CREATE TABLE IF NOT EXISTS `sale_order_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_number` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `unit_price` double(12,3) DEFAULT NULL,
  `discount` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `sale_order_id` int(11) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `product_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `regular_price` float(15,3) DEFAULT NULL,
  `sub_total` float(15,3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sale_order_item_product1` (`item_id`),
  KEY `fk_sale_order_item_sale_order1` (`sale_order_id`),
  KEY `fk_sale_order_item_project1` (`project_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=37 ;

-- --------------------------------------------------------

--
-- Structure de la table `sale_order_item_lang`
--

DROP TABLE IF EXISTS `sale_order_item_lang`;
CREATE TABLE IF NOT EXISTS `sale_order_item_lang` (
  `item_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sale_order_item_id` int(11) DEFAULT NULL,
  `lang` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  KEY `sale_order_item_id` (`sale_order_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `sale_order_lang`
--

DROP TABLE IF EXISTS `sale_order_lang`;
CREATE TABLE IF NOT EXISTS `sale_order_lang` (
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_method_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_method_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sale_order_id` int(11) DEFAULT NULL,
  `lang` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  KEY `sale_order_id` (`sale_order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `sale_order_state`
--

DROP TABLE IF EXISTS `sale_order_state`;
CREATE TABLE IF NOT EXISTS `sale_order_state` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Structure de la table `sale_order_state_lang`
--

DROP TABLE IF EXISTS `sale_order_state_lang`;
CREATE TABLE IF NOT EXISTS `sale_order_state_lang` (
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sale_order_state_id` int(11) DEFAULT NULL,
  `lang` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  KEY `sale_order_state_id` (`sale_order_state_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `saleorder_has_email`
--
ALTER TABLE `saleorder_has_email`
  ADD CONSTRAINT `saleorder_has_email_ibfk_1` FOREIGN KEY (`saleorder_id`) REFERENCES `sale_order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `saleorder_has_email_ibfk_2` FOREIGN KEY (`webmail_email_id`) REFERENCES `webmail_email` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `sale_order`
--
ALTER TABLE `sale_order`
  ADD CONSTRAINT `fk_sale_order_payment1` FOREIGN KEY (`payment_id`) REFERENCES `payment` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sale_order_person1` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sale_order_sale_order_discount_type1` FOREIGN KEY (`sale_order_discount_type_id`) REFERENCES `sale_order_discount_type` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sale_order_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `sale_order_ibfk_1` FOREIGN KEY (`invoice_address_id`) REFERENCES `sale_order_address` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sale_order_ibfk_2` FOREIGN KEY (`shipping_address_id`) REFERENCES `sale_order_address` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sale_order_ibfk_3` FOREIGN KEY (`shipping_id`) REFERENCES `shipping` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sale_order_ibfk_4` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `sale_order_comment`
--
ALTER TABLE `sale_order_comment`
  ADD CONSTRAINT `fk_sale_order_comment_sale_order1` FOREIGN KEY (`sale_order_id`) REFERENCES `sale_order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sale_order_comment_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `sale_order_comment_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `sale_order_has_document`
--
ALTER TABLE `sale_order_has_document`
  ADD CONSTRAINT `fk_sale_order_has_document_document1` FOREIGN KEY (`document_id`) REFERENCES `document` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sale_order_has_document_sale_order1` FOREIGN KEY (`sale_order_id`) REFERENCES `sale_order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `sale_order_item`
--
ALTER TABLE `sale_order_item`
  ADD CONSTRAINT `fk_sale_order_item_product1` FOREIGN KEY (`item_id`) REFERENCES `product` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sale_order_item_project1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sale_order_item_sale_order1` FOREIGN KEY (`sale_order_id`) REFERENCES `sale_order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `sale_order_item_lang`
--
ALTER TABLE `sale_order_item_lang`
  ADD CONSTRAINT `sale_order_item_lang_ibfk_1` FOREIGN KEY (`sale_order_item_id`) REFERENCES `sale_order_item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `sale_order_lang`
--
ALTER TABLE `sale_order_lang`
  ADD CONSTRAINT `sale_order_lang_ibfk_1` FOREIGN KEY (`sale_order_id`) REFERENCES `sale_order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `sale_order_state_lang`
--
ALTER TABLE `sale_order_state_lang`
  ADD CONSTRAINT `sale_order_state_lang_ibfk_1` FOREIGN KEY (`sale_order_state_id`) REFERENCES `sale_order_state` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;
