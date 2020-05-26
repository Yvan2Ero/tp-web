<?php
session_start();
    require "./../ressources/fonctions.php";

    //LE TRIMESTRE PAR DEFAUT C'EST LE PREMIER
    if(empty_in_post(['trimestre'])){$_POST["trimestre"]=1;}

    //SI ON A SELECTIONNE UN CLASSE ET UN TRIMESTRE, ON SELECTIONNE TOUS LES ELEVES DE LA CLASSE
    //ET LES MATIERES
    if(!empty_in_post(["classe","trimestre"]))
    {   

        $_SESSION["eleves"] = []; //PAS D'ELEVES PAR DEFAUT
        $classe = echaper($_POST["classe"]);
        if(in_array($classe,$_SESSION['classes_enseignes']))
        {
            $q  =  getCnxEleve()->query("SELECT * FROM eleve WHERE nom_classe = '$classe'");
            $qc =  getCnxEleve()->query("SELECT * FROM cours WHERE nom_classe = '$classe'");

            //ON SAUVEGARDE LA CLASSE SELECTIONNEE
            $_SESSION['classe'] = $classe;//La classe
            $_SESSION['cours'] = $qc->fetchAll();//Les cours dispensees
            $_SESSION["eleves"] = $q->fetchAll();//Les eleves
            $trim  = (int) echaper($_POST["trimestre"]);//Le trimestre
            $_SESSION["trimestre"] = $trim;
        }
        else{
            $_SESSION["eleves"] = [];
            $erreur = "Vous n'enseignez aucun cours dans la classe choisit!";
        }
    }

    //SI ON ENREGISTRE LA NOTE DE L'ELEVE SI L'ON DISPOSE DU NECESSAIRE
    if(!empty_in_get(["id_eleve","nom_cours","note"]))
    {
        $id =(int) echaper($_GET["id_eleve"]);
        $matiere = echaper($_GET["nom_cours"]);
        $_SESSION['cours_sel'] = $matiere;
        $note =(float) str_replace(',','.',echaper($_GET["note"]));
        //SI LE PROFF ENSEIGNE LA MATIERE SELECTIONNEE
        if(prof_autorisation())
        {
            if($note>=0 && $note<=20)
            {
                $sup = getCnxEleve()->exec("DELETE FROM note WHERE id_eleve = $id AND nom_matiere = '$matiere'");
                $q = getCnxEleve()->exec("INSERT INTO note (id_eleve, nom_matiere, trimestre, valeur)
                                    VALUES ($id,'$matiere',1,$note)");
                if($q){
                    $sucess="Note enregistrée!";
                }
            }else{
                $erreur_note = "mauvaise note!'";
            }
        }
        else
        {
            $erreur_note = "Vous n'enseignez pas cette matiere!!";
        }
    }
    //PREPARATION DE LA REQUETTE QUI AFFICHE LES NOTES PRECEDENTES DES ELEVES SI ELLES EXISTENT
    //======================================================================================
    // $req_note = getCnxEleve()->prepare("SELECT valeur FROM note WHERE id_eleve = :id_eleve");
    //======================================================================================

    //INCLUSION DE LA VUE

    require "./view/admin.view.php";
?>

