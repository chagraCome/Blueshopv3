-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Ven 26 Avril 2013 à 07:32
-- Version du serveur: 5.5.16
-- Version de PHP: 5.3.8

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT=0;
START TRANSACTION;
SET time_zone = "+00:00";


-- --------------------------------------------------------

--
-- Structure de la table `shoppingcart`
--

DROP TABLE IF EXISTS `shoppingcart`;
CREATE TABLE IF NOT EXISTS `shoppingcart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `expire` int(11) DEFAULT NULL,
  `total` double(12,3) DEFAULT NULL,
  `shippingcost` double(12,3) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `shipping_address_id` int(11) DEFAULT NULL,
  `invoice_address_id` int(11) DEFAULT NULL,
  `shipping_id` int(11) DEFAULT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `comment` text COLLATE utf8_unicode_ci,
  `coupon_code_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_shoppingcart_account1` (`account_id`),
  KEY `fk_shoppingcart_address1` (`shipping_address_id`),
  KEY `fk_shoppingcart_address2` (`invoice_address_id`),
  KEY `fk_shoppingcart_shipping1` (`shipping_id`),
  KEY `fk_shoppingcart_payment1` (`payment_id`),
  KEY `coupon_code_id` (`coupon_code_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=43 ;

-- --------------------------------------------------------

--
-- Structure de la table `shoppingcart_has_product`
--

DROP TABLE IF EXISTS `shoppingcart_has_product`;
CREATE TABLE IF NOT EXISTS `shoppingcart_has_product` (
  `shoppingcart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity_in_cart` int(11) DEFAULT '1',
  PRIMARY KEY (`shoppingcart_id`,`product_id`),
  KEY `fk_shoppingcart_has_product_product1` (`product_id`),
  KEY `fk_shoppingcart_has_product_shoppingcart1` (`shoppingcart_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `shoppingcart`
--
ALTER TABLE `shoppingcart`
  ADD CONSTRAINT `fk_shoppingcart_account1` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_shoppingcart_payment1` FOREIGN KEY (`payment_id`) REFERENCES `payment` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_shoppingcart_shipping1` FOREIGN KEY (`shipping_id`) REFERENCES `shipping` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `shoppingcart_ibfk_1` FOREIGN KEY (`shipping_address_id`) REFERENCES `address` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `shoppingcart_ibfk_2` FOREIGN KEY (`invoice_address_id`) REFERENCES `address` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `shoppingcart_has_product`
--
ALTER TABLE `shoppingcart_has_product`
  ADD CONSTRAINT `fk_shoppingcart_has_product_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_shoppingcart_has_product_shoppingcart1` FOREIGN KEY (`shoppingcart_id`) REFERENCES `shoppingcart` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;
