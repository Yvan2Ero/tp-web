<?php 
    session_start();
    require_once "./controler/Register.class.php";

    if(!empty_in_post(["pseudo","email", "password", "password2"]))
    {
        $pseudo = e($_POST['pseudo']);
        $email  = e($_POST['email']);
        $pwd    = e($_POST["password"]);
        $pwd2   = e($_POST["password2"]);
        $ins = new Register($pseudo, $email, $pwd, $pwd2);
        if($ins->verify())
        {
            if($ins->sesseion())
            {
                header("Location:acceuil.php");
                exit();
            }
        }
        else{
            $erreur = $ins->getErrors();
            }
    }elseif(isset($_POST["btn"]))
    {
        $erreur = "Veillez remplir tous les champs";
    }

    $title = "Inscription";
require "./view/register.view.php";


?>