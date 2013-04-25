<?php
/* @var $this FieldsController */

$this->breadcrumbs=array(
	'Fields',
);
?>
<blockquote><h3><?php echo $content_type->slug.' <span class="label">'.Yii::t('admin','Fields').'</span>';?></h3></blockquote>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'test', 
)); ?>
<?php 
 
SortHelper::ui('#test',$this->createUrl('fields/sort',array('id'=>$id,'name'=>$name)));
$columns = array(
	'slug_hidden'=>array(
		'name'=>'slug_hidden',
		'type'=>'raw'
	),'name','data_type'
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
	'dataProvider'=>$fields->search(),
	'itemsCssClass'=>'table table-hover', 
	'filterPosition'=>'body',
	'summaryCssClass'=>'label right',
	'columns'=>$columns,
)); ?>
<?php $this->endWidget(); ?>
<?php if($fid){?>
<p>
	<a href="<?php echo $this->createUrl('fields/index',array('id'=>$id)); ?>">
		<button class='btn btn-inverse'>
			<?php echo Yii::t('admin','Create'); ?>
		</button>
	</a>	
</p>	 
<?php }?>		
 

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'yii-content-form',
	'enableAjaxValidation'=>false,
)); ?>

<hr>
	<?php echo $form->errorSummary($this->yiiform->model,null,null,array('class'=>'alert alert-error')); ?> 
	
	<div class="row-fluid">
    <div class="span6">
       
		<?php foreach ($this->yiiform->columns as $key => $value) { ?> 
			<?php echo $form->labelEx($this->yiiform->model,$key); ?>
			<?php 
			if(!is_array($value))
				echo $form->$value($this->yiiform->model,$key,array('style'=>'width:200px;'));
			else{
				$key1 = $value['html'];
				unset($value['html']);
				echo $form->$key1($this->yiiform->model,$key,$value,array('style'=>'width:200px;'));
			}
			?> 
		<?php } ?>
		<?php echo $form->labelEx($this->yiiform->model,'Mysql Length'); ?>  
		<?php echo $form->textField($this->yiiform->model,'length'); ?> 
			
		<?php echo $form->labelEx($this->yiiform->model,'widget'); ?> 
		 
		<?php echo CHtml::dropDownList('widget',$this->yiiform->model->widget,Html::widget(),array('style'=>'width:200px;'));?>
		<?php echo $form->labelEx($this->yiiform->model,'In Search'); ?>  
		<?php echo $form->dropDownList($this->yiiform->model,'search',array(0=>t('admin','No'),1=>t('admin','Yes'))); ?> 
		<?php echo $form->labelEx($this->yiiform->model,'Show List'); ?>  
		<?php echo $form->dropDownList($this->yiiform->model,'list',array(0=>t('admin','No'),1=>t('admin','Yes'))); ?>  
    </div>
    <div class="span6">
       <?php echo $form->labelEx($this->yiiform->model,'validates'); ?> 
	   
		<div class='well' id='v'> 
			<?php echo CHtml::textArea('validate',$this->yiiform->model->validates,array('style'=>'width:400px;height:100px'));?>
		</div>

		<?php echo $form->labelEx($this->yiiform->model,'plugins'); ?> 
		
		<div class='well' id='p'>
			<?php echo CHtml::textArea('plugin',$this->yiiform->model->plugins,array('style'=>'width:400px;height:100px')); ?>
		</div>
		<p >
			<?php echo CHtml::submitButton($this->yiiform->model->isNewRecord ? Yii::t('admin','Create') : Yii::t('admin','Update'),array('class'=>'btn btn-primary')); ?>
		</p>  
    </div>  
	
<ul id="tip" class='well' style='display:none; padding: 9px;position:absolute;'>
	<?php foreach($validates as $vali){?>
		<li><?php echo $vali;?></li>
	<?php }?>
</ul>

<?php $this->endWidget();

script('misc/js/jquery.caretposition.js');
script('misc/js/jquery.insertatcaret.min.js');	
write_script('content_type_validate'," 
    	var tip = $('#tip');
		$('#tip li').click(function(){
			$('#validate').insertAtCaret($(this).html()+':');
			tip.hide();
		});
		$('#validate').bind('keyup', function(e) {  
			if (e.keyCode == 32 || e.keyCode == 13) {
				var pos = $(this).getCaretPosition();
				tip.css({
					left: this.offsetLeft + pos.left,
					top: this.offsetTop + pos.top
				}).show(); 
			}else{
				tip.hide();
			}
		});
     
");
?>

 
 


