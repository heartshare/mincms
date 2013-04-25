<?php

// change the following paths if necessary
$yii=dirname(__FILE__).'/../yii/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);
if(true === YII_DEBUG)
	error_reporting(E_ALL & ~(E_STRICT | E_NOTICE));
else
	error_reporting(0);
require_once($yii);
require_once(dirname(__FILE__).'/protected/helpers.php');
Yii::createWebApplication($config)->run();
