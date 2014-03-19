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

}