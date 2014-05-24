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
				categoryid, parentid, categoryname, sort
			FROM " . $this->q($this->table) . "
			WHERE deleted = 0
			ORDER BY sort ASC
		");
	}

	/**
	 * 从 Memcache 中读取分类数据
	 *
	 * @return type
	 *
	 */
	public function getAllCategoriesByCache()
	{
		$categories = Yaf\Registry::get('memcache')->get('category');
		if (empty($categories))
		{
			$category['all'] = $this->getAllCategories();
			if (!empty($category['all']))
			{
				foreach ($category['all'] as $value)
				{
					$category['list'][$value['parentid']][$value['categoryid']] = $value['categoryname'];
				}
			}
			Yaf\Registry::get('memcache')->set('category', $category, MEMCACHE_NEVER_TIMEOUT);
			$categories = Yaf\Registry::get('memcache')->get('category');
		}

		return $categories;
	}

	/**
	 * 根据父级ID获取分类
	 *
	 * @param integer $parentid
	 * @return array
	 *
	 */
	public function getCategoryByParentid($parentid = 0)
	{
		return $this->queryArray("
			SELECT
				categoryid, parentid, categoryname, sort
			FROM " . $this->q($this->table) . "
			WHERE deleted = 0
			AND parentid = {$parentid}
			ORDER BY sort ASC
		");
	}

	/**
	 * 根据分类ID获取分类信息
	 *
	 * @param integer $categoryid
	 * @return integer
	 *
	 */
	public function getCategoryById($categoryid)
	{
		return $this->queryFirst("
			SELECT
				categoryid, parentid, categoryname, sort
			FROM " . $this->q($this->table) . "
			WHERE categoryid = {$categoryid}
		");
	}

	/**
	 * 删除分类
	 *
	 * @param type $categoryid
	 *
	 */
	public function deleteCategory($categoryid)
	{
		$this->queryWrite("
			UPDATE " . $this->q($this->table) . " SET
				deleted = 1
			WHERE categoryid = {$categoryid}
		");
	}

}