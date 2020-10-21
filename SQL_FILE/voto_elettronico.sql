-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versione server:              10.4.8-MariaDB - mariadb.org binary distribution
-- S.O. server:                  Win64
-- HeidiSQL Versione:            10.3.0.5771
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dump della struttura del database voto_elettronico
CREATE DATABASE IF NOT EXISTS `voto_elettronico` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `voto_elettronico`;

-- Dump della struttura di tabella voto_elettronico.candidato
CREATE TABLE IF NOT EXISTS `candidato` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `cognome` varchar(50) NOT NULL,
  `totale_voti` int(11) NOT NULL DEFAULT 0,
  `id_elezione` int(11) DEFAULT NULL,
  `id_lista` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_candidato_elezione` (`id_elezione`),
  KEY `FK_candidato_lista` (`id_lista`),
  CONSTRAINT `FK_candidato_elezione` FOREIGN KEY (`id_elezione`) REFERENCES `elezione` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_candidato_lista` FOREIGN KEY (`id_lista`) REFERENCES `lista` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- Dump dei dati della tabella voto_elettronico.candidato: ~5 rows (circa)
/*!40000 ALTER TABLE `candidato` DISABLE KEYS */;
INSERT INTO `candidato` (`id`, `nome`, `cognome`, `totale_voti`, `id_elezione`, `id_lista`) VALUES
	(5, 'Matteo', 'Renzi', 0, 9, 4),
	(6, 'Matteo', 'Salvini', 0, 6, 7),
	(7, 'Silvio', 'Berlusconi', 0, 9, 4),
	(8, 'Giuliano', 'Spata', 0, 9, 4),
	(9, 'Paolo', 'Salemi', 0, 9, 6);
/*!40000 ALTER TABLE `candidato` ENABLE KEYS */;

-- Dump della struttura di tabella voto_elettronico.classe
CREATE TABLE IF NOT EXISTS `classe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `classe` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `classe` (`classe`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

-- Dump dei dati della tabella voto_elettronico.classe: ~3 rows (circa)
/*!40000 ALTER TABLE `classe` DISABLE KEYS */;
INSERT INTO `classe` (`id`, `classe`) VALUES
	(16, '2E Informatica'),
	(15, '3B Informatica'),
	(17, '5B Informatica');
/*!40000 ALTER TABLE `classe` ENABLE KEYS */;

-- Dump della struttura di tabella voto_elettronico.elezione
CREATE TABLE IF NOT EXISTS `elezione` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL DEFAULT '',
  `data_apertura` date DEFAULT NULL,
  `ora_apertura` time DEFAULT NULL,
  `data_chiusura` date DEFAULT NULL,
  `ora_chiusura` time DEFAULT NULL,
  `iscritti` int(11) DEFAULT 0,
  `votanti` int(11) DEFAULT 0,
  `schede_valide` int(11) DEFAULT 0,
  `schede_bianche` int(11) DEFAULT 0,
  `schede_nulle` int(11) DEFAULT 0,
  `id_tipologia_utente` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_elezione_tipologia_utente` (`id_tipologia_utente`),
  CONSTRAINT `FK_elezione_tipologia_utente` FOREIGN KEY (`id_tipologia_utente`) REFERENCES `tipologia_utente` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

-- Dump dei dati della tabella voto_elettronico.elezione: ~5 rows (circa)
/*!40000 ALTER TABLE `elezione` DISABLE KEYS */;
INSERT INTO `elezione` (`id`, `nome`, `data_apertura`, `ora_apertura`, `data_chiusura`, `ora_chiusura`, `iscritti`, `votanti`, `schede_valide`, `schede_bianche`, `schede_nulle`, `id_tipologia_utente`) VALUES
	(6, 'Consulta', '2019-12-25', '13:10:00', '2019-12-29', '11:11:00', 0, 0, 0, 0, 0, 8),
	(7, 'Organo', '2001-05-28', '13:05:00', '2001-05-31', '12:05:00', 150, 0, 0, 0, 0, 6),
	(8, 'Camera', '2019-02-25', '22:17:00', '2019-02-26', '22:00:00', 150, 0, 0, 0, 0, 7),
	(9, 'Senato', '2019-12-25', '09:00:00', '2019-12-30', '12:30:00', 2000, 0, 0, 0, 0, 8),
	(10, 'Comune', '2019-12-27', '20:09:18', '2019-12-28', '15:59:29', 0, 0, 0, 0, 0, NULL);
/*!40000 ALTER TABLE `elezione` ENABLE KEYS */;

-- Dump della struttura di tabella voto_elettronico.lista
CREATE TABLE IF NOT EXISTS `lista` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL DEFAULT '',
  `totale_voti` int(11) DEFAULT 0,
  `id_elezione` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_lista_elezione` (`id_elezione`),
  CONSTRAINT `FK_lista_elezione` FOREIGN KEY (`id_elezione`) REFERENCES `elezione` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- Dump dei dati della tabella voto_elettronico.lista: ~4 rows (circa)
/*!40000 ALTER TABLE `lista` DISABLE KEYS */;
INSERT INTO `lista` (`id`, `nome`, `totale_voti`, `id_elezione`) VALUES
	(4, 'LPS', 0, 9),
	(6, 'Forza Italia', 0, 9),
	(7, 'PD', 0, 6),
	(8, 'M5S', 0, 7);
/*!40000 ALTER TABLE `lista` ENABLE KEYS */;

-- Dump della struttura di tabella voto_elettronico.tipologia_utente
CREATE TABLE IF NOT EXISTS `tipologia_utente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipologia` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

-- Dump dei dati della tabella voto_elettronico.tipologia_utente: ~5 rows (circa)
/*!40000 ALTER TABLE `tipologia_utente` DISABLE KEYS */;
INSERT INTO `tipologia_utente` (`id`, `tipologia`) VALUES
	(5, 'Genitore'),
	(6, 'Tecnico'),
	(7, 'Personale ATA'),
	(8, 'Docente'),
	(10, 'Amministratore');
/*!40000 ALTER TABLE `tipologia_utente` ENABLE KEYS */;

-- Dump della struttura di tabella voto_elettronico.utente
CREATE TABLE IF NOT EXISTS `utente` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `cognome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `id_classe` int(11) DEFAULT NULL,
  `id_tipologia_utente` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_utente_classe` (`id_classe`),
  KEY `FK_utente_tipologia_utente` (`id_tipologia_utente`),
  CONSTRAINT `FK_utente_classe` FOREIGN KEY (`id_classe`) REFERENCES `classe` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_utente_tipologia_utente` FOREIGN KEY (`id_tipologia_utente`) REFERENCES `tipologia_utente` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=217 DEFAULT CHARSET=utf8mb4;

-- Dump dei dati della tabella voto_elettronico.utente: ~8 rows (circa)
/*!40000 ALTER TABLE `utente` DISABLE KEYS */;
INSERT INTO `utente` (`id`, `nome`, `cognome`, `email`, `username`, `password`, `id_classe`, `id_tipologia_utente`) VALUES
	(205, 'Utente ospite', ' ', 'root@localhost', 'guest', '$2y$10$lmBiybYIrRm70fpHWg2K7.sfqz8e/9rwoecznKCBj/FRaeFFvkTCO', NULL, NULL),
	(207, 'Utente ospite', ' ', 'root@localhost', 'guest', '$2y$10$lmBiybYIrRm70fpHWg2K7.sfqz8e/9rwoecznKCBj/FRaeFFvkTCO', NULL, NULL),
	(208, 'Daniele', 'Cocuzza', 'dcocuzza01@gmail.com', 'daniele', '$2y$10$4taZD2/yo9wNI6JAAVP6bed/xzDHjTfMD80/vMZ7pN6SUa2wuZdtC', 17, 8),
	(210, 'Utente ospite', ' ', 'root@localhost', 'guest', '$2y$10$lmBiybYIrRm70fpHWg2K7.sfqz8e/9rwoecznKCBj/FRaeFFvkTCO', NULL, NULL),
	(211, 'Daniele', 'Cocuzza', 'dcocuzza01@gmail.com', 'daniele', '$2y$10$4taZD2/yo9wNI6JAAVP6bed/xzDHjTfMD80/vMZ7pN6SUa2wuZdtC', NULL, NULL),
	(213, 'Utente ospite', ' ', 'root@localhost', 'guest', '$2y$10$lmBiybYIrRm70fpHWg2K7.sfqz8e/9rwoecznKCBj/FRaeFFvkTCO', NULL, NULL),
	(214, 'Daniele', 'Cocuzza', 'dcocuzza01@gmail.com', 'daniele', '$2y$10$4taZD2/yo9wNI6JAAVP6bed/xzDHjTfMD80/vMZ7pN6SUa2wuZdtC', NULL, NULL),
	(216, 'Giovanni', 'Caccamo', 'gcacca@kakka.com', 'giovanni', 'c', 16, 5);
/*!40000 ALTER TABLE `utente` ENABLE KEYS */;

-- Dump della struttura di tabella voto_elettronico.votazione
CREATE TABLE IF NOT EXISTS `votazione` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_utente` bigint(10) DEFAULT NULL,
  `id_elezione` int(11) DEFAULT NULL,
  `id_lista` int(11) DEFAULT NULL,
  `id_candidato` int(11) DEFAULT NULL,
  `id_candidato2` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_votazione_candidato` (`id_candidato`),
  KEY `FK_votazione_candidato_2` (`id_candidato2`),
  KEY `FK_votazione_elezione` (`id_elezione`),
  KEY `FK_votazione_lista` (`id_lista`),
  KEY `FK_votazione_utente` (`id_utente`),
  CONSTRAINT `FK_votazione_candidato` FOREIGN KEY (`id_candidato`) REFERENCES `candidato` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_votazione_candidato_2` FOREIGN KEY (`id_candidato2`) REFERENCES `candidato` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_votazione_elezione` FOREIGN KEY (`id_elezione`) REFERENCES `elezione` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_votazione_lista` FOREIGN KEY (`id_lista`) REFERENCES `lista` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_votazione_utente` FOREIGN KEY (`id_utente`) REFERENCES `utente` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Dump dei dati della tabella voto_elettronico.votazione: ~0 rows (circa)
/*!40000 ALTER TABLE `votazione` DISABLE KEYS */;
/*!40000 ALTER TABLE `votazione` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
