<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?=$titre??null?></title>
        <link rel="stylesheet" href="./fontawesome-free-5.13.0-web/css/all.min.css">
        <link rel="stylesheet" href="css/design_eleve.css">
    </head>
    <body>
        <header>
            <div id="titre">
                <h1><marquee><?=strtoupper(convert($titre))??null?></marquee></h1>
<?if(!empty($_SESSION['id_student_connected'])):?><a href="deconnexion.php" style="color:aliceblue;">[Se déconnecter]</a><?endif;?>
            </div>
            <div id="menu">
                    <ul>
                <? if(!empty($liens)&&!empty($_SESSION['id_student_connected'])): ?>
                        <?php foreach($liens as $lien): ?>
                        <li><a href="<?=$lien.'.php'??null?>"><?=strtoupper($lien)??null ?></a></li>
                        <?php endforeach?>
                <? endif?>
                <?if(empty($_SESSION['id_student_connected'])):?>
                        <li><a href="student_cnx.php">Se connecter</a></li>
                <?endif;?>
                        <li><a href="#">Ecoles superieurs</a></li>
                        <li><a href="./../">Retour a l'aceuil</a></li>
                    </ul>
            </div>
            <div class="titre-page"></div>
        </header>
