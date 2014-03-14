<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="description" content=""/>
<title><?php echo $title; ?> - Github 优秀项目推荐</title>
<link rel="stylesheet" href="<?php echo SYSTEMURL;?>/css/bootstrap.min.css" type="text/css" media="screen,print" />
<link rel="stylesheet" href="<?php echo SYSTEMURL;?>/css/admin.css" type="text/css" media="screen,print" />
<script src="<?php echo SYSTEMURL;?>/js/jquery.min.js"></script>
<script src="<?php echo SYSTEMURL;?>/js/bootstrap.min.js"></script>
</head>
<body>

<!-- Navbar -->
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container">
	<div class="navbar-collapse collapse">
	  <ul class="nav navbar-nav nav-menu">
		<li<?php if('index' == $actionName) : ?> class="active"<?php endif;?>><a href="<?php echo SYSTEMURL;?>/admin">管理首页</a></li>
		<li<?php if('content' == $actionName) : ?> class="active"<?php endif;?>><a href="<?php echo SYSTEMURL;?>/admin/content">内容管理</a></li>
		<li<?php if('user' == $actionName) : ?> class="active"<?php endif;?>><a href="<?php echo SYSTEMURL;?>/admin/user">用户管理</a></li>
		<li<?php if('setting' == $actionName) : ?> class="active"<?php endif;?>><a href="<?php echo SYSTEMURL;?>/admin/setting">系统设置</a></li>
	  </ul>
	  <ul class="nav navbar-nav navbar-right">
		<li><p class="navbar-text navbar-right">您好，<a href="#" class="navbar-link"><?php echo $adminInfo['email'];?></a></p></li>
		<li><a href="<?php echo SYSTEMURL;?>">站点首页</a></li>
		<li><a href="<?php echo SYSTEMURL;?>/admin/logout">退出</a></li>
	  </ul>

	</div>
  </div>
</div>
<!-- / Navbar -->