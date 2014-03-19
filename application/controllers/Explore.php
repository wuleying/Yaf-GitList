<?php

/**
 * 发现控制器
 *
 * @author $Author: 5590548@qq.com $
 *
 */
class ExploreController extends Local\Controller\Base
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

		// 控制器名称
		$this->getView()->assign('controllerName', $this->getRequest()->getControllerName());
	}

	/**
	 * 发现
	 *
	 */
	public function indexAction()
	{
		$title = '发现';
		$this->getView()->assign('title', $title);
	}

}