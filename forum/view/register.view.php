<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>connection</title>
	<link rel="stylesheet" href="./../font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="./css/design.css">
</head>
<body id="cnx_body">
    <h1 class="super-chat">Super-chat+Forum</h1>
	<section id="corps">
		<div id="cnx_form_section">
            <h3>Rejoignez-nous!</h3>

                <form method="post">
                    <i class="fa fa-user"></i>
                    <input type="text" name="pseudo" id="pseudo" value="<?=$pseudo??null ?>" placeholder="Votre pseudo..." required>
                    <i class="fa fa-envelope"></i>
                    <input type="text" name="email" id="email" value="<?=$email??null ?>" placeholder="Adress email..." required>
                    <i class="fa fa-lock" id="lock-inscription"></i>
                    <input type="password" name="password" id="password"  placeholder="Mot de passe..." required>
                    <i class="fa fa-lock" id="lock-inscription-confirm"></i>
                    <input type="password" name="password2" id="password2" placeholder="Confirmer..." required>
                    <button type="submit" name="btn">S'inscrire</button>
                </form>
                <a href="connection.php">Vous avez un compte?</a>
            <div id="errors">
                <span style="margin-top: 20px;color: red" class='error'><?=$erreur??null?></span>
            </div>
            </div>
		</div>
	</section>
</body>
</html>




