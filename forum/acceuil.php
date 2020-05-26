<?php
session_start();
    if(empty($_SESSION['user_id']))
    {header("Location:index.php");}

    require_once "./function/functions.php";
    $cat = bdd()->query("SELECT * FROM categorie_resau");
    if($cat)
    {
        $_SESSION['cat'] = [];
        while($l = $cat->fetch())
        {
            $_SESSION['cat'][] = "".$l['categorie_nom'];
        }
    }

    $title = "Acceuil";


    require "./view/acceuil.view.php";
?>
