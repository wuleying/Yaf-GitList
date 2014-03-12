<?php

/**
 * 用户主页控制器
 *
 */
class PeopleController extends Local\Controller\Base
{

	/**
	 * 初始化方法
	 *
	 */
	public function init()
	{
		// 用户信息
		$this->userInfo = \Yaf\Registry::get('userInfo');
		$this->getView()->assign('userInfo', $this->userInfo);
	}

	/**
	 * 查看用户信息
	 *
	 */
	public function viewAction()
	{
		$email = $this->getRequest()->getParam('email');
		echo $email;
		die();
		return FALSE;
	}

}