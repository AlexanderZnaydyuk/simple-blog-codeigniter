<?php $this->load->view('layouts/header'); ?>

<div class="row">
	<h2>Management your articles here.</h2>

	<table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Image</th>
                <th>Text</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

        <?php foreach ($articles as $article):?>

            <tr>
                <th scope="row"><?php echo $article->title ?></th>
                <td><img src="<?php echo $article->image ?>" width="200" height="200" 
                class="img-circle"></td>
                <td><?php echo $article->text ?></td>
                <td width="10%">
                    <a href="<?php echo base_url() . 'article/edit/' . $article->id ?>" 
                    class="btn btn-warning btn-sm">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </a>

                    <a href="<?php echo base_url() ?>article/delete/<?php echo $article->id ?>" 
                    class="btn btn-danger btn-sm">
                        <span class="glyphicon glyphicon-remove"></span>
                    </a>
                </td>
            </tr>

        <?php endforeach;?>

        </tbody>
    </table>
</div>

<div class="row" style="margin-bottom:10px;">
	<a href="<?php echo base_url() ?>article/new" class="btn btn-primary">Create new article</a>
</div>

<?php $this->load->view('layouts/footer'); ?>