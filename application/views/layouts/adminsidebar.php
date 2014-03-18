<div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
	<div class="list-group">
		<a href="<?php echo SYSTEMURL;?>/admin" class="list-group-item<?php if('index' == $actionName) : ?> active<?php endif;?>">管理首页</a>
		<a href="<?php echo SYSTEMURL;?>/admin/content" class="list-group-item<?php if('content' == $actionName) : ?> active<?php endif;?>">内容管理</a>
		<a href="<?php echo SYSTEMURL;?>/admin/usergroup" class="list-group-item<?php if(in_array($actionName, array('usergroup', 'usergroupedit'))) : ?> active<?php endif;?>">用户组管理</a>
		<a href="<?php echo SYSTEMURL;?>/admin/user" class="list-group-item<?php if(in_array($actionName, array('user', 'useredit'))) : ?> active<?php endif;?>">用户管理</a>
		<a href="<?php echo SYSTEMURL;?>/admin/setting" class="list-group-item<?php if('setting' == $actionName) : ?> active<?php endif;?>">系统设置</a>
	</div>
</div>