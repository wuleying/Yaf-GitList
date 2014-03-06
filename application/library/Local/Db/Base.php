<?php

/**
 * 模型基类
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
		$this->db = \Yaf\Registry::get("db");
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
		return $this->db->platform->quoteValue($str);
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
	protected function queryArray($sql)
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
	protected function queryFirst($sql)
	{
		$result = $this->queryResult($sql);
		$row = $result->current();
		return $row;
	}

	/**
	 * 保存/更新数据
	 *
	 * @param string $table
	 * @param array $data
	 * @return integer
	 *
	 */
	protected function saveData($table, $data)
	{
		if (empty($data))
		{
			return;
		}

		$db = & $this->db;
		$sql = array();
		$id = $data[$table . 'id'];
		unset($data[$table . 'id']);

		foreach ($data as $key => $value)
		{
			$sql[] = $this->q($key) . ' = ' . $this->e($value);
		}

		if (empty($id))
		{
			$query = $db->query("
				INSERT INTO " . $this->q($table) . " SET
				" . implode(',', $sql) . "
			", $db::QUERY_MODE_EXECUTE);
		}
		else
		{
			$query = $db->query("
				UPDATE " . $this->q($table) . " SET
				" . implode(',', $sql) . "
				WHERE {$table}id = {$id}
			", $db::QUERY_MODE_EXECUTE);
		}
	}

}