<?php
  session_start();
  if(empty($_SESSION["id_student_connected"])){header("Location:index.php");}


    $liens [] = 'requettes';
    $liens [] = 'notes';
    $liens [] = 'profile';
    $liens [] = 'informations';
    $liens [] = 'acceuil';
    $titre    = 'bienvenu dans votre espace personnel';

    require_once "./../ressources/fonctions.php";
    require "view/acceuil.view.php";

?>
