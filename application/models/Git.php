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
	 * 获取所有项目数量，默认为已审核
	 *
	 * @param integer $approved
	 * @return integer
	 *
	 */
	public function getAllGitCount($approved = CONTENT_APPROVED)
	{
		return $this->queryOne("
			SELECT
				COUNT(*)
			FROM " . $this->q($this->table) . "
			WHERE approved = {$approved}
			AND deleted = 0
		");
	}

	/**
	 * 获取所有项目，默认为已审核
	 *
	 * @param integer $approved
	 * @param string $orderby
	 * @param integer $offset
	 * @param integer $limit
	 * @return array
	 *
	 */
	public function getAllGit($approved = CONTENT_APPROVED, $orderby = 'dateline DESC', $offset = 0, $limit = 20)
	{
		return $this->queryArray("
			SELECT
				*
			FROM " . $this->q($this->table) . "
			WHERE approved = {$approved}
			AND deleted = 0
			ORDER BY {$orderby}
			LIMIT {$offset}, {$limit}
		");
	}

	/**
	 * 审批内容
	 *
	 * @param integer $gitid
	 * @param integer $approved
	 *
	 */
	public function reviewGit($gitid, $approved = CONTENT_UNAUDITED)
	{
		$this->queryWrite("
			UPDATE " . $this->q($this->table) . " SET
				approved = {$approved}
			WHERE gitid = {$gitid}
		");
	}

}