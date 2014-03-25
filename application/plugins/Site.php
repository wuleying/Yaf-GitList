<?php

/**
 * 网站相关插件
 *
 * @author $Author: 5590548@qq.com $
 *
 */
class SitePlugin extends Yaf\Plugin_Abstract
{

	/**
	 * 路由结束之后触发
	 *
	 * @param Yaf\Request_Abstract $request
	 * @param Yaf\Response_Abstract $response
	 *
	 */
	public function routerShutdown(Yaf\Request_Abstract $request, Yaf\Response_Abstract $response)
	{
		// 常量
		define('MODULE_NAME', strtolower($request->getModuleName()));
		define('CONTROLLER_NAME', strtolower($request->getControllerName()));
		define('ACTION_NAME', strtolower($request->getActionName()));

		// 检查站点是否已经关闭
		if ('admin' == strtolower(MODULE_NAME))
		{
			return;
		}

		if (Yaf\Registry::get('setting')['closesite'])
		{
			if (!in_array(Yaf\Registry::get('userInfo')['usergroupid'], explode(',', Yaf\Registry::get('setting')['closesiteusergroupid'])))
			{
				$view = new Yaf\View\Simple($request);
				$view->setScriptPath(Yaf\Registry::get('config')->application->view->path);
				$view->assign('message', Yaf\Registry::get('setting')['closesitedescription']);
				$view->display('error/siteclose.php');
				exit();
			}
		}
	}

}