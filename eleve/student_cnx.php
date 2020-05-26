<?php 

    session_start();
    require "controler/Eleve_Cnx.class.php";

    if(!empty_in_post(['user_matricule','user_password']))
    {
        $new_eleve = new Eleve_Cnx(echaper($_POST['user_matricule']), echaper($_POST['user_password']));
        $infos = $new_eleve->verifier();
        if($infos != -1)
        {
            $_SESSION["id_student_connected"]      = $infos["id_eleve"];
            $_SESSION["name_student_connected"]    = $infos["nom_eleve"];
            $_SESSION["nickname_student_connected"]= $infos["prenom_eleve"];
            $_SESSION["student_class"]             = $infos["nom_classe"];
            header("Location:acceuil.php");
            exit();
        }
        else
        {
            $erreur = "Compte innexistant!";
        }
    }


    $titre = "Connectez-vous dans votre espace personnel pour consulter vos informatios";

    //INCLUSION DE LA VUE

    require "view/student_cnx.view.php";
?>

<?php
require "./../footer.php";
?>