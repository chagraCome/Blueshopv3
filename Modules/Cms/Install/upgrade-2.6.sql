SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT=0;
START TRANSACTION;
SET time_zone = "+00:00";

DELETE FROM cms_box_lang WHERE cms_box_id NOT IN (SELECT id FROM `cms_box`);

ALTER TABLE `cms_box_lang` ADD FOREIGN KEY ( `cms_box_id` ) REFERENCES `cms_box` (
`id`
) ON DELETE CASCADE ON UPDATE CASCADE ;

SET FOREIGN_KEY_CHECKS=1;
COMMIT;
