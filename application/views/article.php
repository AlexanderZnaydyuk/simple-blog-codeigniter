<?php $this->load->view('layouts/header'); ?>

<div class="row">
	<div class="col-md-9">
		<h3> <?php echo $article->title ?> <h3>
		<img src="<?php echo $article->image ?>" width="340" height="260" class="img-rounded">
		<h4> <?php echo $article->text ?><h4>
	</div>	
</div>

<div class="row">
	<div class="col-md-7">
		Posted by 
		<span style="color: #027353">
			<?php echo $article->author->name . ' ' . $article->author->surname ?>
		</span>
	</div>
	<div class="col-md-5">
		<?php echo $article->published_at ?>
	</div>
</div>

<div class="row">
	<hr>
</div>

<div ng-app="commentaries">
	<div ng-controller="CommentariesController as controller">
		<?php if ($this->auth->isLogin()): ?>
			<div class="row">
				<h2>Leave commentary: </h2>
			</div>
			<form ng-submit="controller.postComment()">

		        <div class="form-group">
		             <textarea class="form-control" rows="5" laceholder="Comment body" ng-model="controller.commentForm.text" required></textarea>
		        </div>

		        <button type="submit" class="btn btn-primary">Post</button>

		    </form>
		<?php endif; ?>

	
		<div ng-repeat="comment in controller.commentaries">

			<div class="row">
				<div class="col-md-12">
					{{ comment.text }}
				</div>
			</div>

			<div class="row">
				<div class="col-md-7">
					leave by 
					<span style="color: #027353">
						{{ comment.author.name }} {{ comment.author.surname}}
					</span>
				</div>
				<div class="col-md-5">
					{{ comment.leave_at }}
				</div>
				<hr>
			</div>

		</div>
		
	</div>
</div>

</div>

<footer class="footer">
      <div class="container">
        <p class="text-muted">Special for Netpeak by Alexander Znaydyuk 2016</p>
      </div>
</footer>

<script type="text/javascript">
	var article = "<?php echo $article->id ?>";
</script>

<script src="<?php echo base_url() ?>assets/javascripts/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/javascripts/bootstrap.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.min.js"></script>
<script src="<?php echo base_url() ?>assets/javascripts/commentaries.js"></script>

</body>
</html>