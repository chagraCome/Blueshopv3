
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

ALTER TABLE  `product_category_lang` ADD FOREIGN KEY (  `product_category_id` ) REFERENCES `product_category` (
`id`
) ON DELETE CASCADE ON UPDATE CASCADE ;

DELETE FROM product_lang WHERE product_id NOT IN (SELECT id FROM `product`);

ALTER TABLE  `product_lang` ADD FOREIGN KEY (  `product_id` ) REFERENCES `product` (
`id`
) ON DELETE CASCADE ON UPDATE CASCADE ;


DELETE FROM product_has_image WHERE product_id NOT IN (SELECT id FROM `product`);

DELETE FROM product_has_image WHERE image_id NOT IN (SELECT id from `image`);

ALTER TABLE  `product_has_image` ADD FOREIGN KEY (  `product_id` ) REFERENCES `product` (
`id`
) ON DELETE CASCADE ON UPDATE CASCADE ;

ALTER TABLE  `product_has_image` ADD FOREIGN KEY (  `image_id` ) REFERENCES `image` (
`id`
) ON DELETE CASCADE ON UPDATE CASCADE ;

DELETE FROM product_has_document WHERE product_id NOT IN (SELECT id FROM `product`);

DELETE FROM product_has_document WHERE document_id NOT IN (SELECT id from `document`);

ALTER TABLE  `product_has_document` ADD FOREIGN KEY (  `product_id` ) REFERENCES `product` (
`id`
) ON DELETE CASCADE ON UPDATE CASCADE ;

ALTER TABLE  `product_has_document` ADD FOREIGN KEY (  `document_id` ) REFERENCES `document` (
`id`
) ON DELETE CASCADE ON UPDATE CASCADE ;


SET FOREIGN_KEY_CHECKS=1;
COMMIT;
