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
			<h3>Connectez-vous!</h3>
			<form id="cnx_form" method="post">
				<i class="fa fa-user"></i>
				<input type="text" name="pseudo" value="<?=$pseudo??null ?>" id="cnx_form_user" placeholder="Pseudo">
				<i class="fa fa-lock"></i>
				<input type="password" name="password" id="cnx_form_password" placeholder="Mot de passe">
				<button type="submit" name="btn" >Login</button>
			<a href="register.php">vous n'avez pas un compte?</a>
			</form>
			<div id="errors">
				<span style="margin-top: 40px;color: red" class='error'><?=$erreur??null?></span>
			</div>
		</div>
	</section>
</body>
</html>
