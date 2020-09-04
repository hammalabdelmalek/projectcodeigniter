<h2><?= $title; ?></h2>

<div class="alert alert-dismissible alert-danger">
<?php echo validation_errors(); ?>
</div>

<?php echo form_open('users/edit_password'); ?>

    <div class="form-group">
      <label> Nouveau mot de passe</label>
      <input type="password" class="form-control" name="password" placeholder="choisir un mot de passe">
    </div>

    <div class="form-group">
      <label>Confirmer votre mot de passe</label>
      <input type="password" class="form-control" name="password2" placeholder="confirmer le mot de passe">
    </div>

	<button type="submit" class="btn btn-primary">Valider</button>
<?php echo form_close(); ?>