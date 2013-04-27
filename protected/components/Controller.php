<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	
	/**
	* @var 
	*/ 
	public $theme;
	public $hash;
	private $securityManager;
	function init(){  
		Yii::app()->theme = $this->theme;
		if(!$this->hash) $this->hash = Yii::app()->params['hash'];
		$this->securityManager = Yii::app()->securityManager;
		$this->securityManager->encryptionKey = $this->hash;
	}
	function encode($value,$key=null){ 
		if($key) $this->securityManager->encryptionKey = $this->hash;
		return base64_encode($this->securityManager->encrypt($value));
	}
	function decode($value,$key=null){ 
		if($key) $this->securityManager->encryptionKey = $this->hash;
		return $this->securityManager->decrypt(base64_decode($value));
	}
	function widgets($name,$params=null){
		return $this->plugin($name,$params,'init','widgets');
	}
	/**
	* Ç°¶ËÖØÓÃwidget
	*/
	function webcontrol($name,$params=null){
		Yii::import("application.webcontrol.{$name}",true); 
		if(!$params) $params = array();
		$cls = ucfirst('webcontrol')."_".ucfirst($name);  
		$this->widget("application.webcontrol.$cls",$params);
	}
	
	function plugin($name,$params=null,$file='init',$type='plugins'){
		Yii::import("application.{$type}.{$name}.$file",true); 
		$cls = ucfirst($type)."_".ucfirst($name)."_".ucfirst($file);  
	 	if(!$params) $params = array();
		$this->widget("application.{$type}.{$name}.$cls",$params);
	}
	function view($view,$data=null){
		if(is_ajax())
			$this->renderPartial($view,$data);
		else
			$this->render($view,$data);
	}
}