-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Ven 26 Avril 2013 à 09:23
-- Version du serveur: 5.5.16
-- Version de PHP: 5.3.8

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT=0;
START TRANSACTION;
SET time_zone = "+00:00";


ALTER TABLE `print_template_lang` ADD `header` TEXT COLLATE utf8_unicode_ci;
ALTER TABLE `print_template_lang` ADD `footer` TEXT COLLATE utf8_unicode_ci;


SET FOREIGN_KEY_CHECKS=1;
COMMIT;
