<?php

/**
 * 系统设置模型
 *
 * @author $Author: 5590548@qq.com $
 *
 */
class SettingModel extends Local\Db\Base
{

	protected $table = 'setting';

	/**
	 * 获取所有系统设置数据
	 *
	 * @return array
	 *
	 */
	public function getAllSetting()
	{
		return $this->queryArray("
			SELECT
				*
			FROM " . $this->q($this->table) . "
			ORDER BY sort ASC
		");
	}

	/**
	 * 从 Memcache 中获取系统设置数据
	 *
	 * @return array
	 *
	 */
	public function getAllSettingByCache()
	{
		$settings = Yaf\Registry::get('memcache')->get('setting');
		if (empty($settings))
		{
			Yaf\Registry::get('memcache')->set('setting', $this->getAllSetting(), MEMCACHE_NEVER_TIMEOUT);
			$settings = Yaf\Registry::get('memcache')->get('setting');
		}

		$setting = array();
		if (!empty($settings))
		{
			foreach ($settings as $value)
			{
				$setting[$value['title']] = $value['value'];
			}
		}

		unset($settings);
		return $setting;
	}

}