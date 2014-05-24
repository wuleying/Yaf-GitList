<?php $this->display('layouts/header.php'); ?>

	<div class="register">
		<form class="form-signin" role="form" method="post" action="<?php echo SYSTEMURL;?>/register/account">
			<h2 class="form-signin-heading"><?php echo $title; ?></h2>
			<input type="text" name="email" class="form-control" placeholder="<?php echo Yaf\Registry::get('lang')->translate('Email');?>" required autofocus />
			<input type="password" name="password" maxlength="16" class="form-control" placeholder="<?php echo Yaf\Registry::get('lang')->translate('Password');?>" required />
			<input type="password" name="repassword" maxlength="16" class="form-control" placeholder="<?php echo Yaf\Registry::get('lang')->translate('Repeat password');?>" required />
			<button class="btn btn-lg btn-primary btn-block" type="submit"><?php echo Yaf\Registry::get('lang')->translate('Register');?></button>
		</form>
	</div>

<?php $this->display('layouts/footer.php'); ?>