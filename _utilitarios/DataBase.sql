/*
** Autor: Leo Altíssimo Neto
** 
** Script sql to define a data base to use in MVC frameworck
*/

CREATE DATABASE IF NOT EXISTS `DBname` CHARACTER SET utf8;


/* Defining tables */

CREATE TABLE IF NOT EXISTS `DBname`.`tableName` (
  `Id`            INT (11) NOT NULL AUTO_INCREMENT,
  `name`          VARCHAR(64) NOT NULL,
  `description`   TEXT,
  PRIMARY KEY (`Id`)
) ENGINE = INNODB CHARSET = utf8 ;

