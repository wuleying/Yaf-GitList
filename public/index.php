<?php

/**
 * 入口文件
 *
 */
ini_set('display_errors', 1);
error_reporting(E_ALL ^ E_NOTICE);

// 目录分隔符
define('DS', DIRECTORY_SEPARATOR);

// 项目路径
define('APP_PATH', 'D:' . DS . 'httproot' . DS . 'gitlist');
define("PUB_PATH", APP_PATH . DS . 'public' . 'DS');

$app = new Yaf\Application(APP_PATH . '/conf/application.ini');
$app->bootstrap()->run();