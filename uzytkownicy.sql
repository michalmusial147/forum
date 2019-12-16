-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 03 Lis 2016, 13:44
-- Wersja serwera: 5.6.26
-- Wersja PHP: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `osadnicy`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE IF NOT EXISTS `uzytkownicy` (
  `userID` int(11) NOT NULL,
  `username` text COLLATE utf8_polish_ci NOT NULL,
  `password` text COLLATE utf8_polish_ci NOT NULL,
  `email` text COLLATE utf8_polish_ci NOT NULL,
  `subscription_expiry_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDBInnoDBddd AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`userID`, `username`, `pass`, `email`,`subscription_expiry_date`) VALUES
(1, 'adam', '$2cZXca', 'adam@gmail.com', '2017-01-15 09:30:15'),
(2, 'marek', 'asdfg', 'marek@gmail.com',  '0000-00-00 00:00:00'),
(3, 'anna', 'zxcvb', 'anna@gmail.com','0000-00-00 00:00:00'),
(4, 'andrzej', 'asdfg', 'andrzej@gmail.com',  '0000-00-00 00:00:00'),


--
-- Indexes for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `userID` (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `userID` int(1) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
  
  
  
  
  
  
  
  
  
  
  
  
  