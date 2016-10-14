-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 15. Dezember 2012 um 10:34
-- Server Version: 5.1.44
-- PHP-Version: 5.3.1

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT=0;
START TRANSACTION;

--
-- Datenbank: `motorssouq`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `entity_attribute`
--

DROP TABLE IF EXISTS `entity_attribute`;
CREATE TABLE IF NOT EXISTS `entity_attribute` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `defaultvalue` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `searchable` tinyint(1) DEFAULT '0',
  `validator` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `required` tinyint(1) DEFAULT NULL,
  `entity_attribute_type_backend_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  KEY `fk_entity_attribute_entity_attribute_type1` (`entity_attribute_type_backend_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=43 ;

--
-- Daten für Tabelle `entity_attribute`
--

INSERT INTO `entity_attribute` (`id`, `name`, `defaultvalue`, `searchable`, `validator`, `required`, `entity_attribute_type_backend_id`) VALUES
(11, 'tyre_width', NULL, 1, NULL, 1, 2),
(12, 'tyre_aspect', NULL, 1, NULL, 1, 2),
(13, 'tyre_rim', NULL, 1, NULL, 1, 2),
(14, 'tyre_load', NULL, 1, NULL, 1, 2),
(15, 'tyre_speed', NULL, 1, NULL, 1, 2),
(19, 'tyre_weather', NULL, 1, NULL, 1, 2),
(21, 'shoes_size', NULL, 1, NULL, 1, 2),
(22, 'shoes_color', NULL, 1, NULL, 1, 21),
(24, 'shoes_brand', NULL, 1, NULL, 0, 2),
(25, 'shoes_style', NULL, 1, NULL, 0, 2),
(26, 'dress_size', NULL, 1, NULL, 1, 2),
(28, 'dress_style', NULL, 1, NULL, 0, 2),
(29, 'dress_brand', NULL, 1, NULL, 0, 2),
(30, 'dress_color', NULL, 1, NULL, 1, 21),
(31, 'skirts_size', NULL, 1, NULL, 1, 2),
(33, 'skirts_color', NULL, 1, NULL, 1, 21),
(34, 'skirts_brand', NULL, 1, NULL, 0, 2),
(35, 'skirts_style', NULL, 1, NULL, 0, 2),
(36, 'jackets_color', NULL, 1, NULL, 1, 21),
(37, 'jackets_size', NULL, 1, NULL, 1, 2),
(38, 'sweatshirts_size', NULL, 1, NULL, 1, 2),
(39, 'sweatshirts_color', NULL, 1, NULL, 1, 21),
(40, 'sportpants_size', NULL, 1, NULL, 1, 2),
(41, 'sportpants_color', NULL, 1, NULL, 1, 21),
(42, 'sportpants_style', NULL, 1, NULL, 0, 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `entity_attribute_datasource`
--

DROP TABLE IF EXISTS `entity_attribute_datasource`;
CREATE TABLE IF NOT EXISTS `entity_attribute_datasource` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entity_attribute_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_attribute_id` (`entity_attribute_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=136 ;

--
-- Daten für Tabelle `entity_attribute_datasource`
--

INSERT INTO `entity_attribute_datasource` (`id`, `entity_attribute_id`) VALUES
(1, 11),
(2, 11),
(3, 11),
(4, 11),
(5, 11),
(6, 11),
(7, 11),
(8, 11),
(9, 11),
(10, 11),
(11, 11),
(12, 11),
(13, 11),
(14, 11),
(15, 11),
(16, 11),
(17, 11),
(18, 11),
(19, 11),
(20, 11),
(21, 12),
(22, 12),
(23, 12),
(24, 12),
(25, 12),
(26, 12),
(37, 13),
(38, 13),
(39, 13),
(40, 13),
(41, 13),
(42, 13),
(43, 13),
(44, 13),
(27, 14),
(28, 14),
(29, 14),
(30, 14),
(31, 14),
(32, 14),
(33, 14),
(34, 14),
(35, 15),
(36, 15),
(48, 19),
(49, 19),
(50, 19),
(51, 21),
(52, 21),
(53, 21),
(54, 21),
(55, 21),
(56, 21),
(57, 21),
(58, 21),
(59, 21),
(60, 24),
(61, 24),
(62, 24),
(63, 24),
(64, 24),
(65, 25),
(66, 25),
(67, 25),
(68, 25),
(69, 25),
(70, 26),
(71, 26),
(72, 26),
(73, 26),
(74, 26),
(75, 26),
(76, 26),
(77, 26),
(78, 26),
(79, 26),
(80, 26),
(81, 28),
(82, 28),
(83, 28),
(84, 28),
(85, 28),
(86, 29),
(87, 29),
(88, 29),
(89, 29),
(97, 31),
(98, 31),
(99, 31),
(100, 31),
(101, 31),
(102, 31),
(103, 31),
(104, 31),
(90, 34),
(91, 34),
(92, 34),
(93, 34),
(94, 34),
(95, 35),
(96, 35),
(105, 37),
(106, 37),
(107, 37),
(108, 37),
(109, 37),
(110, 37),
(111, 37),
(112, 37),
(113, 37),
(114, 37),
(115, 38),
(116, 38),
(117, 38),
(118, 38),
(119, 38),
(120, 38),
(121, 38),
(122, 38),
(123, 38),
(124, 38),
(125, 40),
(126, 40),
(127, 40),
(128, 40),
(129, 40),
(130, 40),
(131, 40),
(132, 40),
(133, 40),
(134, 42),
(135, 42);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `entity_attribute_datasource_lang`
--

DROP TABLE IF EXISTS `entity_attribute_datasource_lang`;
CREATE TABLE IF NOT EXISTS `entity_attribute_datasource_lang` (
  `value` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lang` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `entity_attribute_datasource_id` int(11) NOT NULL,
  KEY `fk_product_attribute_datasource_lang_product_attribute_dataso1` (`entity_attribute_datasource_id`),
  KEY `lang` (`lang`),
  KEY `value` (`value`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `entity_attribute_datasource_lang`
--

INSERT INTO `entity_attribute_datasource_lang` (`value`, `lang`, `entity_attribute_datasource_id`) VALUES
('125', 'en', 1),
('125', 'ar', 1),
('135', 'en', 2),
('135', 'ar', 2),
('145', 'en', 3),
('145', 'ar', 3),
('155', 'en', 4),
('155', 'ar', 4),
('165', 'en', 5),
('165', 'ar', 5),
('175', 'en', 6),
('175', 'ar', 6),
('185', 'en', 7),
('185', 'ar', 7),
('195', 'en', 8),
('195', 'ar', 8),
('205', 'en', 9),
('205', 'ar', 9),
('215', 'en', 10),
('215', 'ar', 10),
('225', 'en', 11),
('225', 'ar', 11),
('235', 'en', 12),
('235', 'ar', 12),
('245', 'en', 13),
('235', 'ar', 13),
('255', 'en', 14),
('255', 'ar', 14),
('265', 'en', 15),
('265', 'ar', 15),
('275', 'en', 16),
('275', 'ar', 16),
('285', 'en', 17),
('285', 'ar', 17),
('295', 'en', 18),
('295', 'ar', 18),
('305', 'en', 19),
('305', 'ar', 19),
('315', 'en', 20),
('315', 'ar', 20),
('45', 'en', 21),
('45', 'ar', 21),
('50', 'en', 22),
('50', 'ar', 22),
('55', 'en', 23),
('55', 'ar', 23),
('60', 'en', 24),
('60', 'ar', 24),
('65', 'en', 25),
('65', 'ar', 25),
('70', 'en', 26),
('70', 'ar', 26),
('R14', 'en', 27),
('R14', 'ar', 27),
('R15', 'en', 28),
('R15', 'ar', 28),
('R16', 'en', 29),
('R16', 'ar', 29),
('R17', 'en', 30),
('R17', 'ar', 30),
('R18', 'en', 31),
('R18', 'ar', 31),
('R19', 'en', 32),
('R19', 'ar', 32),
('R20', 'en', 33),
('R20', 'ar', 33),
('R21', 'en', 34),
('R21', 'ar', 34),
('H up to 210 Km/h', 'en', 35),
('H up to 210 Km/h', 'ar', 35),
('S, T up to 190 Hm/h', 'en', 36),
('S, T up to 190 Hm/h', 'ar', 36),
('R14', 'en', 37),
('R14', 'ar', 37),
('R15', 'en', 38),
('R16', 'ar', 38),
('R16', 'en', 39),
('R16', 'ar', 39),
('R17', 'en', 40),
('R17', 'ar', 40),
('R18', 'en', 41),
('R18', 'ar', 41),
('R19', 'en', 42),
('R19', 'ar', 42),
('R20', 'en', 43),
('R20', 'ar', 43),
('R21', 'en', 44),
('R21', 'ar', 44),
('Sommer', 'en', 48),
('Sommer', 'ar', 48),
('Winter', 'en', 49),
('Winter', 'ar', 49),
('Allweather', 'en', 50),
('Allweather', 'ar', 50),
('32', 'en', 51),
('32', 'ar', 51),
('33', 'en', 52),
('33', 'ar', 52),
('36', 'en', 53),
('36', 'ar', 53),
('37', 'en', 54),
('37', 'ar', 54),
('38', 'en', 55),
('38', 'ar', 55),
('39', 'en', 56),
('39', 'ar', 56),
('40', 'en', 57),
('40', 'ar', 57),
('41', 'en', 58),
('41', 'ar', 58),
('42', 'en', 59),
('42', 'ar', 59),
('BODYFLIRT', 'en', 60),
('BODYFLIRT', 'ar', 60),
('Glööckler', 'en', 61),
('Glööckler', 'ar', 61),
('John Baner Jeanswear', 'en', 62),
('John Baner Jeanswear', 'ar', 62),
('RAINBOW', 'en', 63),
('RAINBOW', 'ar', 63),
('bcp bonprix collection', 'en', 64),
('bcp bonprix collection', 'ar', 64),
('Boots', 'en', 65),
('Boots', 'ar', 65),
('High heel', 'en', 66),
('High', 'ar', 66),
('Flat low', 'en', 67),
('Flat', 'ar', 67),
('Pumps', 'en', 68),
('Pumps', 'ar', 68),
('Sandals', 'en', 69),
('Sandals', 'ar', 69),
('32', 'en', 70),
('32', 'ar', 70),
('34', 'en', 71),
('34', 'ar', 71),
('36', 'en', 72),
('36', 'ar', 72),
('38', 'en', 73),
('38', 'ar', 73),
('40', 'en', 74),
('40', 'ar', 74),
('42', 'en', 75),
('42', 'ar', 75),
('44', 'en', 76),
('44', 'ar', 76),
('46', 'en', 77),
('46', 'ar', 77),
('48', 'en', 78),
('48', 'ar', 78),
('50', 'en', 79),
('50', 'ar', 79),
('52', 'en', 80),
('50', 'ar', 80),
('Short', 'en', 81),
('Short', 'ar', 81),
('Long', 'en', 82),
('Long', 'ar', 82),
('One Shoulder', 'en', 83),
('One Shoulder', 'ar', 83),
('Sleeveless', 'en', 84),
('Sleeveless', 'ar', 84),
('Party Dress', 'en', 85),
('Party Dress', 'ar', 85),
('BODYFLIRT', 'en', 86),
('BODYFLIRT', 'ar', 86),
('RAINBOW', 'en', 87),
('RAINBOW', 'ar', 87),
('bpc bonprix collection', 'en', 88),
('bpc bonprix collection', 'ar', 88),
('bpc selection', 'en', 89),
('bpc selection', 'ar', 89),
('BODYFLIRT', 'en', 90),
('BODYFLIRT', 'ar', 90),
('Glööckler', 'en', 91),
('Glööckler', 'ar', 91),
('John Baner Jeanswear', 'en', 92),
('John Baner Jeanswear', 'ar', 92),
('RAINBOW', 'en', 93),
('RAINBOW', 'ar', 93),
('bcp bonprix collection', 'en', 94),
('bcp bonprix collection', 'ar', 94),
('Long', 'en', 95),
('Long', 'ar', 95),
('Short', 'en', 96),
('Short', 'ar', 96),
('32', 'en', 97),
('32', 'ar', 97),
('34', 'en', 98),
('34', 'ar', 98),
('36', 'en', 99),
('36', 'ar', 99),
('38', 'en', 100),
('38', 'ar', 100),
('40', 'en', 101),
('40', 'ar', 101),
('42', 'en', 102),
('42', 'ar', 102),
('44', 'en', 103),
('44', 'ar', 103),
('46', 'en', 104),
('46', 'ar', 104),
('46', 'en', 105),
('46', 'ar', 105),
('48', 'en', 106),
('48', 'ar', 106),
('50', 'en', 107),
('50', 'ar', 107),
('52', 'en', 108),
('52', 'ar', 108),
('54', 'en', 109),
('54', 'ar', 109),
('56', 'en', 110),
('56', 'ar', 110),
('58', 'en', 111),
('58', 'ar', 111),
('60', 'en', 112),
('60', 'ar', 112),
('62', 'en', 113),
('62', 'ar', 113),
('64', 'en', 114),
('64', 'ar', 114),
('34', 'en', 115),
('34', 'ar', 115),
('36', 'en', 116),
('36', 'ar', 116),
('38', 'en', 117),
('38', 'ar', 117),
('40', 'en', 118),
('40', 'ar', 118),
('42', 'en', 119),
('42', 'ar', 119),
('44', 'en', 120),
('43', 'ar', 120),
('46', 'en', 121),
('46', 'ar', 121),
('48', 'en', 122),
('48', 'ar', 122),
('50', 'en', 123),
('50', 'ar', 123),
('52', 'en', 124),
('52', 'ar', 124),
('30', 'en', 125),
('30', 'ar', 125),
('32', 'en', 126),
('32', 'ar', 126),
('34', 'en', 127),
('34', 'ar', 127),
('36', 'en', 128),
('36', 'ar', 128),
('38', 'en', 129),
('38', 'ar', 129),
('40', 'en', 130),
('40', 'ar', 130),
('42', 'en', 131),
('42', 'ar', 131),
('44', 'en', 132),
('444', 'ar', 132),
('46', 'en', 133),
('46', 'ar', 133),
('Short', 'en', 134),
('Short', 'ar', 134),
('Long', 'en', 135),
('Long', 'ar', 135);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `entity_attribute_lang`
--

DROP TABLE IF EXISTS `entity_attribute_lang`;
CREATE TABLE IF NOT EXISTS `entity_attribute_lang` (
  `entity_attribute_id` int(11) NOT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `datasource` text COLLATE utf8_unicode_ci,
  `lang` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `errormessage` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  KEY `fk_entity_attribute_lang_entity_attribute1` (`entity_attribute_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `entity_attribute_lang`
--

INSERT INTO `entity_attribute_lang` (`entity_attribute_id`, `label`, `datasource`, `lang`, `errormessage`) VALUES
(11, 'Tyre Width', NULL, 'en', NULL),
(11, 'Tyre Width', NULL, 'ar', NULL),
(12, 'Tyre Aspect', NULL, 'en', NULL),
(12, 'Tyre Aspect', NULL, 'ar', NULL),
(13, 'Tyre Rim', NULL, 'en', NULL),
(13, 'Tyre Rim', NULL, 'ar', NULL),
(14, 'Tyre Load', NULL, 'en', NULL),
(14, 'Tyre Load', NULL, 'ar', NULL),
(15, 'Tyre Speed', NULL, 'en', NULL),
(15, 'Tyre Speed', NULL, 'ar', NULL),
(19, 'Weather', NULL, 'en', NULL),
(19, 'Weather', NULL, 'ar', NULL),
(21, 'Size', NULL, 'en', NULL),
(21, 'Size', NULL, 'ar', NULL),
(22, 'Color', NULL, 'en', NULL),
(22, 'Color', NULL, 'ar', NULL),
(24, 'Brand', NULL, 'en', NULL),
(24, 'Brand', NULL, 'ar', NULL),
(25, 'Style', NULL, 'en', NULL),
(25, 'Style', NULL, 'ar', NULL),
(26, 'Size', NULL, 'en', NULL),
(26, 'Size', NULL, 'ar', NULL),
(28, 'Style', NULL, 'en', NULL),
(28, 'Style', NULL, 'ar', NULL),
(29, 'Brand', NULL, 'en', NULL),
(29, 'Brand', NULL, 'ar', NULL),
(30, 'Color', NULL, 'en', NULL),
(30, 'Color', NULL, 'ar', NULL),
(31, 'Size', NULL, 'en', NULL),
(31, 'Size', NULL, 'ar', NULL),
(33, 'Color', NULL, 'en', NULL),
(33, 'Color', NULL, 'ar', NULL),
(34, 'Brand', NULL, 'en', NULL),
(34, 'Brand', NULL, 'ar', NULL),
(35, 'Style', NULL, 'en', NULL),
(35, 'Style', NULL, 'ar', NULL),
(36, 'Color', NULL, 'en', NULL),
(36, 'Color', NULL, 'ar', NULL),
(37, 'Size', NULL, 'en', NULL),
(37, 'Size', NULL, 'ar', NULL),
(38, 'Size', NULL, 'en', NULL),
(38, 'Size', NULL, 'ar', NULL),
(39, 'Color', NULL, 'en', NULL),
(39, 'Color', NULL, 'ar', NULL),
(40, 'Size', NULL, 'en', NULL),
(40, 'Size', NULL, 'ar', NULL),
(41, 'Color', NULL, 'en', NULL),
(41, 'Color', NULL, 'ar', NULL),
(42, 'Style', NULL, 'en', NULL),
(42, 'Style', NULL, 'ar', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `entity_attribute_type`
--

DROP TABLE IF EXISTS `entity_attribute_type`;
CREATE TABLE IF NOT EXISTS `entity_attribute_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `typename` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

--
-- Daten für Tabelle `entity_attribute_type`
--

INSERT INTO `entity_attribute_type` (`id`, `name`, `typename`) VALUES
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
-- Tabellenstruktur für Tabelle `entity_attribute_value`
--

DROP TABLE IF EXISTS `entity_attribute_value`;
CREATE TABLE IF NOT EXISTS `entity_attribute_value` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entity_attribute_id` int(11) DEFAULT NULL,
  `entity_id` int(11) NOT NULL,
  `entity_table_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_attribute_value_product_attribute1` (`entity_attribute_id`),
  KEY `fk_product_attribute_value_product1` (`entity_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=131 ;

--
-- Daten für Tabelle `entity_attribute_value`
--

INSERT INTO `entity_attribute_value` (`id`, `entity_attribute_id`, `entity_id`, `entity_table_name`) VALUES
(4, 11, 2, ''),
(5, 12, 2, ''),
(6, 13, 2, ''),
(7, 14, 2, ''),
(8, 15, 2, ''),
(9, 11, 3, ''),
(10, 12, 3, ''),
(11, 13, 3, ''),
(12, 14, 3, ''),
(13, 15, 3, ''),
(14, 11, 4, ''),
(15, 12, 4, ''),
(16, 13, 4, ''),
(17, 15, 4, ''),
(18, 11, 5, ''),
(19, 12, 5, ''),
(20, 13, 5, ''),
(21, 15, 5, ''),
(22, 11, 6, ''),
(23, 12, 6, ''),
(24, 13, 6, ''),
(25, 15, 6, ''),
(27, 11, 1, ''),
(28, 12, 1, ''),
(29, 13, 1, ''),
(30, 15, 1, ''),
(34, 11, 7, ''),
(35, 12, 7, ''),
(36, 13, 7, ''),
(37, 15, 7, ''),
(38, 14, 5, ''),
(39, 14, 6, ''),
(40, 21, 6, ''),
(41, 22, 6, ''),
(42, 21, 7, ''),
(43, 22, 7, ''),
(44, 21, 8, ''),
(45, 22, 8, ''),
(46, 24, 8, ''),
(47, 25, 8, ''),
(48, 21, 9, ''),
(49, 22, 9, ''),
(50, 24, 9, ''),
(51, 25, 9, ''),
(52, 21, 10, ''),
(53, 22, 10, ''),
(54, 24, 10, ''),
(55, 25, 10, ''),
(56, 30, 11, ''),
(57, 26, 11, ''),
(58, 28, 11, ''),
(59, 29, 11, ''),
(60, 30, 12, ''),
(61, 26, 12, ''),
(62, 28, 12, ''),
(63, 29, 12, ''),
(64, 30, 13, ''),
(65, 26, 13, ''),
(66, 28, 13, ''),
(67, 29, 13, ''),
(68, 30, 14, ''),
(69, 26, 14, ''),
(70, 28, 14, ''),
(71, 29, 14, ''),
(72, 31, 15, ''),
(73, 33, 15, ''),
(74, 34, 15, ''),
(75, 35, 15, ''),
(76, 31, 16, ''),
(77, 33, 16, ''),
(78, 34, 16, ''),
(79, 35, 16, ''),
(80, 31, 17, ''),
(81, 33, 17, ''),
(82, 34, 17, ''),
(83, 35, 17, ''),
(84, 31, 18, ''),
(85, 33, 18, ''),
(86, 34, 18, ''),
(87, 35, 18, ''),
(88, 31, 19, ''),
(89, 33, 19, ''),
(90, 34, 19, ''),
(91, 35, 19, ''),
(92, 36, 20, ''),
(93, 37, 20, ''),
(94, 36, 21, ''),
(95, 37, 21, ''),
(96, 36, 22, ''),
(97, 37, 22, ''),
(98, 36, 23, ''),
(99, 37, 23, ''),
(100, 36, 24, ''),
(101, 37, 24, ''),
(102, 38, 25, ''),
(103, 39, 25, ''),
(104, 38, 26, ''),
(105, 39, 26, ''),
(106, 38, 27, ''),
(107, 39, 27, ''),
(108, 38, 28, ''),
(109, 39, 28, ''),
(110, 38, 29, ''),
(111, 39, 29, ''),
(112, 40, 30, ''),
(113, 41, 30, ''),
(114, 42, 30, ''),
(115, 40, 31, ''),
(116, 41, 31, ''),
(117, 42, 31, ''),
(118, 40, 32, ''),
(119, 41, 32, ''),
(120, 42, 32, ''),
(121, 40, 33, ''),
(122, 41, 33, ''),
(123, 42, 33, ''),
(124, 40, 34, ''),
(125, 41, 34, ''),
(126, 42, 34, ''),
(127, 40, 35, ''),
(128, 41, 35, ''),
(129, 42, 35, ''),
(130, 19, 5, '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `entity_attribute_value_lang`
--

DROP TABLE IF EXISTS `entity_attribute_value_lang`;
CREATE TABLE IF NOT EXISTS `entity_attribute_value_lang` (
  `value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lang` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `entity_attribute_value_id` int(11) NOT NULL,
  KEY `fk_product_attribute_value_lang_product_attribute_value1` (`entity_attribute_value_id`),
  KEY `lang` (`lang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `entity_attribute_value_lang`
--

INSERT INTO `entity_attribute_value_lang` (`value`, `lang`, `entity_attribute_value_id`) VALUES
('4', 'en', 4),
('4', 'ar', 4),
('21', 'en', 5),
('21', 'ar', 5),
('37', 'en', 6),
('37', 'ar', 6),
('27', 'en', 7),
('27', 'ar', 7),
('35', 'en', 8),
('35', 'ar', 8),
('9', 'en', 9),
('9', 'ar', 9),
('23', 'en', 10),
('23', 'ar', 10),
('39', 'en', 11),
('39', 'ar', 11),
('27', 'en', 12),
('27', 'ar', 12),
('35', 'en', 13),
('35', 'ar', 13),
('1', 'en', 14),
('1', 'ar', 14),
('21', 'en', 15),
('21', 'ar', 15),
('37', 'en', 16),
('37', 'ar', 16),
('35', 'en', 17),
('35', 'ar', 17),
('16', 'en', 18),
('16', 'ar', 18),
('21', 'en', 19),
('21', 'ar', 19),
('40', 'en', 20),
('40', 'ar', 20),
('35', 'en', 21),
('35', 'ar', 21),
('9', 'en', 22),
('9', 'ar', 22),
('24', 'en', 23),
('24', 'ar', 23),
('41', 'en', 24),
('41', 'ar', 24),
('36', 'en', 25),
('36', 'ar', 25),
('1', 'en', 27),
('1', 'ar', 27),
('21', 'en', 28),
('21', 'ar', 28),
('37', 'en', 29),
('37', 'ar', 29),
('35', 'en', 30),
('35', 'ar', 30),
('2', 'en', 34),
('2', 'ar', 34),
('23', 'en', 35),
('23', 'ar', 35),
('41', 'en', 36),
('41', 'ar', 36),
('36', 'en', 37),
('36', 'ar', 37),
('27', 'en', 38),
('27', 'ar', 38),
('27', 'en', 39),
('27', 'ar', 39),
('53', 'en', 40),
('53', 'ar', 40),
('e61212', 'en', 41),
('e61212', 'ar', 41),
('54', 'en', 42),
('54', 'ar', 42),
('e61212', 'en', 43),
('e61212', 'ar', 43),
('52', 'en', 44),
('52', 'ar', 44),
('15b0db', 'en', 45),
('15b0db', 'ar', 45),
('61', 'en', 46),
('61', 'ar', 46),
('69', 'en', 47),
('69', 'ar', 47),
('54', 'en', 48),
('54', 'ar', 48),
('e61212', 'en', 49),
('e61212', 'ar', 49),
('63', 'en', 50),
('63', 'ar', 50),
('66', 'en', 51),
('66', 'ar', 51),
('54', 'en', 52),
('54', 'ar', 52),
('15b0db', 'en', 53),
('15b0db', 'ar', 53),
('63', 'en', 54),
('63', 'ar', 54),
('65', 'en', 55),
('65', 'ar', 55),
('050000', 'en', 56),
('050000', 'ar', 56),
('72', 'en', 57),
('72', 'ar', 57),
('81', 'en', 58),
('81', 'ar', 58),
('86', 'en', 59),
('86', 'ar', 59),
('050000', 'en', 60),
('050000', 'ar', 60),
('70', 'en', 61),
('70', 'ar', 61),
('82', 'en', 62),
('82', 'ar', 62),
('86', 'en', 63),
('86', 'ar', 63),
('ff0000', 'en', 64),
('ff0000', 'ar', 64),
('71', 'en', 65),
('71', 'ar', 65),
('83', 'en', 66),
('83', 'ar', 66),
('88', 'en', 67),
('88', 'ar', 67),
('ff7700', 'en', 68),
('ff7700', 'ar', 68),
('70', 'en', 69),
('70', 'ar', 69),
('85', 'en', 70),
('85', 'ar', 70),
('86', 'en', 71),
('86', 'ar', 71),
('102', 'en', 72),
('102', 'ar', 72),
('000000', 'en', 73),
('000000', 'ar', 73),
('90', 'en', 74),
('90', 'ar', 74),
('96', 'en', 75),
('96', 'ar', 75),
('100', 'en', 76),
('100', 'ar', 76),
('ff9d00', 'en', 77),
('ff9d00', 'ar', 77),
('90', 'en', 78),
('90', 'ar', 78),
('96', 'en', 79),
('96', 'ar', 79),
('97', 'en', 80),
('97', 'ar', 80),
('000000', 'en', 81),
('000000', 'ar', 81),
(NULL, 'en', 82),
(NULL, 'ar', 82),
('95', 'en', 83),
('95', 'ar', 83),
('100', 'en', 84),
('100', 'ar', 84),
('ffffff', 'en', 85),
('ffffff', 'ar', 85),
('90', 'en', 86),
('90', 'ar', 86),
('95', 'en', 87),
('95', 'ar', 87),
('97', 'en', 88),
('97', 'ar', 88),
('000000', 'en', 89),
('000000', 'ar', 89),
(NULL, 'en', 90),
(NULL, 'ar', 90),
('95', 'en', 91),
('95', 'ar', 91),
('0095ff', 'en', 92),
('0095ff', 'ar', 92),
('110', 'en', 93),
('110', 'ar', 93),
('000000', 'en', 94),
('000000', 'ar', 94),
('105', 'en', 95),
('105', 'ar', 95),
('0095ff', 'en', 96),
('0095ff', 'ar', 96),
('111', 'en', 97),
('111', 'ar', 97),
('000000', 'en', 98),
('000000', 'ar', 98),
('105', 'en', 99),
('105', 'ar', 99),
('000000', 'en', 100),
('000000', 'ar', 100),
('105', 'en', 101),
('105', 'ar', 101),
('119', 'en', 102),
('119', 'ar', 102),
('ff0000', 'en', 103),
('ff0000', 'ar', 103),
('121', 'en', 104),
('121', 'ar', 104),
('ffffff', 'en', 105),
('ffffff', 'ar', 105),
('115', 'en', 106),
('115', 'ar', 106),
('008cff', 'en', 107),
('008cff', 'ar', 107),
('119', 'en', 108),
('119', 'ar', 108),
('008cff', 'en', 109),
('008cff', 'ar', 109),
('119', 'en', 110),
('119', 'ar', 110),
('000000', 'en', 111),
('000000', 'ar', 111),
('129', 'en', 112),
('129', 'ar', 112),
('2200ff', 'en', 113),
('2200ff', 'ar', 113),
('135', 'en', 114),
('135', 'ar', 114),
('130', 'en', 115),
('130', 'ar', 115),
('ffffff', 'en', 116),
('ffffff', 'ar', 116),
('135', 'en', 117),
('135', 'ar', 117),
('125', 'en', 118),
('125', 'ar', 118),
('000000', 'en', 119),
('000000', 'ar', 119),
('135', 'en', 120),
('135', 'ar', 120),
('131', 'en', 121),
('131', 'ar', 121),
('000000', 'en', 122),
('000000', 'ar', 122),
('134', 'en', 123),
('134', 'ar', 123),
('129', 'en', 124),
('129', 'ar', 124),
('b8b8b8', 'en', 125),
('b8b8b8', 'ar', 125),
('134', 'en', 126),
('134', 'ar', 126),
('130', 'en', 127),
('130', 'ar', 127),
('ff0000', 'en', 128),
('ff0000', 'ar', 128),
('135', 'en', 129),
('135', 'ar', 129),
(NULL, 'en', 130),
(NULL, 'ar', 130);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `entity_rating`
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
  PRIMARY KEY (`id`),
  KEY `entity_id` (`entity_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Daten für Tabelle `entity_rating`
--

INSERT INTO `entity_rating` (`id`, `entity_id`, `entity_class`, `rate`, `name`, `comment`, `rate_date_time`, `ip`) VALUES
(1, 26, 'Product_Product_Model', 3, 'adasdasd', 'asdasdasd', '2012-12-05 12:15:40', '::1'),
(2, 26, 'Product_Product_Model', 3, 'adasdasd', 'asdasdasd', '2012-12-05 12:16:00', '::1'),
(3, 26, 'Product_Product_Model', 4, 'Meriem Sayah', 'das ist ein sehr guutes product', '2012-12-05 12:22:08', '::1'),
(4, 1, 'Product_Product_Model', 4, 'Amir Cherif', 'Sehr gut, genre wieder', '2012-12-05 13:11:03', '::1'),
(5, 1, 'Product_Product_Model', 2, 'Meriem Sayah', 'sehr hässlich', '2012-12-05 13:35:12', '::1'),
(6, 5, 'Product_Product_Model', 5, 'Meriem Sayah', 'sehr gut', '2012-12-05 13:38:56', '::1'),
(7, 5, 'Product_Product_Model', 1, 'Meriem Sayah', 'sehr schlecht', '2012-12-05 13:39:25', '::1'),
(8, 5, 'Product_Product_Model', 3, 'Amir Cherif', 'Gerne wieder.\r\nAlles prima!!!!!', '2012-12-05 13:41:26', '::1'),
(9, 5, 'Product_Product_Model', 4, 'Montassar Smida', 'Perfect! good Shoes!', '2012-12-05 13:43:38', '::1'),
(10, 4, 'Product_Product_Model', 3, 'asdasd', 'adsaa', '2012-12-05 18:59:42', '::1'),
(11, 1638, 'Vehicle_Vehicle_Model', 3, 'aaasdadad', 'asdasdad', '2012-12-05 19:12:00', '::1'),
(12, 1632, 'Vehicle_Vehicle_Model', 4, 'Faras Al jowder', 'very good machine!', '2012-12-06 17:40:38', '::1'),
(13, 1632, 'Vehicle_Vehicle_Model', 5, 'Amir Cherif', 'Very very good maschine!!!!1', '2012-12-06 17:41:02', '::1'),
(14, 415, 'Cms_Page_Model', 5, 'Amir Cherif', 'Very good artcicle', '2012-12-06 17:42:47', '::1'),
(15, 0, 'product_rating_block', 5, 'Selman', 'test', '2012-12-08 21:04:27', '::1');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `entity_set`
--

DROP TABLE IF EXISTS `entity_set`;
CREATE TABLE IF NOT EXISTS `entity_set` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `entity_table_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Daten für Tabelle `entity_set`
--

INSERT INTO `entity_set` (`id`, `name`, `entity_table_name`) VALUES
(4, 'Tyre Standart', 'tyre'),
(5, 'Shoes', 'product'),
(6, 'Skirts', 'product'),
(7, 'Dresses', 'product'),
(8, 'Jackets & gilets', 'product'),
(9, 'Sweatshirts', 'product'),
(10, 'Sportpants', 'product');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `entity_set_has_entity_attribute`
--

DROP TABLE IF EXISTS `entity_set_has_entity_attribute`;
CREATE TABLE IF NOT EXISTS `entity_set_has_entity_attribute` (
  `entity_set_id` int(11) NOT NULL,
  `entity_attribute_id` int(11) NOT NULL,
  `sortid` int(11) DEFAULT NULL,
  `entity_set_view_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`entity_set_id`,`entity_attribute_id`),
  KEY `fk_product_set_has_product_attribute_product_attribute1` (`entity_attribute_id`),
  KEY `fk_product_set_has_product_attribute_product_set1` (`entity_set_id`),
  KEY `product_set_view_id` (`entity_set_view_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `entity_set_has_entity_attribute`
--

INSERT INTO `entity_set_has_entity_attribute` (`entity_set_id`, `entity_attribute_id`, `sortid`, `entity_set_view_id`) VALUES
(4, 11, 1, 5),
(4, 12, 2, 5),
(4, 13, 3, 5),
(4, 14, 4, 5),
(4, 15, 5, 5),
(4, 19, 0, 5),
(5, 21, 0, NULL),
(5, 22, 1, NULL),
(5, 24, 2, NULL),
(5, 25, 3, NULL),
(6, 31, 0, NULL),
(6, 33, 1, NULL),
(6, 34, 2, NULL),
(6, 35, 3, NULL),
(7, 26, 1, NULL),
(7, 28, 2, NULL),
(7, 29, 3, NULL),
(7, 30, 0, NULL),
(8, 36, 0, NULL),
(8, 37, 1, NULL),
(9, 38, 0, NULL),
(9, 39, 1, NULL),
(10, 40, 0, NULL),
(10, 41, 1, NULL),
(10, 42, 2, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `entity_set_view`
--

DROP TABLE IF EXISTS `entity_set_view`;
CREATE TABLE IF NOT EXISTS `entity_set_view` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `frontendvisible` tinyint(1) DEFAULT NULL,
  `entity_set_id` int(11) NOT NULL,
  `sortid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_set_view_product_set1` (`entity_set_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Daten für Tabelle `entity_set_view`
--

INSERT INTO `entity_set_view` (`id`, `frontendvisible`, `entity_set_id`, `sortid`) VALUES
(5, NULL, 4, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `entity_set_view_lang`
--

DROP TABLE IF EXISTS `entity_set_view_lang`;
CREATE TABLE IF NOT EXISTS `entity_set_view_lang` (
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lang` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `entity_set_view_id` int(11) NOT NULL,
  KEY `fk_product_set_view_lang_product_set_view1` (`entity_set_view_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `entity_set_view_lang`
--

INSERT INTO `entity_set_view_lang` (`name`, `lang`, `entity_set_view_id`) VALUES
('Dimensions', 'en', 5),
('Dimensions', 'ar', 5);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` float(15,3) DEFAULT NULL,
  `online` tinyint(1) NOT NULL,
  `categorie_id` int(11) DEFAULT NULL,
  `discount` double(10,2) NOT NULL,
  `remote_id` int(11) DEFAULT NULL,
  `insertat` datetime DEFAULT NULL,
  `updateat` datetime DEFAULT NULL,
  `entity_set_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `special_price` decimal(12,3) DEFAULT NULL,
  `special_price_date_from` date DEFAULT NULL,
  `special_price_date_to` date DEFAULT NULL,
  `manage_stock` tinyint(1) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_product_set1` (`entity_set_id`),
  KEY `categorie_id` (`categorie_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=36 ;

--
-- Daten für Tabelle `product`
--

INSERT INTO `product` (`id`, `number`, `price`, `online`, `categorie_id`, `discount`, `remote_id`, `insertat`, `updateat`, `entity_set_id`, `type_id`, `special_price`, `special_price_date_from`, `special_price_date_to`, `manage_stock`, `quantity`) VALUES
(5, '55224', 150.000, 0, 12, 0.00, NULL, NULL, NULL, 4, 1, NULL, NULL, NULL, NULL, NULL),
(6, 'test', 75.000, 0, 20, 0.00, NULL, NULL, NULL, 5, 1, NULL, NULL, NULL, 0, 15),
(7, 'abcde', 24.000, 0, 20, 0.00, NULL, NULL, NULL, 5, 1, NULL, NULL, NULL, 1, 15),
(8, '123', 14.000, 0, 20, 0.00, NULL, NULL, NULL, 5, 1, NULL, NULL, NULL, 1, 15),
(9, '1234', 27.000, 0, 20, 0.00, NULL, NULL, NULL, 5, 1, NULL, NULL, NULL, 0, 15),
(10, 'asdasda', 39.000, 0, 20, 0.00, NULL, NULL, NULL, 5, 1, NULL, NULL, NULL, 0, 14),
(11, '123456', 34.000, 0, 21, 0.00, NULL, NULL, NULL, 7, 1, NULL, NULL, NULL, 0, 15),
(12, '123141', 39.000, 0, 21, 0.00, NULL, NULL, NULL, 7, 1, NULL, NULL, NULL, 0, 15),
(13, '1232', 24.000, 0, 21, 0.00, NULL, NULL, NULL, 7, 1, NULL, NULL, NULL, 0, 15),
(14, '23144', 27.000, 0, 21, 0.00, NULL, NULL, NULL, 7, 1, NULL, NULL, NULL, 0, 15),
(15, '85481', 19.000, 0, 22, 0.00, NULL, NULL, NULL, 6, 1, NULL, NULL, NULL, 0, 15),
(16, '19283', 29.000, 0, 22, 0.00, NULL, NULL, NULL, 6, 1, NULL, NULL, NULL, 0, 15),
(17, 'asdda', 9.000, 0, 22, 0.00, NULL, NULL, NULL, 6, 1, NULL, NULL, NULL, 0, 15),
(18, '32521', 27.000, 0, 22, 0.00, NULL, NULL, NULL, 6, 1, NULL, NULL, NULL, 0, 154),
(19, 'dasdad', 27.000, 0, 22, 0.00, NULL, NULL, NULL, 6, 1, NULL, NULL, NULL, 0, 15),
(20, '1452342314', 14.000, 0, 24, 0.00, NULL, NULL, NULL, 8, 1, NULL, NULL, NULL, 0, 15),
(21, '81424311', 44.000, 0, 24, 0.00, NULL, NULL, NULL, 8, 1, NULL, NULL, NULL, 0, 15),
(22, '123', 69.000, 0, 24, 0.00, NULL, NULL, NULL, 8, 1, NULL, NULL, NULL, 0, 15),
(23, '312313', NULL, 0, 24, 0.00, NULL, NULL, NULL, 8, 1, NULL, NULL, NULL, 0, 154),
(24, '312313', 17.000, 0, 24, 0.00, NULL, NULL, NULL, 8, 1, NULL, NULL, NULL, 0, 154),
(25, '123414', 22.000, 0, 25, 0.00, NULL, NULL, NULL, 9, 1, NULL, NULL, NULL, 0, 15),
(26, 'asdw', 27.000, 0, 25, 0.00, NULL, NULL, NULL, 9, 1, NULL, NULL, NULL, 0, 15),
(27, '9740', 18.000, 0, 25, 0.00, NULL, NULL, NULL, 9, 1, NULL, NULL, NULL, 0, 15),
(28, '12341', 19.000, 0, 25, 0.00, NULL, NULL, NULL, 9, 1, NULL, NULL, NULL, 0, 15),
(29, '1235478', 19.000, 0, 25, 0.00, NULL, NULL, NULL, 9, 1, NULL, NULL, NULL, 0, 15),
(30, 'asdasd', 19.000, 0, 26, 0.00, NULL, NULL, NULL, 10, 1, NULL, NULL, NULL, 0, 15),
(31, '1232134121132', 27.000, 0, 26, 0.00, NULL, NULL, NULL, 10, 1, NULL, NULL, NULL, 0, 15),
(32, '1231123', 19.000, 0, 26, 0.00, NULL, NULL, NULL, 10, 1, 14.000, NULL, NULL, 0, 15),
(33, 'asdasd', 12.000, 0, 26, 0.00, NULL, NULL, NULL, 10, 1, NULL, NULL, NULL, 0, 15),
(34, 'asdsa', 12.000, 0, 26, 0.00, NULL, NULL, NULL, 10, 1, 9.000, NULL, NULL, 0, 15),
(35, 'asdad', 9.000, 0, 26, 0.00, NULL, NULL, NULL, 10, 1, NULL, NULL, NULL, 0, 15);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=27 ;

--
-- Daten für Tabelle `product_category`
--

INSERT INTO `product_category` (`id`, `sortid`, `state`, `image_id`, `parent_id`) VALUES
(12, NULL, 1, NULL, NULL),
(13, NULL, 1, NULL, NULL),
(14, NULL, 1, NULL, NULL),
(15, NULL, 1, NULL, NULL),
(16, NULL, 1, NULL, NULL),
(17, NULL, 1, NULL, NULL),
(18, NULL, 1, NULL, NULL),
(19, NULL, 1, NULL, NULL),
(20, NULL, 1, NULL, 19),
(21, NULL, 1, NULL, 19),
(22, NULL, 1, NULL, 19),
(23, NULL, 1, NULL, NULL),
(24, NULL, 1, NULL, 23),
(25, NULL, 1, NULL, 23),
(26, NULL, 1, NULL, 23);

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
('Sportpants', NULL, 'ar', 26);

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

--
-- Daten für Tabelle `product_comment`
--


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

--
-- Daten für Tabelle `product_configuration`
--


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

--
-- Daten für Tabelle `product_configuration_has_product`
--


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

--
-- Daten für Tabelle `product_configuration_has_product_attribute`
--


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

--
-- Daten für Tabelle `product_cross_selling`
--


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

--
-- Daten für Tabelle `product_hast_grouped_product`
--


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

--
-- Daten für Tabelle `product_has_document`
--


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
(6, 56, NULL),
(6, 57, NULL),
(7, 58, NULL),
(8, 59, NULL),
(9, 60, NULL),
(10, 61, NULL),
(11, 62, NULL),
(12, 63, NULL),
(13, 64, NULL),
(14, 65, NULL),
(15, 66, NULL),
(16, 67, NULL),
(17, 68, NULL),
(18, 69, NULL),
(19, 70, NULL),
(20, 71, NULL),
(21, 72, NULL),
(22, 73, NULL),
(24, 74, NULL),
(25, 75, NULL),
(26, 76, NULL),
(27, 77, NULL),
(28, 78, NULL),
(29, 79, NULL),
(30, 80, NULL),
(31, 81, NULL),
(32, 82, NULL),
(33, 83, NULL),
(34, 84, NULL),
(35, 85, NULL);

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

--
-- Daten für Tabelle `product_has_product_category`
--


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

--
-- Daten für Tabelle `product_has_related_product`
--


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
  KEY `fk_product_lang_product1` (`product_id`),
  KEY `lang` (`lang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `product_lang`
--

INSERT INTO `product_lang` (`title`, `description`, `lang`, `product_id`) VALUES
('5555', NULL, 'en', 5),
('5555', NULL, 'ar', 5),
('test', 'asdasd', 'en', 6),
('test', 'asdasd', 'ar', 6),
('Classic ankle boots', 'Classic ankle boots with a block heel. 6 cm heel. Imitation leather uppers, TPR sole.', 'en', 7),
('Classic ankle boots', NULL, 'ar', 7),
('Criss-cross strap sandals', 'Criss-cross strap sandals with a stacked sole. 2 cm sole. 11 cm heel. Imitation leather uppers, synthetic sole.', 'en', 8),
('Criss-cross strap sandals', 'Criss-cross strap sandals with a stacked sole. 2 cm sole. 11 cm heel. Imitation leather uppers, synthetic sole.', 'ar', 8),
('Colour block courts', 'Colour block courts with a chunky stacked sole. 13 cm heel. 3 cm sole. Imitation leather uppers, synthetic sole.', 'en', 9),
('Colour block courts', 'Colour block courts with a chunky stacked sole. 13 cm heel. 3 cm sole. Imitation leather uppers, synthetic sole.', 'ar', 9),
('Platform boots', 'Boots with a platform sole and an inside zip. 11 cm heel. Polyester uppers, synthetic sole.', 'en', 10),
('Platform boots', 'Boots with a platform sole and an inside zip. 11 cm heel. Polyester uppers, synthetic sole.', 'ar', 10),
('Gemstone cleavage dress', 'Ruched dress with a gemstone applique at the cleavage. Machine washable. 100% polyester.', 'en', 11),
('Gemstone cleavage dress', 'Ruched dress with a gemstone applique at the cleavage. Machine washable. 100% polyester.', 'ar', 11),
('Empire maxi dress', 'Empire maxi dress with cami straps. Length approx.136 cm. 96% viscose, 4% elastane, layer: 100% polyamide.', 'en', 12),
('Empire maxi dress', 'Empire maxi dress with cami straps. Length approx.136 cm. 96% viscose, 4% elastane, layer: 100% polyamide.', 'ar', 12),
('One shoulder dress', 'One shoulder dress with a rose applique at the shoulder. Length approx. 90 cm. 95% viscose, 5% elastane.', 'en', 13),
('One shoulder dress', 'One shoulder dress with a rose applique at the shoulder. Length approx. 90 cm. 95% viscose, 5% elastane.', 'ar', 13),
('Draped cami dress', 'Draped cami dress with adjustable straps. Length approx. 104 cm. 96% viscose, 4% elastane.', 'en', 14),
('Draped cami dress', 'Draped cami dress with adjustable straps. Length approx. 104 cm. 96% viscose, 4% elastane.', 'ar', 14),
('Jersey pencil skirt', 'Jersey pencil skirt with pleats. Length approx. 56 cm. 100% cotton.', 'en', 15),
('Jersey pencil skirt', 'Jersey pencil skirt with pleats. Length approx. 56 cm. 100% cotton.', 'ar', 15),
('Pleated fifties skirt', 'Smart pleated skirt with a high waist. Length approx. 60 cm. 97% cotton, 3% elastane.', 'en', 16),
('Pleated fifties skirt', 'Smart pleated skirt with a high waist. Length approx. 60 cm. 97% cotton, 3% elastane.', 'ar', 16),
('Skirt', 'Slim fit skirt with a back vent and three buttons. Length approx. 62 cm. 63% polyester, 33% viscose, 4% elastane.', 'en', 17),
('Skirt', 'Slim fit skirt with a back vent and three buttons. Length approx. 62 cm. 63% polyester, 33% viscose, 4% elastane.', 'ar', 17),
('Crushed cotton maxi skirt', 'Crushed cotton maxi skirt with a side zip. Length approx. 96 cm. 100% cotton.', 'en', 18),
('Crushed cotton maxi skirt', 'Crushed cotton maxi skirt with a side zip. Length approx. 96 cm. 100% cotton.', 'ar', 18),
('High waist pencil skirt', 'High waist pencil skirt with belt loops and a slit at the back. Zip fly. Lined. length approx. 64 cm. 70% polyester, 27% viscose, 3% elastane, lining: 100% polyester.', 'en', 19),
('High waist pencil skirt', 'High waist pencil skirt with belt loops and a slit at the back. Zip fly. Lined. length approx. 64 cm. 70% polyester, 27% viscose, 3% elastane, lining: 100% polyester.', 'ar', 19),
('Fleece windcheater', 'Fleece windcheater with a turtleneck collar and zip pockets. Regular fit. Length approx. 73 cm. 100% polyester, lining: 100% polyester.', 'en', 20),
('Fleece windcheater', 'Fleece windcheater with a turtleneck collar and zip pockets. Regular fit. Length approx. 73 cm. 100% polyester, lining: 100% polyester.', 'ar', 20),
('Weatherproof jacket', 'Weatherproof jacket with a waterproof (3000 mm), breathable shell. Taped seams, hidden two-way zip fastening, side pockets, a zip chest pocket and a removable hood. Two pockets inside. Drawstring hem. Slightly longer at the back. Length approx. 78 cm. 100% polyamide, lining: 100% polyester, sleeve lining: 100% polyester.', 'en', 21),
('Weatherproof jacket', 'Weatherproof jacket with a waterproof (3000 mm), breathable shell. Taped seams, hidden two-way zip fastening, side pockets, a zip chest pocket and a removable hood. Two pockets inside. Drawstring hem. Slightly longer at the back. Length approx. 78 cm. 100% polyamide, lining: 100% polyester, sleeve lining: 100% polyester.', 'ar', 21),
('Weaterproof jacket', 'Waterproof, breathable jacket with taped seams. Zip-off hood, reflective quick touch fastening cuffs and a hidden two-way zip. Drawstring hem. Length approx. 84 cm. 100% polyester, lining + wadding: 100% polyester.', 'en', 22),
('Weaterproof jacket', 'Waterproof, breathable jacket with taped seams. Zip-off hood, reflective quick touch fastening cuffs and a hidden two-way zip. Drawstring hem. Length approx. 84 cm. 100% polyester, lining + wadding: 100% polyester.', 'ar', 22),
('Turtleneck biker jacket', 'Short biker jacket with a bar at the turtleneck collar, a zip chest pocket, an inside pocket and side pockets. Length approx. 70 cm. 100% polyamide.', 'en', 23),
('Turtleneck biker jacket', 'Short biker jacket with a bar at the turtleneck collar, a zip chest pocket, an inside pocket and side pockets. Length approx. 70 cm. 100% polyamide.', 'ar', 23),
('Turtleneck biker jacket', 'Short biker jacket with a bar at the turtleneck collar, a zip chest pocket, an inside pocket and side pockets. Length approx. 70 cm. 100% polyamide.', 'en', 24),
('Turtleneck biker jacket', 'Short biker jacket with a bar at the turtleneck collar, a zip chest pocket, an inside pocket and side pockets. Length approx. 70 cm. 100% polyamide.', 'ar', 24),
('Boston print hoodie', 'Boston print hoodie with contrast hood lining and a pouch pocket. Regular fit. Length approx. 73 cm. 60% cotton, 40% polyester, hood lining: 100% cotton.', 'en', 25),
('Boston print hoodie', 'Boston print hoodie with contrast hood lining and a pouch pocket. Regular fit. Length approx. 73 cm. 60% cotton, 40% polyester, hood lining: 100% cotton.', 'ar', 25),
('JBD hoodie', 'Jersey hoodie with a JBD applique in chambray at the front. Regular fit. Length approx. 73 cm. 60% cotton, 40% polyester.', 'en', 26),
('JBD hoodie', 'Jersey hoodie with a JBD applique in chambray at the front. Regular fit. Length approx. 73 cm. 60% cotton, 40% polyester.', 'ar', 26),
('Contrast lined hoodie', 'Classic hoodie with contrast hood lining and seams. Small print at the chest. Soft brushed interior. Regular fit. Length approx. 73 cm. 60% cotton, 40% polyester, hood lining: 100% cotton.', 'en', 27),
('Contrast lined hoodie', 'Classic hoodie with contrast hood lining and seams. Small print at the chest. Soft brushed interior. Regular fit. Length approx. 73 cm. 60% cotton, 40% polyester, hood lining: 100% cotton.', 'ar', 27),
('Jersey print hoodie', 'Jersey print hoodie with contrast hood lining. Length approx. 73 cm. 100% cotton.', 'en', 28),
('Jersey print hoodie', 'Jersey print hoodie with contrast hood lining. Length approx. 73 cm. 100% cotton.', 'ar', 28),
('Advance print hoodie', 'Advance print hoodie with a pouch pocket. Length approx. 73 cm. 100% cotton.', 'en', 29),
('Advance print hoodie', 'Advance print hoodie with a pouch pocket. Length approx. 73 cm. 100% cotton.', 'ar', 29),
('Sweat pants', 'Printed sweat pants with zip hems and a stretch drawstring waist. 60% cotton, 40% polyester.', 'en', 30),
('Sweat pants', 'Printed sweat pants with zip hems and a stretch drawstring waist. 60% cotton, 40% polyester.', 'ar', 30),
('Slouch cotton trousers', 'Slouch cotton trousers with side and back pockets and a stretch waist. 100% cotton.', 'en', 31),
('Slouch cotton trousers', 'Slouch cotton trousers with side and back pockets and a stretch waist. 100% cotton.', 'ar', 31),
('Ribbed waist sweat pants', 'Ribbed waist sweat pants with a print on the left leg. 60% cotton, 40% polyester.', 'en', 32),
('Ribbed waist sweat pants', 'Ribbed waist sweat pants with a print on the left leg. 60% cotton, 40% polyester.', 'ar', 32),
('Sweat bermudas', 'Sweat bermudas with side pockets and a stretch drawstring waist. 60% cotton, 40% polyester.', 'en', 33),
('Sweat bermudas', 'Sweat bermudas with side pockets and a stretch drawstring waist. 60% cotton, 40% polyester.', 'ar', 33),
('Sweat bermudas', 'Sweat bermudas with a stretch waist, side pockets, open hem work and a print on the left leg. 60% cotton, 40% polyester.', 'en', 34),
('Sweat bermudas', 'Sweat bermudas with a stretch waist, side pockets, open hem work and a print on the left leg. 60% cotton, 40% polyester.', 'ar', 34),
('Tracksuit bottoms', 'Stretch waist bottoms with side pockets. Soft brushed interior. Inside leg approx. 82 cm for size 38/40. 60% cotton, 40% polyester.', 'en', 35),
('Tracksuit bottoms', 'Stretch waist bottoms with side pockets. Soft brushed interior. Inside leg approx. 82 cm for size 38/40. 60% cotton, 40% polyester.', 'ar', 35);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `product_pivot_ar`
--

DROP TABLE IF EXISTS `product_pivot_ar`;
CREATE TABLE IF NOT EXISTS `product_pivot_ar` (
  `id` int(11) NOT NULL DEFAULT '0',
  `number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` float(15,3) DEFAULT NULL,
  `online` tinyint(1) NOT NULL,
  `categorie_id` int(11) DEFAULT NULL,
  `discount` double(10,2) NOT NULL,
  `remote_id` int(11) DEFAULT NULL,
  `insertat` datetime DEFAULT NULL,
  `updateat` datetime DEFAULT NULL,
  `entity_set_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `special_price` decimal(12,3) DEFAULT NULL,
  `special_price_date_from` date DEFAULT NULL,
  `special_price_date_to` date DEFAULT NULL,
  `manage_stock` tinyint(1) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci,
  `lang` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tyre_width` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tyre_aspect` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tyre_rim` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tyre_load` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tyre_speed` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tyre_weather` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shoes_size` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shoes_color` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shoes_brand` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shoes_style` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dress_size` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dress_style` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dress_brand` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dress_color` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `skirts_size` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `skirts_color` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `skirts_brand` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `skirts_style` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `jackets_color` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `jackets_size` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sweatshirts_size` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sweatshirts_color` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sportpants_size` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sportpants_color` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sportpants_style` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `product_pivot_ar`
--

INSERT INTO `product_pivot_ar` (`id`, `number`, `price`, `online`, `categorie_id`, `discount`, `remote_id`, `insertat`, `updateat`, `entity_set_id`, `type_id`, `special_price`, `special_price_date_from`, `special_price_date_to`, `manage_stock`, `quantity`, `title`, `lang`, `tyre_width`, `tyre_aspect`, `tyre_rim`, `tyre_load`, `tyre_speed`, `tyre_weather`, `shoes_size`, `shoes_color`, `shoes_brand`, `shoes_style`, `dress_size`, `dress_style`, `dress_brand`, `dress_color`, `skirts_size`, `skirts_color`, `skirts_brand`, `skirts_style`, `jackets_color`, `jackets_size`, `sweatshirts_size`, `sweatshirts_color`, `sportpants_size`, `sportpants_color`, `sportpants_style`) VALUES
(5, '55224', 150.000, 0, 12, 0.00, NULL, NULL, NULL, 4, 1, NULL, NULL, NULL, NULL, NULL, '5555', 'ar', '16', '21', '40', '27', '35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'test', 75.000, 0, 20, 0.00, NULL, NULL, NULL, 5, 1, NULL, NULL, NULL, 0, 15, 'test', 'ar', '9', '24', '41', '27', '36', NULL, '53', 'e61212', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'abcde', 24.000, 0, 20, 0.00, NULL, NULL, NULL, 5, 1, NULL, NULL, NULL, 1, 15, 'Classic ankle boots', 'ar', '2', '23', '41', NULL, '36', NULL, '54', 'e61212', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, '123', 14.000, 0, 20, 0.00, NULL, NULL, NULL, 5, 1, NULL, NULL, NULL, 1, 15, 'Criss-cross strap sandals', 'ar', NULL, NULL, NULL, NULL, NULL, NULL, '52', '15b0db', '61', '69', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, '1234', 27.000, 0, 20, 0.00, NULL, NULL, NULL, 5, 1, NULL, NULL, NULL, 0, 15, 'Colour block courts', 'ar', NULL, NULL, NULL, NULL, NULL, NULL, '54', 'e61212', '63', '66', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'asdasda', 39.000, 0, 20, 0.00, NULL, NULL, NULL, 5, 1, NULL, NULL, NULL, 0, 14, 'Platform boots', 'ar', NULL, NULL, NULL, NULL, NULL, NULL, '54', '15b0db', '63', '65', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, '123456', 34.000, 0, 21, 0.00, NULL, NULL, NULL, 7, 1, NULL, NULL, NULL, 0, 15, 'Gemstone cleavage dress', 'ar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '72', '81', '86', '050000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, '123141', 39.000, 0, 21, 0.00, NULL, NULL, NULL, 7, 1, NULL, NULL, NULL, 0, 15, 'Empire maxi dress', 'ar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '70', '82', '86', '050000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, '1232', 24.000, 0, 21, 0.00, NULL, NULL, NULL, 7, 1, NULL, NULL, NULL, 0, 15, 'One shoulder dress', 'ar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '71', '83', '88', 'ff0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, '23144', 27.000, 0, 21, 0.00, NULL, NULL, NULL, 7, 1, NULL, NULL, NULL, 0, 15, 'Draped cami dress', 'ar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '70', '85', '86', 'ff7700', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, '85481', 19.000, 0, 22, 0.00, NULL, NULL, NULL, 6, 1, NULL, NULL, NULL, 0, 15, 'Jersey pencil skirt', 'ar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '102', '000000', '90', '96', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, '19283', 29.000, 0, 22, 0.00, NULL, NULL, NULL, 6, 1, NULL, NULL, NULL, 0, 15, 'Pleated fifties skirt', 'ar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100', 'ff9d00', '90', '96', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 'asdda', 9.000, 0, 22, 0.00, NULL, NULL, NULL, 6, 1, NULL, NULL, NULL, 0, 15, 'Skirt', 'ar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '97', '000000', NULL, '95', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, '32521', 27.000, 0, 22, 0.00, NULL, NULL, NULL, 6, 1, NULL, NULL, NULL, 0, 154, 'Crushed cotton maxi skirt', 'ar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100', 'ffffff', '90', '95', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 'dasdad', 27.000, 0, 22, 0.00, NULL, NULL, NULL, 6, 1, NULL, NULL, NULL, 0, 15, 'High waist pencil skirt', 'ar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '97', '000000', NULL, '95', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, '1452342314', 14.000, 0, 24, 0.00, NULL, NULL, NULL, 8, 1, NULL, NULL, NULL, 0, 15, 'Fleece windcheater', 'ar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0095ff', '110', NULL, NULL, NULL, NULL, NULL),
(21, '81424311', 44.000, 0, 24, 0.00, NULL, NULL, NULL, 8, 1, NULL, NULL, NULL, 0, 15, 'Weatherproof jacket', 'ar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '000000', '105', NULL, NULL, NULL, NULL, NULL),
(22, '123', 69.000, 0, 24, 0.00, NULL, NULL, NULL, 8, 1, NULL, NULL, NULL, 0, 15, 'Weaterproof jacket', 'ar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0095ff', '111', NULL, NULL, NULL, NULL, NULL),
(23, '312313', NULL, 0, 24, 0.00, NULL, NULL, NULL, 8, 1, NULL, NULL, NULL, 0, 154, 'Turtleneck biker jacket', 'ar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '000000', '105', NULL, NULL, NULL, NULL, NULL),
(24, '312313', 17.000, 0, 24, 0.00, NULL, NULL, NULL, 8, 1, NULL, NULL, NULL, 0, 154, 'Turtleneck biker jacket', 'ar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '000000', '105', NULL, NULL, NULL, NULL, NULL),
(25, '123414', 22.000, 0, 25, 0.00, NULL, NULL, NULL, 9, 1, NULL, NULL, NULL, 0, 15, 'Boston print hoodie', 'ar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '119', 'ff0000', NULL, NULL, NULL),
(26, 'asdw', 27.000, 0, 25, 0.00, NULL, NULL, NULL, 9, 1, NULL, NULL, NULL, 0, 15, 'JBD hoodie', 'ar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '121', 'ffffff', NULL, NULL, NULL),
(27, '9740', 18.000, 0, 25, 0.00, NULL, NULL, NULL, 9, 1, NULL, NULL, NULL, 0, 15, 'Contrast lined hoodie', 'ar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '115', '008cff', NULL, NULL, NULL),
(28, '12341', 19.000, 0, 25, 0.00, NULL, NULL, NULL, 9, 1, NULL, NULL, NULL, 0, 15, 'Jersey print hoodie', 'ar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '119', '008cff', NULL, NULL, NULL),
(29, '1235478', 19.000, 0, 25, 0.00, NULL, NULL, NULL, 9, 1, NULL, NULL, NULL, 0, 15, 'Advance print hoodie', 'ar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '119', '000000', NULL, NULL, NULL),
(30, 'asdasd', 19.000, 0, 26, 0.00, NULL, NULL, NULL, 10, 1, NULL, NULL, NULL, 0, 15, 'Sweat pants', 'ar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '129', '2200ff', '135'),
(31, '1232134121132', 27.000, 0, 26, 0.00, NULL, NULL, NULL, 10, 1, NULL, NULL, NULL, 0, 15, 'Slouch cotton trousers', 'ar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '130', 'ffffff', '135'),
(32, '1231123', 19.000, 0, 26, 0.00, NULL, NULL, NULL, 10, 1, 14.000, NULL, NULL, 0, 15, 'Ribbed waist sweat pants', 'ar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '125', '000000', '135'),
(33, 'asdasd', 12.000, 0, 26, 0.00, NULL, NULL, NULL, 10, 1, NULL, NULL, NULL, 0, 15, 'Sweat bermudas', 'ar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '131', '000000', '134'),
(34, 'asdsa', 12.000, 0, 26, 0.00, NULL, NULL, NULL, 10, 1, 9.000, NULL, NULL, 0, 15, 'Sweat bermudas', 'ar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '129', 'b8b8b8', '134'),
(35, 'asdad', 9.000, 0, 26, 0.00, NULL, NULL, NULL, 10, 1, NULL, NULL, NULL, 0, 15, 'Tracksuit bottoms', 'ar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '130', 'ff0000', '135');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `product_pivot_en`
--

DROP TABLE IF EXISTS `product_pivot_en`;
CREATE TABLE IF NOT EXISTS `product_pivot_en` (
  `id` int(11) NOT NULL DEFAULT '0',
  `number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` float(15,3) DEFAULT NULL,
  `online` tinyint(1) NOT NULL,
  `categorie_id` int(11) DEFAULT NULL,
  `discount` double(10,2) NOT NULL,
  `remote_id` int(11) DEFAULT NULL,
  `insertat` datetime DEFAULT NULL,
  `updateat` datetime DEFAULT NULL,
  `entity_set_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `special_price` decimal(12,3) DEFAULT NULL,
  `special_price_date_from` date DEFAULT NULL,
  `special_price_date_to` date DEFAULT NULL,
  `manage_stock` tinyint(1) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci,
  `lang` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tyre_width` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tyre_aspect` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tyre_rim` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tyre_load` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tyre_speed` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tyre_weather` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shoes_size` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shoes_color` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shoes_brand` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shoes_style` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dress_size` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dress_style` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dress_brand` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dress_color` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `skirts_size` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `skirts_color` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `skirts_brand` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `skirts_style` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `jackets_color` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `jackets_size` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sweatshirts_size` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sweatshirts_color` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sportpants_size` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sportpants_color` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sportpants_style` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `product_pivot_en`
--

INSERT INTO `product_pivot_en` (`id`, `number`, `price`, `online`, `categorie_id`, `discount`, `remote_id`, `insertat`, `updateat`, `entity_set_id`, `type_id`, `special_price`, `special_price_date_from`, `special_price_date_to`, `manage_stock`, `quantity`, `title`, `lang`, `tyre_width`, `tyre_aspect`, `tyre_rim`, `tyre_load`, `tyre_speed`, `tyre_weather`, `shoes_size`, `shoes_color`, `shoes_brand`, `shoes_style`, `dress_size`, `dress_style`, `dress_brand`, `dress_color`, `skirts_size`, `skirts_color`, `skirts_brand`, `skirts_style`, `jackets_color`, `jackets_size`, `sweatshirts_size`, `sweatshirts_color`, `sportpants_size`, `sportpants_color`, `sportpants_style`) VALUES
(5, '55224', 150.000, 0, 12, 0.00, NULL, NULL, NULL, 4, 1, NULL, NULL, NULL, NULL, NULL, '5555', 'en', '16', '21', '40', '27', '35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'test', 75.000, 0, 20, 0.00, NULL, NULL, NULL, 5, 1, NULL, NULL, NULL, 0, 15, 'test', 'en', '9', '24', '41', '27', '36', NULL, '53', 'e61212', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'abcde', 24.000, 0, 20, 0.00, NULL, NULL, NULL, 5, 1, NULL, NULL, NULL, 1, 15, 'Classic ankle boots', 'en', '2', '23', '41', NULL, '36', NULL, '54', 'e61212', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, '123', 14.000, 0, 20, 0.00, NULL, NULL, NULL, 5, 1, NULL, NULL, NULL, 1, 15, 'Criss-cross strap sandals', 'en', NULL, NULL, NULL, NULL, NULL, NULL, '52', '15b0db', '61', '69', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, '1234', 27.000, 0, 20, 0.00, NULL, NULL, NULL, 5, 1, NULL, NULL, NULL, 0, 15, 'Colour block courts', 'en', NULL, NULL, NULL, NULL, NULL, NULL, '54', 'e61212', '63', '66', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'asdasda', 39.000, 0, 20, 0.00, NULL, NULL, NULL, 5, 1, NULL, NULL, NULL, 0, 14, 'Platform boots', 'en', NULL, NULL, NULL, NULL, NULL, NULL, '54', '15b0db', '63', '65', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, '123456', 34.000, 0, 21, 0.00, NULL, NULL, NULL, 7, 1, NULL, NULL, NULL, 0, 15, 'Gemstone cleavage dress', 'en', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '72', '81', '86', '050000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, '123141', 39.000, 0, 21, 0.00, NULL, NULL, NULL, 7, 1, NULL, NULL, NULL, 0, 15, 'Empire maxi dress', 'en', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '70', '82', '86', '050000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, '1232', 24.000, 0, 21, 0.00, NULL, NULL, NULL, 7, 1, NULL, NULL, NULL, 0, 15, 'One shoulder dress', 'en', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '71', '83', '88', 'ff0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, '23144', 27.000, 0, 21, 0.00, NULL, NULL, NULL, 7, 1, NULL, NULL, NULL, 0, 15, 'Draped cami dress', 'en', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '70', '85', '86', 'ff7700', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, '85481', 19.000, 0, 22, 0.00, NULL, NULL, NULL, 6, 1, NULL, NULL, NULL, 0, 15, 'Jersey pencil skirt', 'en', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '102', '000000', '90', '96', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, '19283', 29.000, 0, 22, 0.00, NULL, NULL, NULL, 6, 1, NULL, NULL, NULL, 0, 15, 'Pleated fifties skirt', 'en', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100', 'ff9d00', '90', '96', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 'asdda', 9.000, 0, 22, 0.00, NULL, NULL, NULL, 6, 1, NULL, NULL, NULL, 0, 15, 'Skirt', 'en', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '97', '000000', NULL, '95', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, '32521', 27.000, 0, 22, 0.00, NULL, NULL, NULL, 6, 1, NULL, NULL, NULL, 0, 154, 'Crushed cotton maxi skirt', 'en', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100', 'ffffff', '90', '95', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 'dasdad', 27.000, 0, 22, 0.00, NULL, NULL, NULL, 6, 1, NULL, NULL, NULL, 0, 15, 'High waist pencil skirt', 'en', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '97', '000000', NULL, '95', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, '1452342314', 14.000, 0, 24, 0.00, NULL, NULL, NULL, 8, 1, NULL, NULL, NULL, 0, 15, 'Fleece windcheater', 'en', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0095ff', '110', NULL, NULL, NULL, NULL, NULL),
(21, '81424311', 44.000, 0, 24, 0.00, NULL, NULL, NULL, 8, 1, NULL, NULL, NULL, 0, 15, 'Weatherproof jacket', 'en', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '000000', '105', NULL, NULL, NULL, NULL, NULL),
(22, '123', 69.000, 0, 24, 0.00, NULL, NULL, NULL, 8, 1, NULL, NULL, NULL, 0, 15, 'Weaterproof jacket', 'en', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0095ff', '111', NULL, NULL, NULL, NULL, NULL),
(23, '312313', NULL, 0, 24, 0.00, NULL, NULL, NULL, 8, 1, NULL, NULL, NULL, 0, 154, 'Turtleneck biker jacket', 'en', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '000000', '105', NULL, NULL, NULL, NULL, NULL),
(24, '312313', 17.000, 0, 24, 0.00, NULL, NULL, NULL, 8, 1, NULL, NULL, NULL, 0, 154, 'Turtleneck biker jacket', 'en', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '000000', '105', NULL, NULL, NULL, NULL, NULL),
(25, '123414', 22.000, 0, 25, 0.00, NULL, NULL, NULL, 9, 1, NULL, NULL, NULL, 0, 15, 'Boston print hoodie', 'en', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '119', 'ff0000', NULL, NULL, NULL),
(26, 'asdw', 27.000, 0, 25, 0.00, NULL, NULL, NULL, 9, 1, NULL, NULL, NULL, 0, 15, 'JBD hoodie', 'en', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '121', 'ffffff', NULL, NULL, NULL),
(27, '9740', 18.000, 0, 25, 0.00, NULL, NULL, NULL, 9, 1, NULL, NULL, NULL, 0, 15, 'Contrast lined hoodie', 'en', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '115', '008cff', NULL, NULL, NULL),
(28, '12341', 19.000, 0, 25, 0.00, NULL, NULL, NULL, 9, 1, NULL, NULL, NULL, 0, 15, 'Jersey print hoodie', 'en', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '119', '008cff', NULL, NULL, NULL),
(29, '1235478', 19.000, 0, 25, 0.00, NULL, NULL, NULL, 9, 1, NULL, NULL, NULL, 0, 15, 'Advance print hoodie', 'en', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '119', '000000', NULL, NULL, NULL),
(30, 'asdasd', 19.000, 0, 26, 0.00, NULL, NULL, NULL, 10, 1, NULL, NULL, NULL, 0, 15, 'Sweat pants', 'en', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '129', '2200ff', '135'),
(31, '1232134121132', 27.000, 0, 26, 0.00, NULL, NULL, NULL, 10, 1, NULL, NULL, NULL, 0, 15, 'Slouch cotton trousers', 'en', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '130', 'ffffff', '135'),
(32, '1231123', 19.000, 0, 26, 0.00, NULL, NULL, NULL, 10, 1, 14.000, NULL, NULL, 0, 15, 'Ribbed waist sweat pants', 'en', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '125', '000000', '135'),
(33, 'asdasd', 12.000, 0, 26, 0.00, NULL, NULL, NULL, 10, 1, NULL, NULL, NULL, 0, 15, 'Sweat bermudas', 'en', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '131', '000000', '134'),
(34, 'asdsa', 12.000, 0, 26, 0.00, NULL, NULL, NULL, 10, 1, 9.000, NULL, NULL, 0, 15, 'Sweat bermudas', 'en', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '129', 'b8b8b8', '134'),
(35, 'asdad', 9.000, 0, 26, 0.00, NULL, NULL, NULL, 10, 1, NULL, NULL, NULL, 0, 15, 'Tracksuit bottoms', 'en', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '130', 'ff0000', '135');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `product_table_price`
--

DROP TABLE IF EXISTS `product_table_price`;
CREATE TABLE IF NOT EXISTS `product_table_price` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `table_quantity` int(11) NOT NULL,
  `table_price` decimal(12,3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tyre_id` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Daten für Tabelle `product_table_price`
--

INSERT INTO `product_table_price` (`id`, `product_id`, `table_quantity`, `table_price`) VALUES
(1, 6, 5, 50.000),
(2, 6, 10, 45.000),
(3, 6, 15, 40.000),
(4, 25, 3, 20.000),
(5, 25, 5, 18.000),
(6, 25, 7, 16.000);

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

--
-- Daten für Tabelle `product_up_selling`
--


--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `entity_attribute_datasource`
--
ALTER TABLE `entity_attribute_datasource`
  ADD CONSTRAINT `entity_attribute_datasource_ibfk_1` FOREIGN KEY (`entity_attribute_id`) REFERENCES `entity_attribute` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `entity_attribute_datasource_lang`
--
ALTER TABLE `entity_attribute_datasource_lang`
  ADD CONSTRAINT `entity_attribute_datasource_lang_ibfk_1` FOREIGN KEY (`entity_attribute_datasource_id`) REFERENCES `entity_attribute_datasource` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `entity_attribute_lang`
--
ALTER TABLE `entity_attribute_lang`
  ADD CONSTRAINT `fk_entity_attribute_lang_entity_attribute1` FOREIGN KEY (`entity_attribute_id`) REFERENCES `entity_attribute` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `entity_attribute_value`
--
ALTER TABLE `entity_attribute_value`
  ADD CONSTRAINT `entity_attribute_value_ibfk_1` FOREIGN KEY (`entity_attribute_id`) REFERENCES `entity_attribute` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `entity_attribute_value_lang`
--
ALTER TABLE `entity_attribute_value_lang`
  ADD CONSTRAINT `entity_attribute_value_lang_ibfk_1` FOREIGN KEY (`entity_attribute_value_id`) REFERENCES `entity_attribute_value` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `entity_set_has_entity_attribute`
--
ALTER TABLE `entity_set_has_entity_attribute`
  ADD CONSTRAINT `entity_set_has_entity_attribute_ibfk_1` FOREIGN KEY (`entity_set_id`) REFERENCES `entity_set` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `entity_set_has_entity_attribute_ibfk_2` FOREIGN KEY (`entity_attribute_id`) REFERENCES `entity_attribute` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `entity_set_has_entity_attribute_ibfk_3` FOREIGN KEY (`entity_set_view_id`) REFERENCES `entity_set_view` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `entity_set_view`
--
ALTER TABLE `entity_set_view`
  ADD CONSTRAINT `entity_set_view_ibfk_1` FOREIGN KEY (`entity_set_id`) REFERENCES `entity_set` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `entity_set_view_lang`
--
ALTER TABLE `entity_set_view_lang`
  ADD CONSTRAINT `entity_set_view_lang_ibfk_1` FOREIGN KEY (`entity_set_view_id`) REFERENCES `entity_set_view` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`entity_set_id`) REFERENCES `entity_set` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `fk_product_configuration_product_set1` FOREIGN KEY (`product_set_id`) REFERENCES `entity_set` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `fk_product_configuration_has_product_attribute_product_attrib1` FOREIGN KEY (`product_attribute_id`) REFERENCES `entity_attribute` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
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
-- Constraints der Tabelle `product_table_price`
--
ALTER TABLE `product_table_price`
  ADD CONSTRAINT `product_table_price_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `product_up_selling`
--
ALTER TABLE `product_up_selling`
  ADD CONSTRAINT `fk_product_has_product_product5` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_has_product_product6` FOREIGN KEY (`up_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;







-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 15. Dezember 2012 um 10:40
-- Server Version: 5.1.44
-- PHP-Version: 5.3.1

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT=0;
START TRANSACTION;

--
-- Datenbank: `motorssouq`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `folder` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `extention` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hash` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `public` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `remote_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `insertat` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=86 ;

--
-- Daten für Tabelle `image`
--

INSERT INTO `image` (`id`, `name`, `title`, `folder`, `type`, `extention`, `hash`, `public`, `description`, `remote_url`, `insertat`) VALUES
(8, 'asdasdasdasd', NULL, '/media/banner', 'Image', 'jpg', NULL, '1', 'asdasdasdasd', NULL, '2012-03-25 13:04:35'),
(10, 'asdasdasd1111', NULL, '/media/banner', 'Image', 'jpg', NULL, '1', 'asdasdasd', NULL, '2012-03-25 13:06:36'),
(11, 'MY image Name', 'Image Title', 'images', 'image type', '.jpg', 'd08a855c9bd1d2d3561a457f3a61cf9e', 'public', 'descriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescription', 'www.google.de/image.jpg', '2012-04-11 12:06:30'),
(12, 'MY image Name', 'Image Title', 'images', 'image type', '.jpg', 'd08a855c9bd1d2d3561a457f3a61cf9e', 'public', 'descriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescription', 'www.google.de/image.jpg', '2012-04-11 12:12:27'),
(13, 'MY image Name', 'Image Title', 'images', 'image type', '.jpg', 'd08a855c9bd1d2d3561a457f3a61cf9e', 'public', 'descriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescription', 'www.google.de/image.jpg', '2012-04-11 12:12:43'),
(14, 'MY image Name', 'Image Title', 'images', 'image type', '.jpg', 'd08a855c9bd1d2d3561a457f3a61cf9e', 'public', 'descriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescription', 'www.google.de/image.jpg', '2012-04-11 12:13:54'),
(15, 'MY image Name', 'Image Title', 'images', 'image type', '.jpg', 'd08a855c9bd1d2d3561a457f3a61cf9e', 'public', 'descriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescription', 'www.google.de/image.jpg', '2012-04-11 12:15:21'),
(16, 'asdasdasd', NULL, '/media/product/image', 'Image', 'jpg', NULL, '1', 'asdasdasd', NULL, '2012-04-19 22:15:36'),
(17, 'dfgd', NULL, '/media/product/image', 'Image', 'jpg', NULL, '1', 'fgdfgdfg', NULL, '2012-04-19 22:15:53'),
(18, 'start', NULL, '/media/product/image', 'Image', 'jpg', NULL, '1', NULL, NULL, '2012-04-20 09:45:19'),
(19, 'first image', NULL, '/media/product/image', 'Image', 'jpg', NULL, '1', NULL, NULL, '2012-04-20 09:51:50'),
(20, 'golf 5', NULL, '/media/product/image', 'Image', 'png', NULL, '1', NULL, NULL, '2012-04-20 12:01:14'),
(21, 'asdasdasd', NULL, '/media/product/image', 'Image', 'jpg', NULL, '1', NULL, NULL, '2012-04-21 10:48:12'),
(22, 'asdasdas', NULL, '/media/logos', 'Image', 'jpg', NULL, NULL, NULL, NULL, '2012-04-25 16:47:21'),
(23, 'aaaaaa', NULL, '/media/logos', 'Image', 'jpg', NULL, NULL, NULL, NULL, '2012-04-25 16:55:10'),
(24, 'aaaaaa', NULL, '/media/logos', 'Image', 'jpg', NULL, NULL, NULL, NULL, '2012-04-25 16:56:06'),
(25, 'aaaaaa', 'aaaaaa', '/media/logos', 'Image', 'jpg', NULL, NULL, NULL, NULL, '2012-04-25 16:57:09'),
(26, 'aaaaaa', 'aaaaaa', '/media/logos', 'Image', 'jpg', NULL, NULL, NULL, NULL, '2012-04-25 16:57:15'),
(27, 'aaaaaa', 'aaaaaa', '/media/logos', 'Image', 'jpg', NULL, NULL, NULL, NULL, '2012-04-25 16:57:39'),
(29, 'aaaaaa', 'aaaaaa', '/media/logos', 'Image', 'jpg', NULL, NULL, NULL, NULL, '2012-04-25 16:59:04'),
(30, 'asdasd', 'asdasd', '/media/logos', 'Image', 'jpg', NULL, NULL, NULL, NULL, '2012-04-25 17:56:20'),
(31, 'asdasd', 'asdasd', '/media/logos', 'Image', 'jpg', NULL, NULL, NULL, NULL, '2012-04-25 17:56:32'),
(32, 'asdasd', 'asdasd', '/media/logos', 'Image', 'jpg', NULL, NULL, NULL, NULL, '2012-04-25 17:57:09'),
(38, 'asdasdas', 'asdasdas', '/media/logos', 'Image', 'jpg', NULL, NULL, NULL, NULL, '2012-04-25 18:13:46'),
(40, 'asdasd', 'asdasd', '/media/logos', 'Image', 'jpg', NULL, NULL, NULL, NULL, '2012-04-25 18:14:18'),
(44, 'DHL Deutschland', 'DHL Deutschland', '/media/logos', 'Image', 'jpg', NULL, NULL, NULL, NULL, '2012-04-25 18:17:16'),
(45, 'MY image Name', 'Image Title', 'images', 'image type', '.jpg', 'd08a855c9bd1d2d3561a457f3a61cf9e', 'public', 'descriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescription', 'www.google.de/image.jpg', '2012-07-04 20:57:34'),
(46, 'MY image Name', 'Image Title', 'images', 'image type', '.jpg', 'd08a855c9bd1d2d3561a457f3a61cf9e', 'public', 'descriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescription', 'www.google.de/image.jpg', '2012-07-04 20:57:48'),
(47, 'MY image Name', 'Image Title', 'images', 'image type', '.jpg', 'd08a855c9bd1d2d3561a457f3a61cf9e', 'public', 'descriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescription', 'www.google.de/image.jpg', '2012-07-04 20:59:43'),
(48, 'MY image Name', 'Image Title', 'images', 'image type', '.jpg', 'd08a855c9bd1d2d3561a457f3a61cf9e', 'public', 'descriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescription', 'www.google.de/image.jpg', '2012-07-04 21:15:27'),
(49, 'MY image Name', 'Image Title', 'images', 'image type', '.jpg', 'd08a855c9bd1d2d3561a457f3a61cf9e', 'public', 'descriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescriptiondescription', 'www.google.de/image.jpg', '2012-07-05 09:06:43'),
(50, 'test', NULL, '/media/product/image', NULL, 'jpg', NULL, '1', NULL, NULL, '2012-11-28 16:17:45'),
(51, 'test', NULL, '/media/product/image', NULL, 'jpg', NULL, '1', NULL, NULL, '2012-11-28 16:18:35'),
(52, 'test', NULL, '/media/product/image', NULL, 'jpg', NULL, '1', NULL, NULL, '2012-11-28 13:22:42'),
(53, 'test2', NULL, '/media/product/image', NULL, 'gif', NULL, '0', NULL, NULL, '2012-11-28 13:27:42'),
(54, 'vill front', NULL, '/media/product/image', NULL, 'jpg', NULL, '1', NULL, NULL, '2012-11-30 10:00:49'),
(55, 'villa front image', NULL, '/media/product/image', NULL, 'jpg', NULL, '1', NULL, NULL, '2012-11-30 10:46:24'),
(56, 'shoes', NULL, '/media/product/image', NULL, 'png', NULL, '1', NULL, NULL, '2012-12-14 08:20:01'),
(57, 'asdadasd', NULL, '/media/product/image', NULL, 'jpg', NULL, '1', NULL, NULL, '2012-12-14 08:20:15'),
(58, 'asdda', NULL, '/media/product/image', NULL, 'jpg', NULL, '1', NULL, NULL, '2012-12-14 08:32:53'),
(59, 'blue shoes', NULL, '/media/product/image', NULL, 'jpg', NULL, '1', NULL, NULL, '2012-12-14 08:36:51'),
(60, '545', NULL, '/media/product/image', NULL, 'jpg', NULL, '1', NULL, NULL, '2012-12-14 08:39:05'),
(61, 'boots', NULL, '/media/product/image', NULL, 'jpg', NULL, '1', NULL, NULL, '2012-12-14 08:42:19'),
(62, 'dress', NULL, '/media/product/image', NULL, 'jpg', NULL, '1', NULL, NULL, '2012-12-14 08:54:34'),
(63, 'sdads', NULL, '/media/product/image', NULL, 'jpg', NULL, '1', NULL, NULL, '2012-12-14 08:56:35'),
(64, 'asdda', NULL, '/media/product/image', NULL, 'jpg', NULL, '1', NULL, NULL, '2012-12-14 08:59:09'),
(65, 'asdasa', NULL, '/media/product/image', NULL, 'jpg', NULL, '1', NULL, NULL, '2012-12-14 09:05:21'),
(66, 'sa51d', NULL, '/media/product/image', NULL, 'jpg', NULL, '1', NULL, NULL, '2012-12-14 09:13:43'),
(67, 'asdasd', NULL, '/media/product/image', NULL, 'jpg', NULL, '1', NULL, NULL, '2012-12-14 09:15:10'),
(68, 'asdada', NULL, '/media/product/image', NULL, 'jpg', NULL, '1', NULL, NULL, '2012-12-14 09:17:12'),
(69, 'asdds', NULL, '/media/product/image', NULL, 'jpg', NULL, '1', NULL, NULL, '2012-12-14 09:18:25'),
(70, 'asdada', NULL, '/media/product/image', NULL, 'jpg', NULL, '1', NULL, NULL, '2012-12-14 09:19:29'),
(71, '14014', NULL, '/media/product/image', NULL, 'jpg', NULL, '1', NULL, NULL, '2012-12-14 09:26:36'),
(72, '1231easda', NULL, '/media/product/image', NULL, 'jpg', NULL, '1', NULL, NULL, '2012-12-14 09:29:17'),
(73, 'asdcyx', NULL, '/media/product/image', NULL, 'jpg', NULL, '1', NULL, NULL, '2012-12-14 09:31:42'),
(74, 'asdad', NULL, '/media/product/image', NULL, 'jpg', NULL, '1', NULL, NULL, '2012-12-14 09:32:54'),
(75, '123sd', NULL, '/media/product/image', NULL, 'jpg', NULL, '1', NULL, NULL, '2012-12-14 09:49:24'),
(76, 'sadxy', NULL, '/media/product/image', NULL, 'jpg', NULL, '1', NULL, NULL, '2012-12-14 09:50:29'),
(77, 'a21exy', NULL, '/media/product/image', NULL, 'jpg', NULL, '1', NULL, NULL, '2012-12-14 09:51:58'),
(78, 'asdsda', NULL, '/media/product/image', NULL, 'jpg', NULL, '1', NULL, NULL, '2012-12-14 09:52:55'),
(79, '12132', NULL, '/media/product/image', NULL, 'jpg', NULL, '1', NULL, NULL, '2012-12-14 09:53:57'),
(80, 'asdacyx', NULL, '/media/product/image', NULL, 'jpg', NULL, '1', NULL, NULL, '2012-12-14 10:06:12'),
(81, '123131', NULL, '/media/product/image', NULL, 'jpg', NULL, '1', NULL, NULL, '2012-12-14 10:09:17'),
(82, '123axy', NULL, '/media/product/image', NULL, 'jpg', NULL, '1', NULL, NULL, '2012-12-14 10:10:12'),
(83, '51818', NULL, '/media/product/image', NULL, 'jpg', NULL, '1', NULL, NULL, '2012-12-14 10:11:03'),
(84, '123sadxcy', NULL, '/media/product/image', NULL, 'jpg', NULL, '1', NULL, NULL, '2012-12-14 10:12:05'),
(85, '12312asdxyc', NULL, '/media/product/image', NULL, 'jpg', NULL, '1', NULL, NULL, '2012-12-14 10:13:00');
SET FOREIGN_KEY_CHECKS=1;
COMMIT;
