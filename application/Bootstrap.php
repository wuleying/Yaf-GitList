<?php

/**
 * 引导文件
 *
 * @author $Author: 5590548@qq.com $
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
	 *
	 */
	public function _initConstant()
	{
		// 项目URL
		define('SYSTEMURL', $this->_config->application->baseUrl);
		// 管理后台URL
		define('ADMINURL', SYSTEMURL . '/admin');

		// 缓存文件保存路径
		define('CACHE_PATH', $this->_config->cache->path);

		// Cookies 超时时间
		define('COOKIE_TIMEOUT', (TIMENOW + $this->_config->cookies->timeout));

		// 默认分页数
		define('PERPAGE', $this->_config->pages->perpage);
		//define('PERPAGE', 2);

		// 用户密码长度限制
		define('USER_PASSWORD_MIN', $this->_config->users->default->minpassword);
		define('USER_PASSWORD_MAX', $this->_config->users->default->maxpassword);

		// 排序的默认值
		define('SORT_DEFAULT_VALUE', 99);

		// 内容审核状态
		define('CONTENT_UNAPPROVED', 0);
		define('CONTENT_APPROVED', 1);
		define('CONTENT_UNAUDITED', 2);

		// 用户组ID
		foreach ($this->_config->users->groupid as $groupName => $groupid)
		{
			define('USERGROUP_ID_' . strtoupper($groupName), $groupid);
		}
	}

	/**
	 * 自定义路由
	 *
	 */
	public function _initRoute(Yaf\Dispatcher $dispatcher)
	{
		$router = $dispatcher::getInstance()->getRouter();
		//\Local\Util\Debug::x(Yaf\Registry::get("config")->routes);
		$router->addConfig(Yaf\Registry::get("config")->routes);
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
	 * 初始化系统设置
	 *
	 */
	public function _initSetttings()
	{
		$settings = Local\Util\Cache::getCache(CACHE_PATH . DS . 'setting.json');
		$setting = array();
		if (!empty($settings))
		{
			foreach ($settings as $value)
			{
				$setting[$value['title']] = $value['value'];
			}
		}

		Yaf\Registry::set('setting', $setting);
		unset($settings, $setting);
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
		unset($translator);
	}

	/**
	 * 初始化插件
	 *
	 * @param Yaf_Dispatcher $dispatcher
	 */
	public function _initPlugin(Yaf\Dispatcher $dispatcher)
	{
		$site = new SitePlugin();
		$dispatcher->registerPlugin($site);
	}

	/**
	 * 获取用户信息
	 *
	 */
	public function _initUserInfo()
	{
		$userModel = new UserModel();
		$httpRequest = new Yaf\Request\Http();
		// 获取cookies
		$email = $httpRequest->getCookie('email');
		$password = $httpRequest->getCookie('password');
		$userInfo = array();

		if ($email)
		{
			// 查询用户信息
			$userInfoQuery = $userModel->getUserByEmail($email);

			if ($userInfoQuery['password'] == $password)
			{
				$userInfo = $userInfoQuery;
			}
			else
			{
				// 清除 Cookies
				Local\Header\Cookies::clearCookie('email');
				Local\Header\Cookies::clearCookie('password');
			}
			unset($userInfoQuery);
		}

		Yaf\Registry::set('userInfo', $userInfo);
		unset($userInfo);
	}

}