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
	 * 查询多条数据
	 *
	 * @param string $sql
	 * @return array
	 */
	protected function queryArray($sql)
	{
		$query = $this->db->query($sql);
		$result = $query->execute($result);

		$data = array();
		while ($row = $result->current())
		{
			$data[] = $row;
		}
		unset($query, $result, $row);
		return $data;
	}

}