<div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
	<div class="list-group">
		<a href="<?php echo SYSTEMURL;?>/admin" class="list-group-item<?php if('index' == CONTROLLER_NAME) : ?> active<?php endif;?>"><?php echo Yaf\Registry::get('lang')->translate('Admin home');?></a>
		<a href="<?php echo SYSTEMURL;?>/admin/review/index" class="list-group-item<?php if('review' == CONTROLLER_NAME) : ?> active<?php endif;?>"><?php echo Yaf\Registry::get('lang')->translate('Review content');?></a>
		<a href="<?php echo SYSTEMURL;?>/admin/content/index" class="list-group-item<?php if('content' == CONTROLLER_NAME) : ?> active<?php endif;?>"><?php echo Yaf\Registry::get('lang')->translate('Content management');?></a>
		<a href="<?php echo SYSTEMURL;?>/admin/category/index" class="list-group-item<?php if('category' ==CONTROLLER_NAME) : ?> active<?php endif;?>"><?php echo Yaf\Registry::get('lang')->translate('Category management');?></a>
		<a href="<?php echo SYSTEMURL;?>/admin/usergroup/index" class="list-group-item<?php if(in_array(CONTROLLER_NAME, array('usergroup', 'usergroupedit'))) : ?> active<?php endif;?>"><?php echo Yaf\Registry::get('lang')->translate('User group management');?></a>
		<a href="<?php echo SYSTEMURL;?>/admin/user/index" class="list-group-item<?php if(in_array(CONTROLLER_NAME, array('user', 'useredit'))) : ?> active<?php endif;?>"><?php echo Yaf\Registry::get('lang')->translate('User management');?></a>
		<a href="<?php echo SYSTEMURL;?>/admin/setting/index" class="list-group-item<?php if('setting' == CONTROLLER_NAME) : ?> active<?php endif;?>"><?php echo Yaf\Registry::get('lang')->translate('System setting');?></a>
	</div>
</div>