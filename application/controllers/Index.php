<?php

/**
 * 首页
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
		// 用户信息
		$this->userInfo = \Yaf\Registry::get('userInfo');
		$this->getView()->assign('userInfo', $this->userInfo);
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