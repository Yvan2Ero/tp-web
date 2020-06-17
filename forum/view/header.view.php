<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?=$title?></title>
    <link rel="stylesheet" href="./css/design.css">
    <link rel="stylesheet" href="./../font-awesome-4.7.0/css/font-awesome.min.css">
</head>
<body>
    <header>
        <div id="menu">
        <?if(empty($_SESSION["user_id"])):?>
            <div class="elt_menu"><a href="connection.php">Connection</a></div>
            <div class="elt_menu"><a href="register.php">Inscription</a></div>
        <?else:?>
            <div class="elt_menu"><a href="acceuil.php">Acceui du Forum</a></div>
            <div class="elt_menu"><a href="profile.php">Profile</a></div>
        <?endif;?>
            <div class="elt_menu"><a href="./../">Retour au site</a></div>
        </div>
        <div class="title">
            <h3>SUPER-CHAT+FORUM</h3>
            <?if(!empty($_SESSION["user_id"])):?>
                <a href="deconnexion.php">se deconnecter</a>
            <?endif;?>
        </div>
        <div class="navigation">
            <h4>
                <?if(!empty($_SESSION["user_pseudo"]))echo"[ ".$_SESSION['user_pseudo' ]."]﻿►";?>
                <?if(!empty($_SESSION["actual_cat"]) || !empty($_POST["cat"]))echo"[ ".$_SESSION['actual_cat']."]﻿►"?>
                <?if(!empty($_SESSION["actual_subject"]))echo"[ ".$_SESSION['actual_subject' ]."]﻿►"?>
            </h4>
        </div>
    </header> 
