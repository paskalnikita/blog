-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Авг 23 2017 г., 11:06
-- Версия сервера: 5.5.25
-- Версия PHP: 5.5.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `blog`
--

-- --------------------------------------------------------

--
-- Структура таблицы `ads`
--

CREATE TABLE IF NOT EXISTS `ads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(32) NOT NULL,
  `message` varchar(700) NOT NULL,
  `date` varchar(10) NOT NULL,
  `contacted` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `ads`
--

INSERT INTO `ads` (`id`, `email`, `message`, `date`, `contacted`) VALUES
(1, 'aaa@as.cp', 'asdasd', '04-Aug-201', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `blogs`
--

CREATE TABLE IF NOT EXISTS `blogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` text NOT NULL,
  `date` varchar(32) NOT NULL,
  `time` varchar(32) NOT NULL,
  `post` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=194 ;

--
-- Дамп данных таблицы `blogs`
--

INSERT INTO `blogs` (`id`, `user_id`, `date`, `time`, `post`) VALUES
(143, '7', '2017.08.02', '15:26:30', '#-not tag'),
(146, '7', '2017.08.02', '19:37:49', '7\r\n'),
(147, '7', '2017.08.02', '19:37:53', '8'),
(148, '7', '2017.08.02', '19:37:57', '9'),
(149, '7', '2017.08.02', '19:38:01', '10'),
(150, '7', '2017.08.02', '19:38:06', '11'),
(152, '7', '2017.08.02', '19:38:17', '13'),
(160, '7', '2017.08.03', '17:45:43', 'qwe'),
(162, '7', '2017.08.03', '17:47:15', 'qwe'),
(182, '7', '2017.08.05', '20:31:24', '#tag 1'),
(183, '7', '2017.08.05', '20:31:35', '#tag 2'),
(184, '7', '2017.08.05', '20:31:40', '#tag 222'),
(185, '7', '2017.08.05', '20:31:49', '#tag #new_tag'),
(186, '7', '2017.08.08', '00:02:53', 'a'),
(187, '12345', '2017.08.11', '20:25:28', 'asdasd'),
(188, '12345', '2017.08.11', '20:25:32', 'qweqwe'),
(189, '12345', '2017.08.11', '20:25:36', 'afsfsafa'),
(190, '12345', '2017.08.11', '20:25:40', '#qwe'),
(191, '12345', '2017.08.11', '20:25:45', '#123'),
(192, '7', '2017.08.11', '20:34:47', 'asdasdasda'),
(193, '7', '2017.08.11', '20:41:51', 'asdasdasda');

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `comment` text NOT NULL,
  `date` varchar(11) NOT NULL,
  `time` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=178 ;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `username`, `comment`, `date`, `time`) VALUES
(73, 1, 'paskalnikita', ':) :) :) :) :) :) :)', '2015.08.22', '12:47:40'),
(105, 2, 'paskalnikita', 'http://paskalnikita.com/user/paskalnikita', '2016.02.27', '15:59:50'),
(121, 2, 'paskalnikita', 'asd', '2017.02.22', '19:47:56'),
(151, 2, 'paskalnikita', 'asdasdas', '2017.04.27', '12:33:36'),
(152, 2, 'paskalnikita', 'asdsad', '2017.04.28', '23:30:25'),
(153, 2, 'paskalnikita', 'asdasd', '2017.04.28', '23:31:37'),
(154, 2, 'fujitsu', 'asd', '2017.05.06', '07:56:21'),
(155, 2, 'paskalnikita', 'hello it is a #tag', '2017.07.13', '00:17:27'),
(156, 2, 'paskalnikita', '&#34;#', '2017.07.13', '00:19:14'),
(157, 2, 'paskalnikita', '#qweqwe #&#39;&#39;&#39;asdas', '2017.07.13', '00:19:27'),
(158, 2, 'paskalnikita', '#############', '2017.07.13', '00:32:01'),
(159, 2, 'paskalnikita', '#tag 1', '2017.07.15', '13:49:21'),
(160, 2, 'paskalnikita', '#tag 2', '2017.07.15', '13:49:27'),
(161, 2, 'paskalnikita', '#tag3', '2017.07.15', '13:49:31'),
(162, 2, 'paskalnikita', 'not a tag', '2017.07.15', '14:10:57'),
(163, 2, 'paskalnikita', 'is a #tag', '2017.07.15', '14:11:04'),
(165, 2, 'paskalnikita', '#TAG $gat', '2017.07.18', '20:50:03'),
(166, 2, 'paskalnikita', '## #tag #gat #tag#gat', '2017.07.18', '20:50:18'),
(167, 2, 'paskalnikita', '#qew', '2017.07.18', '22:54:11'),
(168, 2, 'paskalnikita', '#qwe qwe', '2017.07.18', '22:54:17'),
(169, 2, 'paskalnikita', '#qwe rrr', '2017.07.18', '22:54:23'),
(170, 2, 'paskalnikita', '@paskalnikita', '2017.07.18', '23:58:59'),
(172, 2, 'paskalnikita', ':)', '2017.07.20', '01:43:53'),
(173, 2, 'paskalnikita', '#tag and #new_tag', '2017.07.22', '19:31:40'),
(174, 2, 'ericsson', '@paskalnikita', '2017.07.25', '23:27:49'),
(175, 2, 'Victor', '#tag #smek', '2017.07.29', '10:12:05'),
(176, 2, 'paskalnikita', 'zxczxc', '2017.08.01', '11:25:01'),
(177, 3, 'paskalnikita', 'asddasdasd', '2017.08.02', '19:27:30');

-- --------------------------------------------------------

--
-- Структура таблицы `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(32) NOT NULL,
  `message` text NOT NULL,
  `date` varchar(14) NOT NULL,
  `contacted` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=148 ;

--
-- Дамп данных таблицы `contact`
--

INSERT INTO `contact` (`id`, `email`, `message`, `date`, `contacted`) VALUES
(146, '0', 'message ', '03-Aug-2017', 0),
(147, 'paskalnikita@gmail.com', 'message ', '03-Aug-2017', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `developers`
--

CREATE TABLE IF NOT EXISTS `developers` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `message` varchar(700) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date` varchar(10) NOT NULL,
  `contacted` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `developers`
--

INSERT INTO `developers` (`id`, `message`, `email`, `date`, `contacted`) VALUES
(1, '', '', '03-Aug-201', 0),
(2, '', '', '03-Aug-201', 0),
(3, '', '', '03-Aug-201', 0),
(4, '', '', '03-Aug-201', 0),
(5, '', 'qweqwe@asda.casdasd', '03-Aug-201', 0),
(6, '', 'mmm@mm.c', '03-Aug-201', 0),
(7, 'asdasdasd', 'qweqwe@asda.casdasd', '03-Aug-201', 0),
(8, 'sdfsdfsdf', 'qweqwe@asda.casdasd', '07-Aug-201', 0),
(9, 'sdfsdfsdf', 'qweqwe@asda.casdasd', '07-Aug-201', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `friends`
--

CREATE TABLE IF NOT EXISTS `friends` (
  `user_one` int(32) NOT NULL,
  `user_two` int(32) NOT NULL,
  `type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `friends`
--

INSERT INTO `friends` (`user_one`, `user_two`, `type`) VALUES
(5, 8, '1'),
(7, 5, '1'),
(12, 6, '1'),
(6, 3423682, '1'),
(3423683, 7, '1'),
(123, 7, '1'),
(3423662, 7, '1'),
(3423682, 7, '1'),
(123, 3423682, '2'),
(3423684, 7, '1'),
(3423684, 3423682, '1'),
(15, 3423684, '2'),
(15, 3423684, '2'),
(15, 3423684, '2'),
(3423672, 7, '2'),
(12345, 7, '1');

-- --------------------------------------------------------

--
-- Структура таблицы `gallery_comments`
--

CREATE TABLE IF NOT EXISTS `gallery_comments` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `pic_id` int(32) NOT NULL,
  `user_id` int(32) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `date` varchar(12) NOT NULL,
  `time` varchar(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=104 ;

--
-- Дамп данных таблицы `gallery_comments`
--

INSERT INTO `gallery_comments` (`id`, `pic_id`, `user_id`, `comment`, `date`, `time`) VALUES
(3, 78, 7, 'asd', '2017-02-18', ''),
(6, 78, 7, 'привет', '18 Feb 2017', ''),
(7, 93, 7, 'фыв', '19 Feb 2017', ''),
(8, 93, 7, 'фывфыв', '19 Feb 2017', ''),
(9, 93, 7, 'фывфыв', '19 Feb 2017', ''),
(10, 93, 7, 'фыв', '19 Feb 2017', ''),
(11, 93, 7, 'фывфыв', '19 Feb 2017', ''),
(12, 93, 7, 'asd', '20 Feb 2017', ''),
(13, 93, 7, 'zzz', '20 Feb 2017', ''),
(14, 0, 0, 'qqqq', '20 Feb 2017', ''),
(15, 0, 0, 'aaaa', '20 Feb 2017', ''),
(16, 93, 7, '11', '20 Feb 2017', ''),
(20, 94, 7, '94', '20 Feb 2017', ''),
(21, 94, 7, '94', '20 Feb 2017', ''),
(22, 94, 7, '94', '20 Feb 2017', ''),
(23, 94, 7, '94', '20 Feb 2017', ''),
(24, 105, 7, 'qwerty', '20 Feb 2017', ''),
(25, 105, 7, 'jj', '20 Feb 2017', ''),
(26, 105, 7, 'qq', '20 Feb 2017', ''),
(27, 104, 7, 'waerdtfyguh', '20 Feb 2017', ''),
(28, 97, 7, 'awertfy', '20 Feb 2017', ''),
(29, 121, 7, 'йцу', '22 Feb 2017', ''),
(30, 112, 7, 'йц', '22 Feb 2017', ''),
(31, 119, 7, 'last last c', '22 Feb 2017', ''),
(33, 110, 0, 'j', '22 Feb 2017', ''),
(34, 78, 7, 'llll', '23 Feb 2017', ''),
(37, 112, 12345, 'asd', '23 Feb 2017', ''),
(38, 112, 12345, 'asd', '23 Feb 2017', ''),
(39, 112, 7, 'fgghhg', '28 Feb 2017', ''),
(43, 85, 7, 'as', '28 Feb 2017', ''),
(46, 78, 7, 'asdasd', '01 Mar 2017', ''),
(47, 78, 7, 'asdas', '01 Mar 2017', ''),
(48, 78, 7, 'asda', '01 Mar 2017', ''),
(49, 78, 7, 'asd', '01 Mar 2017', ''),
(50, 94, 7, 'asdasd', '01 Mar 2017', ''),
(51, 94, 7, 'asd', '01 Mar 2017', ''),
(52, 94, 7, 'a', '01 Mar 2017', ''),
(53, 94, 7, 'a', '01 Mar 2017', ''),
(54, 94, 7, 'd', '01 Mar 2017', ''),
(55, 94, 7, 'as', '01 Mar 2017', ''),
(56, 94, 7, 'aa', '01 Mar 2017', ''),
(57, 94, 7, '123', '01 Mar 2017', ''),
(58, 94, 7, 'fdsasd', '01 Mar 2017', ''),
(59, 94, 7, '00', '01 Mar 2017', ''),
(60, 94, 7, '[[', '01 Mar 2017', ''),
(61, 122, 7, 'vcxxzcv', '01 Mar 2017', ''),
(62, 122, 7, 'asdas', '01 Mar 2017', ''),
(63, 122, 7, 'asdas', '01 Mar 2017', ''),
(66, 94, 7, 'as', '02 Mar 2017', ''),
(71, 87, 7, 'asda', '04 Mar 2017', ''),
(72, 87, 7, 'asdads', '04 Mar 2017', ''),
(73, 87, 7, 'asdads', '04 Mar 2017', ''),
(74, 87, 7, 'asdads', '04 Mar 2017', ''),
(75, 87, 7, 'asdads', '04 Mar 2017', ''),
(76, 87, 7, 'asdasdasdas da sdasdasdasdasdasdasdas da sdasdasdasdasdasdasdas da sdasdasdasdasdasdasdas da sdasdasdasdasdasdasdas da sdasdasdasdasdasdasdas da sdasdasdasdasdasdasdas da sdasdasdasdasdasdasdas da sdasdasdasdasdasdasdas da sdasdasdasdasdasdasdas da sdasda', '04 Mar 2017', ''),
(77, 87, 7, 'asd', '04 Mar 2017', ''),
(80, 131, 7, 'a', '04 Mar 2017', ''),
(81, 131, 7, 'asdasd', '04 Mar 2017', ''),
(82, 131, 7, 'asdasd', '04 Mar 2017', ''),
(83, 131, 7, 'asdasd', '04 Mar 2017', ''),
(85, 144, 12345, 'qwe', '01 May 2017', ''),
(87, 144, 12345, 'qwe qwe qwqw у qeww 17:22', '01 May 2017', '17:22:15'),
(88, 85, 3423682, '#dfcgvhbjnkml', '13 Jul 2017', '00:33:35'),
(89, 85, 3423682, '#<?php echo $string;?>', '13 Jul 2017', '00:34:08'),
(90, 85, 3423682, '#we qe', '13 Jul 2017', '00:34:26'),
(91, 158, 7, 'last picppppp', '19 Jul 2017', '00:28:01'),
(92, 164, 3423682, 'sdfsfs', '25 Jul 2017', '23:19:55'),
(93, 85, 12345, 'ыыва', '02 Aug 2017', '20:28:32'),
(96, 133, 7, 'nbmn,mnbvbjnkml;,km', '05 Aug 2017', '20:39:23'),
(97, 160, 7, 'xz', '07 Aug 2017', '22:20:25'),
(98, 160, 7, 'asdsd', '07 Aug 2017', '22:21:59'),
(99, 160, 7, 'hello asdasd', '07 Aug 2017', '22:22:15'),
(100, 160, 7, 'asd', '07 Aug 2017', '22:22:51'),
(102, 164, 7, 'pppp', '07 Aug 2017', '22:23:51'),
(103, 164, 7, 'asd', '07 Aug 2017', '22:24:23');

-- --------------------------------------------------------

--
-- Структура таблицы `gallery_pics`
--

CREATE TABLE IF NOT EXISTS `gallery_pics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `pic_name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `upload_date` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=168 ;

--
-- Дамп данных таблицы `gallery_pics`
--

INSERT INTO `gallery_pics` (`id`, `user_id`, `pic_name`, `description`, `upload_date`) VALUES
(78, 0, '19.jpg', '123', '12 Aug 2016'),
(85, 123, '25.jpg', '', '21 Aug 2016'),
(93, 2, '27.jpg', '', '24 Jan 2017'),
(130, 33, '1488401330.jpg', '', '01 Mar 2017'),
(133, 123, '14928979413423680.jpg', 'ja kek 0 odir raz v den', '22 Apr 2017'),
(142, 123, '14932890727.jpg', '', '27 Apr 2017'),
(144, 7, '14934772343423682.jpg', 'Potato!', '29 Apr 2017'),
(145, 7, '1488401330.jpg', '', '06 May 2017'),
(149, 7, '14989984887.jpg', '', '02 Jul 2017'),
(151, 7, '14991128787.jpg', '', '03 Jul 2017'),
(152, 7, '14991128847.jpg', '', '03 Jul 2017'),
(153, 7, '14991128907.jpg', '', '03 Jul 2017'),
(154, 7, '14991128977.jpg', '', '03 Jul 2017'),
(155, 7, '14991129047.jpg', '', '03 Jul 2017'),
(156, 7, '14991129107.jpg', '', '03 Jul 2017'),
(157, 7, '14991129237.jpg', '', '03 Jul 2017'),
(158, 7, '14998982327.jpg', 'qweqweqew #qwe aadsaads asdas$242 #q', '13 Jul 2017'),
(159, 7, '15000796287.jpg', 'dfgdssdgsdg', '15 Jul 2017'),
(160, 7, '15000802417.jpg', 'bong', '15 Jul 2017'),
(161, 7, '15000805117.jpg', 'kosmonaut', '15 Jul 2017'),
(164, 3423682, '15010175213423682.jpg', 'desc', '25 Jul 2017'),
(165, 12345, '150131598112345.jpg', 'llll sdfsd', '29 Jul 2017'),
(166, 12345, '150169861012345.jpg', 'аываываываы', '02 Aug 2017'),
(167, 0, '1502135675.jpg', 'asdasda', '07 Aug 2017');

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `message` text NOT NULL,
  `unread` varchar(1) NOT NULL DEFAULT '1',
  `date` varchar(10) NOT NULL,
  `time` varchar(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=393 ;

--
-- Дамп данных таблицы `messages`
--

INSERT INTO `messages` (`id`, `from`, `to`, `message`, `unread`, `date`, `time`) VALUES
(266, 7, 123, 'от 7 к 123', '0', '2015.09.19', '15:44:15'),
(267, 7, 12345, 'от 7 к 12345', '0', '2015.09.19', '15:44:27'),
(268, 12345, 7, 'от виктора никите\r\n', '0', '2015.09.19', '15:47:37'),
(269, 12345, 7, 'снова от виктора никите', '0', '2015.09.19', '15:47:43'),
(270, 12345, 7, 'ниете от виктора', '0', '2015.09.19', '16:03:45'),
(271, 7, 123, '123', '1', '2015.09.19', '20:49:33'),
(272, 12345, 7, 'никтие от виктора\r\n', '0', '2015.09.19', '20:50:20'),
(273, 12345, 7, 'asd', '0', '2015.09.19', '20:53:18'),
(274, 12345, 7, 'asfasfa', '0', '2015.09.19', '20:53:22'),
(275, 12345, 7, 'asfafasf', '0', '2015.09.19', '20:53:24'),
(276, 12345, 7, 'asfafasfasf', '0', '2015.09.19', '20:53:28'),
(277, 7, 123, 'от 7 к 123\r\n', '1', '2015.09.19', '20:56:34'),
(278, 7, 123, 'от 7 к 123 22222', '1', '2015.09.19', '20:56:42'),
(279, 12345, 7, 'от виктора никите', '0', '2015.09.19', '20:57:49'),
(280, 12345, 7, 'от aedasdasd ', '0', '2015.09.19', '20:58:00'),
(281, 1, 7, 'от никта никите', '0', '2015.09.19', '20:59:10'),
(282, 3423664, 7, 'от фывфывфыв', '0', '2015.09.19', '20:59:38'),
(283, 7, 12345, 'sdfsdf', '0', '2015.09.19', '21:02:21'),
(284, 12345, 7, 'sdfsd', '0', '2015.09.20', '11:53:00'),
(285, 12345, 7, 'asdasdas', '0', '2015.09.20', '11:56:37'),
(286, 12345, 7, 'sd', '0', '2015.09.20', '11:57:09'),
(287, 12345, 7, 'sdfsd', '0', '2015.09.20', '14:35:46'),
(288, 12345, 7, 'dasda', '0', '2015.09.21', '10:33:45'),
(289, 12345, 7, 'qwer', '0', '2015.09.21', '10:38:51'),
(290, 12345, 7, 'sdgdgg', '0', '2015.09.21', '10:38:59'),
(291, 7, 7, 'Hello Nikita!', '0', '2015.09.21', '10:40:47'),
(292, 7, 7, '1234', '0', '2015.09.21', '10:40:59'),
(293, 1, 7, 'Hello paskalnikita!', '0', '2015.09.23', '18:52:56'),
(294, 7, 12345, '111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111', '0', '2015.09.25', '14:55:46'),
(295, 7, 12345, '111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111', '0', '2015.09.25', '14:57:00'),
(296, 7, 1, '@paskalnikita', '0', '2015.09.26', '10:19:18'),
(297, 3423673, 7, '123124', '0', '2015.12.30', '11:53:08'),
(298, 7, 12345, 'zxc', '0', '2016.01.28', '18:31:41'),
(299, 7, 12345, 'ghdsbhdbsdjb', '0', '2016.02.02', '00:59:02'),
(300, 7, 7, 'llkmnbn', '0', '2016.02.05', '17:52:13'),
(301, 1, 7, '@user\r\n', '0', '2016.02.05', '17:59:15'),
(302, 1, 7, 'мить', '0', '2016.02.12', '11:48:38'),
(303, 7, 1, 'привет hello ys how are ', '1', '2016.02.17', '13:02:18'),
(304, 7, 1, 'ad ', '1', '2016.02.17', '13:02:50'),
(305, 7, 1, 'ad ', '1', '2016.02.17', '13:03:08'),
(306, 7, 1, 'привет какы hello asd]', '1', '2016.02.17', '13:03:19'),
(307, 7, 7, 'zxc', '0', '2016.02.17', '13:05:50'),
(308, 12345, 7, 'ываываываываыв\r\n', '0', '2016.02.17', '13:06:17'),
(309, 12345, 7, 'fsdfsdf \r\nsdfs', '0', '2016.02.17', '13:06:22'),
(310, 7, 12345, 's', '0', '2016.02.17', '14:08:58'),
(311, 7, 12345, 's', '0', '2016.02.17', '14:09:03'),
(312, 7, 12345, 's', '0', '2016.02.17', '14:09:05'),
(313, 7, 12345, 's', '0', '2016.02.17', '14:09:07'),
(314, 7, 12345, 's', '0', '2016.02.17', '14:09:10'),
(315, 7, 12345, 'asd', '0', '2016.02.21', '02:59:28'),
(316, 7, 12345, 'asd', '0', '2016.02.21', '02:59:40'),
(317, 7, 12345, 'zxczxczxc', '0', '2016.02.21', '02:59:46'),
(318, 7, 15, 'рун\r\n', '1', '2016.03.03', '20:12:33'),
(319, 7, 15, 'рун\r\n', '1', '2016.03.03', '20:12:40'),
(320, 7, 15, 'привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd привет как да sd ', '1', '2016.03.03', '20:12:51'),
(321, 7, 7, 'sdf', '0', '2016.03.23', '15:05:07'),
(322, 7, 7, 'sdf', '0', '2016.03.23', '15:06:20'),
(323, 7, 7, 'sdf', '0', '2016.03.23', '15:07:09'),
(324, 7, 7, 'sdf', '0', '2016.03.23', '15:07:21'),
(325, 7, 7, 'sdf', '0', '2016.03.23', '15:07:50'),
(326, 7, 7, 'sdf', '0', '2016.03.23', '15:08:14'),
(327, 7, 7, 'sdfsdfsdfkjsdk sjdfsdfsf', '0', '2016.03.23', '15:08:31'),
(328, 7, 7, 'sdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddsddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd', '0', '2016.03.23', '15:17:51'),
(329, 7, 123, '.....', '1', '2016.03.24', '15:54:12'),
(330, 12345, 7, 'ok', '0', '2016.03.26', '10:01:21'),
(331, 12345, 7, 'rxdctfyuh', '0', '2016.04.10', '11:59:19'),
(332, 12345, 7, 'cgvhbjn', '0', '2016.04.10', '11:59:23'),
(333, 7, 7, 'ываыва\r\n\r\n', '0', '2016.07.08', '20:08:32'),
(334, 7, 7, 'фыв', '0', '2016.07.08', '20:10:38'),
(335, 7, 7, 'фыв', '0', '2016.07.08', '20:12:21'),
(336, 12345, 7, 'ты тут?', '0', '2016.07.18', '17:03:27'),
(337, 7, 123, 'afajkfahaasfjfjfjfjfhfa hj', '1', '2016.12.12', '19:33:49'),
(338, 12345, 7, 'фsdasdasds', '0', '2017.01.12', '13:59:52'),
(339, 12345, 7, '123 1231 23 nans', '0', '2017.01.12', '20:15:06'),
(340, 12345, 7, '1231312 ', '0', '2017.01.12', '20:15:12'),
(341, 7, 12345, ' aj sj sasj dj dasj dsj as', '0', '2017.01.12', '20:17:32'),
(342, 7, 12345, 'as das d', '0', '2017.01.12', '20:17:36'),
(343, 7, 12345, 'qweqwe', '0', '2017.02.07', '14:49:53'),
(344, 12345, 7, 'qwew qwe wq', '0', '2017.02.07', '14:50:07'),
(345, 7, 7, 'фывфыв', '0', '2017.02.22', '19:17:49'),
(346, 7, 7, 'йй', '0', '2017.02.22', '19:18:06'),
(347, 7, 7, 'фыв', '0', '2017.02.22', '19:18:14'),
(348, 7, 7, 'sdf', '0', '2017.02.22', '19:18:31'),
(349, 7, 7, 'll', '0', '2017.02.22', '19:18:48'),
(350, 7, 1, 'ads', '1', '2017.03.03', '01:45:54'),
(351, 7, 1, 'czxc', '1', '2017.03.03', '01:45:57'),
(352, 3423682, 3423682, 'qwe', '0', '2017.05.01', '17:26:05'),
(353, 3423682, 12345, 'qwe qwe qwe', '0', '2017.05.01', '17:26:22'),
(354, 12345, 3423682, 'uuu  г гг ', '0', '2017.05.01', '17:30:06'),
(355, 12345, 3423682, 'йцуйцу', '0', '2017.05.01', '17:30:12'),
(356, 3423682, 12345, 'qwe', '0', '2017.05.01', '17:32:31'),
(357, 12345, 3423682, 'qweqweqw', '0', '2017.05.01', '17:33:04'),
(358, 3423682, 12345, 'jhbkn', '0', '2017.05.01', '17:33:57'),
(359, 7, 7, 'qwe', '0', '2017.05.03', '23:35:02'),
(360, 3423682, 3423682, 'pp', '0', '2017.05.03', '23:36:39'),
(361, 7, 3423682, 'ppppkm', '0', '2017.05.03', '23:37:12'),
(362, 3423683, 7, 'йцу', '0', '2017.05.11', '23:31:08'),
(363, 3423683, 7, 'фвы', '0', '2017.05.11', '23:31:11'),
(364, 3423683, 7, 'фв', '0', '2017.05.11', '23:31:14'),
(365, 7, 7, 't', '0', '2017.05.12', '00:00:29'),
(366, 7, 3423664, 'ending messages\r\nTotal messages:1\r\nDialog with asdf:\r\n2015.09.19\r\nasdf:\r\nот фывфывфыв', '1', '2017.05.13', '22:41:54'),
(367, 7, 3423664, 'ending messages\r\nTotal messages:1\r\nDialog with asdf:\r\n2015.09.19\r\nasdf:\r\nот фывфывфыв', '1', '2017.05.13', '22:41:58'),
(368, 7, 3423664, 'ending messages\r\nTotal messages:1\r\nDialog with asdf:\r\n2015.09.19\r\nasdf:\r\nот фывфывфыв', '1', '2017.05.13', '22:42:02'),
(369, 7, 3423664, 'ending messages\r\nTotal messages:1\r\nDialog with asdf:\r\n2015.09.19\r\nasdf:\r\nот фывфывфыв', '1', '2017.05.13', '22:42:07'),
(370, 3423683, 7, 'dfg', '0', '2017.06.24', '12:07:46'),
(371, 7, 3423683, 'qwe', '0', '2017.07.01', '23:10:31'),
(372, 3423683, 7, 'asdasd', '0', '2017.07.01', '23:11:37'),
(373, 7, 3423683, 'asdasd', '0', '2017.07.01', '23:13:00'),
(374, 3423683, 7, '1\r\n', '0', '2017.07.01', '23:18:46'),
(375, 3423683, 7, '2', '0', '2017.07.01', '23:18:50'),
(376, 3423683, 7, 'sad asd ads sd sdaa sd sa', '0', '2017.07.02', '00:50:11'),
(377, 3423683, 7, 'asd asdasd', '0', '2017.07.02', '00:50:15'),
(378, 12345, 7, 'qwrqwr qwr qwrqw', '0', '2017.07.02', '00:50:33'),
(379, 12345, 7, 'qwrqwrqwqwr', '0', '2017.07.02', '00:50:39'),
(380, 12345, 7, 'qwrqwr', '0', '2017.07.02', '00:50:43'),
(381, 3423682, 7, 'qwr', '0', '2017.07.02', '00:51:03'),
(382, 3423683, 7, 'qweqwe', '0', '2017.07.05', '23:52:02'),
(383, 3423683, 7, 'sdfs', '0', '2017.07.05', '23:52:05'),
(384, 7, 7, '@user', '0', '2017.07.19', '00:20:12'),
(385, 3423682, 7, 'sdfasdfsadfasdfa', '0', '2017.07.25', '23:20:59'),
(386, 7, 7, 'qwe', '0', '2017.07.28', '17:21:30'),
(387, 12345, 7, 'fsdfsd s  sd   sdfsdfds', '0', '2017.07.29', '10:12:41'),
(388, 7, 12345, 'asd', '0', '2017.08.05', '20:26:02'),
(389, 7, 12345, 'rbnjfgdfg', '0', '2017.08.07', '22:37:28'),
(390, 7, 12345, 'asda', '0', '2017.08.07', '22:37:32'),
(391, 12345, 7, 'q', '0', '2017.08.07', '22:38:02'),
(392, 12345, 7, 'sitize', '0', '2017.08.07', '22:38:51');

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `header` text NOT NULL,
  `m_desc` text NOT NULL,
  `desc` text NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `title`, `header`, `m_desc`, `desc`, `date`) VALUES
(1, 'Lorem', 'Lorem', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.a', '<img src="images/news/1.jpg" width=160 height=160 class="leftimg"> Доброго времени суток! С сегодняшнего дня,а точнее с 1 сентября 2014 г. официально запущен сайт travel-pleasure.com!Сайт будет посвящен путешествиям,ведь я думаю,что каждый любит путешествовать по миру,но не всегда это получается.Теперь у Вас  есть возможность "путешествовать" не выходя из дома,оставаясь в теплой кровати.На данном сайте я бы хотел показать Вам в какие места в мире Вы можете съездить и как-то помочь Вам в выборе места,в которое Вы возможно отправитесь.Сайт написан полностью с нуля,и то,что Вы видите сейчас,не является конечным результатом того,как он будет выглядеть.Весь успех данного проекта на <b>99%</b> зависит от Вас. Если Вы хотите как-либо помочь проекту,то Вы можете это сделать.Пока над проектом работает только один человек,но Вы также можете принять активное участие в развитии данного проекта,если Вас заинтересовал данный проект,обратитесь пожалуйста по адресу <a href="mailto:nikitapaskal@gmail.com">nikitapaskal@gmail.com</a>.Предложить идею вы можете в разделе\n<a href="ideas.php">\n<img src="images/ideas.ico">\nПредложить идею</a>.Это своего рода гостевая книга.\nПринимается абсолютно любая помощь,начиная с помощи в написании статей и заканчивая материальной.Помните,над проектом работает один человек,и перед тем как писать негативный отзыв,подумайте,а смог ли бы я следить за всем этим?', '2014-09-01'),
(2, 'Lorem', 'Lorem', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2014-09-22'),
(3, 'asd', 'aasdasd', 'asdasd', 'asdasda', '0000-00-00');

-- --------------------------------------------------------

--
-- Структура таблицы `pic_likes`
--

CREATE TABLE IF NOT EXISTS `pic_likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pic_id` int(32) NOT NULL,
  `user_id` int(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=104 ;

--
-- Дамп данных таблицы `pic_likes`
--

INSERT INTO `pic_likes` (`id`, `pic_id`, `user_id`) VALUES
(70, 144, 7),
(81, 144, 7),
(82, 144, 7),
(83, 144, 7),
(84, 144, 7),
(86, 144, 12345),
(87, 110, 3423682),
(88, 144, 12345),
(89, 145, 7),
(90, 131, 3423683),
(91, 144, 7),
(93, 142, 7),
(94, 85, 3423682),
(95, 85, 7),
(97, 152, 3423683),
(102, 164, 7),
(103, 133, 7);

-- --------------------------------------------------------

--
-- Структура таблицы `support`
--

CREATE TABLE IF NOT EXISTS `support` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `pic` varchar(32) NOT NULL,
  `date` varchar(14) NOT NULL,
  `solved` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=143 ;

--
-- Дамп данных таблицы `support`
--

INSERT INTO `support` (`id`, `user_id`, `message`, `pic`, `date`, `solved`) VALUES
(116, 7, 'qqqq', '1501200931.jpg', '28-Jul-2017', 0),
(117, 7, 'тщзшсешкнуу', '0.jpg', '28-Jul-2017', 0),
(118, 7, 'тщзшсешкнуу', '0.jpg', '28-Jul-2017', 0),
(119, 7, 'тщзшсешкнуу', '0.jpg', '28-Jul-2017', 0),
(120, 7, 'тщзшсешкнуу', '0.jpg', '28-Jul-2017', 0),
(121, 7, 'sss', '0.jpg', '28-Jul-2017', 0),
(122, 7, 'bug sss', '1501201354.jpg', '28-Jul-2017', 0),
(123, 7, '------------------------', '', '28-Jul-2017', 0),
(124, 7, 'have pic', '1501201449.jpg', '28-Jul-2017', 0),
(125, 7, 'pcitureeeeeeeeeeeeeeeeeee', '1501201509.jpg', '28-Jul-2017', 0),
(126, 7, 'yes', '1501201593.jpg', '28-Jul-2017', 0),
(127, 7, 'no', '', '28-Jul-2017', 0),
(128, 7, 'bug', '', '28-Jul-2017', 0),
(129, 7, 'bugg', '', '28-Jul-2017', 0),
(130, 7, 'aaa', '', '28-Jul-2017', 0),
(131, 7, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '', '28-Jul-2017', 0),
(132, 7, 'havepic no problem', '1501251723.jpg', '28-Jul-2017', 0),
(133, 7, 'no picture ', '', '28-Jul-2017', 0),
(134, 7, '<?php echo "asd";?>', '1501252307.jpg', '28-Jul-2017', 0),
(135, 7, '', '1501252375.jpg', '28-Jul-2017', 0),
(136, 7, '', '1501252456.jpg', '28-Jul-2017', 0),
(137, 7, ' echo hello asdasd\r\nasdsaf\r\nDROP TABlE', '1501252513.jpg', '28-Jul-2017', 0),
(138, 7, 'asdasdasdasd', '', '01-Aug-2017', 0),
(139, 7, 'qewqee', '', '01-Aug-2017', 0),
(140, 7, 'qwe', '', '01-Aug-2017', 0),
(141, 7, 'aaaa', '', '01-Aug-2017', 0),
(142, 7, 'zcx', '', '01-Aug-2017', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `first_name` varchar(32) NOT NULL,
  `last_name` varchar(32) NOT NULL,
  `gender` varchar(32) NOT NULL,
  `birth_day` int(2) NOT NULL,
  `birth_month` int(2) NOT NULL,
  `birth_year` int(4) NOT NULL,
  `country` varchar(32) NOT NULL,
  `state` varchar(32) NOT NULL,
  `city` varchar(32) NOT NULL,
  `street` varchar(32) NOT NULL,
  `house_number` int(7) NOT NULL,
  `zip_code` varchar(11) NOT NULL DEFAULT '0',
  `email` varchar(32) NOT NULL,
  `email_code` varchar(32) NOT NULL,
  `password_recover` int(11) NOT NULL,
  `profile` varchar(55) NOT NULL DEFAULT 'images/profile/default.jpg',
  `reg_date` varchar(11) NOT NULL,
  `ip` varchar(32) NOT NULL,
  `type` int(11) NOT NULL DEFAULT '0',
  `online_time` int(255) NOT NULL DEFAULT '0',
  `allow_email` int(11) NOT NULL DEFAULT '1',
  `remember_token` varchar(32) NOT NULL,
  `first_log_in` int(1) NOT NULL DEFAULT '1',
  `active` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3423685 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `first_name`, `last_name`, `gender`, `birth_day`, `birth_month`, `birth_year`, `country`, `state`, `city`, `street`, `house_number`, `zip_code`, `email`, `email_code`, `password_recover`, `profile`, `reg_date`, `ip`, `type`, `online_time`, `allow_email`, `remember_token`, `first_log_in`, `active`) VALUES
(1, 'nikitapaskal', 'bf8064f79da227ae08521a23cf8e24d3', 'nikitapaskal', 'nikitapaskal', '', 0, 0, 0, 'None', 'None', 'None', 'None', 0, 'None', 'nikitapaskal@gmail.com', '78ce37922516bce19a4756ca5fa889a0', 0, 'images/profile/default.png', '15.07.2015', '0', 0, 1487299583, 1, '', 0, 1),
(5, 'dfsdf', 'sdfsdf', 'sdfs', 'dfsdfs', 'df', 0, 0, 0, 'None', 'None', 'None', 'None', 0, 'None', '', '', 0, 'images/profile/default.png', '', '0', 0, 1454416728, 1, '', 1, 1),
(7, 'paskalnikita', 'bf8064f79da227ae08521a23cf8e24d3', 'Nikita', 'Paskal', 'male', 7, 7, 1997, 'O', 'qweq', '', '', 0, '', 'paskalnikita@gmail.com', '7', 0, 'images/profile/75d83f2110.jpg', '07.07.2017', '178.124.150.28', 1, 1503085598, 1, '54061746844b0206fb4a87a09a77b5e0', 0, 1),
(15, 'test', 'bf8064f79da227ae08521a23cf8e24d3', 'Eddy', 'Wazowski', 'male', 19, 3, 1985, 'sd', 'popop', 'sdfwerwer', 'sdfwer', 123, '0123123', 'addywaz@mail.com', 'd056d8daeb0fbbc769479648dfa233e5', 0, 'images/profile/8be195c569.jpg', '05.04.2015', '0', 0, 0, 1, '', 1, 1),
(123, 'user', 'd3f39ba627be52f2f675acf440ad82a5', 'useruser', 'UsernameUsername', '', 0, 0, 0, 'None', 'None', 'None', 'None', 0, 'None', 'user@mail.com', 'eb4b9bc55055b1884dbade6d67c94a1f', 0, 'images/profile/default.png', '14.07.2015', '0', 0, 0, 1, '', 1, 1),
(12345, 'Victor', 'bf8064f79da227ae08521a23cf8e24d3', 'Victor', 'Horn', 'male', 5, 9, 1976, 'None', 'None', 'None', 'None', 9, '32483', 'Victor@mail.com', '7b80e0f640b9da5669f23f24b5ed26cc', 0, 'images/profile/1d5766cb62.jpg', '28.04.2015', '0', 0, 1502476442, 1, '54061746844b0206fb4a87a09a77b5e0', 0, 1),
(3423660, 'paskalnikita123', '691ff2d270100d44fb9bd7383ff4b9ac', 'paskalnikita123', 'paskalnikita123', '', 0, 0, 0, 'None', 'None', 'None', 'None', 0, 'None', 'paskalnikita123@gamil.com', '28b08154dca753dc0aa0ad0e1fbbed94', 0, 'images/profile/default.png', '14.07.2015', '0', 0, 0, 1, '', 1, 1),
(3423662, '-----1', '1049633bd35e12b9c63a23a53c4fbaca', '-----1-----1', '-----1-----1', '', 0, 0, 0, 'None', 'None', 'None', 'None', 0, 'None', '-----1-----1@mail.com', '059089ba62e34c420e2f050e2adfc9da', 0, 'images/profile/default.png', '17.07.2015', '0', 0, 0, 1, '', 1, 1),
(3423663, 'paskalnikita123paskalnikita123', '12c423274bb4d58691da27c443346369', 'paskalnikita123paskalnikita123', 'paskalnikita123', '', 0, 0, 0, 'None', 'None', 'None', 'None', 0, 'None', 'paskalnikita123@yahoo.com', '2407e68afb52f221e57a0b911d010176', 0, 'images/profile/default.png', '21.07.2015', '0', 0, 0, 1, '', 1, 1),
(3423664, 'asdf', '08afd6f9ae0c6017d105b4ce580de885', 'asdfas', 'asdfa', 'male', 14, 1, 1983, 'None', 'None', 'None', 'None', 0, 'None', 'asdfasdfasdf@asdf.com', '5f0235fc0559c198b87328f11e3e4c44', 0, 'images/profile/default.png', '27.07.2015', '0', 0, 0, 1, '', 1, 1),
(3423665, 'nikitauser', '2e0f13c7745428c2c1d78cd836783352', 'nikitauser', 'nikitauser', '', 0, 0, 0, 'None', 'None', 'None', 'None', 0, 'None', 'nikitauser@mail.com', 'a6264a903c9ad013fb963139db34169e', 0, 'images/profile/default.png', '16.08.2015', '0', 0, 1454415583, 1, '', 1, 0),
(3423666, 'nik', 'b98ac82b2ae59cc4288465630b28542e', 'nik', 'nik', '', 0, 0, 0, 'None', 'None', 'None', 'None', 0, 'None', 'niknik@mail.com', '48822778f4c5864bcd4d87d515fe6ec2', 0, 'images/profile/97dd22a77f.jpg', '20.08.2015', '0', 0, 0, 1, '', 1, 1),
(3423667, 'paskalnikita111', 'ce4f9cef9ddb18ca8afc6b2a2ce44b87', 'paskalnikita111paskalnikita111', 'paskalnikita111paskalnikita111', '', 0, 0, 0, 'None', 'None', 'None', 'None', 0, 'None', 'paskalnikita111paskalnikita111@m', '0bdfbf25133ca2fa4bd79dc4b6cb8ad8', 0, 'images/profile/default.png', '21.08.2015', '0', 0, 0, 1, '', 1, 1),
(3423668, 'qweqweqweqwe', 'd583667ba83397298563a0cff25af133', 'qweqweqweqwe', 'qweqweqweqwe', '', 0, 0, 0, 'None', 'None', 'None', 'None', 0, 'None', 'qweqweqweqwe@vk.com', '706a8f1f08195fce1b7415d99b4d66d9', 0, 'images/profile/default.png', '23.08.2015', '0', 0, 0, 1, '', 1, 0),
(3423669, 'Active', '36bc05a92dd2950b613ace141e2408ad', 'ActiveActiveActive', 'ActiveActiveActive', '', 0, 0, 0, 'None', 'None', 'None', 'None', 0, 'None', 'Active@mail.com', '34f5bb523bb24f228931c7c133b2d9b6', 0, 'images/profile/default.png', '05.09.2015', '0', 0, 0, 1, '', 1, 0),
(3423670, 'Activate', 'f08c2e8f272a03501c79bac84c1dcf56', 'ActivateActivate', 'ActivateActivate', '', 0, 0, 0, 'None', 'None', 'None', 'None', 0, 'None', 'Activate@mail.com', '4a37b7e1de26ca8773914221130c5726', 0, 'images/profile/default.png', '05.09.2015', '0', 0, 0, 1, '', 1, 0),
(3423671, 'asaaaa', '7cb44a113327f67ea288505b64103556', 'asaaaaasaaaa', 'asaaaaasaaaa', '', 0, 0, 0, 'None', 'None', 'None', 'None', 0, 'None', 'asaaaa@mail.com', '3c493b2c93b720995d0b9fa13deeac70', 0, 'images/profile/default.png', '05.09.2015', '0', 0, 0, 1, '', 1, 0),
(3423672, 'asaaasaaaaaa', 'd7c7d988a47511ca71d7914da936a213', 'asaaasaaaaaaasaaasaaaaaa', 'asaaasaaaaaaasaaasaaaaaa', '', 0, 0, 0, 'None', 'None', 'None', 'None', 0, 'None', 'asaaasaaaaaaasaaasaaaaaa@mailc.o', 'cdbf7efe7a01fd49d9fe914c38ddf41a', 0, 'images/profile/default.png', '05.09.2015', '0', 0, 0, 1, '', 1, 0),
(3423673, 'tester', '8cea91d2d5c816a0d1fb32bd3847135f', 'testertester', 'testertester', '', 0, 0, 0, 'None', 'None', 'None', 'None', 0, 'None', 'tester@tester.com', '6eba9113ae65a939af728f36f87e91ab', 0, 'images/profile/default.png', '29.12.2015', '0', 0, 0, 1, '', 1, 1),
(3423674, '111111111111111111', '2b97cb3305e4b85ba2ba904cecff5601', '1111111111111', '1111111111', '', 0, 0, 0, 'None', 'None', 'None', 'None', 0, 'None', '111111111111111111@gmail.com', '370f07191cccb00dc8200e77fc3b3d13', 0, 'images/profile/default.png', '04.01.2016', '0', 0, 0, 1, '', 1, 0),
(3423675, 'poiuytrewq', '3805248410673a8be6aa4807e61fb5ae', 'poiuytrewq', 'poiuytrewq', '', 0, 0, 0, 'None', 'None', 'None', 'None', 0, 'None', 'poiuytrewq@mai.com', '9f1045ac03d6e70a1883bf26e4d47068', 0, 'images/profile/default.png', '23.03.2016', '1270', 0, 0, 1, '', 1, 1),
(3423676, 'poiuytrewqpoiuytrewq', 'ee919bd4cb26eab621481932ef432691', 'poiuytrewq', 'poiuytrewq', '', 0, 0, 0, 'None', 'None', 'None', 'None', 0, 'None', 'poiuytsrewq@mai.com', '1721b19c446a0fd9cc63469ef364d284', 0, 'images/profile/default.png', '23.03.2016', '1270', 0, 0, 1, '', 1, 0),
(3423677, 'poiupoiuytrewqytrewq', '48f1348b70a6add4db92cf0d02c70f0e', 'poiupoiuytrewqytrewq', 'poiupoiuytrewqytrewq', '', 0, 0, 0, 'None', 'None', 'None', 'None', 0, 'None', 'poiupoiuytrewqytrewq@mail.cas', '580a34ad599343b61903559ddab45b3a', 0, 'images/profile/default.png', '23.03.2016', '127.0.0.1', 0, 0, 1, '', 1, 0),
(3423678, 'qweqweqwe', '6451eb7ed6c6e7ce84cb71664ed0e714', 'qwe', 'qwe', '', 0, 0, 0, 'None', 'None', 'None', 'None', 0, '0', 'qwe@qwe.qwe', '2339b858ecf493a8b7ba7425906da363', 0, 'images/profile/default.png', '22.02.2017', '127.0.0.1', 0, 0, 1, '', 1, 0),
(3423679, '123', 'f5bb0c8de146c67b44babbf4e6584cc0', 'qwe', 'qwe', '', 0, 0, 0, 'None', 'None', 'None', 'None', 0, '0', 'qwe@123.com', '6139986e54c643a52090cc211c096676', 0, 'images/profile/default.png', '01.03.2017', '127.0.0.1', 0, 0, 1, '', 1, 0),
(3423680, 'commadot', '0d6bde662f1e15498ef6284a55ad9590', 'Igor', 'Zmitrovich', '', 0, 0, 0, 'None', 'None', 'None', 'None', 0, '0', 'izmitrowicz@gmail.com', '5e4aac883c8d468309adc419d085fb92', 0, 'images/profile/default.png', '22.04.2017', '127.0.0.1', 0, 1492898787, 1, '', 1, 1),
(3423682, 'fujitsu', '317aefc9ae4d7bba31157640c445bc48', 'fujitsu', 'fujitsu', 'male', 18, 1, 1999, 'fujitsu', '', '', '', 0, '', 'fujitsu@fujitsu.com', '77a652330bfaf54824d3ab30a4eb4de9', 0, 'images/profile/default.jpg', '29.04.2017', '127.0.0.1', 0, 1502135013, 1, 'f15db562705f714d9dc2046bdfad2484', 0, 1),
(3423683, 'ericsson', '430a4200e0c68f338eeceb4cfb1fcd90', 'ericsson', 'ericsson', 'male', 1, 1, 1890, 'ericsson', '', '', '', 0, '', 'ericsson@ericsson.com', '88e2dfb671861a660e99f650af01e29e', 0, 'images/profile/default.jpg', '06.05.2017', '127.0.0.1', 0, 1502136073, 1, '0ea78adc92022a49234f6a5f59ad46af', 0, 1),
(3423684, 'testtest', '05a671c66aefea124cc08b76ea6d30bb', 'testtest', 'testtest', '', 0, 0, 0, '', '', '', '', 0, '0', 'testtest@testtesttesttest.com', '764833b77ea41ce703f2ea7dd51aaafc', 0, 'images/profile/default.jpg', '13.07.2017', '127.0.0.1', 0, 1501788932, 1, '7e907f0ea81d95940445d3ba3998f071', 0, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `votes`
--

CREATE TABLE IF NOT EXISTS `votes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=182 ;

--
-- Дамп данных таблицы `votes`
--

INSERT INTO `votes` (`id`, `user_id`, `post_id`, `rating`) VALUES
(178, 7, 2, 5),
(173, 3423666, 2, 5),
(172, 15, 1, 5),
(171, 12345, 2, 5),
(170, 7, 1, 5),
(169, 7, 2, 5),
(168, 3423661, 1, 2),
(167, 3423661, 2, 1),
(166, 12345, 1, 5),
(165, 12345, 2, 5),
(164, 3423661, 2, 5),
(163, 15, 2, 5),
(162, 7, 1, 5),
(161, 7, 2, 5),
(160, 7, 2, 2),
(159, 7, 2, 4),
(157, 7, 2, 5),
(156, 7, 2, 5),
(155, 7, 2, 5),
(177, 7, 2, 5),
(176, 7, 2, 5),
(175, 7, 2, 5),
(174, 7, 2, 5),
(94, 0, 6, 2),
(95, 0, 3, 5),
(96, 0, 3, 2),
(97, 0, 3, 1),
(98, 0, 3, 4),
(99, 0, 3, 3),
(100, 0, 3, 1),
(101, 0, 3, 4),
(102, 0, 2, 1),
(103, 0, 3, 5),
(104, 0, 3, 3),
(105, 0, 6, 1),
(106, 0, 6, 3),
(107, 0, 4, 5),
(108, 0, 4, 2),
(109, 0, 1, 2),
(110, 0, 2, 4),
(111, 0, 5, 1),
(112, 0, 4, 4),
(113, 0, 6, 5),
(114, 0, 6, 4),
(115, 0, 5, 5),
(116, 0, 5, 4),
(117, 0, 5, 3),
(118, 0, 5, 2),
(119, 0, 5, 4),
(120, 0, 2, 3),
(121, 0, 2, 4),
(122, 0, 2, 5),
(123, 0, 1, 1),
(124, 0, 1, 3),
(125, 0, 1, 5),
(126, 0, 4, 1),
(127, 0, 4, 2),
(128, 0, 4, 4),
(129, 0, 5, 2),
(130, 0, 3, 2),
(131, 0, 5, 5),
(132, 0, 5, 1),
(133, 0, 2, 3),
(134, 0, 2, 4),
(135, 0, 2, 5),
(136, 0, 1, 1),
(137, 0, 1, 3),
(138, 0, 5, 2),
(139, 0, 2, 3),
(140, 0, 2, 5),
(141, 0, 2, 5),
(142, 0, 2, 5),
(143, 0, 2, 5),
(144, 0, 2, 4),
(145, 0, 2, 5),
(146, 0, 2, 1),
(147, 0, 2, 1),
(148, 0, 2, 1),
(149, 0, 1, 1),
(150, 0, 1, 5),
(151, 0, 1, 5),
(152, 0, 1, 5),
(179, 3423682, 2, 5),
(180, 3423683, 2, 1),
(181, 7, 3, 4);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
