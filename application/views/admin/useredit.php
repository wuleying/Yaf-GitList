<?php $this->display('layouts/adminheader.php'); ?>

<form name="useredit" method="post" action="<?php echo ADMINURL;?>/usereditdo">
	<input type="hidden" name="userid" value="<?php echo $userInfo['userid'];?>" />
	<div class="table-box">
		<table class="table table-striped clearfix">
			<tbody>
				<tr>
					<td width="10%">邮箱</td>
					<td><?php echo $userInfo['email']; ?></td>
				</tr>
				<tr>
					<td>用户组</td>
					<td>
						<select name="usergroupid">
							<?php foreach($userGroups as $groupid => $userGroup) : ?>
								<option value="<?php echo $groupid;?>"<?php if($groupid == $userInfo['usergroupid']) : ?> selected<?php endif;?>><?php echo $userGroup['groupname'];?></option>
							<?php endforeach; ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>新密码</td>
					<td><input type="text" name="password" class="form-control" maxlength="16" value="" /></td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="2"><input type="submit" class="btn btn-success" value="确定" /></td>
				</tr>
			</tfoot>
		</table>
	</div>
</form>
<?php $this->display('layouts/adminfooter.php'); ?>