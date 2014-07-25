<?php

/**
 * 用户登录控制器
 *
 * @author $Author: 5590548@qq.com $
 *
 */
use Local\Util\Page;

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

		// 用户已经登录
		if (Yaf\Registry::get('userInfo'))
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
		$title = Yaf\Registry::get('lang')->translate('User login');
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
			Page::displayError('Please enter email');
		}

		if (empty($password))
		{
			Page::displayError('Please enter password');
		}

		if (!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			Page::displayError('Email format error');
		}

		$userInfo = $this->models['userModel']->getUserByEmail($email);

		if (empty($userInfo))
		{
			Page::displayError('User not exist');
		}

		// 检查密码
		if ($userInfo['password'] == md5(md5($password) . $userInfo['salt']))
		{
			// 写入 Cookies
			Local\Header\Cookies::setCookie('email', $userInfo['email']);
			Local\Header\Cookies::setCookie('password', $userInfo['password']);

			// 更新最后登录时间
			$this->models['userModel']->updateLastLoginTime($userInfo['userid']);

			$this->redirect('/index');
		}
		else
		{
			Page::displayError('Email or password is not correct');
		}

		return FALSE;
	}

}