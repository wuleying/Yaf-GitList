<?php

/**
 * 缓存类
 *
 * @author $Author: 5590548@qq.com $
 *
 */

namespace Local\Cache;

class MemcacheSimple
{

	// Memcache 对象
	private $_memcache = NULL;

	/**
	 * 构造函数
	 *
	 * @param array $params
	 *
	 */
	public function __construct($params)
	{
		$this->_memcache = new \Memcache();
		$this->_memcache->connect($params['host'], $params['port']) or die('Could not connect');
	}

	/**
	 * 检查 Memcache 是否存在数据
	 *
	 * @param type $sql
	 *
	 */
	public function check($sql)
	{
		$key = md5($sql);
		if (!$value = $this->get($key))
		{
			return FALSE;
		}
		return $value;
	}

	/**
	 * 获取 Memcache 数据
	 *
	 * @param type $key
	 *
	 */
	public function get($key)
	{
		return $this->_memcache->get($key);
	}

	/**
	 * 设置 Memcache 数据
	 *
	 * @param string $key
	 * @param string $value
	 * @param integer $expire
	 * @param boolean $flag
	 *
	 */
	public function set($key, $value, $expire = MEMCACHE_TIMEOUT, $flag = MEMCACHE_COMPRESSED)
	{
		$this->_memcache->set($key, $value, $flag, $expire);
	}
}