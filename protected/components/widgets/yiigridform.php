<?php
class YiiGridForm extends CWidget{ 
	public $id; 
 	public $name; 
	function run(){  
		$builder = StructGenerate::FormBuilder($this->name);  
		$this->render('grid/form',array('name'=>$this->name,'id'=>$this->id,'builder'=>$builder));
		 
	 
	}
	
}