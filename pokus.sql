-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Počítač: localhost
-- Vygenerováno: Pondělí 24. ledna 2011, 08:56
-- Verze MySQL: 5.1.41
-- Verze PHP: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databáze: `pokus`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `albums`
--

CREATE TABLE IF NOT EXISTS `albums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `artist_id` int(11) NOT NULL,
  `title` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Vypisuji data pro tabulku `albums`
--

INSERT INTO `albums` (`id`, `artist_id`, `title`) VALUES
(1, 1, 'pokus');

-- --------------------------------------------------------

--
-- Struktura tabulky `artists`
--

CREATE TABLE IF NOT EXISTS `artists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Vypisuji data pro tabulku `artists`
--

INSERT INTO `artists` (`id`, `name`) VALUES
(1, 'pokus');

-- --------------------------------------------------------

--
-- Struktura tabulky `guilts`
--

CREATE TABLE IF NOT EXISTS `guilts` (
  `guilt_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `guilt_title` varchar(45) COLLATE utf8_czech_ci NOT NULL,
  `guilt_descriptions` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  PRIMARY KEY (`guilt_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=6 ;

--
-- Vypisuji data pro tabulku `guilts`
--

INSERT INTO `guilts` (`guilt_id`, `guilt_title`, `guilt_descriptions`) VALUES
(1, 'Wrong language', 'Wrong language'),
(2, 'Camping', 'Camping'),
(3, 'Noobtuber', 'Noobtuber'),
(4, 'Wallhack', 'Wallhack'),
(5, 'Aimbot', 'Aimbot');

-- --------------------------------------------------------

--
-- Struktura tabulky `noobs`
--

CREATE TABLE IF NOT EXISTS `noobs` (
  `noob_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `noob_nick` varchar(45) COLLATE utf8_czech_ci NOT NULL,
  `noob_descriptions` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `noob_server` varchar(45) COLLATE utf8_czech_ci DEFAULT NULL,
  `noob_map` varchar(45) COLLATE utf8_czech_ci DEFAULT NULL,
  `noob_dateplaying` datetime DEFAULT NULL,
  `noob_dateadd` datetime NOT NULL,
  `user_id_fk` int(10) unsigned NOT NULL,
  `game_id_fk` smallint(5) unsigned NOT NULL,
  `country_iso_fk` varchar(2) COLLATE utf8_czech_ci NOT NULL,
  `noob_status` varchar(1) COLLATE utf8_czech_ci DEFAULT 'N',
  PRIMARY KEY (`noob_id`),
  UNIQUE KEY `noob_nick_UNIQUE` (`noob_nick`),
  KEY `fk_noobs_users1` (`user_id_fk`),
  KEY `fk_noobs_games1` (`game_id_fk`),
  KEY `fk_noobs_country1` (`country_iso_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=26 ;

--
-- Vypisuji data pro tabulku `noobs`
--

INSERT INTO `noobs` (`noob_id`, `noob_nick`, `noob_descriptions`, `noob_server`, `noob_map`, `noob_dateplaying`, `noob_dateadd`, `user_id_fk`, `game_id_fk`, `country_iso_fk`, `noob_status`) VALUES
(1, 'FL:IP', 'Destroy his M-COMs with C4', 'xxx', 'Nelson Bay', '2010-10-03 17:47:00', '2010-12-31 14:19:09', 1, 3, 'DE', 'Y'),
(2, 'DENNY2603', 'Incredibly score 64:0 ???', 'xxx', 'Laguna Presa', '2010-12-08 20:12:00', '2010-12-31 14:24:56', 1, 3, 'XX', 'Y'),
(3, 'NeilOr', 'Cheater and camper', 'Steam', 'Sub base', '2010-12-24 21:45:00', '2010-12-31 16:24:37', 1, 1, 'XX', 'Y'),
(5, '|R.E.D|ChickZ', 'Nice noob...', 'none', 'Trailer Park', '2010-11-12 21:15:00', '2010-12-31 16:33:02', 1, 1, 'XX', 'Y'),
(6, '<BE-VL>HARLEY', 'kill only with tube... :-(', 'Steam', 'Highrise', '2010-10-14 20:33:00', '2010-12-31 16:43:54', 1, 1, 'XX', 'Y'),
(7, '[WD] Teniente D', 'kill only with tube... :-(', 'xxx', 'Strike', '2010-10-13 23:45:00', '2011-01-01 17:18:52', 1, 1, 'XX', 'Y'),
(8, 'bOnk3rZ', 'very real score on this map...', 'Steam', 'Salvage', '2010-09-11 21:41:00', '2011-01-02 12:52:28', 1, 1, 'XX', 'Y'),
(9, 'N|R|F Snake Eye', 'master of tube', 'Steam', 'Derail', '2011-01-05 23:00:00', '2011-01-05 23:04:15', 1, 1, 'XX', 'Y'),
(10, 'alpecino Scarface.ITAL', 'Cheating noob', 'Steam', 'Highrise', '2011-01-08 03:25:00', '2011-01-10 17:51:16', 1, 1, 'IT', 'Y'),
(11, 'Nanas 1 (now have nick RoflcopterzZ)', 'Total WH in pair with noobtuber', 'Steam', 'Rundown', '2011-01-08 00:10:00', '2011-01-10 20:07:35', 1, 1, 'US', 'Y'),
(12, 'Nanas 2 (now have nick "Soldier Bear")', 'same as nanas 1 - Total WH in pair with noobtuber', 'Steam', 'Rundown', '2011-01-08 00:10:00', '2011-01-10 20:09:53', 1, 1, 'US', 'Y'),
(13, 'Sharduk CZ', 'master of tube from the Czech Republic', 'Steam', 'Invasion', '2011-01-10 22:50:00', '2011-01-11 20:05:36', 1, 1, 'CZ', 'Y'),
(14, 'Still', 'tube tube tube.. bad game', 'Steam', 'Invasion', '2011-01-10 22:50:00', '2011-01-11 20:09:56', 1, 1, 'DE', 'Y'),
(15, 'mmm', 'mmm', 'xxx', 'xxx', '2011-11-01 21:00:00', '2011-01-12 12:25:20', 1, 1, 'AF', 'Y'),
(17, 'mmmj', 'mmm', 'jjjj', 'jjjjj', '2011-11-01 21:00:00', '2011-01-12 12:31:53', 1, 1, 'AF', 'Y'),
(18, 'aaa', 'aaa', 'aaaaaa', 'aaa', '2011-11-01 21:00:00', '2011-02-01 12:33:19', 1, 1, 'AD', 'Y'),
(19, 'kkk', 'kkk', 'kkk', 'kkk', '2011-11-01 21:00:00', '2012-06-01 12:42:10', 1, 1, 'AF', 'Y'),
(20, 'mmmmm', 'ggg', 'ggggg', 'gggggg', '2011-11-01 21:00:00', '2012-06-01 12:45:06', 1, 1, 'AT', 'Y'),
(21, 'fffgdfg', 'gfdgfgdfg', 'gfgdfgdf', 'gfdfgdf', '2011-11-01 21:00:00', '2012-06-01 12:47:09', 1, 1, 'AG', 'Y'),
(22, 'bhvhg', 'vghv', 'lmkmk', 'bhb', '2011-11-01 21:00:00', '2012-05-01 12:49:11', 1, 1, 'AF', 'Y'),
(23, 'knjnjf', 'mmm', 'ffff', 'aaa', '2011-11-01 21:00:00', '2013-04-01 12:52:10', 1, 1, 'AF', 'Y'),
(24, 'kkkff', 'fffff', 'fdfdffff', 'gggggg', '2011-11-01 21:00:00', '2014-02-01 12:59:05', 1, 1, 'AF', 'Y'),
(25, 'fdsfd', 'dfsdfdf', 'fdfsf', 'Karachi', '2011-11-01 21:00:00', '2011-01-21 14:05:36', 1, 1, 'AF', 'Y');

-- --------------------------------------------------------

--
-- Struktura tabulky `noobs_to_guilts`
--

CREATE TABLE IF NOT EXISTS `noobs_to_guilts` (
  `noob_id_fk` int(10) unsigned NOT NULL,
  `guilt_id_fk` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`noob_id_fk`,`guilt_id_fk`),
  KEY `fk_noobs_has_guilts_noobs1` (`noob_id_fk`),
  KEY `fk_noobs_has_guilts_guilts1` (`guilt_id_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `noobs_to_guilts`
--

INSERT INTO `noobs_to_guilts` (`noob_id_fk`, `guilt_id_fk`) VALUES
(1, 1),
(15, 1),
(19, 1),
(23, 1),
(24, 1),
(25, 1),
(3, 2),
(5, 2),
(9, 2),
(19, 2),
(20, 2),
(22, 2),
(1, 3),
(6, 3),
(7, 3),
(9, 3),
(11, 3),
(12, 3),
(13, 3),
(14, 3),
(18, 3),
(19, 3),
(21, 3),
(24, 3),
(25, 3),
(2, 4),
(3, 4),
(5, 4),
(8, 4),
(10, 4),
(11, 4),
(12, 4),
(17, 4),
(19, 4),
(2, 5),
(3, 5),
(5, 5),
(8, 5),
(10, 5),
(19, 5),
(22, 5);

-- --------------------------------------------------------

--
-- Struktura tabulky `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `password` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Vypisuji data pro tabulku `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'demo', 'sha256$rwysbxnteh$96c0d3998928430f432da06290a4d1072c4003958f3035d74937ecb6739a08e6');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
