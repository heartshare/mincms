<!DOCTYPE html>
<html>
  <head>
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
   	<?php
	$this->cs->registerCssFile('misc/bootstrap/css/bootstrap.min.css');	
	
	?> 
  </head>
  <body>
    <h1>Hello, world!</h1>
    
    
    <?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>
		 
  </body>
</html>
		
