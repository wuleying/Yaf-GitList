<?php

/**
 * 搜索控制器
 *
 * @version $Revision: 6 $
 * @date $Date: 2014-02-28 15:38:19 +0800 (周五, 28 二月 2014) $
 * @author $Author: 5590548@qq.com $
 *
 */
class SearchController extends Yaf\Controller_Abstract
{

	/**
	 * 初始化方法
	 *
	 */
	public function init()
	{
		// 加载模型
		$this->models = array(
			'userModel' => new UserModel(),
		);

		// 用户信息
		$this->userInfo = \Yaf\Registry::get('userInfo');
		$this->getView()->assign('userInfo', $this->userInfo);
	}

	/**
	 * 搜索
	 *
	 */
	public function indexAction()
	{
		$title = '搜索';
		$this->getView()->assign('title', $title);
	}

}