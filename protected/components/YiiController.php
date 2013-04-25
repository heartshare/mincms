<?php

class YiiController extends Controller
{
	 
	public $theme = 'admin';
	public $yiiform;
	public $layout='//layouts/column2'; 
	function init(){
		parent::init();
	}
 	/**
 	* 加载form.yaml
 	*/
	function load_form($yaml){  
		Yii::import('application.vendor.spyc',true);
		$yaml = str_replace('application.','',$yaml); 
		$file = Yii::app()->basePath.'/'.str_replace('.','/',$yaml).'.yaml'; 
		$arr = spyc_load_file($file);
		foreach($arr as $key=>$value){
			$this->yiiform->$key = $this->_load_form_value($value);
		}  
	}
	protected function _load_form_value($array){
 		if(!is_array($array)) return $array;
 		foreach($array as $k=>$v){
 			if(!$v){
 				$arr[$k] = $k;
 			}else{
 				$arr[$k] = $v;
 			}
 		}	
 		return $arr;
 	}
	
}