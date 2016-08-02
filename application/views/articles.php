<?php $this->load->view('layouts/header'); ?>

<?php foreach ($articles as $article):?>

	<div class="row">
  		<div class="col-md-9">
  			<h3> 
          <a href="<?php echo base_url() . 'article/' . $article->id ?>">
          <?php echo $article->title ?></a> 
        <h3>
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

<?php endforeach;?>

<ul class="pagination pagination-lg">
	<?php echo $links  ?>
</ul>

<?php $this->load->view('layouts/footer'); ?>