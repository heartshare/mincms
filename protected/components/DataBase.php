<?php
/**
 * 数据库操作
 *
 * @author Sun Kang <68103403@qq.com>
 * @link http://www.mincms.com/
 * @copyright 2013-2013 MinCMS Software
 * @license http://www.mincms.com/license/
 */
class DataBase{ 
	
	static function find_all($name,$condition=null){
		$row = self::_find($name,$condition); 
		$query = $row['query'];
		return $query->queryAll();
	}
	static function _find($name,$condition=null){
		if(!$condition['order'])
			$condition['order'] = array('sort'=>'desc','id'=>'desc');
		$table = Node::table_master($name); 
 		$structs = StructGenerate::tree($name);
 		$sql = "select n.id from $table n "; 
 		//对where条件判断 
 		if($condition['where']){
	 		$where = Node::where($name,$condition['where']);
	 		$i=0;
	 		foreach($where as $wh){ 
	 			foreach($wh as $key=>$wharray){
	 				$i++;
	 				$string = ' AND';
	 				$key = strtoupper($key); //转成大写
	 				if(!is_numeric($key)){ //带OR 或 AND条件的
	 					if(strpos($key,'OR')!==false){ 
	 						$string = ' OR';
	 					}
	 				} 
		 			$f = $wharray[0];
					$c = $wharray[1];
					$v = addslashes($wharray[2]);
					//判断是否是数字
					if(!is_numeric($v)){
						$v = "'".$v."'";
					}
					$master_where = Node::table_nid($f);//判断是否是来自主表的ORDER BY  
					if(!$master_where){//非主表的WHERE 条件
						$wh_alis = $structs[$f]['slug']."_$i"; //alis
						$wh_table = Node::table_name($name,$structs[$f]['mysql']).' '.$wh_alis;
						$wh_fid = $structs[$f]['fid']; 
						
						
						$sql .=" 
							LEFT JOIN $wh_table
							ON {$wh_alis}.nid=n.id AND {$wh_alis}.fid = $wh_fid
						";
						$where_table_alis[$structs[$f]['slug']] = $wh_alis;
						$last_where .= " {$wh_alis}.value {$c} $v $string"; 
					}else{
						$last_where .= " $master_where {$c} $v $string"; 
					}
				}
	 		}  
 		} 
 		 
 		if($last_where) $sql .= " WHERE ".substr($last_where,0,strrpos($last_where,' '));  
		if($condition['order']){ //排序
			foreach($condition['order'] as $order_key=>$order_value){
				$fs = Node::table_nid($order_key);//判断是否是来自主表的ORDER BY
				if(!$fs){
					$fs =  $where_table_alis[$structs[$order_key]['slug']].".value $order_value"; 
				} else{
					$fs  = $fs." $order_value";
				}
				$order .= $fs." ,";
			}
		
		}	
		if($order) $sql .= " ORDER BY	 ".substr($order,0,-1);  
	 	 
 		$query =  Yii::app()->db->createCommand($sql); 
 		unset($row);
 		$row['query'] = $query;
 		$row['sql'] = $sql;
 		return $row;
	}
 	static function pager($name,$condition=null,$pagesize=2){
 		$row = self::_find($name,$condition); 
 		$sql = $row['sql'];
 		$query = $row['query'];  
		$criteria=new CDbCriteria();
		$result = $query->query();
		$pages=new CPagination($result->rowCount);
		$pages->pageSize=$pagesize; 
		$pages->applyLimit($criteria); 
		$result=Yii::app()->db->createCommand($sql." LIMIT :offset,:limit"); 
		$result->bindValue(':offset', $pages->currentPage*$pages->pageSize); 
		$result->bindValue(':limit', $pages->pageSize); 
		$posts=$result->query();
		$rows['posts'] = $posts;
		$rows['pages'] = $pages;
		return $rows;
 	}
 	
 	/**
 	* 通过循环多个表，返回一条完整node信息（不包含*_nid表信息）
 	* @params $tables
 	* @params $nid
 	* @params $fields
 	*/
 	static function find_no_nid($tables,$nid,$fields){   
 		foreach($tables as $table=>$where){
 			$query = Yii::app()->db->createCommand();   
 			$in = implode(',',$where); 
 			$query = $query->from($table)
 					 ->select('nid id,fid,value')
 					 ->where("fid in($in) AND nid=:nid",array(':nid'=>$nid));  
 			$rows = $query->queryAll(); 
 			if(!$rows) continue;
 			foreach($rows as $value){
 				$nid = $value['id'];
 				$fid = $value['fid'];
 				$v = $value['value'];
 				$out[$fields[$fid]][$v] = $v; 
 			}
 		}
 		//整理数据
 		unset($row);
 		$row['id'] = $nid;
 		foreach($out as $f=>$v){
 			if(count($v)==1) 
 				$row[$f] = Node::array_first($v);
 			else
 				$row[$f] = $v;
 		} 
 	  	return $row;
 	 
 	}
 	function select($table,$array=array()){
 		return self::_select($table,$array,true);
 	}
 	function select_all($table,$array=array()){
 		return self::_select($table,$array,false);
 	}
 	static function insert($table,$array){
 		$command = Yii::app()->db->createCommand();
 		$command->insert($table,$array);
 		//取last_insert_id 高并发时可能有问题。请用数据库中 unique 
 		return Yii::app()->db->getLastInsertID(); 
 	}
 	static function update($table,$array,$where=array()){ 
 		$command = Yii::app()->db->createCommand();
 		$command->update($table,$array,$where[0],$where[1]);
 		//取last_insert_id 高并发时可能有问题。请用数据库中 unique 
 		return Yii::app()->db->getLastInsertID(); 
 	}
 	/**
 	* @params $row true时 返回一条记录，如为false 返回所有
 	*/
 	static function _select($table,$array=array(),$row=true){
 		$query = Yii::app()->db->createCommand();
 		$query = $query->from($table); 
 		foreach($array as $key=>$v){ 
 			switch(strtolower($key)){
 				/**
 				* where 条件查寻
 				例如
 				'where'=>array(
	 				'node.id=:id'=>array('id'=>$condition)
	 			)
 				*/
 				case 'where': 
	 				foreach($v as $_k=>$_v){ 
			 			$query = $query->$key($_k,$_v);
			 		}
		 			break;
		 		/**
		 		* 'select'=>'id ',
		 		*/
		 		case 'select':
		 			$query = $query->$key($v);
		 			break;
	 		}
 		}
 		if(true===$row)
 			return $query->queryRow(); 
 		return $query->queryAll(); 
 	}
 	
 	
}