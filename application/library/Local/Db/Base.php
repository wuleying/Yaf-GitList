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

	// 数据库对象
	protected $db;
	// 表名
	protected $table;

	/**
	 * 构造函数
	 *
	 */
	public function __construct()
	{
		$this->db = \Yaf\Registry::get('db');
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
		unset($query, $result, $row);
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
		$query = $this->db->query($sql);
		$query->execute();
	}

	/**
	 * 保存/更新数据
	 *
	 * @param array $data
	 * @return integer
	 *
	 */
	public function saveData($data)
	{
		if (empty($data))
		{
			return;
		}

		$db = & $this->db;
		$sql = array();
		$id = $data[$this->table . 'id'];
		unset($data[$this->table . 'id']);

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
		}
		else
		{
			$query = $db->query("
				UPDATE " . $this->q($this->table) . " SET
				" . implode(',', $sql) . "
				WHERE {$this->table}id = {$id}
			", $db::QUERY_MODE_EXECUTE);
		}
	}

}