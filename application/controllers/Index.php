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

	}

	/**
	 * 首页
	 *
	 */
	public function indexAction()
	{
		$title = Yaf\Registry::get('lang')->translate('Home');
		$this->getView()->assign('title', $title);
	}

}