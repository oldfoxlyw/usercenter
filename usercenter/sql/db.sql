SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema usercenter_platform_db
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `usercenter_platform_db` ;
CREATE SCHEMA IF NOT EXISTS `usercenter_platform_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `usercenter_platform_db` ;

-- -----------------------------------------------------
-- Table `usercenter_platform_db`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `usercenter_platform_db`.`users` ;

CREATE TABLE IF NOT EXISTS `usercenter_platform_db`.`users` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `username` CHAR(16) NOT NULL,
  `password` CHAR(60) NOT NULL,
  `email` CHAR(64) NOT NULL DEFAULT '',
  `login_at` INT NOT NULL,
  `register_at` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `username` (`username` ASC))
ENGINE = MyISAM;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
