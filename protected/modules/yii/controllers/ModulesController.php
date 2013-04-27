<?php
/**
 * 模块管理
 *
 * @author Sun Kang <68103403@qq.com>
 * @link http://www.mincms.com/
 * @copyright 2013-2013 MinCMS Software
 * @license http://www.mincms.com/license/
 */
class ModulesController extends YiiController
{
	public $layout='//layouts/column1';
	public $path;
	public $_modules;
	function init(){
		parent::init();
		Yii::import('application.vendor.spyc',true);
		$this->path = base_path()."/modules";
		$nodes = find_all('zii_module'); 
 		foreach($nodes as $node){ 
 			$this->_modules[$node->slug] = $node->display;
 		} 
	}
	/**
	* 显示所有模块
	*/ 
	function actionIndex(){   
		$path = $this->path;
		$list = scandir($path);
		foreach($list as $vo){ 
			if($vo !="."&& $vo !=".." && $vo !=".svn" )
			{  
				if(!file_exists($path."/$vo/lock")){ 
					$file[$vo] = @spyc_load_file($path."/$vo/readme.yaml");
				}
			}
		}
	 	
	  
		$this->render('index',array(
			'file'=>$file,
			'check'=>$this->_modules,
		));
	}
	/**
	* 下一步
	*/
	function actionNext($name){ 
		$label = "Install";
		if($this->_modules && $this->_modules[$name] == 1)
			$label = "UnInstall";
		$info = @spyc_load_file($this->path."/$name/readme.yaml");
		if($_POST){
			StructGenerate::module($name);
			flash('success',t('admin',$label.' Successful'));
			$model = find('zii_module',array(
				'where'=>array('slug'=>$name)
			));
			$display = 1; 
			if(!$model->id){ 
				save('zii_module',array(
					'slug'=>$name
				));
			} else{
				if($model->display==1) $display = 2;
				save('zii_module',array(
					'display'=>$display
				),$model->id);
			}
			$this->redirect($this->createUrl('modules/index'));
		}
		$this->render('next',array(
			'name'=>$name,
			'info'=>$info,
			'label'=>$label
		));
		 
	}
 
	 
}