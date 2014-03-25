<?php $this->display('layouts/header.php'); ?>

	<div class="table-box">
		<table class="table table-striped table-bordered clearfix">
			<thead>
				<tr>
					<th width="8%">ID</th>
					<th>分类名称</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="3"><a href="<?php echo ADMINURL; ?>/category/handle" class="btn btn-primary">添加分类</a></td>
				</tr>
			</tfoot>
		</table>
	</div>
	
<?php $this->display('layouts/footer.php'); ?>