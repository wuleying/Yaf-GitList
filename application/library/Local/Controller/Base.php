<?php

namespace Local\ConTroller;

/**
 * 控制器基类
 *
 */
class Base extends \Yaf\Controller_Abstract
{

	// 模型
	protected $models = array();
	// 用户信息
	protected $userInfo = array();

	/**
	 * 初始化方法
	 *
	 */
	public function init()
	{
		$this->models = array(
			'userModel' => new UserModel(),
		);
	}

	/**
	 * 获取用户信息
	 *
	 *
	 */
	protected function getUserInfo()
	{
		// 从 Cookies 中获取邮箱与密码
		$email = $this->getRequest()->getCookie('email');
		$password = $this->getRequest()->getCookie('password');

		// 获取用户信息
		$userInfo = $this->models['userModel']->getUserByEmail($email);

		// 用户信息不存在
		if (empty($userInfo))
		{
			return;
		}

		// 检查密码
		if ($password != $userInfo['password'])
		{
			return;
		}

		return $userInfo;
	}

}