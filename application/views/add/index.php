<?php $this->display('layouts/header.php'); ?>

<div style="width:960px;margin:0 auto;">
	<form class="form-horizontal" role="form" name="add-git" method="post" action="<?php echo SYSTEMURL?>/add/do">
	  <div class="form-group">
		<label for="git-title" class="col-sm-2 control-label">项目名称</label>
		<div class="col-sm-10">
		  <input type="input" class="form-control" id="git-title" name="title" value="" />
		</div>
	  </div>
	  <div class="form-group">
		<label for="git-url" class="col-sm-2 control-label">项目URL</label>
		<div class="col-sm-10">
		  <input type="input" class="form-control" id="git-url" name="url" value="" />
		</div>
	  </div>

	  <div class="form-group">
		<label for="git-tags" class="col-sm-2 control-label">标签</label>
		<div class="col-sm-10">
		  <input type="input" class="form-control" id="git-tags" name="tag" value="" />
		</div>
	  </div>

	  <div class="form-group">
		<label for="git-memo" class="col-sm-2 control-label">项目描述</label>
		<div class="col-sm-10">
		   <textarea class="form-control" id="git-memo" rows="4" name="memo"></textarea>
		</div>
	  </div>

	  <div class="form-group text-center">
		  <input type="submit" class="btn btn-primary" value="提交GIT" />
	  </div>
	</form>
</div>

<?php $this->display('layouts/footer.php'); ?>