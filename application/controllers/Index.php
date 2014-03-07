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

		// 用户信息
		$this->userInfo = $this->getUserInfo();
		$this->getView()->assign('userInfo', $this->userInfo);
	}

	/**
	 * 首页
	 *
	 */
	public function indexAction()
	{
		/**
		  $userModel = new UserModel();
		  $x = $userModel->getAllUsers();
		  print_r($x);
		 *
		 */
		$title = '首页';
		$this->getView()->assign('title', $title);
	}

}