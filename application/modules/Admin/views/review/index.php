<?php $this->display('layouts/header.php'); ?>

	<div class="table-box">
		<table class="table table-striped table-bordered clearfix">
			<thead>
				<tr>
					<th width="8%">ID</th>
					<th><?php echo Yaf\Registry::get('lang')->translate('Project name');?></th>
					<th width="15%"><?php echo Yaf\Registry::get('lang')->translate('Submitter Name');?></th>
					<th width="15%"><?php echo Yaf\Registry::get('lang')->translate('Submission time');?></th>
					<th width="130"><?php echo Yaf\Registry::get('lang')->translate('Operation');?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($gits as $git) : ?>
					<tr>
						<td><?php echo $git['gitid'];?></td>
						<td><a href=""><?php echo $git['title'];?></a></td>
						<td><a href=""><?php echo $git['userid'];?></a></td>
						<td><?php echo Local\Util\Time::formatDate($git['dateline']);?></td>
						<td>
							<a href="<?php echo ADMINURL?>/review/do/id/<?php echo $git['gitid']; ?>/approved/<?php echo CONTENT_APPROVED;?>" class="btn btn-success"><?php echo Yaf\Registry::get('lang')->translate('Through');?></a>
							<a href="<?php echo ADMINURL?>/review/do/id/<?php echo $git['gitid']; ?>/approved/<?php echo CONTENT_UNAUDITED;?>" class="btn btn-danger"><?php echo Yaf\Registry::get('lang')->translate('Refuse');?></a>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>

		</table>
	</div>
	
	<div class="pagenav">
		<?php echo $pageNav;?>
	</div>

<?php $this->display('layouts/footer.php'); ?>