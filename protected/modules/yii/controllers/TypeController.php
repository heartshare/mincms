<?php

class TypeController extends YiiController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	/*public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}*/

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	/*public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}*/

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model = $this->loadModel($id);
		$this->breadcrumbs=array(
			'Yii Contents'=>array('admin'),
			$model->name,
		); 
		$this->menu=array( 
			array('label'=>Yii::t('admin','Create YiiContent'), 'url'=>array('create')),
			array('label'=>Yii::t('admin','Update YiiContent'), 'url'=>array('update', 'id'=>$model->id)),
			array('label'=>Yii::t('admin','Delete YiiContent'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
			array('label'=>Yii::t('admin','Manage YiiContent'), 'url'=>array('admin')),
		);
		$this->yiiform->title = 'View Content Type';
		$this->yiiform->attributes = array(
				'id',
				'slug',
				'name',
				'commit',
				'sort',
		);
		$this->yiiform->model = $model;
		$this->render('/view');
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$this->breadcrumbs=array(
			'Yii Contents'=>array('index'),
			'Create',
		);

		$this->menu=array(
			array('label'=>Yii::t('admin','Manage YiiContent'), 'url'=>array('admin')),
		);
		$this->yiiform->yaml = 'application.modules.yii.forms.content_type_form';  

		$model=new YiiContent;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['YiiContent']))
		{
			$model->attributes=$_POST['YiiContent'];
			if($model->save())
				$this->redirect(array('admin'));
		}
		$this->yiiform->model = $model;
		$this->yiiform->title = 'Create Content Type';
		$this->render('/form');
		
	 
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$this->breadcrumbs=array(
			'Yii Contents'=>array('index'),
			'Create',
		); 
		$this->menu=array(
			array('label'=>'List YiiContent', 'url'=>array('index')),
			array('label'=>'Manage YiiContent', 'url'=>array('admin')),
		);  
		$this->yiiform->yaml = 'application.modules.yii.forms.content_type_form';  
		$model=$this->loadModel($id); 
		// $this->performAjaxValidation($model); 
		if(isset($_POST['YiiContent']))
		{
			$model->attributes=$_POST['YiiContent'];
			if($model->save())
				$this->redirect(array('admin'));
		}

		$this->yiiform->model = $model;
		$this->yiiform->title = 'Update Content Type';
		$this->render('/form');
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	 

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{ 
		$this->breadcrumbs=array(
			Yii::t('admin','Content Type')=>array('admin'),
			Yii::t('admin','Manage'),
		); 
		$this->menu=array(
			array('label'=>'List YiiContent', 'url'=>array('admin')),
			array('label'=>'Create YiiContent', 'url'=>array('create')),
		);  
		$model=new YiiContent('YiiContent');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['YiiContent']))
			$model->attributes=$_GET['YiiContent'];
		$this->yiiform->model = $model;
		$this->yiiform->yaml = 'application.modules.yii.forms.content_type';
		$this->render('/admin');
		 
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return YiiContent the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=YiiContent::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param YiiContent $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='yii-content-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
