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

<?php if ($this->auth->isLogin()): ?>
	<div class="row">
		<h2>Leave commentary: </h2>
	</div>
	<form method="POST" action="<?php echo base_url() ?>comment">

        <div class="form-group">
             <textarea class="form-control" rows="5" name="text" placeholder="Comment body" required></textarea>
        </div>

        <input type="hidden" name="article" value="<?php echo $article->id ?>">

        <button type="submit" class="btn btn-primary">Post</button>

    </form>
<?php endif; ?>

<?php foreach ($article->commentaries as $commentary):?>
	<div class="row">
		<div class="col-md-12">
			<?php echo $commentary->text ?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-7">
			leave by 
			<span style="color: #027353">
				<?php echo $commentary->author->name . ' ' . $commentary->author->surname ?>
			</span>
		</div>
		<div class="col-md-5">
			<?php echo $commentary->leave_at ?>
		</div>
		<hr>
	</div>
	
<?php endforeach;?>

<?php $this->load->view('layouts/footer'); ?>