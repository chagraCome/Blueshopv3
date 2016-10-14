-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Ven 11 Avril 2014 à 14:40
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.16

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

ALTER TABLE  `product` ADD  `form_id` INT( 11 ) NULL ,
ADD INDEX (  `form_id` ) ;


SET FOREIGN_KEY_CHECKS=1;
COMMIT;
