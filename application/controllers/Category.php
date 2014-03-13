<?php

/**
 * 分类控制器
 *
 * @author $Author: 5590548@qq.com $
 *
 */
class CategoryController extends Local\Controller\Base
{

	/**
	 * 初始化方法
	 *
	 */
	public function init()
	{
		// 加载模型
		$this->models = array(
		);

		// 用户信息
		$this->userInfo = \Yaf\Registry::get('userInfo');
		$this->getView()->assign('userInfo', $this->userInfo);

		// 控制器名称
		$this->getView()->assign('controllerName', $this->getRequest()->getControllerName());
	}

	/**
	 * 分类首页
	 *
	 */
	public function indexAction()
	{
		$title = '分类';
		$this->getView()->assign('title', $title);
	}

}