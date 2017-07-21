CREATE DATABASE IF NOT EXISTS lokisalle;

USE lokisalle;

CREATE TABLE salle(
	id_salle INT(3) NOT NULL AUTO_INCREMENT,
	titre VARCHAR(200) NOT NULL,
    description TEXT NOT NULL,
    photo VARCHAR(200) NOT NULL,
    pays VARCHAR(50) NOT NULL,
    ville VARCHAR(20) NOT NULL,
    cp INT(5) NOT NULL,
    categorie ENUM('reunion','bureau', 'formation'),
	PRIMARY KEY(id_salle)
) ENGINE=InnoDB;

CREATE TABLE produit(
	id_produit INT(3) NOT NULL AUTO_INCREMENT,
    id_salle INT(3)NOT NULL,
	date_arrive DATETIME NOT NULL,
    date_depart DATETIME NOT NULL,
    prix INT(3) NOT NULL,
    etat ENUM('libre','reservation'),
	PRIMARY KEY(id_produit)
)ENGINE=InnoDB;

CREATE TABLE commande(
	id_commande INT(3) NOT NULL AUTO_INCREMENT,
	id_membre  INT(3) NOT NULL,
	id_produit  INT(3) NOT NULL,
	date_enregistrement DATETIME NOT NULL,
	PRIMARY KEY(id_commande)
) ENGINE=InnoDB;

CREATE TABLE avis(
	id_avis INT(3) NOT NULL AUTO_INCREMENT,
	id_membre  INT(3) NOT NULL,
    id_salle INT(3) NOT NULL,
    commentaire TEXT NOT NULL,
    note INT(3) NOT NULL,
    date_enregistrement DATETIME NOT NULL,
	PRIMARY KEY(id_avis)
) ENGINE=InnoDB;

CREATE TABLE membre(
	id_membre INT(3) NOT NULL AUTO_INCREMENT,
    pseudo VARCHAR (20) NOT NULL,
    mdp VARCHAR(60) NOT NULL,
    nom VARCHAR(20) NOT NULL,
    prenom VARCHAR(20) NOT NULL,
    email VARCHAR(50) NOT NULL,
    civilite ENUM ('homme','femme'),
    statut INT(1) NOT NULL,
    date_enregistrement DATETIME NOT NULL,
	PRIMARY KEY(id_membre)
) ENGINE=InnoDB;
