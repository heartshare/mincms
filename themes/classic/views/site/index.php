<?php
/* @var $this SiteController */

$this->pageTitle= 'Yii Custom System';
?>

<h1>Welcome to theme<i><?php echo CHtml::encode($this->pageTitle); ?></i></h1>


<p>You may change the content of this page by modifying the following two files:</p>
<ul> 
	<li>View file: <code><?php echo __FILE__; ?></code></li>
	<li>Layout file: <code><?php echo $this->getLayoutFile('main'); ?></code></li>
</ul>

 
