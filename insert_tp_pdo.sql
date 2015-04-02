DELETE FROM Formateur;
DELETE FROM Nationalite;
DELETE FROM salle;
DELETE FROM stagiaire;
DELETE FROM stagiaire-formateur;
DELETE FROM Type-Formation-formateur;
DELETE FROM Type-Formation;

INSERT INTO Formateur VALUES (1,'Dupont', 'Robert', 1);
INSERT INTO Formateur VALUES (2, 'Martin', 'Alexis', 2);
INSERT INTO Formateur VALUES (3, 'Durand', 'Paul', 3);
INSERT INTO Formateur VALUES (4, 'Duval', 'Alain', 4);

INSERT INTO Nationalite VALUES (1, 'Français');
INSERT INTO Nationalite VALUES (2, 'Anglais');
INSERT INTO Nationalite VALUES (3, 'Allemand');
INSERT INTO Nationalite VALUES (4, 'Russe');

INSERT INTO salle VALUES (1, '101');
INSERT INTO salle VALUES (1, '102');
INSERT INTO salle VALUES (1, '201');
INSERT INTO salle VALUES (1, '202');

INSERT INTO salle VALUES (1, 'Sharapova', 'Nadia', 4, 1);
INSERT INTO salle VALUES (2, 'Monfils', 'Body', 1, 2);
INSERT INTO salle VALUES (8, 'Murray', 'Bill', 2, 1);
INSERT INTO salle VALUES (4, 'Becker', 'Josephine', 3, 2);
INSERT INTO salle VALUES (6, 'Dupont', 'Robert', 1, 2);

INSERT INTO stagiaire-formateur VALUES (1, 1, '2011-07-25', '2011-10-28');
INSERT INTO stagiaire-formateur VALUES (1, 2, '2011-10-31', '2011-12-30');
INSERT INTO stagiaire-formateur VALUES (2, 4, '2011-08-31', '2011-10-18');
INSERT INTO stagiaire-formateur VALUES (8, 2, '2011-08-15', '2012-02-15');
INSERT INTO stagiaire-formateur VALUES (6, 4, '2011-08-21', '2011-10-21');
INSERT INTO stagiaire-formateur VALUES (4, 3, '2011-08-17', '2012-02-21');

INSERT INTO Type-Formation-formateur VALUES (1, 1);
INSERT INTO Type-Formation-formateur VALUES (1, 2);
INSERT INTO Type-Formation-formateur VALUES (2, 3);
INSERT INTO Type-Formation-formateur VALUES (2, 4);

INSERT INTO Type-Formation VALUES (1, 'Web designer');
INSERT INTO Type-Formation VALUES (2, 'Développeur');

SELECT * FROM Formateur;
SELECT * FROM Nationalite;
SELECT * FROM salle;
SELECT * FROM stagiaire;
SELECT * FROM stagiaire-formateur;
SELECT * FROM Type-Formation-formateur;
SELECT * FROM Type-Formation; 
