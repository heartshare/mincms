<?php
/**
YMAL格式文件 list的格式
table:yii_content
title:Manage Content Type
columns: 
   slug:
   name:
      name:name
      filter:false
   commit: 
      name:commit
      filter:false
   fields    
      filter:false
      name:fields
      type:raw  
 

*/	
?>
<blockquote><h3><?php echo Yii::t('admin',$this->yiiform->title);?></h3></blockquote>	
<?php 
$this->yiiform->columns[] = array(
	'class'=>'CButtonColumn',
	'deleteButtonImageUrl'=>false,
	'updateButtonImageUrl'=>false,
	'viewButtonImageUrl'=>false,
	'deleteButtonLabel'=>'<i class="icon-trash"></i>',
	'updateButtonLabel'=>'<i class="icon-edit"></i>',
	'viewButtonLabel'=>'<i class="icon-eye-open"></i>', 
	'htmlOptions'=>array(
		'class'=>'grid_icon'
	)
);
$widget['dataProvider'] = $this->yiiform->model->search();
$widget['itemsCssClass'] = 'table table-hover';
if(!property_exists($this->yiiform,'filter'))
	$widget['filter'] = $this->yiiform->model;
$widget['columns'] = $this->yiiform->columns;
$widget['summaryCssClass'] = 'label right';
$widget['filterPosition'] = 'body';
$this->widget('zii.widgets.grid.CGridView', $widget); ?>
