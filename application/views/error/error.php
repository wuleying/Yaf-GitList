<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="description" content=""/>
<title>错误信息 - Github 优秀项目推荐</title>
<link rel="stylesheet" href="<?php echo SYSTEMURL;?>/css/bootstrap.min.css" type="text/css" media="screen,print" />
<link rel="stylesheet" href="<?php echo SYSTEMURL;?>/css/error.css" type="text/css" media="screen,print" />
<script src="<?php echo SYSTEMURL;?>/js/jquery.min.js"></script>
<script src="<?php echo SYSTEMURL;?>/js/bootstrap.min.js"></script>
</head>
<body>

	<div class="panel panel-primary error">
		<div class="panel-heading"><h3 class="panel-title">错误信息</h3></div>
		<div class="panel-body">
			<h3><?php echo $exception->getFile(); ?></h3>
			<p>第 <?php echo $exception->getLine(); ?> 行，错误号：<?php echo $exception->getCode(); ?></p>
			<p><?php echo $exception->getMessage(); ?></p>
		</div>
	</div>

</body>
</html>