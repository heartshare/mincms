<?php
/**
 * 自动验证 forms/*.yaml 
 * 需要配置 FormBuilder
 * @author Sun Kang <68103403@qq.com>
 * @link http://www.mincms.com/
 * @copyright 2013-2013 MinCMS Software
 * @license http://www.mincms.com/license/
 */
 
class Model extends CFormModel
{
  	public $rules; 
  	
  	public function rules()
    {
        return $this->rules;
    }
	public function __get($name) { 
		if(!isset($this->$name)) { 
			return false;
		} 
		parent::__get($name); 
	}
	
	public function __set($name,$value)
	{
		$this->$name = $value;
	}

	 
}
