<?php
require "./header.php";
?>
<div class="tableau-notes">

    <?if(!empty($notes)):?>
        <table>
            <tr>
                <th>Matieres</th>
                <th>Enseignants</th>
                <th>Trimestre</th>
                <th>Vleur de la note</th>
            </tr>
        <?foreach($notes as $note): ?>
            <tr class="<?php if($i%2==0){ echo 'tab-ligne1'; $i ++;} else echo 'tab-ligne2'; $i++;?>">
                <td><?= $note['nom_matiere']?></td>
                <td><?=get_teacher($note['nom_matiere'],  $_SESSION['student_class'])?></td>
                <td><?=$note['trimestre']?></td>
                <td><?= $note['valeur']??'Non defini'?></td>
            </tr>
        <?endforeach ?>
        </table>
        <? else: ?>
            <h3 style="text-align:center;">Vous n'avez pas de notes disponibles pour le moment!</h3>
            <p style="text-align: center">Au cas d'un soucis, vous pouvez contacter l'administration <a href="#">ici</a>.</p>
    <? endif?>
</div>