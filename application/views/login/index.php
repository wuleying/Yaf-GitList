<?php $this->display('header.php'); ?>

	<div class="login">
		<form class="form-signin" role="form" method="post" action="<?php echo SYSTEMURL;?>/login/account">
			<h2 class="form-signin-heading"><?php echo $title; ?></h2>
			<input type="text" name="email" class="form-control" placeholder="邮箱" required autofocus />
			<input type="password" name="password" maxlength="16" class="form-control" placeholder="密码" required />
			<button class="btn btn-lg btn-primary btn-block" type="submit">登录</button>
		</form>
	</div>

<?php $this->display('footer.php'); ?>