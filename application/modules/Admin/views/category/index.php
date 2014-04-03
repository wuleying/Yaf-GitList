<?php $this->display('layouts/header.php'); ?>

	<div class="table-box">
		<table class="table table-striped table-bordered clearfix">
			<thead>
				<tr>
					<th width="8%">ID</th>
					<th>分类名称</th>
					<th width="10%">排序</th>
					<th width="130">操作</th>
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
								<a href="<?php echo ADMINURL;?>/category/handle/id/<?php echo $category['categoryid']; ?>" class="btn btn-success">编辑</a>
								<a href="<?php echo ADMINURL;?>/category/delete/id/<?php echo $category['categoryid']; ?>" class="btn btn-danger">删除</a>
							</td>
						</tr>
					<?php endforeach; ?>
				<?php else: ?>
					<td colspan="4" class="text-center">无数据</td>
				<?php endif; ?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="4"><a href="<?php echo ADMINURL; ?>/category/handle/id/0/parentid/<?php echo $parentid; ?>" class="btn btn-primary">添加分类</a></td>
				</tr>
			</tfoot>
		</table>
	</div>
	
<?php $this->display('layouts/footer.php'); ?>