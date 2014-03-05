<?php

/**
 * 错误页
 *
 */
class ErrorController extends Yaf\Controller_Abstract
{

	/**
	 * 显示异常
	 *
	 * @param Object $exception
	 */
	public function errorAction($exception)
	{
		$message = array(
			'file' => $exception->getFile(),
			'line' => $exception->getLine(),
			'code' => $exception->getCode(),
			'message' => $exception->getMessage()
		);
		$this->_view->assign('message', $message);
	}

}