SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `product_has_shipping`
--

CREATE TABLE IF NOT EXISTS `product_has_shipping` (
  `product_id` int(11) NOT NULL,
  `shipping_id` int(11) NOT NULL,
  KEY `product_id` (`product_id`,`shipping_id`),
  KEY `shipping_id` (`shipping_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `product_has_shipping`
--
ALTER TABLE `product_has_shipping`
  ADD CONSTRAINT `product_has_shipping_ibfk_2` FOREIGN KEY (`shipping_id`) REFERENCES `shipping` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_has_shipping_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;
