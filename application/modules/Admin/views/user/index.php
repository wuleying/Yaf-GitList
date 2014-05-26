<?php $this->display('layouts/header.php'); ?>

	<div class="table-box">
		<table class="table table-striped table-bordered clearfix">
			<thead>
				<tr>
					<th width="8%">ID</th>
					<th><?php echo Yaf\Registry::get('lang')->translate('Email');?></th>
					<th width="20%"><?php echo Yaf\Registry::get('lang')->translate('User group');?></th>
					<th width="15%"><?php echo Yaf\Registry::get('lang')->translate('Registration time');?></th>
					<th width="15%"><?php echo Yaf\Registry::get('lang')->translate('Last login time');?></th>
					<th width="70"><?php echo Yaf\Registry::get('lang')->translate('Operation');?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($users as $user) : ?>
					<tr>
						<td><?php echo $user['userid'];?></td>
						<td><a href="<?php echo SYSTEMURL?>/people/<?php echo $user['email'];?>" target="_blank"><?php echo $user['email'];?></a></td>
						<td><?php echo $userGroups[$user['usergroupid']]['groupname'];?></td>
						<td><?php echo Local\Util\Time::formatDate($user['registrattime']);?></td>
						<td><?php echo Local\Util\Time::formatDate($user['lasttime']);?></td>
						<td>
							<a href="<?php echo ADMINURL?>/user/edit/id/<?php echo $user['userid']; ?>" class="btn btn-success"><?php echo Yaf\Registry::get('lang')->translate('Edit');?></a>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	
	<div class="pagenav">
		<?php echo $pageNav;?>
	</div>

<?php $this->display('layouts/footer.php'); ?>