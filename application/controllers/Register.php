<?php

/**
 * 用户注册控制器
 *
 * @author $Author: 5590548@qq.com $
 *
 */
class RegisterController extends Local\Controller\Base
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
	 * 新用户注册
	 *
	 */
	public function indexAction()
	{
		$title = Yaf\Registry::get('lang')->translate('New user register');
		$this->getView()->assign('title', $title);
	}

	/**
	 * 执行新用户注册
	 *
	 */
	public function accountAction()
	{
		$email = $this->getRequest()->getPost('email');
		$password = $this->getRequest()->getPost('password');
		$repassword = $this->getRequest()->getPost('repassword');

		if (empty($email))
		{
			Local\Util\Page::displayError(Yaf\Registry::get('lang')->translate('Please enter email'));
		}

		if (empty($password))
		{
			Local\Util\Page::displayError(Yaf\Registry::get('lang')->translate('Please enter password'));
		}

		if (!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			Local\Util\Page::displayError(Yaf\Registry::get('lang')->translate('Email format error'));
		}

		if (strlen($password) < USER_PASSWORD_MIN || strlen($password) > USER_PASSWORD_MAX)
		{
			Local\Util\Page::displayError(Yaf\Registry::get('lang')->translate('Password length is not correct'));
		}

		if ($password != $repassword)
		{
			Local\Util\Page::displayError(Yaf\Registry::get('lang')->translate('The two passwords do not match'));
		}

		// 查询邮箱是否已经注册
		if ($this->models['userModel']->getUserByEmail($email))
		{
			Local\Util\Page::displayError(Yaf\Registry::get('lang')->translate('Email registered'));
		}

		// 写入数据
		$this->models['userModel']->newUser($email, $password);
		Local\Util\Page::displayMessage(Yaf\Registry::get('lang')->translate('Register successful'), '/login');
	}

}