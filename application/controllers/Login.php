<?php

/**
 * 用户登录控制器
 *
 */
class LoginController extends Local\Controller\Base
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
		$this->userInfo = \Yaf\Registry::get('userInfo');

		// 用户已经登录
		if ($this->userInfo)
		{
			$this->redirect('/index');
		}
	}

	/**
	 * 用户登录
	 *
	 */
	public function indexAction()
	{
		$title = '用户登录';
		$this->getView()->assign('title', $title);
	}

	/**
	 * 执行用户登录
	 *
	 * @return boolean
	 */
	public function accountAction()
	{
		$email = $this->getRequest()->getPost('email');
		$password = $this->getRequest()->getPost('password');

		if (empty($email))
		{
			die('请填写邮箱');
		}

		if (empty($password))
		{
			die('请输入密码');
		}

		if (!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			die('邮箱格式不正确');
		}

		$userInfo = $this->models['userModel']->getUserByEmail($email);

		if (empty($userInfo))
		{
			die('用户不存在');
		}

		// 检查密码
		if ($userInfo['password'] == md5(md5($password) . $userInfo['salt']))
		{
			Local\Header\Cookies::setCookie('email', $userInfo['email']);
			Local\Header\Cookies::setCookie('password', $userInfo['password']);

			$this->redirect('/index');
		}
		else
		{
			die('密码不正确');
		}

		return FALSE;
	}

}