-- phpMyAdmin SQL Dump
-- version 4.1.7
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Дек 24 2014 г., 00:35
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
  `name` text NOT NULL,
  `surname` text NOT NULL,
  `sex` text NOT NULL,
  `numberGroup` int(11) NOT NULL,
  `email` text NOT NULL,
  `score` int(11) NOT NULL,
  `yearOfBirth` date NOT NULL,
  `location` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `matriculant`
--

INSERT INTO `matriculant` (`id`, `name`, `surname`, `sex`, `numberGroup`, `email`, `score`, `yearOfBirth`, `location`) VALUES
(1, 'Коля', 'Марков', 'male', 456, 'dsfs@yandex.com', 180, '1995-11-11', 'notresident'),
(5, 'Вася', 'Пупкин', 'male', 744, 'sdfg@mail.com', 198, '1997-02-04', 'notresident'),
(6, 'Женя', 'Соколова', 'female', 2342, 'fghj@mail.com', 165, '1997-01-05', 'resident'),
(7, 'Гаврила', 'Смирнов', 'male', 23423, 'sgjg@yandex.ru', 201, '1999-08-12', 'notresident'),
(8, 'Яков', 'Измайлов', 'male', 1111, 'uhvv@mail.ru', 2342, '1993-02-10', 'notresident');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
