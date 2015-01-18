-- phpMyAdmin SQL Dump
-- version 4.1.7
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Янв 15 2015 г., 20:55
-- Версия сервера: 5.5.34
-- Версия PHP: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `matriculant`
--

-- --------------------------------------------------------

--
-- Структура таблицы `matriculant`
--

CREATE TABLE IF NOT EXISTS `matriculant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` bigint(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `sex` enum('female','male') NOT NULL,
  `numberGroup` varchar(5) NOT NULL,
  `email` varchar(100) NOT NULL,
  `score` int(11) NOT NULL,
  `yearOfBirth` year(4) NOT NULL,
  `location` enum('notresident','resident') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `matriculant`
--

INSERT INTO `matriculant` (`id`, `code`, `name`, `surname`, `sex`, `numberGroup`, `email`, `score`, `yearOfBirth`, `location`) VALUES
(1, 157775, 'Коля', 'Марков', 'male', '456', 'dsfs@yandex.com', 180, 1990, 'notresident'),
(2, 25785, 'Вася', 'Пупкин', 'male', '744', 'sdfg@mail.com', 198, 1993, 'notresident'),
(3, 35785768, 'Женя', 'Соколова', 'female', '2342', 'fghj@mail.com', 165, 1997, 'resident'),
(4, 45785, 'Гаврила', 'Смирнов', 'male', '23423', 'sgjg@yandex.ru', 201, 1999, 'notresident'),
(5, 778, 'Яков', 'Измайлов', 'male', '1111', 'uhvv@mail.ru', 234, 1987, 'notresident'),
(6, 46578, 'Вака', 'Мака', 'female', 'ФО-12', 'maka@mail.com', 231, 1996, 'resident'),
(7, 87578, 'Женя', 'Ляпин', 'male', 'КО-22', 'daka@mail.com', 211, 1995, 'notresident'),
(8, 674962, 'Вася', 'Фомкин', 'male', 'ВП-13', 'erfddfa@gfbf.ru', 189, 1999, 'resident'),
(9, 704313, 'Антон', 'Феодосин', 'male', 'ВА-13', 'dsfsv@gfbf.ru', 156, 1996, 'resident');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
