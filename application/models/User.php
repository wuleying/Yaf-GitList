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
	public function getAllUsers($usergroupid = 0, $orderby = 'lasttime DESC', $offset = 0, $limit = 20)
	{
		$where = '';
		if ($usergroupid)
		{
			$where = "WHERE usergroupid =  " . $this->q($usergroupid);
		}

		return $this->queryArray("
			SELECT
				*
			FROM " . $this->q($this->table) . "
			{$where}
			ORDER BY {$orderby}
			LIMIT {$offset}, {$limit}
		");
	}

	/**
	 * 获取所有用户数量
	 *
	 * @param integer $usergroupid
	 * @return integer
	 *
	 */
	public function getAllUsersCount($usergroupid = 0)
	{
		$where = '';
		if ($usergroupid)
		{
			$where = "WHERE usergroupid =  " . $this->q($usergroupid);
		}

		return $this->queryOne("
			SELECT
				COUNT(*)
			FROM " . $this->q($this->table) . "
			{$where}
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
	 * 根据用户ID获取用户信息
	 *
	 * @param integer $userid
	 * @return array
	 *
	 */
	public function getUserById($userid)
	{
		return $this->queryFirst("
			SELECT
				*
			FROM " . $this->q($this->table) . "
			WHERE userid = {$userid}
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
		$salt = Local\Util\String::randString();
		$this->saveData(array(
			'usergroupid' => USERGROUP_ID_GENER,
			'email' => $email,
			'password' => md5(md5($password) . $salt),
			'salt' => $salt,
			'registrattime' => TIMENOW
		));
	}

	/**
	 * 更新用户最后登录时间
	 *
	 * @param integer $userid
	 *
	 */
	public function updateLastLoginTime($userid)
	{
		if (empty($userid))
		{
			return;
		}

		$this->queryWrite("
			UPDATE " . $this->q($this->table) . " SET
				lasttime = " . TIMENOW . "
			WHERE userid = {$userid}
		");
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