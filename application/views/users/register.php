<h2><?= $title; ?></h2>

<div class="alert alert-dismissible alert-danger">
<?php echo validation_errors(); ?>
</div>

<?php echo form_open('users/register'); ?>
	<div class="form-group">
      <label>Nom </label>
      <input type="text" class="form-control" name="name" placeholder="entrer votre nom ">
    </div>

    <div class="form-group">
      <label>Prenom</label>
      <input type="text" class="form-control" name="prenom" placeholder="entrer votre prenom">
    </div>

    <div class="form-group">
      <label>Nom d'utilisateur</label>
      <input type="text" class="form-control" name="username" placeholder="choisir un nom d'utilisateur">
    </div>

    <div class="form-group">
      <label>Email</label>
      <input type="email" class="form-control" name="email" placeholder="entrer votre mail">
    </div>

    <div class="form-group">
      <label>Password</label>
      <input type="password" class="form-control" name="password" placeholder="chosir un mot de passe">
    </div>

    <div class="form-group">
      <label>confirm your password</label>
      <input type="password" class="form-control" name="password2" placeholder="confirmer le mot de passe">
    </div>

    <div class="form-group">
      <label>Choisir votre role :</label>
      <br>
      <input type="radio" name="role" value= 1> prof <br>
      <input type="radio" name="role" value= 2> etudiant <br>
    </div>

	<button type="submit" class="btn btn-primary">S'incrire</button>
<?php echo form_close(); ?>