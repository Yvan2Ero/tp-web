<?php

    require_once "./../ressources/fonctions.php";
    if(!empty_in_get(["type"]) && $_GET["type"]=="student")
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
            $password       = "";

            $eleve = new Student($nom_eleve, $prenom_eleve, $date_naiss,$lieu_naiss, $classe, $password, $matricul, $sexe);

            if($eleve->verifier())
            {
                if(!$eleve->enregistrer())
                {
                    $erreur = "Erreur survenu lors de l'enregistrement de l'eleve";
                }
            }
            else
            {
                $erreur = $eleve->getErrors();
            }

        }
    }elseif(!empty_in_get(["type"]) && $_GET["type"] == "teacher")
    {
        require_once "./controler/Teacher.class.php";
        if(!empty_in_post(["prof_name","prof_surname","prof_emial"]))
        {
            $name       = e($_POST["prof_name"]);
            $surname    = e($_POST["prof_surname"]);
            $email      = e($_POST["prof_emial"]);

            $prof = new Teacher($name, $surname, $email);
            
            if($prof->verifier())
            {
                if($prof->sauvegarder())
                {
                    $succes = "Enseignant enregistre";
                }else
                {
                    $erreur = "Erreur lors de l'enregistrement de l'enseignant";
                }
            }else
            {
                $erreur = $prof->getErrors();
            }
        }
        elseif(isset($_POST["btn"]))
        {
            $erreur = "Veillez entrer tous les informations!";
        }
    }