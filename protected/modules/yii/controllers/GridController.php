<?php
/**
 * NODE 的CURD
 *
 * @author Sun Kang <68103403@qq.com>
 * @link http://www.mincms.com/
 * @copyright 2013-2013 MinCMS Software
 * @license http://www.mincms.com/license/
 */
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
		 
		$this->render('form',array('name'=>$name,'id'=>$id));
	}
	public function actionAdmin($name)
	{  
		$this->render('admin',array( 
		     'name'=>$name,  
		));
	} 
	 
}