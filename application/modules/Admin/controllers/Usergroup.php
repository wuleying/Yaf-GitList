<?php

/**
 * 用户组管理控制器
 *
 * @author $Author: 5590548@qq.com $
 *
 */
class UserGroupController extends Local\Controller\Base
{

	public function init()
	{
		// 加载模型
		$this->models = array(
			'userModel' => new UserModel(),
			'userGroupModel' => new UserGroupModel(),
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
		// 获取用户组信息
		$userGroups = $this->models['userGroupModel']->getAllUserGroups();
		$this->getView()->assign('userGroups', $userGroups);

		// 写入缓存 @todo 要移动到编辑用户组ACTION
		Yaf\Registry::get('memcache')->set('usergroup', $userGroups, MEMCACHE_NEVER_TIMEOUT);

		$title = Yaf\Registry::get('lang')->translate('User group management');
		$this->getView()->assign('title', $title);
		$this->getView()->assign('breadCrumb', Local\Util\Page::dispayBreadCrumb($title, array(), TRUE));
	}

	/**
	 * 编辑用户组
	 *
	 */
	public function editAction()
	{
		$title = Yaf\Registry::get('lang')->translate('Edit user group');
		$breadCrumb[ADMINURL . '/usergroup/index'] = Yaf\Registry::get('lang')->translate('User group management');
		$breadCrumb[] = $title;

		$this->getView()->assign('title', $title);
		$this->getView()->assign('breadCrumb', Local\Util\Page::dispayBreadCrumb($title, $breadCrumb, TRUE));
	}

}