-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Янв 24 2019 г., 15:01
-- Версия сервера: 5.7.25-0ubuntu0.18.04.2
-- Версия PHP: 7.2.10-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `Diary`
--

-- --------------------------------------------------------

--
-- Структура таблицы `taskList`
--

CREATE TABLE `taskList` (
  `id` int(11) NOT NULL,
  `task` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `taskList`
--

INSERT INTO `taskList` (`id`, `task`, `status`) VALUES
(81, 'Task1', 0),
(82, 'Task2', 0),
(83, 'Task3', 0),
(84, 'Task4', 0),
(85, 'Task5', 0),
(86, 'Task6', 0),
(87, 'Task7', 0),
(88, 'Task8', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('child','mother','father','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `role`) VALUES
(6, 'mother', '202cb962ac59075b964b07152d234b70', 'mother'),
(7, 'father', '202cb962ac59075b964b07152d234b70', 'father'),
(8, 'child', '202cb962ac59075b964b07152d234b70', 'child');

-- --------------------------------------------------------

--
-- Структура таблицы `user_task`
--

CREATE TABLE `user_task` (
  `id_user` int(11) DEFAULT NULL,
  `id_task` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_task`
--

INSERT INTO `user_task` (`id_user`, `id_task`) VALUES
(6, 81),
(6, 82),
(7, 83),
(7, 84),
(8, 85),
(8, 86),
(8, 87),
(8, 88);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `taskList`
--
ALTER TABLE `taskList`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Индексы таблицы `user_task`
--
ALTER TABLE `user_task`
  ADD KEY `id_user` (`id_user`,`id_task`),
  ADD KEY `user_task_ibfk_2` (`id_task`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `taskList`
--
ALTER TABLE `taskList`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `user_task`
--
ALTER TABLE `user_task`
  ADD CONSTRAINT `user_task_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_task_ibfk_2` FOREIGN KEY (`id_task`) REFERENCES `taskList` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
