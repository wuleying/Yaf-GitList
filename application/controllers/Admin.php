<?php

/**
 * 管理员控制器
 *
 * @author $Author: 5590548@qq.com $
 *
 */
class AdminController extends Local\Controller\Base
{

	// 管理员信息
	private $_adminInfo = array();

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

		// 获取管理员信息
		$this->_adminInfo = $this->models['userModel']->getAdminInfo();

		// 获取 Action 方法
		$actionName = $this->getRequest()->getActionName();

		// 权限检查
		if (!in_array($actionName, array(
					'login',
					'account',
					'logout'
				)) && empty($this->_adminInfo))
		{
			$this->redirect('/admin/login');
		}

		if (!empty($this->_adminInfo))
		{
			// 管理员信息
			$this->getView()->assign('adminInfo', $this->_adminInfo);
			// 动作名称
			$this->getView()->assign('actionName', $this->getRequest()->getActionName());
		}
	}

	/**
	 * 管理员登录
	 *
	 */
	public function loginAction()
	{
		// 已经登录
		if ($this->_adminInfo)
		{
			$this->redirect('/admin');
		}

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
		// 已经登录
		if ($this->_adminInfo)
		{
			$this->redirect('/admin');
		}

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

				$this->redirect('/admin/index');
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

	/**
	 * 管理员注销
	 *
	 * @return boolean
	 *
	 */
	public function logoutAction()
	{
		// 清除 Cookies
		Local\Header\Cookies::clearCookie('email');
		Local\Header\Cookies::clearCookie('password');
		Local\Header\Cookies::clearCookie('adminemail');
		Local\Header\Cookies::clearCookie('adminpassword');
		// 删除全局数据
		Yaf\Registry::del('userInfo');

		$this->redirect('/admin/login');

		return FALSE;
	}

	/**
	 * 管理员首页
	 *
	 */
	public function indexAction()
	{
		$title = '管理首页';
		$this->getView()->assign('title', $title);
	}

	/**
	 * 内容管理
	 *
	 */
	public function contentAction()
	{
		$title = '内容管理';
		$this->getView()->assign('title', $title);
	}

	/**
	 * 用户管理
	 *
	 */
	public function userAction()
	{
		$title = '用户管理';
		$this->getView()->assign('title', $title);
	}

	/**
	 * 系统设置
	 *
	 */
	public function settingAction()
	{
		$title = '系统设置';
		$this->getView()->assign('title', $title);
	}

}