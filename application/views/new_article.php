<?php $this->load->view('layouts/header'); ?>

<div class="row">
	<h2>Create new article</h2>

	<div style="margin-top: 20px;">
	    <form method="POST" enctype="multipart/form-data" action="<?php echo base_url() . 'article/new'?>">

	        <div class="form-group">
	            <label>Title</label>
	            <input name="title" type="text" class="form-control" placeholder="Title" 
	            	value="" required>
	        </div>

	        <div class="form-group">
	            <label>Text</label>
	             <textarea class="form-control" rows="5" name="text" placeholder="Description" required></textarea>
	        </div>

	        <div class="form-group">
	            <label>Image</label>
	            <input name="image" type="file" required>
	        </div>

	        <button type="submit" class="btn btn-primary">Create</button>
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