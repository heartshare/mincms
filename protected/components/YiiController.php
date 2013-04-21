<?php

class YiiController extends Controller
{
	 
	public $theme = 'admin';
	public $yiiform;
	public $layout='//layouts/column2'; 
	function init(){
		parent::init();
	}
 
	function load($name,$alias='application'){ 
		Yii::import($alias);
	}
}