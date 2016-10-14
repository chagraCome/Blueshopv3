CREATE  TABLE IF NOT EXISTS `rbac_privilege` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NULL ,
  `alias` VARCHAR(255) NULL ,
  `permission` VARCHAR(255) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB