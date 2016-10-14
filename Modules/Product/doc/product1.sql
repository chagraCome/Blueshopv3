-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Jeu 13 Décembre 2012 à 10:48
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
-- Structure de la table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` float(15,3) DEFAULT NULL,
  `online` tinyint(1) NOT NULL,
  `categorie_id` int(11) DEFAULT NULL,
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
  `weight` decimal(8,3) DEFAULT NULL,
  `fix_shipping_cost` decimal(12,3) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `publish_date_from` date DEFAULT NULL,
  `publish_date_to` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_product_set1` (`entity_set_id`),
  KEY `categorie_id` (`categorie_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Structure de la table `product_attribute`
--

DROP TABLE IF EXISTS `product_attribute`;
CREATE TABLE IF NOT EXISTS `product_attribute` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `defaultvalue` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type_frontend` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'Label',
  `validator` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `required` tinyint(1) DEFAULT NULL,
  `product_attribute_type_backend_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  KEY `fk_product_attribute_product_attribute_type1` (`product_attribute_type_backend_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Structure de la table `product_attribute_datasource`
--

DROP TABLE IF EXISTS `product_attribute_datasource`;
CREATE TABLE IF NOT EXISTS `product_attribute_datasource` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_attribute_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_attribute_id` (`product_attribute_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=39 ;

-- --------------------------------------------------------

--
-- Structure de la table `product_attribute_datasource_lang`
--

DROP TABLE IF EXISTS `product_attribute_datasource_lang`;
CREATE TABLE IF NOT EXISTS `product_attribute_datasource_lang` (
  `value` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lang` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product_attribute_datasource_id` int(11) NOT NULL,
  KEY `fk_product_attribute_datasource_lang_product_attribute_dataso1` (`product_attribute_datasource_id`),
  KEY `lang` (`lang`),
  KEY `value` (`value`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `product_attribute_lang`
--

DROP TABLE IF EXISTS `product_attribute_lang`;
CREATE TABLE IF NOT EXISTS `product_attribute_lang` (
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `datasource` text COLLATE utf8_unicode_ci,
  `product_attribute_id` int(11) NOT NULL,
  `lang` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `errormessage` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  KEY `fk_product_attribute_lang_product_attribute1` (`product_attribute_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `product_attribute_type`
--

DROP TABLE IF EXISTS `product_attribute_type`;
CREATE TABLE IF NOT EXISTS `product_attribute_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `typename` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Structure de la table `product_attribute_value`
--

DROP TABLE IF EXISTS `product_attribute_value`;
CREATE TABLE IF NOT EXISTS `product_attribute_value` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_attribute_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_attribute_value_product_attribute1` (`product_attribute_id`),
  KEY `fk_product_attribute_value_product1` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=41 ;

-- --------------------------------------------------------

--
-- Structure de la table `product_attribute_value_lang`
--

DROP TABLE IF EXISTS `product_attribute_value_lang`;
CREATE TABLE IF NOT EXISTS `product_attribute_value_lang` (
  `value` text COLLATE utf8_unicode_ci,
  `lang` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product_attribute_value_id` int(11) NOT NULL,
  KEY `fk_product_attribute_value_lang_product_attribute_value1` (`product_attribute_value_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  PRIMARY KEY (`id`),
  KEY `fk_product_category_image1` (`image_id`),
  KEY `fk_product_category_product_category1` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

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
  KEY `fk_product_lang_product1` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `product_pivot_ar`
--

DROP TABLE IF EXISTS `product_pivot_ar`;
CREATE TABLE IF NOT EXISTS `product_pivot_ar` (
  `id` int(11) NOT NULL DEFAULT '0',
  `number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` float(15,4) NOT NULL,
  `online` tinyint(1) NOT NULL,
  `categorie_id` int(11) DEFAULT NULL,
  `discount` double(10,2) NOT NULL,
  `remote_id` int(11) DEFAULT NULL,
  `insertat` datetime DEFAULT NULL,
  `updateat` datetime DEFAULT NULL,
  `entity_set_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci,
  `lang` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Amir` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `product_pivot_en`
--

DROP TABLE IF EXISTS `product_pivot_en`;
CREATE TABLE IF NOT EXISTS `product_pivot_en` (
  `id` int(11) NOT NULL DEFAULT '0',
  `number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` float(15,4) NOT NULL,
  `online` tinyint(1) NOT NULL,
  `categorie_id` int(11) DEFAULT NULL,
  `discount` double(10,2) NOT NULL,
  `remote_id` int(11) DEFAULT NULL,
  `insertat` datetime DEFAULT NULL,
  `updateat` datetime DEFAULT NULL,
  `entity_set_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci,
  `lang` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Amir` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `product_set`
--

DROP TABLE IF EXISTS `product_set`;
CREATE TABLE IF NOT EXISTS `product_set` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Structure de la table `product_set_has_product_attribute`
--

DROP TABLE IF EXISTS `product_set_has_product_attribute`;
CREATE TABLE IF NOT EXISTS `product_set_has_product_attribute` (
  `product_set_id` int(11) NOT NULL,
  `product_attribute_id` int(11) NOT NULL,
  `sortid` int(11) DEFAULT NULL,
  PRIMARY KEY (`product_set_id`,`product_attribute_id`),
  KEY `fk_product_set_has_product_attribute_product_attribute1` (`product_attribute_id`),
  KEY `fk_product_set_has_product_attribute_product_set1` (`product_set_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `product_set_view`
--

DROP TABLE IF EXISTS `product_set_view`;
CREATE TABLE IF NOT EXISTS `product_set_view` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `frontendvisible` tinyint(1) DEFAULT NULL,
  `product_set_id` int(11) NOT NULL,
  `sortid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_set_view_product_set1` (`product_set_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=33 ;

-- --------------------------------------------------------

--
-- Structure de la table `product_set_view_lang`
--

DROP TABLE IF EXISTS `product_set_view_lang`;
CREATE TABLE IF NOT EXISTS `product_set_view_lang` (
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lang` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product_set_view_id` int(11) NOT NULL,
  KEY `fk_product_set_view_lang_product_set_view1` (`product_set_view_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=42 ;

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

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`entity_set_id`) REFERENCES `entity_set` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `product_attribute`
--
ALTER TABLE `product_attribute`
  ADD CONSTRAINT `fk_product_attribute_product_attribute_type1` FOREIGN KEY (`product_attribute_type_backend_id`) REFERENCES `product_attribute_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `product_attribute_datasource`
--
ALTER TABLE `product_attribute_datasource`
  ADD CONSTRAINT `product_attribute_datasource_ibfk_1` FOREIGN KEY (`product_attribute_id`) REFERENCES `product_attribute` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `product_attribute_datasource_lang`
--
ALTER TABLE `product_attribute_datasource_lang`
  ADD CONSTRAINT `fk_product_attribute_datasource_lang_product_attribute_dataso1` FOREIGN KEY (`product_attribute_datasource_id`) REFERENCES `product_attribute_datasource` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `product_attribute_lang`
--
ALTER TABLE `product_attribute_lang`
  ADD CONSTRAINT `fk_product_attribute_lang_product_attribute1` FOREIGN KEY (`product_attribute_id`) REFERENCES `product_attribute` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `product_attribute_value`
--
ALTER TABLE `product_attribute_value`
  ADD CONSTRAINT `fk_product_attribute_value_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_attribute_value_product_attribute1` FOREIGN KEY (`product_attribute_id`) REFERENCES `product_attribute` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `product_attribute_value_lang`
--
ALTER TABLE `product_attribute_value_lang`
  ADD CONSTRAINT `fk_product_attribute_value_lang_product_attribute_value1` FOREIGN KEY (`product_attribute_value_id`) REFERENCES `product_attribute_value` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `product_category`
--
ALTER TABLE `product_category`
  ADD CONSTRAINT `fk_product_category_image1` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_category_product_category1` FOREIGN KEY (`parent_id`) REFERENCES `product_category` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `product_comment`
--
ALTER TABLE `product_comment`
  ADD CONSTRAINT `fk_product_comment_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `product_configuration`
--
ALTER TABLE `product_configuration`
  ADD CONSTRAINT `fk_product_configuration_product_set1` FOREIGN KEY (`product_set_id`) REFERENCES `product_set` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `fk_product_configuration_has_product_attribute_product_attrib1` FOREIGN KEY (`product_attribute_id`) REFERENCES `product_attribute` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
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
-- Contraintes pour la table `product_set_has_product_attribute`
--
ALTER TABLE `product_set_has_product_attribute`
  ADD CONSTRAINT `fk_product_set_has_product_attribute_product_attribute1` FOREIGN KEY (`product_attribute_id`) REFERENCES `product_attribute` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_set_has_product_attribute_product_set1` FOREIGN KEY (`product_set_id`) REFERENCES `product_set` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `product_set_view`
--
ALTER TABLE `product_set_view`
  ADD CONSTRAINT `product_set_view_ibfk_1` FOREIGN KEY (`product_set_id`) REFERENCES `product_set` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `product_set_view_lang`
--
ALTER TABLE `product_set_view_lang`
  ADD CONSTRAINT `fk_product_set_view_lang_product_set_view1` FOREIGN KEY (`product_set_view_id`) REFERENCES `product_set_view` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
