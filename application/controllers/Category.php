<?php

/**
 * 分类控制器
 *
 */
class CategoryController extends Yaf\Controller_Abstract
{

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