<?php
    session_start();
    require "./../ressources/fonctions.php";
    $cnx = getCnxEleve();
    $id = $_SESSION['id_student_connected'];
    $q = $cnx->query("SELECT * FROM eleve WHERE id_eleve = $id");
    $q = $q->fetch();

    $liens [] = 'requettes';
    $liens [] = 'notes';
    $liens [] = 'profile';
    $liens [] = 'informations';
    $liens [] = 'acceuil';
    $titre    = 'votre profile';

    //INCLUSION DE LA VUE
    require "view/profile.view.php";
?>