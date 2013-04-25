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
	 public $view = 'FormBuilderView';
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
	 		$row = Node::load($this->name,$this->nid);
	 		foreach($row as $k=>$v){
	 			$this->model->$k=$v;
	 		} 
	 	} 
	 	$data['model'] = $this->model;
	 	$this->set_rules();//set validate 
	 	if($_POST && is_ajax()){
	 		//保存数据成功  
	 	 	Node::save($this->name,$this->model,$this->attrs,$this->nid);
	 	}  
	 	$data['nid'] = $this->nid;
	 	if(!is_ajax())
	 		$this->renderFile(dirname(__FILE__).'/'.$this->view.'.php',$data);
	 }
	 /**
	 * 设置验证规则
	 */
	 function set_rules(){
	 	//set validate rules && plugins
	 	$i=0;  
	 	
		foreach($this->data as $field=>$value){
			// get plugins
			$plugins = $value['plugins'];
			if($plugins){
				foreach($plugins as $pk=>$plugin){
					if($plugin['tag']){
						if(in_array(strtolower($plugin['tag']),array('#','id'))){
							$plugin['tag'] = '#'.$field;
						}elseif(in_array(strtolower($plugin['tag']),array('name'))){
							$plugin['tag'] = $field;
						}
					}
					$this->controller->plugin($pk,$plugin);
				}
			}
			//set validate
			$this->attrs[] = $field;
			$validates = $value['validates'];
			if(!$validates) continue;
			foreach($validates as $k=>$v){  
				if(is_bool($v) || is_numeric($v) ){
					$rules[$i] = array($field,$k);
				}else if(is_array($v)){ 
					$rules[$i][] = $field; 
					$rules[$i][] = $k; 
					foreach($v as $_k=>$_v){  
						$rules[$i][$_k] = $_v;
					} 
				} 
				$i++;
			}
		} 
	 	if(!$rules){
	 		exit(t('admin','No Validate Rules'));
	 	}
		$this->model->rules = $rules; 
		
	 }
	 
}