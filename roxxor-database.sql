-- Adminer 4.2.0 MySQL dump

SET NAMES utf8mb4;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `roxxor-database`;
CREATE DATABASE `roxxor-database` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `roxxor-database`;

DROP TABLE IF EXISTS `horaires`;
CREATE TABLE `horaires` (
  `acheteur` varchar(20) NOT NULL,
  `quantite` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `id-cafe` int(11) NOT NULL,
  KEY `id-cafe` (`id-cafe`),
  CONSTRAINT `horaires_ibfk_1` FOREIGN KEY (`id-cafe`) REFERENCES `type-cafe` (`id-cafe`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `horaires` (`acheteur`, `quantite`, `date`, `id-cafe`) VALUES
('Mascret',	10,	'2015-04-13 08:32:43',	4),
('Alizée',	100,	'2015-04-13 08:48:42',	13);

DROP TABLE IF EXISTS `type-cafe`;
CREATE TABLE `type-cafe` (
  `id-cafe` int(11) NOT NULL,
  `qualite` varchar(15) NOT NULL,
  `marque` varchar(20) NOT NULL,
  PRIMARY KEY (`id-cafe`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `type-cafe` (`id-cafe`, `qualite`, `marque`) VALUES
(4,	'correcte',	'Carte Noire'),
(13,	'Nulle',	'Grand Mère');

-- 2015-04-13 06:49:37
