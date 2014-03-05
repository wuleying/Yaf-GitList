<?php

/**
 * 首页
 *
 */
class IndexController extends Yaf\Controller_Abstract
{

	public function indexAction()
	{
		$userModel = new UserModel();
		$x = $userModel->getAllUsers();
		print_r($x);
	}

}