<?php
/**
 * 建立表单
 *
 * @author Sun Kang <68103403@qq.com>
 * @link http://www.mincms.com/
 * @copyright 2013-2013 MinCMS Software
 * @license http://www.mincms.com/license/
 */
class FormBuilder extends CWidget{
	 public $model;
	 public $file; //file 
	 public $data; //file data araay
	 public $name; //content type name 
	 public $attrs;//fileds
	 public $nid; //node id
	 public $script;
	 public $message;
 	 /**
 	 * $params $file yaml文件，文件在forms目录下。且文件不能有.连接
 	 * 如在froms目录下的目录如 admin/post.php  该值为admin.post
 	 * @params $nid node id,如有值说明是更新操作
 	 */
	 function __construct($file=null,$nid=null){  
	 	$this->message = t('admin','Save Successful');
	 	$this->model = new Model;
	 	$this->file  = $file; 
	 	$this->nid  = $nid; 
	 	if(!is_array($this->file)){
	 		Yii::import('application.vendor.spyc',true);
	 		$file = str_replace('.','/',$file);
	 		$file = base_path()."/forms/{$file}.yaml";
			if(!file_exists($file)){
				return ;
			}
			$this->data = spyc_load_file($file);
			$this->name = $this->data['content_type']; 
			unset($this->data['content_type']); 
	 	}
	 	else{
	 		$this->data = $file;
	 		$this->name = $this->data['content_type']; 
			unset($this->data['content_type']); 
	 	}
	  
	 }
	 
	 function run(){
	 	if($this->nid>0){
	 		/**
	 		* 如果有nid,说明是更新
	 		* 需要先取出NODE的内容并赋值给model
	 		*/
	 		$row = Node::load($this->name,$this->nid);
	 		foreach($row as $k=>$v){
	 			$this->model->$k=$v;
	 		} 
	 	} 
	 	$data['model'] = $this->model;
	 	//设置字段验证规则
	 	$this->set_rules();
	 	if($_POST && is_ajax()){
	 		//保存数据到数据库  
	 		$attrs_data = array();
	 		foreach($this->attrs as $get){
	 			$attrs_data[$get] = $_POST[$get];
	 		}
	 		
	 	 	Node::save($this->name,$this->model,$attrs_data,$this->nid);
	 	}  
	 	$data['nid'] = $this->nid;
	 	if(!is_ajax())
	 		$this->renderFile(dirname(__FILE__).'/FormBuilderView.php',$data);
	 }
	 /**
	 * 设置验证规则
	 */
	 function set_rules(){
	  	$data = Node::set_rules($this->data);
		//加载插件
		if($plugins) {
			foreach($plugins as $pk=>$plugin)
			$this->controller->plugin($pk,$plugin);
		}
		$this->attrs = $data['attrs']; 
	 	/**
	 	* 验证规则赋值给Model中的ruels属性
	 	*/
		$this->model->rules = $data['rules']; 
		
	 }
	 
}