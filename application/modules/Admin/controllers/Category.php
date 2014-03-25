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
	 */
	public function indexAction()
	{
		$title = '分类管理';
		$this->getView()->assign('title', $title);
		$this->getView()->assign('breadCrumb', Local\Util\Page::showBreadCrumb($title, array(), TRUE));
	}

	/**
	 * 添加/编辑分类
	 *
	 * @param integer $id
	 *
	 */
	public function handleAction($id = 0)
	{
		$id = (int) $id;

		if ($id)
		{
			$title = '编辑分类';
		}
		else
		{
			$title = '添加分类';
		}

		$this->getView()->assign('id', $id);
		$this->getView()->assign('title', $title);
		$this->getView()->assign('breadCrumb', Local\Util\Page::showBreadCrumb($title, array(), TRUE));
	}

	/**
	 * 执行添加/编辑分类
	 *
	 * @param integer $id
	 * @return boolean
	 *
	 */
	public function doAction($id = 0)
	{
		$data['categoryid'] = (int) $id;
		$data['categoryname'] = $this->getRequest()->getPost('categoryname');
		$data['parentid'] = (int) $this->getRequest()->getPost('parentid');
		$data['sort'] = (int) $this->getRequest()->getPost('sort');

		if (empty($data['categoryname']))
		{
			die('请输入分类名称');
		}

		$this->models['categoryModel']->saveData($data);
		unset($data);

		// 写入缓存
		$category = $this->models['categoryModel']->getAllCategories();
		Local\Util\Cache::setCache(CACHE_PATH . '/category.json', $category);
		unset($category);

		$this->redirect('/admin/category/index');

		return FALSE;
	}

}