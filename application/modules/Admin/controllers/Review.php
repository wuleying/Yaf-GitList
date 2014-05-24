<?php

/**
 * 内容审核控制器
 *
 * @author $Author: 5590548@qq.com $
 *
 */
class ReviewController extends Local\Controller\Base
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

		$gitCount = $this->models['gitModel']->getAllGitCount(CONTENT_UNAPPROVED);
		// 查询偏移量
		$offset = ($page - 1) * PERPAGE;
		// 总页数
		$pageTotal = ceil($gitCount / PERPAGE);

		$gits = $this->models['gitModel']->getAllGit(CONTENT_UNAPPROVED, 'dateline DESC', $offset, PERPAGE);
		$this->getView()->assign('gits', $gits);
		$this->getView()->assign('pageNav', Local\Util\Page::pageNav($page, $pageTotal, ADMINURL . '/review/index'));

		$title = Yaf\Registry::get('lang')->translate('Review content');
		$this->getView()->assign('title', $title);
		$this->getView()->assign('breadCrumb', Local\Util\Page::dispayBreadCrumb($title, array(), TRUE));
	}

	/**
	 * 审核内容
	 *
	 * @param integer $id
	 * @param integer $approved
	 * @return boolean
	 *
	 */
	public function doAction($id = 0, $approved = CONTENT_UNAPPROVED)
	{
		$id = (int) $id;
		if (empty($id))
		{
			Local\Util\Page::displayError(Yaf\Registry::get('lang')->translate('Incorrect parameter'));
		}

		$this->models['gitModel']->reviewGit($id, $approved);
		$this->redirect('/admin/review/index');
		return FALSE;
	}

}