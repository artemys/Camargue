CREATE DATABASE `dblogin` ;
CREATE TABLE `dblogin`.`users` (
   `user_id` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
   `user_name` VARCHAR( 255 ) NOT NULL ,
   `user_email` VARCHAR( 60 ) NOT NULL ,
   `user_pass` VARCHAR( 255 ) NOT NULL ,
    UNIQUE (`user_name`),
    UNIQUE (`user_email`)
) ENGINE = MYISAM ;

CREATE TABLE `dblogin`.`photo`(
	`photo_id` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`photo_auteur` INT( 11 ) NOT NULL,
	`photo_src` VARCHAR( 255 ) NOT NULL,
	`photo_height` INT( 11 ) NOT NULL,
	`photo_weight` INT( 11 ) NOT NULL,
	`photo_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
)

CREATE TABLE `dblogin`.`commentaire`(
	`comm_id` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`photo_id` INT( 11 ) NOT NULL,
	`user_name` VARCHAR( 225 ) NOT NULL,
	`comm` TEXT() NOT NULL,
	`comm_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,


)