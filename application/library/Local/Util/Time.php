<?php

/**
 * 时间类
 *
 * @author $Author: 5590548@qq.com $
 *
 */

namespace Local\Util;

class Time
{
	/**
	 * 格式化时间
	 *
	 * @param integer $timestamp
	 * @param string $format
	 * @return string
	 *
	 */
	public static function formatDate($timestamp = TIMENOW, $format = 'Y-m-d H:i:s')
	{
		$config = \Yaf\Registry::get('config');
		return date($format, $timestamp + (3600 * $config->users->default->timezone));
	}

}