<?php $this->display('layouts/header.php'); ?>

	<div class="table-box">
		<table class="table table-striped table-bordered clearfix">
			<thead>
				<tr>
					<th width="8%">ID</th>
					<th><?php echo Yaf\Registry::get('lang')->translate('Category name');?></th>
					<th width="10%"><?php echo Yaf\Registry::get('lang')->translate('Sort');?></th>
					<th width="140"><?php echo Yaf\Registry::get('lang')->translate('Operation');?></th>
				</tr>
			</thead>
			<tbody>
				<?php if($categories) : ?>
					<?php foreach($categories as $category) : ?>
						<tr>
							<td class="text-center"><?php echo $category['categoryid']; ?></td>
							<td><a href="<?php echo ADMINURL;?>/category/index/parentid/<?php echo $category['categoryid']; ?>"><?php echo $category['categoryname']; ?></a></td>
							<td><?php echo $category['sort']; ?></td>
							<td>
								<a href="<?php echo ADMINURL;?>/category/handle/id/<?php echo $category['categoryid']; ?>" class="btn btn-success"><?php echo Yaf\Registry::get('lang')->translate('Edit');?></a>
								<a href="<?php echo ADMINURL;?>/category/delete/id/<?php echo $category['categoryid']; ?>" class="btn btn-danger"><?php echo Yaf\Registry::get('lang')->translate('Delete');?></a>
							</td>
						</tr>
					<?php endforeach; ?>
				<?php else: ?>
					<td colspan="4" class="text-center"><?php echo Yaf\Registry::get('lang')->translate('No data');?></td>
				<?php endif; ?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="4"><a href="<?php echo ADMINURL; ?>/category/handle/id/0/parentid/<?php echo $parentid; ?>" class="btn btn-primary"><?php echo Yaf\Registry::get('lang')->translate('Add category');?></a></td>
				</tr>
			</tfoot>
		</table>
	</div>
	
<?php $this->display('layouts/footer.php'); ?>