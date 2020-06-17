<?php require "./view/header.php" ?>
<div class="menu">
  <a class="menu-item" href="./../index.php">Retour au site</a>
  <a class="menu-item" href="index.php">Enseignant??</a>
</div>
<div class="">
    <?if($type=="teacher"):?>
    <h3 style="text-align: center;">LISTE DES ENSEIGNANTS DU LYCEE</h3>
        <div class="">
            <form class="form-group">
                <input type="search" name="q" value="<?= $nom??null; ?>"  class="form form-control mb-2" placeholder="Rechercher enseignant par nom...">
                <button type="submit" class="btn search" style="width: 100px;">Rechercher</button>
                <input type="hidden" name="type" value="teacher">
            </form>
        </div>
    <table class="container-fluid" style="width: 120%;">
        <tr style>
            <th>#Id</th>
            <th>Nom</th>
            <th>Prenom</th>
            <th>email</th>
            <th>Cours enseignes</th>
        </tr>
        <?foreach($professeurs as $prof):?>
        <tr>
            <td><?=$prof["id_prof"]?></td>
            <td><?=$prof["nom_prof"]?></td>
            <td><?=$prof["prenom_prof"]?></td>
            <td><?=$prof["email_prof"]?></td>
            <td><? if(cours_of($prof["id_prof"])==""){
                    $id = $prof['id_prof'];
                    echo  "<a class='btn btn-warning btn-cours-manaage' href='cours_manage.php?id_teacher=$id'  style='text-decoration: none;background: green; color: white'>Attribuer un cours?</a>";
                }else echo cours_of($prof["id_prof"]);?>
            </td>
        </tr>
        <?endforeach;?>
    </table>
    <?else:?>
    <h3>LISTE DES ELEVES DU LYCEE</h3>
        <div class="">
            <form class="form-group">
                <input type="search" name="q" value="<?= $nom??null; ?>"  class="form form-control mb-2" placeholder="Rechercher élève par classe, nom ou prenom...">
                <button type="submit" class="btn search">Rechercher</button>
                <input type="hidden" name="type" value="student">
            </form>
        </div>
        <table class="container-fluid table">
            <thead>
                <tr>
                    <th><?= column_sortable("id_eleve", "#Id", $_GET)?></th>
                    <th><?= column_sortable("nom_eleve", "Nom", $_GET)?></th>
                    <th><?= column_sortable("prenom_eleve", "Prenom", $_GET)?></th>
                    <th><?= column_sortable("nom_classe", "Classe", $_GET)?></th>
                    <th><?= column_sortable("matricule", "Matricule", $_GET)?></th>
                </tr>
            </thead>
            <tbody>
                <?foreach($eleves as $eleve):?>
                    <tr>
                        <td><?= $eleve['id_eleve']?></td>
                        <td><?= $eleve['nom_eleve']?></td>
                        <td><?= $eleve['prenom_eleve']?></td>
                        <td><?= $eleve['nom_classe']?></td>
                        <td><?= $eleve['matricule']?></td>
                    </tr>
                <? endforeach; ?>
            </tbody>
        </table>
        <div class="container-fluid">
            <? if($nombre_de_pages>1 && $numero_page > 1): ?>
            <a href="?<?=conserve_param($_GET,"p",$numero_page-1); ?>" class="btn btn-primary pag">Page precedente</a>
            <? endif; ?>
            <? if($nombre_de_pages>1 && $numero_page< $nombre_de_pages): ?>
            <a href="?<?=conserve_param($_GET, "p",$numero_page+1); ?>" class="btn btn-primary pag">Page suivente</a>
            <? endif; ?>
        </div>
    <?endif;?>
</div>
<?php require "./view/footer.php" ?>
