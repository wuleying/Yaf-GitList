<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="description" content=""/>
<title><?php echo $title; ?> - <?php echo Yaf\Registry::get('setting')['sitedescription']; ?></title>
<link rel="stylesheet" href="<?php echo SYSTEMURL;?>/css/bootstrap.min.css" type="text/css" media="screen,print" />
<link rel="stylesheet" href="<?php echo SYSTEMURL;?>/css/common.css" type="text/css" media="screen,print" />
<link rel="stylesheet" href="<?php echo SYSTEMURL;?>/css/site.css" type="text/css" media="screen,print" />
<script src="<?php echo SYSTEMURL;?>/js/jquery.min.js"></script>
<script src="<?php echo SYSTEMURL;?>/js/bootstrap.min.js"></script>
</head>
<body>

<?php if(Yaf\Registry::get('setting')['closesite']) : ?>
	<div class="alert alert-warning text-center siteclosed"><strong><?php echo Yaf\Registry::get('lang')->translate('Warning');?></strong> <?php echo Yaf\Registry::get('lang')->translate('The site is closed');?></div>
<?php endif;?>

<!-- Navbar -->
<div class="navbar navbar-inverse" role="navigation">
  <div class="container">
	<div class="navbar-header">
		<a class="navbar-brand" href="<?php echo SYSTEMURL;?>">Github</a>
	</div>
	<div class="navbar-collapse collapse">
		<ul class="nav navbar-nav nav-menu">
			<li<?php if ('index' == CONTROLLER_NAME) : ?> class="active"<?php endif; ?>><a href="<?php echo SYSTEMURL;?>"><?php echo Yaf\Registry::get('lang')->translate('Home');?></a></li>
			<li<?php if ('category' == CONTROLLER_NAME) : ?> class="active"<?php endif; ?>><a href="<?php echo SYSTEMURL;?>/category"><?php echo Yaf\Registry::get('lang')->translate('Category');?></a></li>
			<li<?php if ('explore' == CONTROLLER_NAME) : ?> class="active"<?php endif; ?>><a href="<?php echo SYSTEMURL;?>/explore"><?php echo Yaf\Registry::get('lang')->translate('Explore');?></a></li>
		</ul>

		<form class="navbar-form navbar-left search-from" role="search" method="get" action="<?php echo SYSTEMURL;?>/search">
		  <div class="form-group">
			<input type="text" name="keyword" class="form-control search-input" placeholder="<?php echo Yaf\Registry::get('lang')->translate('Search the project or a project the author');?>" />
		  </div>
		  <button type="submit" class="btn btn-default"><?php echo Yaf\Registry::get('lang')->translate('Search');?></button>
		</form>

		<div class="navbar-left add-git"><a href="<?php echo SYSTEMURL;?>/add" class="btn btn-success"><?php echo Yaf\Registry::get('lang')->translate('Submit GIT');?></a></div>

		<ul class="nav navbar-nav user-information">
			<?php if(Yaf\Registry::get('userInfo')) : ?>
			  <li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" title="<?php echo Yaf\Registry::get('userInfo')['email'];?>"><?php echo Yaf\Registry::get('userInfo')['email'];?><b class="caret"></b></a>
				<ul class="dropdown-menu">
				  <li><a href="<?php echo SYSTEMURL;?>/people/<?php echo Yaf\Registry::get('userInfo')['email'];?>"><?php echo Yaf\Registry::get('lang')->translate('My home page');?></a></li>
				  <li><a href="<?php echo SYSTEMURL;?>/inbox"><?php echo Yaf\Registry::get('lang')->translate('PM');?> <span class="badge">4</span></a></li>
				  <li><a href="<?php echo SYSTEMURL;?>/settings/account"><?php echo Yaf\Registry::get('lang')->translate('Setting');?></a></li>
				  <li class="divider"></li>
				  <li><a href="<?php echo SYSTEMURL;?>/logout"><?php echo Yaf\Registry::get('lang')->translate('Logout');?></a></li>
				</ul>
			  </li>
			<?php else: ?>
				<li><a href="<?php echo SYSTEMURL;?>/register"><?php echo Yaf\Registry::get('lang')->translate('Register');?></a></li>
				<li><a href="<?php echo SYSTEMURL;?>/login"><?php echo Yaf\Registry::get('lang')->translate('Login');?></a></li>
			<?php endif; ?>
		</ul>
	</div>
  </div>
</div>
<!-- / Navbar -->