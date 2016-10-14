
-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Mar 01 Octobre 2013 à 08:06
-- Version du serveur: 5.5.16
-- Version de PHP: 5.3.8

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT=0;
START TRANSACTION;
SET time_zone = "+00:00";

DELETE FROM product_category_lang WHERE product_category_id NOT IN (SELECT id FROM `product_category`);

ALTER TABLE  `product_category_lang` ADD FOREIGN KEY (  `product_category_id` ) REFERENCES  `blueshop_sample`.`product_category` (
`id`
) ON DELETE CASCADE ON UPDATE CASCADE ;

DELETE FROM product_lang WHERE product_id NOT IN (SELECT id FROM `product`);

ALTER TABLE  `product_lang` ADD FOREIGN KEY (  `product_id` ) REFERENCES  `blueshop_sample`.`product` (
`id`
) ON DELETE CASCADE ON UPDATE CASCADE ;


SET FOREIGN_KEY_CHECKS=1;
COMMIT;
