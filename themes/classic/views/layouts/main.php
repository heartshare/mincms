<!DOCTYPE html>
<html>
  <head>
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
   	<?php
	$this->cs->registerCssFile('misc/bootstrap/css/bootstrap.min.css');	
	$this->cs->registerScriptFile('misc/js/jquery-1.9.1.min.js');	
	$this->cs->registerScriptFile('misc/bootstrap/js/bootstrap.min.js');	

	
	?> 
	<style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
  </head>
  <body>
  	<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="#">Yii Custom System</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="#">Home</a></li> 
               
            </ul>
             
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    
    <div class="container">
	    <?php if(isset($this->breadcrumbs)):?>
			<?php $this->widget('zii.widgets.CBreadcrumbs', array(
				'links'=>$this->breadcrumbs,
			)); ?><!-- breadcrumbs -->
		<?php endif?>

		<?php echo $content; ?>
	</div> 
  </body>
</html>
		
