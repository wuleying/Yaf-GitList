

<div>
	<h1>错误信息</h1>
	<h2><?php echo $exception->getFile(); ?> <?php echo $exception->getLine(); ?> 行，错误号：<?php echo $exception->getCode(); ?></h2>
	<p><?php echo $exception->getMessage(); ?></p>
</div>
