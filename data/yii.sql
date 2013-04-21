-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 04 月 21 日 12:01
-- 服务器版本: 5.5.24-log
-- PHP 版本: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `yii`
--

-- --------------------------------------------------------

--
-- 表的结构 `yii_content`
--

CREATE TABLE IF NOT EXISTS `yii_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(100) NOT NULL COMMENT '唯一',
  `name` varchar(100) NOT NULL COMMENT '显示名',
  `commit` text NOT NULL COMMENT '备注',
  `sort` int(11) NOT NULL COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `yii_content`
--

INSERT INTO `yii_content` (`id`, `slug`, `name`, `commit`, `sort`) VALUES
(1, 'post', 'post', 'commit', 0),
(2, 'video', 'video', '', 0);

-- --------------------------------------------------------

--
-- 表的结构 `yii_fields`
--

CREATE TABLE IF NOT EXISTS `yii_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(20) NOT NULL COMMENT '唯一名称，只能是_',
  `name` varchar(20) NOT NULL COMMENT '字段标题',
  `data_type` varchar(10) NOT NULL COMMENT 'MYSQL类型',
  `cid` int(11) NOT NULL COMMENT '内容类型ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `yii_fields`
--

INSERT INTO `yii_fields` (`id`, `slug`, `name`, `data_type`, `cid`) VALUES
(1, 'body3', 'body3', 'varchar', 1),
(2, 'title', 'title', 'varchar', 1),
(3, 'body2', 'body2', 'varchar', 1),
(4, 'body', 'body', 'text', 1);

-- --------------------------------------------------------

--
-- 表的结构 `yii_field_group`
--

CREATE TABLE IF NOT EXISTS `yii_field_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fid` int(11) NOT NULL COMMENT '字段ID',
  `gid` int(11) NOT NULL COMMENT '组ID',
  `sort` int(11) NOT NULL COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `yii_groups`
--

CREATE TABLE IF NOT EXISTS `yii_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT '名称',
  `cid` int(11) NOT NULL COMMENT '内容类型ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `yii_plugins`
--

CREATE TABLE IF NOT EXISTS `yii_plugins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fid` int(11) NOT NULL COMMENT '字段',
  `value` text NOT NULL COMMENT '值',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `yii_validates`
--

CREATE TABLE IF NOT EXISTS `yii_validates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fid` int(11) NOT NULL COMMENT '字段',
  `value` text NOT NULL COMMENT '值',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `yii_value`
--

CREATE TABLE IF NOT EXISTS `yii_value` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fid` int(11) NOT NULL COMMENT '字段',
  `value` varchar(255) NOT NULL COMMENT '值',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
