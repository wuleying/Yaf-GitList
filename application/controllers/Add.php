<?php

/**
 * 添加数据控制器
 *
 * @author $Author: 5590548@qq.com $
 *
 */
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
			Local\Util\Page::displayError(Yaf\Registry::get('lang')->translate('Project name cannot be empty'));
		}

		if (empty($data['categoryid']))
		{
			Local\Util\Page::displayError(Yaf\Registry::get('lang')->translate('Please select a category'));
		}

		if (empty($data['url']))
		{
			Local\Util\Page::displayError(Yaf\Registry::get('lang')->translate('Project URL cannot be empty'));
		}

		if (empty($data['memo']))
		{
			Local\Util\Page::displayError(Yaf\Registry::get('lang')->translate('Project description cannot be empty'));
		}

		$this->models['gitModel']->saveData($data);
		unset($data);

		Local\Util\Page::displayMessage(Yaf\Registry::get('lang')->translate('Successful submission Please wait for audit'), '/add');

		return FALSE;
	}

}