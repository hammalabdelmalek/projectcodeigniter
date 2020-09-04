<html>
<head>
	<title>EXOGOOD</title>
	<link rel="stylesheet" href="https://bootswatch.com/4/journal/bootstrap.min.css">   
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <script src="http://cdn.ckeditor.com/4.11.4/standard/ckeditor.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</head>	



<body>

	<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
	  <a class="navbar-brand" href="<?php echo base_url(); ?>posts">EXOGOOD</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarColor01">
	    <ul class="navbar-nav mr-auto">

	      <?php if(!$this->session->userdata('logged_in')): ?>			

		      <li class="nav-item active">
		        <a class="nav-link" href="<?php echo base_url(); ?>users/login">connect <span class="sr-only">(current)</span></a>
		      </li>

	      <?php endif;?>
	      

	      <?php if(!$this->session->userdata('logged_in')): ?>

	      <li class="nav-item">
	        <a class="nav-link" href="<?php echo base_url(); ?>users/register">s'inscrire</a>
	      </li>

	      <?php endif;?>

	      <?php if($this->session->userdata('logged_in')): ?>

	      <li class="nav-item active">
          <a class="nav-link" href="<?php echo base_url(); ?>users/profile"> Mon profil <span class="sr-only">(current)</span></a>
          </li>

	      <li class="nav-item">
	        <a class="nav-link" href="<?php echo base_url(); ?>users/logout">deconnect</a>
	      </li>
	  	  <?php endif;?>
	    </ul>
	    
	    <?php echo form_open('posts/stitle'); ?>
	      <div class="btn-group" role="group">
	        <input class="form-control" type="text" name="keyword"  placeholder="mots clés">
	        <button class="btn btn-secondary my-2 my-sm-0" type="submit">Recherche</button>
	      </div>  
	    <?php echo form_close(); ?>


	  </div>
	</nav>

	<div class="container"> 
       <!--Flash messages  -->

        <?php if($this->session->flashdata('user_password')): ?>
        <?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_password').'</p>'; ?>
        <?php endif; ?>

       <?php if($this->session->flashdata('user_registered')): ?>
        <?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_registered').'</p>'; ?>
        <?php endif; ?>

        <?php if($this->session->flashdata('login_failed')): ?>
        <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('login_failed').'</p>'; ?>
        <?php endif; ?>               

        <?php if($this->session->flashdata('user_loggedin')): ?>
        <?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_loggedin').'</p>'; ?>
        <?php endif; ?>                    

        <?php if($this->session->flashdata('user_loggedout')): ?>
        <?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_loggedout').'</p>'; ?>
        <?php endif; ?>       

        <?php if($this->session->flashdata('post_created')): ?>
        <?php echo '<p class="alert alert-success">'.$this->session->flashdata('post_created').'</p>'; ?>
        <?php endif; ?>

        <?php if($this->session->flashdata('inscrit')): ?>
        <?php echo '<p class="alert alert-success">'.$this->session->flashdata('inscrit').'</p>'; ?>
        <?php endif; ?>

        <?php if($this->session->flashdata('check_inscription')): ?>
        <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('check_inscription').'</p>'; ?>
        <?php endif; ?>    

        <?php if($this->session->flashdata('creer_exo')): ?>
        <?php echo '<p class="alert alert-success">'.$this->session->flashdata('creer_exo').'</p>'; ?>
        <?php endif; ?>      

        <?php if($this->session->flashdata('exo_created')): ?>
        <?php echo '<p class="alert alert-success">'.$this->session->flashdata('exo_created').'</p>'; ?>
        <?php endif; ?>

        <?php if($this->session->flashdata('exo_juste')): ?>
        <?php echo '<p class="alert alert-success">'.$this->session->flashdata('exo_juste').'</p>'; ?>
        <?php endif; ?>

        <?php if($this->session->flashdata('exo_faut')): ?>
        <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('exo_faut').'</p>'; ?>
        <?php endif; ?>

        <?php if($this->session->flashdata('exo_dejaresolu')): ?>
        <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('exo_dejaresolu').'</p>'; ?>
        <?php endif; ?>

        <?php if($this->session->flashdata('ligne_deleted')): ?>
        <?php echo '<p class="alert alert-success">'.$this->session->flashdata('ligne_deleted').'</p>'; ?>
        <?php endif; ?>        
