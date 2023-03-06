-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 06 Mar 2023, 18:23
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
(3, 'Jabolce'),
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

--
-- Zrzut danych tabeli `rekord`
--

INSERT INTO `rekord` (`id`, `alcohol_id`, `created_on`, `quantity`, `gramatura`, `user_id`) VALUES
(146, 2, '2020-12-25', 150, 2, 1),
(147, 3, '2022-09-09', 250, 2, 0),
(148, 4, '2023-01-09', 500, 2, 0),
(150, 1, '2022-01-09', 2, 1, 0),
(154, 1, '2023-01-09', 3, 1, 2),
(159, 2, '2023-01-09', 50, 2, 1),
(164, 2, '2023-01-17', 700, 2, 0),
(165, 1, '2023-02-02', 3, 1, 0),
(166, 2, '2023-02-02', 200, 2, 0),
(167, 1, '2023-02-05', 1, 1, 0),
(168, 2, '2023-02-05', 50, 2, 0),
(169, 3, '2023-02-05', 330, 2, 0),
(170, 3, '2023-02-05', 200, 2, 0),
(171, 5, '2023-02-05', 200, 2, 0),
(172, 5, '2023-02-05', 150, 2, 0),
(173, 5, '2023-02-05', 50, 2, 0),
(174, 5, '2023-02-07', 150, 2, 0),
(175, 2, '2023-02-07', 25, 2, 0),
(176, 3, '2023-02-07', 25, 2, 0),
(177, 4, '2023-02-07', 50, 2, 0),
(178, 1, '2023-02-07', 3, 1, 0),
(179, 1, '2023-02-07', 2, 1, 0),
(181, 1, '2023-03-09', 16, 1, 0),
(182, 2, '2023-02-12', 250, 2, 0),
(183, 4, '2023-02-12', 250, 2, 0),
(184, 5, '2023-02-12', 250, 2, 0),
(185, 1, '2023-02-23', 4, 1, 2),
(186, 5, '2023-02-23', 15, 2, 2),
(187, 1, '2023-02-23', 4, 1, 1),
(188, 2, '2023-02-23', 350, 2, 1),
(189, 3, '2023-02-26', 234, 2, 1),
(190, 2, '2023-02-26', 500, 2, 1),
(191, 4, '2023-02-26', 50, 2, 1),
(192, 5, '2023-02-26', 200, 2, 1),
(193, 1, '2023-03-05', 2, 1, 1),
(194, 1, '2023-03-05', 1, 1, 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=195;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
