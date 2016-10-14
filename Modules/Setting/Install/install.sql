-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 07. Sep 2012 um 11:04
-- Server Version: 5.5.8
-- PHP-Version: 5.3.5

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT=0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Datenbank: `motorssouq_relaunch`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `settings_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `settings_value` longtext COLLATE utf8_unicode_ci,
  `hash_key` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



CREATE TABLE IF NOT EXISTS `config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `config_key` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`,`config_key`),
  KEY `value` (`value`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=42497 ;

--
-- Daten für Tabelle `config`
--

INSERT INTO `config` (`id`, `config_key`, `value`, `description`) VALUES
(20, 'name', '', NULL),
(21, 'owner', '', NULL),
(22, 'adress', '', NULL),
(23, 'tel', '', NULL),
(24, 'fax', '', NULL),
(25, 'mobile', '', NULL),
(26, 'email', '', NULL),
(27, 'ssl', '0', NULL),
(28, 'url_friendly', '0', NULL),
(29, 'without_login', '0', NULL),
(51, 'user_field_postalCode_required', '0', NULL),
(52, 'user_field_city', '1', NULL),
(53, 'user_field_city_required', '0', NULL),
(54, 'user_field_country', '1', NULL),
(55, 'user_field_country_required', '0', NULL),
(56, 'width', '970', NULL),
(57, 'layout', '3', 'Layout: Anzahl der splaten'),
(58, 'box_width', '200', NULL),
(59, 'show_banner', '0', NULL),
(60, 'product_banner', '0', NULL),
(61, 'banner_product_count', '0', NULL),
(62, 'banner_height', '100', NULL),
(63, 'list_product_num_col', '2', NULL),
(64, 'home_layout', '0', NULL),
(65, 'max_pro_page', '9', NULL),
(73, 'rss', '0', NULL),
(74, 'statistic_online', '0', NULL),
(75, 'description', '', NULL),
(76, 'shop_offline', '0', NULL),
(77, 'offline_ip', '', NULL),
(80, 'alarm_quantity', '2', NULL),
(82, 'count_number_after_comma_price', '0', NULL),
(83, 'rss', '1', NULL),
(84, 'description', '', NULL),
(85, 'logo_alt_text', '', 'Alternative logo text, for disabled persons or if logo image not loaded.'),
(86, 'keywords', '', 'Meta keywords for search robots.'),
(87, 'rss', '1', NULL),
(88, 'description', '', NULL),
(89, 'logo_alt_text', NULL, 'Alternative logo text, for disabled persons or if logo image not loaded.'),
(90, 'keywords', NULL, 'Meta keywords for search robots.'),
(91, 'rss', '1', NULL),
(92, 'description', '', NULL),
(96, 'logo_width', '', NULL),
(97, 'logo_height', '', NULL);
(98, 'style', 'motorssouq', NULL);



SET FOREIGN_KEY_CHECKS=1;
COMMIT;
