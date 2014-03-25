<?php $this->display('layouts/header.php'); ?>

	<div class="table-box">
		<table class="table table-striped table-bordered clearfix">
			<thead>
				<tr>
					<th width="15%">ID</th>
					<th>用户组</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($userGroups as $userGroup) : ?>
					<tr>
						<td><?php echo $userGroup['usergroupid'];?></td>
						<td><?php echo $userGroup['groupname'];?></td>
						<td>
							<a href="<?php echo ADMINURL?>/usergroup/edit/id/<?php echo $userGroup['usergroupid']; ?>">编辑</a>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>

<?php $this->display('layouts/footer.php'); ?>