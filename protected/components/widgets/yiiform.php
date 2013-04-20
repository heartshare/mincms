<?php
class YiiForm extends CWidget{
	public $yiiform;
	public $view; 
 	function value($array){
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
	function run(){
		if(property_exists($this->yiiform,'yaml')){
			Yii::import('application.vendor.spyc',true);
			$yaml = str_replace('application.','',$this->yiiform->yaml);
			
			$file = Yii::app()->basePath.'/'.str_replace('.','/',$yaml).'.yaml';
			if(!file_exists($file)){
				return 'YiiForm Yaml File Not Exists';
			}
			$arr = spyc_load_file($file);
			foreach($arr as $key=>$value){
				$this->yiiform->$key = $this->value($value);
			}  
			$table = $this->yiiform->table; 
			
		}
		
		
	 
		$this->render("form/$this->view",array(
			'yiiform'=>$this->yiiform
		));
	}
	
}