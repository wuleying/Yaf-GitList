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
		);
	}

	/**
	 * 提交GIT
	 *
	 */
	public function indexAction()
	{
		$title = '提交GIT';
		$this->getView()->assign('title', $title);
		$this->getView()->assign('category', Local\Util\Cache::getCache(CACHE_PATH . '/category.json'));
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
			Local\Util\Page::displayError('项目名称不能为空');
		}

		if (empty($data['categoryid']))
		{
			Local\Util\Page::displayError('请选择分类');
		}

		if (empty($data['url']))
		{
			Local\Util\Page::displayError('项目URL不能为空');
		}

		if (empty($data['memo']))
		{
			Local\Util\Page::displayError('项目备注不能为空');
		}


		$this->models['gitModel']->saveData($data);
		unset($data);

		Local\Util\Page::displayMessage('提交成功，管理员审核通过后显示，请耐心等待。', '/add');

		return FALSE;
	}

}