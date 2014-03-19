<?php

/**
 * 用户主页控制器
 *
 * @author $Author: 5590548@qq.com $
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

	}

	/**
	 * 查看用户信息
	 *
	 */
	public function viewAction()
	{
		$email = $this->getRequest()->getParam('email');

		$title = $email;
		$this->getView()->assign('title', $title);
	}

}