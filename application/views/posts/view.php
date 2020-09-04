<style> 
		#body {
		  padding: 30px;
		  background-color: #e5eecc;
		  border: solid 1px #c3c3c3;
		 
		}
</style>		
<h2><?php echo $post['title']; ?></h2>
 <small class="post-date">posté le: <?php echo $post['created_at']; ?> par <?php echo $post['user_name']; ?> </small>

 <div id="body" class="post-body">
     <?php echo $post['body'] ; ?>
 </div>

 <br><br>

 <?php if($this->session->userdata('logged_in')):?>
 <?php if($this->session->userdata('role')==2): ?>
 <div class="btn-group" role="group" >
	<a class="btn btn-danger" href="<?php echo base_url(); ?>posts/inscrit/<?php echo $post['id']; ?>">je m'inscrit</a> 
</div>
<?php endif; ?>
<?php endif; ?>

 <?php if($this->session->userdata('logged_in')):?>
 <?php if($this->session->userdata('user_id')==$post['user_id']): ?>
 <div class="btn-group" role="group" >
	<a class="btn btn-danger" href="<?php echo base_url(); ?>posts/nbrligne/<?php echo $post['id']; ?>">Ajouter exo</a> 
</div>
<?php endif; ?>
<?php endif; ?>