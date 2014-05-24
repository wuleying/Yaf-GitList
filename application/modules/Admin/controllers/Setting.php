<?php

/**
 * 系统设置控制器
 *
 * @author $Author: 5590548@qq.com $
 *
 */
class SettingController extends Local\Controller\Base
{

	public function init()
	{
		// 加载模型
		$this->models = array(
			'userModel' => new UserModel,
			'settingModel' => new SettingModel()
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
	 * 首页
	 *
	 */
	public function indexAction()
	{
		// 获取系统设置
		$setting = $this->models['settingModel']->getAllSetting();
		$this->getView()->assign('settings', $setting);

		$title = Yaf\Registry::get('lang')->translate('System setting');
		$this->getView()->assign('title', $title);
		$this->getView()->assign('breadCrumb', Local\Util\Page::dispayBreadCrumb($title, array(), TRUE));
	}

	/**
	 * 编辑系统设置
	 *
	 * @return boolean
	 *
	 */
	public function editAction()
	{
		$settings = $this->getRequest()->getPost('settings');

		if (!empty($settings))
		{
			foreach ($settings as $settingid => $setting)
			{
				$settingData = array(
					'settingid' => $settingid,
					'value' => $setting['value'],
					'sort' => $setting['sort']
				);

				// 更新数据
				$this->models['settingModel']->saveData($settingData);
				unset($settingData);
			}
		}

		// 更新缓存
		$setting = $this->models['settingModel']->getAllSetting();
		Yaf\Registry::get('memcache')->set('setting', $setting, MEMCACHE_NEVER_TIMEOUT);

		$this->redirect('/admin/setting/index');
		return FALSE;
	}

}