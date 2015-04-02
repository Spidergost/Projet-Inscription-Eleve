DROP DATABASE IF EXISTS formation;

CREATE DATABASE IF NOT EXISTS formation;
USE formation;
# -----------------------------------------------------------------------------
#       TABLE : NATIONALITE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS NATIONALITE
 (
   ID_NATIONALITE INTEGER(2) NOT NULL  ,
   LIBELLE VARCHAR(20) NULL  
   , PRIMARY KEY (ID_NATIONALITE) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : FORMATEUR
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS FORMATEUR
 (
   ID_FORMATEUR INTEGER(2) NOT NULL AUTO_INCREMENT ,
   ID_SALLE INTEGER(2) NOT NULL  ,
   NOM VARCHAR(20) NULL  ,
   PRENOM VARCHAR(20) NULL  
   , PRIMARY KEY (ID_FORMATEUR) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE FORMATEUR
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_FORMATEUR_SALLE
     ON FORMATEUR (ID_SALLE ASC);

# -----------------------------------------------------------------------------
#       TABLE : STAGIAIRE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS STAGIAIRE
 (
   ID INTEGER(2) NOT NULL AUTO_INCREMENT ,
   ID_TYPE_FORMATION INTEGER(2) NULL  ,
   ID_NATIONALITE INTEGER(2) NOT NULL  ,
   NOM VARCHAR(20) NULL  ,
   PRENOM VARCHAR(20) NULL  
   , PRIMARY KEY (ID) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE STAGIAIRE
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_STAGIAIRE_TYPE_FORMATION
     ON STAGIAIRE (ID_TYPE_FORMATION ASC);

CREATE  INDEX I_FK_STAGIAIRE_NATIONALITE
     ON STAGIAIRE (ID_NATIONALITE ASC);

# -----------------------------------------------------------------------------
#       TABLE : DATE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS DATE
 (
   DATE_DEBUT_FORMATION DATETIME NOT NULL  
   , PRIMARY KEY (DATE_DEBUT_FORMATION) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : SALLE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS SALLE
 (
   ID_SALLE INTEGER(2) NOT NULL  ,
   LIBELLE VARCHAR(25) NULL  
   , PRIMARY KEY (ID_SALLE) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : TYPE_FORMATION
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS TYPE_FORMATION
 (
   ID_TYPE_FORMATION INTEGER(2) NOT NULL  ,
   LIBELLE VARCHAR(25) NULL  
   , PRIMARY KEY (ID_TYPE_FORMATION) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : STAGIAIRE_FORMATEUR
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS STAGIAIRE_FORMATEUR
 (
   ID INTEGER(2) NOT NULL  ,
   ID_FORMATEUR INTEGER(2) NOT NULL  ,
   DATE_DEBUT DATE NULL  ,
   DATE_FIN DATE NULL  
   , PRIMARY KEY (ID,ID_FORMATEUR) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE STAGIAIRE_FORMATEUR
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_STAGIAIRE_FORMATEUR_STAGIAIRE
     ON STAGIAIRE_FORMATEUR (ID ASC);

CREATE  INDEX I_FK_STAGIAIRE_FORMATEUR_FORMATEUR
     ON STAGIAIRE_FORMATEUR (ID_FORMATEUR ASC);

# -----------------------------------------------------------------------------
#       TABLE : TYPE_FORMATION_FORMATEUR
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS TYPE_FORMATION_FORMATEUR
 (
   ID_FORMATEUR INTEGER(2) NOT NULL  ,
   ID_TYPE_FORMATION INTEGER(2) NOT NULL  ,
   DATE_DEBUT_FORMATION DATETIME NOT NULL  ,
   DATE_FIN_FORMATION DATE NULL  
   , PRIMARY KEY (ID_FORMATEUR,ID_TYPE_FORMATION,DATE_DEBUT_FORMATION) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE TYPE_FORMATION_FORMATEUR
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_TYPE_FORMATION_FORMATEUR_FORMATEUR
     ON TYPE_FORMATION_FORMATEUR (ID_FORMATEUR ASC);

CREATE  INDEX I_FK_TYPE_FORMATION_FORMATEUR_TYPE_FORMATION
     ON TYPE_FORMATION_FORMATEUR (ID_TYPE_FORMATION ASC);

CREATE  INDEX I_FK_TYPE_FORMATION_FORMATEUR_DATE
     ON TYPE_FORMATION_FORMATEUR (DATE_DEBUT_FORMATION ASC);


# -----------------------------------------------------------------------------
#       CREATION DES REFERENCES DE TABLE
# -----------------------------------------------------------------------------


ALTER TABLE FORMATEUR 
  ADD FOREIGN KEY FK_FORMATEUR_SALLE (ID_SALLE)
      REFERENCES SALLE (ID_SALLE) ;


ALTER TABLE STAGIAIRE 
  ADD FOREIGN KEY FK_STAGIAIRE_TYPE_FORMATION (ID_TYPE_FORMATION)
      REFERENCES TYPE_FORMATION (ID_TYPE_FORMATION) ;


ALTER TABLE STAGIAIRE 
  ADD FOREIGN KEY FK_STAGIAIRE_NATIONALITE (ID_NATIONALITE)
      REFERENCES NATIONALITE (ID_NATIONALITE) ;


ALTER TABLE STAGIAIRE_FORMATEUR 
  ADD FOREIGN KEY FK_STAGIAIRE_FORMATEUR_STAGIAIRE (ID)
      REFERENCES STAGIAIRE (ID) ;


ALTER TABLE STAGIAIRE_FORMATEUR 
  ADD FOREIGN KEY FK_STAGIAIRE_FORMATEUR_FORMATEUR (ID_FORMATEUR)
      REFERENCES FORMATEUR (ID_FORMATEUR) ;


ALTER TABLE TYPE_FORMATION_FORMATEUR 
  ADD FOREIGN KEY FK_TYPE_FORMATION_FORMATEUR_FORMATEUR (ID_FORMATEUR)
      REFERENCES FORMATEUR (ID_FORMATEUR) ;


ALTER TABLE TYPE_FORMATION_FORMATEUR 
  ADD FOREIGN KEY FK_TYPE_FORMATION_FORMATEUR_TYPE_FORMATION (ID_TYPE_FORMATION)
      REFERENCES TYPE_FORMATION (ID_TYPE_FORMATION) ;


ALTER TABLE TYPE_FORMATION_FORMATEUR 
  ADD FOREIGN KEY FK_TYPE_FORMATION_FORMATEUR_DATE (DATE_DEBUT_FORMATION)
      REFERENCES DATE (DATE_DEBUT_FORMATION) ;

