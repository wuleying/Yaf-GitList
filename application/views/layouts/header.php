<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="description" content=""/>
<title><?php echo $title; ?> - Github 优秀项目推荐</title>
<link rel="stylesheet" href="<?php echo SYSTEMURL;?>/css/bootstrap.min.css" type="text/css" media="screen,print" />
<link rel="stylesheet" href="<?php echo SYSTEMURL;?>/css/common.css" type="text/css" media="screen,print" />
<link rel="stylesheet" href="<?php echo SYSTEMURL;?>/css/site.css" type="text/css" media="screen,print" />
<script src="<?php echo SYSTEMURL;?>/js/jquery.min.js"></script>
<script src="<?php echo SYSTEMURL;?>/js/bootstrap.min.js"></script>
</head>
<body>

<!-- Navbar -->
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container">
	<div class="navbar-header">
		<a class="navbar-brand" href="<?php echo SYSTEMURL;?>">Github</a>
	</div>
	<div class="navbar-collapse collapse">
		<ul class="nav navbar-nav nav-menu">
			<li<?php if ('Index' == $controllerName) : ?> class="active"<?php endif; ?>><a href="<?php echo SYSTEMURL;?>">首页</a></li>
			<li<?php if ('Category' == $controllerName) : ?> class="active"<?php endif; ?>><a href="<?php echo SYSTEMURL;?>/category">分类</a></li>
			<li<?php if ('Explore' == $controllerName) : ?> class="active"<?php endif; ?>><a href="<?php echo SYSTEMURL;?>/explore">发现</a></li>
		</ul>

		<form class="navbar-form navbar-left search-from" role="search" method="get" action="<?php echo SYSTEMURL;?>/search">
		  <div class="form-group">
			<input type="text" name="keyword" class="form-control search-input" placeholder="搜索项目或项目作者" />
		  </div>
		  <button type="submit" class="btn btn-default">搜索</button>
		</form>

		<ul class="nav navbar-nav user-information">
			<?php if($this->userInfo) : ?>
			  <li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" title="<?php echo $this->userInfo['email'];?>"><?php echo $this->userInfo['email'];?><b class="caret"></b></a>
				<ul class="dropdown-menu">
				  <li><a href="<?php echo SYSTEMURL;?>/people/<?php echo $this->userInfo['email'];?>">我的主页</a></li>
				  <li><a href="<?php echo SYSTEMURL;?>/inbox">私信 <span class="badge">4</span></a></li>
				  <li><a href="<?php echo SYSTEMURL;?>/settings/account">设置</a></li>
				  <li class="divider"></li>
				  <li><a href="<?php echo SYSTEMURL;?>/logout">退出</a></li>
				</ul>
			  </li>
			<?php else: ?>
				<li><a href="<?php echo SYSTEMURL;?>/register">注册</a></li>
				<li><a href="<?php echo SYSTEMURL;?>/login">登录</a></li>
			<?php endif; ?>
		</ul>
	</div>
  </div>
</div>
<!-- / Navbar -->