<?php

/**
 * 引导文件
 *
 */
class Bootstrap extends Yaf\Bootstrap_Abstract
{

	private $_config;

	/**
	 * 初始化配置项
	 *
	 */
	public function _initConfig()
	{
		$this->_config = Yaf\Application::app()->getConfig();
		Yaf\Registry::set('config', $this->_config);
	}

	/**
	 * 初始化命名空间，以 Zend, Local 开头的类为本地类
	 *
	 */
	public function _initNamespaces()
	{
		Yaf\Loader::getInstance()->registerLocalNameSpace(array(
			'Zend',
			'Local'
		));
	}

	/**
	 * 连接数据库，设置数据库适配器
	 *
	 */
	public function _initDefaultDbAdapter()
	{
		$db = new Zend\Db\Adapter\Adapter(
				$this->_config->database->params->toArray()
		);

		Yaf\Registry::set('db', $db);
	}

}