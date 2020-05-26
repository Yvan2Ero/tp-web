<?php
    session_start();
    require_once"./controler/Cnx.class.php";
    if(!empty_in_post(['pseudo', 'password']))
    {
        $pseudo = e($_POST['pseudo']);
        $password = e($_POST['password']);

        $nc = new Cnx($pseudo, $password);
        if($nc->session())
        {
            header("Location:acceuil.php");
            exit();
        }
        else
        {
            $erreur = "ERREUR: Compte innexistant!";
        }
    }
    elseif(isset($_POST['btn']))
    {
        $erreur = "ERREUR: veillez remplir tous les champs!";
    }
require "./view/connection.view.php";