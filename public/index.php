<?php

/**
 * 入口文件
 *
 * @author $Author: 5590548@qq.com $
 *
 */
// 当前时间
define('TIMENOW', $_SERVER['REQUEST_TIME']);
// 目录分隔符
define('DS', DIRECTORY_SEPARATOR);

// 项目路径
define('APP_PATH', 'D:' . DS . 'httproot' . DS . 'gitlist');
define('PUB_PATH', APP_PATH . DS . 'public' . 'DS');

$app = new Yaf\Application(APP_PATH . DS . 'conf' . DS . 'application.ini');
$app->bootstrap()->run();