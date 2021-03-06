<?php
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

$array = array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',
	'timeZone'=>'Asia/Chongqing',
	// preloading 'log' component
	'preload'=>array('log'),
	'runtimePath'=>dirname(__FILE__).'/../../temp',
	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.helpers.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'yii','i18n',
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'admin',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		
	),

	// application components
	'components'=>array(
		
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'urlSuffix'=>'.html',
			'showScriptName'=>false,
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		
		 
		// uncomment the following to use a MySQL database
		
		
		'clientScript' => array(
			   'class' => 'ext.minify.EClientScript',
			   'combineScriptFiles' => !YII_DEBUG, // By default this is set to true, set this to true if you'd like to combine the script files
			   'combineCssFiles' => !YII_DEBUG, // By default this is set to true, set this to true if you'd like to combine the css files
			   'optimizeScriptFiles' => !YII_DEBUG, // @since: 1.1
			   'optimizeCssFiles' => !YII_DEBUG, // @since: 1.1
		 ),
		/*'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),*/
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array( 
				 array( // configuration for the toolbar
		          'class'=>'ext.yiidebugtb.XWebDebugRouter',
		          'config'=>'alignLeft, opaque, runInDebug, fixedPos, collapsed, yamlStyle',
		          'levels'=>'error, warning, trace, profile, info',
		          'allowedIPs'=>array('127.0.0.1','::1'),
		        ),
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'debug'=>true,
		'hash'=>md5('mincms'),
	),
);
$database = include_once dirname(__FILE__).'/database.php';		
$array['components'] = array_merge($database,$array['components']);
$cache = include_once dirname(__FILE__).'/cache.php';		
$array['components'] = array_merge($cache,$array['components']);
return $array;