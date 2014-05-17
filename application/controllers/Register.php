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
		$title = '新用户注册';
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
			Local\Util\Page::displayError('请填写邮箱');
		}

		if (empty($password))
		{
			Local\Util\Page::displayError('请输入密码');
		}

		if (!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			Local\Util\Page::displayError('邮箱格式不正确');
		}

		if (strlen($password) < USER_PASSWORD_MIN || strlen($password) > USER_PASSWORD_MAX)
		{
			Local\Util\Page::displayError('密码长度不正确');
		}

		if ($password != $repassword)
		{
			Local\Util\Page::displayError('两次密码输入不一致');
		}

		// 查询邮箱是否已经注册
		if ($this->models['userModel']->getUserByEmail($email))
		{
			Local\Util\Page::displayError('此邮箱已注册');
		}

		// 写入数据
		$this->models['userModel']->newUser($email, $password);
		Local\Util\Page::displayMessage('注册成功', '/login');
	}

}