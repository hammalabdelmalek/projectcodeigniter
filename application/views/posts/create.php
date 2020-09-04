<h2><?= $title ?></h2>

<div class="alert alert-dismissible alert-danger">
<?php echo validation_errors(); ?>
</div>

<?php echo form_open('posts/create'); ?>

	<div class="form-group">
      <label>Titre</label>
      <input type="text" class="form-control" name="title" placeholder="Ajouter titre">
    </div>

    <div class="form-group">
      <label>Filiers</label>
      <input type="text" class="form-control" name="filiers" placeholder="donner la filiers">
    </div>

    <div class="form-group">
      <label>Description</label>
      <textarea id="editor1" class="form-control" name="body" rows="3"></textarea>
    </div>


    <button type="submit" class="btn btn-primary">Valider</button>

</form>    