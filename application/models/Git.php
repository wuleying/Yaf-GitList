<?php

/**
 * GIT项目模型
 *
 * @author $Author: 5590548@qq.com $
 *
 */
class GitModel extends Local\Db\Base
{

	protected $table = 'git';

	/**
	 * 获取所有项目，默认为已审核
	 *
	 * @param integer $approved
	 * @return array
	 *
	 */
	public function getAllGit($approved = 1)
	{
		return $this->queryArray("
			SELECT
				*
			FROM " . $this->q($this->table) . "
			WHERE approved = {$approved}
			AND deleted = 0
			ORDER BY dateline DESC
		");
	}
}