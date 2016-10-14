SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT=0;
START TRANSACTION;
SET time_zone = "+00:00";


DROP TABLE IF EXISTS `coupon_account`;
CREATE TABLE IF NOT EXISTS `coupon_account` (
  `coupon_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL,
  KEY `coupon_id` (`coupon_id`,`account_id`,`status`),
  KEY `account_id` (`account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `coupon_contact`;
CREATE TABLE IF NOT EXISTS `coupon_contact` (
  `coupon_id` int(11) DEFAULT NULL,
  `contact_id` int(11) DEFAULT NULL,
  `state` int(11) DEFAULT NULL,
  KEY `coupon_id` (`coupon_id`),
  KEY `contact_id` (`contact_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `coupon_account`
  ADD CONSTRAINT `coupon_account_ibfk_1` FOREIGN KEY (`coupon_id`) REFERENCES `coupon` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `coupon_account_ibfk_2` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `compain_contact`
--
ALTER TABLE `coupon_contact`
  ADD CONSTRAINT `coupon_contact_ibfk_1` FOREIGN KEY (`coupon_id`) REFERENCES `coupon` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `coupon_contact_ibfk_2` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;


SET FOREIGN_KEY_CHECKS=1;
COMMIT;



