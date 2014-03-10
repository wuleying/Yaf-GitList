<?php

namespace Local\ConTroller;

/**
 * 控制器基类
 *
 */
class Base extends \Yaf\Controller_Abstract
{

	// 模型
	protected $models = array();
	// 用户信息
	protected $userInfo = array();
}