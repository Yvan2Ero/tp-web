<?php
    session_start();
    if(empty($_SESSION['user_id']))
    {header("Location:index.php");}

    require_once "./controler/Add_subject.class.php";
    //ENREGISTREMENT D'UN SUJET
    if(!empty_in_get(['subject_title','subject_content']))
    {
        $t = e($_GET['subject_title']);
        $c = e($_GET['subject_content']);
        $s = new Add_subject($t, $c, e($_GET['cat']), $_SESSION['user_pseudo']);
        if($s->verifier() && $s->sauvegarder())
        {
            header("Location:conversation.php?subject=$t");
            exit();
        }
        else
        {
            $erreur = $s->getErrors();
        }
    }elseif(isset($_GET['btn']))
    {
        $erreur = "Veillez remplir tous les champs!!";
    }
    // FIN D'ENREGISTREMENT D'UN SUJET

    $sujets = [];
    $cat = e($_GET['cat']);
    if(!in_array($cat, $_SESSION['cat']))
    {
        echo json_encode(["erreur"=>"cathegorie non existant!"]);
    }else
    {
        $q = getCnxReseau()->query("SELECT * FROM sujets_reseau
                            WHERE  	nom_categorie = '$cat'");
        $_SESSION['sujets'] = $q->fetchAll();
    }

    //on coserve la cathegorie en session(pas oblige)
    $_SESSION["actual_cat"] = $cat;
    $title = "sujets";
    require "./view/sujets.view.php";
