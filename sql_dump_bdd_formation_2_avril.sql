-- Adminer 4.2.0 MySQL dump

SET NAMES utf8mb4;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `formation`;
CREATE DATABASE `formation` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `formation`;

DROP TABLE IF EXISTS `formateur`;
CREATE TABLE `formateur` (
  `Id_formateur` int(11) NOT NULL,
  `Nom` varchar(20) NOT NULL,
  `Prenom` varchar(20) NOT NULL,
  `Id_salle` int(11) NOT NULL,
  PRIMARY KEY (`Id_formateur`),
  KEY `Id_salle` (`Id_salle`),
  CONSTRAINT `formateur_ibfk_1` FOREIGN KEY (`Id_salle`) REFERENCES `salle` (`Id_salle`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `nationalite`;
CREATE TABLE `nationalite` (
  `Id_nationalite` int(11) NOT NULL,
  `Libelle` varchar(25) NOT NULL,
  PRIMARY KEY (`Id_nationalite`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `salle`;
CREATE TABLE `salle` (
  `Id_salle` int(11) NOT NULL,
  `Libelle` varchar(20) NOT NULL,
  PRIMARY KEY (`Id_salle`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `stagiaire`;
CREATE TABLE `stagiaire` (
  `Id` int(11) NOT NULL,
  `Nom` varchar(20) NOT NULL,
  `Prenom` varchar(20) NOT NULL,
  `Id_nationalite` int(11) NOT NULL,
  `Id_type_formation` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `Id_nationalite` (`Id_nationalite`),
  KEY `Id_type_formation` (`Id_type_formation`),
  CONSTRAINT `stagiaire_ibfk_1` FOREIGN KEY (`Id_nationalite`) REFERENCES `nationalite` (`Id_nationalite`),
  CONSTRAINT `stagiaire_ibfk_2` FOREIGN KEY (`Id_type_formation`) REFERENCES `type_formation` (`Id_type_formation`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `stagiaire_formateur`;
CREATE TABLE `stagiaire_formateur` (
  `Id_stagiaire` int(11) NOT NULL,
  `Id_formateur` int(11) NOT NULL,
  `Date_debut` date NOT NULL,
  `Date_fin` date NOT NULL,
  KEY `Id_stagiaire` (`Id_stagiaire`),
  KEY `Id_formateur` (`Id_formateur`),
  CONSTRAINT `stagiaire_formateur_ibfk_1` FOREIGN KEY (`Id_stagiaire`) REFERENCES `stagiaire` (`Id`),
  CONSTRAINT `stagiaire_formateur_ibfk_2` FOREIGN KEY (`Id_formateur`) REFERENCES `formateur` (`Id_formateur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `type_formation`;
CREATE TABLE `type_formation` (
  `Id_type_formation` int(11) NOT NULL,
  `Libelle` varchar(25) NOT NULL,
  PRIMARY KEY (`Id_type_formation`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `type_formation_formateur`;
CREATE TABLE `type_formation_formateur` (
  `Id_type_formation` int(11) NOT NULL,
  `Id_formateur` int(11) NOT NULL,
  KEY `Id_type_formation` (`Id_type_formation`),
  KEY `Id_formateur` (`Id_formateur`),
  CONSTRAINT `type_formation_formateur_ibfk_1` FOREIGN KEY (`Id_type_formation`) REFERENCES `type_formation` (`Id_type_formation`),
  CONSTRAINT `type_formation_formateur_ibfk_2` FOREIGN KEY (`Id_formateur`) REFERENCES `formateur` (`Id_formateur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- 2015-04-02 12:47:55
