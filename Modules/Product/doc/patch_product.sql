ALTER TABLE  `product` ADD  `special_price` DECIMAL( 12, 3 ) NULL AFTER  `type_id` ,
ADD  `special_price_date_from` DATE NULL AFTER  `special_price` ,
ADD  `special_price_date_to` DATE NULL AFTER  `special_price_date_from` ,
ADD  `manage_stock` BOOLEAN NULL AFTER  `special_price_date_to` ,
ADD  `quantity` INT NULL AFTER  `manage_stock`;

ALTER TABLE  `product` CHANGE  `price`  `price` FLOAT( 15,3 ) NULL;


ALTER TABLE  `product` ADD  `weight` DECIMAL( 8, 3 ) NULL AFTER  `quantity` ,
ADD  `fix_shipping_cost` DECIMAL( 12, 3 ) NULL AFTER  `weight` ,
ADD  `user_id` INT NULL AFTER  `fix_shipping_cost` ,
ADD  `publish_date_from` DATE NULL AFTER  `user_id` ,
ADD  `publish_date_to` DATE NULL AFTER  `publish_date_from`;


-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Mar 04 Décembre 2012 à 13:15
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `product_table_price`
--
ALTER TABLE `product_table_price`
  ADD CONSTRAINT `product_table_price_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;
