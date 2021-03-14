-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 10 2021 г., 21:25
-- Версия сервера: 8.0.19
-- Версия PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `chats`
--

DELIMITER $$
--
-- Функции
--
CREATE DEFINER=`root`@`127.0.0.1` FUNCTION `VerboseCompare` (`n` INT, `m` INT) RETURNS VARCHAR(50) CHARSET utf8mb4 BEGIN
    DECLARE s VARCHAR(50);

    IF n = m THEN SET s = 'equals';
    ELSE
      IF n > m THEN SET s = 'greater';
      ELSE SET s = 'less';
      END IF;

      SET s = CONCAT('is ', s, ' than');
    END IF;

    SET s = CONCAT(n, ' ', s, ' ', m, '.');

    RETURN s;
  END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `compound`
--

CREATE TABLE `compound` (
  `id_main` int DEFAULT NULL,
  `id_teg` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `main`
--

CREATE TABLE `main` (
  `id_main` int NOT NULL,
  `question` varchar(1000) NOT NULL,
  `answer` varchar(2000) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `tegs`
--

CREATE TABLE `tegs` (
  `id_teg` int NOT NULL,
  `teg` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `compound`
--
ALTER TABLE `compound`
  ADD KEY `id_main` (`id_main`,`id_teg`),
  ADD KEY `compound_ibfk_2` (`id_teg`);

--
-- Индексы таблицы `main`
--
ALTER TABLE `main`
  ADD PRIMARY KEY (`id_main`);

--
-- Индексы таблицы `tegs`
--
ALTER TABLE `tegs`
  ADD PRIMARY KEY (`id_teg`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `main`
--
ALTER TABLE `main`
  MODIFY `id_main` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT для таблицы `tegs`
--
ALTER TABLE `tegs`
  MODIFY `id_teg` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=192;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `compound`
--
ALTER TABLE `compound`
  ADD CONSTRAINT `compound_ibfk_1` FOREIGN KEY (`id_main`) REFERENCES `main` (`id_main`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `compound_ibfk_2` FOREIGN KEY (`id_teg`) REFERENCES `tegs` (`id_teg`) ON DELETE CASCADE ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
