<?php
class YiiGrid extends CWidget{ 
	public $condition; 
 	public $name;
 	public $url = 'yii/grid/sort';
 	public $update = 'yii/grid/index';
 	public $delete = 'yii/grid/remove';
  
	function run(){  
		$t = StructGenerate::tree($this->name); 
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
				'or'=>array('title','like','%БъЬт%'), 
			),  
		);*/ 
	//	$condition['order'] = array('sort'=>'desc','id'=>'desc');
		$rows = Node::pager($this->name,$this->condition);
		$this->render('grid/admin',array( 
		     'posts'=>$rows['posts'], 
		     'pages'=>$rows['pages'], 
		     'name'=>$this->name,
		     'list'=>$list,
		     'url'=>$this->url,
		     'update'=>$this->update,
		     'delete'=>$this->delete,
		     'plugins'=>$plugins,
		     'search'=>$search
		));
	 
	 
	}
	
}