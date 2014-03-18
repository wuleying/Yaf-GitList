<?php $this->display('layouts/adminheader.php'); ?>

	<div class="table-box">
		<table class="table table-striped table-bordered clearfix">
			<thead>
				<tr>
					<th width="8%">ID</th>
					<th>邮箱</th>
					<th width="20%">用户组</th>
					<th width="15%">注册时间</th>
					<th width="15%">最后登录时间</th>
					<th width="8%">操作</th>
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
							<a href="<?php echo ADMINURL?>/useredit/id/<?php echo $user['userid']; ?>">编辑</a>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	
	<div class="pagenav">
		<?php echo $pageNav;?>
	</div>

<?php $this->display('layouts/adminfooter.php'); ?>