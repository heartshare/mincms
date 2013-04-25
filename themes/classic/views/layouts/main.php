<!DOCTYPE html>
<html>
  <head>
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <meta charset="utf-8">
   	<?php
	css('misc/bootstrap/css/bootstrap.min.css');	
	core_script('jquery');
	script('misc/bootstrap/js/bootstrap.min.js');	

	
	?> 
	<style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      span.required{color: red;}
      .alert{margin-left: 0;padding-left: 20px;};
      .alert li{list-style: none;}
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
              <li><a href="<?php echo url('site/index');?>">Home</a></li> 
              <li><a href="<?php echo url('site/test');?>">Test</a></li>  
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
		
