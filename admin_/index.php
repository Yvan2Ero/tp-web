<?php
    session_start();
    require "./controler/Admin_Cnx.class.php";
    //SI ON A PASSE UN NOM D'UTILISATEUR ET UN MOT DE PASSE
    if(!empty_in_post(["admin_name","admin_password"]))
    {
        $user = e($_POST['admin_name']);
        $pwd = e($_POST['admin_password']);
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
require "./view/index.view.php";