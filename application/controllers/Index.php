<?php

/**
 * 首页控制器
 *
 * @author $Author: 5590548@qq.com $
 *
 */
class IndexController extends Local\Controller\Base
{

	/**
	 * 初始化方法
	 *
	 */
	public function init()
	{
		// 控制器名称
		$this->getView()->assign('controllerName', $this->getRequest()->getControllerName());
	}

	/**
	 * 首页
	 *
	 */
	public function indexAction()
	{
		$title = '首页';
		$this->getView()->assign('title', $title);
	}

}