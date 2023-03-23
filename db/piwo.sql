-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 23 Mar 2023, 16:33
-- Wersja serwera: 10.4.27-MariaDB
-- Wersja PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `piwo`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `alcohols`
--

CREATE TABLE `alcohols` (
  `ID` int(11) NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Zrzut danych tabeli `alcohols`
--

INSERT INTO `alcohols` (`ID`, `type`) VALUES
(1, 'Piwsko'),
(2, 'Wóda'),
(3, 'Wino'),
(4, 'Ruda'),
(5, 'Jager');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `gramatura`
--

CREATE TABLE `gramatura` (
  `id` int(11) NOT NULL,
  `name` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Zrzut danych tabeli `gramatura`
--

INSERT INTO `gramatura` (`id`, `name`) VALUES
(1, 'szt'),
(2, 'ml');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rekord`
--

CREATE TABLE `rekord` (
  `id` int(11) NOT NULL,
  `alcohol_id` int(10) NOT NULL,
  `created_on` date NOT NULL DEFAULT current_timestamp(),
  `quantity` int(10) NOT NULL,
  `gramatura` int(11) NOT NULL,
  `user_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user` varchar(20) NOT NULL,
  `password` varchar(80) NOT NULL,
  `email` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `user`, `password`, `email`) VALUES
(1, '123456', '$2y$10$rFhyreKFk9pQtGmmAjSL5.QaoItoQNgAG5rembG9.m..SN9YYyKzy', '123456@gmail.com'),
(2, '987654', '$2y$10$xrzhtnEhQqXDasw.gbNioOEKnjqFc29B4F7BRf5uIIA2wHos63nEG', '987654@wp.pl');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `alcohols`
--
ALTER TABLE `alcohols`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `gramatura`
--
ALTER TABLE `gramatura`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `rekord`
--
ALTER TABLE `rekord`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `alcohols`
--
ALTER TABLE `alcohols`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT dla tabeli `gramatura`
--
ALTER TABLE `gramatura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `rekord`
--
ALTER TABLE `rekord`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=208;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
