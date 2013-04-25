<?php
/**
 * CHtml
 *
 * @author Sun Kang <68103403@qq.com>
 * @link http://www.mincms.com/
 * @copyright 2013-2013 MinCMS Software
 * @license http://www.mincms.com/license/
 */
class Html extends CHtml{
	function widget(){
		$arr = self::_widgets();
		foreach($arr as $k=>$v){
			$out[$v] = $v;
		}
		return $out;
	}
	/**
	* ≤È’“widget
	*/
	function _widgets(){
		 $list = scandir(base_path().'/widgets');
		 foreach($list as $vo){  
			 
			if($vo !="."&& $vo !=".." && $vo !=".svn" )
			{ 
				$w[] = $vo;
			}
		}
		return $w;
	}
	function call($name){
		 
	}
 
}