<?php $this->load->view('layouts/header'); ?>

<div class="row">
	<h2>Register in blog for posting articles !</h2>

	<div style="margin-top: 20px;">
	    <form method="POST" action="<?php echo base_url() . 'auth/signup'?>">
	        <div class="form-group">
	            <label>Name</label>
	            <input name="name" type="text" class="form-control" placeholder="Name"
	            value="<?php echo set_value('name'); ?>" required>
	        </div>

	        <div class="form-group">
	            <label>Surname</label>
	            <input name="surname" type="text" class="form-control" placeholder="Surname"
	            value="<?php echo set_value('surname'); ?>" required>
	        </div>

	        <div class="form-group">
	            <label>Email</label>
	            <input name="email" type="email" class="form-control" placeholder="Email"
	            value="<?php echo set_value('email'); ?>" required>
	        </div>


	        <div class="form-group">
	            <label>Password</label>
	            <input name="password" type="password" class="form-control" placeholder="Password" required>
	        </div>

	        <button type="submit" class="btn btn-primary">Sign up</button>
	        <a href="<?php echo base_url() ?>articles" class="btn btn-default">Back</a>

	    </form>

	    <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

	</div>
</div>

<?php $this->load->view('layouts/footer'); ?>