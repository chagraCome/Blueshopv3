-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Sam 15 Décembre 2012 à 13:10
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
-- Structure de la table `sale_order`
--

DROP TABLE IF EXISTS `sale_order`;
CREATE TABLE IF NOT EXISTS `sale_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_address_id` int(11) DEFAULT NULL,
  `shipping_address_id` int(11) DEFAULT NULL,
  `number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_price` double(12,3) NOT NULL,
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
  `discount` double(12,3) DEFAULT NULL,
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
  `sub_total` float(12,3) NOT NULL,
  `handling_fee` float(12,3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sale_order_sale_order_discount_type1` (`sale_order_discount_type_id`),
  KEY `fk_sale_order_user1` (`user_id`),
  KEY `fk_sale_order_person1` (`person_id`),
  KEY `fk_sale_order_payment1` (`payment_id`),
  KEY `invoice_address_id` (`invoice_address_id`,`shipping_address_id`),
  KEY `shipping_address_id` (`shipping_address_id`),
  KEY `shipping_id` (`shipping_id`),
  KEY `currency_set_id` (`currency_set_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Contenu de la table `sale_order`
--

INSERT INTO `sale_order` (`id`, `invoice_address_id`, `shipping_address_id`, `number`, `total_price`, `payment_log`, `sale_order_discount_type_id`, `user_id`, `person_id`, `person_name`, `creator_name`, `due_date`, `description`, `payment_id`, `insertat`, `updateat`, `discount`, `policy`, `account_name`, `account_email`, `account_mobile`, `shipping_cost`, `shipping_id`, `currency`, `base_currency`, `currency_set_id`, `account_id`, `sale_order_state_id`, `sub_total`, `handling_fee`) VALUES
(4, 3, 4, 'N4', 100.000, '', NULL, NULL, NULL, NULL, 'Montasser', '2012-12-13', NULL, NULL, '2012-12-13 12:29:52', '2012-12-13 12:29:52', 0.000, 'default_policy arabic', 'Montasser', NULL, 'Montasser', NULL, NULL, 'BHD', 'BHD', 18, 1187, NULL, 0.000, 0.000),
(5, 5, 6, 'N5', 100.000, '', NULL, NULL, NULL, NULL, 'Montasser', '2012-12-14', NULL, NULL, '2012-12-14 08:58:22', '2012-12-14 08:58:22', 0.000, 'default_policy arabic', 'Montasser', NULL, 'Montasser', NULL, NULL, 'BHD', 'BHD', 18, 1187, NULL, 0.000, 0.000),
(6, 7, 8, 'N6', 27.000, '', NULL, NULL, NULL, NULL, 'Montasser', '2012-12-15', 'sfgsdgsdfgsdfgsdfg', NULL, '2012-12-15 10:44:54', '2012-12-15 10:44:54', 0.000, '', 'Montasser', NULL, 'Montasser', NULL, NULL, 'TND', 'BHD', 18, 1187, NULL, 0.000, 0.000);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Contenu de la table `sale_order_address`
--

INSERT INTO `sale_order_address` (`id`, `name`, `street`, `zipcode`, `city`, `province`, `country`) VALUES
(3, 'Montasser', 'Road 4332', NULL, '2169', 'Gafsa', 'Tunisie'),
(4, 'Amir', '23', NULL, 'Gafsa', 'Ksar', 'Tunisie'),
(5, 'Montasser', 'Road 4332', NULL, '2169', 'Gafsa', 'Tunisie'),
(6, 'Amir', '23', NULL, 'Gafsa', 'Ksar', 'Tunisie'),
(7, 'Montasser', 'Road 4332', NULL, '2169', 'Gafsa', 'BHR'),
(8, 'Amir', '23', NULL, 'Gafsa', 'Ksar', 'TUN');

-- --------------------------------------------------------

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Contenu de la table `sale_order_comment`
--

INSERT INTO `sale_order_comment` (`id`, `comment`, `user_id`, `sale_order_id`, `insertat`, `author_name`, `account_id`, `admin_seen`, `account_seen`, `public`) VALUES
(1, 'thanks please ship it tomorrow', 4, 5, '2012-12-14', 'Montassar', 1187, 1, 0, 1),
(8, 'bfgddfggg', NULL, 5, '2012-12-14', 'admin', NULL, NULL, NULL, 1),
(9, 'jfghjfgjfgjfgjh', NULL, 5, '2012-12-14', 'admin', NULL, NULL, NULL, 1),
(10, 'ghdhdfghdfh', NULL, 5, '2012-12-14', 'admin', NULL, 1, NULL, 1),
(11, 'fqsdfqsdfsdf', NULL, 5, '2012-12-14', 'Montasser', 1187, 1, 1, 1),
(13, 'dfhgdfghdfghdgh', NULL, 5, '2012-12-14', 'Montasser', 1187, NULL, NULL, NULL),
(14, 'ghdfghdfhdfgh', NULL, 5, '2012-12-14', 'Montasser', 1187, 1, 1, 1),
(15, 'sfgsdgsdfgsdfgsdfg', NULL, 6, '2012-12-15', 'Montasser', 1187, 1, 1, 1);

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

--
-- Contenu de la table `sale_order_has_document`
--

INSERT INTO `sale_order_has_document` (`sale_order_id`, `document_id`) VALUES
(5, 131),
(5, 132),
(6, 133),
(6, 134),
(6, 135);

-- --------------------------------------------------------

--
-- Structure de la table `sale_order_item`
--

DROP TABLE IF EXISTS `sale_order_item`;
CREATE TABLE IF NOT EXISTS `sale_order_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unit_price` double(12,3) DEFAULT NULL,
  `discount` double(12,3) DEFAULT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=25 ;

--
-- Contenu de la table `sale_order_item`
--

INSERT INTO `sale_order_item` (`id`, `unit_price`, `discount`, `quantity`, `item_id`, `sale_order_id`, `project_id`, `product_number`, `regular_price`, `sub_total`) VALUES
(7, 5.000, NULL, 1, 1, 4, NULL, NULL, NULL, NULL),
(8, 9.000, 10.000, 2, 1, 5, NULL, '1', 5.000, 18.000),
(9, 6100.000, NULL, 1, NULL, 5, NULL, '23652652', NULL, 0.000),
(10, 6100.000, NULL, 1, NULL, 5, NULL, '23652652', NULL, 0.000),
(11, 6100.000, NULL, 1, NULL, 5, NULL, '23652652', NULL, 0.000),
(12, 6100.000, NULL, 1, NULL, 5, NULL, '23652652', NULL, 0.000),
(13, 5.000, NULL, 1, NULL, 5, NULL, '1', NULL, 0.000),
(14, 6.100, NULL, 1, NULL, 5, NULL, '2', NULL, 0.000),
(15, 6100.000, NULL, 1, NULL, 5, NULL, '23652652', NULL, 0.000),
(16, 5.000, NULL, 1, NULL, 5, NULL, '1', NULL, 0.000),
(17, 6.100, NULL, 1, NULL, 5, NULL, '2', NULL, 0.000),
(18, 6.100, NULL, 1, NULL, 5, NULL, '2', NULL, 0.000),
(19, 6.100, NULL, 1, NULL, 5, NULL, '2', NULL, 0.000),
(20, 6.100, NULL, 1, NULL, 5, NULL, '2', NULL, 0.000),
(21, 6100.000, NULL, 1, NULL, 5, NULL, '23652652', NULL, 0.000),
(23, NULL, NULL, 2, 4, 5, NULL, '2', NULL, 0.000),
(24, 27.000, NULL, 1, 19, 6, NULL, 'dasdad', 27.000, 27.000);

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

--
-- Contenu de la table `sale_order_item_lang`
--

INSERT INTO `sale_order_item_lang` (`item_name`, `item_description`, `sale_order_item_id`, `lang`) VALUES
('للبيع لومينا LTZ ', '', 7, 'en'),
('للبيع لومينا LTZ ', '', 7, 'ar'),
('للبيع لومينا LTZ ', NULL, 8, 'en'),
('للبيع لومينا LTZ ', '', 8, 'ar'),
('للبيع: فورد موستنج موديل 2006', 'dsfgdsfg', 9, 'en'),
('للبيع: فورد موستنج موديل 2006', 'dsfgdsfg', 9, 'ar'),
('للبيع: فورد موستنج موديل 2006', 'dsfgdsfg', 10, 'en'),
('للبيع: فورد موستنج موديل 2006', 'dsfgdsfg', 10, 'ar'),
('Developping Controller', NULL, 11, 'en'),
('Developping Controller', NULL, 11, 'ar'),
('Developping Controller', NULL, 12, 'en'),
('Developping Controller', NULL, 12, 'ar'),
('للبيع لومينا LTZ ', NULL, 13, 'en'),
('للبيع لومينا LTZ ', NULL, 13, 'ar'),
('للبيع لومينا LTZ ', NULL, 14, 'en'),
('للبيع لومينا LTZ ', NULL, 14, 'ar'),
('Developping Controller', NULL, 15, 'en'),
('Developping Controller', NULL, 15, 'ar'),
('للبيع لومينا LTZ ', NULL, 16, 'en'),
('للبيع لومينا LTZ ', NULL, 16, 'ar'),
('للبيع لومينا LTZ ', NULL, 17, 'en'),
('للبيع لومينا LTZ ', NULL, 17, 'ar'),
('للبيع لومينا LTZ ', NULL, 18, 'en'),
('للبيع لومينا LTZ ', NULL, 18, 'ar'),
('للبيع لومينا LTZ ', NULL, 19, 'en'),
('للبيع لومينا LTZ ', NULL, 19, 'ar'),
('للبيع لومينا LTZ ', NULL, 20, 'en'),
('للبيع لومينا LTZ ', NULL, 20, 'ar'),
('Developping Controller', NULL, 21, 'en'),
('Developping Controller', NULL, 21, 'ar'),
('للبيع لومينا LTZ ', NULL, 23, 'en'),
('للبيع لومينا LTZ ', NULL, 23, 'ar'),
('High waist pencil skirt', 'Size: 32\nColor: 000000\nBrand: \nStyle: Long', 24, 'en'),
('High waist pencil skirt', 'Size: 32\nColor: 000000\nBrand: \nStyle: Long', 24, 'ar');

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

--
-- Contenu de la table `sale_order_lang`
--

INSERT INTO `sale_order_lang` (`name`, `payment_method_name`, `shipping_method_name`, `sale_order_id`, `lang`) VALUES
('Online Order', 'بنك البحرين والكويت', 'DHL International', 4, 'en'),
('Online Order arabic', 'بنك البحرين والكويت', 'ttttt', 4, 'ar'),
('Online Order', 'بنك البحرين والكويت', 'DHL International', 5, 'en'),
('Online Order arabic', 'بنك البحرين والكويت', 'ttttt', 5, 'ar'),
('Online Order ', 'بنك الراجحي', 'DHL International', 6, 'en'),
('Online Order ', 'بنك الراجحي', 'ttttt', 6, 'ar');

-- --------------------------------------------------------

--
-- Structure de la table `sale_order_state`
--

DROP TABLE IF EXISTS `sale_order_state`;
CREATE TABLE IF NOT EXISTS `sale_order_state` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `sale_order_state`
--

INSERT INTO `sale_order_state` (`id`) VALUES
(7),
(8),
(9),
(10);

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
-- Contenu de la table `sale_order_state_lang`
--

INSERT INTO `sale_order_state_lang` (`name`, `sale_order_state_id`, `lang`) VALUES
('OPEN', 7, 'en'),
('OPEN', 7, 'ar'),
('CREATED', 8, 'en'),
('CREATED', 8, 'ar'),
('CLOSED', 9, 'en'),
('CLOSED', 9, 'ar'),
('ACCEPTED', 10, 'en'),
('ACCEPTED', 10, 'ar');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `sale_order`
--
ALTER TABLE `sale_order`
  ADD CONSTRAINT `fk_sale_order_payment1` FOREIGN KEY (`payment_id`) REFERENCES `payment` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sale_order_person1` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sale_order_sale_order_discount_type1` FOREIGN KEY (`sale_order_discount_type_id`) REFERENCES `sale_order_discount_type` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sale_order_shipping_method1` FOREIGN KEY (`shipping_id`) REFERENCES `shipping` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_sale_order_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `sale_order_ibfk_1` FOREIGN KEY (`invoice_address_id`) REFERENCES `sale_order_address` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sale_order_ibfk_2` FOREIGN KEY (`shipping_address_id`) REFERENCES `sale_order_address` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
