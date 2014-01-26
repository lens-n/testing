-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Янв 26 2014 г., 20:49
-- Версия сервера: 5.5.32
-- Версия PHP: 5.3.10-1ubuntu3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `testing_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `configs`
--

CREATE TABLE IF NOT EXISTS `configs` (
  `login` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `configs`
--

INSERT INTO `configs` (`login`, `password`) VALUES
('admin', 'admin123');

-- --------------------------------------------------------

--
-- Структура таблицы `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `courses`
--

INSERT INTO `courses` (`id`, `title`) VALUES
(1, '1'),
(2, '2'),
(3, '3'),
(4, '4'),
(5, '5');

-- --------------------------------------------------------

--
-- Структура таблицы `faculties`
--

CREATE TABLE IF NOT EXISTS `faculties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `faculties`
--

INSERT INTO `faculties` (`id`, `title`) VALUES
(1, 'КСФ'),
(2, 'ФЭУ'),
(3, 'СМФ'),
(4, 'ФМП');

-- --------------------------------------------------------

--
-- Структура таблицы `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) DEFAULT NULL,
  `faculties_id` int(11) NOT NULL,
  `cours_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`faculties_id`),
  KEY `fk_groups_faculties1` (`faculties_id`),
  KEY `fk_groups_cours1` (`cours_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `groups`
--

INSERT INTO `groups` (`id`, `title`, `faculties_id`, `cours_id`) VALUES
(4, '1', 1, 1),
(5, '2', 1, 1),
(6, '3', 1, 1),
(7, '4', 1, 2),
(8, '1', 2, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `text` text,
  `type` varchar(255) DEFAULT NULL,
  `priority` tinyint(4) DEFAULT NULL,
  `themes_id` int(11) NOT NULL,
  `subjects_id` int(11) NOT NULL,
  `answer_correct` text,
  `answers` text,
  PRIMARY KEY (`id`),
  KEY `fk_questions_themes1` (`themes_id`),
  KEY `fk_questions_subjects1` (`subjects_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Дамп данных таблицы `questions`
--

INSERT INTO `questions` (`id`, `title`, `text`, `type`, `priority`, `themes_id`, `subjects_id`, `answer_correct`, `answers`) VALUES
(5, NULL, 'База данных – это? ', '1', 0, 1, 2, 'совокупность взаимосвязанных данных, организованных по определенным правилам, предусматривающим общие принципы описания, хранения и обработки данных; ', '["\\u043d\\u0430\\u0431\\u043e\\u0440 \\u0434\\u0430\\u043d\\u043d\\u044b\\u0445, \\u0441\\u043e\\u0431\\u0440\\u0430\\u043d\\u043d\\u044b\\u0445 \\u043d\\u0430 \\u043e\\u0434\\u043d\\u043e\\u0439 \\u0434\\u0438\\u0441\\u043a\\u0435\\u0442\\u0435;","\\u0434\\u0430\\u043d\\u043d\\u044b\\u0435, \\u043f\\u0435\\u0440\\u0435\\u0441\\u044b\\u043b\\u0430\\u0435\\u043c\\u044b\\u0435 \\u043f\\u043e \\u043a\\u043e\\u043c\\u043c\\u0443\\u043d\\u0438\\u043a\\u0430\\u0446\\u0438\\u043e\\u043d\\u043d\\u044b\\u043c \\u0441\\u0435\\u0442\\u044f\\u043c.","\\u0434\\u0430\\u043d\\u043d\\u044b\\u0435, \\u043f\\u0440\\u0435\\u0434\\u043d\\u0430\\u0437\\u043d\\u0430\\u0447\\u0435\\u043d\\u043d\\u044b\\u0435 \\u0434\\u043b\\u044f \\u0440\\u0430\\u0431\\u043e\\u0442\\u044b \\u043f\\u0440\\u043e\\u0433\\u0440\\u0430\\u043c\\u043c\\u044b;"]'),
(6, NULL, 'С++ объектно ориентирован?', '0', 0, 4, 3, 'да', 'null'),
(8, NULL, 'Что такое С?', '1', 0, 4, 3, 'language', '["language2","languagewdw","language22"]'),
(9, NULL, 'Что происходит в результате присваивания ссылке?', '0', 1, 3, 3, 'Вы меняете состояние ссыльного объекта (того, на который ссылается ссылка).', 'null'),
(10, NULL, 'Иерархическая база данных – это? ', '1', 0, 1, 2, 'БД, в которой элементы в записи упорядочены, т.е. один элемент считается главным, остальные подчиненными; ', '["\\u0411\\u0414, \\u0432 \\u043a\\u043e\\u0442\\u043e\\u0440\\u043e\\u0439 \\u0438\\u043d\\u0444\\u043e\\u0440\\u043c\\u0430\\u0446\\u0438\\u044f \\u043e\\u0440\\u0433\\u0430\\u043d\\u0438\\u0437\\u043e\\u0432\\u0430\\u043d\\u0430 \\u0432 \\u0432\\u0438\\u0434\\u0435 \\u043f\\u0440\\u044f\\u043c\\u043e\\u0443\\u0433\\u043e\\u043b\\u044c\\u043d\\u044b\\u0445 \\u0442\\u0430\\u0431\\u043b\\u0438\\u0446;","\\u0411\\u0414, \\u0432 \\u043a\\u043e\\u0442\\u043e\\u0440\\u043e\\u0439 \\u0437\\u0430\\u043f\\u0438\\u0441\\u0438 \\u0440\\u0430\\u0441\\u043f\\u043e\\u043b\\u043e\\u0436\\u0435\\u043d\\u044b \\u0432 \\u043f\\u0440\\u043e\\u0438\\u0437\\u0432\\u043e\\u043b\\u044c\\u043d\\u043e\\u043c \\u043f\\u043e\\u0440\\u044f\\u0434\\u043a\\u0435; ","\\u0411\\u0414, \\u0432 \\u043a\\u043e\\u0442\\u043e\\u0440\\u043e\\u0439 \\u0441\\u0443\\u0449\\u0435\\u0441\\u0442\\u0432\\u0443\\u0435\\u0442 \\u0432\\u043e\\u0437\\u043c\\u043e\\u0436\\u043d\\u043e\\u0441\\u0442\\u044c \\u0443\\u0441\\u0442\\u0430\\u043d\\u0430\\u0432\\u043b\\u0438\\u0432\\u0430\\u0442\\u044c \\u0434\\u043e\\u043f\\u043e\\u043b\\u043d\\u0438\\u0442\\u0435\\u043b\\u044c\\u043d\\u043e \\u043a \\u0432\\u0435\\u0440\\u0442\\u0438\\u043a\\u0430\\u043b\\u044c\\u043d\\u044b\\u043c \\u0438\\u0435\\u0440\\u0430\\u0440\\u0445\\u0438\\u0447\\u0435\\u0441\\u043a\\u0438\\u043c \\u0441\\u0432\\u044f\\u0437\\u044f\\u043c \\u0433\\u043e\\u0440\\u0438\\u0437\\u043e\\u043d\\u0442\\u0430\\u043b\\u044c\\u043d\\u044b\\u0435 \\u0441\\u0432\\u044f\\u0437\\u0438."]'),
(11, NULL, 'Запись – это? ', '0', 0, 5, 2, 'Строка таблицы', 'null'),
(12, NULL, 'Поле – это?', '1', 0, 5, 2, 'Столбец таблицы', '["\\u0421\\u043e\\u0432\\u043e\\u043a\\u0443\\u043f\\u043d\\u043e\\u0441\\u0442\\u044c \\u043e\\u0434\\u043d\\u043e\\u0442\\u0438\\u043f\\u043d\\u044b\\u0445 \\u0434\\u0430\\u043d\\u043d\\u044b\\u0445; ","\\u0421\\u0442\\u0440\\u043e\\u043a\\u0430 \\u0442\\u0430\\u0431\\u043b\\u0438\\u0446\\u044b;"]');

-- --------------------------------------------------------

--
-- Структура таблицы `reports`
--

CREATE TABLE IF NOT EXISTS `reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tests_id` int(11) NOT NULL,
  `students_id` int(11) NOT NULL,
  `mark` float DEFAULT NULL,
  PRIMARY KEY (`id`,`students_id`),
  KEY `fk_reports_tests1` (`tests_id`),
  KEY `fk_reports_students1` (`students_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Дамп данных таблицы `reports`
--

INSERT INTO `reports` (`id`, `tests_id`, `students_id`, `mark`) VALUES
(10, 17, 15, 25),
(11, 17, 16, 75),
(12, 17, 15, 0),
(13, 17, 16, 0),
(14, 17, 16, 50),
(15, 17, 16, 100),
(16, 17, 15, 0),
(17, 17, 15, 0),
(18, 17, 15, 0),
(19, 17, 16, 0),
(20, 17, 15, 0),
(21, 17, 15, 0),
(22, 17, 15, 0),
(23, 17, 15, 0),
(24, 17, 15, 0),
(25, 17, 15, 25),
(26, 17, 15, 0),
(27, 17, 16, 0),
(28, 17, 16, NULL),
(29, 17, 16, 0),
(30, 17, 16, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `report_question`
--

CREATE TABLE IF NOT EXISTS `report_question` (
  `reports_id` int(11) NOT NULL,
  `questions_id` int(11) NOT NULL,
  `themes_id` int(11) NOT NULL,
  `answer` text,
  `correct` tinyint(4) DEFAULT NULL,
  `priority` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`reports_id`,`questions_id`),
  KEY `fk_questions_has_answers1_questions1` (`questions_id`) USING BTREE,
  KEY `fk_questions_has_answers1_reports1` (`reports_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `report_question`
--

INSERT INTO `report_question` (`reports_id`, `questions_id`, `themes_id`, `answer`, `correct`, `priority`) VALUES
(10, 5, 1, 'набор данных, собранных на одной дискете;', 0, '0'),
(10, 10, 1, 'бд, в которой существует возможность устанавливать дополнительно к вертикальным иерархическим связям горизонтальные связи.', 0, '0'),
(10, 11, 5, 'ghgh', 0, '0'),
(10, 12, 5, 'столбец таблицы', 1, '0'),
(11, 5, 1, 'совокупность взаимосвязанных данных, организованных по определенным правилам, предусматривающим общие принципы описания, хранения и обработки данных;', 1, '0'),
(11, 10, 1, 'бд, в которой существует возможность устанавливать дополнительно к вертикальным иерархическим связям горизонтальные связи.', 0, '0'),
(11, 11, 5, 'строка таблицы', 1, '0'),
(11, 12, 5, 'столбец таблицы', 1, '0'),
(13, 5, 1, 'данные, предназначенные для работы программы;', 0, '0'),
(14, 5, 1, 'набор данных, собранных на одной дискете;', 0, '0'),
(14, 10, 1, 'бд, в которой элементы в записи упорядочены, т.е. один элемент считается главным, остальные подчиненными;', 1, '0'),
(14, 11, 5, 't', 0, '0'),
(14, 12, 5, 'столбец таблицы', 1, '0'),
(15, 12, 5, 'столбец таблицы', 1, '0'),
(17, 5, 1, 'данные, пересылаемые по коммуникационным сетям.', 0, '0'),
(25, 5, 1, 'данные, пересылаемые по коммуникационным сетям.', 0, '0'),
(25, 10, 1, 'бд, в которой элементы в записи упорядочены, т.е. один элемент считается главным, остальные подчиненными;', 1, '0'),
(25, 11, 5, 'tgy', 0, '0'),
(25, 12, 5, 'строка таблицы;', 0, '0'),
(27, 5, 1, 'данные, пересылаемые по коммуникационным сетям.', 0, '0'),
(30, 5, 1, 'данные, пересылаемые по коммуникационным сетям.', 0, '0'),
(30, 10, 1, 'бд, в которой существует возможность устанавливать дополнительно к вертикальным иерархическим связям горизонтальные связи.', 0, '0');

-- --------------------------------------------------------

--
-- Структура таблицы `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(255) DEFAULT NULL,
  `sname` varchar(255) DEFAULT NULL,
  `pname` varchar(255) DEFAULT NULL,
  `faculty_id` int(11) NOT NULL,
  `cours_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_students_faculties1` (`faculty_id`),
  KEY `fk_students_cours1` (`cours_id`),
  KEY `fk_students_groups1` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Дамп данных таблицы `students`
--

INSERT INTO `students` (`id`, `fname`, `sname`, `pname`, `faculty_id`, `cours_id`, `group_id`) VALUES
(15, 'Александр', 'Ленский', 'Анатольевич', 1, 1, 4),
(16, 'Иван', 'Иванов', 'Иванович', 1, 1, 6);

-- --------------------------------------------------------

--
-- Структура таблицы `subjects`
--

CREATE TABLE IF NOT EXISTS `subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `subjects`
--

INSERT INTO `subjects` (`id`, `title`) VALUES
(2, 'ОБД'),
(3, 'С++');

-- --------------------------------------------------------

--
-- Структура таблицы `teachers`
--

CREATE TABLE IF NOT EXISTS `teachers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sname` varchar(100) DEFAULT NULL,
  `fname` varchar(100) DEFAULT NULL,
  `pname` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `teachers`
--

INSERT INTO `teachers` (`id`, `sname`, `fname`, `pname`) VALUES
(2, 'Рублев', 'Сергей', 'Юрьевич'),
(3, 'Вычужанин', 'Владимир', 'Викторович'),
(4, 'Меркт', 'Растислав', 'Владимирович'),
(5, 'Бойко', 'Виктор', 'Дмитриевич');

-- --------------------------------------------------------

--
-- Структура таблицы `tests`
--

CREATE TABLE IF NOT EXISTS `tests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `config` text,
  `teacher_id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `cours_id` int(11) NOT NULL,
  `themes` text NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_tests_teachers` (`teacher_id`),
  KEY `fk_tests_faculties1` (`faculty_id`),
  KEY `fk_tests_subjects1` (`subject_id`),
  KEY `fk_tests_groups1` (`group_id`),
  KEY `fk_tests_cours1` (`cours_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Дамп данных таблицы `tests`
--

INSERT INTO `tests` (`id`, `title`, `date`, `config`, `teacher_id`, `faculty_id`, `subject_id`, `group_id`, `cours_id`, `themes`, `active`) VALUES
(17, 'ОБД', NULL, '{"min_ip":"127.0.0.1","max_ip":"127.255.255.255","min":"2","max":"4"}', 2, 1, 2, 4, 1, '{"1":"1","5":"5"}', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `themes`
--

CREATE TABLE IF NOT EXISTS `themes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) DEFAULT NULL,
  `subjects_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_themes_subjects1` (`subjects_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `themes`
--

INSERT INTO `themes` (`id`, `title`, `subjects_id`) VALUES
(1, 'Введение', 2),
(2, 'Операторы', 2),
(3, 'Циклы ', 3),
(4, 'Блок if', 3),
(5, 'Элементы БД', 2);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `fk_groups_cours1` FOREIGN KEY (`cours_id`) REFERENCES `courses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_groups_faculties1` FOREIGN KEY (`faculties_id`) REFERENCES `faculties` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `fk_questions_subjects1` FOREIGN KEY (`subjects_id`) REFERENCES `subjects` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_questions_themes1` FOREIGN KEY (`themes_id`) REFERENCES `themes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `fk_reports_students1` FOREIGN KEY (`students_id`) REFERENCES `students` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reports_tests1` FOREIGN KEY (`tests_id`) REFERENCES `tests` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `report_question`
--
ALTER TABLE `report_question`
  ADD CONSTRAINT `fk_questions_has_answers1_questions1` FOREIGN KEY (`questions_id`) REFERENCES `questions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_questions_has_answers1_reports1` FOREIGN KEY (`reports_id`) REFERENCES `reports` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `fk_students_cours1` FOREIGN KEY (`cours_id`) REFERENCES `courses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_students_faculties1` FOREIGN KEY (`faculty_id`) REFERENCES `faculties` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_students_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `tests`
--
ALTER TABLE `tests`
  ADD CONSTRAINT `fk_tests_cours1` FOREIGN KEY (`cours_id`) REFERENCES `courses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tests_faculties1` FOREIGN KEY (`faculty_id`) REFERENCES `faculties` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tests_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tests_subjects1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tests_teachers` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `themes`
--
ALTER TABLE `themes`
  ADD CONSTRAINT `fk_themes_subjects1` FOREIGN KEY (`subjects_id`) REFERENCES `subjects` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
