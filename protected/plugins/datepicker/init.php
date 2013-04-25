<?php  

class Plugins_Datepicker_Init extends CWidget{ 
    public $tag='select';
    public $params;  
    
    function run(){  
    	$this->params['dateFormat'] = "yy-mm-dd";
		if($this->params)
			$opts = CJavaScript::encode($this->params);
		$base = publish(dirname(__FILE__).'/assets'); 
		core_script('jquery'); 
		core_script('jquery.ui');
 		css($base.'/css.css');  
 		script($base.'/jquery-ui-timepicker-addon.js');  
 		css(core_script_url().'/jui/css/base/jquery-ui.css'); 
 		if(!$this->tag) return;	  
 		write_script('datepicker_'.$this->tag," 
 			$('".$this->tag."').datetimepicker($opts); 
 		");  
 	} 
	 
	
}