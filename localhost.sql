-- Base de données: `memoliste`
-- 
DROP DATABASE IF EXISTS annuaire;
CREATE DATABASE annuaire DEFAULT CHARACTER SET 'utf8';
USE annuaire;

-- --------------------------------------------------------

-- 
-- Structure de la table personne
-- 

DROP TABLE IF EXISTS personne;
CREATE TABLE IF NOT EXISTS personne (
    id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    nom varchar(50) default '',
    prenom varchar(50) default '',
    datecreation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    datemaj datetime,
  PRIMARY KEY  (id)
)  AUTO_INCREMENT=1 ;

-- 
-- Structure de la table adresse
-- 

DROP TABLE IF EXISTS adresse;
CREATE TABLE IF NOT EXISTS adresse (
    id_adresse SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    id_personne SMALLINT UNSIGNED NOT NULL DEFAULT 0,
    rue1 varchar(50) default '',
    rue2 varchar(50) default '',
    codepostal varchar(5) default '',
    ville varchar(50) default '',
    datecreation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    datemaj datetime,
  PRIMARY KEY  (id_adresse)
)  AUTO_INCREMENT=1 ;

-- 
-- Structure de la table telephone
-- 

DROP TABLE IF EXISTS telephone;
CREATE TABLE IF NOT EXISTS telephone (
    id_telephone SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    id_personne SMALLINT UNSIGNED NOT NULL,
    numero varchar(50) default '',
    typenumero varchar(10) default '',
    datecreation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    datemaj datetime,
  PRIMARY KEY  (id_telephone)
)  AUTO_INCREMENT=1 ;
