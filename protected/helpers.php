<?php

/**
 * 设置COOKIE
 *
 * @param unknown_type $name
 * @param unknown_type $value
 * @return unknown
 */ 
function cookie($name,$value=null,$time=null){
	if($value){
		$cookie=new CHttpCookie($name,$value);
		if($time>0)
			$cookie->expire = time()+$time; 
		return Yii::app()->request->cookies[$name]=$cookie; 
	}
	else{
		$cookie=Yii::app()->request->cookies[$name]; 
		return $cookie->value;
	}
}
/**
 * 加载内部JS
 *
 * @param unknown_type $name
 */
function  core_script($name){
	Yii::app()->getClientScript()->registerCoreScript($name);
}
function core_script_url(){
	return Yii::app()->clientScript->getCoreScriptUrl();
}
/**
 * 发布一个misc目录
 *
 * @param unknown_type $path
 * @return unknown
 */
function publish($path){
	return Yii::app()->getAssetManager()->publish($path);
}
/**
 * 加载published css文件
 *
 * @param unknown_type $file
 */
function css($file,$media=''){ 
	if(is_array($file)){
		foreach($file as $v){
			Yii::app()->getClientScript()->registerCssFile($v,$media);
		}	
	}
	else
		Yii::app()->getClientScript()->registerCssFile($file,$media);
}

/**
 * 直接写style
 *
 * @param unknown_type $file
 */
function write_css($id,$script){
	Yii::app()->getClientScript()->registerCss($id,$script);
}
/**
 * 加载published js文件
 *
 * @param unknown_type $file
 */
function script($file){
	if(is_array($file)){
		foreach($file as $v){
			Yii::app()->getClientScript()->registerScriptFile($v);
		}	
	}
	else
		Yii::app()->getClientScript()->registerScriptFile($file);
}
/**
 * 直接写script
 *
 * @param unknown_type $file
 */
function write_script($id,$script){
	Yii::app()->getClientScript()->registerScript($id,$script);
}
function has_flash($type){ 
	return Yii::app()->user->hasFlash($type,$msg); 
}
function flash($type,$msg=null){
	if($msg)
		return Yii::app()->user->setFlash($type,$msg);
	else
		return Yii::app()->user->getFlash($type);	
}
function dump($var)
{
	CVarDumper::dump($var, 10, true);
}
function clean_html($s){
	return trim(strip_tags($s));
}

function app(){
	return Yii::app();
}
function url($route,$params=array())
{  
	if($_GET['lang']) $params = array_merge(array('lang'=>$_GET['lang']),$params);
	return Yii::app()->createUrl($route,$params);
}
function h($text)
{
	return htmlspecialchars($text,ENT_QUOTES,Yii::app()->charset);
}
function t($category = 'front',$message,  $params = array(), $source = null, $language = null)
{
	return Yii::t($category, $message, $params, $source, $language);
}
function config($name)
{
	return Yii::app()->params[$name];
}
/**
* 是否是ajax请求
*/
function is_ajax(){ 
	return Yii::app()->request->isAjaxRequest ? true:false;
}
function ip(){
	return Yii::app()->request->userHostAddress;
}
function host(){
	return app()->request->hostInfo;
}

function base_url(){
	return Yii::app()->baseUrl;
}
function root_path(){
	return Yii::app()->basePath.'/..';
}
function base_path(){
	return Yii::app()->basePath;
}
function theme_url(){
	return Yii::app()->theme->baseUrl;
}
function theme_path(){
	return Yii::app()->theme->basePath;
}
/**
* 设置及取得上级URL
*/
function return_url($url=null){
	if($url)
		return Yii::app()->user->setReturnUrl($url);
	return host().Yii::app()->user->returnUrl;
}
/**
* 批量替换
*/
function new_replace($body,$replace=array()){ 
	foreach($replace as $k=>$v){
		$body = str_replace($k,$v,$body);
	}
 	return $body;
}

/**
* 查寻数据
*/
function find($name,$condition){
	if(is_array($condition))
		$condition['limit'] = 1;
	// true 返回完整的node,为空或false 仅返回node id
	$data =  Node::find($name,$condition,true);
	return (object)$data;
}
/**
* 查寻所有数据
*/
function find_all($name,$condition=null){
	$nodes = find_all_nid($name,$condition);
 	if($nodes){
 		foreach($nodes as $n){
 			$node[] = find($name,$n['id']);  
 		}
 	}
 	return $node;
}
/**
* 查寻所有数据
*/
function find_all_nid($name,$condition=null){
	return Node::find_all($name,$condition);
}
/**
* 查寻数据并分页
*/
function pager($name,$condition=null,$pagesize=10){
	return Node::find_all($name,$condition,$pagesize);
}
/**
* 查寻单条数据
*/
function node($name,$id){
	return Node::load($name,$id);
}
/**
* 保存数据
*/
function save($name,$data,$nid=null){
	Node::save_data($name,$data,$nid);
}
function load_file($name){
	$name = str_replace('.','/',$name);
	$file = base_path()."/{$name}.php"; 
	if(file_exists($file)){
		include_once($file);
		$flag = true;
	}
	return $flag;
}
/**
* for NODE.php
*/
function before($model,$name){
	if(load_file("overwrite.{$name}")){ 
		$cls = "over_write_$name";
		$cls::before($model);
	}
 
}
function after($model,$name){
	if(load_file("overwrite.{$name}")){ 
		$cls = "over_write_$name";
		$cls::after($model);
	} 
}
/**
* for Plugins
*/
function plugin_before($name,$value){
	if(load_file("plugins.{$name}.overwrite")){ 
		$cls = "overwrite_$name";  
		return $cls::before($value);
	} 
 
}
function plugin_after($name,$value){ 
	if(load_file("plugins.{$name}.overwrite")){ 
		$cls = "overwrite_$name";  
		return $cls::after($value);
	}  
}

