<?php

class GridController extends YiiController
{
	public $layout='//layouts/column1';
	
	function actionSort($name){   
 		$ids = $sort = $_POST['id']; 
 		arsort($sort); 
 		$sort = array_merge($sort,array()); 
 		$table = Node::table_master($name);
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
 	  
 		return 1;
 		
 	}
 	function actionRemove($name,$id){ 
	 	$row = Node::find($name,$id);
	 	if(!$row) exit;
	 	$dis = 1;
	 	if($row->display == 1)
	 		$dis = 0;
	 	Node::update($name,array('display'=>$dis),$id);
	 	flash('success',t('admin','Update Successful'));
	 	Node::delete_cache($name,$id);
	 	$this->redirect($this->createUrl('grid/admin',array('name'=>$name)));
	}
 	
	function actionIndex($name,$id=null){ 
		$builder = StructGenerate::FormBuilder($name);  
		$this->render('form',array('name'=>$name,'id'=>$id,'builder'=>$builder));
	}
	public function actionAdmin($name)
	{ 
		$t = StructGenerate::tree($name);
	 
		foreach($t as $k=>$v){
			if($v['plugins']){
				$p = $v['plugins'];
				foreach($p as $pk=>$vo){
					$plugins[$pk][] = $k;
				}
			}
			if($v['search'])
				$search[$k] = $v['widget'];
			if($v['list'])
				$list[$k] = $k;
		}
		 
		/*$condition = array(
			'where'=>array(
				'or'=>array('title','like','%标题%'), 
			),  
		);*/
		 
	//	$condition['order'] = array('sort'=>'desc','id'=>'desc');
		$rows = Node::pager($name,$condition);
		$this->render('admin',array( 
		     'posts'=>$rows['posts'], 
		     'pages'=>$rows['pages'], 
		     'name'=>$name,
		     'list'=>$list,
		     'plugins'=>$plugins,
		     'search'=>$search
		));
	} 
	 
}