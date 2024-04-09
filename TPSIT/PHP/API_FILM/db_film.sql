-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Apr 09, 2024 alle 20:16
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
-- Database: `db_film`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `actor`
--

CREATE TABLE `actor` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `birthday_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `actor`
--

INSERT INTO `actor` (`id`, `first_name`, `last_name`, `birthday_date`) VALUES
(1, 'Mike', 'Myers', '1963-05-25'),
(2, 'Checco', 'Zalone', '1977-06-03'),
(3, 'Checco', 'Zalone', '1977-06-03'),
(4, 'Checco', 'Zalone', '1977-06-03'),
(5, 'Checco', 'Zalone', '1977-06-03'),
(6, 'Bud', 'Spencer', '1929-10-31'),
(7, 'Philippe', 'Noiret', '1930-10-01'),
(8, 'Marcello', 'Mastroianni', '1924-09-28'),
(9, 'Roberto', 'Benigni', '1952-10-27'),
(10, 'Audrey', 'Tautou', '1976-08-09'),
(11, 'Lamberto', 'Maggiorani', '1909-08-28'),
(12, 'Vittorio', 'Gassman', '1922-09-01'),
(13, 'Philippe', 'Noiret', '1930-10-01'),
(14, 'Licia', 'Maglietta', '1954-11-16'),
(15, 'Johnny', 'Depp', '1963-06-09'),
(16, 'Alvaro', 'Vitali', '1950-09-03'),
(17, 'Nanni', 'Moretti', '1953-08-19'),
(18, 'Magali', 'Noël', '1932-06-27'),
(19, 'Katie', 'Holmes', '1978-12-18'),
(20, 'Crystal', 'Reed', '1985-02-06');

-- --------------------------------------------------------

--
-- Struttura della tabella `director`
--

CREATE TABLE `director` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `birthday_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `director`
--

INSERT INTO `director` (`id`, `first_name`, `last_name`, `birthday_date`) VALUES
(1, 'Andrew', 'Adamson', '1966-12-01'),
(2, 'Gennaro', 'Nunziante', '1967-08-20'),
(3, 'Gennaro', 'Nunziante', '1967-08-20'),
(4, 'Gennaro', 'Nunziante', '1967-08-20'),
(5, 'Gennaro', 'Nunziante', '1967-08-20'),
(6, 'Enzo', 'Barboni', '1922-01-07'),
(7, 'Giuseppe', 'Tornatore', '1956-03-27'),
(8, 'Marco', 'Ferreri', '1928-05-11'),
(9, 'Federico', 'Fellini', '1920-01-20'),
(10, 'Jean-Pierre', 'Jeunet', '1953-09-03'),
(11, 'Vittorio', 'De Sica', '1901-07-07'),
(12, 'Roberto', 'Benigni', '1952-10-27'),
(13, 'Mario', 'Monicelli', '1915-05-16'),
(14, 'Giuseppe', 'Tornatore', '1956-03-27'),
(15, 'Silvio', 'Soldini', '1958-09-27'),
(16, 'Tim', 'Burton', '1958-08-25'),
(17, 'Mario', 'Imperoli', '1925-04-19'),
(18, 'Nanni', 'Moretti', '1953-08-19'),
(19, 'Federico', 'Fellini', '1920-01-20'),
(20, 'Lars', 'Klevberg', '1981-05-09');

-- --------------------------------------------------------

--
-- Struttura della tabella `genre`
--

CREATE TABLE `genre` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `slug` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `genre`
--

INSERT INTO `genre` (`id`, `name`, `slug`) VALUES
(1, 'Animazione', 'animazione'),
(2, 'Commedia', 'commedia'),
(3, 'Drammatico', 'drammatico'),
(4, 'Avventura', 'avventura'),
(5, 'Commedia', 'commedia'),
(6, 'Commedia', 'commedia'),
(7, 'Drammatico', 'drammatico'),
(8, 'Commedia', 'commedia'),
(9, 'Drammatico', 'drammatico'),
(10, 'Commedia', 'commedia'),
(11, 'Drammatico', 'drammatico'),
(12, 'Commedia', 'commedia'),
(13, 'Commedia', 'commedia'),
(14, 'Drammatico', 'drammatico'),
(15, 'Drammatico', 'drammatico'),
(16, 'Fantasy', 'fantasy'),
(17, 'Commedia', 'commedia'),
(18, 'Drammatico', 'drammatico'),
(19, 'Drammatico', 'drammatico'),
(20, 'Horror', 'horror');

-- --------------------------------------------------------

--
-- Struttura della tabella `movie`
--

CREATE TABLE `movie` (
  `id` int(11) NOT NULL,
  `synopsis` text DEFAULT NULL,
  `title` varchar(128) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `released_year` date DEFAULT NULL,
  `poster` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `movie`
--

INSERT INTO `movie` (`id`, `synopsis`, `title`, `duration`, `released_year`, `poster`) VALUES
(1, 'Un orco verde e simpatico incontra un asino e una principessa in questo film animato.', 'Shrek', 90, '2001-05-22', 'https://play-lh.googleusercontent.com/OYz7f_yXWhyhpLO_6d-65nqCKDD47MLdCXJFhJZven7V-Kg83AF4yi01o76uaod-M28C'),
(2, 'Un uomo del sud Italia si trova coinvolto in situazioni comiche e commoventi.', 'Cado dalle nubi', 110, '2009-12-18', 'https://pad.mymovies.it/filmclub/2009/07/088/locandina.jpg'),
(3, 'Un uomo che cerca di sfondare nel mondo dello spettacolo finisce per trovare il successo.', 'Che bella giornata', 95, '2011-01-07', 'https://pad.mymovies.it/filmclub/2010/03/072/locandina.jpg'),
(4, 'Un uomo disoccupato diventa un eroe inaspettato durante un viaggio in Africa.', 'Sole a catinelle', 95, '2013-10-31', 'https://pad.mymovies.it/filmclub/2011/09/009/locandina.jpg'),
(5, 'Due uomini disperati cercano di riscattarsi con un viaggio di lavoro particolare.', 'Quo Vado?', 86, '2016-01-01', 'https://pad.mymovies.it/filmclub/2015/11/022/locandina.jpg'),
(6, 'Un comico trova la fortuna vendendo hot dog per strada.', 'La leggenda di Al, John e Jack', 100, '2002-12-20', 'https://pad.mymovies.it/filmclub/2002/12/008/locandina.jpg'),
(7, 'Un giovane sogna di diventare un grande regista.', 'Nuovo Cinema Paradiso', 155, '1988-11-17', 'https://m.media-amazon.com/images/I/91XbLFIJm3L.jpg'),
(8, 'Un giovane ragazzo intraprende un viaggio avventuroso per recuperare un\'antica ricetta di famiglia.', 'La grande abbuffata', 130, '1973-11-22', 'https://pad.mymovies.it/filmclub/2005/11/113/locandinapg1.jpg'),
(9, 'Un professore si ritrova coinvolto in una storia di amore e tradimento.', 'La Dolce Vita', 174, '1960-02-05', 'https://product-image.juniqe-production.juniqe.com/media/catalog/product/seo-cache/x800/171/205/171-205-101P/La-Dolce-Vita-Retro-Movie-Poster-Vintage-Photography-Archive-Poster.jpg'),
(10, 'Un uomo di mezza età trova un nuovo senso alla vita durante un viaggio a Parigi.', 'Il favoloso mondo di Amélie', 122, '2001-04-25', 'https://m.media-amazon.com/images/I/51F0hWdODLL._AC_UF894,1000_QL80_.jpg'),
(11, 'Un uomo si ritrova coinvolto in una serie di eventi incredibili grazie a un treno speciale.', 'Ladri di biciclette', 93, '1948-12-13', 'https://ladri_biciclette_poster.jpg'),
(12, 'Una giovane donna decide di diventare attrice durante la seconda guerra mondiale.', 'La vita è bella', 116, '1997-12-20', 'https://vita_bella_poster.jpg'),
(13, 'Un gruppo di amici intraprende un viaggio attraverso l\'Italia per sperimentare il vero significato della vita.', 'I soliti ignoti', 106, '1958-03-27', 'https://www.benitomovieposter.com/catalog/images/movieposter/23865.jpg'),
(14, 'Un musicista famoso cerca di riconciliarsi con il passato.', 'Cinema Paradiso', 123, '1988-11-17', 'https://m.media-amazon.com/images/I/51F0hWdODLL._AC_UF894,1000_QL80_.jpg'),
(15, 'Un pittore e un giornalista si incontrano in un albergo veneziano.', 'Pane e tulipani', 114, '2000-03-17', 'https://pad.mymovies.it/filmclub/2006/08/221/locandina.jpg'),
(16, 'Un ragazzo inizia a lavorare in una fabbrica di cioccolato.', 'La fabbrica di cioccolato', 115, '2005-06-29', 'https://pad.mymovies.it/filmclub/2005/05/058/locandinapg1.jpg'),
(17, 'Un gruppo di ragazzi trascorre l\'estate nella Riviera Romagnola.', 'I ragazzi della Roma violenta', 90, '1976-12-09', 'https://m.media-amazon.com/images/I/518MdR29kLL._AC_UF894,1000_QL80_.jpg'),
(18, 'Un regista deve affrontare il rapporto con sua figlia durante un viaggio in Toscana.', 'La stanza del figlio', 99, '2001-09-09', 'https://pad.mymovies.it/filmclub/2006/03/066/locandina.jpg'),
(19, 'Un uomo viene coinvolto in una serie di eventi straordinari durante la seconda guerra mondiale.', 'Amarcord', 123, '1973-12-18', 'https://m.media-amazon.com/images/I/81KTrzD0DBL.jpg'),
(20, 'Sedici anni dopo un evento traumatico, una madre e le sue due figlie si riuniscono nella casa in cui è accaduto il terribile evento. Proprio in quel luogo, le cose cominciano a prendere una strana piega.', 'La casa delle bambole', 95, '2018-03-14', 'https://pad.mymovies.it/filmclub/2017/05/234/locandina.jpg');

-- --------------------------------------------------------

--
-- Struttura della tabella `movie_actor`
--

CREATE TABLE `movie_actor` (
  `movie_id` int(11) DEFAULT NULL,
  `actor_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `movie_actor`
--

INSERT INTO `movie_actor` (`movie_id`, `actor_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 3),
(5, 3),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(11, 11),
(12, 12),
(13, 13),
(14, 14),
(15, 15),
(16, 16),
(17, 17),
(18, 18),
(19, 19),
(20, 20);

-- --------------------------------------------------------

--
-- Struttura della tabella `movie_director`
--

CREATE TABLE `movie_director` (
  `movie_id` int(11) DEFAULT NULL,
  `director_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `movie_director`
--

INSERT INTO `movie_director` (`movie_id`, `director_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 3),
(5, 3),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(11, 11),
(12, 12),
(13, 13),
(14, 14),
(15, 15),
(16, 16),
(17, 17),
(18, 18),
(19, 19),
(20, 20);

-- --------------------------------------------------------

--
-- Struttura della tabella `movie_genre`
--

CREATE TABLE `movie_genre` (
  `movie_id` int(11) DEFAULT NULL,
  `genre_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `actor`
--
ALTER TABLE `actor`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `director`
--
ALTER TABLE `director`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `movie_actor`
--
ALTER TABLE `movie_actor`
  ADD KEY `movie_id` (`movie_id`),
  ADD KEY `actor_id` (`actor_id`);

--
-- Indici per le tabelle `movie_director`
--
ALTER TABLE `movie_director`
  ADD KEY `movie_id` (`movie_id`),
  ADD KEY `director_id` (`director_id`);

--
-- Indici per le tabelle `movie_genre`
--
ALTER TABLE `movie_genre`
  ADD KEY `movie_id` (`movie_id`),
  ADD KEY `genre_id` (`genre_id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `actor`
--
ALTER TABLE `actor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT per la tabella `director`
--
ALTER TABLE `director`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT per la tabella `genre`
--
ALTER TABLE `genre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT per la tabella `movie`
--
ALTER TABLE `movie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `movie_actor`
--
ALTER TABLE `movie_actor`
  ADD CONSTRAINT `movie_actor_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`id`),
  ADD CONSTRAINT `movie_actor_ibfk_2` FOREIGN KEY (`actor_id`) REFERENCES `actor` (`id`);

--
-- Limiti per la tabella `movie_director`
--
ALTER TABLE `movie_director`
  ADD CONSTRAINT `movie_director_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`id`),
  ADD CONSTRAINT `movie_director_ibfk_2` FOREIGN KEY (`director_id`) REFERENCES `director` (`id`);

--
-- Limiti per la tabella `movie_genre`
--
ALTER TABLE `movie_genre`
  ADD CONSTRAINT `movie_genre_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`id`),
  ADD CONSTRAINT `movie_genre_ibfk_2` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
