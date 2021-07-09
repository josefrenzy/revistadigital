-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `revista` DEFAULT CHARACTER SET utf8 ;
USE `revista` ;

-- -----------------------------------------------------
-- Table `mydb`.`categorias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `revista`.`categorias` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  `descripcion` VARCHAR(45) NULL,
  `status` INT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`ediciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `revista`.`ediciones` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  `descripcion` VARCHAR(2000) NULL,
  `status` INT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`abstract`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `revista`.`abstract` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  `descripcion` text NULL,
  `img_abstract` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`capsula`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `revista`.`capsula` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  `descripcion` text NULL,
  `status` INT NOT NULL,
  `img_capsula` varchar(200),
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`posts`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `revista`.`posts` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `user_id` BIGINT UNSIGNED NOT NULL,
  `cuerpo` text NULL,
  `titulo` VARCHAR(45) NULL,
  `slug` VARCHAR(45) NOT NULL UNIQUE,
  `visitas` INT NULL,
  -- `scope` INT NOT NULL,
  `img_portada` VARCHAR(45) NULL,
  `status` INT NOT NULL,
  -- `nombre_imagen` VARCHAR(45) NULL,
  `categorias_id` INT NOT NULL,
  `ediciones_id` INT NOT NULL,
  `abstract_id` INT NOT NULL,
  `tipo_post` INT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 `updated_at` timestamp NULL,
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  FOREIGN KEY (`categorias_id`) REFERENCES `categorias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  FOREIGN KEY (`ediciones_id`) REFERENCES `ediciones` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  FOREIGN KEY (`abstract_id`) REFERENCES `abstract` (`id`)ON DELETE NO ACTION ON UPDATE NO ACTION)
ENGINE = InnoDB DEFAULT CHARSET=latin1;


-- -----------------------------------------------------
-- Table `mydb`.`capsula`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `revista`.`lectores` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nombre` varchar(200) NOT NULL,
  `nombre_empresa` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(30) NOT NULL DEFAULT 'revista@123',
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;