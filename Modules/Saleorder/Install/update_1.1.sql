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

--
-- Base de données: `clean_braun`
--
ALTER TABLE  `sale_order` ADD `contact_id` INT NULL ,ADD INDEX (  `contact_id` );

ALTER TABLE  `sale_order` ADD FOREIGN KEY (  `contact_id` ) REFERENCES  `contact` (
`id`
) ON DELETE SET NULL ON UPDATE CASCADE ;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;