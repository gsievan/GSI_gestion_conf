-- novembre 2008
-- Version du serveur: 5.0.18


-- --------------------------------------------------------
GRANT ALL ON jpe . * TO 'jpe'@'localhost' IDENTIFIED BY 'jpe';

DROP TABLE IF EXISTS `visite`;
DROP TABLE IF EXISTS `entreprise`;
DROP TABLE IF EXISTS `inscription`;
DROP TABLE IF EXISTS `activite`;
-- 
-- Structure de la table `activite`
-- 

CREATE TABLE activite
(
  id int(11) NOT NULL auto_increment,
  libelle  varchar(50) NOT NULL,
  PRIMARY KEY  (id)
) 
ENGINE = INNODB AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

-- 
-- Structure de la table `entreprise`
-- 

CREATE TABLE entreprise 
(
  id int(11) NOT NULL auto_increment,
  raisonSociale varchar(50) NOT NULL default '',
  adresse varchar(50) NOT NULL default '',
  ville varchar(30) NOT NULL default '',
  cp varchar(5) NOT NULL,
  nomResponsable varchar(30) NOT NULL default '',
  nomContact varchar(30) NOT NULL default '',
  telContact varchar(14) NOT NULL,
  site varchar(50) default NULL,
  effectif int(11) default NULL,
  idActivite int(11) NOT NULL,
  PRIMARY KEY  (id),
  constraint fk_activite foreign key(idActivite) references activite(id) 
) 
ENGINE=INNODB AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

-- 
-- Structure de la table `visite`
-- 

CREATE TABLE visite 
(
   id int(11) NOT NULL auto_increment,
   dateV date NOT NULL,
   heureDebut varchar(12) NOT NULL default '',
   duree varchar(12) NOT NULL default '',
   description varchar(500) NOT NULL,
   nbPlacesMax int(11) NOT NULL default '0',
   nbPlacesMin int(11) NOT NULL default '0',
   visiteAnnulee boolean NOT NULL default '0',
   nbVisiteursInscrits int(11) NOT NULL default '0',
   idEntreprise int(11) NOT NULL default '0',
  PRIMARY KEY  (id),
  constraint fk_entreprise foreign key(idEntreprise) references entreprise(id) 
) 
ENGINE=INNODB AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

-- 
-- Structure de la table `inscription`
-- 

CREATE TABLE inscription 
(
   id int(11) NOT NULL auto_increment,
   nom varchar(50) NOT NULL default '',
   prenom varchar(50) NOT NULL default '',	
   tel varchar(12) default NULL,
   cp varchar(5) NOT NULL,
   nbPersonnes int(11) NOT NULL,
   idVisite int(11) ,
  PRIMARY KEY  (id),
  constraint fk_visite foreign key(idVisite) references visite(id)
) 
ENGINE=INNODB AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Insertions des lignes
-- 

INSERT INTO activite VALUES ('', 'Assurance');
INSERT INTO activite VALUES ('', 'Commerce');
INSERT INTO activite VALUES ('', 'Travaux public');
INSERT INTO activite VALUES ('', 'Industrie');




INSERT INTO entreprise VALUES ('','BatiRefect', 'Route de Paris', 'Bergerac', '24100', 'Monsieur Pontel', 'Jean Durand', '0512131415','',250, 3);
INSERT INTO entreprise VALUES ('','Brossette', 'Bd de l''Atlantique', 'Bergerac', '241007', 'Monsieur Ramy', 'Jules renard', '0510101012','',  50,1);
INSERT INTO entreprise VALUES ('','Aluminium de Dordogne', 'ZI de Périgueux', 'Périgueux', '24000', 'Madame Parmielle', 'France Binard', '0513420712','', 50,4);
INSERT INTO entreprise VALUES ('','MAGIF', '45 Bd de l''Ouest', 'Bergerac', '241007', 'Madame Chymene', 'Yves Polard', '0514457893','',  150,1);
INSERT INTO entreprise VALUES ('','Carrefour', 'ZI de Périgueux', 'Périgueux', '24000', 'Monsieur Piedblanc', 'Anne Zrari', '0524579812','', 350,2);
INSERT INTO entreprise VALUES ('','Le Nouveau Comptoir', 'Avenue Auguste Blanqui', 'Périgueux', '24000', 'Monsieur Barron', 'Annie Demarque', '0532899899','', 50,2);
INSERT INTO entreprise VALUES ('','InfoDev', '12 Avenue Aristide Briand', 'Périgueux', '24000', 'Monsieur hardy', 'Jean lassalle', '0578945653','', 25,4);


INSERT INTO visite VALUES ('', '2008/10/20', '10h', '1h30','Visite de l''entrepot', 15, 10,  0, 0, 1);
INSERT INTO visite VALUES ('', '2008/10/18', '8H', '1h', 'Visite du magasin',20, 10,  0, 0, 2);
INSERT INTO visite VALUES ('', '2008/10/18', '15h', '1h30','Visite des bureaux', 25, 10,  0, 0, 3);
INSERT INTO visite VALUES ('', '2008/10/18', '10H', '1h','Visite du SI', 20, 10,  0, 0, 2);
INSERT INTO visite VALUES ('', '2008/10/20', '10h', '1h30','Visite de l''entrepot', 35, 10, 0, 0, 5);
INSERT INTO visite VALUES ('', '2008/10/20', '8H', '1h','Visite des stoks', 20, 10, 0, 0, 2);
INSERT INTO visite VALUES ('', '2008/10/21', '15h', '1h30','Visite des bureaux', 10, 2, 0, 0, 4);
INSERT INTO visite VALUES ('', '2008/10/20', '14H', '2h','Présentation du SI', 20, 10, 0, 0, 4);
INSERT INTO visite VALUES ('', '2008/10/21', '10H', '2h','Visite des locaux', 30, 10, 0, 0, 6);
INSERT INTO visite VALUES ('', '2008/10/21', '15H', '2h','Visite des locaux', 25, 5, 0, 0, 7);


INSERT INTO inscription VALUES ('','Ardie','Jean','0623231299','24500',2,1);
INSERT INTO inscription VALUES ('','Macler','Marie','0634631299','24450',1,1);
INSERT INTO inscription VALUES ('','Sami','Andree','0523223459','24320',3,1);
INSERT INTO inscription VALUES ('','Moineau','Jeanne','0611231299','24500',3,2);
INSERT INTO inscription VALUES ('','Marcel','Yves','0699871299','24500',2,7);
INSERT INTO inscription VALUES ('','Poisson','Myriam','0547831232','24530',2,2);
INSERT INTO inscription VALUES ('','Renard','Marie','0634671299','24500',1,3);
INSERT INTO inscription VALUES ('','Gramon','Patrice','0623234231','24430',2,4);
INSERT INTO inscription VALUES ('','Paris','Marc','0645321299','24510',2,3);
INSERT INTO inscription VALUES ('','Finele','Marie','0634637856','24550',1,1);
INSERT INTO inscription VALUES ('','Satyre','Ange','0528745459','24320',3,1);
INSERT INTO inscription VALUES ('','Mignon','Jules','0611232156','24610',2,8);
INSERT INTO inscription VALUES ('','Pignon','Maurice','0665891299','24740',2,2);
INSERT INTO inscription VALUES ('','Poireau','Gilles','0588761232','24530',2,2);
INSERT INTO inscription VALUES ('','Boisse','Anne','0634674532','24500',1,3);
INSERT INTO inscription VALUES ('','Garmine','Pascal','0623234231','24430',2,4);
INSERT INTO inscription VALUES ('','Margie','Hamed','0632451299','24510',2,3);
INSERT INTO inscription VALUES ('','Ramon','Marc','0634567856','24550',1,7);
INSERT INTO inscription VALUES ('','Jojo','Annie','0512457459','24320',3,1);
INSERT INTO inscription VALUES ('','PoiMignon','Jim','0687982156','24610',2,2);
INSERT INTO inscription VALUES ('','Panard','Mathilde','0623231299','24740',2,6);
INSERT INTO inscription VALUES ('','Hamadi','Youssef','0588761232','24530',2,6);
INSERT INTO inscription VALUES ('','Elimouni','Zieb','0634674532','24500',1,4);
INSERT INTO inscription VALUES ('','Costra','Pascal','0623234231','24430',2,5);
INSERT INTO inscription VALUES ('','Rahmy','Aulélien','0514567477','24320',3,9);
INSERT INTO inscription VALUES ('','Prince','Camille','0687912789','24610',2,9);
INSERT INTO inscription VALUES ('','Plantu','René','0623212345','24740',1,9);
INSERT INTO inscription VALUES ('','Parizi','Julio','0588788954','24530',2,10);
INSERT INTO inscription VALUES ('','Arbi','Zineb','0634678981','24500',1,10);
INSERT INTO inscription VALUES ('','Castro','Pascal','0623211457','24430',2,10);

-- --------------------------------------------------------

-- 
-- Mise à jours du nombre de visiteurs
-- 

UPDATE visite SET nbVisiteursInscrits=13 where id = 1 ;
UPDATE visite SET nbVisiteursInscrits=11  where id = 2 ;
UPDATE visite SET nbVisiteursInscrits=6  where id = 3 ;
UPDATE visite SET nbVisiteursInscrits=5  where id = 4 ;
UPDATE visite SET nbVisiteursInscrits=2 where id = 5 ;
UPDATE visite SET nbVisiteursInscrits=4  where id = 6 ;
UPDATE visite SET nbVisiteursInscrits=3  where id = 7 ;
UPDATE visite SET nbVisiteursInscrits=2  where id = 8 ;
UPDATE visite SET nbVisiteursInscrits=6  where id = 9 ;
UPDATE visite SET nbVisiteursInscrits=5  where id = 10 ;

