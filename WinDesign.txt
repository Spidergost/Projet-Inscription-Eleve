#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: Formateur
#------------------------------------------------------------

CREATE TABLE Formateur(
        Id_formateur Int NOT NULL ,
        Nom          Varchar (20) ,
        Prenom       Varchar (20) ,
        Id_salle     Int ,
        PRIMARY KEY (Id_formateur )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: salle
#------------------------------------------------------------

CREATE TABLE salle(
        Id_salle Int NOT NULL ,
        Libelle  Varchar (25) ,
        PRIMARY KEY (Id_salle )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: nationalite
#------------------------------------------------------------

CREATE TABLE nationalite(
        Id_nationalite Int NOT NULL ,
        Libelle        Varchar (20) ,
        PRIMARY KEY (Id_nationalite )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: stagiaire
#------------------------------------------------------------

CREATE TABLE stagiaire(
        Id                Int NOT NULL ,
        Nom               Varchar (20) ,
        Prenom            Varchar (20) ,
        Id_nationalite    Int ,
        Id_type_formation Int ,
        PRIMARY KEY (Id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: type_formation
#------------------------------------------------------------

CREATE TABLE type_formation(
        Id_type_formation Int NOT NULL ,
        Libelle           Varchar (25) ,
        PRIMARY KEY (Id_type_formation )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: relation5
#------------------------------------------------------------

CREATE TABLE relation5(
        Date_debut   Date ,
        Date_fin     Date ,
        Id           Int NOT NULL ,
        Id_formateur Int NOT NULL ,
        PRIMARY KEY (Id ,Id_formateur )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: type_formation_formateur
#------------------------------------------------------------

CREATE TABLE type_formation_formateur(
        Id_formateur      Int NOT NULL ,
        Id_type_formation Int NOT NULL ,
        PRIMARY KEY (Id_formateur ,Id_type_formation )
)ENGINE=InnoDB;

ALTER TABLE Formateur ADD CONSTRAINT FK_Formateur_Id_salle FOREIGN KEY (Id_salle) REFERENCES salle(Id_salle);
ALTER TABLE stagiaire ADD CONSTRAINT FK_stagiaire_Id_nationalite FOREIGN KEY (Id_nationalite) REFERENCES nationalite(Id_nationalite);
ALTER TABLE stagiaire ADD CONSTRAINT FK_stagiaire_Id_type_formation FOREIGN KEY (Id_type_formation) REFERENCES type_formation(Id_type_formation);
ALTER TABLE relation5 ADD CONSTRAINT FK_relation5_Id FOREIGN KEY (Id) REFERENCES stagiaire(Id);
ALTER TABLE relation5 ADD CONSTRAINT FK_relation5_Id_formateur FOREIGN KEY (Id_formateur) REFERENCES Formateur(Id_formateur);
ALTER TABLE type_formation_formateur ADD CONSTRAINT FK_type_formation_formateur_Id_formateur FOREIGN KEY (Id_formateur) REFERENCES Formateur(Id_formateur);
ALTER TABLE type_formation_formateur ADD CONSTRAINT FK_type_formation_formateur_Id_type_formation FOREIGN KEY (Id_type_formation) REFERENCES type_formation(Id_type_formation);
