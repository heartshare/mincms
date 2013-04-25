<?php
include 'mysql.php';
$db->query("SHOW VARIABLES LIKE  '%basedir%'"); 
$row = $db->first();
foreach($row as $k=>$v){
	$k = strtolower($k);
	if($k=='value')
		$bin = $v.'/bin/';
}
if(!$bin) exit;
$HOST = $mysql['connectionString'];
$USERNAME = $mysql['username'];
$PASSWORD = $mysql['password']; 
$DATABASE = substr($HOST,strrpos($HOST,'dbname=')+7);
$dir = dirname(__FILE__)."/backup/{$DATABASE}_"; 
$file = $dir.date('Ymd-H-i-s',time()).'.sql'; 
$sql = "{$bin}mysqldump -u$USERNAME -p$PASSWORD   $DATABASE > $file ";
 
@exec($sql); 
