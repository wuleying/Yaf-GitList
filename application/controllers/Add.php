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
	}

	/**
	 * 执行提交GIT数据
	 *
	 */
	public function doAction()
	{
		$data['title'] = $this->getRequest()->getPost('title');
		$data['url'] = $this->getRequest()->getPost('url');
		$data['memo'] = $this->getRequest()->getPost('memo');
		$data['userid'] = Yaf\Registry::get('userInfo')['userid'];
		$data['dateline'] = TIMENOW;

		if(empty($data['title']))
		{
			die('项目名称不能为空');
		}

		if(empty($data['url']))
		{
			die('项目URL不能为空');
		}

		if(empty($data['memo']))
		{
			die('项目备注不能为空');
		}


		$this->models['gitModel']->saveData($data);
		unset($data);

		$this->redirect('/add');

		return FALSE;
	}

}