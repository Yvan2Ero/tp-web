<?php
    session_start();
    require "./controler/Admin_Cnx.class.php";
    //SI ON A PASSE UN NOM D'UTILISATEUR ET UN MOT DE PASSE
    if(!empty_in_post(["admin_name","admin_password"]))
    {
        $user = echaper($_POST['admin_name']);
        $pwd = echaper($_POST['admin_password']);
        $infos = new Admin_Cnx($user, $pwd);
        $infos = $infos->getInfos();

        if($infos)
        {
            //SI LE COMPTE EXISTE
            //ON ENREGISTRE SES INFORMATIONS ET LES CLASSES OU IL ENSEIGNE
            $_SESSION["id_admin"] = $id = $infos['id_prof'];
            $_SESSION["user_name"] = $infos['prof_login'];
            
            $cours = getCnxEleve()->query("SELECT * FROM cours WHERE id_prof = $id")->fetchAll();
            $_SESSION['cours_enseignes'] = $cous;
            //ENREGISTREMENT DES CLASSES
            $_SESSION['classes_enseignes'][] = [];
            foreach($cours as $cour)
            {
                $_SESSION['classes_enseignes'][] = $cour['nom_classe'];
            }
            header("Location: admin.php");
        }
        else{
            $erreur = "Compte innexistant!";
        }
        
    }

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <title>Admin</title>
</head>
<body>
    <h1>Connectez vous!</h1>
    <div class="contener" style="margin-left: auto; margin-right:auto;">
        <span style="color: red"><?=$erreur??null?></span>
        <form method="POST">
            <input type="text" class="form-group" name="admin_name" id="admin_name" required placeholder="Nom d'utilisateur"><br>
            <input type="password" class="form-group" name="admin_password" id="admin_password" required placeholder="Mot de passe"><br>
            <input type="submit" class="btn btn-primary" value="Se connecter">
        </form>
    </div>
</body>
</html>