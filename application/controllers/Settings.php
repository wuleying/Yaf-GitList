<?php

/**
 * 个人设置控制器
 *
 * @author $Author: 5590548@qq.com $
 *
 */
class SettingsController extends Local\Controller\Base
{

	/**
	 * 初始化方法
	 *
	 */
	public function init()
	{

	}

	/**
	 * 个人设置默认页
	 *
	 */
	public function indexAction()
	{
		$this->redirect('/settings/account');

		return FALSE;
	}

	/**
	 * 账号设置
	 *
	 */
	public function accountAction()
	{
		$title = Yaf\Registry::get('lang')->translate('Account');
		$this->getView()->assign('title', $title);
	}

}