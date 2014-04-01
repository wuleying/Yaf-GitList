<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="description" content=""/>
<title>出错了 - Github 优秀项目推荐</title>
<link rel="stylesheet" href="<?php echo SYSTEMURL;?>/css/bootstrap.min.css" type="text/css" media="screen,print" />
<link rel="stylesheet" href="<?php echo SYSTEMURL;?>/css/error.css" type="text/css" media="screen,print" />
<script src="<?php echo SYSTEMURL;?>/js/jquery.min.js"></script>
<script src="<?php echo SYSTEMURL;?>/js/bootstrap.min.js"></script>
</head>
<body>

	<div class="panel panel-warning error">
		<div class="panel-heading"><h3 class="panel-title">出错了!</h3></div>
		<div class="panel-body">
			<h3>
			<?php echo $message; ?>，<span id="redirecttime"><?php echo $time;?></span> 秒后返回，或
			<a href="<?php echo $url;?>">点击这里</a>
			</h3>
		</div>
	</div>

<?php if($time > -1) : ?>
	<script type="text/javascript">
	var i = <?php echo $time;?>;
	var timer = null;
	var redirecttime = document.getElementById('redirecttime');
	var timer = setInterval(function(){
		i--;
		redirecttime.innerHTML = i;
		if(i == 0)
		{
			location.href = "<?php echo $url;?>";
			clearInterval(timer);
		}
	},1000);
	</script>
<?php endif; ?>
</body>
</html>