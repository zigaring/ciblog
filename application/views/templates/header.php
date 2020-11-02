	<html>

<head>
    <link rel="stylesheet" href="https://bootswatch.com/4/flatly/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
</head>
<body>
		<nav class="navbar navbar-inverse">
			<div class="container" style="background-color: lightblue">
				<div class="navbar-header">
					<a class="navbar-brand" href="<?php echo base_url();?>">ciBlog</a>
					<a class="navbar-brand" href="<?php echo base_url();?>">Home</a>
					<a class="navbar-brand" href="<?php echo base_url();?>about">About</a>
					<a class="navbar-brand" href="<?php echo base_url();?>posts">Blog</a>
					<a class="navbar-brand" href="<?php echo base_url();?>categories">Categories</a>
				</div>
				<div id="navbar">
					<?php if(!$this->session->userdata('logged_in')): ?>
						<a class="navbar-brand" href="<?php echo base_url();?>users/login">Login</a>
						<a class="navbar-brand" href="<?php echo base_url();?>users/register">Register</a>
					<?php endif; ?>
					<?php if($this->session->userdata('logged_in')): ?>
						<a class="navbar-brand" href="<?php echo base_url();?>posts/create">Create Post</a>
						<a class="navbar-brand" href="<?php echo base_url();?>categories/create">Create Category</a>
						<a class="navbar-brand" href="<?php echo base_url();?>users/logout">Logout</a>
					<?php endif; ?>
				</div>
			</div>
		</nav>


		<div class="container"> 

		<!--Flash message -->
		<?php if($this->session->flashdata('user_registered')): ?>
			<?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_registered').'</p>'; ?>
		<?php endif; ?>	

		<?php if($this->session->flashdata('post_created')): ?>
			<?php echo '<p class="alert alert-success">'.$this->session->flashdata('post_created').'</p>'; ?>
		<?php endif; ?>	

		<?php if($this->session->flashdata('post_updated')): ?>
			<?php echo '<p class="alert alert-success">'.$this->session->flashdata('post_updated').'</p>'; ?>
		<?php endif; ?>	

		<?php if($this->session->flashdata('post_deleted')): ?>
			<?php echo '<p class="alert alert-success">'.$this->session->flashdata('post_deleted').'</p>'; ?>
		<?php endif; ?>	

		<?php if($this->session->flashdata('category_created')): ?>
			<?php echo '<p class="alert alert-success">'.$this->session->flashdata('category_created').'</p>'; ?>
		<?php endif; ?>	

		<?php if($this->session->flashdata('user_loggedin')): ?>
			<?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_loggedin').'</p>'; ?>
		<?php endif; ?>	

		<?php if($this->session->flashdata('login_failed')): ?>
			<?php echo '<p class="alert alert-danger">'.$this->session->flashdata('login_failed').'</p>'; ?>  
		<?php endif; ?>

		<?php if($this->session->flashdata('user_loggedout')): ?>
			<?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_loggedout').'</p>'; ?>
		<?php endif; ?>

		<?php if($this->session->flashdata('category_deleted')): ?>
			<?php echo '<p class="alert alert-success">'.$this->session->flashdata('category_deleted').'</p>'; ?>
		<?php endif; ?>


		<!--alert success=greed / alert-danger=red -->
