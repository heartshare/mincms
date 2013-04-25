<?php  

class Widgets_Input_Init extends Widget{ 
	
 	function run(){ 
 		 $name = $this->name; 
 		 echo '<p>';
 		 echo $this->form->labelEx($this->model,$name,array());
		 echo Html::textField($this->name,$this->value); 
		 echo '</p>';
 	}
	 
	
}