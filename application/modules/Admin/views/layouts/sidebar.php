<div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
	<div class="list-group">
		<a href="<?php echo SYSTEMURL;?>/admin" class="list-group-item<?php if('index' == CONTROLLER_NAME) : ?> active<?php endif;?>">管理首页</a>
		<a href="<?php echo SYSTEMURL;?>/admin/content/index" class="list-group-item<?php if('content' == CONTROLLER_NAME) : ?> active<?php endif;?>">内容管理</a>
		<a href="<?php echo SYSTEMURL;?>/admin/category/index" class="list-group-item<?php if('category' ==CONTROLLER_NAME) : ?> active<?php endif;?>">分类管理</a>
		<a href="<?php echo SYSTEMURL;?>/admin/usergroup/index" class="list-group-item<?php if(in_array(CONTROLLER_NAME, array('usergroup', 'usergroupedit'))) : ?> active<?php endif;?>">用户组管理</a>
		<a href="<?php echo SYSTEMURL;?>/admin/user/index" class="list-group-item<?php if(in_array(CONTROLLER_NAME, array('user', 'useredit'))) : ?> active<?php endif;?>">用户管理</a>
		<a href="<?php echo SYSTEMURL;?>/admin/setting/index" class="list-group-item<?php if('setting' == CONTROLLER_NAME) : ?> active<?php endif;?>">系统设置</a>
	</div>
</div>