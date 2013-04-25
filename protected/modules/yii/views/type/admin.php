<blockquote><h3><?php echo ' <span class="label">'.Yii::t('admin','Content Type').'</span>';?></h3></blockquote>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'test', 
)); ?>
<?php 
SortHelper::ui('#test',$this->createUrl('type/sort',array('id'=>$id)));
$columns = array(
	'slug_hidden'=>array(
		'name'=>'slug_hidden',
		'type'=>'raw'
	),
	'name',
	'fields'=>array(
		'name'=>'fields',
		'type'=>'raw'
	) 
);
$columns[] = array(
	'class'=>'CButtonColumn',
	'deleteButtonImageUrl'=>false,
	'updateButtonImageUrl'=>false,
	'viewButtonImageUrl'=>false,
	'deleteButtonLabel'=>'<i class="icon-trash"></i>',
	'updateButtonLabel'=>'<i class="icon-edit"></i>',
	'viewButtonLabel'=>false, 
	 
	'htmlOptions'=>array(
		'class'=>'grid_icon'
	)
);
$this->widget('zii.widgets.grid.CGridView', array( 
	'dataProvider'=>$model->search(),
	'itemsCssClass'=>'table table-hover', 
	'filterPosition'=>'body',
	'summaryCssClass'=>'label right',
	'columns'=>$columns,
)); ?>
<?php $this->endWidget(); ?>