<?php
/**
 *  Widget
 *  
 * @author Sun Kang <68103403@qq.com>
 * @link http://www.mincms.com/
 * @copyright 2013-2013 MinCMS Software
 * @license http://www.mincms.com/license/
 */
 
class Widget extends CWidget
{
  	public $label;
    public $name;//field name
    public $model;
    public $form;
  	public $value;
  	function init(){
  		parent::init();
  		if(!$this->value)
  			$this->value = $this->model->{$this->name};
  	}
  	 

	 
}
