-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2017-04-15 12:03:43
-- 服务器版本： 10.1.19-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sign`
--

-- --------------------------------------------------------

--
-- 表的结构 `cms_admin`
--

CREATE TABLE `cms_admin` (
  `admin_id` mediumint(6) UNSIGNED NOT NULL,
  `username` varchar(20) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL DEFAULT '',
  `createtime` int(10) UNSIGNED DEFAULT '0',
  `email` varchar(40) DEFAULT '',
  `realname` varchar(50) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `online` tinyint(1) DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `cms_admin`
--

INSERT INTO `cms_admin` (`admin_id`, `username`, `password`, `createtime`, `email`, `realname`, `status`, `online`) VALUES
(13, 'czc', 'e2549172457ea725492eca0d353a18fd', 1490712915, '963239044@qq.com', 'czc', 1, 1),
(2, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1458139801, '963239044@qq.com', '蔡志成', 1, 1),
(8, 'singwa123', '204c93175e725ca51d28633055536e09', 1458485298, 'singcms@singwa.com', 'singcms123', -1, 1),
(14, 'czc1', 'e2549172457ea725492eca0d353a18fd', 1490712993, '21', '121', -1, -1),
(15, 'admin111', 'e2549172457ea725492eca0d353a18fd', 1490713292, '1211', '121', 1, -1),
(16, '1212', '6512bd43d9caa6e02c990b0a82652dca', 1490715122, '121', '2121', 1, -1);

-- --------------------------------------------------------

--
-- 表的结构 `cms_attend`
--

CREATE TABLE `cms_attend` (
  `attend_id` int(100) NOT NULL,
  `wordtime` int(30) DEFAULT '0',
  `clostime` int(30) DEFAULT '0',
  `staff_id` int(3) NOT NULL,
  `online` tinyint(1) NOT NULL DEFAULT '1',
  `depart_id` int(3) NOT NULL,
  `name` varchar(20) NOT NULL,
  `model` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `cms_depart`
--

CREATE TABLE `cms_depart` (
  `depart_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `online` tinyint(1) NOT NULL DEFAULT '1',
  `createtime` int(10) NOT NULL,
  `model` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `cms_depart`
--

INSERT INTO `cms_depart` (`depart_id`, `name`, `telephone`, `status`, `online`, `createtime`, `model`) VALUES
(1, '运营部', '1211', -1, 1, 0, 0),
(2, '开发部', '2111', 1, 1, 0, 0),
(3, '宣传部', '114', 1, 1, 1490870475, 0),
(4, '宣传部', '1141', 1, -1, 1490870703, 0),
(8, '1号家庭', '121', 1, -1, 1492241428, 1),
(9, '1号家庭', '121', 1, -1, 1492241683, 0),
(13, '1号家庭', '121', 1, 1, 1492241863, 1);

-- --------------------------------------------------------

--
-- 表的结构 `cms_scribe`
--

CREATE TABLE `cms_scribe` (
  `id` int(11) NOT NULL,
  `phone` varchar(22) NOT NULL,
  `scribe_id` int(11) NOT NULL,
  `describe_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `cms_scribe`
--

INSERT INTO `cms_scribe` (`id`, `phone`, `scribe_id`, `describe_id`) VALUES
(2, '15070380105', 8, 10),
(5, '15070380105', 8, 12);

-- --------------------------------------------------------

--
-- 表的结构 `cms_staff`
--

CREATE TABLE `cms_staff` (
  `staff_id` int(11) NOT NULL,
  `sno` bigint(30) NOT NULL,
  `name` varchar(20) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `depart_id` int(3) NOT NULL,
  `sex` tinyint(1) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '-1',
  `position` varchar(20) NOT NULL,
  `online` tinyint(1) DEFAULT '1',
  `createtime` int(12) NOT NULL,
  `url` varchar(150) NOT NULL,
  `model` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `cms_staff`
--

INSERT INTO `cms_staff` (`staff_id`, `sno`, `name`, `telephone`, `depart_id`, `sex`, `status`, `position`, `online`, `createtime`, `url`, `model`) VALUES
(36, 17009, '甘甘', '18279923530', 1, 1, 1, '121', 1, 1492163212, 'http://okq9z91is.bkt.clouddn.com/2017041417465023068.jpg', 0),
(37, 17002, '菜菜', '123123', 13, 1, -1, '儿子', 1, 1492244162, 'http://okq9z91is.bkt.clouddn.com/2017041516160246114.jpg', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cms_admin`
--
ALTER TABLE `cms_admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `cms_attend`
--
ALTER TABLE `cms_attend`
  ADD PRIMARY KEY (`attend_id`);

--
-- Indexes for table `cms_depart`
--
ALTER TABLE `cms_depart`
  ADD PRIMARY KEY (`depart_id`);

--
-- Indexes for table `cms_scribe`
--
ALTER TABLE `cms_scribe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_staff`
--
ALTER TABLE `cms_staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `cms_admin`
--
ALTER TABLE `cms_admin`
  MODIFY `admin_id` mediumint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- 使用表AUTO_INCREMENT `cms_attend`
--
ALTER TABLE `cms_attend`
  MODIFY `attend_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- 使用表AUTO_INCREMENT `cms_depart`
--
ALTER TABLE `cms_depart`
  MODIFY `depart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- 使用表AUTO_INCREMENT `cms_scribe`
--
ALTER TABLE `cms_scribe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- 使用表AUTO_INCREMENT `cms_staff`
--
ALTER TABLE `cms_staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
