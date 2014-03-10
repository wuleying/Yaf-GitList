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
	 * 注册常量
	 *
	 */
	public function _initConstant()
	{
		// 项目URL
		define('SYSTEMURL', $this->_config->application->baseUrl);

		// Cookies 超时时间
		define('COOKIE_TIMEOUT', (TIMENOW + $this->_config->cookies->timeout));

		// 默认用户组ID
		define('DEFAULT_USERGROUP_ID', $this->_config->users->default->groupid);
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

	/**
	 * 国际化
	 *
	 * @todo 额，这个后期再做吧
	 *
	 */
	public function _initTranslator()
	{
		$translator = new Zend\I18n\Translator\Translator();
		Yaf\Registry::set('translator', $translator);
	}

	/**
	 * 获取用户信息
	 *
	 */
	public function _initUserInfo()
	{
		$userModel = new UserModel();
	}

}