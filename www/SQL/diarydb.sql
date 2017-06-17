-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Версия сервера: 5.6.34
-- Версия PHP: 7.0.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `diarydb`
--

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE `tasks` (
  `id` int(10) UNSIGNED NOT NULL,
  `task` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `done` tinyint(1) NOT NULL,
  `id_user` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tasks`
--

INSERT INTO `tasks` (`id`, `task`, `date`, `done`, `id_user`) VALUES
(1, 'Walk', '2017-01-07 16:00:00', 1, 3),
(2, 'Prepare dinner', '2017-01-03 12:15:00', 0, 2),
(3, 'Get up', '2017-01-01 07:15:00', 1, 3),
(4, 'Clean bathroom', '2017-01-01 11:00:00', 1, 2),
(5, 'Learn lessons', '2017-01-06 16:30:00', 0, 2),
(6, 'Clean house', '2017-01-06 16:00:00', 0, 2),
(7, 'English course', '2017-01-06 14:00:00', 1, 1),
(8, 'German language course', '2017-01-06 19:30:00', 0, 3),
(9, 'Walk', '2017-02-07 16:00:00', 0, 0),
(10, 'Prepare dinner', '2017-02-03 12:15:00', 0, 0),
(11, 'Get up', '2017-02-02 07:15:00', 0, 0),
(12, 'Clean bathroom', '2017-02-02 11:00:00', 0, 0),
(13, 'Learn lessons', '2017-02-06 16:00:00', 0, 0),
(14, 'Clean house', '2017-02-06 16:00:00', 0, 0),
(15, 'English course', '2017-02-06 14:00:00', 0, 0),
(16, 'German language course', '2017-02-06 19:30:00', 0, 0),
(17, 'Walk', '2017-03-07 16:00:00', 0, 0),
(18, 'Prepare dinner', '2017-03-03 12:15:00', 0, 0),
(19, 'Get up', '2017-03-03 07:15:00', 0, 0),
(20, 'Clean bathroom', '2017-03-03 11:00:00', 0, 0),
(21, 'Learn lessons', '2017-03-03 16:00:00', 0, 0),
(22, 'Clean house', '2017-03-06 16:00:00', 0, 0),
(23, 'English course', '2017-03-06 14:00:00', 0, 0),
(24, 'German language course', '2017-03-06 19:30:00', 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `role`) VALUES
(1, 'Father', '$2y$10$1vlfLlXfJH664qION4habuPGfVGIly17iQne004TuIeZ7td814LU2', 'father'),
(2, 'Mother', '$2y$10$YCYKDaVcN4XCmtQzeo72PuSqGNtOhlFSsTv5M/9F1eWXMrK0AISRq', 'mother'),
(3, 'Child', '$2y$10$OlrsYg0VIrnA9QK.MmHOx.KvlHacI7At/knuiuF4o/RQms9M.51GS', 'child');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=832;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
