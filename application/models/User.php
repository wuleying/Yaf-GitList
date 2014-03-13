<?php

/**
 * 用户模型
 *
 * @author $Author: 5590548@qq.com $
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
		// @todo $salt 需要写方法
		$salt = 'abcd';
		$this->saveData($this->table, array(
			'usergroupid' => USERGROUP_ID_GENER,
			'email' => $email,
			'password' => md5(md5($password) . $salt),
			'salt' => $salt,
			'registrattime' => TIMENOW
		));
	}

	/**
	 * 获取管理员信息
	 *
	 * @return array
	 * 
	 */
	public function getAdminInfo()
	{
		$adminInfo = array();

		$httpRequest = new Yaf\Request\Http();
		// 获取cookies
		$email = $httpRequest->getCookie('adminemail');
		$password = $httpRequest->getCookie('adminpassword');


		if ($email)
		{
			// 查询用户信息
			$adminInfoQuery = $this->getUserByEmail($email);

			if ($adminInfoQuery['password'] == $password)
			{
				$adminInfo = $adminInfoQuery;
			}
			unset($adminInfoQuery);
		}

		return $adminInfo;
	}

}