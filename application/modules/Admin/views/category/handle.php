<?php $this->display('layouts/header.php'); ?>
<form name="categorydo" method="post" action="<?php echo ADMINURL;?>/category/do">
	<input type="hidden" name="categoryid" value="<?php echo $categoryInfo['categoryid']; ?>" />
	<div class="table-box">
		<table class="table table-striped clearfix">
			<tbody>
				<tr>
					<td width="10%"><?php echo Yaf\Registry::get('lang')->translate('Category name');?></td>
					<td><div class="col-xs-3"><input type="text" class="form-control" maxlength="16" name="categoryname" value="<?php echo $categoryInfo['categoryname']; ?>" /></div></td>
				</tr>
				<tr>
					<td><?php echo Yaf\Registry::get('lang')->translate('Parent category');?></td>
					<td>
						<div class="col-xs-3">
							<select name="parentid" class="form-control">
								<option value="0"><?php echo Yaf\Registry::get('lang')->translate('Nothing');?></option>
								<?php echo $categoryList;?>
							</select>
						</div>
					</td>
				</tr>
				<tr>
					<td width="10%"><?php echo Yaf\Registry::get('lang')->translate('Sort');?></td>
					<td><div class="col-xs-1"><input type="text" class="form-control" maxlength="3" name="sort" value="<?php echo $categoryInfo['sort']; ?>" /></div></td>
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