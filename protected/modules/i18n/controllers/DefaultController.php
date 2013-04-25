<?php

class DefaultController extends YiiController
{
	public function actionIndex()
	{
		$this->render('index');
	}
}