<?php $this->display('layouts/header.php'); ?>
<form name="useredit" method="post" action="<?php echo ADMINURL;?>/user/editdo">
	<input type="hidden" name="userid" value="<?php echo $userInfo['userid'];?>" />
	<div class="table-box">
		<table class="table table-striped clearfix">
			<tbody>
				<tr>
					<td width="10%"><?php echo Yaf\Registry::get('lang')->translate('Email');?></td>
					<td><div class="col-xs-3"><?php echo $userInfo['email']; ?></div></td>
				</tr>
				<tr>
					<td><?php echo Yaf\Registry::get('lang')->translate('User group');?></td>
					<td>
						<div class="col-xs-3">
							<select name="usergroupid" class="form-control">
								<?php foreach($userGroups as $groupid => $userGroup) : ?>
									<option value="<?php echo $groupid;?>"<?php if($groupid == $userInfo['usergroupid']) : ?> selected<?php endif;?>><?php echo $userGroup['groupname'];?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</td>
				</tr>
				<tr>
					<td><?php echo Yaf\Registry::get('lang')->translate('New password');?></td>
					<td><div class="col-xs-3"><input type="text" name="password" class="form-control" maxlength="16" value="" /></div></td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="2"><input type="submit" class="btn btn-primary" value="<?php echo Yaf\Registry::get('lang')->translate('Confirm');?>" /></td>
				</tr>
			</tfoot>
		</table>
	</div>
</form>
<?php $this->display('layouts/footer.php'); ?>