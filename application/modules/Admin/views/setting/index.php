<?php $this->display('layouts/header.php'); ?>

	<form name="settingedit" method="post" action="<?php echo ADMINURL;?>/setting/edit">
		<div class="table-box">
			<table class="table table-striped table-bordered clearfix">
				<thead>
					<tr>
						<th width="15%"><?php echo Yaf\Registry::get('lang')->translate('Parameter name');?></th>
						<th width="28%"><?php echo Yaf\Registry::get('lang')->translate('Parameter explanation');?></th>
						<th><?php echo Yaf\Registry::get('lang')->translate('Parameter value');?></th>
						<th width="5%"><?php echo Yaf\Registry::get('lang')->translate('Sort');?></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($settings as $setting) : ?>
						<tr>
							<td><?php echo $setting['title'];?></td>
							<td><?php echo $setting['description'];?></td>
							<td><?php echo  Local\Util\Page::displayFormElement("settings[{$setting['settingid']}][value]", $setting['value'], $setting['type']); ?></td>
							<td><input type="text" class="form-control text-center" maxlength="3" name="settings[<?php echo $setting['settingid'];?>][sort]" value="<?php echo $setting['sort'];?>"></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="4"><input type="submit" class="btn btn-primary" value="<?php echo Yaf\Registry::get('lang')->translate('Confirm');?>" /></td>
					</tr>
				</tfoot>
			</table>
		</div>
	</form>

<?php $this->display('layouts/footer.php'); ?>