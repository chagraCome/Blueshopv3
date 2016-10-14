-- phpMyAdmin SQL Dump
-- version 3.5.8.1deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mar 28 Janvier 2014 à 11:03
-- Version du serveur: 5.5.34-0ubuntu0.13.04.1
-- Version de PHP: 5.4.9-4ubuntu2.4

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT=0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de données
--

-- --------------------------------------------------------

--
-- Structure de la table `entity_attribute_type`
--

DROP TABLE IF EXISTS `entity_attribute_type`;
CREATE TABLE IF NOT EXISTS `entity_attribute_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `typename` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=23 ;

--
-- Contenu de la table `entity_attribute_type`
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
(21, 'Color', 'ColorInput'),
(22, 'Centimeter', 'Centimeter');

-- --------------------------------------------------------

--
-- Structure de la table `entity_attribute_type_lang`
--

DROP TABLE IF EXISTS `entity_attribute_type_lang`;
CREATE TABLE IF NOT EXISTS `entity_attribute_type_lang` (
  `entity_attribute_type_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `typename` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lang` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  KEY `entity_attribute_type_id` (`entity_attribute_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `entity_attribute_type_lang`
--

INSERT INTO `entity_attribute_type_lang` (`entity_attribute_type_id`, `name`, `typename`, `lang`) VALUES
(1, 'Input', 'Text', 'en'),
(1, 'مدخلات', 'Text', 'ar'),
(2, 'ListBox', 'Drop Down', 'en'),
(2, 'قائمة منسدلة ', 'Drop Down', 'ar'),
(3, 'DateControl', 'Date', 'en'),
(3, 'تقويم ميلادي', 'Date', 'ar'),
(4, 'CheckBox', 'Check Box', 'en'),
(4, 'مربع إختيار', 'Check Box', 'ar'),
(5, 'CurrencyInput', 'Currency', 'en'),
(5, 'قائمة العملات', 'Currency', 'ar'),
(6, 'WysiwygTextArea', 'Editor', 'en'),
(6, 'محرر نصوص متطور', 'Editor', 'ar'),
(7, 'TextArea', 'Big Text', 'en'),
(7, 'محرر نصوص', 'Big Text', 'ar'),
(8, 'Label', 'label', 'en'),
(8, 'عنوان', 'label', 'ar'),
(9, 'YesNoListBox', 'YesNoListBox', 'en'),
(9, ' مربع إختيار نعم/لا', 'YesNoListBox', 'ar'),
(10, 'Kilometer Input', 'KMInput', 'en'),
(10, 'كيلومتر', 'KMInput', 'ar'),
(11, 'Mile Input', 'MileInput', 'en'),
(11, 'ميل', 'MileInput', 'ar'),
(12, 'Gramm Input', 'GrammInput', 'en'),
(12, 'جرام', 'GrammInput', 'ar'),
(13, 'Kliogramm Input', 'KlioGrammInput', 'en'),
(13, 'كيلوجرام', 'KlioGrammInput', 'ar'),
(14, 'Meter Input', 'MeterInput', 'en'),
(14, 'متر', 'MeterInput', 'ar'),
(15, 'Feed', 'FeedInput', 'en'),
(15, 'قدم', 'FeedInput', 'ar'),
(16, 'Minute', 'MinuteInput', 'en'),
(16, 'دقائق', 'MinuteInput', 'ar'),
(17, 'Second', 'SecondInput', 'en'),
(17, 'ثواني', 'SecondInput', 'ar'),
(18, 'Centiliter', 'CentiliterInput', 'en'),
(18, 'سنتيلتر', 'CentiliterInput', 'ar'),
(19, 'Milliliter', 'MilliliterInput', 'en'),
(19, 'ملليتر', 'MilliliterInput', 'ar'),
(20, 'Hour', 'HourInput', 'en'),
(20, 'ساعة', 'HourInput', 'ar'),
(21, 'Color', 'ColorInput', 'en'),
(21, 'لون', 'ColorInput', 'ar'),
(22, 'Centimeter', 'Centimeter', 'en'),
(22, 'سنتميتر', 'Centimeter', 'ar');
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

