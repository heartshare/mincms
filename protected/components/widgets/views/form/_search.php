<?php
/* @var $this TypeController */
/* @var $model YiiContent */
/* @var $form CActiveForm */
?>

<div class="well">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->controller->route),
	'method'=>'get',
)); ?>

<?php foreach ($search as $key => $value) { ?> 
	<?php echo $form->label($model,$key); ?>
	<?php echo $form->$value($model,$key); ?>
<?php } ?>	 
	 
	<p>
		<?php echo CHtml::submitButton(Yii::t('admin','Search'),array('class'=>'btn')); ?>
	</p>

<?php $this->endWidget(); ?>

</div><!-- search-form -->