<?php
class overwrite_datepicker{
	
	function before($value){ 
		 return strtotime($value);
	}
	function after($value){ 
		 return date('Y-m-d H:i',$value); 
	}
}