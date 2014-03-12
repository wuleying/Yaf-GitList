<?php

/**
 * 分类控制器
 *
 */
class CategoryController extends Yaf\Controller_Abstract
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