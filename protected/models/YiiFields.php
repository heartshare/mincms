<?php

/**
 * This is the model class for table "yii_fields".
 *
 * The followings are the available columns in table 'yii_fields':
 * @property integer $id
 * @property string $slug
 * @property string $name
 * @property string $data_type
 * @property integer $cid
 */
class YiiFields extends ActiveRecord
{
	public $groups;
	public $validates;
	public $values;
	public $plugins;
	function init(){
		parent::init();
		Yii::import('application.vendor.spyc',true);
	}
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'yii_fields';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('slug, name, data_type, cid', 'required'),
			array('cid', 'numerical', 'integerOnly'=>true),
			array('slug, name', 'length', 'max'=>20),
			array('data_type', 'length', 'max'=>10),
			array('slug','cunique'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, slug, name, data_type, cid', 'safe', 'on'=>'search'),
		);
	}
	function cunique($name){
		$cid = (int)$_GET['id'];
		if(!$cid) 
			$this->addError($name,Yii::t('admin','is uniqued'));
		if(in_array(strtolower($this->$name),array(
			'id',
			'display',
			'sort',
			'created',
			'updated',
			'unique',
			'uid'
			))){
			$this->addError($name,Yii::t('admin','Content Field is used in node'));
		} 
		$model = $this->findByAttributes(array(
			$name=>$this->$name,
			'cid'=>$cid
		));
		
		if($model && $this->id!=$this->id){
			$this->addError($name,Yii::t('admin','is uniqued'));
		} 
	}
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'vali'=>array(self::HAS_ONE, 'YiiValidates', 'fid'),
			'plug'=>array(self::HAS_ONE, 'YiiPlugins', 'fid'),
			'type'=>array(self::BELONGS_TO, 'YiiContent', 'cid'),
		);
	}
	/**
	*
	* 保存字段信息
	* 主要用于modules  data目录里面的生成的.json内容类型
	*/
	function save_struct($k,$li,$mid){  
		$uk = '#name#';
		unset($li->$uk);
		$model_field = YiiFields::model()->findByAttributes(array(
			'slug'=>$k,
			'cid'=>$mid
		)); 
		$plugins = $li->plugins; 
		$validates = $li->validates;
		unset($li->plugins,
			$li->validates,
			$li->type,
			$li->display,
			$li->fid);
	  
		if(!$model_field){
		 	$model = new YiiFields; 
			foreach($li as $k=>$v){
				$model->$k = $v;
			}
			$model->save();
			$fid = $model->id;
		}else{
			$fid = $model_field->id;
		}
	  
	 	
	 	if($plugins){
	 		$model_plugin = YiiPlugins::model()->findByAttributes(
	 			array('fid'=>$fid)
	 		);
	 		if(!$model_plugin){
	 			$model_plugin = new YiiPlugins;
	 			$model_plugin->fid = $fid;
	 			$model_plugin->value = $plugins;
	 			$model_plugin->save();
	 		}
	 	}
	 	if($validates){
	 		$model_vali = YiiValidates::model()->findByAttributes(
	 			array('fid'=>$fid)
	 		);
	 		if(!$model_vali){
	 			$model_vali = new YiiValidates;
	 			$model_vali->fid = $fid;
	 			$model_vali->value = $plugins;
	 			$model_vali->save();
	 		}
	 	} 
	}
	
	

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('data_type',$this->data_type,true);
		$criteria->compare('cid',(int)$_GET['id']);
		$criteria->order = "sort desc,id asc";
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria, 
		    'pagination'=>array(
		        'pageSize'=>20000,
		    ),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return YiiFields the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	function afterFind(){
		parent::afterFind();
		$this->validates = Spyc::YAMLDump($this->vali->value);
		$this->plugins = Spyc::YAMLDump($this->plug->value);
	}
	function afterSave(){
		parent::afterSave(); 
		$validate = $_POST['validate'];
		$plugin = $_POST['plugin'];
		
		if(trim($validate)){
			$validate = Spyc::YAMLLoadString($validate);
			YiiValidates::model()->deleteAllByAttributes(array(
				'fid'=>$this->id
			));
			$model = new YiiValidates;
			$model->fid = $this->id;
			$model->value = $validate;
			$model->save(); 
		}  else{
			YiiValidates::model()->deleteAllByAttributes(array(
				'fid'=>$this->id
			));
		}
		if(trim($plugin)){
			$plugin = Spyc::YAMLLoadString($plugin);
			YiiPlugins::model()->deleteAllByAttributes(array(
				'fid'=>$this->id
			));
			$model = new YiiPlugins;
			$model->fid = $this->id;
			$model->value = $plugin;
			$model->save();  
		}else{
			YiiPlugins::model()->deleteAllByAttributes(array(
				'fid'=>$this->id
			));
		}
		StructGenerate::delete_cache();//清除缓存
		StructGenerate::delete_cache($this->type->slug);//清除缓存 
		return true;
	}
	function beforeSave(){
		parent::beforeSave(); 
		$this->name = trim($_POST['YiiFields']['name']);
		$this->slug = strtolower(trim($_POST['YiiFields']['slug']));
		$this->widget = trim($_POST['widget']); 
		$this->search = trim($_POST['YiiFields']['search']);
		$this->list = trim($_POST['YiiFields']['list']);
		$this->length = trim($_POST['YiiFields']['length']);
		
	 
		return true;
	}
	
	function getslug_hidden(){
		return '<i class="drag"></i>'.CHtml::hiddenField('ids[]',$this->id).$this->slug;
	}
}
