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
		$criteria->compare('data_type',$this->data_type,true);
		$criteria->compare('cid',(int)$_GET['id']);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
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
	function beforeSave(){
		parent::beforeSave();
		$this->name = trim($_POST['YiiFields']['name']);
		return true;
	}
}
