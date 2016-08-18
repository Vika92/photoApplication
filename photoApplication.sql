-- phpMyAdmin SQL Dump
-- version 4.0.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 18 2016 г., 22:53
-- Версия сервера: 5.6.19-log
-- Версия PHP: 5.5.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `photoApplication`
--

-- --------------------------------------------------------

--
-- Структура таблицы `albums`
--

CREATE TABLE IF NOT EXISTS `albums` (
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `albumId` int(128) NOT NULL AUTO_INCREMENT,
  `userId` int(128) NOT NULL,
  `background` varchar(255) NOT NULL,
  `dateOfCreation` int(128) NOT NULL,
  `photoTmp` varchar(255) NOT NULL,
  PRIMARY KEY (`albumId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=66 ;

--
-- Дамп данных таблицы `albums`
--

INSERT INTO `albums` (`title`, `description`, `albumId`, `userId`, `background`, `dateOfCreation`, `photoTmp`) VALUES
('My fist album', 'It shows all my life', 2, 2, '57a52722b8609.jpg', 1457887885, ''),
('My second album', 'About my dog', 3, 2, '57a52722b8610.jpg', 1466617455, ''),
('new album', 'new album', 45, 3, '57b5ff365c135.jpg', 1471545142, '57b5ff6c1be27.jpg'),
('title', 'description', 46, 16, '5799fced34c7e.jpg', 1469709549, ''),
('new album', 'new album', 51, 3, '57a704439ced7.jpg', 1470563395, '57ab9c4ec381b.jpg'),
('new album', 'new album', 52, 3, '57a70473ed314.jpg', 1470563443, ''),
('emotions', 'emotions', 53, 3, '57a704deef6b4.jpg', 1470563550, ''),
('travel', 'travel', 54, 3, '57a707ac92e6a.jpg', 1470564268, ''),
('travel', 'travel', 55, 3, '57a707ed919c7.jpg', 1470564333, ''),
('New album', 'New album', 56, 3, '57a707fda9078.jpg', 1470564349, ''),
('New album', 'New album', 57, 3, '57a70821043d4.jpg', 1470564385, ''),
('Fashion album', 'fashion', 59, 3, '57a9b6e0d183a.jpg', 1470740192, ''),
('nice life', 'my life', 65, 3, '57b5ff412ae8f.jpg', 1471545153, '');

-- --------------------------------------------------------

--
-- Структура таблицы `feedbacks`
--

CREATE TABLE IF NOT EXISTS `feedbacks` (
  `userId` int(128) NOT NULL,
  `photoId` int(128) NOT NULL,
  `title` varchar(255) NOT NULL,
  `feedbackId` int(128) NOT NULL AUTO_INCREMENT,
  `date` int(128) NOT NULL,
  PRIMARY KEY (`feedbackId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=147 ;

--
-- Дамп данных таблицы `feedbacks`
--

INSERT INTO `feedbacks` (`userId`, `photoId`, `title`, `feedbackId`, `date`) VALUES
(3, 18, 'Beautiful photo', 1, 1469782076),
(3, 18, 'Cool', 2, 1469632040),
(4, 18, 'Great', 3, 1469742407),
(4, 42, 'Perfect', 4, 1469742420),
(16, 18, 'Петрушкино селфи прекрасно', 5, 1469770800),
(16, 18, 'I like it', 11, 1469782106),
(16, 18, 'Cool photo', 12, 1469782130),
(16, 18, 'Nice', 17, 1469784169),
(16, 20, 'Cool glasses', 30, 1469784967),
(16, 20, 'Nice', 31, 1469785325),
(16, 20, 'Awesome', 32, 1469785362),
(16, 20, 'Great', 33, 1469785391),
(16, 20, 'Sweet', 34, 1469785425),
(16, 20, 'Nice', 46, 1469786545),
(16, 42, 'You are a superstar!!', 61, 1469787459),
(16, 18, 'Nice smile', 62, 1469787592),
(16, 42, 'wou', 67, 1469787867),
(16, 18, 'cool', 72, 1469790486),
(16, 18, 'cool', 73, 1469790488),
(16, 18, 'cool', 74, 1469790555),
(16, 20, 'HEYHey', 76, 1469791343),
(16, 20, 'cool', 83, 1469791654),
(16, 20, 'Nice', 84, 1469791933),
(16, 20, 'Nice', 85, 1469791988),
(16, 20, 'Nice', 88, 1469793412),
(16, 18, 'Nice', 89, 1469793518),
(16, 18, 'like it', 90, 1469793521),
(16, 20, 'like it', 91, 1469793586),
(16, 20, 'like it', 92, 1469793590),
(16, 20, 'Great', 93, 1469793594),
(16, 18, 'Great', 94, 1469793707),
(16, 18, 'Cool', 95, 1469793886),
(16, 18, 'Awesome', 96, 1469793905),
(16, 18, 'Awesome', 97, 1469794186),
(16, 18, 'Nice', 98, 1469794262),
(16, 20, 'Nice', 101, 1469794356),
(16, 20, 'Cool', 102, 1469794386),
(16, 20, 'Nice', 106, 1469794765),
(16, 20, 'Cool', 107, 1469794827),
(16, 20, 'Nice', 109, 1469794908),
(16, 20, 'Awesome', 110, 1469795202),
(16, 20, 'Awesome', 111, 1469795203),
(16, 20, 'Cool', 112, 1469795203),
(16, 20, 'Cool', 113, 1469795204),
(16, 20, 'Cool', 114, 1469795239),
(3, 21, 'Hey', 126, 1469823217),
(3, 21, 'like it', 128, 1469823335),
(3, 21, 'like it', 129, 1469823393),
(3, 21, 'like it', 130, 1469823435),
(3, 21, 'like it', 131, 1469823474),
(3, 21, 'like it', 132, 1469823488),
(3, 21, 'like it', 133, 1469823578),
(3, 20, 'like it', 135, 1469823773),
(2, 26, 'like it', 137, 1469888061),
(3, 19, 'You are at the sea', 138, 1469956849),
(3, 42, 'nice', 141, 1470669550),
(3, 41, 'nice', 144, 1470749823),
(3, 41, 'nice', 145, 1470862391),
(3, 36, 'nice', 146, 1471263252);

-- --------------------------------------------------------

--
-- Структура таблицы `likes`
--

CREATE TABLE IF NOT EXISTS `likes` (
  `likeId` int(128) NOT NULL AUTO_INCREMENT,
  `photoId` int(128) NOT NULL,
  `userId` int(128) NOT NULL,
  PRIMARY KEY (`likeId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=140 ;

--
-- Дамп данных таблицы `likes`
--

INSERT INTO `likes` (`likeId`, `photoId`, `userId`) VALUES
(36, 38, 1),
(37, 42, 1),
(38, 42, 18),
(42, 32, 4),
(43, 34, 4),
(45, 35, 9),
(46, 18, 8),
(47, 42, 8),
(48, 18, 10),
(49, 39, 10),
(50, 40, 11),
(51, 42, 11),
(67, 42, 2),
(89, 18, 2),
(90, 42, 25),
(91, 42, 23),
(122, 40, 3),
(123, 42, 3),
(126, 28, 3),
(133, 20, 3),
(137, 0, 3),
(139, 41, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `photos`
--

CREATE TABLE IF NOT EXISTS `photos` (
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `albumId` int(128) NOT NULL,
  `photoId` int(128) NOT NULL AUTO_INCREMENT,
  `photo` varchar(255) NOT NULL,
  `dateOfCreation` int(128) NOT NULL,
  `photoTmp` varchar(255) NOT NULL,
  PRIMARY KEY (`photoId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=56 ;

--
-- Дамп данных таблицы `photos`
--

INSERT INTO `photos` (`title`, `description`, `albumId`, `photoId`, `photo`, `dateOfCreation`, `photoTmp`) VALUES
('Night', 'Me at night', 36, 14, '5797ad109ba2c.jpg', 1469558032, ''),
('Я на море', 'Ах море море', 3, 19, '5798c169ac48c.jpg', 1469628777, ''),
('Я на море', 'Ах море море', 45, 20, '5798c1db35051.jpg', 1469628891, ''),
('Новое фото обновить', 'Новое фото описание', 45, 21, '5798d4816cf1f.jpg', 1469633679, ''),
('title', 'description', 46, 23, '', 1469709675, ''),
('title', 'description', 46, 24, '', 1469709678, ''),
('title', 'description', 46, 25, '579a01dc2dc24.jpg', 1469710812, ''),
('Mashenkas first photo', 'description photo', 2, 26, '579bbe5e95f60.jpg', 1469824607, ''),
('pation', 'love', 45, 36, '57a747050240f.jpg', 1470580485, ''),
('love', 'pation', 45, 39, '57a747a6d8eaa.jpg', 1470580646, '57ab15a70d265.jpg'),
('cool', 'cool', 45, 40, '57a75aa364380.jpg', 1470731080, 'images (1).jpg'),
('Good girl', 'like it', 45, 41, '57ab29c4a69a3.JPG', 1470835140, '57ab29bf75f21.JPG'),
('Hey', 'Hey', 45, 42, '57a9d7afdb220.jpg', 1470748591, ''),
('Hey', 'hey', 51, 43, '57ab9c50110eb.jpg', 1470864464, ''),
('Girl', 'girl', 60, 44, '', 1470867439, ''),
('Hello', 'Kitty!', 45, 45, '57b5ff628ebde.jpg', 1471545186, '57b5ff6066eaa.jpg'),
('dd', 'dd', 45, 54, '57b5fdbfaefa8.jpg', 1471544767, '57b5ff230e69c.jpg'),
('boy', 'boy', 45, 55, '57b5ff7220d9f.jpg', 1471545202, '');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `firstName` varchar(128) CHARACTER SET utf8mb4 NOT NULL,
  `lastName` varchar(128) CHARACTER SET utf8mb4 NOT NULL,
  `email` varchar(128) NOT NULL,
  `dateOfBirth` int(128) NOT NULL,
  `sex` varchar(128) NOT NULL,
  `status` varchar(128) NOT NULL,
  `login` varchar(128) NOT NULL,
  `password` varchar(255) NOT NULL,
  `userId` int(255) NOT NULL AUTO_INCREMENT,
  `photo` varchar(255) NOT NULL,
  `photoTmp` varchar(255) NOT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=60 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`firstName`, `lastName`, `email`, `dateOfBirth`, `sex`, `status`, `login`, `password`, `userId`, `photo`, `photoTmp`) VALUES
('Ангелина', 'Ростушкина', 'angelina@mail.ru', 546033600, 'male', 'I  am a photographer', 'angelina', '$2y$10$4zoDHjcP5zfSDv6UOtD5Uez312ivMprhap.EwlXgbcB6RU.aeocS6', 1, '57a30d9b85c37.jpg', ''),
('Mashenka', 'Pupkina', 'rthjk@mail.ru', -1975113000, 'female', 'r', 'masha', '$2y$10$PN2sGafAcqZKIymWSzg9ue4b6120RiG7kdsvUcyhakv8PDZht57Qm', 2, '579ddb716de06.jpg', ''),
('Petr', 'Petrenko', 'petrov@mail.ru', -2111623324, 'male', 'petr', 'petr', '$2y$10$Ruwv.RIojzCM7mMu5lz32OqkBWpseEnOWmeu4ILAUPW8Gg3bapRMK', 3, '57b5eddf3641c.jpg', '57b5ff3c5070a.jpg'),
('Andrey', 'Andreev', 'andr@mail.ru', -2017017000, 'male', 'Andr', 'andr1258', '$2y$10$roti5Xe9x0Eql0CgMjHmb.IjsdjTc4FL0Y.YHjIcyBAEBkWQCFmu2', 4, '579ddb716de05.jpg', ''),
('Олег', 'Семенченко', 'sem@gmail.com', -636346800, 'male', 'Hey, want to show my photos', 'oleg', 'oleg0211', 5, '579ddb716de01.jpg', ''),
('Андрей', 'Куценко', 'jiii@mail.ru', -2145925800, 'male', 'like to do selfi', '6', '111111aa', 8, '579ddb716de02.jpg', ''),
('Антон', 'Ворошилов', 'jiii@mail.ru', -2077583400, 'male', 'Watch at me', '7', 'fdgdhdd45', 9, '579ddb716de03.jpg', ''),
('Ольга', 'Плотникова', 'f@mail.ru', -1735698600, 'female', 'dfgh', 'dret', '111111aatryhj', 10, '579ddb716de08.jpg', ''),
('Геннадий', 'Шевченко', 'kernes@rambler.ru', 299883600, 'male', 'Миша тебе с таким лицом никто денег не даст', 'Gepa', 'gepa123456', 11, '579ddb716de04.jpg', ''),
('Иван', 'Петрушенко', 'rthjk@mail.ru', -2145925800, 'male', 'wedrf', '2566vfdg', 'dfbsdfbf554', 12, '579ddb716de06.jpg', ''),
('Руслан', 'Олейник', 'hello1@gmail.com', -1398996000, 'male', 'I am a super star', 'me123456', 'me123456', 13, '579ddb716de07.jpg', ''),
('Максим', 'Петренко', 'dafgdf@cvb.ry', -1861929000, 'male', 'fgsbfdgv', 'fgsb', 'fgsbg458', 14, '579ddb716de08.jpg', ''),
('Анна', 'Семенченко', 'sdv@mail.ru', 665355600, 'female', 'fgbvfb', 'fad', 'bfd568f', 15, '579ddb716de09.jpg', ''),
('Василий', 'Васильков', 'sdv@mail.ru', -2017017000, 'male', 'fgbvfb', 'dfvdfbdb', 'dfagv5896', 16, '579ddb3f9dc4c.jpg', ''),
('Артем', 'Артемов', 'adfvdf@df.re', -1975113000, 'male', 'dvfdcxfvdf', '1dfva', 'adfvdf5', 17, '579ddb716de09.jpg', ''),
('Василий', 'Грищенко', 'sfdbsf@mail.ru', -1985481000, 'male', 'afd', '1sdfba', '111111aadfsv', 18, '579ddb716de10.jpg', ''),
('Алексей', 'Бродов', 'dfzjtd@mail.ru', -1480557600, 'male', 'fd', '1fd', '111111aadaf', 19, '579ddb716de11.jpg', ''),
('Игорь', 'Есиков', 'dfzjtd@mail.ru', -1480557600, 'male', 'fdf', '1fdgfgds', 'fgdfg56', 20, '579ddb716de12.jpg', ''),
('Fedor', 'Ivanov', 'ivanov@gmail.com', 400190400, 'male', 'I am Fedor', 'fedor987', '$2y$10$3Su5wiJ82GX2TULvT/GW2OV4knuai0uo4uXURhS5sIjyIM7nP6wxC', 21, '579ddb716de13.jpg', ''),
('Виктория', 'Максимова', 'df@hgj.ru', -2145925800, 'female', 'd', 'dddd254', '$2y$10$K9xBVLpFsidH7uHh0mZu8ucRAIJLH8tGpKfy8HONilFb1n9tgaF4m', 22, '579ddb716de05.jpg', ''),
('Mary', 'Sucharenko', 'marsia_d@mail.ru', 519508800, 'male', 'Hey everybody!', 'klfgmlk', '$2y$10$PsDx/B2jcMyaFkRED/eM.eCIvyFP7Xg16UDf8ymr9pXEe4RwONQTC', 41, '57a18f343379f.jpg', ''),
('Marina', 'Kolinchenko', 'marina@mail.ru', 601678800, 'male', 'My name is Marina', '1dfgfdg', '$2y$10$O/WCG0ysGuZgV4v7ebZY6eBWQW5jv8/ZgOASsXRqjCKfdQY2z3APi', 42, '57a192503e97a.JPG', ''),
('Kirill', 'Onishenko', 'oish@mail.ru', 474584400, 'male', 'Hey, i am cool', '1dfvadf', '$2y$10$twbpvlSTZ3u3aJcR4iZOnu9xGpTQuifS8ojX/SeWjxafr9rH0yL8m', 43, '57a192c404a37.JPG', ''),
('Oleg', 'Popov', 'popov@mail.ru', 453412800, 'male', 'I am cool, look at me', 'popov', '$2y$10$7ir4Z4Kp3vfiLLRIkeokVO1tnbTi.T7dWiobvkxjnVP5dc66gWlV2', 44, '57a1947b2fa2f.JPG', ''),
('Oleg', 'Popov', 'popov@mail.ru', 453412800, 'male', 'I am cool, look at me', 'popovdffg', '$2y$10$59pc1DqmrMDxI4KHGIx5wOD.akrRNY1Kw/BwPddQs2530WFc5/NEi', 45, '57a194d9d6f96.JPG', ''),
('Alexey', 'Antonov', 'antonov@mail.ru', 978469200, 'female', 'Hey, i am cool', '1dfvgds', '$2y$10$HpUgyULGWShtKF/rfc1G7OuTtQ8F7zMA7FWvgFJEu9d5/WNnuzVSG', 46, '57a195c41efd5.jpg', ''),
('Yriy', 'Popkin', 'pop@mail.ru', 979592400, 'male', 'Hello everybody!', '1dfvaddf', '$2y$10$WzEVVUXI9E4Fd/FKz90NAObQoWJJfnk51mROJUUB.erKWwZA4duNe', 47, '57a196177caee.jpg', ''),
('Sasha', 'Cherniy', 'chern@mail.ru', 455832000, 'male', 'I am a super star', 'dvddd485', '$2y$10$pB1z.RW1UqZDyHPYD/X4Fu6QzPaxjtQRHjeXS8JenKUb7Jj9wjIZy', 48, '57a19657c461b.jpg', ''),
('Vadim', 'Panchenko', 'vadim@mail.ru', 478904400, 'male', 'Hey everybody!', 'fgb', '$2y$10$xhuKZcjQnFC8uT2LqPgtJ.nSrMtD7e1TZXgqPCUMeLwjLqTNFtjma', 49, '57a197ec93975.jpg', ''),
('Viktor', 'Panasuk', 'panasuyk@mail.ru', 478818000, 'male', 'Hello everybody!', 'Heydfv8564', '$2y$10$H3zDh.9NMo3Hs.sJrulYbOkFwsDToScdytrT0UYjUs1qKN7LWzYM6', 50, '57a198a4e0df3.jpg', ''),
('Viacheslav', 'Volkov', 'volkov@mail.ru', 447368400, 'male', 'Hello everybody!', 'dfvdfvdf', '$2y$10$1pOm1Ge1v3ufiS.5Ge3DsONDM0sI2KrUwXm0afFH/2Fsw.dH..VPW', 51, '57a199ade4159.jpg', ''),
('Pavel', 'Pavlov', 'pavel@mail.ru', 484257600, 'male', 'Hey, i am cool', 'dfvsdf561', '$2y$10$2elON.hQLrfacLVULUeMY.x.JgCe6wVDCquPvVBvsocefzglo1dNi', 54, '57a19b5c9daec.jpg', ''),
('Viktoria', 'Gritsenko', 'vika_jpg@mail.ru', 696204000, 'female', 'I like development', 'vika92', '$2y$10$dFkOI0an38gUM/ACTgbnoeqqBbNGCO4.CUOwC7qzS3jqhNf7XrhTe', 55, '57abb566c9f5c.JPG', ''),
('Marina', 'Popik', 'popik@mail.ru', 978904800, 'female', 'Hey, i am cool', 'Marina12345', '$2y$10$/hQ6P62.icMjJ1VZjEWm3erxNP3xEJm9FzWes3pRKQvw1VaBZwMVy', 58, '', ''),
('Alex', 'Band', 'alena@rambler.ru', 978386400, 'male', 'Hello world', 'alex', '$2y$10$Z8vMN.eiHK/ZE3548oqIxO3Ibf3yA0iuGe/0Wox6o8sSzUXXYiGJy', 59, '57b5ff96c5ea1.jpg', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
