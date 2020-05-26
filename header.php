<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title><?= $titre?></title>
        <link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">
        <link rel="stylesheet" type="text/css" href="./font-awesome-4.7.0/css/font-awesome.css">
        <link rel="stylesheet" href=<?= $css; ?>>
    </head>
    <body>
        <header>
            <div id="menu">
                <ul>
                    <li><a href="#contact">CONTACTEZ-NOUS</a></li>
                    <li><a href=<?= $about; ?>>A PROPOS</a></li>
                    <li><a href=<?= $reseau; ?>>RESEAU SOCIAL</a></li>
                    <li><a href=<?= $eleve; ?>>JE SUIS ELEVE</a></li>
                    <li><a href=<?= $acceuil; ?>>ACCEUIL</a></li>
                </ul>
                <div class="clear"></div>
              <div class="search-section">
                <form id="search-form" action="./ressources/search.php" method="get">
                  <input type="search" id="q" name="q" value="" placeholder="Rechercher un ecole">
                  <input type="submit" name="btn-q" value="Go">
                </form>
              </div><br>
            </div>
            <div id="titre">
              <h2>
                <?= strtoupper(str_replace('é','e',$titre)); ?>
              </h2>
            </div>
        </header>
