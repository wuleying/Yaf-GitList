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
<div class="navbar navbar-default" role="navigation">
	<div class="navbar-collapse collapse">
		<a href="<?php echo SYSTEMURL;?>" class="navbar-brand"">Github</a>
		<ul class="nav navbar-nav navbar-right">
			<li><p class="navbar-text navbar-right">您好，<a href="#" class="navbar-link"><?php echo $adminInfo['email'];?></a></p></li>
			<li><a href="<?php echo SYSTEMURL;?>" target="_blank">站点首页</a></li>
			<li><a href="<?php echo SYSTEMURL;?>/admin/logout">退出</a></li>
		</ul>
	</div>
</div>
<!-- / Navbar -->

<div class="adminmain">

	<div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
		<div class="list-group">
			<a href="<?php echo SYSTEMURL;?>/admin" class="list-group-item<?php if('index' == $actionName) : ?> active<?php endif;?>">管理首页</a>
			<a href="<?php echo SYSTEMURL;?>/admin/content" class="list-group-item<?php if('content' == $actionName) : ?> active<?php endif;?>">内容管理</a>
			<a href="<?php echo SYSTEMURL;?>/admin/usergroup" class="list-group-item<?php if('usergroup' == $actionName) : ?> active<?php endif;?>">用户组管理</a>
			<a href="<?php echo SYSTEMURL;?>/admin/user" class="list-group-item<?php if('user' == $actionName) : ?> active<?php endif;?>">用户管理</a>
			<a href="<?php echo SYSTEMURL;?>/admin/setting" class="list-group-item<?php if('setting' == $actionName) : ?> active<?php endif;?>">系统设置</a>
		</div>
	</div>

	<div class="rightbox">
		<div class="rightmain panel panel-default">
			<ol class="breadcrumb"><?php echo $breadCrumb;?></ol>