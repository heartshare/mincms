<?php
/**
 * NODE
 *
 * @author Sun Kang <68103403@qq.com>
 * @link http://www.mincms.com/
 * @copyright 2013-2013 MinCMS Software
 * @license http://www.mincms.com/license/
 */
class Node{
	static $array_deep = 0;
	/**
	* 直接保存数据，无需FORM
	*/
	static function save_data($name,$data,$nid=null){
		$model = new Model;
		$data = (object)$data;
		if(!$nid)
			$nid = $data->id;
		
		if($nid){
			$row = Node::load($name,$nid);
	 		foreach($row as $k=>$v){
	 			$model->$k=$v;
	 		} 
		}
		$st = StructGenerate::tree($name); 
		$rt = Node::set_rules($st);
		$model->rules = $rt['rules'];
		return Node::save($name,$model,$data,$nid,true);  
	}
	/**
	 * 设置验证规则
	 */
	 function set_rules($data){
	 	//set validate rules && plugins
	 	$i=0;  
		foreach($data as $field=>$value){
			/**
			* 对设置中的插件参数进行加载
			*
			*/
			$plugins = $value['plugins'];
			if($plugins){  
				foreach($plugins as $pk=>$plugin){
					/**
					* TAG参数是常规参数，
					* 如对应的是ID，则可以tag:id 或tag:#
					* 如对应的是NAME,则可以tag:name 
					*/
					if($plugin['tag']){
						if(in_array(strtolower($plugin['tag']),array('#','id'))){
							$plugin['tag'] = '#'.$field;
						}elseif(in_array(strtolower($plugin['tag']),array('name'))){
							$plugin['tag'] = $field;
						}
					}
					$out_plugins[$pk] = $plugin;
					//加载插件
					$this->controller->plugin($pk,$plugin);
				}
			}
			/**
			* 设置字段对应的验证规则，
			* 至少有一个验证规则。
			* 如果都没有验证规则，则无法显示表单。
			* 因为数据库不需要保留全为空的值
			*/
			$attrs[] = $field;
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
		/**
		* 无规则直接报错
		*/
	 	if(!$rules){
	 		exit(t('admin','No Validate Rules'));
	 	} 
		return array(
			'rules'=>$rules,
			'attrs'=>$attrs,
			'plugins'=>$out_plugins,
		);
		
	 }
	static function find_all($name,$condition=null){
	 	//使用mysql 分页
	 	return DataBase::find_all($name,$condition);	 
	 }
	/**
	* 分页
	调用方法
	$condition = array(
		'where'=>array(
			'or'=>array('created','like','%标题%'),
			//'and_1'=>array('title','like','%标题%'),
			//'or_2'=>array('title','like','%标题%'),
		), 
		'order'=>array('id'=>'desc'),
	);
	$rows = Node::pager($name,$condition);
	$this->render('admin',array( 
	     'posts'=>$rows['posts'], 
	     'pages'=>$rows['pages'], 
	     'name'=>$name
	));
	//输出数据
	foreach($posts as $row){
	$post = Node::find($name,$row['id']);
	显示分页
	<div class="pagination"> 
	<?php 
	$this->widget('LinkPager',array('pages'=>$pages));
	?>
	</div>
	*/ 
	static function pager($name,$condition=null,$pagesize=20){
	 	//使用mysql 分页
	 	return DataBase::pager($name,$condition,$pagesize);	 
	 }
	static function delete_cache($name,$nid){
		$cache_id = "node_{$name}_{$nid}"; 
		Yii::app()->cache->delete($cache_id);
	}
	/**
	* 显示完整一条node的内容
	*/
	static function load($name,$nid){  
 		$cache_id = "node_{$name}_{$nid}"; 
		$data=Yii::app()->cache->get($cache_id);
		if($data===false)
		{
		    //取得 content_type 指定name的所有信息
			$structs = StructGenerate::tree($name);
			$master = self::table_master($name);
			//取得主node信息，_nid表
			$row = DataBase::select($master." as node",array( 
				'where'=>array(
					'node.id=:id'=>array(':id'=>$nid)
				)
			)); 		
			foreach($structs as $field=>$options){  
				$fid = (int)$options['fid'];//字段ID
				$mysql = $options['mysql'];
				$table = self::table_name($name,$mysql);
				$tables[$table][] = $fid;
				$fs[$fid] = $field;//字段
				$i++;
			}  		 
			$rows = DataBase::find_no_nid($tables,$nid,$fs);
			$data = (object)array_merge($row,$rows);
		    Yii::app()->cache->set($cache_id,$data);
		} 
 	 	return $data; 		
	}
	static function find($name,$condition,$all=false){
		//取得 content_type 指定name的所有信息
		$structs = StructGenerate::tree($name);
 		$master = self::table_master($name);
		if(is_numeric($condition)){  
			return self::load($name,$condition); 
		} else{
			$rt = DataBase::find_all($name,$condition); 
			if(true===$all){
				if($rt){
			 		foreach($rt as $n){
			 			$node[] = find($name,$n['id']);  
			 		}
			 	}
			 	$rt = $node;
			}
			if($condition['limit']==1){
				 return $rt[0];
			}
			return $rt;
		}
	}
	static function update($name,$array=array(),$nid){
		$master = self::table_master($name);
		DataBase::update($master,$array,array(
 			'id=:id',
 			array( ':id'=>$nid)
 		));  
	}
	
 	/**
 	* 数据保存
 	* @params $name content_type_name
 	* @params $model Model
 	* @params $attrs 属性
 	* @params $return 为true时返回nid
 	*/
 	static function save($name,$model,$attrs,$node_id=null,$return=false){  
 		foreach($attrs as $key=>$value){
 			$model->$key = $value;
 		}
 		$out = "##ajax-form-alert##:";
 		if(!$model->validate()){
 			$errors = $model->getErrors(); 
 			$out.= "<ul class='alert alert-error'>";
 			foreach($errors as $key=>$e){
 				foreach($e as $r)
 					$out.= '<li>'.$r.'</li>';
 			}
 			$out.="</ul>"; 
 			if(true === $return){
 				return $out;
 			}
 			exit($out);
 		} 
 		before($model,$name);
 		//保存数据到数据库
 		$structs = StructGenerate::tree($name);
 		$master = self::table_master($name);
 		 
 		//主表 _nid 表，生成node 信息。向mysql中写源数据,返回主键值
 		if($node_id>0){ //如果node_id > 0说明是更新
 			$nid =  $node_id;
 		 	$display = 1;
 		 	if($model->display)
 				$display = $model->display;
 			DataBase::update($master,array( 
	 			'updated'=>time(), 
	 			'display'=>$display
	 		),array(
	 			'id=:id',
	 			array( ':id'=>$node_id)
	 		));  
 		}else{
	 		$nid = DataBase::insert($master,array(
	 			'created'=>time(),
	 			'updated'=>time(),
	 			'uid'=>0
	 		)); 
 		}
 		foreach($structs as $field=>$options){
 			if($value = $model->$field){ //属性有值时 才会查寻数据库
 				$fid = $options['fid'];//字段ID
 				$table = self::table_name($name,$options['mysql']);
 				//对插件的overwrite支持
 				$plugins = $options['plugins'];
 				if($plugins){
	 				foreach($plugins as $pk=>$pks){ 
	 					$af = plugin_before($pk,$value);
							if($af)
								$value = $af;
	 				}
 				}
 				//向数据库中写源数据
 				$update = false;
 				if($node_id>0){ //如果node_id > 0说明是更新
 					$q = DataBase::select($table,array(
 						'where'=>array(
			 				'nid=:nid AND fid=:fid'=>array(':nid'=>$nid,':fid'=>$fid)
			 			) 
			 		)); 
			 		if($q){
				 		$update = true;
			 		}else{
			 			$update = false;
			 		}
 				}
 				if($update===true){
 					DataBase::update($table,array( 
			 			'value'=>$value
			 		),array(
			 			'nid=:nid AND fid=:fid',
	 					array( ':nid'=>$nid,':fid'=>$fid) 
			 		));  
 				}else{
	 				DataBase::insert($table,array(
			 			'nid'=>$nid,
			 			'fid'=>$fid,
			 			'value'=>$value
			 		));
		 		}
 			}
 		}
 		$out.= 1; 
		self::delete_cache($name,$nid);
		if(true === $return){
			return $nid;
		}
		exit($out);  
 	}
 	/**
 	* 返回数据库名称
 	*/
 	static function table_name($name,$mysql,$slave=false){
 		$table = $name.'_'.$mysql;
 		return $table;
 	}
 	/**
 	* 数据库主库名称 如post_nid 一般以_nid结尾
 	*/
 	static function table_master($name,$slave=false){
 		$table = $name.'_nid';
 		return $table;
 	}
 	static function array_first($arr){
 		foreach($arr as $v){
 			return $v;
 		}
 	}
 	
 	/**
	* 条件中判断是否是主分的
	*/
	static function table_nid($key){
		$k = array(
			'id'=>1,
			'display'=>1,
			'sort'=>1,
			'created'=>1,
			'updated'=>1,
			'unique'=>1,
			'uid'=>1
		);
		if($k[$key])
			return "n.$key";
	}
	//判断数组深度
	static function array_deep($array=array()){
	 	foreach($array as $k=>$v){
	 		self::$array_deep++;
	 		if(is_array($v))
	 			self::array_deep($v);
	 	}
	 	return self::$array_deep;
	}
	/**
	* 对分页调用方法的判断
	返回统一结构的where
	where=>array(
		array(k,'=',v)
	)
	*/
	static function where($name,$where){ 
		$deep = Node::array_deep($where); 
 		//如果是1维
 		if($deep==1){
 			foreach($where as $k=>$v){
 				if(is_numeric($k)){
 					$field = $where[0];
 					$condition = $where[1];
 					$value = $where[2];
 					$wheres[] = array(array($field,$condition,$value));
 				}else{
 					$wheres[] = array(array($k,'=',$v));
 				}
 			} 
 		}else{
 			$wheres[] = $where;
 		}
 		
 		return $wheres;
	}
 	
}