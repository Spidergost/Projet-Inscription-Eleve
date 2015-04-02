DELETE FROM formateur;
DELETE FROM nationalite;
DELETE FROM salle;
DELETE FROM stagiaire;
DELETE FROM stagiaire_formateur;
DELETE FROM type_formation_formateur;
DELETE FROM type_formation;

INSERT INTO formateur VALUES (1,'Dupont', 'Robert', 1);
INSERT INTO formateur VALUES (2, 'Martin', 'Alexis', 2);
INSERT INTO formateur VALUES (3, 'Durand', 'Paul', 3);
INSERT INTO formateur VALUES (4, 'Duval', 'Alain', 4);

INSERT INTO nationalite VALUES (1, 'Français');
INSERT INTO nationalite VALUES (2, 'Anglais');
INSERT INTO nationalite VALUES (3, 'Allemand');
INSERT INTO nationalite VALUES (4, 'Russe');

INSERT INTO salle VALUES (1, '101');
INSERT INTO salle VALUES (1, '102');
INSERT INTO salle VALUES (1, '201');
INSERT INTO salle VALUES (1, '202');

INSERT INTO salle VALUES (1, 'Sharapova', 'Nadia', 4, 1);
INSERT INTO salle VALUES (2, 'Monfils', 'Body', 1, 2);
INSERT INTO salle VALUES (8, 'Murray', 'Bill', 2, 1);
INSERT INTO salle VALUES (4, 'Becker', 'Josephine', 3, 2);
INSERT INTO salle VALUES (6, 'Dupont', 'Robert', 1, 2);

INSERT INTO stagiaire_formateur VALUES (1, 1, '2011-07-25', '2011-10-28');
INSERT INTO stagiaire_formateur VALUES (1, 2, '2011-10-31', '2011-12-30');
INSERT INTO stagiaire_formateur VALUES (2, 4, '2011-08-31', '2011-10-18');
INSERT INTO stagiaire_formateur VALUES (8, 2, '2011-08-15', '2012-02-15');
INSERT INTO stagiaire_formateur VALUES (6, 4, '2011-08-21', '2011-10-21');
INSERT INTO stagiaire_formateur VALUES (4, 3, '2011-08-17', '2012-02-21');

INSERT INTO type_formation_formateur VALUES (1, 1);
INSERT INTO type_formation_formateur VALUES (1, 2);
INSERT INTO type_formation_formateur VALUES (2, 3);
INSERT INTO type_formation_formateur VALUES (2, 4);

INSERT INTO type_formation VALUES (1, 'Web designer');
INSERT INTO type_formation VALUES (2, 'Développeur');

SELECT * FROM formateur;
SELECT * FROM nationalite;
SELECT * FROM salle;
SELECT * FROM stagiaire;
SELECT * FROM stagiaire_formateur;
SELECT * FROM fype_formation_formateur;
SELECT * FROM fype_formation; 
