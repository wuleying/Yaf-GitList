<?php

/**
 * 管理员登录控制器
 *
 * @author $Author: 5590548@qq.com $
 *
 */
class LoginController extends Local\Controller\Base
{

	public function init()
	{
		// 加载模型
		$this->models = array(
			'userModel' => new UserModel()
		);

		// 获取管理员信息
		$this->adminInfo = $this->models['userModel']->getAdminInfo();

		// 管理员已登录
		if (!empty($this->adminInfo))
		{
			$this->redirect('/admin');
		}
	}

	/**
	 * 管理员登录
	 *
	 */
	public function indexAction()
	{
		$title = '管理员登录';
		$this->getView()->assign('title', $title);
	}

	/**
	 * 执行管理员登录
	 *
	 * @return boolean
	 *
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

		$adminInfo = $this->models['userModel']->getUserByEmail($email);

		if (empty($adminInfo))
		{
			die('用户不存在');
		}

		// 检查密码
		if ($adminInfo['password'] == md5(md5($password) . $adminInfo['salt']))
		{
			// 检查用户组
			if (in_array($adminInfo['usergroupid'], array(
						USERGROUP_ID_SUPERADMIN,
						USERGROUP_ID_ADMIN
					)))
			{
				// 写入 Cookies
				Local\Header\Cookies::setCookie('email', $adminInfo['email']);
				Local\Header\Cookies::setCookie('password', $adminInfo['password']);
				Local\Header\Cookies::setCookie('adminemail', $adminInfo['email']);
				Local\Header\Cookies::setCookie('adminpassword', $adminInfo['password']);

				$this->redirect('/admin');
			}
			else
			{
				die('无权限');
			}
		}
		else
		{
			die('密码不正确');
		}

		return FALSE;
	}

}