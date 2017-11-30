--
-- Base de données :  projet_vacataires
--
DROP DATABASE IF EXISTS projet_vacataires;
CREATE DATABASE projet_vacataires
DEFAULT CHARACTER SET utf8
DEFAULT COLLATE utf8_general_ci;
USE projet_vacataires;

-- --------------------------------------------------------

-- -----------------------
-- nettoyage des tables --
-- -----------------------
SET foreign_key_checks = 0;
DROP TABLE IF EXISTS batiment; 
DROP TABLE IF EXISTS document;
DROP TABLE IF EXISTS formation;
DROP TABLE IF EXISTS niveau;
DROP TABLE IF EXISTS matiere;
DROP TABLE IF EXISTS poste;
DROP TABLE IF EXISTS remuneration;
DROP TABLE IF EXISTS salle; 
DROP TABLE IF EXISTS sessions;
DROP TABLE IF EXISTS type;
DROP TABLE IF EXISTS utilisateur;
DROP TABLE IF EXISTS cours;

-- ----------------------
-- création des tables --
-- ----------------------
SET foreign_key_checks = 1;

--
-- Structure de la table batiment
--
CREATE TABLE IF NOT EXISTS batiment (
  idbatiment int(11) NOT NULL AUTO_INCREMENT,
  codebatiment varchar(2) NOT NULL,
  libellebatiment varchar(255) NOT NULL,
  PRIMARY KEY (idbatiment)
) ENGINE=InnoDB;

--
-- Structure de la table document
--
CREATE TABLE IF NOT EXISTS document (
  iddocument int(11) NOT NULL AUTO_INCREMENT,
  libelledocument varchar(255) NOT NULL,
  PRIMARY KEY (iddocument)
) ENGINE=InnoDB;

--
-- Structure de la table formation
--
CREATE TABLE IF NOT EXISTS formation (
  idformation varchar(255) NOT NULL,
  nomformation varchar(255) NOT NULL,
  responsable varchar(255) NOT NULL,
  secretaire varchar(255) NOT NULL,
  PRIMARY KEY (idformation)
) ENGINE=InnoDB;

--
-- Structure de la table niveau
--
CREATE TABLE IF NOT EXISTS niveau (
  idniveau int(11) NOT NULL AUTO_INCREMENT,
  nomniveau varchar(2) NOT NULL,
  PRIMARY KEY (idniveau)
) ENGINE=InnoDB;

--
-- Structure de la table nommatiere
--
CREATE TABLE IF NOT EXISTS nommatiere (
  idnommatiere int(11) NOT NULL AUTO_INCREMENT,
  intitulematiere varchar(255) NOT NULL,
  PRIMARY KEY (idnommatiere)
) ENGINE=InnoDB;

--
-- Structure de la table matiere
--
CREATE TABLE IF NOT EXISTS matiere (
  idmatiere int(11) NOT NULL AUTO_INCREMENT,
  intitulematiere int(11) NOT NULL,
  idformation varchar(255) NOT NULL,
  idniveau int(11) NOT NULL,
  PRIMARY KEY (idmatiere)
) ENGINE=InnoDB;

--
-- Structure de la table poste
--
CREATE TABLE IF NOT EXISTS poste (
  idposte int(5) NOT NULL,
  intituleposte varchar(50) NOT NULL,
  PRIMARY KEY (idposte)
) ENGINE=InnoDB;

--
-- Structure de la table remuneration
--
CREATE TABLE IF NOT EXISTS remuneration (
  idremuneration int(11) NOT NULL AUTO_INCREMENT,
  montantremuneration float(3,2) NOT NULL,
  dateremuneration date NOT NULL,
  PRIMARY KEY (idremuneration)
) ENGINE=InnoDB;

--
-- Structure de la table salle
--
CREATE TABLE IF NOT EXISTS salle (
  idsalle int(11) NOT NULL AUTO_INCREMENT,
  numerosalle varchar(11) NOT NULL,
  idbatiment int(11) NOT NULL,
  PRIMARY KEY (idsalle),
  KEY idbatiment (idbatiment)
)  ENGINE=InnoDB;


--
-- Structure de la table sessions
--
CREATE TABLE IF NOT EXISTS sessions (
  id int(11) NOT NULL AUTO_INCREMENT,
  sessionid varchar(255) NOT NULL,
  user_id varchar(255) NOT NULL,
  device varchar(255) NOT NULL,
  ip varchar(50) NOT NULL,
  datetime timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) ENGINE=InnoDB;


--
-- Structure de la table type
--
CREATE TABLE IF NOT EXISTS type (
  idtype int(3) NOT NULL AUTO_INCREMENT,
  libelletype varchar(255) NOT NULL,
  PRIMARY KEY (idtype)
) ENGINE=InnoDB AUTO_INCREMENT=4;


--
-- Structure de la table utilisateur
--
CREATE TABLE IF NOT EXISTS utilisateur (
  email varchar(100) NOT NULL,
  mdp varchar(50) NOT NULL,
  nom varchar(50) NOT NULL,
  prenom varchar(50) NOT NULL,
  poste int(2) NOT NULL,
  adresse varchar(250) DEFAULT NULL,
  datenaissance date DEFAULT NULL,
  tempid int(11) DEFAULT NULL,
  PRIMARY KEY (email)
) ENGINE=InnoDB;

--
-- Structure de la table cours
--
CREATE TABLE IF NOT EXISTS cours (
  idcours int(11) NOT NULL AUTO_INCREMENT,
  datecours date NOT NULL,
  heuredebutcours time NOT NULL,
  heurefincours time NOT NULL,
  idmatiere int(11) NOT NULL,
  idsalle int(11) NOT NULL,
  idtype int(11) NOT NULL,
  enseignant varchar(255) NOT NULL,
  PRIMARY KEY (idcours)
) ENGINE=InnoDB;

-- ------------------------------
-- gestion des clés étrangères --
-- ------------------------------
ALTER TABLE matiere ADD CONSTRAINT FK_idformation_matiere FOREIGN KEY (idformation) REFERENCES formation(idformation) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE matiere ADD CONSTRAINT FK_idniveau_matiere FOREIGN KEY (idniveau) REFERENCES niveau(idniveau) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE matiere ADD CONSTRAINT FK_idnommatiere_matiere FOREIGN KEY (intitulematiere) REFERENCES nommatiere(idnommatiere) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE salle ADD CONSTRAINT FK_idbatiment_salle FOREIGN KEY (idbatiment) REFERENCES batiment(idbatiment) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE cours ADD CONSTRAINT FK_enseignant_cours FOREIGN KEY (enseignant) REFERENCES utilisateur(email) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE cours ADD CONSTRAINT FK_idtype_cours FOREIGN KEY (idtype) REFERENCES type(idtype) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE cours ADD CONSTRAINT FK_idsalle_cours FOREIGN KEY (idsalle) REFERENCES salle(idsalle) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE cours ADD CONSTRAINT FK_idmatiere_cours FOREIGN KEY (idmatiere) REFERENCES matiere(idmatiere) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE formation ADD CONSTRAINT FK_responsable_formation FOREIGN KEY (responsable) REFERENCES utilisateur(email) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE formation ADD CONSTRAINT FK_secretaire_formation FOREIGN KEY (secretaire) REFERENCES utilisateur(email) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE utilisateur ADD CONSTRAINT FK_idposte_utilisateur FOREIGN KEY (poste) REFERENCES poste(idposte) ON DELETE CASCADE ON UPDATE CASCADE;
-- -------------------------
-- remplissage des tables --
-- -------------------------
--
-- Déchargement des données de la table batiment
--
INSERT INTO batiment (idbatiment, codebatiment, libellebatiment) VALUES
(1, 'E', 'CLAM'),
(2, 'I', 'ENSISA Lumière'),
(3, 'K', 'FST18');

--
-- Déchargement des données de la table salle
--
INSERT INTO salle (idsalle, numerosalle, idbatiment) VALUES
(1, '107', 3),
(2, '37', 2),
(3, '4', 1),
(4, 'A', 1),
(5, 'Amphi A', 3),
(6, 'Amphi GB', 3),
(7, 'Labo', 1);


--
-- Déchargement des données de la table poste
--
INSERT INTO poste (idposte, intituleposte) VALUES
(1, 'Vacataire'),
(2, 'Responsable Formation'),
(3, 'Responsable Administratif'),
(4, 'Contrôle de Gestion'),
(5, 'Responsable Financier');

--
-- Déchargement des données de la table type
--
INSERT INTO type (idtype, libelletype) VALUES
(1, 'TD'),
(2, 'TP'),
(3, 'CM'),
(4, 'Examen');

--
-- Déchargement des données de la table utilisateur
--
INSERT INTO utilisateur (email, mdp, nom, prenom, poste, adresse, datenaissance, tempid) VALUES
('bruno.adam@uha.fr', '3f9a7149b08b11538c9210e9d202ad1b', 'Adam', 'Bruno', 2, 'adresse renseignée par bruno adam', '1970-02-02', 0),
('jessica.blyet@uha.fr', 'a7735c4780885a5cd06085e13289d81d', 'Blyet', 'Jessica', 4, '', '1991-04-04', NULL),
('lionel.signolet@uha.fr', 'caa4809b8ab788afde5c3b22e209ca26', 'Signolet', 'Lionel', 5, '', '1974-05-05', NULL),
('patricia.bonte@uha.fr', '6e41125b44e89615a477440ce0a24008', 'Bonte', 'Patricia', 3, '', '1980-03-03', NULL),
('joel.heinis@uha.fr', '5aa93f42a1ff6635b542a50f94fd8e16', 'Heinis', 'Joel', 1, '', '1978-01-01', NULL),
('mahmoud.melkemi@uha.fr', '5337b8eb7a6f3897b0b7e56a94963f05', 'Mahmoud', 'Melkemi', 2, '', '1942-02-02', NULL),
('evelyne.ducrot@uha.fr', 'dfb6b5fd7a9440e77eb6e4a4bf6925c8', 'Evelyne', 'Ducrot', 2, '', '1978-02-02', NULL),
('enrico.monti@uha.fr', '8e38b58c61f6441e10665dfb77e62832', 'Enrico', 'Monti', 2, '', '1968-02-02', NULL),
('alexandre.binder@uha.fr', 'd53a8cb881ea1f8962d2cabae804f91b', 'Binder', 'Alexandre', 1, '27 Avenue DMC 68200 Mulhouse', '1991-03-12', NULL),
('thierry.sahler@uha.fr', 'b55740fca1ac693097824d2f1634b5cd', 'Sahler', 'Thierry', 1, '', '1965-01-01', NULL),
('julie.ehmer@uha.fr', '1d1c6e8664b45442adc8cd2a52a1a83c', 'Ehmer', 'Julie', 3, '', '1980-03-03', NULL),
('pierrette.figenwald@uha.fr', '9a901060ebafa6fd6ad3991bb5d1a112', 'Figenwald', 'Pierrette', 3, '', '1980-03-03', NULL);


--
-- Déchargement des données de la table formation
--
INSERT INTO formation (idformation, nomformation, responsable, secretaire) VALUES
('AGEC', 'Administration et Gestion des Entreprises Culturelles', 'evelyne.ducrot@uha.fr', 'julie.ehmer@uha.fr'),
('IMR', 'Informatique Mobile et Répartie', 'mahmoud.melkemi@uha.fr', 'patricia.bonte@uha.fr'),
('LEA', 'Langues Étrangères Appliquées ', 'enrico.monti@uha.fr', 'pierrette.figenwald@uha.fr'),
('MIAGE', 'Méthodes Informatiques Appliquées à la Gestion d\'Entreprise', 'bruno.adam@uha.fr', 'patricia.bonte@uha.fr');


--
-- Déchargement des données de la table niveau
--
INSERT INTO niveau (idniveau, nomniveau) VALUES
(1, 'L1'),
(2, 'L2'),
(3, 'L3'),
(4, 'M1'),
(5, 'M2');

--
-- Déchargement des données de la table nommatiere
--
INSERT INTO nommatiere (idnommatiere, intitulematiere) VALUES
(1, 'Architecture N-Tiers'),
(2, 'Anglais'),
(3, 'Contrôle de Gestion'),
(4, 'Langages Formels');


--
-- Déchargement des données de la table matiere
--
INSERT INTO matiere (idmatiere, intitulematiere, idformation, idniveau) VALUES
(1, 1, 'MIAGE', 4),
(2, 1, 'IMR', 4),
(3, 3, 'MIAGE', 4),
(4, 4, 'IMR', 4),
(5, 2, 'MIAGE', 4),
(6, 2, 'IMR', 4),
(7, 2, 'LEA', 1);

--
-- Déchargement des données de la table cours
--
INSERT INTO cours (idcours, datecours, heuredebutcours, heurefincours, idmatiere, idsalle, idtype, enseignant) VALUES
(1, '2017-12-09', '08:00:00', '12:00:00', 1, 1, 1, 'joel.heinis@uha.fr'),
(2, '2017-12-16', '08:00:00', '10:00:00', 1, 1, 1, 'joel.heinis@uha.fr'),
(3, '2017-12-16', '10:00:00', '12:00:00', 1, 1, 4, 'joel.heinis@uha.fr'),
(4, '2017-12-09', '08:00:00', '12:00:00', 2, 1, 1, 'joel.heinis@uha.fr'),
(5, '2017-12-16', '08:00:00', '10:00:00', 2, 1, 1, 'joel.heinis@uha.fr'),
(6, '2017-12-16', '10:00:00', '12:00:00', 2, 1, 4, 'joel.heinis@uha.fr'),
(7, '2017-12-08', '08:00:00', '12:00:00', 3, 1, 3, 'thierry.sahler@uha.fr');