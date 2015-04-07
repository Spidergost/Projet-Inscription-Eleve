################################
# Insertion des données
################################

INSERT INTO `SALLE` (`ID_SALLE`, `LIBELLE`) VALUES
(1,	'101'),
(2,	'102'),
(3,	'201'),
(4,	'202');

INSERT INTO `FORMATEUR` (`ID_FORMATEUR`, `NOM`, `PRENOM`, `ID_SALLE`) VALUES
	(1,	'Dupont', 'Robert', 1),
	(2,	'Martin', 'Alexis', 2),
	(3,	'Durand', 'Paul', 3),
	(4,	'Duval', 'Alain', 4);

INSERT INTO `NATIONALITE` (`ID_NATIONALITE`, `LIBELLE`) VALUES
(1,	'Français'),
(2,	'Anglais'),
(3,	'Allemand'),
(4,	'Russe');

INSERT INTO `TYPE_FORMATION` (`ID_TYPE_FORMATION`, `LIBELLE`) VALUES
(1,	'Web designer'),
(2,	'Développeur');

INSERT INTO `STAGIAIRE` (`ID`, `NOM`, `PRENOM`, `ID_NATIONALITE`, `ID_TYPE_FORMATION`) VALUES
(1,	'Sharapova', 'Nadia', 4, 1),
(2,	'Monfils', 'Boby', 1, 2),
(4,	'Becker', 'Josephine', 3, 2),
(6,	'Dupont', 'Robert', 1, 2),
(8,	'Murray', 'Bill', 2, 1);

INSERT INTO DATE VALUES
	('2011-07-25'),
	('2011-09-25'),
	('2010-08-21'),
	('2011-08-17');

INSERT INTO `STAGIAIRE_FORMATEUR` (`ID`, `ID_FORMATEUR`, `DATE_DEBUT`, `DATE_FIN`) VALUES
(1,	1, '2011-07-25', '2011-10-28'),
(1,	2, '2011-10-31', '2011-12-30'),
(2,	4, '2011-08-26', '2011-10-18'),
(8,	2, '2011-08-15', '2012-02-15'),
(6,	4, '2011-08-21', '2011-10-21'),
(4,	3, '2011-08-17', '2012-02-21');

INSERT INTO TYPE_FORMATION_FORMATEUR (ID_FORMATEUR, ID_TYPE_FORMATION, DATE_DEBUT_FORMATION, DATE_FIN_FORMATION) VALUES
(1,	1, '2011-07-25', '2011-12-28'),
(2,	1, '2011-09-25', '2012-01-25'),
(3,	2, '2010-08-21', '2013-10-21'),
(4,	2, '2011-08-17', '2012-02-21');