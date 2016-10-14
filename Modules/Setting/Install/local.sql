-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 10. Dezember 2012 um 14:14
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
-- Tabellenstruktur für Tabelle `locale`
--

DROP TABLE IF EXISTS `locale`;
CREATE TABLE IF NOT EXISTS `locale` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `local` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `country_iso3` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `double_comma` int(11) NOT NULL,
  `thousend_sep` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `decimal_sep` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `currency` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `currency_iso3` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `minor_unit` int(11) NOT NULL,
  `tel_code` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `time_zone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rate` decimal(11,6) NOT NULL DEFAULT '1.000000',
  `base` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Daten für Tabelle `locale`
--

INSERT INTO `locale` (`id`, `local`, `country_iso3`, `double_comma`, `thousend_sep`, `decimal_sep`, `currency`, `currency_iso3`, `minor_unit`, `tel_code`, `time_zone`, `rate`, `base`) VALUES
(1, 'ar_BH', 'BHR', 3, ',', '.', 'Bahraini Dinar', 'BHD', 1000, '+973', 'Asia/Bahrain', 1.000000, 1),
(2, 'ar_SA', 'SAU', 3, '.', ',', 'Saudi Rial', 'SAR', 100, '+966', 'Asia/Riyadh', 9.955700, 0),
(3, 'de_DE', 'DEU', 2, '.', ',', 'Euro European', 'EUR', 100, '+49', 'Europe/Berlin', 2.053600, 0),
(4, 'ar_TN', 'TUN', 3, '.', ',', 'Tunisian Dinar', 'TND', 1000, '+216', 'Africa/Tunis', 4.195200, 0),
(5, 'ar_QA', 'SAU', 2, '.', ',', 'Qatari Riyal', 'QAR', 100, '+974', 'Asia/Qatar', 9.664200, 0),
(6, 'ar_LB', 'LBN', 2, '.', ',', 'Lebanese Pound', 'LBP', 100, '+961', 'Asia/Beirut', 3996.124500, 0),
(7, 'ar_LY', 'LBY', 3, '.', ',', 'Libyan Dinar', 'LYD', 100, '+218', 'Africa/Tripoli', 3.356700, 0),
(8, 'ar_SD', 'SDN', 3, '.', ',', 'Sudanese Pound', 'SDG', 100, '+249', 'Africa/Khartoum', 11.712300, 0),
(9, 'ar_SY', 'SYR', 2, '.', ',', 'Syrian Pound', 'SYP', 100, '+963', 'Asia/Damascus', 188.458900, 0),
(10, 'ar_KW', 'KWT', 3, '.', ',', 'Kuwaiti Dinar', 'KWD', 1000, '+965', 'Asia/Kuwait', 0.748300, 0),
(11, 'ar_IQ', 'IRQ', 3, '.', ',', 'Iraqi Dinar', 'IQD', 1000, '+964', 'Asia/Baghdad', 3090.991000, 0),
(12, 'ar_DZ', 'DZA', 2, '.', ',', 'Algerian Dinar', 'DZD', 100, '+213', 'Africa/Algiers', 207.756000, 0),
(13, 'ar_JO', 'JOR', 2, '.', ',', 'Jordanian Dinar', 'JOD', 100, '+962', 'Asia/Ammans', 1.885900, 0),
(14, 'ar_MA', 'MAR', 2, '.', ',', 'Moroccan Dirham', 'MAD', 100, '+212', 'Africa/Casablanca', 22.799000, 0),
(15, 'ar_OM', 'OMN', 3, '.', ',', 'Omani Rial', 'OMR', 1000, '+968', 'Asia/Muscat', 1.021500, 0),
(16, 'ar_AE', 'ARE', 2, '.', ',', 'United Arab Emirates Dirham', 'AED', 100, '+971', 'Asia/Dubai', 9.750000, 0),
(17, 'ar_YE', 'YEM', 2, '.', ',', 'Yemeni Rial', 'YER', 100, '+967', 'Asia/Aden', 569.636800, 0),
(18, 'ar_MR', 'MRT', 2, '.', ',', 'Mauritanian Ouguiya', 'MRO', 100, '+222', 'Africa/Nouakchott', 783.697000, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `locale_lang`
--

DROP TABLE IF EXISTS `locale_lang`;
CREATE TABLE IF NOT EXISTS `locale_lang` (
  `locale_id` int(11) NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `language` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `currency_symbol` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `currency_cent` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lang` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  KEY `locale_id` (`locale_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `locale_lang`
--

INSERT INTO `locale_lang` (`locale_id`, `country`, `language`, `currency_symbol`, `currency_cent`, `lang`) VALUES
(1, 'Bahrain', 'Arabic', 'BD', 'Fils', 'en'),
(1, 'Bahrain', 'Arabic', 'BHD', 'Fils', 'ar'),
(2, 'Saudi Arabia', 'Arabic', 'SAR', 'Halala', 'en'),
(2, 'Saudi Arabia', 'Arabic', 'SAR', 'Halala', 'ar'),
(3, 'Germany', 'German', '€', 'Cent', 'en'),
(3, 'Germany', 'German', '€', 'Cent', 'ar'),
(4, 'Tunisia', 'Arabic', 'TND', 'Millimes', 'en'),
(4, 'Tunisia', 'Arabic', 'TND', 'Millimes', 'ar'),
(5, 'Qatar', 'Arabic', 'QAR', 'Dirham', 'en'),
(5, 'Qatar', 'Arabic', 'QAR', 'Dirham', 'ar'),
(6, 'Lebanon', 'Arabic', 'LBP', 'Piastre', 'en'),
(6, 'Lebanon', 'Arabic', 'LBP', 'Piastre', 'ar'),
(7, 'Libya', 'Arabic', 'LYD', 'Dirham', 'en'),
(7, 'Libya', 'Arabic', 'LYD', 'Dirham', 'ar'),
(8, 'Sudan', 'Arabic', 'SDG', 'Piastres', 'en'),
(8, 'Sudan', 'Arabic', 'SDG', 'Piastres', 'ar'),
(9, 'Syrian Arab Republic', 'Arabic', 'SYP', 'Piastre', 'en'),
(9, 'Syrian Arab Republic', 'Arabic', 'SYP', 'Piastre', 'ar'),
(10, 'Kuwait', 'Arabic', 'KWD', 'Fils', 'en'),
(10, 'Kuwait', 'Arabic', 'KWD', 'Fils', 'ar'),
(11, 'Iraq', 'Arabic', 'IQD', 'fils', 'en'),
(11, 'Iraq', 'Arabic', 'IQD', 'fils', 'ar'),
(12, 'Algeria', 'Arabic', 'DZD', 'Santeem', 'en'),
(12, 'Algeria', 'Arabic', 'DZD', 'Santeem', 'ar'),
(13, 'Jordan', 'Arabic', 'JOD', 'Qirsh', 'en'),
(13, 'Jordan', 'Arabic', 'JOD', 'Qirsh', 'ar'),
(14, 'Morocco', 'Arabic', 'MAD', 'Santim', 'en'),
(14, 'Morocco', 'Arabic', 'MAD', 'Santim', 'ar'),
(15, 'Oman', 'Arabic', 'OMR', 'Baisa', 'en'),
(15, 'Oman', 'Arabic', 'OMR', 'Baisa', 'ar'),
(16, 'United Arab Emirates', 'Arabic', 'AED', 'fils', 'en'),
(16, 'United Arab Emirates', 'Arabic', 'AED', 'fils', 'ar'),
(17, 'Yemen', 'Arabic', 'YER', 'fils', 'en'),
(17, 'Yemen', 'Arabic', 'YER', 'fils', 'ar'),
(18, 'Mauritania', 'Arabic', 'MRO', 'Khoums', 'en'),
(18, 'Mauritania', 'Arabic', 'MRO', 'Khoums', 'ar');

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `locale_lang`
--
ALTER TABLE `locale_lang`
  ADD CONSTRAINT `locale_lang_ibfk_1` FOREIGN KEY (`locale_id`) REFERENCES `locale` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;
