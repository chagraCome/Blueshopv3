ALTER TABLE  `user` ADD  `msn` VARCHAR( 255 )  NULL AFTER  `admin` ,
ADD  `facebook` VARCHAR( 255 )  NULL AFTER  `msn` ,
ADD  `twitter` VARCHAR( 255 ) NULL AFTER  `facebook` ,
ADD  `icq` VARCHAR( 255 )  NULL AFTER  `twitter` ,
ADD  `whatsapp` VARCHAR( 255 ) NULL AFTER  `icq` ,
ADD  `blackberry` VARCHAR( 255 )  NULL AFTER  `whatsapp` ,
ADD  `gmail` VARCHAR( 255 ) NULL AFTER  `blackberry`,
ADD  `role_id` INT NOT NULL AFTER  `gmail`
