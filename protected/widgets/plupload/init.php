<?php  

class Widgets_Plupload_Init extends Widget{ 
	
 	function run(){ 
 		 $name = $this->name; 
 		 echo '<p>';
 		 echo $this->form->labelEx($this->model,$name,array());
		 echo Html::textArea($this->name,$this->value); 
		 echo '</p>';
 	}
	 
	
}