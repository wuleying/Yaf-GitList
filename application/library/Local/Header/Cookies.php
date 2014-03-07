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

}