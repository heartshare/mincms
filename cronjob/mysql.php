<?php
error_reporting(E_ALL & ~(E_STRICT | E_NOTICE));
error_reporting(0);
$config = include dirname(__FILE__).'/../protected/config/database.php';
$main = include dirname(__FILE__).'/../protected/config/main.php';
 
$mysql = $config['db']; 
$db = new db;
$db->connect($mysql); 
ini_set('date.timezone',$main['timeZone']?$main['timeZone']:'Asia/Shanghai');
function dump($str){
	print_r('<pre>');
	print_r($str);
	print_r('</pre>');
}
class db{
	protected $_conn;
	protected $_query;
	function connect($mysql){
		$this->_conn = new PDO($mysql['connectionString'],$mysql['username'],$mysql['password'],array(
			PDO::ATTR_PERSISTENT=>true
		)); 
	}
	function query($sql){
		$this->_query = $this->_conn->prepare($sql);
		$this->_query->execute();
	}
	function first(){ 
		return $this->_query->fetch(PDO::FETCH_OBJ);  
	}
	function get(){
		while($list = $this->_query->fetch(PDO::FETCH_OBJ)){
			$data[] = $list;
		}
		return $data;
	}
}

 
