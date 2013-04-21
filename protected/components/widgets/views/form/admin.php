<?php
/* @var $this TypeController */
/* @var $model YiiContent */



/*Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#yii-content-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");*/
?>

<blockquote><h3><?php echo Yii::t('admin',$this->yiiform->title);?></h3></blockquote>	

 

<?php /* echo CHtml::link(Yii::t('admin','Search'),'#',
array('class'=>'search-button')); */?>
<!--<div class="search-form" style="display:none">
<?php /*$this->renderFile(dirname(__FILE__).'/_search.php',array(
	'model'=>$this->yiiform->model,
	'search'=>$this->yiiform->search
)); */?>
</div>-->

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
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'yii-content-grid',
	'dataProvider'=>$this->yiiform->model->search(),
	'itemsCssClass'=>'table table-hover',
	'filter'=>$this->yiiform->model,
	'filterPosition'=>'body',
	'summaryCssClass'=>'label right',
	'columns'=>$this->yiiform->columns,
)); ?>
