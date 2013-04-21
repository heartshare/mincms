<?php
/* @var $this FieldsController */

$this->breadcrumbs=array(
	'Fields',
);
?>
<blockquote><h3><?php echo $content_type->slug.' <span class="label">'.Yii::t('admin','Fields').'</span>';?></h3></blockquote>

<?php 
$columns = array(
	'slug','name','data_type'
);
$columns[] = array(
	'class'=>'CButtonColumn',
	'deleteButtonImageUrl'=>false,
	'updateButtonImageUrl'=>false,
	'viewButtonImageUrl'=>false,
	'deleteButtonLabel'=>'<i class="icon-trash"></i>',
	'updateButtonLabel'=>'<i class="icon-edit"></i>',
	'viewButtonLabel'=>false, 
	'updateButtonUrl'=>'Yii::app()->createUrl("yii/fields/index",array(
		"id"=>'.$id.',
		"fid"=>"$data->id",
	))',
	'htmlOptions'=>array(
		'class'=>'grid_icon'
	)
);
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'yii-content-grid',
	'dataProvider'=>$fields->search(),
	'itemsCssClass'=>'table table-hover',
	
	'filterPosition'=>'body',
	'summaryCssClass'=>'label right',
	'columns'=>$columns,
)); ?>
<p>
	<a href="<?php echo $this->createUrl('fields/index',array('id'=>$id)); ?>">
		<button class='btn btn-inverse'>
			<?php echo Yii::t('admin','Create'); ?>
		</button>
	</a>	
</p>	 
<?php $this->renderPartial('/form'); ?>


