<?php

/**
 * 首页
 *
 */
class IndexController extends Local\Controller\Base
{

	/**
	 * 初始化方法
	 *
	 */
	public function init()
	{
		// 加载模型
		$this->models = array(
			'userModel' => new UserModel(),
		);
	}

	/**
	 * 首页
	 *
	 */
	public function indexAction()
	{
		$title = '首页';
		$this->getView()->assign('title', $title);
	}

}