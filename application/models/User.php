<?php

/**
 * 用户模型
 *
 */
class UserModel extends Local\Db\Base
{

	protected $table = 'user';

	/**
	 * 获取所有用户数据
	 *
	 * @return type
	 *
	 */
	public function getAllUsers()
	{
		return $this->queryArray("
			SELECT
				*
			FROM" . $this->q($this->table) . "
			WHERE email = " . $this->e('5590548@qq.com') . "
		");
	}

}