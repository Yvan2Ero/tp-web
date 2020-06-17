
        <aside>
            
        <form action="#" id="sugestions" method="post">
            <input type="email" name="sug_email" id="" placeholder="Votre E-mail"><br>
            <textarea name="sug_msg" id="" cols="24" rows="4" placeholder="Votre sugestion!"></textarea><br>
            <button type="submit">Enoyer</button>
        </form>
        </aside>
        <section>
          <h1>Aide pour le superviseur!</h1>
          <p>
              Ce site inclut une plateforme de mise en ligne des notes et management des enseignants et
               eleves par l'administrateur qui peut etre le principale du lyccee.
          </p>
          <h3>Pour se connnecter en tanque principale</h3>
          <p>
              vous pouvez utiliser ces coordonnees pour vous connecter en tantque super administrateur du lycee
              afin d'inscrirer des enseignants oubien des eleves.
              vous pouvez ouvriri un nouvel onglet a partir d' <a href="admin_/super_admin.php">ici</a><br>
              <strong>Username:</strong>principale1
              <strong>mot de passe 1:</strong>principale1_pwd1
              <strong>Username:</strong>principale1
          </p>
          <h3>Se connecter</h3>
        </section>
<?php require "footer.php";
if(!empty($alert)){echo $alert;}
?>