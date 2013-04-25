-- MySQL dump 10.13  Distrib 5.5.8, for Win32 (x86)
--
-- Host: localhost    Database: yii
-- ------------------------------------------------------
-- Server version	5.5.8-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `post_int`
--

DROP TABLE IF EXISTS `post_int`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post_int` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nid` int(11) NOT NULL,
  `fid` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_int`
--

LOCK TABLES `post_int` WRITE;
/*!40000 ALTER TABLE `post_int` DISABLE KEYS */;
INSERT INTO `post_int` VALUES (1,2,7,1366913880),(2,1,7,1366883700);
/*!40000 ALTER TABLE `post_int` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_nid`
--

DROP TABLE IF EXISTS `post_nid`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post_nid` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `display` tinyint(1) NOT NULL DEFAULT '1',
  `sort` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  `unique` varchar(200) NOT NULL,
  `uid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_nid`
--

LOCK TABLES `post_nid` WRITE;
/*!40000 ALTER TABLE `post_nid` DISABLE KEYS */;
INSERT INTO `post_nid` VALUES (1,0,1,1366882085,1366883707,'',0),(2,0,2,1366882396,1366886058,'',0);
/*!40000 ALTER TABLE `post_nid` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_text`
--

DROP TABLE IF EXISTS `post_text`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post_text` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nid` int(11) NOT NULL,
  `fid` int(11) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_text`
--

LOCK TABLES `post_text` WRITE;
/*!40000 ALTER TABLE `post_text` DISABLE KEYS */;
/*!40000 ALTER TABLE `post_text` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_varchar`
--

DROP TABLE IF EXISTS `post_varchar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post_varchar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nid` int(11) NOT NULL,
  `fid` int(11) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_varchar`
--

LOCK TABLES `post_varchar` WRITE;
/*!40000 ALTER TABLE `post_varchar` DISABLE KEYS */;
INSERT INTO `post_varchar` VALUES (1,1,2,'标题'),(2,1,4,'<p>内容</p>'),(3,2,2,'看看'),(4,2,4,'<p>不错</p>'),(5,2,3,'23233'),(6,2,1,'232323');
/*!40000 ALTER TABLE `post_varchar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `video_nid`
--

DROP TABLE IF EXISTS `video_nid`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `video_nid` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `display` tinyint(1) NOT NULL DEFAULT '1',
  `sort` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  `unique` varchar(200) NOT NULL,
  `uid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `video_nid`
--

LOCK TABLES `video_nid` WRITE;
/*!40000 ALTER TABLE `video_nid` DISABLE KEYS */;
INSERT INTO `video_nid` VALUES (1,1,0,1366882074,1366882074,'',0);
/*!40000 ALTER TABLE `video_nid` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `video_varchar`
--

DROP TABLE IF EXISTS `video_varchar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `video_varchar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nid` int(11) NOT NULL,
  `fid` int(11) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `video_varchar`
--

LOCK TABLES `video_varchar` WRITE;
/*!40000 ALTER TABLE `video_varchar` DISABLE KEYS */;
INSERT INTO `video_varchar` VALUES (1,1,5,'2'),(2,1,6,'<p>2</p>');
/*!40000 ALTER TABLE `video_varchar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yii_content`
--

DROP TABLE IF EXISTS `yii_content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yii_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(100) NOT NULL COMMENT '唯一',
  `name` varchar(100) NOT NULL COMMENT '显示名',
  `commit` text NOT NULL COMMENT '备注',
  `sort` int(11) NOT NULL COMMENT '排序',
  `update` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yii_content`
--

LOCK TABLES `yii_content` WRITE;
/*!40000 ALTER TABLE `yii_content` DISABLE KEYS */;
INSERT INTO `yii_content` VALUES (1,'post','post','commit',2,0),(2,'video','video','',1,0);
/*!40000 ALTER TABLE `yii_content` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yii_field_group`
--

DROP TABLE IF EXISTS `yii_field_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yii_field_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fid` int(11) NOT NULL COMMENT '字段ID',
  `gid` int(11) NOT NULL COMMENT '组ID',
  `sort` int(11) NOT NULL COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yii_field_group`
--

LOCK TABLES `yii_field_group` WRITE;
/*!40000 ALTER TABLE `yii_field_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `yii_field_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yii_fields`
--

DROP TABLE IF EXISTS `yii_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yii_fields` (
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yii_fields`
--

LOCK TABLES `yii_fields` WRITE;
/*!40000 ALTER TABLE `yii_fields` DISABLE KEYS */;
INSERT INTO `yii_fields` VALUES (1,'body3','body3','varchar',1,'text',0,0,0,3),(2,'title','title','varchar',1,'text',1,0,0,4),(3,'body2','body2','varchar',1,'text',0,0,0,1),(4,'body','body','varchar',1,'text',1,0,200,2),(5,'title','标题','varchar',2,'input',1,0,0,6),(6,'body','内容','varchar',2,'text',1,0,200,5),(7,'time','时间','int',1,'input',1,0,0,0);
/*!40000 ALTER TABLE `yii_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yii_groups`
--

DROP TABLE IF EXISTS `yii_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yii_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT '名称',
  `cid` int(11) NOT NULL COMMENT '内容类型ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yii_groups`
--

LOCK TABLES `yii_groups` WRITE;
/*!40000 ALTER TABLE `yii_groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `yii_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yii_plugins`
--

DROP TABLE IF EXISTS `yii_plugins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yii_plugins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fid` int(11) NOT NULL COMMENT '字段',
  `value` text NOT NULL COMMENT '值',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yii_plugins`
--

LOCK TABLES `yii_plugins` WRITE;
/*!40000 ALTER TABLE `yii_plugins` DISABLE KEYS */;
INSERT INTO `yii_plugins` VALUES (11,3,'a:0:{}'),(33,1,'a:0:{}'),(40,2,'a:0:{}'),(57,5,'a:0:{}'),(60,6,'a:1:{s:8:\"redactor\";a:1:{s:3:\"tag\";s:2:\"id\";}}'),(61,4,'a:1:{s:8:\"redactor\";a:1:{s:3:\"tag\";s:5:\"#body\";}}'),(62,7,'a:1:{s:10:\"datepicker\";a:1:{s:3:\"tag\";s:2:\"id\";}}');
/*!40000 ALTER TABLE `yii_plugins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yii_validates`
--

DROP TABLE IF EXISTS `yii_validates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yii_validates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fid` int(11) NOT NULL COMMENT '字段',
  `value` text NOT NULL COMMENT '值',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yii_validates`
--

LOCK TABLES `yii_validates` WRITE;
/*!40000 ALTER TABLE `yii_validates` DISABLE KEYS */;
INSERT INTO `yii_validates` VALUES (11,3,'a:0:{}'),(33,1,'a:0:{}'),(40,2,'a:0:{}'),(57,5,'a:1:{s:8:\"required\";i:1;}'),(60,6,'a:1:{s:8:\"required\";i:1;}'),(61,4,'a:1:{s:8:\"required\";i:1;}'),(62,7,'a:0:{}');
/*!40000 ALTER TABLE `yii_validates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yii_value`
--

DROP TABLE IF EXISTS `yii_value`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yii_value` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fid` int(11) NOT NULL COMMENT '字段',
  `value` varchar(255) NOT NULL COMMENT '值',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yii_value`
--

LOCK TABLES `yii_value` WRITE;
/*!40000 ALTER TABLE `yii_value` DISABLE KEYS */;
/*!40000 ALTER TABLE `yii_value` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-04-25 19:35:55
