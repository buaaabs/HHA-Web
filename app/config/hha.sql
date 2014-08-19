-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2014-08-17 08:30:39
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hha`
--

-- --------------------------------------------------------

--
-- 表的结构 `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `author` int(11) NOT NULL,
  `body` mediumtext COLLATE utf8_unicode_ci,
  `date` datetime DEFAULT NULL,
  `section-id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `author` (`author`),
  KEY `date` (`date`),
  KEY `section-id` (`section-id`),
  FULLTEXT KEY `title` (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `auth-group`
--

CREATE TABLE IF NOT EXISTS `auth-group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `auth-group`
--

INSERT INTO `auth-group` (`id`, `name`) VALUES
(1, '');

-- --------------------------------------------------------

--
-- 表的结构 `auth-map`
--

CREATE TABLE IF NOT EXISTS `auth-map` (
  `group-id` int(10) unsigned NOT NULL,
  `auth-id` int(10) unsigned NOT NULL,
  KEY `group-id` (`group-id`),
  KEY `auth-id` (`auth-id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- 表的结构 `auth-name`
--

CREATE TABLE IF NOT EXISTS `auth-name` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `data`
--

CREATE TABLE IF NOT EXISTS `data` (
  `id` int(10) unsigned NOT NULL,
  `key` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`,`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- 表的结构 `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `unit` varchar(10) COLLATE utf8_bin NOT NULL,
  `type` tinyint(1) NOT NULL,
  `user-group` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- 表的结构 `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `to_id` int(10) unsigned NOT NULL,
  `from_id` int(10) unsigned NOT NULL,
  `type` int(10) unsigned NOT NULL,
  `data` text COLLATE utf8_unicode_ci NOT NULL,
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `read` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `to_id` (`to_id`),
  KEY `from_id` (`from_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `relationship`
--

CREATE TABLE IF NOT EXISTS `relationship` (
  `id1` int(10) unsigned NOT NULL,
  `id2` int(10) unsigned NOT NULL,
  `relation` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  KEY `id2` (`id2`),
  KEY `id1` (`id1`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- 表的结构 `section`
--

CREATE TABLE IF NOT EXISTS `section` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `survey`
--

CREATE TABLE IF NOT EXISTS `survey` (
  `id` int(10) unsigned NOT NULL,
  `user-id` int(10) unsigned NOT NULL,
  `item` int(10) unsigned NOT NULL,
  `value` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user-id` (`user-id`),
  KEY `item` (`item`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- 表的结构 `survey-sample`
--

CREATE TABLE IF NOT EXISTS `survey-sample` (
  `id` int(10) unsigned NOT NULL,
  `item` int(10) unsigned NOT NULL,
  `value` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`,`item`),
  KEY `item` (`item`),
  KEY `date` (`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `auth-group` int(2) unsigned NOT NULL DEFAULT '1',
  `showname` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '游客',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `auth-group` (`auth-group`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `auth-group`, `showname`) VALUES
(1, 'sxf', '123', 1, '游客');

-- --------------------------------------------------------

--
-- 表的结构 `user-ext`
--

CREATE TABLE IF NOT EXISTS `user-ext` (
  `id` int(10) unsigned NOT NULL,
  `realname` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sex` tinyint(1) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `age` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `user-group`
--

CREATE TABLE IF NOT EXISTS `user-group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- 限制导出的表
--

--
-- 限制表 `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `section_ibfk_1` FOREIGN KEY (`section-id`) REFERENCES `section` (`id`);

--
-- 限制表 `auth-map`
--
ALTER TABLE `auth-map`
  ADD CONSTRAINT `auth-map_ibfk_1` FOREIGN KEY (`auth-id`) REFERENCES `auth-name` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `group-map_ibfk_1` FOREIGN KEY (`group-id`) REFERENCES `auth-group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`from_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`to_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `relationship`
--
ALTER TABLE `relationship`
  ADD CONSTRAINT `relationship_ibfk_2` FOREIGN KEY (`id2`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `relationship_ibfk_1` FOREIGN KEY (`id1`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `survey`
--
ALTER TABLE `survey`
  ADD CONSTRAINT `survey_ibfk_2` FOREIGN KEY (`user-id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `survey_ibfk_1` FOREIGN KEY (`item`) REFERENCES `item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `survey-sample`
--
ALTER TABLE `survey-sample`
  ADD CONSTRAINT `survey-sample_ibfk_1` FOREIGN KEY (`item`) REFERENCES `item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`auth-group`) REFERENCES `auth-group` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
