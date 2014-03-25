<?php

/**
 * 控制器基类
 *
 * @author $Author: 5590548@qq.com $
 *
 */

namespace Local\ConTroller;

class Base extends \Yaf\Controller_Abstract
{

	// 模型
	protected $models = array();
	// 用户信息
	protected $userInfo = array();
	// 管理员信息
	protected $adminInfo = array();
}