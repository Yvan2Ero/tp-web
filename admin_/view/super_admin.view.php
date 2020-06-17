<?php require "./view/header.php"; ?>
<div class="menu">
  <a class="menu-item" href="./../index.php">Retour au site</a>
  <a class="menu-item" href="index.php">Enseignant??</a>
</div>
<form class="form-control">
  <h2 class="h2-title">Super administrateur du lycee</h2>
  <div class="separator"></div>
  <?if(isset($erreur)):?>
  <div class="erreur"><?= $erreur ?></div>
  <?endif;?>
  <input type="text" name="user_name" class="form form-group" value="<?=$user_name??null?>"
    placeholder="Nom d'utilisateur..."><br>
  <input type="password" name="user_password1" class="form form-group" placeholder="Premier mot de passe..."><br>
  <input type="password" name="user_password2" class="form form-group" placeholder="Deuxieme mot de pase"><br>
  <input type="submit" name="btn" value="Connecter" class="btn btn-primary"><br><br>
</form>

<?php require "./view/footer.php" ?>