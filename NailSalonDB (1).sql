-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 17 2024 г., 12:12
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `NailSalonDB`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Admin`
--

CREATE TABLE `Admin` (
  `IdAdmin` int NOT NULL,
  `FIO` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Phone` varchar(12) COLLATE utf8mb4_general_ci NOT NULL,
  `Login` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `Password` varchar(99) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `Admin`
--

INSERT INTO `Admin` (`IdAdmin`, `FIO`, `Phone`, `Login`, `Password`) VALUES
(15, 'Виктория', '86653321424', 'Victorya', '$2y$10$nairXBpJ95OTiym49npZbuwqkvL4A2eYI9DMR1vin2QpMIMFIFXY.'),
(16, 'Милла', '85522253636', 'Milya', '$2y$10$ekRJK3yF8jtpBdsqJK6NOubpsI9siDyiAy6yi4Xg4Parnxx7tmghy');

-- --------------------------------------------------------

--
-- Структура таблицы `Feedback`
--

CREATE TABLE `Feedback` (
  `IdFeetback` int NOT NULL,
  `IdRequest` int NOT NULL,
  `MasterFeetback` int NOT NULL,
  `Comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `Feedback`
--

INSERT INTO `Feedback` (`IdFeetback`, `IdRequest`, `MasterFeetback`, `Comment`) VALUES
(1, 25, 2, 'прекрасная работа, очень вежливый мастер'),
(3, 27, 5, 'понравилось');

-- --------------------------------------------------------

--
-- Структура таблицы `Klient`
--

CREATE TABLE `Klient` (
  `IdKlient` int NOT NULL,
  `KlientName` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Phone` varchar(12) COLLATE utf8mb4_general_ci NOT NULL,
  `Birthday` date NOT NULL,
  `Email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `Password` varchar(99) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `Klient`
--

INSERT INTO `Klient` (`IdKlient`, `KlientName`, `Phone`, `Birthday`, `Email`, `Password`) VALUES
(3, 'Даша', '89920144934', '2004-09-11', 'Semerovadb@gmail.com', '$2y$10$T95OpWR/f7gqMrOCvin0AOuY6Tz3v62oW/NdvTsnowyu0XRAsnz4O'),
(15, 'Александра', '899099090', '2003-04-12', 'sanaNasana@gmai.com', '$2y$10$ZnJ6NVOvltB.wEOjmrkWFeRPYOmEboKy238q4VBoi8GmfTIq2APG6'),
(16, 'Яна', '85563324523', '2003-02-11', 'yana667@mail.ru', '$2y$10$V9e7L7g3/7OfZZmMpXAhselNgE7vGMwlaDoHZ.14mP2YH8t9.LkA2'),
(17, 'Варвара', '87752253656', '1999-06-11', 'varvara@gmail.com', '$2y$10$woP06doKeapJYcejwvNdS.s74BqugK4odZMG9GC8eUWtXd6M0XoZ2'),
(18, 'Рита', '87756695232', '2007-11-29', 'wqqer@mail.ru', '$2y$10$QXgczXoJEK2ItrzCagF55e..Q6kHNywgQQbG/Sx4IhYVgrRMnXSiW');

-- --------------------------------------------------------

--
-- Структура таблицы `KlientRequest`
--

CREATE TABLE `KlientRequest` (
  `IdRequest` int NOT NULL,
  `IdKlient` int NOT NULL,
  `IdMaster` int NOT NULL,
  `Date` date NOT NULL,
  `Time` time NOT NULL,
  `Confimed` int NOT NULL,
  `Visit` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `KlientRequest`
--

INSERT INTO `KlientRequest` (`IdRequest`, `IdKlient`, `IdMaster`, `Date`, `Time`, `Confimed`, `Visit`) VALUES
(21, 3, 2, '2024-06-13', '12:00:00', 1, 1),
(22, 3, 1, '2024-06-13', '14:00:00', 1, 1),
(23, 3, 1, '2024-06-14', '14:00:00', 0, 0),
(24, 3, 2, '2024-06-21', '18:00:00', 0, 0),
(25, 3, 1, '2024-06-15', '16:00:00', 1, 1),
(26, 3, 1, '2024-06-15', '18:00:00', 1, 1),
(27, 3, 2, '2024-06-15', '12:00:00', 1, 1),
(28, 3, 2, '2024-06-15', '16:00:00', 1, 1),
(58, 17, 2, '2024-06-21', '14:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `Manager`
--

CREATE TABLE `Manager` (
  `IdManager` int NOT NULL,
  `FIO` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Phone` varchar(12) COLLATE utf8mb4_general_ci NOT NULL,
  `Login` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `Password` varchar(99) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `Manager`
--

INSERT INTO `Manager` (`IdManager`, `FIO`, `Phone`, `Login`, `Password`) VALUES
(1, 'Валиева Анастасия Тимуровна', '89956451122', 'Anastasiya', '$2y$10$.FpnLpqj98wmG9BXR9IKiujc2G./1D/hmJi6jfU2ZhlH9wiu2wp3q');

-- --------------------------------------------------------

--
-- Структура таблицы `Master`
--

CREATE TABLE `Master` (
  `IdMaster` int NOT NULL,
  `FIO` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Qualification` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `WorkExperience` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `Information` text COLLATE utf8mb4_general_ci NOT NULL,
  `Image` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `Master`
--

INSERT INTO `Master` (`IdMaster`, `FIO`, `Qualification`, `WorkExperience`, `Information`, `Image`) VALUES
(1, 'Марина', 'Мастер', '1 год', 'Классический, аппаратный и комбинированный маникюр, наращивание, укрепление ', 'ph1.png'),
(2, 'Анастасия', 'ТОП-Мастер', '3 года', 'Начала свой путь в 2018 году, делает наращивание и сложные дизайны', 'ph2.png'),
(3, 'Виолетта', 'ПРЕМИУМ-Мастер', '5 лет', 'Высокое качество покрытия, индивидуальная схема покрытия для каждого клиента и типа его ногтей', 'ph3.png');

-- --------------------------------------------------------

--
-- Структура таблицы `Notification`
--

CREATE TABLE `Notification` (
  `Id` int NOT NULL,
  `IdKlient` int NOT NULL,
  `NotifText` text COLLATE utf8mb4_general_ci NOT NULL,
  `IdRequest` int NOT NULL,
  `UrlForKlient` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `Notification`
--

INSERT INTO `Notification` (`Id`, `IdKlient`, `NotifText`, `IdRequest`, `UrlForKlient`) VALUES
(18, 3, 'Пожалуйста, оцените качество полученной услуги.', 27, 'feedback.php?requestId=27'),
(19, 3, 'Пожалуйста, оцените качество полученной услуги.', 28, 'feedback.php?requestId=28');

-- --------------------------------------------------------

--
-- Структура таблицы `Services`
--

CREATE TABLE `Services` (
  `IdServices` int UNSIGNED NOT NULL,
  `Name` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `Price` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `Services`
--

INSERT INTO `Services` (`IdServices`, `Name`, `Price`) VALUES
(1, 'Маникюр с покрытием гель-лак 1', 2500),
(2, 'Маникюр без покрытия гель-лак', 1000),
(3, 'Укрепление ногтей (гель/акрил)', 300),
(4, 'Ремонт трещины', 100),
(5, 'Снятие покрытия коррекция формы', 400),
(6, 'Наращивание одного ногтя', 200),
(7, 'Наращивание + однотонное покрытие', 3000),
(8, 'Коррекция нарощенных ногтей', 2000),
(9, 'Снятие нарощенных ногтей', 500),
(11, 'Дизайн', 150);

-- --------------------------------------------------------

--
-- Структура таблицы `VisitingRequest`
--

CREATE TABLE `VisitingRequest` (
  `IdVisitRequest` int NOT NULL,
  `IdRequest` int NOT NULL,
  `Visit` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `WorkScedule`
--

CREATE TABLE `WorkScedule` (
  `Id` int NOT NULL,
  `IdMaster` int NOT NULL,
  `Month` int NOT NULL,
  `Days` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `WorkScedule`
--

INSERT INTO `WorkScedule` (`Id`, `IdMaster`, `Month`, `Days`) VALUES
(26, 2, 6, 3),
(27, 2, 6, 4),
(28, 2, 6, 9),
(29, 2, 6, 10),
(30, 2, 6, 15),
(31, 2, 6, 16),
(32, 2, 6, 21),
(33, 2, 6, 22),
(34, 2, 6, 27),
(35, 2, 6, 28),
(44, 1, 6, 1),
(45, 1, 6, 2),
(46, 1, 6, 7),
(47, 1, 6, 8),
(48, 1, 6, 13),
(49, 1, 6, 14),
(50, 1, 6, 19),
(51, 1, 6, 20),
(52, 1, 6, 25),
(53, 1, 6, 26),
(54, 3, 6, 5),
(55, 3, 6, 6),
(56, 3, 6, 11),
(57, 3, 6, 12),
(58, 3, 6, 17),
(59, 3, 6, 18),
(60, 3, 6, 23),
(61, 3, 6, 24),
(62, 3, 6, 29),
(63, 3, 6, 30);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Admin`
--
ALTER TABLE `Admin`
  ADD PRIMARY KEY (`IdAdmin`);

--
-- Индексы таблицы `Feedback`
--
ALTER TABLE `Feedback`
  ADD PRIMARY KEY (`IdFeetback`),
  ADD KEY `IdVisitRequest` (`IdRequest`);

--
-- Индексы таблицы `Klient`
--
ALTER TABLE `Klient`
  ADD PRIMARY KEY (`IdKlient`),
  ADD KEY `Email` (`Email`);

--
-- Индексы таблицы `KlientRequest`
--
ALTER TABLE `KlientRequest`
  ADD PRIMARY KEY (`IdRequest`),
  ADD KEY `IdMaster` (`IdMaster`),
  ADD KEY `IdKlient` (`IdKlient`);

--
-- Индексы таблицы `Manager`
--
ALTER TABLE `Manager`
  ADD PRIMARY KEY (`IdManager`);

--
-- Индексы таблицы `Master`
--
ALTER TABLE `Master`
  ADD PRIMARY KEY (`IdMaster`);

--
-- Индексы таблицы `Notification`
--
ALTER TABLE `Notification`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IdKlient` (`IdKlient`),
  ADD KEY `IdRequesr` (`IdRequest`),
  ADD KEY `IdRequest` (`IdRequest`);

--
-- Индексы таблицы `Services`
--
ALTER TABLE `Services`
  ADD PRIMARY KEY (`IdServices`);

--
-- Индексы таблицы `VisitingRequest`
--
ALTER TABLE `VisitingRequest`
  ADD PRIMARY KEY (`IdVisitRequest`),
  ADD KEY `IdRequest` (`IdRequest`);

--
-- Индексы таблицы `WorkScedule`
--
ALTER TABLE `WorkScedule`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IdMaster` (`IdMaster`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Admin`
--
ALTER TABLE `Admin`
  MODIFY `IdAdmin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `Feedback`
--
ALTER TABLE `Feedback`
  MODIFY `IdFeetback` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `Klient`
--
ALTER TABLE `Klient`
  MODIFY `IdKlient` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `KlientRequest`
--
ALTER TABLE `KlientRequest`
  MODIFY `IdRequest` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT для таблицы `Manager`
--
ALTER TABLE `Manager`
  MODIFY `IdManager` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `Master`
--
ALTER TABLE `Master`
  MODIFY `IdMaster` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `Notification`
--
ALTER TABLE `Notification`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `Services`
--
ALTER TABLE `Services`
  MODIFY `IdServices` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `VisitingRequest`
--
ALTER TABLE `VisitingRequest`
  MODIFY `IdVisitRequest` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT для таблицы `WorkScedule`
--
ALTER TABLE `WorkScedule`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `Feedback`
--
ALTER TABLE `Feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`IdRequest`) REFERENCES `KlientRequest` (`IdRequest`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `KlientRequest`
--
ALTER TABLE `KlientRequest`
  ADD CONSTRAINT `klientrequest_ibfk_1` FOREIGN KEY (`IdMaster`) REFERENCES `Master` (`IdMaster`),
  ADD CONSTRAINT `klientrequest_ibfk_2` FOREIGN KEY (`IdKlient`) REFERENCES `Klient` (`IdKlient`);

--
-- Ограничения внешнего ключа таблицы `Notification`
--
ALTER TABLE `Notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`IdKlient`) REFERENCES `Klient` (`IdKlient`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `notification_ibfk_2` FOREIGN KEY (`IdRequest`) REFERENCES `KlientRequest` (`IdRequest`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `VisitingRequest`
--
ALTER TABLE `VisitingRequest`
  ADD CONSTRAINT `visitingrequest_ibfk_1` FOREIGN KEY (`IdRequest`) REFERENCES `KlientRequest` (`IdRequest`);

--
-- Ограничения внешнего ключа таблицы `WorkScedule`
--
ALTER TABLE `WorkScedule`
  ADD CONSTRAINT `workscedule_ibfk_1` FOREIGN KEY (`IdMaster`) REFERENCES `Master` (`IdMaster`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
