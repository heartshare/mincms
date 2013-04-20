<blockquote><h3><?php echo Yii::t('admin',$this->yiiform->title);?></h3></blockquote>	
 
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'yii-content-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="alert alert-warning">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($this->yiiform->model,null,null,array('class'=>'alert alert-error')); ?>

	<?php foreach ($this->yiiform->columns as $key => $value) { ?> 
		<?php echo $form->labelEx($this->yiiform->model,$key); ?>
		<?php echo $form->$value($this->yiiform->model,$key); ?>
	  
	<?php } ?>	 
	  <p>
		<?php echo CHtml::submitButton($this->yiiform->model->isNewRecord ? Yii::t('admin','Create') : Yii::t('admin','Save'),array('class'=>'btn')); ?>
	  </p>

<?php $this->endWidget(); ?>

</div><!-- form -->