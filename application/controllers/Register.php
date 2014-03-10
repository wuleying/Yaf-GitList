<?php

/**
 * 用户注册控制器
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

		if (strlen($password) < 6 || strlen($password) > 16)
		{
			die('密码长度不正确');
		}

		if ($password != $repassword)
		{
			die('两次密码输入不一致');
		}

		// 查询邮箱是否已经注册
		if ($this->models['userModel']->getUserByEmail($email))
		{
			die('此邮箱已注册');
		}

		// 写入数据
		$this->models['userModel']->newUser($email, $password);
		die('注册成功');

		return FALSE;
	}

}