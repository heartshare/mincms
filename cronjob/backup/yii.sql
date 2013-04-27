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
  `display` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yii_content`
--

LOCK TABLES `yii_content` WRITE;
/*!40000 ALTER TABLE `yii_content` DISABLE KEYS */;
INSERT INTO `yii_content` VALUES (1,'zii_user','系统用户','',0,0,2),(2,'zii_user_group','用户绑定到用户组','',0,0,2),(3,'zii_file','文件','',0,0,2),(4,'zii_group','用户组','',0,0,2),(5,'zii_config','配置','',0,0,1),(6,'zii_module','系统模块','',0,0,2);
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
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
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yii_fields`
--

LOCK TABLES `yii_fields` WRITE;
/*!40000 ALTER TABLE `yii_fields` DISABLE KEYS */;
INSERT INTO `yii_fields` VALUES (1,'email','用户名','varchar',1,'input',1,1,0,0),(2,'password','密码','varchar',1,'password',0,0,64,0),(3,'name','名字','varchar',1,'input',1,0,50,0),(4,'path','路径','varchar',3,'input',1,0,0,0),(5,'ext','后缀','varchar',3,'input',1,1,10,0),(6,'size','文件大小','int',3,'input',1,0,0,0),(7,'uniqid','MD5','varchar',3,'input',0,0,0,0),(8,'type','类型','varchar',3,'input',0,0,50,0),(9,'name','组名','varchar',4,'input',1,1,50,11),(10,'access','权限','text',4,'text',0,0,0,9),(11,'slug','组标识','varchar',4,'input',1,0,50,10),(12,'slug','标识','varchar',5,'input',1,1,20,0),(13,'value','值','text',5,'text',1,0,0,0),(14,'slug','标识','varchar',6,'input',1,0,50,0);
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yii_plugins`
--

LOCK TABLES `yii_plugins` WRITE;
/*!40000 ALTER TABLE `yii_plugins` DISABLE KEYS */;
INSERT INTO `yii_plugins` VALUES (1,2,'a:0:{}'),(2,1,'a:0:{}'),(4,10,'a:0:{}');
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
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yii_validates`
--

LOCK TABLES `yii_validates` WRITE;
/*!40000 ALTER TABLE `yii_validates` DISABLE KEYS */;
INSERT INTO `yii_validates` VALUES (3,2,'a:1:{s:8:\"required\";i:1;}'),(4,1,'a:1:{s:8:\"required\";i:1;}'),(5,3,'a:1:{s:8:\"required\";i:1;}'),(6,4,'a:1:{s:8:\"required\";i:1;}'),(7,5,'a:1:{s:8:\"required\";i:1;}'),(8,6,'a:1:{s:8:\"required\";i:1;}'),(9,7,'a:1:{s:8:\"required\";i:1;}'),(10,8,'a:1:{s:8:\"required\";i:1;}'),(11,9,'a:1:{s:8:\"required\";i:1;}'),(13,11,'a:2:{s:8:\"required\";i:1;s:6:\"unique\";i:1;}'),(14,12,'a:1:{s:8:\"required\";i:1;}'),(18,13,'a:1:{s:8:\"required\";i:1;}'),(19,14,'a:1:{s:8:\"required\";i:1;}');
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yii_value`
--

LOCK TABLES `yii_value` WRITE;
/*!40000 ALTER TABLE `yii_value` DISABLE KEYS */;
/*!40000 ALTER TABLE `yii_value` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yii_widgets`
--

DROP TABLE IF EXISTS `yii_widgets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yii_widgets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fid` int(11) NOT NULL,
  `name` varchar(200) NOT NULL COMMENT 'widget名',
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yii_widgets`
--

LOCK TABLES `yii_widgets` WRITE;
/*!40000 ALTER TABLE `yii_widgets` DISABLE KEYS */;
/*!40000 ALTER TABLE `yii_widgets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zii_config_nid`
--

DROP TABLE IF EXISTS `zii_config_nid`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zii_config_nid` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `display` tinyint(1) NOT NULL DEFAULT '1',
  `sort` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  `unique` varchar(200) NOT NULL,
  `uid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zii_config_nid`
--

LOCK TABLES `zii_config_nid` WRITE;
/*!40000 ALTER TABLE `zii_config_nid` DISABLE KEYS */;
INSERT INTO `zii_config_nid` VALUES (1,1,0,1367055119,1367055474,'',0),(2,1,0,1367055510,1367055510,'',0);
/*!40000 ALTER TABLE `zii_config_nid` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zii_config_text`
--

DROP TABLE IF EXISTS `zii_config_text`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zii_config_text` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nid` int(11) NOT NULL,
  `fid` int(11) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zii_config_text`
--

LOCK TABLES `zii_config_text` WRITE;
/*!40000 ALTER TABLE `zii_config_text` DISABLE KEYS */;
INSERT INTO `zii_config_text` VALUES (1,1,13,'adf'),(2,2,13,'test');
/*!40000 ALTER TABLE `zii_config_text` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zii_config_varchar`
--

DROP TABLE IF EXISTS `zii_config_varchar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zii_config_varchar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nid` int(11) NOT NULL,
  `fid` int(11) NOT NULL,
  `value` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zii_config_varchar`
--

LOCK TABLES `zii_config_varchar` WRITE;
/*!40000 ALTER TABLE `zii_config_varchar` DISABLE KEYS */;
INSERT INTO `zii_config_varchar` VALUES (1,1,12,'adf'),(2,2,12,'tes');
/*!40000 ALTER TABLE `zii_config_varchar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zii_module_nid`
--

DROP TABLE IF EXISTS `zii_module_nid`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zii_module_nid` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `display` tinyint(1) NOT NULL DEFAULT '1',
  `sort` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  `unique` varchar(200) NOT NULL,
  `uid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zii_module_nid`
--

LOCK TABLES `zii_module_nid` WRITE;
/*!40000 ALTER TABLE `zii_module_nid` DISABLE KEYS */;
INSERT INTO `zii_module_nid` VALUES (1,1,0,1367060093,1367061740,'',0),(2,2,0,1367060819,1367061907,'',0);
/*!40000 ALTER TABLE `zii_module_nid` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zii_module_varchar`
--

DROP TABLE IF EXISTS `zii_module_varchar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zii_module_varchar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nid` int(11) NOT NULL,
  `fid` int(11) NOT NULL,
  `value` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zii_module_varchar`
--

LOCK TABLES `zii_module_varchar` WRITE;
/*!40000 ALTER TABLE `zii_module_varchar` DISABLE KEYS */;
INSERT INTO `zii_module_varchar` VALUES (1,1,14,'i18n'),(2,2,14,'mysql');
/*!40000 ALTER TABLE `zii_module_varchar` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-04-27 20:05:47
