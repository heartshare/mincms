<?php

class FieldsController extends YiiController
{

	public function actionIndex($id,$fid='')
	{
		$this->yiiform->yaml = 'application.modules.yii.forms.content_type_fields';  
		if($fid)
			$model=YiiFields::model()->findByPk($fid);  
		else
			$model=new YiiFields;  
		if(isset($_POST['YiiFields']))
		{
			$model->attributes=$_POST['YiiFields'];
			$model->cid = $id;
			if($model->save())
				$this->refresh();
		}
		$this->yiiform->model = $model;
		
		$content_type = YiiContent::model()->findByPk($id);
		 
		$fields=new YiiFields('YiiFields');
		$fields->unsetAttributes();  // clear any default values
		if(isset($_GET['YiiFields']))
			$fields->attributes=$_GET['YiiFields'];

		$this->render('index',array(
			'content_type'=>$content_type,
			'fields'=>$fields,
			'id'=>$id
		));
	} 
	 
}