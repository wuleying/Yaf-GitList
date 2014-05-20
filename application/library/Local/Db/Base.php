<?php

/**
 * 模型基类
 *
 * @author $Author: 5590548@qq.com $
 *
 */

namespace Local\Db;

class Base
{
	// 数据库连接
	protected $db;
	// 主数据库
	protected $dbMaster;
	// 从数据库
	protected $dbSlave;
	// 表名
	protected $table;

	/**
	 * 构造函数
	 *
	 */
	public function __construct()
	{
		// 主数据库
		$this->dbMaster = new \Zend\Db\Adapter\Adapter(
				\Yaf\Registry::get('config')->database->master->toArray()
		);

		// 从数据库
		$this->dbSlave = new \Zend\Db\Adapter\Adapter(
				\Yaf\Registry::get('config')->database->slave->toArray()
		);

		// 默认使用从数据库
		$this->db = & $this->dbSlave;
	}

	/**
	 * 对表名或字段加上相应的引用符
	 *
	 * @param string $str
	 * @return string
	 */
	protected function q($str)
	{
		return $this->db->platform->quoteIdentifier($str);
	}

	/**
	 *
	 *
	 * @param string $str
	 * @return string
	 */
	protected function e($str)
	{
		return $this->db->platform->quoteValue(htmlspecialchars($str));
	}

	/**
	 * 返回查询
	 *
	 * @param string $sql
	 * @return object
	 *
	 */
	protected function queryResult($sql)
	{
		$query = $this->db->query($sql);
		$result = $query->execute();
		return $result;
	}

	/**
	 * 查询多条数据
	 *
	 * @param string $sql
	 * @return array
	 *
	 */
	public function queryArray($sql)
	{
		$result = $this->queryResult($sql);

		$data = array();
		while ($row = $result->current())
		{
			$data[] = $row;
		}
		unset($result, $row);
		return $data;
	}

	/**
	 * 查询单条数据
	 *
	 * @param string $sql
	 * @return array
	 *
	 */
	public function queryFirst($sql)
	{
		$result = $this->queryResult($sql);
		$row = $result->current();
		return $row;
	}

	/**
	 * 查询单个字段
	 *
	 * @param string $sql
	 * @return string
	 */
	public function queryOne($sql)
	{
		$result = $this->queryFirst($sql);
		return current($result);
	}

	/**
	 * 查询，用于 Insert/Updata/Delete
	 *
	 * @param string $sql
	 *
	 */
	public function queryWrite($sql)
	{
		$this->db = & $this->dbMaster;
		$query = $this->db->query($sql);
		$query->execute();
	}

	/**
	 * 保存/更新数据
	 *
	 * @param array $data
	 * @return
	 *
	 */
	public function saveData($data)
	{
		if (empty($data))
		{
			return;
		}

		$db = & $this->dbMaster;
		$sql = array();
		$id = 0;
		if (isset($data[$this->table . 'id']))
		{
			$id = $data[$this->table . 'id'];
			unset($data[$this->table . 'id']);
		}

		foreach ($data as $key => $value)
		{
			$sql[] = $this->q($key) . ' = ' . $this->e($value);
		}

		if (empty($id))
		{
			$query = $db->query("
				INSERT INTO " . $this->q($this->table) . " SET
				" . implode(',', $sql) . "
			", $db::QUERY_MODE_EXECUTE);

			$id =  $db->getDriver()->getLastGeneratedValue();
		}
		else
		{
			$query = $db->query("
				UPDATE " . $this->q($this->table) . " SET
				" . implode(',', $sql) . "
				WHERE {$this->table}id = {$id}
			", $db::QUERY_MODE_EXECUTE);
		}

		return $id;
	}

}