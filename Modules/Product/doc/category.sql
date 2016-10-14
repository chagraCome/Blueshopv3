-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 17. Jan 2013 um 10:13
-- Server Version: 5.5.8
-- PHP-Version: 5.3.5

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT=0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `amhshopprp12`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `product_category`
--

DROP TABLE IF EXISTS `product_category`;
CREATE TABLE IF NOT EXISTS `product_category` (
  `id` bigint(31) NOT NULL AUTO_INCREMENT,
  `sortid` int(11) DEFAULT '0',
  `state` int(1) DEFAULT '1',
  `image_id` int(11) DEFAULT NULL,
  `parent_id` bigint(31) DEFAULT NULL,
  `previous` int(11) DEFAULT NULL,
  `next` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_category_image1` (`image_id`),
  KEY `fk_product_category_product_category1` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=111 ;

--
-- Daten für Tabelle `product_category`
--

INSERT INTO `product_category` (`id`, `sortid`, `state`, `image_id`, `parent_id`, `previous`, `next`) VALUES
(103, NULL, 1, NULL, NULL, 2, 7),
(104, NULL, 1, NULL, NULL, 8, 13),
(105, NULL, 1, NULL, 103, 5, 6),
(106, NULL, 1, NULL, 104, 11, 12),
(107, NULL, 1, NULL, 104, 9, 10),
(108, NULL, 1, NULL, 103, 3, 4),
(109, NULL, 1, NULL, NULL, 14, 15),
(110, NULL, 1, NULL, NULL, 16, 17);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `product_category_lang`
--

DROP TABLE IF EXISTS `product_category_lang`;
CREATE TABLE IF NOT EXISTS `product_category_lang` (
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `lang` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product_category_id` bigint(31) NOT NULL,
  KEY `fk_product_category_lang_product_category1` (`product_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `product_category_lang`
--

INSERT INTO `product_category_lang` (`name`, `description`, `lang`, `product_category_id`) VALUES
('Category Name', 'Category DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory Description', 'AR', 1),
('Woman', 'Category DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory Description', 'EN', 1),
('Category Name', 'Category DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory Description', 'DE', 1),
('Category Name', 'Category DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory Description', 'AR', 2),
('Men', 'Category DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory Description', 'EN', 2),
('Category Name', 'Category DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory Description', 'DE', 2),
('Category Name', 'Category DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory Description', 'AR', 3),
('Kids', 'Category DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory Description', 'EN', 3),
('Category Name', 'Category DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory Description', 'DE', 3),
('Category Name', 'Category DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory Description', 'AR', 4),
('shoes', 'Category DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory Description', 'EN', 4),
('Category Name', 'Category DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory Description', 'DE', 4),
('sport', NULL, 'AR', 5),
('sport', NULL, 'EN', 5),
('sport', NULL, 'DE', 5),
('Accessories', NULL, 'AR', 6),
('Accessories', NULL, 'EN', 6),
('Accessories', NULL, 'DE', 6),
('adasdasd', NULL, 'AR', 7),
('adasdasd', NULL, 'EN', 7),
('adasdasd', NULL, 'DE', 7),
('asdasdasdasd', NULL, 'AR', 8),
('asdasdasdasd', NULL, 'EN', 8),
('asdasdasdasd', NULL, 'DE', 8),
('211323423', NULL, 'AR', 9),
('211323423', NULL, 'EN', 9),
('211323423', NULL, 'DE', 9),
('Category Name', 'Category DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory Description', 'AR', 10),
('Category Name', 'Category DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory Description', 'EN', 10),
('Category Name', 'Category DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory DescriptionCategory Description', 'DE', 10),
('ahmedf', NULL, 'AR', 11),
('ahmedf', NULL, 'EN', 11),
('ahmedf', NULL, 'DE', 11),
('Wheels', NULL, 'AR', 12),
('Wheels', NULL, 'EN', 12),
('Number', NULL, 'AR', 13),
('Number', NULL, 'EN', 13),
('Smartphone', NULL, 'AR', 14),
('Smartphone', NULL, 'EN', 14),
('Vehcicle Window', NULL, 'AR', 15),
('Vehcicle Window', NULL, 'EN', 15),
('Water Craft', NULL, 'AR', 16),
('Water Craft', NULL, 'EN', 16),
('Books', NULL, 'en', 17),
('Books', NULL, 'ar', 17),
('Villa', NULL, 'en', 18),
('Villa', NULL, 'ar', 18),
('Woman', NULL, 'en', 19),
('Woman', NULL, 'ar', 19),
('Shoes', NULL, 'en', 20),
('Shoes', NULL, 'ar', 20),
('Dresses', NULL, 'en', 21),
('Dresses', NULL, 'ar', 21),
('Skirts', NULL, 'en', 22),
('Skirts', NULL, 'ar', 22),
('Men', NULL, 'en', 23),
('Men', NULL, 'ar', 23),
('Jackets & gilets', NULL, 'en', 24),
('Jackets & gilets', NULL, 'ar', 24),
('Sweatshirts', NULL, 'en', 25),
('Sweatshirts', NULL, 'ar', 25),
('Sportpants', NULL, 'en', 26),
('Sportpants', NULL, 'ar', 26),
('Computer', NULL, 'en', 27),
('Computer', NULL, 'ar', 27),
('Furniture', NULL, 'en', 28),
('Furniture', NULL, 'ar', 28),
('Women', NULL, 'en', 103),
('Women', NULL, 'ar', 103),
('Men', NULL, 'en', 104),
('Men', NULL, 'ar', 104),
('Shoes', NULL, 'en', 105),
('Shoes', NULL, 'ar', 105),
('Shoes', NULL, 'en', 106),
('Shoes', NULL, 'ar', 106),
('Shirts', NULL, 'en', 107),
('Shirts', NULL, 'ar', 107),
('Skirts', NULL, 'en', 108),
('Skirts', NULL, 'ar', 108),
('Furniture', NULL, 'en', 109),
('Furniture', NULL, 'ar', 109),
('Computer', NULL, 'en', 110),
('Computer', NULL, 'ar', 110);

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `product_category`
--
ALTER TABLE `product_category`
  ADD CONSTRAINT `fk_product_category_image1` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_category_product_category1` FOREIGN KEY (`parent_id`) REFERENCES `product_category` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
