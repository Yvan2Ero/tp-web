<?php
    session_start();

    //UNE PRECAUTION
    if(empty($_SESSION["id_student_connected"])){header("Location:index.php");}


    $liens [] = 'requettes';
    $liens [] = 'notes';
    $liens [] = 'profile';
    $liens [] = 'informations';
    $liens [] = 'acceuil';
    $titre    = 'Notes';
    require "./../ressources/fonctions.php";
    $cnx = getCnxEleve();
    $id = $_SESSION["id_student_connected"];

    // RECHERCHE DES NOTES DISPONIBLES  DE L'ELEVE 
    $notes   = $cnx->query("SELECT * FROM note WHERE id_eleve = $id")->fetchAll();



    require "./view/notes.view.php";

    $i = 1;
?>
