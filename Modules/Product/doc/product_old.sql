-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 01. Okt 2012 um 10:35
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
-- Datenbank: `motorssouq_relaunch`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` float(15,4) NOT NULL,
  `online` tinyint(1) NOT NULL,
  `categorie_id` int(11) DEFAULT NULL,
  `discount` double(10,2) NOT NULL,
  `remote_id` int(11) DEFAULT NULL,
  `insertat` datetime DEFAULT NULL,
  `updateat` datetime DEFAULT NULL,
  `product_set_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_product_set1` (`product_set_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=196 ;

--
-- Daten für Tabelle `product`
--

INSERT INTO `product` (`id`, `number`, `price`, `online`, `categorie_id`, `discount`, `remote_id`, `insertat`, `updateat`, `product_set_id`, `type_id`) VALUES
(184, '0012', 60.0000, 0, 12, 0.00, NULL, NULL, NULL, 10, 1),
(185, '23232', 95.0000, 0, 12, 0.00, NULL, NULL, NULL, 10, 1),
(186, '2222', 50.0000, 0, 12, 0.00, NULL, NULL, NULL, 10, 1),
(187, 'asdad', 50.0000, 0, 12, 0.00, NULL, NULL, NULL, 10, 1),
(188, '1122', 111.0000, 0, 14, 0.00, NULL, NULL, NULL, 13, 1),
(189, '2222', 100.0000, 0, 14, 0.00, NULL, NULL, NULL, 13, 1),
(190, '00413255', 150.0000, 0, 15, 0.00, NULL, NULL, NULL, 14, 1),
(191, '0224', 125.0000, 0, 15, 0.00, NULL, NULL, NULL, 14, 1),
(192, '343434', 200.0000, 0, 15, 0.00, NULL, NULL, NULL, 14, 1),
(193, '155545', 150000.0000, 0, 16, 0.00, NULL, NULL, NULL, 17, 1),
(194, '34534534', 200000.0000, 0, 16, 0.00, NULL, NULL, NULL, 17, 1),
(195, '5544', 855222.0000, 0, 16, 0.00, NULL, NULL, NULL, 17, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `product_attribute`
--

DROP TABLE IF EXISTS `product_attribute`;
CREATE TABLE IF NOT EXISTS `product_attribute` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `defaultvalue` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type_frontend` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'Label',
  `validator` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `required` tinyint(1) DEFAULT NULL,
  `product_attribute_type_backend_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  KEY `fk_product_attribute_product_attribute_type1` (`product_attribute_type_backend_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=42 ;

--
-- Daten für Tabelle `product_attribute`
--

INSERT INTO `product_attribute` (`id`, `name`, `defaultvalue`, `type_frontend`, `validator`, `required`, `product_attribute_type_backend_id`) VALUES
(19, 'wheelbrand', NULL, 'Label', 'String|3', 1, 12),
(21, 'wheelprofile', NULL, NULL, NULL, 1, 5),
(22, 'wheeltreadwidth', NULL, NULL, NULL, 1, 2),
(23, 'numbertype', NULL, NULL, NULL, 1, 2),
(24, 'smartphoneos', NULL, NULL, NULL, 1, 2),
(25, 'smartphonememory', NULL, NULL, NULL, 1, 2),
(26, 'vehicletype', NULL, NULL, NULL, 1, 2),
(27, 'vehiclewindowtype', NULL, NULL, NULL, 1, 2),
(30, 'testcheck', NULL, NULL, NULL, 0, 4),
(31, 'checkb', NULL, NULL, NULL, 0, 4),
(32, 'smartphonecamera', NULL, NULL, NULL, 0, 1),
(33, 'smartphonecameraresol', NULL, NULL, NULL, 0, 1),
(34, 'smartphoneusb', NULL, 'Label', NULL, 0, 10),
(35, 'watercraftlenght', NULL, 'Label', 'Integer', 1, 15),
(36, 'watercraftusedhours', NULL, 'Label', 'Integer', 1, 20),
(37, 'watercraftengine', NULL, 'Label', NULL, 1, 2),
(38, 'watercraftenginemake', NULL, NULL, NULL, 1, 2),
(39, 'watercraftbodytype', NULL, NULL, NULL, 1, 2),
(40, 'watercraftgps', NULL, NULL, NULL, 0, 4),
(41, 'globalattributecolor', NULL, NULL, NULL, 0, 21);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `product_attribute_datasource`
--

DROP TABLE IF EXISTS `product_attribute_datasource`;
CREATE TABLE IF NOT EXISTS `product_attribute_datasource` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_attribute_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_attribute_id` (`product_attribute_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=33 ;

--
-- Daten für Tabelle `product_attribute_datasource`
--

INSERT INTO `product_attribute_datasource` (`id`, `product_attribute_id`) VALUES
(12, 22),
(13, 22),
(14, 24),
(15, 24),
(16, 24),
(17, 24),
(18, 25),
(19, 25),
(20, 25),
(21, 37),
(22, 37),
(23, 38),
(24, 38),
(25, 38),
(26, 38),
(27, 39),
(28, 39),
(29, 39),
(30, 39),
(31, 39),
(32, 39);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `product_attribute_datasource_lang`
--

DROP TABLE IF EXISTS `product_attribute_datasource_lang`;
CREATE TABLE IF NOT EXISTS `product_attribute_datasource_lang` (
  `value` text COLLATE utf8_unicode_ci,
  `lang` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product_attribute_datasource_id` int(11) NOT NULL,
  KEY `fk_product_attribute_datasource_lang_product_attribute_dataso1` (`product_attribute_datasource_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `product_attribute_datasource_lang`
--

INSERT INTO `product_attribute_datasource_lang` (`value`, `lang`, `product_attribute_datasource_id`) VALUES
('205', 'AR', 12),
('205', 'EN', 12),
('206', 'AR', 13),
('206', 'EN', 13),
('Android', 'AR', 14),
('Android', 'EN', 14),
('IOS', 'AR', 15),
('IOS', 'EN', 15),
('Windows Mobile', 'AR', 16),
('Windows Mobile', 'EN', 16),
('Blackberry', 'AR', 17),
('Blackberry', 'EN', 17),
('8 GB', 'AR', 18),
('8 GB', 'EN', 18),
('16 GB', 'AR', 19),
('16 GB', 'EN', 19),
('32 GB', 'AR', 20),
('32 GB', 'EN', 20),
('بترول', 'AR', 21),
('Petrol', 'EN', 21),
('ديزال', 'AR', 22),
('Diesel', 'EN', 22),
('Suzuki', 'AR', 23),
('Suzuki', 'EN', 23),
('Yamaha', 'AR', 24),
('Yamaha', 'EN', 24),
('General Electric', 'AR', 25),
('General Electric', 'EN', 25),
('مركوري', 'AR', 26),
('Mercury', 'EN', 26),
('Fishing Boot', 'AR', 27),
('Fishing Boot', 'EN', 27),
('Picnic Boot', 'AR', 28),
('Picnic Boot', 'EN', 28),
('Jet Sky', 'AR', 29),
('Jet Sky', 'EN', 29),
('Speed Boot', 'AR', 30),
('Speed Boot', 'EN', 30),
('Jacht', 'AR', 31),
('Jacht', 'EN', 31),
('Mini Jacht', 'AR', 32),
('Mini Jacht', 'EN', 32);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `product_attribute_lang`
--

DROP TABLE IF EXISTS `product_attribute_lang`;
CREATE TABLE IF NOT EXISTS `product_attribute_lang` (
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `datasource` text COLLATE utf8_unicode_ci,
  `product_attribute_id` int(11) NOT NULL,
  `lang` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `errormessage` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  KEY `fk_product_attribute_lang_product_attribute1` (`product_attribute_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `product_attribute_lang`
--

INSERT INTO `product_attribute_lang` (`label`, `datasource`, `product_attribute_id`, `lang`, `errormessage`) VALUES
('Wheel Brand', NULL, 19, 'AR', NULL),
('Wheel Brand', NULL, 19, 'EN', NULL),
('Wheel Profile', '95\n90\n85\n80\n75\n70\n65\n60\n55\n50\n45\n40\n35', 21, 'AR', NULL),
('Wheel Profile', '95\n90\n85\n80\n75\n70\n65\n60\n55\n50\n45\n40\n35', 21, 'EN', NULL),
('Tread Width', '145\n155\n165\n175\n185\n195\n205\n215\n225\n235\n245\n255\n265\n275\n285\n295\n305\n315\n325\n335\n345\n355\n365\n375', 22, 'AR', NULL),
('Tread Width', '145\n155\n165\n175\n185\n195\n205\n215\n225\n235\n245\n255\n265\n275\n285\n295\n305\n315\n325\n335\n345\n355\n365\n375', 22, 'EN', NULL),
('Number Type', 'Bike Number\nVehicle Number', 23, 'AR', NULL),
('Number Type', 'Bike Number\nVehicle Number', 23, 'EN', NULL),
('OS', 'Android\nWindows Mobile\nIOS', 24, 'AR', NULL),
('OS', 'Android\nWindows Mobile\nIOS', 24, 'EN', NULL),
('OS', '8 GB\n16 GB\n24 GB', 25, 'AR', NULL),
('Memory', '8 GB\n16 GB\n24 GB', 25, 'EN', NULL),
('Vehicle Type', 'تويوتا كورولا\nVolkswagen Golf\nNissan Tida', 26, 'AR', NULL),
('Vehicle Type', 'Toyota Corolla\nVolkswagen Golf\nNissan Tida', 26, 'EN', NULL),
('Window Type', 'Normal Window\nTan\nRain Proof\nAnti Smash\nbolt proof', 27, 'AR', NULL),
('Window Type', 'Normal Window\nTan\nRain Proof\nAnti Smash\nbolt proof', 27, 'EN', NULL),
('Test Cgheck', NULL, 30, 'AR', NULL),
('Test Cgheck', NULL, 30, 'EN', NULL),
('Check Box 2', NULL, 31, 'AR', NULL),
('Check Box 2', NULL, 31, 'EN', NULL),
('Camera', NULL, 32, 'AR', NULL),
('Camera', NULL, 32, 'EN', NULL),
('Resolution', NULL, 33, 'AR', NULL),
('Resolution', NULL, 33, 'EN', NULL),
('USB Type', NULL, 34, 'AR', NULL),
('Microusb', NULL, 34, 'EN', NULL),
('Length', NULL, 35, 'AR', 'Please enter length'),
('Length', NULL, 35, 'EN', 'Please enter length'),
('Used Hours', NULL, 36, 'AR', NULL),
('Used Hours', NULL, 36, 'EN', NULL),
('نوع المحرك', NULL, 37, 'AR', NULL),
('Engine Type', NULL, 37, 'EN', NULL),
('Engine Make', NULL, 38, 'AR', NULL),
('Engine Make', NULL, 38, 'EN', NULL),
('Body Type', NULL, 39, 'AR', NULL),
('Body Type', NULL, 39, 'EN', NULL),
('GPS', NULL, 40, 'AR', NULL),
('GPS', NULL, 40, 'EN', NULL),
('Color', NULL, 41, 'AR', NULL),
('Color', NULL, 41, 'EN', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `product_attribute_type`
--

DROP TABLE IF EXISTS `product_attribute_type`;
CREATE TABLE IF NOT EXISTS `product_attribute_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `typename` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

--
-- Daten für Tabelle `product_attribute_type`
--

INSERT INTO `product_attribute_type` (`id`, `name`, `typename`) VALUES
(1, 'Input', 'Text'),
(2, 'ListBox', 'Drop Down'),
(3, 'DateControl', 'Date'),
(4, 'CheckBox', 'Check Box'),
(5, 'CurrencyInput', 'Currency'),
(6, 'WysiwygTextArea', 'Editor'),
(7, 'TextArea', 'Big Text'),
(8, 'Label', 'label'),
(9, 'YesNoListBox', 'YesNoListBox'),
(10, 'Kilometer Input', 'KMInput'),
(11, 'Mile Input', 'MileInput'),
(12, 'Gramm Input', 'GrammInput'),
(13, 'Kliogramm Input', 'KlioGrammInput'),
(14, 'Meter Input', 'MeterInput'),
(15, 'Feed', 'FeedInput'),
(16, 'Minute', 'MinuteInput'),
(17, 'Second', 'SecondInput'),
(18, 'Centiliter', 'CentiliterInput'),
(19, 'Milliliter', 'MilliliterInput'),
(20, 'Hour', 'HourInput'),
(21, 'Color', 'ColorInput');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `product_attribute_value`
--

DROP TABLE IF EXISTS `product_attribute_value`;
CREATE TABLE IF NOT EXISTS `product_attribute_value` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_attribute_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_attribute_value_product_attribute1` (`product_attribute_id`),
  KEY `fk_product_attribute_value_product1` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=105 ;

--
-- Daten für Tabelle `product_attribute_value`
--

INSERT INTO `product_attribute_value` (`id`, `product_attribute_id`, `product_id`) VALUES
(53, 19, 184),
(55, 22, 184),
(56, 21, 184),
(57, 19, 185),
(58, 22, 185),
(60, 21, 185),
(61, 19, 186),
(62, 22, 186),
(64, 21, 186),
(65, 19, 187),
(66, 22, 187),
(68, 21, 187),
(69, 24, 188),
(70, 25, 188),
(71, 24, 189),
(72, 25, 189),
(73, 26, 190),
(74, 27, 190),
(75, 26, 191),
(76, 27, 191),
(77, 26, 192),
(78, 27, 192),
(79, 32, 188),
(80, 33, 188),
(81, 32, 189),
(82, 33, 189),
(83, 34, 188),
(84, 35, 193),
(85, 39, 193),
(86, 38, 193),
(87, 37, 193),
(88, 36, 193),
(89, 40, 193),
(90, 35, 194),
(91, 39, 194),
(92, 38, 194),
(93, 37, 194),
(94, 36, 194),
(95, 40, 194),
(96, 35, 195),
(97, 39, 195),
(98, 38, 195),
(99, 37, 195),
(100, 36, 195),
(101, 40, 195),
(102, 41, 194),
(103, 41, 195),
(104, 41, 193);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `product_attribute_value_lang`
--

DROP TABLE IF EXISTS `product_attribute_value_lang`;
CREATE TABLE IF NOT EXISTS `product_attribute_value_lang` (
  `value` text COLLATE utf8_unicode_ci,
  `lang` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product_attribute_value_id` int(11) NOT NULL,
  KEY `fk_product_attribute_value_lang_product_attribute_value1` (`product_attribute_value_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `product_attribute_value_lang`
--

INSERT INTO `product_attribute_value_lang` (`value`, `lang`, `product_attribute_value_id`) VALUES
('Contiental', 'AR', 53),
('wewe', 'EN', 53),
('215', 'AR', 55),
('206', 'EN', 55),
('95', 'AR', 56),
('555522.00', 'EN', 56),
('Continental', 'AR', 57),
('2323sd', 'EN', 57),
('195', 'AR', 58),
('205', 'EN', 58),
('95', 'AR', 60),
('95.00', 'EN', 60),
('Contentiant', 'AR', 61),
('Contentiant', 'EN', 61),
('315', 'AR', 62),
('315', 'EN', 62),
('70', 'AR', 64),
('70', 'EN', 64),
('ghjghjg', 'AR', 65),
('ghjghjg', 'EN', 65),
('305', 'AR', 66),
('305', 'EN', 66),
('65', 'AR', 68),
('65', 'EN', 68),
('IOS', 'AR', 69),
('IOS', 'EN', 69),
('16 GB', 'AR', 70),
('32 GB', 'EN', 70),
('Android', 'AR', 71),
('Android', 'EN', 71),
('24 GB', 'AR', 72),
('32 GB', 'EN', 72),
('Toyota Corolla', 'AR', 73),
('Toyota Corolla', 'EN', 73),
('Tan', 'AR', 74),
('Tan', 'EN', 74),
('Volkswagen Golf', 'AR', 75),
('Volkswagen Golf', 'EN', 75),
('Rain Proof', 'AR', 76),
('Rain Proof', 'EN', 76),
('Nissan Tida', 'AR', 77),
('Nissan Tida', 'EN', 77),
('bolt proof', 'AR', 78),
('bolt proof', 'EN', 78),
('8 MP', 'AR', 79),
('8 MP', 'EN', 79),
('13 x 17 x 2 Zoll', 'AR', 80),
('13 x 17 x 2 Zoll', 'EN', 80),
('12 MP', 'AR', 81),
('12 MP', 'EN', 81),
('28 x 15 x 5', 'AR', 82),
('28 x 15 x 5', 'EN', 82),
('Micro USB', 'AR', 83),
('Micro USB', 'EN', 83),
('5.00', 'AR', 84),
('5.00', 'EN', 84),
('30', 'AR', 85),
('30', 'EN', 85),
('26', 'AR', 86),
('26', 'EN', 86),
('22', 'AR', 87),
('22', 'EN', 87),
('2500.00', 'AR', 88),
('2500.00', 'EN', 88),
('1', 'AR', 89),
('1', 'EN', 89),
('8.00', 'AR', 90),
('8.00', 'EN', 90),
('29', 'AR', 91),
('29', 'EN', 91),
('24', 'AR', 92),
('24', 'EN', 92),
('22', 'AR', 93),
('22', 'EN', 93),
('400.00', 'AR', 94),
('400.00', 'EN', 94),
('1', 'AR', 95),
(NULL, 'EN', 95),
('6.00', 'AR', 96),
('6.00', 'EN', 96),
('27', 'AR', 97),
('27', 'EN', 97),
('23', 'AR', 98),
('23', 'EN', 98),
('21', 'AR', 99),
('21', 'EN', 99),
('8555.00', 'AR', 100),
('8555.00', 'EN', 100),
('1', 'AR', 101),
('1', 'EN', 101),
('#bd4040', 'AR', 102),
('eea8f0', 'EN', 102),
('eea8f0', 'AR', 103),
('eea8f0', 'EN', 103),
('8.00', 'عرب', 90),
('8.00', 'Eng', 90),
('300', 'عرب', 94),
('300', 'Eng', 94),
('8.00', 'عرب', 90),
('8.00', 'Eng', 90),
('300', 'عرب', 94),
('300', 'Eng', 94),
('8.00', 'عرب', 90),
('8.00', 'Eng', 90),
('Picnic Boot', 'عرب', 91),
('Picnic Boot', 'Eng', 91),
(NULL, 'عرب', 95),
(NULL, 'Eng', 95),
('Mercury', 'عرب', 92),
('Mercury', 'Eng', 92),
('eea8f0', 'عرب', 102),
('eea8f0', 'Eng', 102),
('Diesel', 'عرب', 93),
('Diesel', 'Eng', 93),
('3000', 'عرب', 94),
('3000', 'Eng', 94),
(NULL, 'AR', 104),
(NULL, 'EN', 104);

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
  PRIMARY KEY (`id`),
  KEY `fk_product_category_image1` (`image_id`),
  KEY `fk_product_category_product_category1` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Daten für Tabelle `product_category`
--

INSERT INTO `product_category` (`id`, `sortid`, `state`, `image_id`, `parent_id`) VALUES
(12, NULL, 1, NULL, NULL),
(13, NULL, 1, NULL, NULL),
(14, NULL, 1, NULL, NULL),
(15, NULL, 1, NULL, NULL),
(16, NULL, 1, NULL, NULL);

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
('Water Craft', NULL, 'EN', 16);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `product_comment`
--

DROP TABLE IF EXISTS `product_comment`;
CREATE TABLE IF NOT EXISTS `product_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment` text COLLATE utf8_unicode_ci,
  `public` tinyint(1) DEFAULT NULL,
  `author` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `insertat` date DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_comment_product1` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `product_configuration`
--

DROP TABLE IF EXISTS `product_configuration`;
CREATE TABLE IF NOT EXISTS `product_configuration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product_set_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_configuration_product_set1` (`product_set_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `product_configuration_has_product`
--

DROP TABLE IF EXISTS `product_configuration_has_product`;
CREATE TABLE IF NOT EXISTS `product_configuration_has_product` (
  `product_configuration_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`product_configuration_id`,`product_id`),
  KEY `fk_product_configuration_has_product_product1` (`product_id`),
  KEY `fk_product_configuration_has_product_product_configuration1` (`product_configuration_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `product_configuration_has_product_attribute`
--

DROP TABLE IF EXISTS `product_configuration_has_product_attribute`;
CREATE TABLE IF NOT EXISTS `product_configuration_has_product_attribute` (
  `product_configuration_id` int(11) NOT NULL,
  `product_attribute_id` int(11) NOT NULL,
  PRIMARY KEY (`product_configuration_id`,`product_attribute_id`),
  KEY `fk_product_configuration_has_product_attribute_product_attrib1` (`product_attribute_id`),
  KEY `fk_product_configuration_has_product_attribute_product_config1` (`product_configuration_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `product_cross_selling`
--

DROP TABLE IF EXISTS `product_cross_selling`;
CREATE TABLE IF NOT EXISTS `product_cross_selling` (
  `product_id` int(11) NOT NULL,
  `cross_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`cross_id`),
  KEY `fk_product_has_product_product4` (`cross_id`),
  KEY `fk_product_has_product_product3` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `product_hast_grouped_product`
--

DROP TABLE IF EXISTS `product_hast_grouped_product`;
CREATE TABLE IF NOT EXISTS `product_hast_grouped_product` (
  `grouped_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  KEY `fk_product_hast_grouped_product_product1` (`grouped_id`),
  KEY `fk_product_hast_grouped_product_product2` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `product_has_document`
--

DROP TABLE IF EXISTS `product_has_document`;
CREATE TABLE IF NOT EXISTS `product_has_document` (
  `product_id` int(11) NOT NULL,
  `document_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`document_id`),
  KEY `fk_product_has_document_document1` (`document_id`),
  KEY `fk_product_has_document_product1` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `product_has_image`
--

DROP TABLE IF EXISTS `product_has_image`;
CREATE TABLE IF NOT EXISTS `product_has_image` (
  `product_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  `sortid` int(11) DEFAULT NULL,
  PRIMARY KEY (`product_id`,`image_id`),
  KEY `fk_product_has_image_image1` (`image_id`),
  KEY `fk_product_has_image_product1` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `product_has_image`
--

INSERT INTO `product_has_image` (`product_id`, `image_id`, `sortid`) VALUES
(184, 51, NULL),
(193, 52, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `product_has_product_category`
--

DROP TABLE IF EXISTS `product_has_product_category`;
CREATE TABLE IF NOT EXISTS `product_has_product_category` (
  `product_id` int(11) NOT NULL,
  `product_category_id` bigint(31) NOT NULL,
  PRIMARY KEY (`product_id`,`product_category_id`),
  KEY `fk_product_has_product_category_product_category1` (`product_category_id`),
  KEY `fk_product_has_product_category_product1` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `product_has_related_product`
--

DROP TABLE IF EXISTS `product_has_related_product`;
CREATE TABLE IF NOT EXISTS `product_has_related_product` (
  `product_id` int(11) NOT NULL,
  `related_product_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`related_product_id`),
  KEY `fk_product_has_product_product2` (`related_product_id`),
  KEY `fk_product_has_product_product1` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `product_lang`
--

DROP TABLE IF EXISTS `product_lang`;
CREATE TABLE IF NOT EXISTS `product_lang` (
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `lang` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  KEY `fk_product_lang_product1` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `product_lang`
--

INSERT INTO `product_lang` (`title`, `description`, `lang`, `product_id`) VALUES
('Wheel 17&quot;', NULL, 'AR', 184),
('Wheel 17&quot;', NULL, 'EN', 184),
('Wheel2', NULL, 'AR', 185),
('Wheel2', NULL, 'EN', 185),
('Montassar Wheel', NULL, 'AR', 186),
('Montassar Wheel', NULL, 'EN', 186),
('Montassar 2', NULL, 'AR', 187),
('Montassar 2', NULL, 'EN', 187),
('Iphone 5', NULL, 'AR', 188),
('Iphone 5', NULL, 'EN', 188),
('Galaxy SIII', NULL, 'AR', 189),
('Galaxy SIII', NULL, 'EN', 189),
('window 1', NULL, 'AR', 190),
('window 1', NULL, 'EN', 190),
('window 2', NULL, 'AR', 191),
('window 2', NULL, 'EN', 191),
('window 3', NULL, 'AR', 192),
('window 3', NULL, 'EN', 192),
('Faras Boot', 'asdasdasdasd\nas\nda\nsdasd', 'AR', 193),
('Faras Boot', 'asdasdasdasd\nas\nda\nsdasd', 'EN', 193),
('Faras Boot 2', 'asdasdasd', 'AR', 194),
('Faras Boot 2', 'asdasdasd', 'EN', 194),
('Faras Boot 3', NULL, 'AR', 195),
('Faras Boot 3', NULL, 'EN', 195);

-- --------------------------------------------------------

--
-- Stellvertreter-Struktur des Views `product_pivot_view_ar`
--
DROP VIEW IF EXISTS `product_pivot_view_ar`;
CREATE TABLE IF NOT EXISTS `product_pivot_view_ar` (
`id` int(11)
,`number` varchar(255)
,`price` float(15,4)
,`online` tinyint(1)
,`categorie_id` int(11)
,`discount` double(10,2)
,`remote_id` int(11)
,`insertat` datetime
,`updateat` datetime
,`product_set_id` int(11)
,`type_id` int(11)
,`title` varchar(255)
,`description` longtext
,`lang` varchar(3)
,`product_id` int(11)
,`wheelbrand` text
,`wheelprofile` text
,`wheeltreadwidth` text
,`numbertype` text
,`smartphoneos` text
,`smartphonememory` text
,`vehicletype` text
,`vehiclewindowtype` text
,`testcheck` text
,`checkb` text
,`smartphonecamera` text
,`smartphonecameraresol` text
,`smartphoneusb` text
,`watercraftlenght` text
,`watercraftusedhours` text
,`watercraftengine` text
,`watercraftenginemake` text
,`watercraftbodytype` text
,`watercraftgps` text
,`globalattributecolor` text
);
-- --------------------------------------------------------

--
-- Stellvertreter-Struktur des Views `product_pivot_view_en`
--
DROP VIEW IF EXISTS `product_pivot_view_en`;
CREATE TABLE IF NOT EXISTS `product_pivot_view_en` (
`id` int(11)
,`number` varchar(255)
,`price` float(15,4)
,`online` tinyint(1)
,`categorie_id` int(11)
,`discount` double(10,2)
,`remote_id` int(11)
,`insertat` datetime
,`updateat` datetime
,`product_set_id` int(11)
,`type_id` int(11)
,`title` varchar(255)
,`description` longtext
,`lang` varchar(3)
,`product_id` int(11)
,`wheelbrand` text
,`wheelprofile` text
,`wheeltreadwidth` text
,`numbertype` text
,`smartphoneos` text
,`smartphonememory` text
,`vehicletype` text
,`vehiclewindowtype` text
,`testcheck` text
,`checkb` text
,`smartphonecamera` text
,`smartphonecameraresol` text
,`smartphoneusb` text
,`watercraftlenght` text
,`watercraftusedhours` text
,`watercraftengine` text
,`watercraftenginemake` text
,`watercraftbodytype` text
,`watercraftgps` text
,`globalattributecolor` text
);
-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `product_set`
--

DROP TABLE IF EXISTS `product_set`;
CREATE TABLE IF NOT EXISTS `product_set` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=18 ;

--
-- Daten für Tabelle `product_set`
--

INSERT INTO `product_set` (`id`, `name`) VALUES
(1, 'Book'),
(10, 'Vehicle Wheel'),
(11, 'Number'),
(12, 'Boot'),
(13, 'Smartphone'),
(14, 'Vehicle Window'),
(16, 'realestate'),
(17, 'Water Craft');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `product_set_has_product_attribute`
--

DROP TABLE IF EXISTS `product_set_has_product_attribute`;
CREATE TABLE IF NOT EXISTS `product_set_has_product_attribute` (
  `product_set_id` int(11) NOT NULL,
  `product_attribute_id` int(11) NOT NULL,
  `sortid` int(11) DEFAULT NULL,
  `product_set_view_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`product_set_id`,`product_attribute_id`),
  KEY `fk_product_set_has_product_attribute_product_attribute1` (`product_attribute_id`),
  KEY `fk_product_set_has_product_attribute_product_set1` (`product_set_id`),
  KEY `product_set_view_id` (`product_set_view_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `product_set_has_product_attribute`
--

INSERT INTO `product_set_has_product_attribute` (`product_set_id`, `product_attribute_id`, `sortid`, `product_set_view_id`) VALUES
(1, 30, 0, NULL),
(1, 31, 1, NULL),
(10, 19, 0, NULL),
(10, 21, 3, NULL),
(10, 22, 1, NULL),
(13, 24, 0, NULL),
(13, 25, 1, NULL),
(13, 32, 0, 29),
(13, 33, 1, 29),
(13, 34, 0, 30),
(14, 26, 0, NULL),
(14, 27, 1, NULL),
(16, 19, 0, NULL),
(16, 21, 1, NULL),
(16, 22, 0, 27),
(16, 23, 1, 27),
(16, 24, 0, 26),
(16, 25, 2, 25),
(16, 26, 0, 25),
(16, 27, 1, 25),
(17, 35, 0, 31),
(17, 36, 3, NULL),
(17, 37, 2, NULL),
(17, 38, 1, NULL),
(17, 39, 0, NULL),
(17, 40, 0, 32),
(17, 41, 1, 32);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `product_set_view`
--

DROP TABLE IF EXISTS `product_set_view`;
CREATE TABLE IF NOT EXISTS `product_set_view` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `frontendvisible` tinyint(1) DEFAULT NULL,
  `product_set_id` int(11) NOT NULL,
  `sortid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_set_view_product_set1` (`product_set_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=33 ;

--
-- Daten für Tabelle `product_set_view`
--

INSERT INTO `product_set_view` (`id`, `frontendvisible`, `product_set_id`, `sortid`) VALUES
(23, NULL, 1, NULL),
(25, NULL, 16, NULL),
(26, NULL, 16, NULL),
(27, NULL, 16, NULL),
(29, NULL, 13, NULL),
(30, NULL, 13, NULL),
(31, NULL, 17, NULL),
(32, NULL, 17, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `product_set_view_lang`
--

DROP TABLE IF EXISTS `product_set_view_lang`;
CREATE TABLE IF NOT EXISTS `product_set_view_lang` (
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lang` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product_set_view_id` int(11) NOT NULL,
  KEY `fk_product_set_view_lang_product_set_view1` (`product_set_view_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `product_set_view_lang`
--

INSERT INTO `product_set_view_lang` (`name`, `lang`, `product_set_view_id`) VALUES
('Surfaces', 'AR', 23),
('Surfaces', 'EN', 23),
('rent', 'AR', 25),
('rent', 'EN', 25),
('surfaces', 'AR', 26),
('surfaces', 'EN', 26),
('distances', 'AR', 27),
('distances', 'EN', 27),
('Zubehör', 'AR', 29),
('Camera Informations', 'EN', 29),
('Inputs', 'AR', 30),
('Inputs', 'EN', 30),
('Dimentions', 'AR', 31),
('Dimentions', 'EN', 31),
('Options', 'AR', 32),
('Options', 'EN', 32);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `product_up_selling`
--

DROP TABLE IF EXISTS `product_up_selling`;
CREATE TABLE IF NOT EXISTS `product_up_selling` (
  `product_id` int(11) NOT NULL,
  `up_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`up_id`),
  KEY `fk_product_has_product_product6` (`up_id`),
  KEY `fk_product_has_product_product5` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur des Views `product_pivot_view_ar`
--
DROP TABLE IF EXISTS `product_pivot_view_ar`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `product_pivot_view_ar` AS select `product`.`id` AS `id`,`product`.`number` AS `number`,`product`.`price` AS `price`,`product`.`online` AS `online`,`product`.`categorie_id` AS `categorie_id`,`product`.`discount` AS `discount`,`product`.`remote_id` AS `remote_id`,`product`.`insertat` AS `insertat`,`product`.`updateat` AS `updateat`,`product`.`product_set_id` AS `product_set_id`,`product`.`type_id` AS `type_id`,`product_lang`.`title` AS `title`,`product_lang`.`description` AS `description`,`product_lang`.`lang` AS `lang`,`product_lang`.`product_id` AS `product_id`,max(if((`product_attribute`.`name` = 'wheelbrand'),`product_attribute_value_lang`.`value`,NULL)) AS `wheelbrand`,max(if((`product_attribute`.`name` = 'wheelprofile'),`product_attribute_value_lang`.`value`,NULL)) AS `wheelprofile`,max(if((`product_attribute`.`name` = 'wheeltreadwidth'),`product_attribute_value_lang`.`value`,NULL)) AS `wheeltreadwidth`,max(if((`product_attribute`.`name` = 'numbertype'),`product_attribute_value_lang`.`value`,NULL)) AS `numbertype`,max(if((`product_attribute`.`name` = 'smartphoneos'),`product_attribute_value_lang`.`value`,NULL)) AS `smartphoneos`,max(if((`product_attribute`.`name` = 'smartphonememory'),`product_attribute_value_lang`.`value`,NULL)) AS `smartphonememory`,max(if((`product_attribute`.`name` = 'vehicletype'),`product_attribute_value_lang`.`value`,NULL)) AS `vehicletype`,max(if((`product_attribute`.`name` = 'vehiclewindowtype'),`product_attribute_value_lang`.`value`,NULL)) AS `vehiclewindowtype`,max(if((`product_attribute`.`name` = 'testcheck'),`product_attribute_value_lang`.`value`,NULL)) AS `testcheck`,max(if((`product_attribute`.`name` = 'checkb'),`product_attribute_value_lang`.`value`,NULL)) AS `checkb`,max(if((`product_attribute`.`name` = 'smartphonecamera'),`product_attribute_value_lang`.`value`,NULL)) AS `smartphonecamera`,max(if((`product_attribute`.`name` = 'smartphonecameraresol'),`product_attribute_value_lang`.`value`,NULL)) AS `smartphonecameraresol`,max(if((`product_attribute`.`name` = 'smartphoneusb'),`product_attribute_value_lang`.`value`,NULL)) AS `smartphoneusb`,max(if((`product_attribute`.`name` = 'watercraftlenght'),`product_attribute_value_lang`.`value`,NULL)) AS `watercraftlenght`,max(if((`product_attribute`.`name` = 'watercraftusedhours'),`product_attribute_value_lang`.`value`,NULL)) AS `watercraftusedhours`,max(if((`product_attribute`.`name` = 'watercraftengine'),`product_attribute_value_lang`.`value`,NULL)) AS `watercraftengine`,max(if((`product_attribute`.`name` = 'watercraftenginemake'),`product_attribute_value_lang`.`value`,NULL)) AS `watercraftenginemake`,max(if((`product_attribute`.`name` = 'watercraftbodytype'),`product_attribute_value_lang`.`value`,NULL)) AS `watercraftbodytype`,max(if((`product_attribute`.`name` = 'watercraftgps'),`product_attribute_value_lang`.`value`,NULL)) AS `watercraftgps`,max(if((`product_attribute`.`name` = 'globalattributecolor'),`product_attribute_value_lang`.`value`,NULL)) AS `globalattributecolor` from ((((`product` left join `product_lang` on((`product`.`id` = `product_lang`.`product_id`))) left join `product_attribute_value` on((`product`.`id` = `product_attribute_value`.`product_id`))) left join `product_attribute_value_lang` on((`product_attribute_value`.`id` = `product_attribute_value_lang`.`product_attribute_value_id`))) left join `product_attribute` on((`product_attribute`.`id` = `product_attribute_value`.`product_attribute_id`))) where ((`product_attribute_value_lang`.`lang` = 'ar') and (`product_lang`.`lang` = 'ar')) group by `product`.`id`;

-- --------------------------------------------------------

--
-- Struktur des Views `product_pivot_view_en`
--
DROP TABLE IF EXISTS `product_pivot_view_en`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `product_pivot_view_en` AS select `product`.`id` AS `id`,`product`.`number` AS `number`,`product`.`price` AS `price`,`product`.`online` AS `online`,`product`.`categorie_id` AS `categorie_id`,`product`.`discount` AS `discount`,`product`.`remote_id` AS `remote_id`,`product`.`insertat` AS `insertat`,`product`.`updateat` AS `updateat`,`product`.`product_set_id` AS `product_set_id`,`product`.`type_id` AS `type_id`,`product_lang`.`title` AS `title`,`product_lang`.`description` AS `description`,`product_lang`.`lang` AS `lang`,`product_lang`.`product_id` AS `product_id`,max(if((`product_attribute`.`name` = 'wheelbrand'),`product_attribute_value_lang`.`value`,NULL)) AS `wheelbrand`,max(if((`product_attribute`.`name` = 'wheelprofile'),`product_attribute_value_lang`.`value`,NULL)) AS `wheelprofile`,max(if((`product_attribute`.`name` = 'wheeltreadwidth'),`product_attribute_value_lang`.`value`,NULL)) AS `wheeltreadwidth`,max(if((`product_attribute`.`name` = 'numbertype'),`product_attribute_value_lang`.`value`,NULL)) AS `numbertype`,max(if((`product_attribute`.`name` = 'smartphoneos'),`product_attribute_value_lang`.`value`,NULL)) AS `smartphoneos`,max(if((`product_attribute`.`name` = 'smartphonememory'),`product_attribute_value_lang`.`value`,NULL)) AS `smartphonememory`,max(if((`product_attribute`.`name` = 'vehicletype'),`product_attribute_value_lang`.`value`,NULL)) AS `vehicletype`,max(if((`product_attribute`.`name` = 'vehiclewindowtype'),`product_attribute_value_lang`.`value`,NULL)) AS `vehiclewindowtype`,max(if((`product_attribute`.`name` = 'testcheck'),`product_attribute_value_lang`.`value`,NULL)) AS `testcheck`,max(if((`product_attribute`.`name` = 'checkb'),`product_attribute_value_lang`.`value`,NULL)) AS `checkb`,max(if((`product_attribute`.`name` = 'smartphonecamera'),`product_attribute_value_lang`.`value`,NULL)) AS `smartphonecamera`,max(if((`product_attribute`.`name` = 'smartphonecameraresol'),`product_attribute_value_lang`.`value`,NULL)) AS `smartphonecameraresol`,max(if((`product_attribute`.`name` = 'smartphoneusb'),`product_attribute_value_lang`.`value`,NULL)) AS `smartphoneusb`,max(if((`product_attribute`.`name` = 'watercraftlenght'),`product_attribute_value_lang`.`value`,NULL)) AS `watercraftlenght`,max(if((`product_attribute`.`name` = 'watercraftusedhours'),`product_attribute_value_lang`.`value`,NULL)) AS `watercraftusedhours`,max(if((`product_attribute`.`name` = 'watercraftengine'),`product_attribute_value_lang`.`value`,NULL)) AS `watercraftengine`,max(if((`product_attribute`.`name` = 'watercraftenginemake'),`product_attribute_value_lang`.`value`,NULL)) AS `watercraftenginemake`,max(if((`product_attribute`.`name` = 'watercraftbodytype'),`product_attribute_value_lang`.`value`,NULL)) AS `watercraftbodytype`,max(if((`product_attribute`.`name` = 'watercraftgps'),`product_attribute_value_lang`.`value`,NULL)) AS `watercraftgps`,max(if((`product_attribute`.`name` = 'globalattributecolor'),`product_attribute_value_lang`.`value`,NULL)) AS `globalattributecolor` from ((((`product` left join `product_lang` on((`product`.`id` = `product_lang`.`product_id`))) left join `product_attribute_value` on((`product`.`id` = `product_attribute_value`.`product_id`))) left join `product_attribute_value_lang` on((`product_attribute_value`.`id` = `product_attribute_value_lang`.`product_attribute_value_id`))) left join `product_attribute` on((`product_attribute`.`id` = `product_attribute_value`.`product_attribute_id`))) where ((`product_attribute_value_lang`.`lang` = 'en') and (`product_lang`.`lang` = 'en')) group by `product`.`id`;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_product_product_set1` FOREIGN KEY (`product_set_id`) REFERENCES `product_set` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `product_attribute`
--
ALTER TABLE `product_attribute`
  ADD CONSTRAINT `fk_product_attribute_product_attribute_type1` FOREIGN KEY (`product_attribute_type_backend_id`) REFERENCES `product_attribute_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `product_attribute_datasource`
--
ALTER TABLE `product_attribute_datasource`
  ADD CONSTRAINT `product_attribute_datasource_ibfk_1` FOREIGN KEY (`product_attribute_id`) REFERENCES `product_attribute` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `product_attribute_datasource_lang`
--
ALTER TABLE `product_attribute_datasource_lang`
  ADD CONSTRAINT `fk_product_attribute_datasource_lang_product_attribute_dataso1` FOREIGN KEY (`product_attribute_datasource_id`) REFERENCES `product_attribute_datasource` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `product_attribute_lang`
--
ALTER TABLE `product_attribute_lang`
  ADD CONSTRAINT `fk_product_attribute_lang_product_attribute1` FOREIGN KEY (`product_attribute_id`) REFERENCES `product_attribute` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `product_attribute_value`
--
ALTER TABLE `product_attribute_value`
  ADD CONSTRAINT `fk_product_attribute_value_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_attribute_value_product_attribute1` FOREIGN KEY (`product_attribute_id`) REFERENCES `product_attribute` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `product_attribute_value_lang`
--
ALTER TABLE `product_attribute_value_lang`
  ADD CONSTRAINT `fk_product_attribute_value_lang_product_attribute_value1` FOREIGN KEY (`product_attribute_value_id`) REFERENCES `product_attribute_value` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `product_category`
--
ALTER TABLE `product_category`
  ADD CONSTRAINT `fk_product_category_image1` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_category_product_category1` FOREIGN KEY (`parent_id`) REFERENCES `product_category` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints der Tabelle `product_comment`
--
ALTER TABLE `product_comment`
  ADD CONSTRAINT `fk_product_comment_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `product_configuration`
--
ALTER TABLE `product_configuration`
  ADD CONSTRAINT `fk_product_configuration_product_set1` FOREIGN KEY (`product_set_id`) REFERENCES `product_set` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `product_configuration_has_product`
--
ALTER TABLE `product_configuration_has_product`
  ADD CONSTRAINT `fk_product_configuration_has_product_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_configuration_has_product_product_configuration1` FOREIGN KEY (`product_configuration_id`) REFERENCES `product_configuration` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `product_configuration_has_product_attribute`
--
ALTER TABLE `product_configuration_has_product_attribute`
  ADD CONSTRAINT `fk_product_configuration_has_product_attribute_product_attrib1` FOREIGN KEY (`product_attribute_id`) REFERENCES `product_attribute` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_configuration_has_product_attribute_product_config1` FOREIGN KEY (`product_configuration_id`) REFERENCES `product_configuration` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `product_cross_selling`
--
ALTER TABLE `product_cross_selling`
  ADD CONSTRAINT `fk_product_has_product_product3` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_has_product_product4` FOREIGN KEY (`cross_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `product_hast_grouped_product`
--
ALTER TABLE `product_hast_grouped_product`
  ADD CONSTRAINT `fk_product_hast_grouped_product_product1` FOREIGN KEY (`grouped_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_hast_grouped_product_product2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `product_has_document`
--
ALTER TABLE `product_has_document`
  ADD CONSTRAINT `fk_product_has_document_document1` FOREIGN KEY (`document_id`) REFERENCES `document` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_has_document_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `product_has_image`
--
ALTER TABLE `product_has_image`
  ADD CONSTRAINT `fk_product_has_image_image1` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_has_image_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `product_has_product_category`
--
ALTER TABLE `product_has_product_category`
  ADD CONSTRAINT `fk_product_has_product_category_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_has_product_category_product_category1` FOREIGN KEY (`product_category_id`) REFERENCES `product_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `product_has_related_product`
--
ALTER TABLE `product_has_related_product`
  ADD CONSTRAINT `fk_product_has_product_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_has_product_product2` FOREIGN KEY (`related_product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `product_lang`
--
ALTER TABLE `product_lang`
  ADD CONSTRAINT `fk_product_lang_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `product_set_has_product_attribute`
--
ALTER TABLE `product_set_has_product_attribute`
  ADD CONSTRAINT `fk_product_set_has_product_attribute_product_attribute1` FOREIGN KEY (`product_attribute_id`) REFERENCES `product_attribute` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_set_has_product_attribute_product_set1` FOREIGN KEY (`product_set_id`) REFERENCES `product_set` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_set_has_product_attribute_ibfk_1` FOREIGN KEY (`product_set_view_id`) REFERENCES `product_set_view` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `product_set_view`
--
ALTER TABLE `product_set_view`
  ADD CONSTRAINT `product_set_view_ibfk_1` FOREIGN KEY (`product_set_id`) REFERENCES `product_set` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `product_set_view_lang`
--
ALTER TABLE `product_set_view_lang`
  ADD CONSTRAINT `fk_product_set_view_lang_product_set_view1` FOREIGN KEY (`product_set_view_id`) REFERENCES `product_set_view` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `product_up_selling`
--
ALTER TABLE `product_up_selling`
  ADD CONSTRAINT `fk_product_has_product_product5` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_has_product_product6` FOREIGN KEY (`up_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;




DROP TABLE IF EXISTS `entity_attribute_lang`;
CREATE TABLE IF NOT EXISTS `entity_attribute_lang` (
entity_attribute_id INT NOT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `datasource` text COLLATE utf8_unicode_ci,
  `product_attribute_id` int(11) NOT NULL,
  `lang` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `errormessage` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  KEY `fk_entity_attribute_lang_entity_attribute1` (`entity_attribute_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


ALTER TABLE `entity_attribute_lang`
  ADD CONSTRAINT `fk_entity_attribute_lang_entity_attribute1` FOREIGN KEY (`entity_attribute_id`) REFERENCES `entity_attribute` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
