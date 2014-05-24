<?php

/**
 * 分类控制器
 *
 * @author $Author: 5590548@qq.com $
 *
 */
class CategoryController extends Local\Controller\Base
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
	 * 分类首页
	 *
	 * @param integer $id
	 *
	 */
	public function indexAction($id = 0)
	{
		$id = (int) $id;
		$title = Yaf\Registry::get('lang')->translate('Category');
		$this->getView()->assign('title', $title);
	}

}