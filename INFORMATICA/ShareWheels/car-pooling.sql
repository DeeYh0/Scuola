-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 08, 2024 alle 15:06
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car-pooling`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `autisti`
--

CREATE TABLE `autisti` (
  `email` varchar(255) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cognome` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `numeroTelefono` varchar(20) NOT NULL,
  `numeroPatente` varchar(20) NOT NULL,
  `scadenzaPatente` date NOT NULL,
  `datiAutomobile` text DEFAULT NULL,
  `fotoProfilo` varchar(255) DEFAULT NULL,
  `dataRegistrazione` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `passeggeri`
--

CREATE TABLE `passeggeri` (
  `email` varchar(255) NOT NULL,
  `codice_fiscale` varchar(16) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cognome` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `numero_telefono` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `recensioniautisti`
--

CREATE TABLE `recensioniautisti` (
  `id` int(11) NOT NULL,
  `autista_email` varchar(255) DEFAULT NULL,
  `passeggero_email` varchar(255) DEFAULT NULL,
  `voto` int(11) DEFAULT NULL,
  `commento` text DEFAULT NULL,
  `viaggio_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `recensionipasseggeri`
--

CREATE TABLE `recensionipasseggeri` (
  `id` int(11) NOT NULL,
  `passeggero_email` varchar(255) DEFAULT NULL,
  `autista_email` varchar(255) DEFAULT NULL,
  `voto` int(11) DEFAULT NULL,
  `commento` text DEFAULT NULL,
  `viaggio_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `richieste`
--

CREATE TABLE `richieste` (
  `id` int(11) NOT NULL,
  `viaggio_id` int(11) DEFAULT NULL,
  `passeggero_email` varchar(255) DEFAULT NULL,
  `is_accettata` tinyint(1) DEFAULT 0,
  `conclusa` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `viaggi`
--

CREATE TABLE `viaggi` (
  `id` int(11) NOT NULL,
  `autista_email` varchar(255) DEFAULT NULL,
  `luogo_partenza` varchar(255) DEFAULT NULL,
  `luogo_destinazione` varchar(255) DEFAULT NULL,
  `orario_partenza` datetime DEFAULT NULL,
  `is_pubblicato` tinyint(1) DEFAULT 0,
  `concluso` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `autisti`
--
ALTER TABLE `autisti`
  ADD PRIMARY KEY (`email`);

--
-- Indici per le tabelle `passeggeri`
--
ALTER TABLE `passeggeri`
  ADD PRIMARY KEY (`email`);

--
-- Indici per le tabelle `recensioniautisti`
--
ALTER TABLE `recensioniautisti`
  ADD PRIMARY KEY (`id`),
  ADD KEY `autista_email` (`autista_email`),
  ADD KEY `passeggero_email` (`passeggero_email`),
  ADD KEY `FKA_viaggio_id` (`viaggio_id`);

--
-- Indici per le tabelle `recensionipasseggeri`
--
ALTER TABLE `recensionipasseggeri`
  ADD PRIMARY KEY (`id`),
  ADD KEY `passeggero_email` (`passeggero_email`),
  ADD KEY `autista_email` (`autista_email`),
  ADD KEY `FK_viaggio_id` (`viaggio_id`);

--
-- Indici per le tabelle `richieste`
--
ALTER TABLE `richieste`
  ADD PRIMARY KEY (`id`),
  ADD KEY `viaggio_id` (`viaggio_id`),
  ADD KEY `passeggero_email` (`passeggero_email`);

--
-- Indici per le tabelle `viaggi`
--
ALTER TABLE `viaggi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `autista_email` (`autista_email`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `recensioniautisti`
--
ALTER TABLE `recensioniautisti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `recensionipasseggeri`
--
ALTER TABLE `recensionipasseggeri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `richieste`
--
ALTER TABLE `richieste`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `viaggi`
--
ALTER TABLE `viaggi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `recensioniautisti`
--
ALTER TABLE `recensioniautisti`
  ADD CONSTRAINT `FKA_viaggio_id` FOREIGN KEY (`viaggio_id`) REFERENCES `viaggi` (`id`),
  ADD CONSTRAINT `RecensioniAutisti_ibfk_1` FOREIGN KEY (`autista_email`) REFERENCES `autisti` (`email`),
  ADD CONSTRAINT `RecensioniAutisti_ibfk_2` FOREIGN KEY (`passeggero_email`) REFERENCES `passeggeri` (`email`);

--
-- Limiti per la tabella `recensionipasseggeri`
--
ALTER TABLE `recensionipasseggeri`
  ADD CONSTRAINT `FK_viaggio_id` FOREIGN KEY (`viaggio_id`) REFERENCES `viaggi` (`id`),
  ADD CONSTRAINT `RecensioniPasseggeri_ibfk_1` FOREIGN KEY (`passeggero_email`) REFERENCES `passeggeri` (`email`),
  ADD CONSTRAINT `RecensioniPasseggeri_ibfk_2` FOREIGN KEY (`autista_email`) REFERENCES `autisti` (`email`);

--
-- Limiti per la tabella `richieste`
--
ALTER TABLE `richieste`
  ADD CONSTRAINT `Richieste_ibfk_1` FOREIGN KEY (`viaggio_id`) REFERENCES `viaggi` (`id`),
  ADD CONSTRAINT `Richieste_ibfk_2` FOREIGN KEY (`passeggero_email`) REFERENCES `passeggeri` (`email`);

--
-- Limiti per la tabella `viaggi`
--
ALTER TABLE `viaggi`
  ADD CONSTRAINT `Viaggi_ibfk_1` FOREIGN KEY (`autista_email`) REFERENCES `autisti` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
