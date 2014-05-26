<?php $this->display('layouts/header.php'); ?>

	<div class="table-box">
		<table class="table table-striped table-bordered clearfix">
			<thead>
				<tr>
					<th width="15%">ID</th>
					<th><?php echo Yaf\Registry::get('lang')->translate('User group');?></th>
					<th width="70"><?php echo Yaf\Registry::get('lang')->translate('Operation');?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($userGroups as $userGroup) : ?>
					<tr>
						<td><?php echo $userGroup['usergroupid'];?></td>
						<td><?php echo $userGroup['groupname'];?></td>
						<td>
							<a href="<?php echo ADMINURL?>/usergroup/edit/id/<?php echo $userGroup['usergroupid']; ?>" class="btn btn-success"><?php echo Yaf\Registry::get('lang')->translate('Edit');?></a>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>

<?php $this->display('layouts/footer.php'); ?>