
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <title>Admin</title>
</head>
<body class="container">
    <h1>Espace reservé aux enseignants</h1>
    <div class="contener" style="margin-left: auto; margin-right:auto;">
<?if(!empty($erreur)):?><div class="alert alert-danger"><?=$erreur?></div><?endif;?>
        <form method="POST">
            <input type="text" class="form-group" name="admin_name" id="admin_name" required placeholder="Nom d'utilisateur"><br>
            <input type="password" class="form-group" name="admin_password" id="admin_password" required placeholder="Mot de passe"><br>
            <input type="submit" class="btn btn-primary" value="Se connecter">
        </form>
    </div><br>
    <a href="super_admin.php">Super administrateur???</a>
</body>
</html>
