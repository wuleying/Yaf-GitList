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
	 * @return array
	 *
	 */
	public function getAllUsers()
	{
		return $this->queryArray("
			SELECT
				*
			FROM " . $this->q($this->table) . "
		");
	}

	/**
	 * 使用邮箱地址获取用户信息
	 *
	 * @param string $email
	 * @return array
	 *
	 */
	public function getUserByEmail($email)
	{
		return $this->queryFirst("
			SELECT
				*
			FROM " . $this->q($this->table) . "
			WHERE email = " . $this->e($email) . "
			LIMIT 1
		");
	}

	/**
	 * 注册新用户
	 *
	 * @param string $email
	 * @param string $password
	 *
	 */
	public function newUser($email, $password)
	{
		$salt = 'abcd';
		$this->saveData($this->table, array(
			'usergroupid' => DEFAULT_USERGROUP_ID,
			'email' => $email,
			'password' => md5(md5($password) . $salt),
			'salt' => $salt,
			'registrattime' => TIMENOW
		));
	}

}