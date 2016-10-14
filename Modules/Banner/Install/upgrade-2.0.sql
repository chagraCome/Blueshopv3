-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Jeu 03 Octobre 2013 à 20:52
-- Version du serveur: 5.5.16
-- Version de PHP: 5.3.8

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT=0;
START TRANSACTION;
SET time_zone = "+00:00";

ALTER TABLE  `banner` ADD `sortid` INT NULL ;
ALTER TABLE  `banner` ADD `state` TINYINT DEFAULT 0 NULL ;

SET FOREIGN_KEY_CHECKS=1;
COMMIT;

