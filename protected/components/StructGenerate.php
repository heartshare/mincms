<?php
/**
 * 数据表生成
 *
 * @author Sun Kang <68103403@qq.com>
 * @link http://www.mincms.com/
 * @copyright 2013-2013 MinCMS Software
 * @license http://www.mincms.com/license/
 */
class StructGenerate{
	/**
	* 安装模块所需要的字段信息
	* @params $name 模块名
	*/
	static function module($name){ 
		$path = base_path()."/modules/$name/data";
		if(!is_dir($path)) return;
		$list = scandir($path); 
		foreach($list as $vo){   
			if($vo !="."&& $vo !=".." && $vo !=".svn" )
			{ 
				$file[] = $vo;
				$d = json_decode(file_get_contents($path.'/'.$vo)); 
				//取得内容类型
				$nk = "#name#";
				$type = $d->$nk;
				unset($type->id,$d->$nk);
				$model = YiiContent::model()->findByAttributes(array(
					'slug'=>$type->slug
				));
				$mid = $model->id; 
				//保存内容类型到数据库
				if(!$model){
					$model = new YiiContent;
					foreach($type as $ck=>$ck_value){
						$model->$ck = $ck_value;
					}
					$model->save();
					$mid = $model->id;
				}
				foreach($d as $k=>$li){
					YiiFields::save_struct($k,$li,$mid,$type);
				}
				 
			}
		}
		 
	}
	/**
	* 生成内容类型的CODE
	*/
    static function code($name){
    	$all = self::content_type(); 
    	$tr = self::tree($name);
    	//内容类型信息
    	$tr['#name#'] = $all[$name];  
    	$content = json_encode($tr);
    	Yii::app()->request->sendFile($name.'.json',$content);
    }
	/**
	* @params $content_type_name yii_content(content type)名称
	*  INNODB  MYISAM
	*/
	static function table($content_type_name,$field){
		$data = self::tree($content_type_name);  
		$t_nid = $content_type_name."_nid";
		$r = Yii::app()->db->createCommand('SHOW TABLES')->queryAll();
		$tb = array();
 	 	foreach($r as $a){
 	 		foreach($a as $v){
 	 			if(substr($v,0,4)!='yii_')
 	 				$tb[] = $v;
 	 		}
 	 	} 
 	 	if(!in_array($t_nid,$tb)){
			$sql = "
				CREATE TABLE IF NOT EXISTS `".$t_nid."` (
				  `id` int(11) NOT NULL AUTO_INCREMENT,   
				  `display` tinyint(1) NOT NULL DEFAULT '1',
				  `sort` int(11) NOT NULL,
				  `created` int(11) NOT NULL,
				  `updated` int(11) NOT NULL,
				  `unique` varchar(200) NOT NULL, 
				  `uid` int(11) NOT NULL DEFAULT '0',	
				  PRIMARY KEY (`id`)
				) ENGINE=MYISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
	 		";
	 		$table = Yii::app()->db->createCommand($sql)->query();
	 		foreach($data as $key=>$v){
	 			self::create_table($data,$content_type_name,$key);
	 		}
 		}else{
 			self::create_table($data,$content_type_name,$field);
 		} 
	}
	/**
	* 生成单个字段对应的表
	* 无需单独使用该方法
	* 在 table方法中被调用
	*/
	static function create_table($data,$content_type_name,$field){
		$mysql = $data[$field]['mysql'];
		$length = $data[$field]['length'];
		if(!$mysql) return;
		$type = $mysql;
		
		switch($mysql){
			case 'varchar':
				$len = 255;
		}
		if($length) $len = $length;
		if($len) $type = $mysql."($len)";
		$table = $content_type_name."_$mysql";
		$sql = "
			CREATE TABLE IF NOT EXISTS `".$table."` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `nid` int(11) NOT NULL,
			  `fid` int(11) NOT NULL,
			  `value` $type NOT NULL, 
			  PRIMARY KEY (`id`)
			) ENGINE=MYISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
 		";
 		Yii::app()->db->createCommand($sql)->query();
	}
	/**
	* 生成内容类型列表缓存
	*/
	static function content_type(){
		$cache_id = "yii_content_type";
		$cache_data=Yii::app()->cache->get($cache_id);
		if($cache_data===false)
		{ 
			$sql = 'SELECT 	*	FROM yii_content  ORDER BY sort desc,id asc '; 
			$rows = Yii::app()->db->createCommand($sql)->queryAll();	 
			foreach($rows as $vo){
				$cache_data[$vo['slug']] = $vo;
			}
		 	Yii::app()->cache->set($cache_id,$cache_data);
	 	}
	 	return $cache_data;
	}
	/**
	* 删除内容类型缓存
	*/
	static function delete_cache($content_name=null){
		$cache_id = "yii_content_type_$content_name";
		Yii::app()->cache->delete($cache_id);
		$cache_id = "yii_content_type";
		Yii::app()->cache->delete($cache_id); 
	}
	/**
	* 内容类型对应的所有信息
	* 包含字段，字段的所有配置，如验证规则 插件 对应的mysql字段类型
	*/
	static function tree($content_name=null){
		$cache_id = "yii_content_type_$content_name";
		$cache_data=Yii::app()->cache->get($cache_id);
		if($cache_data===false)
		{ 
			$sql = 'SELECT 
			c.slug type_slug,
			c.name type, 
			c.display display,
			f.slug slug,
			f.name name,
			f.id fid,
			f.list list,
			f.length length,
			f.search search,
			f.data_type mysql,
			f.widget widget,
			v.value validate,
			p.value plugins	
			FROM yii_content AS c 
			LEFT JOIN  yii_fields f 
			ON c.id = f.cid
			LEFT JOIN  yii_plugins p
			ON f.id = p.fid
			LEFT JOIN  yii_validates v
			ON f.id = v.fid	
			ORDER BY f.sort desc ,f.id asc
			'; 
			$rows = Yii::app()->db->createCommand($sql)->queryAll();	
		 	foreach($rows as $row){  
		 		$slug = $row['type_slug'];
		 		$name = $row['content_type'];
	 			$row['validates'] = unserialize($row['validate']); 
	 			unset($row['validate']);
	 			$row['plugins'] = unserialize($row['plugins']); 
	 			unset($row['type_slug']);
	 			if($row['slug'])
		 			$out[$slug][$row['slug']] = $row;
		 	} 
		 	
		 	if($content_name) 
		 		$cache_data = $out[$content_name];
		 	else
		 		$cache_data = $out; 
		 	Yii::app()->cache->set($cache_id,$cache_data);
	 	}
	 	return $cache_data;
	}
	static function FormBuilder($name){
		$st = StructGenerate::tree($name);
		$st['content_type'] = $name;
		return $st;
	}
}