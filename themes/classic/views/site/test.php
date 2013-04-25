<?php  
$form = new FormBuilder('post',2);
$form->script = "
	$('form').clearForm();
";
$form->run();

/*$this->plugin('redactor',array(
	'tag'=>'#a'
));*/
?>