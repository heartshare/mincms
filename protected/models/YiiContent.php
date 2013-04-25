<?php

/**
 * This is the model class for table "yii_content".
 *
 * The followings are the available columns in table 'yii_content':
 * @property integer $id
 * @property string $slug
 * @property string $name
 * @property string $commit
 * @property integer $sort
 */
class YiiContent extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'yii_content';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('slug, name', 'required'),
			array('slug','unique'),
			array('sort', 'numerical', 'integerOnly'=>true),
			array('slug, name', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, slug, name, commit, sort', 'safe', 'on'=>'search'),
			array('slug','check'),
		);
	}
	
	function check($name){
		$ext = strtolower(substr($this->$name,0,4));
		if(Yii::app()->params['debug']===true) return true;
		if($ext=='yii_' || $ext=='core'){
			$this->addError($name,Yii::t('admin','Content Type is not allow'));	
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'slug' => 'Slug',
			'name' => 'Name',
			'commit' => 'Commit',
			'sort' => 'Sort',
		);
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
		$criteria->compare('commit',$this->commit,true);
		$criteria->compare('sort',$this->sort);
		$criteria->order = "sort desc,id asc";
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return YiiContent the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	function getFields(){
		return CHtml::link('<i class="icon-wrench"></i>',Yii::app()->createUrl('yii/fields/index',array('id'=>$this->id)));
	}
	function beforeSave(){
		parent::beforeSave();
		$this->name = trim($_POST['YiiContent']['name']);
		$this->slug = strtolower(trim($_POST['YiiContent']['slug']));
		return true;
	}
	function afterSave(){
		parent::afterSave(); 
		StructGenerate::delete_cache();//Çå³ý»º´æ
		return true;
	}
	function getslug_hidden(){ 
		return '<i class="drag"></i>'.CHtml::hiddenField('ids[]',$this->id).$this->slug;
	}
}
