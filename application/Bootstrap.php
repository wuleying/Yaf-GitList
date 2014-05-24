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
	 * 初始化错误报告
	 *
	 */
	public function _initDisplayErrors()
	{

		if ($this->_config->application->display->error)
		{
			error_reporting(-1);
			ini_set('display_errors', 1);
		}
		else
		{
			error_reporting(0);
			ini_set('display_errors', 0);
		}
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
		// 管理后台URL
		define('ADMINURL', SYSTEMURL . '/admin');

		// 缓存文件保存路径
		define('CACHE_PATH', $this->_config->filecache->path);

		// Cookies 超时时间
		define('COOKIE_TIMEOUT', (TIMENOW + $this->_config->cookies->timeout));

		// Memcache 默认超时时间
		define('MEMCACHE_TIMEOUT', $this->_config->memcache->timeout);
		// Memcache 永不超时
		define('MEMCACHE_NEVER_TIMEOUT', 0);

		// 默认分页数
		define('PERPAGE', $this->_config->pages->perpage);

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
		$routes = new Yaf\Config\Ini(APP_PATH . DS . 'conf' . DS . 'routes.ini', 'routes');
		$router->addConfig($routes->routes);
		unset($routes);
	}

	/**
	 * 初始化 Memcache
	 *
	 */
	public function _initMemcache()
	{
		$memcache = new \Local\Cache\MemcacheSimple($this->_config->memcache->toArray());
		Yaf\Registry::set('memcache', $memcache);
		unset($memcache);
	}

	/**
	 * 初始化系统设置
	 *
	 */
	public function _initSetttings()
	{
		$settingModel = new SettingModel();
		$setting = $settingModel->getAllSettingByCache();
		Yaf\Registry::set('setting', $setting);
		unset($setting);
	}

	/**
	 * 国际化
	 *
	 */
	public function _initTranslator()
	{
		$lang = new Zend\I18n\Translator\Translator();
		$lang->setLocale('zh_CN');
		$lang->addTranslationFilePattern('phparray', APP_PATH . DS . 'application' . DS . 'language', '%s.php');
		Yaf\Registry::set('lang', $lang);
		unset($lang);
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