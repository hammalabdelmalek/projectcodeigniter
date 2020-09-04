
<h2><?= $title ?></h2>
<br><br>
<?php foreach($exos as $exo) : ?>
    <div class="raper">
    <h3><?php echo $exo['title']; ?></h3>
    <div class="row">

        <div class="col-md-9">
            <small class="post-date">Posté le: <?php echo $exo['created_at']; ?></small><br>
        <br><br>
        <div class="btn-group" role="group" aria-label="Basic example">

        <?php if($exo['etat']==0):?>
        <?php if($this->session->userdata('role') == 1): ?>    
        <a href="<?php echo site_url('/posts/ajouter_ligne/'.$exo['id']); ?>"><button type="button" class="btn btn-danger">completer ligne </button></a>
        <?php endif;?> 
        <?php endif;?>
       
        <?php if($this->session->userdata('role') == 2): ?>  
        <?php if($exo['etat']==1):?>
        	<a href="<?php echo site_url('/posts/resoudre/'.$exo['id']); ?>"><button type="button" class="btn btn-success">resoudre</button> </a>
        <?php endif;?>    
    	<?php endif;?>

        <?php if($exo['etat']==1):?>    
    	<?php if($this->session->userdata('role') == 1): ?>  
       
        	<a  href="<?php echo site_url('/posts/statistics/'.$exo['id']); ?>"><button type="button" class="btn btn-info">voir statistics</button></a>

    	<?php endif;?>
        <?php endif;?>

        <?php if($exo['etat']==1):?>
        <?php if($this->session->userdata('role') == 1): ?>  
       
           <a  href="<?php echo site_url('/posts/ajouter_solution/'.$exo['id']); ?>"><button type="button" class="btn btn-success">Ajouter solution</button></a>

        <?php endif;?>   
        <?php endif;?>

        </div>

        </div>
    </div>
  </div>  
<?php endforeach; ?>
<div class="pagination-links">
        <?php echo $this->pagination->create_links(); ?>
</div>