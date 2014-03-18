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
	 * 获取所有用户数据
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

		if(!empty($query))
		{
			foreach ($query as $value)
			{
				$userGroups[$value['usergroupid']] = $value;
			}
		}
		return $userGroups;
	}

}