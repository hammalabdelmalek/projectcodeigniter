
<?php echo form_open('users/login'); ?>
   
   <div class="row mt-5">
    <div class="col-md-6 m-auto">
      <div class="card card-body">
        <h1 class="text-center mb-3"> <?php echo $title; ?> </h1>


	
			<div class="form-group">
				<input type="text" name="username" class="form-control" placeholder="Enter Username" required autofocus>
			</div>

			<div class="form-group">
				<input type="password" name="password" class="form-control" placeholder="Enter Password" required autofocus>
			</div>
			
			<button type="submit" class="btn btn-primary btn-block">Connecté</button>
			<a class="nav-link" href="<?php echo base_url(); ?>users/register"><p class="text-center text-danger">S'incrire</p><span class="sr-only">(current)</span></a>
		</div>
		
	</div>
 </div>
 	

<?php echo form_close(); ?>