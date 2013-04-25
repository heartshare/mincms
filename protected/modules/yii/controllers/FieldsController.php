<?php

class FieldsController extends YiiController
{
	public $layout='//layouts/column1';
	function actionSort($id,$name){   
 		$ids = $sort = $_POST['ids']; 
 		arsort($sort); 
 		$sort = array_merge($sort,array()); 
 		$table = "yii_fields";
 		$fid = $id;
 		$row = Yii::app()->db->createCommand()->from($table)
 		 		->where('id=:id', array(':id'=>$id))
    			->queryRow();
 	  	
 		foreach($ids as $k=>$id){ 
 		 	Yii::app()->db->createCommand() 
 		 		->update($table,
 		 			array(
 		 				'sort'=>$sort[$k]
 		 			),'id=:id', array(':id'=>$id)
 		 	); 
 		} 
 	 
 	 	StructGenerate::delete_cache($name);//Çå³ı»º´æ
 		return 1;
 		
 	}
	public function actionIndex($id,$fid='')
	{ 
		$validates = array(
			'boolean'=>'boolean',
			'email'=>'email',
			'captcha'=>'captcha',
			'date'=>'date',
			'default'=>'default',
			'exist'=>'exist',
			'file'=>'file',
			'filter'=>'filter',
			'in'=>'in',
			'length'=>'length',
			'match'=>'match',
			'numerical'=>'numerical',
			'required'=>'required',
			'type'=>'type',
			'unique'=>'unique',
			'url'=>'url',
		);
 		$this->load_form('application.modules.yii.forms.content_type_fields');
		if($fid)
			$model=YiiFields::model()->findByPk($fid);  
		else
			$model=new YiiFields;  
		if(isset($_POST['YiiFields']))
		{ 
			$model->attributes=$_POST['YiiFields'];
			$model->cid = $id;
			if($model->save()){
				StructGenerate::table($model->type->slug,$model->slug);
				flash('success',t('admin','Save Fields Success'));
				 
				$this->refresh();
			}
		}
		$this->yiiform->model = $model;
		
		$content_type = YiiContent::model()->findByPk($id);
		 
		$fields=new YiiFields('YiiFields');
		$fields->unsetAttributes();  // clear any default values
		if(isset($_GET['YiiFields']))
			$fields->attributes=$_GET['YiiFields'];
		$list = scandir(base_path().'/plugins');
		$plugins[] = t('admin','Please Select');
		foreach($list as $vo){   
			if($vo !="."&& $vo !=".." && $vo !=".svn" )
			{ 
				$plugins[] = $vo;
			}
		}
		 
		$this->render('index',array(
			'content_type'=>$content_type,
			'fields'=>$fields,
			'id'=>$id,
			'fid'=>$fid,
			'name'=>$content_type->slug,
			'plugins'=>$plugins,
			'validates'=>$validates
		));
	} 
	 
}