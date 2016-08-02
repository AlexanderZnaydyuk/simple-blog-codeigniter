<?php $this->load->view('layouts/header'); ?>

<div class="row">
	<h2>Update article</h2>

	<div style="margin-top: 20px;">
	    <form method="POST" enctype="multipart/form-data" action="<?php echo base_url() . 'article/edit/' . $article->id?>">

	        <div class="form-group">
	            <label>Title</label>
	            <input name="title" type="text" class="form-control" placeholder="Title" 
	            	value="<?php echo $article->title ?>" required>
	        </div>

	        <div class="form-group">
	            <label>Text</label>
	             <textarea class="form-control" rows="5" name="text" placeholder="Description" required><?php echo $article->text ?></textarea>
	        </div>

	        <div class="form-group">
	            <img src="<?php echo $article->image ?>" width="200" height="200">
	        </div>

	        <div class="form-group">
	            <label>Image</label>
	            <input name="image" type="file">
	        </div>
	        <input type="hidden" name="oldImage" value="<?php echo $article->image ?>">
	        <button type="submit" class="btn btn-primary">Update</button>
	        <a href="<?php echo base_url() ?>dashboard" class="btn btn-default">Back</a>

	    </form>

	    <?php if (isset($error)): ?>
	    	<div class="alert alert-danger">
	    	<?php echo $error ?>
	    	</div>
	    <?php endif; ?>

	    <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

	</div>
</div>

<?php $this->load->view('layouts/footer'); ?>