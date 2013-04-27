<?php 
/** yaml 文件form格式
table:yii_content
title:Manage Content Type
table:yii_fields
columns:  
   slug:textField
   name:textField
   data_type:
       html:dropDownList
       int:INT
       varchar:VARCHAR  
      
*/	
if(property_exists($this->yiiform,'title')){ ?>
<blockquote><h3><?php echo Yii::t('admin',$this->yiiform->title);?></h3></blockquote>	
<?php } ?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'yii-content-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="alert alert-warning">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($this->yiiform->model,null,null,array('class'=>'alert alert-error')); ?>

	<?php foreach ($this->yiiform->columns as $key => $value) { ?> 
		<?php echo $form->labelEx($this->yiiform->model,$key); ?>
		<?php 
		if(!is_array($value))
			echo $form->$value($this->yiiform->model,$key);
		else{
			$key1 = $value['html'];
			unset($value['html']); 
			echo $form->$key1($this->yiiform->model,$key,$value);
		}
		?>
	  
	<?php } ?>	 
	  <p>
		<?php echo CHtml::submitButton($this->yiiform->model->isNewRecord ? Yii::t('admin','Create') : Yii::t('admin','Update'),array('class'=>'btn  btn-primary')); ?>
	  </p>

<?php $this->endWidget(); ?>

</div><!-- form -->