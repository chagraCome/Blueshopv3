-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Lun 21 Octobre 2013 à 13:08
-- Version du serveur: 5.5.16
-- Version de PHP: 5.3.8

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT=0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Module: Rating
--

-- --------------------------------------------------------

--
-- Structure de la table `entity_rating`
--
DROP TABLE IF EXISTS `entity_rating`;  
CREATE TABLE IF NOT EXISTS `entity_rating` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entity_id` int(11) NOT NULL,
  `entity_class` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rate` int(11) DEFAULT '0',
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment` text COLLATE utf8_unicode_ci,
  `rate_date_time` datetime DEFAULT NULL,
  `ip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `entity_id` (`entity_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE VIEW `product_rating_view` AS select avg(`entity_rating`.`rate`) AS `rate`,count(0) AS `rate_count`,`entity_rating`.`entity_id` AS `entity_id` from `entity_rating` where (`entity_rating`.`entity_class` = 'Product_Product_Model') group by `entity_rating`.`entity_id`;

SET FOREIGN_KEY_CHECKS=1;
COMMIT;
