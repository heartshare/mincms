<?php
/* @var $this TypeController */
/* @var $model YiiContent */


?>
<blockquote><h3><?php echo Yii::t('admin',$this->yiiform->title);?></h3></blockquote>	
 

<?php 

$this->widget('zii.widgets.CDetailView', array(
	'data'=>$this->yiiform->model,
	'attributes'=>$this->yiiform->attributes
)); ?>
