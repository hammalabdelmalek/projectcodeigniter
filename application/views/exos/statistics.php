<h2><?= $title ?></h2>
<br>

<div class="alert alert-dismissible alert-warning">
<p>number d'essey sur cette exo :<b> <?php echo $exo['nbr_essey']; ?></b></p>
</div>

<br>

<div class="alert alert-dismissible alert-success">
<p>number de reponse juste sur cette exo :<b> <?php echo $exo['nbr_juste']; ?></b></p>
</div>

<br>

<div class="alert alert-dismissible alert-info">
<p>le pourcentage de reussite est de : <b><?php echo $pourcentage;?>%</b></p>
</div>