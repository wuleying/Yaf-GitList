<?php

/**
 * 用户组模型
 *
 * @author $Author: 5590548@qq.com $
 *
 */
class UserGroupModel extends Local\Db\Base
{

	protected $table = 'usergroup';

	/**
	 * 获取所有用户组数据
	 *
	 * @return array
	 *
	 */
	public function getAllUserGroups()
	{
		$userGroups = array();
		$query = $this->queryArray("
			SELECT
				*
			FROM " . $this->q($this->table) . "
		");

		if (!empty($query))
		{
			foreach ($query as $value)
			{
				$userGroups[$value['usergroupid']] = $value;
			}
		}
		return $userGroups;
	}

	/**
	 * 从 Memcache 中获取缓存数据
	 *
	 * @return array
	 * 
	 */
	public function getAllUserGroupsByCache()
	{
		$usergroup = Yaf\Registry::get('memcache')->get('usergroup');
		if (empty($usergroup))
		{
			Yaf\Registry::get('memcache')->set('usergroup', $this->getAllUserGroups(), MEMCACHE_NEVER_TIMEOUT);
			$usergroup = Yaf\Registry::get('memcache')->get('usergroup');
		}

		return $usergroup;
	}

}