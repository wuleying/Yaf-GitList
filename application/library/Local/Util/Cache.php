<?php

/**
 * 缓存类
 *
 * @author $Author: 5590548@qq.com $
 *
 */

namespace Local\Util;

class Cache
{

	/**
	 * 设置缓存
	 *
	 * @param string $file
	 * @param array  $data
	 *
	 * @return boolean
	 */
	public static function setCache($file, $data)
	{
		if ($handle = fopen($file, 'w+'))
		{
			$data = json_encode($data);
			flock($handle, LOCK_EX);
			$rs = fputs($handle, $data);
			flock($handle, LOCK_UN);
			fclose($handle);
			if ($rs !== FALSE)
			{
				return TRUE;
			}
		}
		return false;
	}

	/**
	 * 获取缓存
	 *
	 * @param string $filename
	 * @return array
	 *
	 */
	public static function getCache($file)
	{
		$json = file_get_contents($file);
		return json_decode($json, TRUE);
	}

}