<h2><?= $title ?></h2>

<div class="alert alert-dismissible alert-danger">
<?php echo validation_errors(); ?>
</div>

<?php echo form_open('posts/nbrligne/'.$id); ?>

	<div class="form-group">
      <label>Titre</label>
      <input type="text" class="form-control" name="titre" placeholder="Donné un titre a l'exo">
    </div>

    <div class="form-group">
      <label>Enoncé</label>
      <input type="text" class="form-control" name="enonce" placeholder="Donné l'enonce de l'exo">
    </div>

    <button type="submit" class="btn btn-primary">Valider</button>

</form>    