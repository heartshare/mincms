<?php  

class Plugins_Select2_Init extends CWidget{ 
    public $tag='select';
    public $params;
 	function run(){  
		if($this->params)
			$opts = CJavaScript::encode($this->params);
		$base = publish(dirname(__FILE__).'/select2-3.3.2'); 
		core_script('jquery'); 
 		css($base.'/select2.css');  
 		script($base.'/select2.js'); 
 		if(!$this->tag) return;	  
 		write_script('select2_'.$this->tag," 
 			$('".$this->tag."').select2($opts); 
 		"); 
	  
 	}
	 
	
}