
<div class="row mt-5">
    <div class="col-md-6 m-auto">
      <div class="card card-body">
        <h1 class="text-center mb-3"> Mon profile </h1>

<?php if($this->session->userdata('role') == 1): ?>  
<div class="card text-white bg-warning mb-3" >
  <div class="card-header" align="center">EXERCICE</div>
  <div class="card-body">
      <li class="list-group-item">
        <a  href="<?php echo base_url(); ?>posts/exos_noncomplet">exos à completé<span class="sr-only">(current)</span></a>
      </li>
  </div>
</div>
<?php endif ; ?>        

<?php if($this->session->userdata('role') == 1): ?>  
<div class="card text-white bg-success mb-3" >
  <div class="card-header" align="center">Cours</div>
  <div class="card-body">
	<li class="list-group-item">
      <a  href="<?php echo base_url(); ?>posts/create">Ajouter cours<span class="sr-only">(current)</span></a>
    </li>

    <li class="list-group-item">
    	<a href="<?php echo base_url(); ?>posts/prof_cours/<?php echo $this->session->userdata('user_id'); ?>"> mes cours</a>
    </li>	
 </div>
</div>
<?php endif ; ?>


<?php if($this->session->userdata('role') == 2): ?>  
<div class="card text-white bg-warning mb-3" >
  <div class="card-header" align="center">EXERCICE</div>
  <div class="card-body">
      <li class="list-group-item">
        <a  href="<?php echo base_url(); ?>posts/mes_resolu">exos_resolu<span class="sr-only">(current)</span></a>
      </li>
  </div>
</div>
<?php endif ; ?>

<?php if($this->session->userdata('role') == 2): ?>  
<div class="card text-white bg-success mb-3" >
  <div class="card-header" align="center">inscription</div>
  <div class="card-body">
  <li class="list-group-item">
      <a  href="<?php echo base_url(); ?>posts">cours<span class="sr-only">(current)</span></a>
    </li>

    <li class="list-group-item">
      <a href="<?php echo base_url(); ?>posts/mescours/<?php echo $this->session->userdata('user_id'); ?>"> mes cours</a>
    </li> 
 </div>
</div>
<?php endif ; ?>

<div class="card text-white bg-info mb-3" >
  <div class="card-header" align="center">Mon compte</div>
  <div class="card-body">
    <li class="list-group-item">
     <a href="<?php echo base_url(); ?>users/edit_password"> Mod de passe</a>
    </li>

    <li class="list-group-item">
   	 <a href="<?php echo base_url(); ?>users/logout"> Deconnexion </a>
    </li>

  </div>
</div>
</div>
</div>
</div>
