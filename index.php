<?php 
//GESTION DES SUGESTIONS
require "ressources/fonctions.php";
if(!empty_in_post(["sug_email","sug_msg"]))
{
    $email = e($_POST["sug_email"]);
    $msg = e($_POST["sug_msg"]);
    if(filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $to = MON_EMAIL;

        $headers = "MIME-Version: 1.0\r\n";
        $headers .= 'FROM:"'.$email.'"<'.$to.'>'."\n";
        $headers .= 'Content-Type:text/html; charset="utf-8"'."\n";
        $headers .= 'Content-Transfer-Encoding: 8bits';

        $obj = "A propos du site du lycee";
        $rslt = mail($to,$obj,$msg);
        if($rslt)
        {
            $alert = "<script>alert('Merci pour votre sugestion!');</script>";
        }else{
            $alert = "<script>alert('Echec d'envoi du mail');</script>";
        }
    }
}
///FIN DE LA GESTION DES SUGESTIONS



$titre = "Bienvennu sur le site du lycée";
$css = "css/design.css";
$acceuil = "#";
$about = "about.php";
$historique = "historique.php";
$reseau = "./forum";
$eleve ="./eleve/index.php";
require "header.php"; 

//INCLUSION DE LA VUE

require 'vue_generale/index.view.php';

?>