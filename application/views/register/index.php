<?php $this->display('header.php'); ?>

	<div class="register">
		<form class="form-signin" role="form" method="post" action="<?php echo SYSTEMURL;?>/register/account">
			<h2 class="form-signin-heading">注册账号</h2>
			<input type="text" name="email" class="form-control" placeholder="邮箱" required autofocus />
			<input type="password" name="password" maxlength="16" class="form-control" placeholder="密码" required />
			<input type="password" name="repassword" maxlength="16" class="form-control" placeholder="重复密码" required />
			<button class="btn btn-lg btn-primary btn-block" type="submit">注册</button>
		</form>
	</div>

<?php $this->display('footer.php'); ?>