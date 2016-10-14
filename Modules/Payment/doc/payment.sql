-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 06. Dez 2012 um 09:58
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
-- Datenbank: `amhshoppro`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `max_mount` double(12,3) DEFAULT NULL,
  `modulename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `online` tinyint(1) NOT NULL,
  `charge` double(12,3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Daten für Tabelle `payment`
--

INSERT INTO `payment` (`id`, `name`, `max_mount`, `modulename`, `description`, `online`, `charge`) VALUES
(1, 'حسب الاتفاق هاتفيا', 0.000, '', 'الرجاء الاتصال على الرقم التالي:\n00495312801805\nاو \n00495312801809\n', 0, NULL),
(10, 'الوسترن يونيون', 0.000, '', 'المستفيد\nfaras rashed aljowder\nCity: muharraq\nCountry: bahrain\n\nرجاء اعلامنا بارسال المبلغ و اسم المرسل (بالحروف اللاتينية) و رقم التحويل\nالاستلام يتم مباشرة بعد استلام المبلغ\n', 1, NULL),
(11, 'paypal', NULL, 'paypal', 'باي بال هي أسرع وأكثر أمانا كوسيلة للدفع والحصول على أموال عبر الإنترنت. وتسمح هذه الخدمة للأعضاء لإرسال المال من دون إستخدام معلوماتهم الشخصية والمالية على مواقع الإنترنت، مع المرونة للدفع سواءاً بإستخدام أرصدة حساباتهم بالباي بال، والحسابات المصرفية وبطاقات الائتمان.\nالشرح مقتبس من موقع باي بال الرسمي.', 1, NULL),
(12, 'visa & mastercard', NULL, 'credimax', 'أشهر وآمن وسائل الدفع حول العالم.', 1, NULL),
(13, 'Cashu', NULL, 'cashu', 'تقلل كاش يو من مخاطر الدفع عبر شبكة الإنترنت، وتتيح للمستخدمين مشاركة أوسع وأسرع وأكثر أماناً في التجارة الإلكترونية.\nالشرح مقتبس من موقع كاش يو الرسمي.', 1, NULL),
(14, 'بنك الراجحي', NULL, '', 'التحويل البنكي إلى حساب الشركة في بنك الراجحي.\n\nمعلومات الحساب كالآتي:\nأسم الحساب: فراس راشد الجودر\nرقم الحساب: 187608010300205\nIBAN: SA2380000187608010300205\n\nملاحظة مهمة: عند تحويل المبلغ سواءاً بالإنترنت او يدوياً من خلال أحد فروع البنك، فيجب على العميل أن يرسل ومن خلال حسابه في موقع المتجر الالكتروني بيانات التحويل سواءاً كتابياً أو صورة من التحويل حتى يتسنى لنا التفريق ما بين المدفوعات التي تتم في حساب الشركة.\nالمعلومات المطلوب توفيرها هي كالآتي:\nأسم الشخص الذي حول المبلغ\nرمز التحويل\nالمبلغ المحول إلى حساب الشركة\n', 1, NULL),
(15, 'بنك البحرين والكويت', NULL, '', 'التحويل البنكي إلى حساب الشركة في بنك البحرين والكويت.\n\nمعلومات الحساب كالآتي:\nأسم الحساب: ARABIC MODERN HOUSE\nرقم الحساب: 200002864264\nسويفت كود: BBKUBHBM\n\nملاحظة مهمة: عند تحويل المبلغ سواءاً بالإنترنت او يدوياً من خلال أحد فروع البنك، فيجب على العميل أن يرسل ومن خلال حسابه في موقع المتجر الالكتروني بيانات التحويل سواءاً كتابياً أو صورة من التحويل حتى يتسنى لنا التفريق ما بين المدفوعات التي تتم في حساب الشركة.\nالمعلومات المطلوب توفيرها هي كالآتي:\nأسم الشخص الذي حول المبلغ\nرمز التحويل\nالمبلغ المحول إلى حساب الشركة\n', 1, NULL);
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
