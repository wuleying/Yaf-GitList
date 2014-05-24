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

	}

	/**
	 * 发现
	 *
	 */
	public function indexAction()
	{
		$title = Yaf\Registry::get('lang')->translate('Explore');
		$this->getView()->assign('title', $title);
	}

}