-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Ven 26 Avril 2013 à 12:51
-- Version du serveur: 5.5.16
-- Version de PHP: 5.3.8

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT=0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de données: `braun`
--

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT '1',
  `account_id` int(11) DEFAULT NULL,
  `number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` float(15,3) DEFAULT NULL,
  `online` tinyint(1) NOT NULL,
  `categorie_id` int(11) DEFAULT NULL,
  `discount` double(10,2) NOT NULL,
  `remote_id` int(11) DEFAULT NULL,
  `insertat` datetime DEFAULT NULL,
  `updateat` datetime DEFAULT NULL,
  `entity_set_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `special_price` decimal(12,3) DEFAULT NULL,
  `special_price_date_from` date DEFAULT NULL,
  `special_price_date_to` date DEFAULT NULL,
  `manage_stock` tinyint(1) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `show_only` tinyint(1) DEFAULT '0',
  `is_new` int(11) DEFAULT NULL,
  `sort_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_product_set1` (`entity_set_id`),
  KEY `categorie_id` (`categorie_id`),
  KEY `show_only` (`show_only`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `product_category`
--

DROP TABLE IF EXISTS `product_category`;
CREATE TABLE IF NOT EXISTS `product_category` (
  `id` bigint(31) NOT NULL AUTO_INCREMENT,
  `sortid` int(11) DEFAULT '0',
  `state` int(1) DEFAULT '1',
  `image_id` int(11) DEFAULT NULL,
  `parent_id` bigint(31) DEFAULT NULL,
  `previous` int(11) DEFAULT NULL,
  `next` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_category_image1` (`image_id`),
  KEY `fk_product_category_product_category1` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `product_category_lang`
--

DROP TABLE IF EXISTS `product_category_lang`;
CREATE TABLE IF NOT EXISTS `product_category_lang` (
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `lang` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product_category_id` bigint(31) NOT NULL,
  KEY `fk_product_category_lang_product_category1` (`product_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `product_category_view`
--
DROP VIEW IF EXISTS `product_category_view`;
CREATE TABLE IF NOT EXISTS `product_category_view` (
`id` bigint(31)
,`sortid` int(11)
,`state` int(1)
,`image_id` int(11)
,`parent_id` bigint(31)
,`previous` int(11)
,`next` int(11)
,`name` varchar(255)
,`description` longtext
,`lang` varchar(3)
,`product_category_id` bigint(31)
);
-- --------------------------------------------------------

--
-- Structure de la table `product_comment`
--

DROP TABLE IF EXISTS `product_comment`;
CREATE TABLE IF NOT EXISTS `product_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment` text COLLATE utf8_unicode_ci,
  `public` tinyint(1) DEFAULT NULL,
  `author` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `insertat` date DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_comment_product1` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `product_configuration`
--

DROP TABLE IF EXISTS `product_configuration`;
CREATE TABLE IF NOT EXISTS `product_configuration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product_set_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_configuration_product_set1` (`product_set_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `product_configuration_has_product`
--

DROP TABLE IF EXISTS `product_configuration_has_product`;
CREATE TABLE IF NOT EXISTS `product_configuration_has_product` (
  `product_configuration_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`product_configuration_id`,`product_id`),
  KEY `fk_product_configuration_has_product_product1` (`product_id`),
  KEY `fk_product_configuration_has_product_product_configuration1` (`product_configuration_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `product_configuration_has_product_attribute`
--

DROP TABLE IF EXISTS `product_configuration_has_product_attribute`;
CREATE TABLE IF NOT EXISTS `product_configuration_has_product_attribute` (
  `product_configuration_id` int(11) NOT NULL,
  `product_attribute_id` int(11) NOT NULL,
  PRIMARY KEY (`product_configuration_id`,`product_attribute_id`),
  KEY `fk_product_configuration_has_product_attribute_product_attrib1` (`product_attribute_id`),
  KEY `fk_product_configuration_has_product_attribute_product_config1` (`product_configuration_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `product_cross_selling`
--

DROP TABLE IF EXISTS `product_cross_selling`;
CREATE TABLE IF NOT EXISTS `product_cross_selling` (
  `product_id` int(11) NOT NULL,
  `cross_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`cross_id`),
  KEY `fk_product_has_product_product4` (`cross_id`),
  KEY `fk_product_has_product_product3` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `product_hast_grouped_product`
--

DROP TABLE IF EXISTS `product_hast_grouped_product`;
CREATE TABLE IF NOT EXISTS `product_hast_grouped_product` (
  `grouped_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  KEY `fk_product_hast_grouped_product_product1` (`grouped_id`),
  KEY `fk_product_hast_grouped_product_product2` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `product_has_document`
--

DROP TABLE IF EXISTS `product_has_document`;
CREATE TABLE IF NOT EXISTS `product_has_document` (
  `product_id` int(11) NOT NULL,
  `document_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`document_id`),
  KEY `fk_product_has_document_document1` (`document_id`),
  KEY `fk_product_has_document_product1` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `product_has_image`
--

DROP TABLE IF EXISTS `product_has_image`;
CREATE TABLE IF NOT EXISTS `product_has_image` (
  `product_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  `sortid` int(11) DEFAULT NULL,
  PRIMARY KEY (`product_id`,`image_id`),
  KEY `fk_product_has_image_image1` (`image_id`),
  KEY `fk_product_has_image_product1` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `product_has_product_category`
--

DROP TABLE IF EXISTS `product_has_product_category`;
CREATE TABLE IF NOT EXISTS `product_has_product_category` (
  `product_id` int(11) NOT NULL,
  `product_category_id` bigint(31) NOT NULL,
  PRIMARY KEY (`product_id`,`product_category_id`),
  KEY `fk_product_has_product_category_product_category1` (`product_category_id`),
  KEY `fk_product_has_product_category_product1` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `product_has_related_product`
--

DROP TABLE IF EXISTS `product_has_related_product`;
CREATE TABLE IF NOT EXISTS `product_has_related_product` (
  `product_id` int(11) NOT NULL,
  `related_product_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`related_product_id`),
  KEY `fk_product_has_product_product2` (`related_product_id`),
  KEY `fk_product_has_product_product1` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `product_lang`
--

DROP TABLE IF EXISTS `product_lang`;
CREATE TABLE IF NOT EXISTS `product_lang` (
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `lang` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  KEY `fk_product_lang_product1` (`product_id`),
  KEY `lang` (`lang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `product_pivot_ar`
--

DROP TABLE IF EXISTS `product_pivot_ar`;
CREATE TABLE IF NOT EXISTS `product_pivot_ar` (
  `id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) DEFAULT '1',
  `account_id` int(11) DEFAULT NULL,
  `number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` float(15,3) DEFAULT NULL,
  `online` tinyint(1) NOT NULL,
  `categorie_id` int(11) DEFAULT NULL,
  `discount` double(10,2) NOT NULL,
  `remote_id` int(11) DEFAULT NULL,
  `insertat` datetime DEFAULT NULL,
  `updateat` datetime DEFAULT NULL,
  `entity_set_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `special_price` decimal(12,3) DEFAULT NULL,
  `special_price_date_from` date DEFAULT NULL,
  `special_price_date_to` date DEFAULT NULL,
  `manage_stock` tinyint(1) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `show_only` tinyint(1) DEFAULT '0',
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lang` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shoe_size` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shoe_color` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shoe_brand` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shoe_material` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Jacket_size` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `jacket_style` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `jacket_material` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `jacket_brand` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `jacket_colour` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hat_size` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hat_brand` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hat_color` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hat_material` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hat_style` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hat_season` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `product_pivot_en`
--

DROP TABLE IF EXISTS `product_pivot_en`;
CREATE TABLE IF NOT EXISTS `product_pivot_en` (
  `id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) DEFAULT '1',
  `account_id` int(11) DEFAULT NULL,
  `number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` float(15,3) DEFAULT NULL,
  `online` tinyint(1) NOT NULL,
  `categorie_id` int(11) DEFAULT NULL,
  `discount` double(10,2) NOT NULL,
  `remote_id` int(11) DEFAULT NULL,
  `insertat` datetime DEFAULT NULL,
  `updateat` datetime DEFAULT NULL,
  `entity_set_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `special_price` decimal(12,3) DEFAULT NULL,
  `special_price_date_from` date DEFAULT NULL,
  `special_price_date_to` date DEFAULT NULL,
  `manage_stock` tinyint(1) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `show_only` tinyint(1) DEFAULT '0',
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lang` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shoe_size` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shoe_color` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shoe_brand` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shoe_material` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Jacket_size` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `jacket_style` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `jacket_material` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `jacket_brand` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `jacket_colour` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hat_size` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hat_brand` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hat_color` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hat_material` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hat_style` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hat_season` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `product_table_price`
--

DROP TABLE IF EXISTS `product_table_price`;
CREATE TABLE IF NOT EXISTS `product_table_price` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `table_quantity` int(11) NOT NULL,
  `table_price` decimal(12,3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tyre_id` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `product_up_selling`
--

DROP TABLE IF EXISTS `product_up_selling`;
CREATE TABLE IF NOT EXISTS `product_up_selling` (
  `product_id` int(11) NOT NULL,
  `up_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`up_id`),
  KEY `fk_product_has_product_product6` (`up_id`),
  KEY `fk_product_has_product_product5` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la vue `product_category_view`
--
DROP TABLE IF EXISTS `product_category_view`;

CREATE  VIEW `product_category_view` AS select `product_category`.`id` AS `id`,`product_category`.`sortid` AS `sortid`,`product_category`.`state` AS `state`,`product_category`.`image_id` AS `image_id`,`product_category`.`parent_id` AS `parent_id`,`product_category`.`previous` AS `previous`,`product_category`.`next` AS `next`,`product_category_lang`.`name` AS `name`,`product_category_lang`.`description` AS `description`,`product_category_lang`.`lang` AS `lang`,`product_category_lang`.`product_category_id` AS `product_category_id` from (`product_category` left join `product_category_lang` on((`product_category_lang`.`product_category_id` = `product_category`.`id`)));

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`entity_set_id`) REFERENCES `entity_set` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `product_category`
--
ALTER TABLE `product_category`
  ADD CONSTRAINT `fk_product_category_image1` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_category_product_category1` FOREIGN KEY (`parent_id`) REFERENCES `product_category` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `product_category_lang`
--
ALTER TABLE `product_category_lang`
  ADD CONSTRAINT `product_category_lang_ibfk_1` FOREIGN KEY (`product_category_id`) REFERENCES `product_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `product_comment`
--
ALTER TABLE `product_comment`
  ADD CONSTRAINT `fk_product_comment_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `product_configuration`
--
ALTER TABLE `product_configuration`
  ADD CONSTRAINT `fk_product_configuration_product_set1` FOREIGN KEY (`product_set_id`) REFERENCES `entity_set` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `product_configuration_has_product`
--
ALTER TABLE `product_configuration_has_product`
  ADD CONSTRAINT `fk_product_configuration_has_product_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_configuration_has_product_product_configuration1` FOREIGN KEY (`product_configuration_id`) REFERENCES `product_configuration` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `product_configuration_has_product_attribute`
--
ALTER TABLE `product_configuration_has_product_attribute`
  ADD CONSTRAINT `fk_product_configuration_has_product_attribute_product_attrib1` FOREIGN KEY (`product_attribute_id`) REFERENCES `entity_attribute` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_configuration_has_product_attribute_product_config1` FOREIGN KEY (`product_configuration_id`) REFERENCES `product_configuration` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `product_cross_selling`
--
ALTER TABLE `product_cross_selling`
  ADD CONSTRAINT `fk_product_has_product_product3` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_has_product_product4` FOREIGN KEY (`cross_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `product_hast_grouped_product`
--
ALTER TABLE `product_hast_grouped_product`
  ADD CONSTRAINT `fk_product_hast_grouped_product_product1` FOREIGN KEY (`grouped_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_hast_grouped_product_product2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `product_has_document`
--
ALTER TABLE `product_has_document`
  ADD CONSTRAINT `fk_product_has_document_document1` FOREIGN KEY (`document_id`) REFERENCES `document` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_has_document_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `product_has_image`
--
ALTER TABLE `product_has_image`
  ADD CONSTRAINT `fk_product_has_image_image1` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_has_image_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `product_has_product_category`
--
ALTER TABLE `product_has_product_category`
  ADD CONSTRAINT `fk_product_has_product_category_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_has_product_category_product_category1` FOREIGN KEY (`product_category_id`) REFERENCES `product_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `product_has_related_product`
--
ALTER TABLE `product_has_related_product`
  ADD CONSTRAINT `fk_product_has_product_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_has_product_product2` FOREIGN KEY (`related_product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `product_lang`
--
ALTER TABLE `product_lang`
  ADD CONSTRAINT `fk_product_lang_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `product_table_price`
--
ALTER TABLE `product_table_price`
  ADD CONSTRAINT `product_table_price_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `product_up_selling`
--
ALTER TABLE `product_up_selling`
  ADD CONSTRAINT `fk_product_has_product_product5` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_has_product_product6` FOREIGN KEY (`up_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;
