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

DELETE FROM entity_attribute_lang WHERE entity_attribute_id NOT IN (SELECT id FROM `entity_attribute`);

ALTER TABLE  `entity_attribute_lang` ADD FOREIGN KEY (  `entity_attribute_id` ) REFERENCES  `entity_attribute` (
`id`
) ON DELETE CASCADE ON UPDATE CASCADE ;


DELETE FROM `entity_attribute_value` WHERE entity_id not in (select id from product);

DELETE FROM entity_attribute_value_lang WHERE entity_attribute_value_id NOT IN (SELECT id FROM `entity_attribute_value`);

ALTER TABLE  `entity_attribute_value_lang` ADD FOREIGN KEY (  `entity_attribute_value_id` ) REFERENCES  `entity_attribute_value` (
`id`
) ON DELETE CASCADE ON UPDATE CASCADE ;

DELETE FROM `entity_attribute_datasource_lang` WHERE `entity_attribute_datasource_id` not in (select id from entity_attribute_datasource);

ALTER TABLE  `entity_attribute_datasource_lang` ADD FOREIGN KEY (  `entity_attribute_datasource_id` ) REFERENCES  `entity_attribute_datasource` (
`id`
) ON DELETE CASCADE ON UPDATE CASCADE ;

SET FOREIGN_KEY_CHECKS=1;
COMMIT;
