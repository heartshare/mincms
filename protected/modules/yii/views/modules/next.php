<blockquote><h3><?php echo t('admin','Module '.$label); ?></h3></blockquote>  
<?php $form=$this->beginWidget('CActiveForm'); ?>	
<h3><?php echo $name;?></h3>
<p>
	<?php echo t('admin','Desciption').': ';?>
	<label class='label'><?php echo $info['name'];?></label>
</p>
<p>
	<?php echo t('admin','Author').': ';?>
	<label class='label'><?php echo $info['auth'];?></label>
</p>
  <p>
	<?php echo CHtml::submitButton(Yii::t('admin',$label),array('class'=>'btn  btn-primary')); ?>
  </p>

<?php $this->endWidget(); ?>