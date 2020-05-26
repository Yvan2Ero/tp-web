-- RECREATION DE LA BASE DE DONNEES

DROP DATABASE IF EXISTS Forum;
CREATE DATABASE Forum CHARACTER SET 'utf8';

USE Forum;
-- CREATION DE LA TABLE DES UTLISATEURS CONNECTES
CREATE TABLE users_reseau(
                            user_avatar     VARCHAR(100),
                            user_pseudo     VARCHAR(100) NOT NULL UNIQUE,
                            user_email      VARCHAR(100) NOT NULL UNIQUE,
                            user_id         INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                            user_password   VARCHAR(15) NOT NULL
)engine=InnoDB;



-- INSERTION DES USERS PAR DEFAUT


INSERT INTO users_reseau (user_pseudo, user_email, user_avatar, user_password)
VALUES ('toto','toto@titi', '1.jpg', 'tototiti');

CREATE TABLE categorie_resau(
                                categorie_id      INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                                categorie_nom    VARCHAR(70) NOT NULL
)engine = InnoDB;
-- AJOUT DES CATEGORIE PAR DEFAUT

INSERT INTO categorie_resau (categorie_nom)
VALUES ('Informatique'),('Ammusement'),('Renseignements');

-- CREATIONDE LA TABLE DES SUJETS

CREATE TABLE sujets_reseau(
                            sujet_id    INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                            nom_categorie VARCHAR(100),
                            sujet_nom   VARCHAR(100) NOT NULL
)engine = InnoDB;

-- CREATION DE LA TABLE DES POSTS SUR UN SUJET

CREATE TABLE posts_reseau(
                            id_post         INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                            pseudo_autor    VARCHAR(100) NOT NULL,
                            sujet_nom       VARCHAR(100) NOT NULL,
                            contenu_post    TEXT NOT NULL,
                            date_post       DATETIME NOT NULL
)engine = InnoDB;