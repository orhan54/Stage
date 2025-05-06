CREATE TABLE Departement(
   Id_departement INT AUTO_INCREMENT,
   departement_code INT,
   departement_nom VARCHAR(150) ,
   departement_nom_uppercase VARCHAR(150) ,
   departement_slug VARCHAR(120) ,
   PRIMARY KEY(Id_departement)
);

CREATE TABLE Accompagne(
   Id_accompagne INT AUTO_INCREMENT,
   accompagne_nom VARCHAR(150) ,
   accompagne_prenom VARCHAR(150) ,
   accompagne_naissance INT,
   PRIMARY KEY(Id_accompagne)
);

CREATE TABLE VilleFR(
   Id_villeFR INT AUTO_INCREMENT,
   ville_departement INT,
   ville_nom VARCHAR(200) ,
   ville_nom_simple VARCHAR(200) ,
   ville_nom_reel VARCHAR(200) ,
   ville_code_postal INT,
   Id_departement INT NOT NULL,
   PRIMARY KEY(Id_villeFR),
   FOREIGN KEY(Id_departement) REFERENCES Departement(Id_departement)
);

CREATE TABLE Hebergement(
   Id_hebergement INT AUTO_INCREMENT,
   hebergement_nom VARCHAR(150) ,
   hebergement_detail TEXT,
   hebergement_adresse VARCHAR(255) ,
   hebergement_date_disponible VARCHAR(50) ,
   Id_villeFR INT NOT NULL,
   PRIMARY KEY(Id_hebergement),
   FOREIGN KEY(Id_villeFR) REFERENCES VilleFR(Id_villeFR)
);

CREATE TABLE Association(
   Id_association INT AUTO_INCREMENT,
   association_nom VARCHAR(150) ,
   association_president VARCHAR(200) ,
   association_telephone VARCHAR(50) ,
   association_email VARCHAR(255)  NOT NULL,
   association_date DATE,
   association_facebook VARCHAR(255) ,
   association_instagram VARCHAR(255) ,
   association_telegram VARCHAR(255) ,
   association_description_FR TEXT,
   association_siret INT,
   association_site_web VARCHAR(255) ,
   association_logo VARCHAR(255) ,
   association_photo VARCHAR(255) ,
   association_mp VARCHAR(255)  NOT NULL,
   Id_villeFR INT NOT NULL,
   PRIMARY KEY(Id_association),
   UNIQUE(association_email),
   FOREIGN KEY(Id_villeFR) REFERENCES VilleFR(Id_villeFR)
);

CREATE TABLE TypeReseau(
   Id_type_reseau INT AUTO_INCREMENT,
   type_nom VARCHAR(150) ,
   type_chemin VARCHAR(255) ,
   type_icon VARCHAR(50) ,
   PRIMARY KEY(Id_type_reseau)
);

CREATE TABLE TypeMedia(
   Id_type_media INT AUTO_INCREMENT,
   type_nom VARCHAR(150) ,
   PRIMARY KEY(Id_type_media)
);

CREATE TABLE TypeUser(
   Id_TypeUser INT AUTO_INCREMENT,
   type_nom VARCHAR(120) ,
   PRIMARY KEY(Id_TypeUser)
);

CREATE TABLE Users(
   Id_user INT AUTO_INCREMENT,
   user_nom VARCHAR(150) ,
   user_prenom VARCHAR(150) ,
   user_email VARCHAR(255)  NOT NULL,
   user_telephone VARCHAR(50) ,
   user_naissance INT,
   user_arriver_france INT,
   user_ville_ukraine VARCHAR(200) ,
   user_langue_francaise VARCHAR(150) ,
   user_niveau_etude VARCHAR(150) ,
   user_dernier_poste_ukraine VARCHAR(150) ,
   user_dernier_poste_france VARCHAR(150) ,
   user_experience VARCHAR(150) ,
   user_pseudonyme VARCHAR(255) ,
   user_mp VARCHAR(255)  NOT NULL,
   Id_TypeUser INT NOT NULL,
   Id_villeFR INT NOT NULL,
   PRIMARY KEY(Id_user),
   UNIQUE(user_email),
   FOREIGN KEY(Id_TypeUser) REFERENCES TypeUser(Id_TypeUser),
   FOREIGN KEY(Id_villeFR) REFERENCES VilleFR(Id_villeFR)
);

CREATE TABLE Evenement(
   Id_evenement INT AUTO_INCREMENT,
   evenement_titre VARCHAR(150)  NOT NULL,
   evenement_description TEXT NOT NULL,
   evenement_date DATE NOT NULL,
   Id_villeFR INT NOT NULL,
   PRIMARY KEY(Id_evenement),
   FOREIGN KEY(Id_villeFR) REFERENCES VilleFR(Id_villeFR)
);

CREATE TABLE Emploi(
   Id_emploi INT AUTO_INCREMENT,
   emploi_nom VARCHAR(150) ,
   emploi_description TEXT,
   emploi_date DATE,
   emploi_salaire VARCHAR(50) ,
   Id_villeFR INT NOT NULL,
   PRIMARY KEY(Id_emploi),
   FOREIGN KEY(Id_villeFR) REFERENCES VilleFR(Id_villeFR)
);

CREATE TABLE Reseau(
   Id_reseau INT AUTO_INCREMENT,
   url_reseau VARCHAR(255)  NOT NULL,
   Id_type_reseau INT NOT NULL,
   Id_association INT NOT NULL,
   PRIMARY KEY(Id_reseau),
   FOREIGN KEY(Id_type_reseau) REFERENCES TypeReseau(Id_type_reseau),
   FOREIGN KEY(Id_association) REFERENCES Association(Id_association)
);

CREATE TABLE Media(
   Id_media INT AUTO_INCREMENT,
   media_chemin VARCHAR(150) ,
   Id_type_media INT NOT NULL,
   Id_evenement INT NULL,
   Id_hebergement INT NULL,
   PRIMARY KEY(Id_media),
   FOREIGN KEY(Id_type_media) REFERENCES TypeMedia(Id_type_media),
   FOREIGN KEY(Id_evenement) REFERENCES Evenement(Id_evenement),
   FOREIGN KEY(Id_hebergement) REFERENCES Hebergement(Id_hebergement)
);

CREATE TABLE accompagner(
   Id_user INT,
   Id_accompagne INT,
   PRIMARY KEY(Id_user, Id_accompagne),
   FOREIGN KEY(Id_user) REFERENCES Users(Id_user),
   FOREIGN KEY(Id_accompagne) REFERENCES Accompagne(Id_accompagne)
);

CREATE TABLE postuler(
   Id_user INT,
   Id_emploi INT,
   postule_date DATE,
   PRIMARY KEY(Id_user, Id_emploi),
   FOREIGN KEY(Id_user) REFERENCES Users(Id_user),
   FOREIGN KEY(Id_emploi) REFERENCES Emploi(Id_emploi)
);

CREATE TABLE regarder(
   Id_user INT,
   Id_hebergement INT,
   PRIMARY KEY(Id_user, Id_hebergement),
   FOREIGN KEY(Id_user) REFERENCES Users(Id_user),
   FOREIGN KEY(Id_hebergement) REFERENCES Hebergement(Id_hebergement)
);
