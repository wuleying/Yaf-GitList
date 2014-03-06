<?php

/**
 * 首页
 *
 */
class IndexController extends Yaf\Controller_Abstract
{

	/**
	 * 首页
	 *
	 */
	public function indexAction()
	{
		/**
		  $userModel = new UserModel();
		  $x = $userModel->getAllUsers();
		  print_r($x);
		 *
		 */
		$title = '首页';
		$this->getView()->assign('title', $title);
	}

}