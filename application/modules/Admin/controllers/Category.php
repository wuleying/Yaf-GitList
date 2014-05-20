<?php

/**
 * 分类控制器
 *
 * @author $Author: 5590548@qq.com $
 *
 */
class CategoryController extends Local\Controller\Base
{

	public function init()
	{
		// 加载模型
		$this->models = array(
			'userModel' => new UserModel(),
			'categoryModel' => new CategoryModel()
		);

		// 获取管理员信息
		$this->adminInfo = $this->models['userModel']->getAdminInfo();

		// 管理员未登录
		if (empty($this->adminInfo))
		{
			$this->redirect('/admin/login/index');
		}
		else
		{
			// 管理员信息
			$this->getView()->assign('adminInfo', $this->adminInfo);
		}
	}

	/**
	 * 分类管理首页
	 *
	 * @param integer $parentid
	 *
	 */
	public function indexAction($parentid = 0)
	{
		$parentid = (int) $parentid;
		// 获取分类数据
		$categories = $this->models['categoryModel']->getCategoryByParentid($parentid);
		$this->getView()->assign('categories', $categories);

		$title = '分类管理';
		$this->getView()->assign('parentid', $parentid);
		$this->getView()->assign('title', $title);
		$this->getView()->assign('breadCrumb', Local\Util\Page::dispayBreadCrumb($title, array(), TRUE));
	}

	/**
	 * 添加/编辑分类
	 *
	 * @param integer $id
	 * @param integer $parentid
	 *
	 */
	public function handleAction($id = 0, $parentid = 0)
	{
		$id = (int) $id;

		if ($id)
		{
			$categoryInfo = $this->models['categoryModel']->getCategoryById($id);
			$title = '编辑分类';
		}
		else
		{
			$categoryInfo = array(
				'categoryid' => 0,
				'parentid' => $parentid,
				'categoryname' => '',
				'sort' => SORT_DEFAULT_VALUE
			);
			$title = '添加分类';
		}

		// 读取缓存
		$categoryCache = Yaf\Registry::get('memcache')->get('category');

		$this->getView()->assign('categoryInfo', $categoryInfo);
		$this->getView()->assign('categoryList', Local\Util\Page::displayCategorySelector($categoryCache['list'], $categoryInfo['parentid']));
		$this->getView()->assign('title', $title);
		$this->getView()->assign('breadCrumb', Local\Util\Page::dispayBreadCrumb($title, array(), TRUE));
		unset($categoryInfo, $categoryCache);
	}

	/**
	 * 执行添加/编辑分类
	 *
	 * @return boolean
	 *
	 */
	public function doAction()
	{
		$data['categoryid'] = (int) $this->getRequest()->getPost('categoryid');
		$data['categoryname'] = $this->getRequest()->getPost('categoryname');
		$data['parentid'] = (int) $this->getRequest()->getPost('parentid');
		$data['sort'] = (int) $this->getRequest()->getPost('sort');

		if (empty($data['categoryname']))
		{
			die('请输入分类名称');
		}

		// @todo 这里还有点问题，父级分类不能设置为子分类的子分类，否则会出现逻辑错误
		if ($data['categoryid'] && ($data['categoryid'] == $data['parentid']))
		{
			die('不能成为自身的父分类');
		}

		$this->models['categoryModel']->saveData($data);

		// 生成分类缓存
		$this->_createCategroiesCache();
		$this->redirect('/admin/category/index/parentid/' . $data['parentid']);
		return FALSE;
	}

	/**
	 * 删除分类
	 *
	 * @param integer $id
	 * @return boolean
	 *
	 */
	public function deleteAction($id = 0)
	{
		$id = (int) $id;
		if ($id)
		{
			$this->models['categoryModel']->deleteCategory($id);

			// 生成分类缓存
			$this->_createCategroiesCache();
		}

		$this->redirect('/admin/category/index');
		return FALSE;
	}

	/**
	 * 生成分类缓存
	 *
	 */
	private function _createCategroiesCache()
	{
		// 写入缓存
		$category['all'] = $this->models['categoryModel']->getAllCategories();
		$category['list'] = array();

		if (!empty($category['all']))
		{
			foreach ($category['all'] as $value)
			{
				$category['list'][$value['parentid']][$value['categoryid']] = $value['categoryname'];
			}
		}
		Yaf\Registry::get('memcache')->set('category', $category, MEMCACHE_NEVER_TIMEOUT);
		unset($category);
	}

}