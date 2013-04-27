<?php  

class Widgets_Password_Init extends Widget{ 
	
 	function run(){ 
 		 $name = $this->name; 
 		 echo '<p>';
 		 echo $this->form->labelEx($this->model,$name,array());
		 echo Html::passwordField($this->name); 
		 echo '</p>';
 	}
	 
	
}