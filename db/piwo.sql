-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 19 Sty 2023, 18:34
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
(1, 'szt.'),
(2, 'ml.');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rekord`
--

CREATE TABLE `rekord` (
  `id` int(11) NOT NULL,
  `alcohol_id` int(10) NOT NULL,
  `created_on` date NOT NULL DEFAULT current_timestamp(),
  `quantity` int(10) NOT NULL,
  `gramatura` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Zrzut danych tabeli `rekord`
--

INSERT INTO `rekord` (`id`, `alcohol_id`, `created_on`, `quantity`, `gramatura`) VALUES
(145, 1, '2023-01-09', 23, 1),
(146, 2, '2023-01-09', 150, 2),
(147, 3, '2023-01-09', 250, 2),
(148, 4, '2023-01-09', 500, 2),
(150, 1, '2023-01-09', 2, 1),
(151, 1, '2023-01-09', 2, 1),
(154, 1, '2023-01-09', 3, 1),
(155, 1, '2023-01-09', 3, 1),
(158, 1, '2023-01-09', 5, 1),
(159, 2, '2023-01-09', 50, 2),
(160, 1, '2023-01-09', 2, 1),
(161, 1, '2023-01-17', 3, 1),
(162, 1, '2023-01-17', 2, 1),
(163, 2, '2023-01-17', 200, 2),
(164, 2, '2023-01-17', 700, 2);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
