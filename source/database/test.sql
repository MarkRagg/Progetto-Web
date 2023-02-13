-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Feb 13, 2023 alle 15:38
-- Versione del server: 10.4.25-MariaDB
-- Versione PHP: 8.1.10

CREATE DATABASE socialnetwork;
USE socialnetwork;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `socialnetwork`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL COMMENT 'chiave primaria, semplicemente un numero che deve essere incrementato ogni volta che si aggiunge una nuova riga',
  `author` varchar(20) NOT NULL,
  `post_id` int(11) NOT NULL,
  `post_comment` varchar(50) NOT NULL,
  `data_commento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='tabella dei commenti';

--
-- Dump dei dati per la tabella `comment`
--

INSERT INTO `comment` (`comment_id`, `author`, `post_id`, `post_comment`, `data_commento`) VALUES
(1, 'bob', 1, 'certo', '2023-02-13'),
(2, 'ciccio', 3, 'Quando vengo in università ti do una mano', '2023-02-13'),
(3, 'ciccio', 1, 'guarda sul portale di studenti online', '2023-02-13');

-- --------------------------------------------------------

--
-- Struttura della tabella `corsi`
--

CREATE TABLE `corsi` (
  `corso_id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `anno` int(11) NOT NULL,
  `uni_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `corsi`
--

INSERT INTO `corsi` (`corso_id`, `nome`, `anno`, `uni_id`) VALUES
(1, 'Ingegneria informatica', 2022, 1),
(2, 'Ingegneria biomedica', 2021, 1),
(3, 'Ingegneria Elettronica', 2020, 1),
(4, 'Psicologia', 2016, 1),
(5, 'Economia Aziendale', 2022, 2),
(6, 'Politiche internazionali', 2019, 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `esami`
--

CREATE TABLE `esami` (
  `esame_id` int(11) NOT NULL,
  `corso_id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `sezione` varchar(20) NOT NULL COMMENT 'tipo ingegneria, matematica, ecc ecc'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `esami`
--

INSERT INTO `esami` (`esame_id`, `corso_id`, `nome`, `sezione`) VALUES
(1, 1, 'OOP', 'informatica'),
(2, 1, 'Probabilità', 'matematica'),
(3, 1, 'Sistemi operativi', 'informatica'),
(4, 1, 'Analisi', 'matematica'),
(5, 2, 'Fisiologia', 'medicina'),
(6, 2, 'Elaborazione dei segnali', 'matematica'),
(7, 2, 'Fisica A', 'matematica'),
(8, 5, 'Macroeconomia', 'economia'),
(9, 5, 'Microeconomia', 'economia'),
(10, 5, 'Economia Politica', 'economia'),
(11, 5, 'Economia Aziendale', 'economia');

-- --------------------------------------------------------

--
-- Struttura della tabella `notifiche`
--

CREATE TABLE `notifiche` (
  `notifica_id` int(11) NOT NULL,
  `user_1_id` varchar(20) NOT NULL COMMENT 'user che fa l''azione',
  `user_2_id` varchar(20) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `tipologia` int(11) NOT NULL COMMENT 'follow(1), reaction(2), commento(3)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `notifiche`
--

INSERT INTO `notifiche` (`notifica_id`, `user_1_id`, `user_2_id`, `post_id`, `tipologia`) VALUES
(29, 'marco_ragg', 'bob', NULL, 1),
(30, 'bob', 'marco_ragg', NULL, 1),
(31, 'bob', 'marco_ragg', 1, 2),
(32, 'bob', 'marco_ragg', 1, 3),
(33, 'bob', 'marco_ragg', 1, 2),
(34, 'bob', 'ciccio', NULL, 1),
(35, 'marco_ragg', 'simo_zama', NULL, 1),
(36, 'marco_ragg', 'lore_tosi', NULL, 1),
(37, 'ciccio', 'marco_ragg', 3, 3),
(38, 'ciccio', 'marco_ragg', 3, 2),
(39, 'ciccio', 'marco_ragg', 3, 2),
(40, 'ciccio', 'bob', NULL, 1),
(41, 'ciccio', 'marco_ragg', 1, 3);

-- --------------------------------------------------------

--
-- Struttura della tabella `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL COMMENT 'chiave primaria, semplicemente un numero che deve essere incrementato ogni volta che si aggiunge una nuova riga',
  `author` varchar(20) NOT NULL,
  `string` varchar(200) NOT NULL COMMENT 'ciò che scrivi',
  `data` date NOT NULL,
  `esame_id` int(11) DEFAULT NULL COMMENT 'l''esame di riferimento del post, PUO ESSERE NULLO',
  `immagine` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='la tabella dei post con post_id, autore e il contenuto testuale (ma non solo) del post';

--
-- Dump dei dati per la tabella `post`
--

INSERT INTO `post` (`post_id`, `author`, `string`, `data`, `esame_id`, `immagine`) VALUES
(1, 'marco_ragg', 'Non ho capito come funziona il tirocinio, qualcuno può spiegare?\r\n', '2023-02-13', NULL, NULL),
(2, 'marco_ragg', 'Buongiorno', '2023-02-13', NULL, NULL),
(3, 'marco_ragg', 'Non mi viene l\'esercizio del secondo lab', '2023-02-13', 1, NULL),
(4, 'ciccio', 'Non ho capito l\'idea di Freud, qualcuno spiega?', '2023-02-13', NULL, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `post_user_reaction`
--

CREATE TABLE `post_user_reaction` (
  `pur_id` int(11) NOT NULL COMMENT 'chiave primaria, semplicemente un numero che deve essere incrementato ogni volta che si aggiunge una nuova riga',
  `user_id` varchar(20) NOT NULL,
  `post_id` int(11) NOT NULL,
  `reaction_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='tabella che collega l''utente(user) che fa la reazione(reaction) ad un post(post)';

--
-- Dump dei dati per la tabella `post_user_reaction`
--

INSERT INTO `post_user_reaction` (`pur_id`, `user_id`, `post_id`, `reaction_id`) VALUES
(1, 'bob', 1, 1),
(2, 'bob', 1, 4),
(3, 'marco_ragg', 1, 2),
(4, 'marco_ragg', 3, 1),
(5, 'ciccio', 3, 2),
(6, 'ciccio', 3, 5);

-- --------------------------------------------------------

--
-- Struttura della tabella `reaction`
--

CREATE TABLE `reaction` (
  `reaction_id` int(11) NOT NULL COMMENT 'chiave primaria, semplicemente un numero che deve essere incrementato ogni volta che si aggiunge una nuova riga',
  `reaction_info` varchar(100) NOT NULL COMMENT 'la reazione stessa, che può essere una immagine, una emoji ecc ecc'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='tabella delle reazioni';

--
-- Dump dei dati per la tabella `reaction`
--

INSERT INTO `reaction` (`reaction_id`, `reaction_info`) VALUES
(1, 'like'),
(2, 'fire'),
(3, 'smile'),
(4, 'cuore'),
(5, 'baci');

-- --------------------------------------------------------

--
-- Struttura della tabella `universita`
--

CREATE TABLE `universita` (
  `uni_id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `sede` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `universita`
--

INSERT INTO `universita` (`uni_id`, `nome`, `sede`) VALUES
(1, 'Unibo', 'Bologna'),
(2, 'Bocconi', 'Milano');

-- --------------------------------------------------------

--
-- Struttura della tabella `user`
--

CREATE TABLE `user` (
  `user_id` varchar(20) NOT NULL COMMENT 'chiave primaria, NON E'' INT ma E'' LO USERNAME, lunghezza max 20',
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='l''utente con username(user_id), email e password';

--
-- Dump dei dati per la tabella `user`
--

INSERT INTO `user` (`user_id`, `password`, `email`) VALUES
('bob', 'darioberto', 'darioberto@gmail.com'),
('ciccio', 'cicciocarl', 'ciccio@cc.it'),
('lore_tosi', 'loretosi', 'lorenzo.tosi@gmail.com'),
('marco_ragg', 'marcoraggio', 'marcoraggio27@gmail.com'),
('simo_zama', 'simozama', 'simozama@gmail.com');

-- --------------------------------------------------------

--
-- Struttura della tabella `user_followers_followed`
--

CREATE TABLE `user_followers_followed` (
  `user_follower_count` int(11) NOT NULL COMMENT 'chiave primaria, semplicemente un numero che deve essere incrementato ogni volta che si aggiunge una nuova riga',
  `follower_id` varchar(20) NOT NULL COMMENT 'colui che viene seguito',
  `user_id` varchar(20) NOT NULL COMMENT 'colui che fa l''azione di seguire'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='tabella per seguiti e seguaci';

--
-- Dump dei dati per la tabella `user_followers_followed`
--

INSERT INTO `user_followers_followed` (`user_follower_count`, `follower_id`, `user_id`) VALUES
(14, 'marco_ragg', 'bob'),
(15, 'bob', 'marco_ragg'),
(16, 'bob', 'ciccio'),
(17, 'marco_ragg', 'simo_zama'),
(18, 'marco_ragg', 'lore_tosi'),
(19, 'ciccio', 'bob');

-- --------------------------------------------------------

--
-- Struttura della tabella `user_info`
--

CREATE TABLE `user_info` (
  `user_info_count` int(11) NOT NULL COMMENT 'chiave primaria, semplicemente un numero che deve essere incrementato ogni volta che si aggiunge una nuova riga',
  `user_id` varchar(20) NOT NULL COMMENT 'è la FK',
  `name` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `date_of_birth` date NOT NULL,
  `birthplace` varchar(100) NOT NULL COMMENT 'luogo di nascita',
  `uni_residence` varchar(100) NOT NULL COMMENT 'citta dove studi',
  `corso_id` int(11) DEFAULT NULL,
  `user_image` varchar(100) DEFAULT NULL,
  `descrizione` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='tabella che arricchisce la tabella user';

--
-- Dump dei dati per la tabella `user_info`
--

INSERT INTO `user_info` (`user_info_count`, `user_id`, `name`, `surname`, `date_of_birth`, `birthplace`, `uni_residence`, `corso_id`, `user_image`, `descrizione`) VALUES
(1, 'marco_ragg', 'Marco', 'Raggini', '2001-11-29', 'Rimini', 'Rimini', 1, 'default_image.png', ' Ingengeria e scienze informatiche, Cesena.\r\n3° anno\r\n'),
(2, 'ciccio', 'Francesco', 'Carlucci', '2002-02-18', 'Matera', 'Genova', 4, 'default_image.png', 'Hobby: gym\r\nVivo a Cesena ma adoro Matera'),
(3, 'bob', 'Dario', 'Berti', '2001-10-14', 'Bologna', 'Forlì-Cesena', 2, 'default_image.png', ' '),
(4, 'lore_tosi', 'Lorenzo', 'Tosi', '2001-12-01', 'Rimini', 'Rimini', NULL, 'default_image.png', ' '),
(5, 'simo_zama', 'Simone', 'Zama', '2001-02-18', 'Ravenna', 'Ravenna', NULL, 'default_image.png', ' ');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `fk_comment_comment` (`author`),
  ADD KEY `fk_comment_post` (`post_id`);

--
-- Indici per le tabelle `corsi`
--
ALTER TABLE `corsi`
  ADD PRIMARY KEY (`corso_id`),
  ADD KEY `fk_corsi_universita` (`uni_id`);

--
-- Indici per le tabelle `esami`
--
ALTER TABLE `esami`
  ADD PRIMARY KEY (`esame_id`),
  ADD KEY `fk_esami_corsi` (`corso_id`);

--
-- Indici per le tabelle `notifiche`
--
ALTER TABLE `notifiche`
  ADD PRIMARY KEY (`notifica_id`),
  ADD KEY `fk_notifche_user1` (`user_1_id`),
  ADD KEY `fk_notifche_user` (`user_2_id`),
  ADD KEY `fk_notifche_post` (`post_id`);

--
-- Indici per le tabelle `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `fk_post_user` (`author`),
  ADD KEY `fk_post_esame` (`esame_id`);

--
-- Indici per le tabelle `post_user_reaction`
--
ALTER TABLE `post_user_reaction`
  ADD PRIMARY KEY (`pur_id`),
  ADD KEY `fk_post_user_reaction_user` (`user_id`),
  ADD KEY `fk_post_user_reaction_reaction` (`reaction_id`),
  ADD KEY `fk_post_user_reaction` (`post_id`);

--
-- Indici per le tabelle `reaction`
--
ALTER TABLE `reaction`
  ADD PRIMARY KEY (`reaction_id`);

--
-- Indici per le tabelle `universita`
--
ALTER TABLE `universita`
  ADD PRIMARY KEY (`uni_id`);

--
-- Indici per le tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indici per le tabelle `user_followers_followed`
--
ALTER TABLE `user_followers_followed`
  ADD PRIMARY KEY (`user_follower_count`),
  ADD KEY `fk_user_followers_user` (`user_id`);

--
-- Indici per le tabelle `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`user_info_count`),
  ADD KEY `fk_user_info_user` (`user_id`),
  ADD KEY `fk_user_info_corso` (`corso_id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'chiave primaria, semplicemente un numero che deve essere incrementato ogni volta che si aggiunge una nuova riga', AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT per la tabella `corsi`
--
ALTER TABLE `corsi`
  MODIFY `corso_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT per la tabella `esami`
--
ALTER TABLE `esami`
  MODIFY `esame_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT per la tabella `notifiche`
--
ALTER TABLE `notifiche`
  MODIFY `notifica_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT per la tabella `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'chiave primaria, semplicemente un numero che deve essere incrementato ogni volta che si aggiunge una nuova riga', AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT per la tabella `post_user_reaction`
--
ALTER TABLE `post_user_reaction`
  MODIFY `pur_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'chiave primaria, semplicemente un numero che deve essere incrementato ogni volta che si aggiunge una nuova riga', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT per la tabella `reaction`
--
ALTER TABLE `reaction`
  MODIFY `reaction_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'chiave primaria, semplicemente un numero che deve essere incrementato ogni volta che si aggiunge una nuova riga', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `universita`
--
ALTER TABLE `universita`
  MODIFY `uni_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `user_followers_followed`
--
ALTER TABLE `user_followers_followed`
  MODIFY `user_follower_count` int(11) NOT NULL AUTO_INCREMENT COMMENT 'chiave primaria, semplicemente un numero che deve essere incrementato ogni volta che si aggiunge una nuova riga', AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT per la tabella `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_info_count` int(11) NOT NULL AUTO_INCREMENT COMMENT 'chiave primaria, semplicemente un numero che deve essere incrementato ogni volta che si aggiunge una nuova riga', AUTO_INCREMENT=16;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk_comment_comment` FOREIGN KEY (`author`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_comment_post` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `corsi`
--
ALTER TABLE `corsi`
  ADD CONSTRAINT `fk_corsi_universita` FOREIGN KEY (`uni_id`) REFERENCES `universita` (`uni_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `esami`
--
ALTER TABLE `esami`
  ADD CONSTRAINT `fk_esami_corsi` FOREIGN KEY (`corso_id`) REFERENCES `corsi` (`corso_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `notifiche`
--
ALTER TABLE `notifiche`
  ADD CONSTRAINT `fk_notifche_post` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_notifche_user` FOREIGN KEY (`user_2_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_notifche_user1` FOREIGN KEY (`user_1_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `fk_post_esame` FOREIGN KEY (`esame_id`) REFERENCES `esami` (`esame_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_post_user` FOREIGN KEY (`author`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `post_user_reaction`
--
ALTER TABLE `post_user_reaction`
  ADD CONSTRAINT `fk_post_user_reaction` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_post_user_reaction_reaction` FOREIGN KEY (`reaction_id`) REFERENCES `reaction` (`reaction_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_post_user_reaction_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `user_followers_followed`
--
ALTER TABLE `user_followers_followed`
  ADD CONSTRAINT `fk_user_followers_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `user_info`
--
ALTER TABLE `user_info`
  ADD CONSTRAINT `fk_user_info_corso` FOREIGN KEY (`corso_id`) REFERENCES `corsi` (`corso_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_info_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
