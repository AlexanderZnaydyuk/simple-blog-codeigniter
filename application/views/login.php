<?php $this->load->view('layouts/header'); ?>

<div class="row">
	<h2>Login</h2>

	<div style="margin-top: 20px;">
	    <form method="POST" action="<?php echo base_url() . 'auth/signin'?>">

	        <div class="form-group">
	            <label>Email</label>
	            <input name="email" type="email" class="form-control" placeholder="Email" 
	            	value="<?php echo set_value('email'); ?>" required>
	        </div>

	        <div class="form-group">
	            <label>Password</label>
	            <input name="password" type="password" class="form-control" placeholder="Password"
	            required>
	        </div>

	        <button type="submit" class="btn btn-primary">Sign in</button>
	        <a href="<?php echo base_url() ?>articles" class="btn btn-default">Back</a>

	    </form>

	    <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

        <?php if ($this->session->flashdata('error')): ?>

        	<div class="alert alert-danger">
        		<p>Login or password incorrect.</p>
        	</div>

        <?php endif; ?>

	</div>
</div>

<?php $this->load->view('layouts/footer'); ?>