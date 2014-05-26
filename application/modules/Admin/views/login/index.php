<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="description" content=""/>
<title><?php echo $title; ?> - <?php echo Yaf\Registry::get('setting')['sitedescription']; ?></title>
<link rel="stylesheet" href="<?php echo SYSTEMURL;?>/css/bootstrap.min.css" type="text/css" media="screen,print" />
<link rel="stylesheet" href="<?php echo SYSTEMURL;?>/css/admin.css" type="text/css" media="screen,print" />
<script src="<?php echo SYSTEMURL;?>/js/jquery.min.js"></script>
<script src="<?php echo SYSTEMURL;?>/js/bootstrap.min.js"></script>
</head>
<body>

	<div class="adminlogin">
		<form class="form-signin" role="form" method="post" action="<?php echo SYSTEMURL;?>/admin/login/account">
			<h2 class="form-signin-heading"><?php echo $title; ?></h2>
			<input type="text" name="email" class="form-control" placeholder="<?php echo Yaf\Registry::get('lang')->translate('Email');?>" required autofocus />
			<input type="password" name="password" maxlength="16" class="form-control" placeholder="<?php echo Yaf\Registry::get('lang')->translate('Password');?>" required />
			<button class="btn btn-lg btn-primary btn-block" type="submit"><?php echo Yaf\Registry::get('lang')->translate('Login');?></button>
		</form>
	</div>

</body>
</html>