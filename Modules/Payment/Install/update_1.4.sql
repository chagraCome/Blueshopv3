
DROP TABLE IF EXISTS `payment_bank`;
CREATE TABLE IF NOT EXISTS `payment_bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `payment_bank_lang`
--

DROP TABLE IF EXISTS `payment_bank_lang`;
CREATE TABLE IF NOT EXISTS `payment_bank_lang` (
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lang` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_bank_id` int(11) DEFAULT NULL,
  KEY `payment_bank_id` (`payment_bank_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
