


SET FOREIGN_KEY_CHECKS=0;


DROP TABLE IF EXISTS `sale_order_address`;
CREATE TABLE IF NOT EXISTS `sale_order_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `street` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zipcode` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `province` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;
  




ALTER TABLE `sale_order` ADD FOREIGN KEY ( `invoice_address_id` ) REFERENCES `sale_order_address` (
`id`
) ON DELETE CASCADE ON UPDATE CASCADE ;

ALTER TABLE `sale_order` ADD FOREIGN KEY ( `shipping_address_id` ) REFERENCES `sale_order_address` (
`id`
) ON DELETE CASCADE ON UPDATE CASCADE ;
SET FOREIGN_KEY_CHECKS=1;


