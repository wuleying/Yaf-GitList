<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="description" content=""/>
<title><?php echo $title; ?> - <?php echo Yaf\Registry::get('setting')['sitedescription']; ?></title>
<link rel="stylesheet" href="<?php echo SYSTEMURL;?>/css/bootstrap.min.css" type="text/css" media="screen,print" />
<link rel="stylesheet" href="<?php echo SYSTEMURL;?>/css/common.css" type="text/css" media="screen,print" />
<link rel="stylesheet" href="<?php echo SYSTEMURL;?>/css/admin.css" type="text/css" media="screen,print" />
<script src="<?php echo SYSTEMURL;?>/js/jquery.min.js"></script>
<script src="<?php echo SYSTEMURL;?>/js/bootstrap.min.js"></script>
</head>
<body>

<?php if(Yaf\Registry::get('setting')['closesite']) : ?>
	<div class="alert alert-warning text-center siteclosed"><strong><?php echo Yaf\Registry::get('lang')->translate('Warning');?></strong> <?php echo Yaf\Registry::get('lang')->translate('The site is closed');?></div>
<?php endif;?>

<!-- Navbar -->
<div class="navbar navbar-default" role="navigation">
	<div class="navbar-collapse collapse">
		<a href="<?php echo SYSTEMURL;?>" class="navbar-brand"">Github</a>
		<ul class="nav navbar-nav navbar-right">
			<li><p class="navbar-text navbar-right"><?php echo Yaf\Registry::get('lang')->translate('Hello');?>，<a href="#" class="navbar-link"><?php echo $adminInfo['email'];?></a></p></li>
			<li><a href="<?php echo SYSTEMURL;?>" target="_blank"><?php echo Yaf\Registry::get('lang')->translate('Website home');?></a></li>
			<li><a href="<?php echo SYSTEMURL;?>/admin/logout/index"><?php echo Yaf\Registry::get('lang')->translate('Logout');?></a></li>
		</ul>
	</div>
</div>
<!-- / Navbar -->

<div class="adminmain">

	<?php $this->display('layouts/sidebar.php')?>

	<div class="rightbox">
		<div class="rightmain panel panel-default">
			<ol class="breadcrumb"><?php echo $breadCrumb;?></ol>