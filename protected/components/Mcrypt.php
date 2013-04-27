<?php
/**
 * CHtml
 *
 * @author Sun Kang <68103403@qq.com>
 * @link http://www.mincms.com/
 * @copyright 2013-2013 MinCMS Software
 * @license http://www.mincms.com/license/
 */
class Mcrypt{
	function encode($value,$key=null){
		if(!$key) $key = Yii::app()->params['hash'];
		$crypt = Yii::app()->securityManager;
		$crypt->encryptionKey = $key;
		return $crypt->encrypt($value);
	}
	function decode($value,$key=null){
		if(!$key) $key = Yii::app()->params['hash']; 
		$crypt = Yii::app()->securityManager;
		$crypt->encryptionKey = $key;
		return $crypt->decrypt($value);
	}
 
}