<?php

/**
 * Cookies 类
 *
 */

namespace Local\Header;

class Cookies
{

	/**
	 * 设置 Cookies
	 *
	 * @param string $name
	 * @param string $value
	 *
	 */
	public static function setCookie($name, $value)
	{
		setcookie($name, $value, COOKIE_TIMEOUT, '/');
	}

	/**
	 * 清除 Cookies
	 *
	 * @param string $name
	 *
	 */
	public static function clearCookie($name)
	{
		setcookie($name, '', TIMENOW - 3600, '/');
	}

}