<?php $this->display('layouts/header.php'); ?>

	<div class="login">
		<form class="form-signin" role="form" method="post" action="<?php echo SYSTEMURL;?>/login/account">
			<h2 class="form-signin-heading"><?php echo $title; ?></h2>
			<input type="text" name="email" class="form-control" placeholder="<?php echo Yaf\Registry::get('lang')->translate('Email');?>" required autofocus />
			<input type="password" name="password" maxlength="16" class="form-control" placeholder="<?php echo Yaf\Registry::get('lang')->translate('Password');?>" required />
			<button class="btn btn-lg btn-primary btn-block" type="submit"><?php echo Yaf\Registry::get('lang')->translate('Login');?></button>
		</form>
	</div>

<?php $this->display('layouts/footer.php'); ?>