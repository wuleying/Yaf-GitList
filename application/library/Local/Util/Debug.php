<?php

/**
 * 调试类
 *
 * @author $Author: 5590548@qq.com $
 *
 */

namespace Local\Util;

class Debug
{

	/**
	 * 自定义调试函数
	 *
	 * @param mixed $var
	 * @param integer $called
	 *
	 */
	public static function debug($var = '', $called = 0)
	{
		$calledFrom = debug_backtrace();
		echo '<strong>' . $calledFrom[$called]['file'] . '</strong>';
		echo ' (line <strong>' . $calledFrom[$called]['line'] . '</strong>)';
		echo "\n<pre>\n";

		$var = print_r($var, true);
		echo $var . "\n</pre>\n";
	}

	/**
	 * 自定义调试函数
	 *
	 * @param mixed $var
	 *
	 */
	public static function x($var = '')
	{
		self::debug($var, 1);
		exit();
	}

}