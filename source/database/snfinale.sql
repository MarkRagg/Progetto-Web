CREATE SCHEMA socialnetwork;

CREATE  TABLE socialnetwork.reaction ( 
	reaction_id          INT  NOT NULL     PRIMARY KEY,
	reaction_info        VARCHAR(100)  NOT NULL     
 ) engine=InnoDB;

CREATE  TABLE socialnetwork.universita ( 
	uni_id               INT  NOT NULL     PRIMARY KEY,
	nome                 VARCHAR(50)  NOT NULL     ,
	sede                 VARCHAR(50)  NOT NULL     
 ) engine=InnoDB;

CREATE  TABLE socialnetwork.`user` ( 
	user_id              VARCHAR(20)  NOT NULL     PRIMARY KEY,
	password             VARCHAR(50)  NOT NULL     ,
	email                VARCHAR(50)  NOT NULL     
 ) engine=InnoDB;

CREATE  TABLE socialnetwork.user_followers_followed ( 
	user_follower_count  INT  NOT NULL     PRIMARY KEY,
	follower_id          VARCHAR(20)  NOT NULL     ,
	user_id              VARCHAR(20)  NOT NULL     
 ) engine=InnoDB;

CREATE  TABLE socialnetwork.corsi ( 
	corso_id             INT  NOT NULL     PRIMARY KEY,
	nome                 VARCHAR(50)  NOT NULL     ,
	anno                 INT  NOT NULL     ,
	uni_id               INT  NOT NULL     
 ) engine=InnoDB;

CREATE  TABLE socialnetwork.esami ( 
	esame_id             INT  NOT NULL     PRIMARY KEY,
	corso_id             INT  NOT NULL     ,
	nome                 VARCHAR(50)  NOT NULL     ,
	sezione              VARCHAR(20)  NOT NULL     
 ) engine=InnoDB;

CREATE  TABLE socialnetwork.post ( 
	post_id              INT  NOT NULL     PRIMARY KEY,
	author               VARCHAR(20)  NOT NULL     ,
	string               VARCHAR(200)  NOT NULL     ,
	data                 DATE  NOT NULL     ,
	esame_id             INT       
 ) engine=InnoDB;

CREATE  TABLE socialnetwork.post_user_reaction ( 
	pur_id               INT  NOT NULL     PRIMARY KEY,
	user_id              VARCHAR(20)  NOT NULL     ,
	post_id              INT  NOT NULL     ,
	reaction_id          INT  NOT NULL     
 ) engine=InnoDB;

CREATE  TABLE socialnetwork.user_info ( 
	user_info_count      INT  NOT NULL     PRIMARY KEY,
	user_id              VARCHAR(20)  NOT NULL     ,
	name                 VARCHAR(100)  NOT NULL     ,
	surname              VARCHAR(100)  NOT NULL     ,
	date_of_birth        DATE  NOT NULL     ,
	birthplace           VARCHAR(100)  NOT NULL     ,
	uni_residence        VARCHAR(100)  NOT NULL     ,
	corso_id             INT       ,
	user_image      VARCHAR(100)       
 ) engine=InnoDB;

CREATE  TABLE socialnetwork.comment ( 
	comment_id           INT  NOT NULL     PRIMARY KEY,
	author               VARCHAR(20)  NOT NULL     ,
	post_id              INT  NOT NULL     ,
	post_comment         VARCHAR(50)  NOT NULL     ,
	data_commento        DATE  NOT NULL     
 ) engine=InnoDB;

CREATE  TABLE socialnetwork.notifiche ( 
	notifica_id          INT  NOT NULL     PRIMARY KEY,
	user_1_id            VARCHAR(20)  NOT NULL     ,
	user_2_id            VARCHAR(20)  NOT NULL     ,
	post_id              INT       ,
	tipologia            INT  NOT NULL     
 ) engine=InnoDB;

ALTER TABLE socialnetwork.comment ADD CONSTRAINT fk_comment_comment FOREIGN KEY ( author ) REFERENCES socialnetwork.`user`( user_id ) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE socialnetwork.comment ADD CONSTRAINT fk_comment_post FOREIGN KEY ( post_id ) REFERENCES socialnetwork.post( post_id ) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE socialnetwork.corsi ADD CONSTRAINT fk_corsi_universita FOREIGN KEY ( uni_id ) REFERENCES socialnetwork.universita( uni_id ) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE socialnetwork.esami ADD CONSTRAINT fk_esami_corsi FOREIGN KEY ( corso_id ) REFERENCES socialnetwork.corsi( corso_id ) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE socialnetwork.notifiche ADD CONSTRAINT fk_notifche_user1 FOREIGN KEY ( user_1_id ) REFERENCES socialnetwork.`user`( user_id ) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE socialnetwork.notifiche ADD CONSTRAINT fk_notifche_user FOREIGN KEY ( user_2_id ) REFERENCES socialnetwork.`user`( user_id ) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE socialnetwork.notifiche ADD CONSTRAINT fk_notifche_post FOREIGN KEY ( post_id ) REFERENCES socialnetwork.post( post_id ) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE socialnetwork.post ADD CONSTRAINT fk_post_user FOREIGN KEY ( author ) REFERENCES socialnetwork.`user`( user_id ) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE socialnetwork.post ADD CONSTRAINT fk_post_esame FOREIGN KEY ( esame_id ) REFERENCES socialnetwork.esami( esame_id ) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE socialnetwork.post_user_reaction ADD CONSTRAINT fk_post_user_reaction_user FOREIGN KEY ( user_id ) REFERENCES socialnetwork.`user`( user_id ) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE socialnetwork.post_user_reaction ADD CONSTRAINT fk_post_user_reaction_reaction FOREIGN KEY ( reaction_id ) REFERENCES socialnetwork.reaction( reaction_id ) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE socialnetwork.post_user_reaction ADD CONSTRAINT fk_post_user_reaction FOREIGN KEY ( post_id ) REFERENCES socialnetwork.post( post_id ) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE socialnetwork.user_followers_followed ADD CONSTRAINT fk_user_followers_user FOREIGN KEY ( user_id ) REFERENCES socialnetwork.`user`( user_id ) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE socialnetwork.user_info ADD CONSTRAINT fk_user_info_user FOREIGN KEY ( user_id ) REFERENCES socialnetwork.`user`( user_id ) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE socialnetwork.user_info ADD CONSTRAINT fk_user_info_corso FOREIGN KEY ( corso_id ) REFERENCES socialnetwork.corsi( corso_id ) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE socialnetwork.reaction COMMENT 'tabella delle reazioni';

ALTER TABLE socialnetwork.reaction MODIFY reaction_id INT  NOT NULL   COMMENT 'chiave primaria, semplicemente un numero che deve essere incrementato ogni volta che si aggiunge una nuova riga';

ALTER TABLE socialnetwork.reaction MODIFY reaction_info VARCHAR(100)  NOT NULL   COMMENT 'la reazione stessa, che può essere una immagine, una emoji ecc ecc';

ALTER TABLE socialnetwork.`user` COMMENT 'l''utente con username(user_id), email e password';

ALTER TABLE socialnetwork.`user` MODIFY user_id VARCHAR(20)  NOT NULL   COMMENT 'chiave primaria, NON E'' INT ma E'' LO USERNAME, lunghezza max 20';

ALTER TABLE socialnetwork.user_followers_followed COMMENT 'tabella per seguiti e seguaci';

ALTER TABLE socialnetwork.user_followers_followed MODIFY user_follower_count INT  NOT NULL   COMMENT 'chiave primaria, semplicemente un numero che deve essere incrementato ogni volta che si aggiunge una nuova riga';

ALTER TABLE socialnetwork.user_followers_followed MODIFY follower_id VARCHAR(20)  NOT NULL   COMMENT 'colui che viene seguito';

ALTER TABLE socialnetwork.user_followers_followed MODIFY user_id VARCHAR(20)  NOT NULL   COMMENT 'colui che fa l''azione di seguire';

ALTER TABLE socialnetwork.esami MODIFY sezione VARCHAR(20)  NOT NULL   COMMENT 'tipo ingegneria, matematica, ecc ecc';

ALTER TABLE socialnetwork.post COMMENT 'la tabella dei post con post_id, autore e il contenuto testuale (ma non solo) del post';

ALTER TABLE socialnetwork.post MODIFY post_id INT  NOT NULL   COMMENT 'chiave primaria, semplicemente un numero che deve essere incrementato ogni volta che si aggiunge una nuova riga';

ALTER TABLE socialnetwork.post MODIFY string VARCHAR(200)  NOT NULL   COMMENT 'ciò che scrivi';

ALTER TABLE socialnetwork.post MODIFY esame_id INT     COMMENT 'l''esame di riferimento del post, PUO ESSERE NULLO';

ALTER TABLE socialnetwork.post_user_reaction COMMENT 'tabella che collega l''utente(user) che fa la reazione(reaction) ad un post(post)';

ALTER TABLE socialnetwork.post_user_reaction MODIFY pur_id INT  NOT NULL   COMMENT 'chiave primaria, semplicemente un numero che deve essere incrementato ogni volta che si aggiunge una nuova riga';

ALTER TABLE socialnetwork.user_info COMMENT 'tabella che arricchisce la tabella user';

ALTER TABLE socialnetwork.user_info MODIFY user_info_count INT  NOT NULL   COMMENT 'chiave primaria, semplicemente un numero che deve essere incrementato ogni volta che si aggiunge una nuova riga';

ALTER TABLE socialnetwork.user_info MODIFY user_id VARCHAR(20)  NOT NULL   COMMENT 'è la FK';

ALTER TABLE socialnetwork.user_info MODIFY birthplace VARCHAR(100)  NOT NULL   COMMENT 'luogo di nascita';

ALTER TABLE socialnetwork.user_info MODIFY uni_residence VARCHAR(100)  NOT NULL   COMMENT 'citta dove studi';

ALTER TABLE socialnetwork.comment COMMENT 'tabella dei commenti';

ALTER TABLE socialnetwork.comment MODIFY comment_id INT  NOT NULL   COMMENT 'chiave primaria, semplicemente un numero che deve essere incrementato ogni volta che si aggiunge una nuova riga';

ALTER TABLE socialnetwork.notifiche MODIFY user_1_id VARCHAR(20)  NOT NULL   COMMENT 'user che fa l''azione';

ALTER TABLE socialnetwork.notifiche MODIFY tipologia INT  NOT NULL   COMMENT 'follow(1), reaction(2), commento(3)';

