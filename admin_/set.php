<?php 

    require_once "./../ressources/fonctions.php";

    $type = "student";
    if(!empty($_GET["type"]))
    {
        $type   = $_GET["type"];
    }
    if($type=="teacher")
    {
        $requette = "SELECT * FROM professeur ";

        $requette_compte    = "SELECT COUNT(id_prof) as count FROM professeur ";

        $param = [];
        if(!empty_in_get(["q"]))
        {
            $nom    = e($_GET['q']);

            $requette .= "WHERE nom_prof LIKE :nom OR prenom_prof LIKE :nom ";

            $requette_compte .= "WHERE nom_prof LIKE :nom OR prenom_prof LIKE :nom ";

            $param["nom"] = $nom."%";
        }
        $qs = getCnxEleve()->prepare($requette);

        $qs->execute($param);

        $professeurs = $qs->fetchAll();
    }
    else{
        define("MAX_PAR_PAGE", 10);
        $requette_eleve = "SELECT * FROM eleve ";

        $requette_compte_eleve = "SELECT COUNT(id_eleve) AS count FROM eleve ";
        $param  = [];
        if(!empty_in_get(['q']))
        {
            $nom    = e($_GET['q']);
            $cdt = "WHERE nom_classe LIKE :nom 
            OR nom_eleve LIKE :nom 
            OR prenom_eleve LIKE :nom ";

            $requette_eleve .= $cdt;
            $requette_compte_eleve  .= $cdt;
            $param["nom"]    = $nom."%";
        }
        //pagination
        $numero_page =  (int) ($_GET['p'] ?? 1);

        $saut_de_page = (int) ($numero_page - 1)*MAX_PAR_PAGE;

        //organisation
        $triables   = ["nom_eleve", "prenom_eleve", "nom_classe", "matricule"];
        if(!empty_in_get(["trie"]) && in_array($_GET["trie"], $triables))
        {
            $colone_de_trie = $_GET["trie"];
            $direction      = $_GET["direction"] ?? "ASC";
            if(!in_array($direction, ["ASC","DESC", "asc", "desc"]))
            {
                $direction  = "ASC";
            }
            $requette_eleve .= "ORDER BY ".e($colone_de_trie)." ".$direction;
        }

        $requette_eleve  .= " LIMIT ".MAX_PAR_PAGE." OFFSET ". $saut_de_page;

        $q          = getCnxEleve()->prepare($requette_eleve);
        $q_compte   = getCnxEleve()->prepare($requette_compte_eleve);


        $q->execute($param);
        $q_compte->execute($param);

        $total  =(int) $q_compte->fetch()["count"];

        $eleves = $q->fetchAll();

        $nombre_de_pages = ceil($total/ MAX_PAR_PAGE);
    }
    require "./view/set.view.php";