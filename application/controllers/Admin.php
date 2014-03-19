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
	// 执行的动作
	private $_actionName;

	/**
	 * 初始化方法
	 *
	 */
	public function init()
	{
		// 加载模型
		$this->models = array(
			'userModel' => new UserModel(),
			'userGroupModel' => new UserGroupModel(),
			'settingModel' => new SettingModel()
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
			$this->_actionName = $this->getRequest()->getActionName();
			$this->getView()->assign('actionName', $this->_actionName);
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
		$this->_pageInfo('管理首页');
	}

	/**
	 * 内容管理
	 *
	 */
	public function contentAction()
	{
		$this->_pageInfo('内容管理');
	}

	/**
	 * 用户组管理
	 *
	 */
	public function usergroupAction()
	{
		// 获取用户组信息
		$userGroups = $this->models['userGroupModel']->getAllUserGroups();

		// 写入缓存 @todo 要移动到编辑用户组ACTION
		Local\Util\Cache::setCache(CACHE_PATH . '/usergroup.json', $userGroups);

		$this->getView()->assign('userGroups', $userGroups);

		$this->_pageInfo('用户组管理');
	}

	/**
	 * 编辑用户组
	 *
	 */
	public function userGroupEditAction()
	{
		$title = '编辑用户组';
		$breadCrumb[ADMINURL . '/usergroup'] = '用户组管理';
		$breadCrumb[] = $title;
		$this->_pageInfo($title, $breadCrumb);
	}

	/**
	 * 用户管理
	 *
	 */
	public function userAction()
	{
		$page = $this->getRequest()->getParam('page');
		$page = max(1, $page);

		// 获取用户数量
		$userCount = $this->models['userModel']->getAllUsersCount();
		// 查询偏移量
		$offset = ($page - 1) * PERPAGE;
		// 总页数
		$pageTotal = ceil($userCount / PERPAGE);

		// 获取用户数据
		$users = $this->models['userModel']->getAllUsers(0, 'lasttime DESC', $offset, PERPAGE);

		$this->getView()->assign('users', $users);
		$this->getView()->assign('pageNav', Local\Util\Page::pageNav($page, $pageTotal, ADMINURL . '/user'));
		// 获取用户组缓存
		$this->getView()->assign('userGroups', Local\Util\Cache::getCache(CACHE_PATH . '/usergroup.json'));

		$this->_pageInfo('用户管理');
	}

	/**
	 * 编辑用户信息
	 *
	 * @param integer $id
	 *
	 */
	public function userEditAction($id)
	{
		// 获取用户信息
		$userInfo = $this->models['userModel']->getUserById($id);

		if (empty($userInfo))
		{
			die('用户不存在');
		}

		$this->getView()->assign('userInfo', $userInfo);
		// 获取用户组缓存
		$this->getView()->assign('userGroups', Local\Util\Cache::getCache(CACHE_PATH . '/usergroup.json'));

		$title = '编辑用户';
		$breadCrumb[ADMINURL . '/user'] = '用户管理';
		$breadCrumb[] = $title;
		$this->_pageInfo($title, $breadCrumb);
	}

	/**
	 * 执行编辑用户信息
	 *
	 */
	public function userEditDoAction()
	{
		$data['userid'] = $this->getRequest()->getPost('userid');
		$data['usergroupid'] = $this->getRequest()->getPost('usergroupid');
		$password = $this->getRequest()->getPost('password');
		$repassword = $this->getRequest()->getPost('repassword');

		if (empty($data['userid']))
		{
			die('请选择一个用户');
		}

		if (empty($data['usergroupid']))
		{
			die('请选择一个用户组');
		}

		$userInfo = $this->models['userModel']->getUserById($data['userid']);
		if (empty($userInfo))
		{
			die('用户不存在');
		}

		// 如果要修改密码
		if ($password)
		{
			if (strlen($password) < USER_PASSWORD_MIN || strlen($password) > USER_PASSWORD_MAX)
			{
				die('密码长度不正确');
			}
			$data['password'] = md5(md5($password) . $userInfo['salt']);
		}
		unset($userInfo);

		// 保存数据
		$this->models['userModel']->saveData($data);

		$this->redirect('/admin/useredit/id/' . $data['userid']);

		return FALSE;
	}

	/**
	 * 系统设置
	 *
	 */
	public function settingAction()
	{

		// 获取系统设置
		$setting = $this->models['settingModel']->getAllSetting();

		Local\Util\Cache::setCache(CACHE_PATH . '/setting.json', $setting);

		$this->getView()->assign('setting', $setting);

		$this->_pageInfo('系统设置');
	}

	/**
	 * 页面信息
	 *
	 * @param string $title
	 *
	 */
	private function _pageInfo($title, $breadCrumb = array())
	{
		$this->getView()->assign('title', $title);
		$breadCrumbArray[ADMINURL] = '控制台';
		// 面包屑导航
		if (empty($breadCrumb))
		{
			$breadCrumbArray[] = $title;
		}
		else
		{
			foreach ($breadCrumb as $key => $value)
			{
				$breadCrumbArray[$key] = $value;
			}
		}
		$this->getView()->assign('breadCrumb', Local\Util\Page::breadCrumb($breadCrumbArray));
	}

}