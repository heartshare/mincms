<?php

class YiiController extends Controller
{
	 
	public $theme = 'admin';
	public $yiiform;
	function init(){
		parent::init();
	}
 
	function load($name,$alias='application'){ 
		Yii::import($alias);
	}
}