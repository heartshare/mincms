<?php  

class Plugins_Redactor_Init extends CWidget{ 
    public $tag;
    public $params;
 	function run(){  
		if($this->params)
			$opts = CJavaScript::encode($this->params);
		$base = publish(dirname(__FILE__).'/redactor');
        
		core_script('jquery'); 
 		css($base.'/redactor.css'); 
 		//script($base.'/redactor.js'); 
 		script($base.'/redactor.zh.js'); 
 		if(!$this->tag) return;	 
 	 	
 		write_script('redactor_'.$this->tag," 
 			$('".$this->tag."').redactor($opts); 
 		"); 
	  
 	}
	 
	
}