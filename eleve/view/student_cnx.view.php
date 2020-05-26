
    <?require "./header.php";?>
<p style="text-align:center"><span style="color:red;text-align: center;"><?=!empty($erreur)?$erreur:null;?></span></p>
    <div id="cnx_form_section">
        <form method="post">
            <input type="text" name="user_matricule" id="cnx_form_user" value="<?=$_POST['user_matricule']??get_ses('user_matricule')??null?>" placeholder="Votre matricule"><br>
            <input type="password" name="user_password" id="cnx_form_password" placeholder="Votre mot de passe"><br>
            <button type="submit" >Login</button>
        </form>
        <p>
            <a href="set_password.php">Mot de passe oublié?<a>
        </p>
    </div>