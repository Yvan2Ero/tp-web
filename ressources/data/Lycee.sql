-- Base de donnees pour le site de gestion des eleves d'un lycee
-- Creation de la base de donnees

DROP DATABASE IF EXISTS Lycee;

CREATE DATABASE Lycee CHARACTER SET 'utf8';
USE Lycee;
-- **********************************************************************************
-- Creation de la table des supers-administrateurs

CREATE TABLE superadmin(

    admin_id          INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    admin_user_name   VARCHAR(100)  NOT NULL,
    admin_password_1  VARCHAR(1000)  NOT NULL,
    admin_password_2  VARCHAR(1000)  NOT NULL
)engine=InnoDB;
-- insertion du super-admin

INSERT INTO superadmin(admin_user_name, admin_password_1, admin_password_2)
VALUES('principale1','principale1_pwd1','principale1_pwd2');

-- Creation de la table proffesseur

CREATE TABLE professeur(

    nom_prof         VARCHAR(100),
    prenom_prof      VARCHAR(100),
    email_prof       VARCHAR(100),
    prof_login       VARCHAR(100),
    prof_password    VARCHAR(1000),
    id_prof          INT NOT NULL AUTO_INCREMENT PRIMARY KEY

          )engine=InnoDB;
DESCRIBE professeur;

-- AJOUT DES PROFESSEURS
INSERT INTO professeur(nom_prof, prenom_prof, email_prof, prof_login, prof_password) VALUES
('Temgoua','Jean','jean@email.com','Jean_user',SHA1('jean_pwd'));
INSERT INTO professeur(nom_prof, prenom_prof, email_prof, prof_login, prof_password) VALUES
 ('Kenfack','Etienne','etiene@gmail.com','Erienne_user', SHA1('etienne_pwd'));
 INSERT INTO professeur(nom_prof, prenom_prof, email_prof, prof_login, prof_password) VALUES
('Manfo','Roger', 'roger@email.com', 'Roger_user', SHA1('roger_pwd'));
 INSERT INTO professeur(nom_prof, prenom_prof, email_prof, prof_login, prof_password) VALUES
('Kasso','Robert', 'robert@email.com', 'Robert_user', SHA1('robert_pwd'));
 INSERT INTO professeur(nom_prof, prenom_prof, email_prof, prof_login, prof_password) VALUES
('Tennesso','Douglasse','douglasse@email.com', 'Douglasse_user', SHA1('douglasse_pwd'));
 INSERT INTO professeur(nom_prof, prenom_prof, email_prof, prof_login, prof_password) VALUES
('Tchwang','Appolinaire','appolinaire@email.com', 'Appolinaire', SHA1('appolinaire'));
 INSERT INTO professeur(nom_prof, prenom_prof, email_prof, prof_login, prof_password) VALUES
('Kwasso','Rene','rene@email.com', 'Rene_user', SHA1('Rene_pwd'));
 INSERT INTO professeur(nom_prof, prenom_prof, email_prof, prof_login, prof_password) VALUES
('Temsuate','Joseph','joseph@email.com', 'Joseph', SHA1('joseph_pwd'));
 INSERT INTO professeur(nom_prof, prenom_prof, email_prof, prof_login, prof_password) VALUES
('Azangue','Florent','florent@email.com', 'Florent_user', SHA1('florent_pwd'));
 INSERT INTO professeur(nom_prof, prenom_prof, email_prof, prof_login, prof_password) VALUES
 ('Janze','Laurine','laurine@email.com', 'Laurine_user', SHA1('laurine_pwd'));
 INSERT INTO professeur(nom_prof, prenom_prof, email_prof, prof_login, prof_password) VALUES
('Momo','Joceline','joceline@email.com', 'Joceline_user', SHA1('joceline_pwd'));
 INSERT INTO professeur(nom_prof, prenom_prof, email_prof, prof_login, prof_password) VALUES
 ('Temeze','Madelene','madelene@email.com', 'Madelene_user', SHA1('madelene_pwd'));
 INSERT INTO professeur(nom_prof, prenom_prof, email_prof, prof_login, prof_password) VALUES
 ('Kemze', 'Jessica', 'jessica@email.com', 'Jessica_user', SHA1('jessica_pwd'));
 INSERT INTO professeur(nom_prof, prenom_prof, email_prof, prof_login, prof_password) VALUES
 ('Tazoh','Patty','patty@email.com', 'Patty_user', SHA1('patty_pwd'));
 INSERT INTO professeur(nom_prof, prenom_prof, email_prof, prof_login, prof_password) VALUES
('Tadmon','Eric','eric@email.com','Eric_user', SHA1('eric_pwd'));
-- **********************************************************************************
-- Creation de la table classe

CREATE TABLE classe(
                    nom_classe VARCHAR(20) NOT NULL PRIMARY KEY,
                    id_prof_titulaire    INT,
                    CONSTRAINT fk_classe_professeur
                    FOREIGN KEY (id_prof_titulaire) REFERENCES professeur(id_prof)
                    )engine=InnoDB;
DESCRIBE classe;

-- AJOUT DES CLASSES DANS LA TABLE
INSERT INTO classe (nom_classe, id_prof_titulaire) VALUES ('6eme',1);
INSERT INTO classe (nom_classe, id_prof_titulaire) VALUES ('5eme',2);
INSERT INTO classe (nom_classe, id_prof_titulaire) VALUES ('4eme All',3);
INSERT INTO classe (nom_classe, id_prof_titulaire) VALUES ('4eme Esp',4);
INSERT INTO classe (nom_classe, id_prof_titulaire) VALUES ('3eme All',5);
INSERT INTO classe (nom_classe, id_prof_titulaire) VALUES ('3eme Esp',6);
INSERT INTO classe (nom_classe, id_prof_titulaire) VALUES ('2nde C',7);
INSERT INTO classe (nom_classe, id_prof_titulaire) VALUES ('2nde A',8);
INSERT INTO classe (nom_classe, id_prof_titulaire) VALUES ('1ere C',9);
INSERT INTO classe (nom_classe, id_prof_titulaire) VALUES ('1ere D',10);
INSERT INTO classe (nom_classe, id_prof_titulaire) VALUES ('1ere A',11);
INSERT INTO classe (nom_classe, id_prof_titulaire) VALUES ('Tle C',12);
INSERT INTO classe (nom_classe, id_prof_titulaire) VALUES ('Tle D',13);
INSERT INTO classe (nom_classe, id_prof_titulaire) VALUES ('Tle A',14);
-- **********************************************************************************
-- creation de la table eleve

CREATE TABLE eleve(
                nom_eleve       VARCHAR(100) NOT NULL,
                prenom_eleve    VARCHAR(100) NOT NULL,
                id_eleve        INT(4) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                date_naiss      DATE DEFAULT NOW(),
                lieu_naiss      VARCHAR(40),
                annee_arrive    DATE DEFAULT NOW(),
                nom_classe      VARCHAR(15),
                mot_de_passe    VARCHAR(300),
                avatar_eleve    VARCHAR(255),
                matricule       VARCHAR(100),
                sexe            ENUM('Masculin','Feminin'),
                CONSTRAINT fk_eleve_classe
                FOREIGN KEY (nom_classe) REFERENCES classe(nom_classe)
                )engine=InnoDB;
DESCRIBE eleve;

 -- AJOUT DES ELEVES
INSERT INTO eleve (nom_eleve,prenom_eleve, matricule, date_naiss, lieu_naiss,sexe, nom_classe, mot_de_passe)
VALUES ('Tasso','Loic','eleve1','2000-01-05','Dschang','Masculin','Tle C', SHA1('tasso_pwd')),
       ('Kana','Guy','eleve2','2003-05-30','Doumbouo','Masculin','1ere D', SHA1('kana_pwd')),
       ('Koumbo','Laura','eleve4','1997-05-10','Batonga','Feminin','1ere D', SHA1('koumbo'));

-- **********************************************************************************
-- Creation de la table cours

CREATE TABLE cours(
                    nom_cours   VARCHAR(50) NOT NULL,
                    id_prof    INT NOT NULL,
                    nom_classe  VARCHAR(15),
                    CONSTRAINT fk_cours_professeur
                    FOREIGN KEY (id_prof) REFERENCES professeur(id_prof),
                    CONSTRAINT fk_cours_classe
                    FOREIGN KEY (nom_classe) REFERENCES classe(nom_classe),
                    CONSTRAINT pk_cours
                    PRIMARY KEY (nom_cours,nom_classe)
                    )engine=InnoDB;
DESCRIBE cours;

-- INSERTION DES COURS

-- EN 6EME
INSERT INTO cours (nom_cours, id_prof, nom_classe)
VALUES ('Histoire-Geographie',1,'6eme'),
        ('Education-Civique',2,'6eme'),
        ('Mathematique',3,'6eme'),
        ('Informatique',4,'6eme'),
        ('Francais',5,'6eme'),
        ('Anglais',6,'6eme');
-- EN 5EME
INSERT INTO cours (nom_cours, id_prof, nom_classe)
VALUES ('Histoire-Geographie',1,'5eme'),
        ('Education-Civique',2,'5eme'),
        ('Mathematique',3,'5eme'),
        ('Informatique',4,'5eme'),
        ('Francais',5,'5eme'),
        ('Anglais',6,'5eme');
-- EN 4EME
--    4eme A
INSERT INTO cours (nom_cours, id_prof, nom_classe)
VALUES ('Histoire-Geographie',1,'4eme All'),
        ('Education-Civique',2,'4eme All'),
        ('Mathematique',3,'4eme All'),
        ('Informatique',4,'4eme All'),
        ('Francais',5,'4eme All'),
        ('Anglais',6,'4eme All'),
        ('Allemand',7,'4eme All')
        ;
--    4eme E

INSERT INTO cours (nom_cours, id_prof, nom_classe)
VALUES ('Histoire-Geographie',1,'4eme Esp'),
        ('Education-Civique',2,'4eme Esp'),
        ('Mathematique',3,'4eme Esp'),
        ('Informatique',4,'4eme Esp'),
        ('Francais',5,'4eme Esp'),
        ('Anglais',6,'4eme Esp'),
        ('Espagnol',7,'4eme Esp')
        ;
-- EN 3EME
--    3eme A
INSERT INTO cours (nom_cours, id_prof, nom_classe)
VALUES ('Histoire-Geographie',1,'3eme All'),
        ('Education-Civique',2,'3eme All'),
        ('Mathematique',3,'3eme All'),
        ('Informatique',4,'3eme All'),
        ('Francais',5,'3eme All'),
        ('Anglais',6,'3eme All'),
        ('Allemand',7,'3eme All')
        ;
--    3eme E

INSERT INTO cours (nom_cours, id_prof, nom_classe)
VALUES ('Histoire-Geographie',1,'3eme Esp'),
        ('Education-Civique',2,'3eme Esp'),
        ('Mathematique',3,'3eme Esp'),
        ('Informatique',4,'3eme Esp'),
        ('Francais',5,'3eme Esp'),
        ('Anglais',6,'3eme Esp'),
        ('Espagnol',7,'3eme Esp')
        ;
-- EN 2NDE
--   2nde C
INSERT INTO cours (nom_cours, id_prof, nom_classe)
VALUES ('Histoire-Geographie',8,'2nde C'),
        ('Education-Civique',8,'2nde C'),
        ('Mathematique',9,'2nde C'),
        ('Informatique',10,'2nde C'),
        ('Francais',11,'2nde C'),
        ('Anglais',12,'2nde C'),
        ('Chimie',13,'2nde C'),
        ('Physique',14,'2nde C')
        ;
--    2ende A
INSERT INTO cours (nom_cours, id_prof, nom_classe)
VALUES ('Histoire-Geographie',8,'2nde A'),
        ('Education-Civique',8,'2nde A'),
        ('Mathematique',9,'2nde A'),
        ('Informatique',10,'2nde A'),
        ('Francais',11,'2nde A'),
        ('Anglais',12,'2nde A'),
        ('Physique-Chimie',13,'2nde A'),
        ('Allemand',7,'2nde A'),
        ('Espagnol',7,'2nde A')
        ;
-- EN 1ERE
--    1ere C
INSERT INTO cours (nom_cours, id_prof, nom_classe)
VALUES ('Histoire-Geographie',8,'1ere C'),
        ('Education-Civique',8,'1ere C'),
        ('Mathematique',9,'1ere C'),
        ('Informatique',10,'1ere C'),
        ('Francais',11,'1ere C'),
        ('Anglais',12,'1ere C'),
        ('Chimie',13,'1ere C'),
        ('Physique',14,'1ere C')
        ;
--    1ere D
INSERT INTO cours (nom_cours, id_prof, nom_classe)
VALUES ('Histoire-Geographie',8,'1ere D'),
        ('Education-Civique',8,'1ere D'),
        ('Mathematique',9,'1ere D'),
        ('Informatique',10,'1ere D'),
        ('Francais',11,'1ere D'),
        ('Anglais',12,'1ere D'),
        ('Chimie',13,'1ere D'),
        ('Physique',14,'1ere D')
        ;
--    1ere A
INSERT INTO cours (nom_cours, id_prof, nom_classe)
VALUES ('Histoire-Geographie',8,'1ere A'),
        ('Education-Civique',8,'1ere A'),
        ('Mathematique',9,'1ere A'),
        ('Informatique',10,'1ere A'),
        ('Francais',11,'1ere A'),
        ('Anglais',12,'1ere A'),
        ('Physique-Chimie',13,'1ere A'),
        ('Allemand',7,'1ere A'),
        ('Espagnol',7,'1ere A');
-- EN TLE
--    Tle C
INSERT INTO cours (nom_cours, id_prof, nom_classe)
VALUES ('Histoire-Geographie',8,'Tle C'),
        ('Education-Civique',8,'Tle C'),
        ('Mathematique',9,'Tle C'),
        ('Informatique',10,'Tle C'),
        ('Francais',11,'Tle C'),
        ('Anglais',12,'Tle C'),
        ('Chimie',13,'Tle C'),
        ('Physique',14,'Tle C'),
        ('Phylosophie',15,'Tle C')
        ;
--    Tle D
INSERT INTO cours (nom_cours, id_prof, nom_classe)
VALUES ('Histoire-Geographie',8,'Tle D'),
        ('Education-Civique',8,'Tle D'),
        ('Mathematique',9,'Tle D'),
        ('Informatique',10,'Tle D'),
        ('Francais',11,'Tle D'),
        ('Anglais',12,'Tle D'),
        ('Chimie',13,'Tle D'),
        ('Physique',14,'Tle D'),
        ('Phylosophie',15,'Tle D')
        ;
--    Tle A
INSERT INTO cours (nom_cours, id_prof, nom_classe)
VALUES ('Histoire-Geographie',8,'Tle A'),
        ('Education-Civique',8,'Tle A'),
        ('Mathematique',9,'Tle A'),
        ('Informatique',10,'Tle A'),
        ('Francais',11,'Tle A'),
        ('Anglais',12,'Tle A'),
        ('Allemand',7,'Tle A'),
        ('Espagol',7,'Tle A'),
        ('Phylosophie',15,'Tle A')
        ;
-- **********************************************************************************
-- Creation de l'entite Note
CREATE TABLE note(
                        id_eleve        INT(4) NOT NULL,
                        nom_matiere     VARCHAR(50) NOT NULL,
                        annee_scolaire  DATE NOT NULL DEFAULT NOW(),
                        trimestre       ENUM('1','2','3') NOT NULL,
                        valeur          FLOAT,
                        CONSTRAINT fk_note_cours
                        FOREIGN KEY (nom_matiere) REFERENCES cours(nom_cours),
                        CONSTRAINT ft_note_eleve
                        FOREIGN KEY (id_eleve) REFERENCES eleve(id_eleve)
                        )engine=innodb;
DESCRIBE note;
-- **********************************************************************************
-- POUR LES ECOLES SUPERIEURS
