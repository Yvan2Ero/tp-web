<?php 
    require_once "./../ressources/fonctions.php";

    if(!empty_in_get(["btn-q","q"]))
    {
        echo json_encode(["titre" => "Universite de Dschang",
                            "actualite" => "L'universsite est entrain de mettre la wireless dans tous le campus",
                            "Projets" => "L'universite de Dschang se bet pour etre le meilleur de toute l'afrique"
                            ]);
    }




?>