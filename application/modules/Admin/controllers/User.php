<?php

/**
 * 用户管理控制器
 *
 * @author $Author: 5590548@qq.com $
 *
 */
use Local\Util\Page;

class UserController extends Local\Controller\Base
{

	public function init()
	{
		// 加载模型
		$this->models = array(
			'userModel' => new UserModel(),
			'userGroupModel' => new UserGroupModel()
		);

		// 获取管理员信息
		$this->adminInfo = $this->models['userModel']->getAdminInfo();

		// 管理员未登录
		if (empty($this->adminInfo))
		{
			$this->redirect('/admin/login/index');
		}
		else
		{
			// 管理员信息
			$this->getView()->assign('adminInfo', $this->adminInfo);
		}
	}

	/**
	 * 首页
	 *
	 */
	public function indexAction()
	{
		$page = max(1, $this->getRequest()->getParam('page'));

		// 获取用户数量
		$userCount = $this->models['userModel']->getAllUsersCount();
		// 查询偏移量
		$offset = ($page - 1) * PERPAGE;
		// 总页数
		$pageTotal = ceil($userCount / PERPAGE);

		// 获取用户数据
		$users = $this->models['userModel']->getAllUsers(0, 'lasttime DESC', $offset, PERPAGE);

		$this->getView()->assign('users', $users);
		$this->getView()->assign('pageNav', Page::pageNav($page, $pageTotal, ADMINURL . '/user/index'));

		// 获取用户组缓存
		$this->getView()->assign('userGroups', $this->models['userGroupModel']->getAllUserGroupsByCache());

		$title = Yaf\Registry::get('lang')->translate('User management');
		$this->getView()->assign('title', $title);
		$this->getView()->assign('breadCrumb', Page::dispayBreadCrumb($title, array(), TRUE));
	}

	/**
	 * 编辑用户信息
	 *
	 * @param integer $id
	 *
	 */
	public function editAction($id)
	{
		$id = (int) $id;
		// 获取用户信息
		$userInfo = $this->models['userModel']->getUserById($id);

		if (empty($userInfo))
		{
			Page::displayError(Yaf\Registry::get('lang')->translate('User not exist'));
		}

		$this->getView()->assign('userInfo', $userInfo);
		// 获取用户组缓存
		$this->getView()->assign('userGroups', $this->models['userGroupModel']->getAllUserGroupsByCache());

		$title = Yaf\Registry::get('lang')->translate('Edit user');
		$breadCrumb[ADMINURL . '/user/index'] = Yaf\Registry::get('lang')->translate('User management');
		$breadCrumb[] = $title;
		$this->getView()->assign('title', $title);
		$this->getView()->assign('breadCrumb', Page::dispayBreadCrumb($title, $breadCrumb, TRUE));
	}

	/**
	 * 执行编辑用户信息
	 *
	 */
	public function editDoAction()
	{
		$data['userid'] = $this->getRequest()->getPost('userid');
		$data['usergroupid'] = $this->getRequest()->getPost('usergroupid');
		$password = $this->getRequest()->getPost('password');
		//$repassword = $this->getRequest()->getPost('repassword');

		if (empty($data['userid']))
		{
			Page::displayError(Yaf\Registry::get('lang')->translate('Please select a user'));
		}

		if (empty($data['usergroupid']))
		{
			Page::displayError(Yaf\Registry::get('lang')->translate('Please select a user group'));
		}

		$userInfo = $this->models['userModel']->getUserById($data['userid']);
		if (empty($userInfo))
		{
			Page::displayError(Yaf\Registry::get('lang')->translate('User not exist'));
		}

		// 如果要修改密码
		if ($password)
		{
			if (strlen($password) < USER_PASSWORD_MIN || strlen($password) > USER_PASSWORD_MAX)
			{
				Page::displayError(Yaf\Registry::get('lang')->translate('Password length is not correct'));
			}
			$data['password'] = md5(md5($password) . $userInfo['salt']);
		}
		unset($userInfo);

		// 保存数据
		$this->models['userModel']->saveData($data);
		$this->redirect('/admin/user/edit/id/' . $data['userid']);
		return FALSE;
	}

}