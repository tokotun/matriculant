SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

CREATE DATABASE IF NOT EXISTS `matriculant` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `matriculant`;

CREATE TABLE IF NOT EXISTS `matriculant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` int(16) NOT NULL,
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
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `email_2` (`email`),
  UNIQUE KEY `key` (`code`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

INSERT INTO `matriculant` (`id`, `code`, `name`, `surname`, `sex`, `numberGroup`, `email`, `score`, `yearOfBirth`, `location`) VALUES
(1, 1, 'Коля', 'Марков', 'male', '456', 'dsfs@yandex.com', 180, 1990, 'notresident'),
(5, 2, 'Вася', 'Пупкин', 'male', '744', 'sdfg@mail.com', 198, 1993, 'notresident'),
(6, 3, 'Женя', 'Соколова', 'female', '2342', 'fghj@mail.com', 165, 1997, 'resident'),
(7, 4, 'Гаврила', 'Смирнов', 'male', '23423', 'sgjg@yandex.ru', 201, 1999, 'notresident'),
(8, 7, 'Яков', 'Измайлов', 'male', '1111', 'uhvv@mail.ru', 234, 1987, 'notresident'),
(9, 46, 'Вака', 'Мака', 'female', 'ФО-12', 'maka@mail.com', 231, 1996, 'resident'),
(10, 87, 'Женя', 'Ляпин', 'male', 'КО-22', 'daka@mail.com', 211, 1995, 'notresident'),
(11, 674962, 'Вася', 'Фомкин', 'male', 'ВП-13', 'erfddfa@gfbf.ru', 189, 1999, 'resident'),
(12, 704313, 'Антон', 'Феодосин', 'male', 'ВА-13', 'dsdsfsv@gfbf.ru', 156, 1996, 'resident');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
