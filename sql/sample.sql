-- phpMyAdmin SQL Dump
-- version 4.4.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2016-06-15 23:13:45
-- 服务器版本： 5.5.41-log
-- PHP Version: 5.5.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

CREATE TABLE IF NOT EXISTS `URLInfo` (
  `url` text,
  `shortName` varchar(30) NOT NULL DEFAULT '',
  `addTime` varchar(30) DEFAULT NULL,
  `addIP` text NOT NULL,
  `stat` bigint(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `URLInfo`
--

INSERT INTO `URLInfo` (`url`, `shortName`, `addTime`, `addIP`, `stat`) VALUES
('http://touko.moe', 'dm2jW2', '2016-06-15 14:20:54', '127.0.0.1', 0),

--
-- Indexes for dumped tables
--

--
-- Indexes for table `URLInfo`
--
ALTER TABLE `URLInfo`
  ADD PRIMARY KEY (`shortName`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
