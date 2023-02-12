-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 12 Lut 2023, 16:13
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
(146, 2, '2020-12-25', 150, 2),
(147, 3, '2022-09-09', 250, 2),
(148, 4, '2023-01-09', 500, 2),
(150, 1, '2022-01-09', 2, 1),
(151, 1, '2023-01-09', 2, 1),
(154, 1, '2023-01-09', 3, 1),
(155, 1, '2023-01-09', 1, 1),
(158, 1, '2023-01-09', 5, 1),
(159, 2, '2023-01-09', 50, 2),
(161, 1, '2023-01-17', 3, 1),
(162, 1, '2023-01-17', 2, 1),
(163, 2, '2023-01-17', 200, 2),
(164, 2, '2023-01-17', 700, 2),
(165, 1, '2023-02-02', 3, 1),
(166, 2, '2023-02-02', 200, 2),
(167, 1, '2023-02-05', 1, 1),
(168, 2, '2023-02-05', 50, 2),
(169, 3, '2023-02-05', 330, 2),
(170, 3, '2023-02-05', 200, 2),
(171, 5, '2023-02-05', 200, 2),
(172, 5, '2023-02-05', 150, 2),
(173, 5, '2023-02-05', 50, 2),
(174, 5, '2023-02-07', 150, 2),
(175, 2, '2023-02-07', 25, 2),
(176, 3, '2023-02-07', 25, 2),
(177, 4, '2023-02-07', 50, 2),
(178, 1, '2023-02-07', 3, 1),
(179, 1, '2023-02-07', 2, 1),
(181, 1, '2023-03-09', 16, 1),
(182, 2, '2023-02-12', 250, 2),
(183, 4, '2023-02-12', 250, 2);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `rekord`
--
ALTER TABLE `rekord`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `rekord`
--
ALTER TABLE `rekord`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=184;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
