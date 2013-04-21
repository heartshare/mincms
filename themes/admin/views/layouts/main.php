<!DOCTYPE html>
<html>
  <head>
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
<?php
	$this->cs->registerCssFile('misc/bootstrap/css/bootstrap.min.css');	
	$this->cs->registerCoreScript('jquery');	
	$this->cs->registerScriptFile('misc/bootstrap/js/bootstrap.min.js');	 
?> 
	<style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      table{width: 100%;}
      table .grid_icon i{margin-right: 5px;}
      table .grid_icon {width: 80px;}
      span.required{color: red;}
      .right{float: right;}
      blockquote{margin:0;}
      .grid-view {padding: 0;}
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
          <a class="brand" href="#">Yii Custom System Admin</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="#">Home</a></li>
              <li><a href="#about">About</a></li>
              <li><a href="#contact">Contact</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo Yii::t('admin','Fields'); ?><b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="<?php echo $this->app->createUrl('yii/type/admin'); ?>"><?php echo Yii::t('admin','Content Type'); ?></a></li>
                  <li><a href="#"><?php echo Yii::t('admin','Fields'); ?></a></li>
                  <li><a href="#">Something else here</a></li>
                  <li class="divider"></li>
                  <li class="nav-header">Nav header</li>
                  <li><a href="#">Separated link</a></li>
                  <li><a href="#">One more separated link</a></li>
                </ul>
              </li>
            </ul>
             
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    
    <div class="container">
      <?php if(isset($this->breadcrumbs)):?>
        <?php $this->widget('zii.widgets.CBreadcrumbs', array(
          'links'=>$this->breadcrumbs,
          'htmlOptions'=>array('class'=>'breadcrumb')
        )); ?><!-- breadcrumbs -->
      <?php endif?>
      <div class="row-fluid">
  	    

  		<?php echo $content; ?>
      </div> 
	</div> 
  </body>
</html>
		
