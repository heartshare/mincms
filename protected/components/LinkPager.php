<?php
/**
 * 分页
 *
 * @author Sun Kang <68103403@qq.com>
 * @link http://www.mincms.com/
 * @copyright 2013-2013 MinCMS Software
 * @license http://www.mincms.com/license/
 */
class LinkPager extends CLinkPager
{ 
 
	public function init()
	{
		parent::init(); 
		$this->header = null; 
		$this->htmlOptions = array('class'=>'');
		$this->cssFile = false;
		$this->selectedPageCssClass = 'active';
		$this->nextPageLabel = '>';
		$this->prevPageLabel = '<';
		$this->firstPageLabel = '<<';
		$this->lastPageLabel = '>>';
		
	}

 

 
 
 
}
