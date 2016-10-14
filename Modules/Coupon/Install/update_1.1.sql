SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT=0;
START TRANSACTION;
SET time_zone = "+00:00";



INSERT INTO  `coupon_code_state` (`id`)VALUES ('1');
INSERT INTO  `coupon_code_state` (`id`)VALUES ('2');
INSERT INTO  `coupon_code_state` (`id`)VALUES ('3');



INSERT INTO `coupon_code_state_lang` (
`coupon_code_state_id` ,
`name` ,
`lang`
)
VALUES (
'1',  'free',  'en'
), (
'1',  'حر ',  'ar'
);


INSERT INTO  `coupon_code_state_lang` (
`coupon_code_state_id` ,
`name` ,
`lang`
)
VALUES (
'2',  'used',  'en'
), (
'2',  'مستعمل ',  'ar'
);

INSERT INTO  `coupon_code_state_lang` (
`coupon_code_state_id` ,
`name` ,
`lang`
)
VALUES (
'3',  'expired',  'en'
), (
'3',  '  منتهي ',  'ar'
);


SET FOREIGN_KEY_CHECKS=1;
COMMIT;



