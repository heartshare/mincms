-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 04 月 27 日 03:58
-- 服务器版本: 5.5.8-log
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
  `update` int(11) NOT NULL,
  `display` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `yii_content`
--

INSERT INTO `yii_content` (`id`, `slug`, `name`, `commit`, `sort`, `update`, `display`) VALUES
(1, 'core_user', '系统用户', '', 0, 0, 2),
(2, 'core_user_group', '用户绑定到用户组', '', 0, 0, 2),
(3, 'core_file', '文件', '', 0, 0, 2),
(4, 'core_group', '用户组', '', 0, 0, 2),
(5, 'core_config', '配置', '', 0, 0, 1),
(6, 'core_module', '系统模块', '', 0, 0, 2);

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
  `widget` varchar(200) NOT NULL,
  `list` tinyint(1) NOT NULL COMMENT '是否在列表中显示',
  `search` tinyint(1) NOT NULL COMMENT '搜索',
  `length` int(11) NOT NULL COMMENT '字段长度',
  `sort` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- 转存表中的数据 `yii_fields`
--

INSERT INTO `yii_fields` (`id`, `slug`, `name`, `data_type`, `cid`, `widget`, `list`, `search`, `length`, `sort`) VALUES
(1, 'email', '用户名', 'varchar', 1, 'input', 1, 1, 0, 0),
(2, 'password', '密码', 'varchar', 1, 'password', 0, 0, 64, 0),
(3, 'name', '名字', 'varchar', 1, 'input', 1, 0, 50, 0),
(4, 'path', '路径', 'varchar', 3, 'input', 1, 0, 0, 0),
(5, 'ext', '后缀', 'varchar', 3, 'input', 1, 1, 10, 0),
(6, 'size', '文件大小', 'int', 3, 'input', 1, 0, 0, 0),
(7, 'uniqid', 'MD5', 'varchar', 3, 'input', 0, 0, 0, 0),
(8, 'type', '类型', 'varchar', 3, 'input', 0, 0, 50, 0),
(9, 'name', '组名', 'varchar', 4, 'input', 1, 1, 50, 11),
(10, 'access', '权限', 'text', 4, 'text', 0, 0, 0, 9),
(11, 'slug', '组标识', 'varchar', 4, 'input', 1, 0, 50, 10),
(12, 'slug', '标识', 'varchar', 5, 'input', 1, 1, 20, 0),
(13, 'value', '值', 'text', 5, 'text', 0, 0, 0, 0),
(14, 'slug', '标识', 'varchar', 6, 'input', 1, 0, 50, 0);

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `yii_groups`
--

CREATE TABLE IF NOT EXISTS `yii_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT '名称',
  `cid` int(11) NOT NULL COMMENT '内容类型ID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `yii_plugins`
--

CREATE TABLE IF NOT EXISTS `yii_plugins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fid` int(11) NOT NULL COMMENT '字段',
  `value` text NOT NULL COMMENT '值',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `yii_plugins`
--

INSERT INTO `yii_plugins` (`id`, `fid`, `value`) VALUES
(1, 2, 'a:0:{}'),
(2, 1, 'a:0:{}'),
(4, 10, 'a:0:{}');

-- --------------------------------------------------------

--
-- 表的结构 `yii_validates`
--

CREATE TABLE IF NOT EXISTS `yii_validates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fid` int(11) NOT NULL COMMENT '字段',
  `value` text NOT NULL COMMENT '值',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- 转存表中的数据 `yii_validates`
--

INSERT INTO `yii_validates` (`id`, `fid`, `value`) VALUES
(3, 2, 'a:1:{s:8:"required";i:1;}'),
(4, 1, 'a:1:{s:8:"required";i:1;}'),
(5, 3, 'a:1:{s:8:"required";i:1;}'),
(6, 4, 'a:1:{s:8:"required";i:1;}'),
(7, 5, 'a:1:{s:8:"required";i:1;}'),
(8, 6, 'a:1:{s:8:"required";i:1;}'),
(9, 7, 'a:1:{s:8:"required";i:1;}'),
(10, 8, 'a:1:{s:8:"required";i:1;}'),
(11, 9, 'a:1:{s:8:"required";i:1;}'),
(13, 11, 'a:2:{s:8:"required";i:1;s:6:"unique";i:1;}'),
(14, 12, 'a:1:{s:8:"required";i:1;}'),
(15, 13, 'a:1:{s:8:"required";i:1;}'),
(16, 14, 'a:1:{s:8:"required";i:1;}');

-- --------------------------------------------------------

--
-- 表的结构 `yii_value`
--

CREATE TABLE IF NOT EXISTS `yii_value` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fid` int(11) NOT NULL COMMENT '字段',
  `value` varchar(255) NOT NULL COMMENT '值',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `yii_widgets`
--

CREATE TABLE IF NOT EXISTS `yii_widgets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fid` int(11) NOT NULL,
  `name` varchar(200) NOT NULL COMMENT 'widget名',
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
