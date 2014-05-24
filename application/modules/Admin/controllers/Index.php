<?php

/**
 * 管理员首页控制器
 *
 * @author $Author: 5590548@qq.com $
 *
 */
class IndexController extends Local\Controller\Base
{

	public function init()
	{
		// 加载模型
		$this->models = array(
			'userModel' => new UserModel()
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
		$title = Yaf\Registry::get('lang')->translate('Admin home');
		$this->getView()->assign('title', $title);
		$this->getView()->assign('breadCrumb', Local\Util\Page::dispayBreadCrumb($title, array(), TRUE));
	}

}