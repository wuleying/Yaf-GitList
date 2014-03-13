<?php

/**
 * 错误控制器
 *
 * @author $Author: 5590548@qq.com $
 *
 */
class ErrorController extends Local\Controller\Base
{

	/**
	 * 显示异常
	 *
	 * @param Object $exception
	 */
	public function errorAction($exception)
	{
		$this->_view->assign('exception', $exception);
	}

}