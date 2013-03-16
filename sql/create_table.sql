CREATE  TABLE `php_mysql_simple_crud_schema`.`Users` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `first_name` VARCHAR(45) NULL ,
  `last_name` VARCHAR(45) NULL ,
  `country` VARCHAR(45) NULL ,
  `city` VARCHAR(45) NULL ,
  `address` VARCHAR(45) NULL ,
  `email` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) );