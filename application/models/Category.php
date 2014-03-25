<?php

/**
 * 分类模型
 *
 * @author $Author: 5590548@qq.com $
 *
 */
class CategoryModel extends Local\Db\Base
{

	protected $table = 'category';

	/**
	 * 获取全部分类
	 *
	 * @return array
	 * 
	 */
	public function getAllCategories()
	{
		return $this->queryArray("
			SELECT
				*
			FROM " . $this->q($this->table) . "
			WHERE deleted = 0
			ORDER BY sort ASC
		");
	}

}