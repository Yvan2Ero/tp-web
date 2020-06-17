
<?php

session_start();

if(empty($_SESSION["user_name"])){
    header("Location:index.php");
}
require_once "./../ressources/fonctions.php";
if(!empty_in_get(["type"]) && $_GET["type"] == "student")
{

    require_once "./controler/Student.class.php";

    if(!empty_in_post(["nom_eleve","prenom_eleve","date_naiss","lieu_naiss","classe","sexe"]))
    {
        $nom_eleve      = e($_POST["nom_eleve"]);
        $prenom_eleve   = e($_POST["prenom_eleve"]);
        $date_naiss     = e($_POST["date_naiss"]);
        $lieu_naiss     = e($_POST["lieu_naiss"]);
        $classe         = e($_POST["classe"]);
        $sexe           = e($_POST["sexe"]);
        $matricul       = "";
        $password       = e($_POST["password"]);

        $eleve = new Student($nom_eleve, $prenom_eleve, $date_naiss,$lieu_naiss, $classe, $password, $matricul, $sexe);

        if($eleve->verifier())
        {
            if(!$eleve->enregistrer())
            {
                $erreurS = "Erreur survenu lors de l'enregistrement de l'eleve";
            }else
            {
                $succesS = "Eleve enregistre!";
            }
        }
        else
        {
            $erreurS = $eleve->getErrors();
        }

    }
    elseif(isset($_POST["add"]))
    {
      $erreurS = "Veillez remplir tous les champs!";
    }
}elseif(!empty_in_get(["type"]) && $_GET["type"] == "teacher")
{
    require_once "./controler/Teacher.class.php";
    if(!empty_in_post(["prof_name","prof_surname","prof_emial"]))
    {
        $name       = e($_POST["prof_name"]);
        $surname    = e($_POST["prof_surname"]);
        $email      = e($_POST["prof_emial"]);
        $login      = e($_POST["prof_login"]??"");
        $password   = e($_POST["prof_password"]??"");
        $prof = new Teacher($name, $surname, $email, $login, $password);
        
        if($prof->verifier())
        {
            if($prof->sauvegarder())
            {
                $succesT = "Enseignant enregistre";
            }else
            {
                $erreurT = "Erreur lors de l'enregistrement de l'enseignant";
            }
        }else
        {
            $erreurT = $prof->getErrors();
        }
    }
    elseif(isset($_POST["add"]))
    {
        $erreurT = "Veillez entrer tous les informations!";
    }
}

    require "./view/acceuil.view.php";
