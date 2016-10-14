-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 07. Dez 2012 um 09:51
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
-- Tabellenstruktur für Tabelle `shoppingcart`
--

DROP TABLE IF EXISTS `shoppingcart`;
CREATE TABLE IF NOT EXISTS `shoppingcart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `expire` int(11) DEFAULT NULL,
  `total` double(12,3) DEFAULT NULL,
  `shippingcost` double(12,3) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `shipping_address_id` int(11) DEFAULT NULL,
  `invoice_address_id` int(11) DEFAULT NULL,
  `shipping_id` int(11) DEFAULT NULL,
  `payment_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_shoppingcart_account1` (`account_id`),
  KEY `fk_shoppingcart_address1` (`shipping_address_id`),
  KEY `fk_shoppingcart_address2` (`invoice_address_id`),
  KEY `fk_shoppingcart_shipping1` (`shipping_id`),
  KEY `fk_shoppingcart_payment1` (`payment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=454 ;

--
-- Daten für Tabelle `shoppingcart`
--

INSERT INTO `shoppingcart` (`id`, `expire`, `total`, `shippingcost`, `account_id`, `shipping_address_id`, `invoice_address_id`, `shipping_id`, `payment_id`) VALUES
(427, NULL, NULL, NULL, NULL, 5, 5, NULL, NULL),
(429, NULL, NULL, NULL, NULL, 5, 5, NULL, NULL),
(432, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL),
(433, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL),
(436, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL),
(437, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL),
(440, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL),
(441, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL),
(444, NULL, NULL, NULL, NULL, 5, 5, NULL, NULL),
(447, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL),
(448, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL),
(451, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL),
(452, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL),
(453, NULL, 100.000, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `shoppingcart_has_product`
--

DROP TABLE IF EXISTS `shoppingcart_has_product`;
CREATE TABLE IF NOT EXISTS `shoppingcart_has_product` (
  `shoppingcart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity_in_cart` int(11) DEFAULT '1',
  PRIMARY KEY (`shoppingcart_id`,`product_id`),
  KEY `fk_shoppingcart_has_product_product1` (`product_id`),
  KEY `fk_shoppingcart_has_product_shoppingcart1` (`shoppingcart_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `shoppingcart`
--
ALTER TABLE `shoppingcart`
  ADD CONSTRAINT `fk_shoppingcart_account1` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_shoppingcart_payment1` FOREIGN KEY (`payment_id`) REFERENCES `payment` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_shoppingcart_shipping1` FOREIGN KEY (`shipping_id`) REFERENCES `shipping` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `shoppingcart_ibfk_1` FOREIGN KEY (`shipping_address_id`) REFERENCES `address` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `shoppingcart_ibfk_2` FOREIGN KEY (`invoice_address_id`) REFERENCES `address` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints der Tabelle `shoppingcart_has_product`
--
ALTER TABLE `shoppingcart_has_product`
  ADD CONSTRAINT `fk_shoppingcart_has_product_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_shoppingcart_has_product_shoppingcart1` FOREIGN KEY (`shoppingcart_id`) REFERENCES `shoppingcart` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE  `shoppingcart` ADD  `comment` TEXT NULL


SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
