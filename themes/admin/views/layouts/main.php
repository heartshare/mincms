<!DOCTYPE html>
<html>
  <head>
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <meta charset="utf-8">
<?php
	css('misc/bootstrap/css/bootstrap.min.css');	
	core_script('jquery');	
	script('misc/bootstrap/js/bootstrap.min.js');	
	//css('misc/KickStart/css/kickstart.css ');	
	//script('misc/KickStart/js/kickstart.js');	
	//css("misc/jquery-ui/css/ui-lightness/jquery-ui-1.10.2.custom.min.css");
?> 
	<style type="text/css">
	  .drag{ 
		background:url("<?php echo base_url();?>/misc/img/drag.png") no-repeat;
	  	width: 50px;
		height: 50px;
		position: relative;
		padding-right: 20px;
	  }	
	  form label{display:block;}
	  .breadcrumb{margin:0;}
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
      .alert{margin-left: 0;padding-left: 20px;};
      .alert li{list-style: none;}
      li{list-style:none;}
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
              <li><a href="#">Home</a></li>
              <li><a href="#about">About</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo t('admin','Content'); ?>
        		<b class="caret"></b></a>
                <ul class="dropdown-menu">
        		  <?php $content_type = StructGenerate::content_type();
        			foreach($content_type as $v){ if($v['display']!=1) continue;?>
                  <li><a href="<?php echo url('yii/grid/admin',array('name'=>$v['slug'])); ?>">
        			<?php echo t('admin',$v['name']); ?></a></li> 
                  <?php }?>
                </ul>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo t('admin','System'); ?><b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="<?php echo url('yii/type/admin'); ?>"><?php echo t('admin','Content Type'); ?></a></li>
                
                  <li class="divider"></li>
                  <li class="nav-header"><?php echo t('admin','Modules'); ?></li>
                  <li><a href="<?php echo url('yii/modules/index'); ?>"><?php echo t('admin','Module Lists'); ?></a></li>
                  <?php
                  	 $nodes = find_all('zii_module'); 
                  	if($nodes){
				 		foreach($nodes as $node){ 
				 			if($node->display==1){
				  ?>
				 	<li><a href="<?php echo url($node->slug.'/default/index'); ?>"><?php echo t('admin',$node->slug); ?></a></li>		 
				 <?php	 }}} ?>
                  
                  
                   
                   
                </ul>
              </li>
            </ul>
             
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    
    <div class="container">
      <?php 
        //Êä³öflash message
       $flash = array('success','error');
       foreach($flash as $v){
       	   if(has_flash($v)){
       ?>
       	<div class="alert alert-<?php echo $v;?>"><?php echo flash($v);?></div>
       <?php }}?>
      
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
<?php
$this->plugin('select2');
?>
  </body>
</html>
		
