SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


ALTER TABLE  `shipping` ADD  `max_order_amount` DOUBLE( 12, 3 ) NULL ;


SET FOREIGN_KEY_CHECKS=1;
COMMIT;

