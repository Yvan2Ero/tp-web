<?php
    session_start();

    if(empty($_SESSION["user_name"])){
        header("Location:index.php");
    }

    require_once "./../ressources/fonctions.php";

    $qc = getCnxEleve()->prepare("SELECT * FROM cours ORDER BY nom_classe");

    $qc->execute();
    $tab_cours = $qc->fetchAll();
    $qc->closeCursor();


    $id = $_GET['id_teacher'];

    if(!empty_in_post(["attribuer"]) && !empty_in_get(["id_teacher"]) && !empty($_POST["cours"]))
    {
        $f = true;
        foreach($_POST["cours"] as $cours)
        {
            $composee   = explode("_",$cours);
            $classe     = $composee[0];
            $nom_cours  = $composee[1];
            $f  = $f && setProf_of_cours($nom_cours, $classe, $_GET["id_teacher"]);
           
        }
        if($f)
        {
            $statut = "Modifications effectués aveec succès";
        }else
        {
            $statut = "Echec";
        }
        header("Location:acceuil.php?statut=$statut");
        exit();
    }
    
 require "./view/cours_manage.view.php" ?>