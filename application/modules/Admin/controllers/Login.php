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
		$title = Yaf\Registry::get('lang')->translate('Admin login');
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

		$adminInfo = $this->models['userModel']->getUserByEmail($email);

		if (empty($adminInfo))
		{
			Local\Util\Page::displayError(Yaf\Registry::get('lang')->translate('User not exist'));
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
				Local\Util\Page::displayError(Yaf\Registry::get('lang')->translate('Not permission'));
			}
		}
		else
		{
			Local\Util\Page::displayError(Yaf\Registry::get('lang')->translate('Email or password is not correct'));
		}

		return FALSE;
	}

}