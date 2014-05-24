<?php

/**
 * 内容管理控制器
 *
 * @author $Author: 5590548@qq.com $
 *
 */
class ContentController extends Local\Controller\Base
{

	public function init()
	{
		// 加载模型
		$this->models = array(
			'userModel' => new UserModel(),
			'gitModel' => new GitModel()
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

		$gitCount = $this->models['gitModel']->getAllGitCount();
		// 查询偏移量
		$offset = ($page - 1) * PERPAGE;
		// 总页数
		$pageTotal = ceil($gitCount / PERPAGE);

		$gits = $this->models['gitModel']->getAllGit(CONTENT_APPROVED, 'dateline DESC', $offset, PERPAGE);
		$this->getView()->assign('gits', $gits);
		$this->getView()->assign('pageNav', Local\Util\Page::pageNav($page, $pageTotal, ADMINURL . '/content/index'));

		$title = Yaf\Registry::get('lang')->translate('Content management');
		$this->getView()->assign('title', $title);
		$this->getView()->assign('breadCrumb', Local\Util\Page::dispayBreadCrumb($title, array(), TRUE));
	}

	/**
	 * 编辑内容
	 *
	 * @param integer $id
	 *
	 */
	public function editAction($id = 0)
	{
		$id = (int) $id;
		if (empty($id))
		{
			Local\Util\Page::displayError(Yaf\Registry::get('lang')->translate('Incorrect parameter'));
		}

		$title = Yaf\Registry::get('lang')->translate('Edit content');
		$breadCrumb[ADMINURL . '/content/index'] = Yaf\Registry::get('lang')->translate('Content management');
		$breadCrumb[] = $title;
		$this->getView()->assign('title', $title);
		$this->getView()->assign('breadCrumb', Local\Util\Page::dispayBreadCrumb($title, $breadCrumb, TRUE));
	}

}