CREATE TABLE IF NOT EXISTS `matriculant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(16) NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

INSERT INTO `matriculant` (`id`, `code`, `name`, `surname`, `sex`, `numberGroup`, `email`, `score`, `yearOfBirth`, `location`) VALUES
(1, '157775', 'Коля', 'Марков', 'male', '456', 'dsfs@yandex.com', 180, 1990, 'notresident'),
(2, '25785', 'Вася', 'Пупкин', 'male', '744', 'sdfg@mail.com', 198, 1993, 'notresident'),
(3, '35785768', 'Женя', 'Соколова', 'female', '2342', 'fghj@mail.com', 165, 1997, 'resident'),
(4, '45785', 'Гаврила', 'Смирнов', 'male', '23423', 'sgjg@yandex.ru', 201, 1999, 'notresident'),
(5, '778', 'Яков', 'Измайлов', 'male', '1111', 'uhvv@mail.ru', 234, 1987, 'notresident'),
(6, '46578', 'Вака', 'Мака', 'female', 'ФО-12', 'maka@mail.com', 231, 1996, 'resident'),
(7, '87578', 'Женя', 'Ляпин', 'male', 'КО-22', 'daka@mail.com', 211, 1995, 'notresident'),
(8, '674962', 'Вася', 'Фомкин', 'male', 'ВП-13', 'erfddfa@gfbf.ru', 189, 1999, 'resident'),
(9, '704313', 'Антон', 'Феодосин', 'male', 'ВА-13', 'dsfsv@gfbf.ru', 156, 1996, 'resident'),
(10, '229722000533915', 'Вавака', 'Макарова', 'female', 'ПА-43', 'ewfsdfsa@dfdfg.en', 299, 1995, 'resident'),
(11, 'ca6cewok0bbgphb', 'Курлык', 'Курлык', 'male', 'ПИ-23', 'rtdghdhd@dfdfg.en', 232, 1995, 'notresident'),
(12, 'c345v57bde8sz5s', 'Авапвап', 'Аываыва', 'male', 'ЛО-23', 'dsfsdfdsf@fgdfg.te', 214, 1993, 'resident'),
(13, 'ucvop2se0rj0eu4w', 'Рок', 'Ыпрыпр', 'female', 'ЕР-21', 'dsfdfg@sgfhsg.com', 215, 1999, 'resident'),
(14, 'd7fb1r07e5e36qki', 'Аапрары', 'Маппоапр', 'male', 'ВЫ-52', 'wedf@shhsgh.ru', 123, 1998, 'resident');