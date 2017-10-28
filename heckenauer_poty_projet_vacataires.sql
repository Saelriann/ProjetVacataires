--
-- Base de données :  projet_vacataires
--
DROP DATABASE IF EXISTS projet_vacataires;
CREATE DATABASE projet_vacataires
DEFAULT CHARACTER SET utf8
DEFAULT COLLATE utf8_general_ci;
USE projet_vacataires;
-- --------------------------------------------------------

--
-- Structure de la table batiment
--

DROP TABLE IF EXISTS batiment;
CREATE TABLE IF NOT EXISTS batiment (
  idbatiment int(11) NOT NULL AUTO_INCREMENT,
  libellebatiment varchar(255) NOT NULL,
  PRIMARY KEY (idbatiment)
) ENGINE=InnoDB;

-- --------------------------------------------------------

--
-- Structure de la table cours
--

DROP TABLE IF EXISTS cours;
CREATE TABLE IF NOT EXISTS cours (
  idcours int(11) NOT NULL AUTO_INCREMENT,
  datecours date NOT NULL,
  heuredebutcours time NOT NULL,
  heurefincours time NOT NULL,
  idmatiere int(11) NOT NULL,
  idsalle int(11) NOT NULL,
  idtype int(11) NOT NULL,
  email int(11) NOT NULL,
  PRIMARY KEY (idcours)
) ENGINE=InnoDB;

-- --------------------------------------------------------

--
-- Structure de la table document
--

DROP TABLE IF EXISTS document;
CREATE TABLE IF NOT EXISTS document (
  iddocument int(11) NOT NULL AUTO_INCREMENT,
  libelledocument varchar(255) NOT NULL,
  PRIMARY KEY (iddocument)
) ENGINE=InnoDB;

-- --------------------------------------------------------

--
-- Structure de la table matiere
--

DROP TABLE IF EXISTS matiere;
CREATE TABLE IF NOT EXISTS matiere (
  idmatiere int(11) NOT NULL AUTO_INCREMENT,
  intitulematiere varchar(255) NOT NULL,
  PRIMARY KEY (idmatiere)
) ENGINE=InnoDB;

-- --------------------------------------------------------

--
-- Structure de la table poste
--

DROP TABLE IF EXISTS poste;
CREATE TABLE IF NOT EXISTS poste (
  idposte int(5) NOT NULL,
  intituleposte varchar(50) NOT NULL,
  PRIMARY KEY (idposte)
) ENGINE=InnoDB;

--
-- Déchargement des données de la table poste
--

INSERT INTO poste (idposte, intituleposte) VALUES
(1, 'Vacataire'),
(2, 'Responsable Formation'),
(3, 'Responsable Administratif'),
(4, 'Contrôle de Gestion'),
(5, 'Responsable Financier');

-- --------------------------------------------------------

--
-- Structure de la table remuneration
--

DROP TABLE IF EXISTS remuneration;
CREATE TABLE IF NOT EXISTS remuneration (
  idremuneration int(11) NOT NULL AUTO_INCREMENT,
  montantremuneration float(3,2) NOT NULL,
  dateremuneration date NOT NULL,
  PRIMARY KEY (idremuneration)
) ENGINE=InnoDB;

-- --------------------------------------------------------

--
-- Structure de la table salle
--

DROP TABLE IF EXISTS salle;
CREATE TABLE IF NOT EXISTS salle (
  idsalle int(11) NOT NULL AUTO_INCREMENT,
  libellesalle varchar(255) NOT NULL,
  idbatiment int(11) NOT NULL,
  PRIMARY KEY (idsalle)
) ENGINE=InnoDB;

-- --------------------------------------------------------

--
-- Structure de la table sessions
--

DROP TABLE IF EXISTS sessions;
CREATE TABLE IF NOT EXISTS sessions (
  id int(11) NOT NULL AUTO_INCREMENT,
  sessionid varchar(255) NOT NULL,
  user_id varchar(255) NOT NULL,
  device varchar(255) NOT NULL,
  ip varchar(50) NOT NULL,
  datetime timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) ENGINE=InnoDB AUTO_INCREMENT=64;

--
-- Déchargement des données de la table sessions
--

INSERT INTO sessions (id, sessionid, user_id, device, ip, datetime) VALUES
(63, '83da33abc393f1e', 'bruno.adam@uha.fr', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:56.0) Gecko/20100101 Firefox/56.0', '::1', '2017-10-28 16:50:34');

-- --------------------------------------------------------

--
-- Structure de la table type
--

DROP TABLE IF EXISTS type;
CREATE TABLE IF NOT EXISTS type (
  idtype int(3) NOT NULL AUTO_INCREMENT,
  libelletype varchar(255) NOT NULL,
  PRIMARY KEY (idtype)
) ENGINE=InnoDB AUTO_INCREMENT=4;

--
-- Déchargement des données de la table type
--

INSERT INTO type (idtype, libelletype) VALUES
(1, 'TD'),
(2, 'TP'),
(3, 'CM');

-- --------------------------------------------------------

--
-- Structure de la table utilisateur
--

DROP TABLE IF EXISTS utilisateur;
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
-- Déchargement des données de la table utilisateur
--

INSERT INTO utilisateur (email, mdp, nom, prenom, poste, adresse, datenaissance, tempid) VALUES
('bruno.adam@uha.fr', '3f9a7149b08b11538c9210e9d202ad1b', 'Adam', 'Bruno', 2, 'adresse renseignée par bruno adam', '1970-10-02', 0),
('jessica.blyet@uha.fr', 'a7735c4780885a5cd06085e13289d81d', 'Blyet', 'Jessica', 4, '', '1991-02-01', NULL),
('lionel.signolet@uha.fr', 'caa4809b8ab788afde5c3b22e209ca26', 'Signolet', 'Lionel', 5, '', '1974-08-10', NULL),
('patricia.bonte@uha.fr', '6e41125b44e89615a477440ce0a24008', 'Bonte', 'Patricia', 3, '', '1980-12-31', NULL);