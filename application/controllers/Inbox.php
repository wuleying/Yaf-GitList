<?php

/**
 * 私信控制器
 *
 * @author $Author: 5590548@qq.com $
 *
 */
class InboxController extends Local\Controller\Base
{

	/**
	 * 初始化方法
	 *
	 */
	public function init()
	{

	}

	/**
	 * 私信首页
	 *
	 */
	public function indexAction()
	{
		$title = Yaf\Registry::get('lang')->translate('PM');
		$this->getView()->assign('title', $title);
	}

}