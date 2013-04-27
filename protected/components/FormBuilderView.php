<?php 
$id = 'form'.uniqid();
$form=$this->beginWidget('CActiveForm', array(
	'id'=>$id,
	'enableAjaxValidation'=>false,
)); ?>
<div class="<?php echo $id;?>"></div>

<?php foreach($this->data as $field=>$value){?>
	<?php 
	/**
	* 后台自动加载插件改变的值
	*/
	$plugins = $value['plugins'];
	if($plugins){
		foreach($plugins as $pk=>$pks){ 
		 	$af = plugin_after($pk,$model->$field); 
			if($af)
				$new = $af; 
		}
	}	
	$this->controller->widgets($value['widget'],array(
		'label'=>$value['label'],
		'name'=>$field,
		'value'=>$new,
		'form'=>$form,
		'model'=>$model));?> 
<?php }?>
	
<?php echo CHtml::submitButton($nid>0?Yii::t('admin','Update'):Yii::t('admin','Create'),
	array('class'=>'btn  btn-primary')); ?>
</p>
<?php $this->endWidget();
core_script('jquery');
script('misc/js/php.js');
script('misc/js/jquery.form.js');

$out= "<ul class='alert alert-success'>";
$out.= '<li>'.$this->message.'</li>';
$out.="</ul>"; 
write_script($id,"
$('#".$id."').ajaxForm(function(data) { 
	data = data.substr(strrpos(data,'##ajax-form-alert##:'));
	data = str_replace('##ajax-form-alert##:','',data);
	if(data!=1){
		$('.".$id."').html(data);
	}else{
		$('.".$id."').html(\"".$out."\"); 
		".$this->script."
	}
     
}); 
");	
?>