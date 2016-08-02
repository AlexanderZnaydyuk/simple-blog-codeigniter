<html>
<head>
    <title>Blog</title>
    <link href="<?php echo base_url() ?>assets/stylesheets/bootstrap.min.css" rel="stylesheet" type="text/css">
</head>
<body>

<div class="container">

 		<div style="float:left; margin-top: 10px;">
            <a href="<?php echo base_url() ?>articles">Simple blog on Codeigniter</a>
        </div>

        <div style="float:right; margin-top: 10px">
        	<?php if ($this->auth->isLogin()): ?>
	 			Hello, <a href="<?php echo base_url()?>dashboard">
	 				<?php echo $this->auth->user()->name ?>
	 				<?php echo $this->auth->user()->surname ?>
	 			</a>!
	            <a href="<?php echo base_url() ?>auth/logout">logout</a>

            <?php else: ?>
            	Hello, <span style="color: #027353">
	 				stranger
	 			</span>!
	            <a href="<?php echo base_url() ?>auth/signin">login</a> or 
	            <a href="<?php echo base_url() ?>auth/signup">register</a>
            <?php endif; ?>
        </div>

        <div style="margin-top:30px;"></div>
