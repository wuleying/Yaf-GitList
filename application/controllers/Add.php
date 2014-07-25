<?php

/**
 * 添加数据控制器
 *
 * @author $Author: 5590548@qq.com $
 *
 */
use Local\Util\Page;

class AddController extends Local\Controller\Base
{

	/**
	 * 初始化方法
	 *
	 */
	public function init()
	{
		// 加载模型
		$this->models = array(
			'gitModel' => new GitModel(),
			'categoryModel' => new CategoryModel()
		);

		// 检查用户是否登录
		if (empty(Yaf\Registry::get('userInfo')['userid']))
		{
			Page::displayError('Please login', SYSTEMURL . '/login');
		}
	}

	/**
	 * 提交GIT
	 *
	 */
	public function indexAction()
	{
		$title = Yaf\Registry::get('lang')->translate('Submit GIT');
		$this->getView()->assign('title', $title);
		$this->getView()->assign('category', $this->models['categoryModel']->getAllCategoriesByCache());
	}

	/**
	 * 执行提交GIT数据
	 *
	 */
	public function doAction()
	{
		$data['title'] = $this->getRequest()->getPost('title');
		$data['categoryid'] = (int) $this->getRequest()->getPost('categoryid');
		$data['url'] = $this->getRequest()->getPost('url');
		$data['memo'] = $this->getRequest()->getPost('memo');
		$data['userid'] = Yaf\Registry::get('userInfo')['userid'];
		$data['dateline'] = TIMENOW;

		if (empty($data['title']))
		{
			Page::displayError('Project name cannot be empty');
		}

		if (empty($data['categoryid']))
		{
			Page::displayError('Please select a category');
		}

		if (empty($data['url']))
		{
			Page::displayError('Project URL cannot be empty');
		}

		if (empty($data['memo']))
		{
			Page::displayError('Project description cannot be empty');
		}

		$this->models['gitModel']->saveData($data);
		unset($data);

		Page::displayMessage('Successful submission Please wait for audit', '/add');

		return FALSE;
	}

}