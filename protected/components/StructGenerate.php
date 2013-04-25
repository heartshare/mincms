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
	* @params $content_type_name yii_content(content type)名称
	*/
	function table($content_type_name,$field){
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
				) ENGINE=INNODB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
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
	*/
	static function create_table($data,$content_type_name,$field){
		$mysql = $data[$field]['mysql'];
		if(!$mysql) return;
		$type = $mysql;
		switch($mysql){
			case 'varchar':
				$len = 255;
		}
		if($len) $type = $mysql."($len)";
		$table = $content_type_name."_$mysql";
		$sql = "
			CREATE TABLE IF NOT EXISTS `".$table."` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `nid` int(11) NOT NULL,
			  `fid` int(11) NOT NULL,
			  `value` $type NOT NULL, 
			  PRIMARY KEY (`id`)
			) ENGINE=INNODB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
 		";
 		Yii::app()->db->createCommand($sql)->query();
	}
	static function content_type(){
		$cache_id = "yii_content_type";
		$cache_data=Yii::app()->cache->get($cache_id);
		if($cache_data===false)
		{ 
			$sql = 'SELECT 	*	FROM yii_content  ORDER BY sort desc,id asc '; 
			$cache_data = Yii::app()->db->createCommand($sql)->queryAll();	 
		 	Yii::app()->cache->set($cache_id,$cache_data);
	 	}
	 	return $cache_data;
	}
	static function delete_cache($content_name=null){
		$cache_id = "yii_content_type_$content_name";
		Yii::app()->cache->delete($cache_id);
		$cache_id = "yii_content_type";
		Yii::app()->cache->delete($cache_id); 
	}
	/**
	* @params $content_name yii_content(content type)名称
	*/
	static function tree($content_name=null){
		$cache_id = "yii_content_type_$content_name";
		$cache_data=Yii::app()->cache->get($cache_id);
		if($cache_data===false)
		{ 
			$sql = 'SELECT 
			c.slug type_slug,
			c.name type, 
			f.slug slug,
			f.name name,
			f.id fid,
			f.list list,
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
			ORDER BY f.sort desc ,f.id desc
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