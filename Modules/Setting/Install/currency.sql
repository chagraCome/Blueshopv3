-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 10. Dezember 2012 um 14:08
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
-- Tabellenstruktur für Tabelle `currency`
--

DROP TABLE IF EXISTS `currency`;
CREATE TABLE IF NOT EXISTS `currency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `currency_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `currency_kuerzel` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `standart` int(1) unsigned NOT NULL,
  `factor` decimal(12,6) NOT NULL DEFAULT '1.000000',
  `decimal` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thousand` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `defined_kuerzel` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=31 ;

--
-- Daten für Tabelle `currency`
--

INSERT INTO `currency` (`id`, `currency_name`, `currency_kuerzel`, `state`, `standart`, `factor`, `decimal`, `thousand`, `defined_kuerzel`) VALUES
(1, 'يـورو أوروبي', 'EUR', 1, 0, 1.000000, ',', '.', NULL),
(2, 'دولار امريكي', 'USD', 1, 0, 1.314000, ',', '.', NULL),
(3, 'جنيه مصري', 'EGP', 1, 0, 7.927900, ',', '.', NULL),
(4, 'دينار تونسي', 'TND', 1, 0, 1.986900, ',', '.', NULL),
(6, 'دينار جزائري', 'DZD', 1, 0, 97.691600, ',', '.', NULL),
(7, 'دولار أوسترالي', 'AUD', 1, 0, 1.252700, ',', '.', NULL),
(8, 'دولار بهامي', 'BSD', 1, 0, 1.316600, ',', '.', NULL),
(9, 'دينار بحريني', 'BHD', 0, 0, 0.495400, ',', '.', NULL),
(10, 'جنيه أسترليني', 'GBP', 0, 0, 0.841600, ',', '.', NULL),
(11, 'يوان صيني', 'CNY', 0, 0, 8.312100, ',', '.', NULL),
(13, 'دولار هونج كونج', 'HKD', 1, 0, 10.194800, ',', '.', NULL),
(14, 'روبيه هنديـه', 'INR', 0, 0, 65.673700, ',', '.', NULL),
(15, 'دينار عراقي', 'IQD', 0, 0, 0.000000, ',', '.', NULL),
(16, 'دينار عراقي', 'JPY', 0, 0, 108.037000, ',', '.', NULL),
(17, 'دينار اردني', 'JOD', 1, 0, 0.932000, ',', '.', NULL),
(18, 'دولار كندي', 'CAD', 0, 0, 1.305300, ',', '.', NULL),
(19, 'ريال قطري', 'QAR', 1, 0, 4.784500, ',', '.', NULL),
(20, 'دينار كويتي', 'KWD', 1, 1, 0.366200, ',', '.', NULL),
(21, 'ليره لبنانيه', 'LBP', 0, 0, 1975.600000, ',', '.', NULL),
(22, 'دينار ليبي', 'LYD', 1, 0, 1.719600, ',', '.', NULL),
(23, 'درهم مغربي', 'MAD', 1, 0, 11.138600, ',', '.', NULL),
(24, 'ريال عماني', 'OMR', 0, 0, 0.505900, ',', '.', NULL),
(25, 'روبل روسي', 'RUB', 0, 0, 38.947500, ',', '.', NULL),
(26, 'ريال سعودي', 'SAR', 0, 0, 4.928000, ',', '.', NULL),
(27, 'فرنك سويسري', 'CHF', 1, 0, 1.206000, ',', '.', NULL),
(28, 'ليرة تركيه', 'TLY', 0, 0, 0.000000, ',', '.', NULL),
(29, 'ريال يمني', 'YER', 1, 0, 283.167000, '.', ',', NULL),
(30, 'درهم اماراتي', 'AED', 1, 0, 4.826300, ',', '.', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `currency_lang`
--

DROP TABLE IF EXISTS `currency_lang`;
CREATE TABLE IF NOT EXISTS `currency_lang` (
  `currency_id` int(11) NOT NULL,
  `currency_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lang` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  KEY `fk_currency_lang_currency1` (`currency_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `currency_lang`
--

INSERT INTO `currency_lang` (`currency_id`, `currency_name`, `lang`) VALUES
(1, 'يـورو أوروبي', 'AR'),
(2, 'دولار امريكي', 'AR'),
(3, 'جنيه مصري', 'AR'),
(4, 'دينار تونسي', 'AR'),
(6, 'دينار جزائري', 'AR'),
(7, 'دولار أوسترالي', 'AR'),
(8, 'دولار بهامي', 'AR'),
(9, 'دينار بحريني', 'AR'),
(10, 'جنيه أسترليني', 'AR'),
(11, 'يوان صيني', 'AR'),
(13, 'دولار هونج كونج', 'AR'),
(14, 'روبيه هنديـه', 'AR'),
(15, 'دينار عراقي', 'AR'),
(16, 'دينار عراقي', 'AR'),
(17, 'دينار اردني', 'AR'),
(18, 'دولار كندي', 'AR'),
(19, 'ريال قطري', 'AR'),
(20, 'دينار كويتي', 'AR'),
(21, 'ليره لبنانيه', 'AR'),
(22, 'دينار ليبي', 'AR'),
(23, 'درهم مغربي', 'AR'),
(24, 'ريال عماني', 'AR'),
(25, 'روبل روسي', 'AR'),
(26, 'ريال سعودي', 'AR'),
(27, 'فرنك سويسري', 'AR'),
(28, 'ليرة تركيه', 'AR'),
(29, 'ريال يمني', 'AR'),
(30, 'درهم اماراتي', 'AR'),
(1, 'Euro', 'EN'),
(2, 'US Dollar', 'EN'),
(3, 'جنيه مصري', 'EN'),
(4, 'دينار تونسي', 'EN'),
(6, 'دينار جزائري', 'EN'),
(7, 'دولار أوسترالي', 'EN'),
(8, 'دولار بهامي', 'EN'),
(9, 'دينار بحريني', 'EN'),
(10, 'جنيه أسترليني', 'EN'),
(11, 'يوان صيني', 'EN'),
(13, 'دولار هونج كونج', 'EN'),
(14, 'روبيه هنديـه', 'EN'),
(15, 'دينار عراقي', 'EN'),
(16, 'دينار عراقي', 'EN'),
(17, 'دينار اردني', 'EN'),
(18, 'دولار كندي', 'EN'),
(19, 'ريال قطري', 'EN'),
(20, 'دينار كويتي', 'EN'),
(21, 'ليره لبنانيه', 'EN'),
(22, 'دينار ليبي', 'EN'),
(23, 'درهم مغربي', 'EN'),
(24, 'ريال عماني', 'EN'),
(25, 'روبل روسي', 'EN'),
(26, 'ريال سعودي', 'EN'),
(27, 'فرنك سويسري', 'EN'),
(28, 'ليرة تركيه', 'EN'),
(29, 'ريال يمني', 'EN'),
(30, 'درهم اماراتي', 'EN');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `currency_set`
--

DROP TABLE IF EXISTS `currency_set`;
CREATE TABLE IF NOT EXISTS `currency_set` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `base` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `rates` text COLLATE utf8_unicode_ci NOT NULL,
  `insert_date_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `currency_set`
--

INSERT INTO `currency_set` (`id`, `base`, `rates`, `insert_date_time`) VALUES
(1, 'BHD', '{"base":"BHD","rates":{"BHD":"1.00","SAR":"9.9551","EUR":"2.0532","TND":"4.1952","QAR":"9.6658","LBP":"3996.1245","LYD":"3.3567","SDG":"11.7123","SYP":"188.4589","KWD":"0.7481","IQD":"3090.991","DZD":"210.1847","JOD":"1.8859","MAD":"22.8118","OMR":"1.0215","AED":"9.7502","YER":"569.6368","MRO":"783.697"}}', '2012-12-07 08:59:05'),
(2, 'BHD', '{"base":"BHD","rates":{"BHD":"1.00","SAR":"9.9557","EUR":"2.0536","TND":"4.1952","QAR":"9.6642","LBP":"3996.1245","LYD":"3.3567","SDG":"11.7123","SYP":"188.4589","KWD":"0.7483","IQD":"3090.991","DZD":"207.756","JOD":"1.8859","MAD":"22.799","OMR":"1.0215","AED":"9.75","YER":"569.6368","MRO":"783.697"}}', '2012-12-07 09:23:19');

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `currency_lang`
--
ALTER TABLE `currency_lang`
  ADD CONSTRAINT `fk_currency_lang_currency1` FOREIGN KEY (`currency_id`) REFERENCES `currency` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;
