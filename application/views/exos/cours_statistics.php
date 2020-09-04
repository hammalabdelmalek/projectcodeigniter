	<style> 
		#liste {
		  padding: 50px;
		  text-align: center;
		  background-color: #e5eecc;
		  border: solid 1px #c3c3c3;
		  display: none;
		}
	</style>

<h2><?= $title ?></h2>

<br>

<div class="alert alert-dismissible alert-danger">
<p>number d'exercice non encore resolu egale a :<b> <?php echo $exo_nonresolu; ?></b></p>
</div>

<br>

<div class="alert alert-dismissible alert-warning">
<p>number d'essey sur ce cours :<b> <?php echo $nbr_essey; ?></b></p>
</div>

<br>

<div class="alert alert-dismissible alert-success">
<p>number de reponse juste sur ce cours :<b> <?php echo $nbr_juste; ?></b></p>
</div>

<br>

<div class="alert alert-dismissible alert-info">
<p>le pourcentage de reussite est de : <b><?php echo $pourcentage;?>%</b></p>
</div>

<br><br>
<div id="about" class="alert alert-dismissible alert-info">
	<h2>Appuyer pour la liste des etudiant qui on travailler sur les exos de ce cours  :</h2> 
</div>	

<div id="liste">
	
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">NOM:</th>
      <th scope="col">PRENOM:</th>
   
      
    </tr>
  </thead>
  <tbody>
   
   <?php foreach($liste_etu as $key) : ?>
   
    <tr class="table-success">
      <th scope="row"><?php echo $key['nom']; ?></th>
      <td> <?php echo $key['prenom']; ?></td>    
     
    </tr>
    
    <?php endforeach; ?>
  </tbody>
</table> 
</div>

<script>
	$(document).ready(function(){
		$("#about").click(function(){
		$("#liste").slideToggle("slow");
 	 });
	});
</script>