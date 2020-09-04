
<h2><?= $title ?></h2>
<br><br>

<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">EXO:</th>
      <th scope="col">Cours:</th>
      <th scope="col">resolu_le</th>
      
    </tr>
  </thead>
  <tbody>
   
   <?php foreach($exos as $exo) : ?>
   
    <tr class="table-success">
      <th scope="row"><?php echo $exo['title']; ?></th>
      <td> <?php echo $exo['cours_name']; ?></td>
      <td> <?php echo $exo['created_at']; ?></td>
     
    </tr>
    
    <?php endforeach; ?>
  </tbody>
</table> 