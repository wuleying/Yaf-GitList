<?php

/**
 * 发现控制器
 *
 * @version $Revision: 6 $
 * @date $Date: 2014-02-28 15:38:19 +0800 (周五, 28 二月 2014) $
 * @author $Author: 5590548@qq.com $
 *
 */
class ExploreController extends Yaf\Controller_Abstract
{
	/**
	 * 新用户注册
	 *
	 */
	public function indexAction()
	{
		$title = '新用户注册';
		$this->getView()->assign('title', $title);
	}
}