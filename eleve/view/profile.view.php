<?php
require "./header.php";
?>
        <div class="informations">
            <div class="avatar">
               <!--  -->
               <span class="fas fa-user"><img src="<?= $q["avatar"]??"user.svg"?>" alt="avatar"></span>
            </div>
            <nav>
                <div class="infos">Nom      : <strong><?=$q["nom_eleve"]?></strong></div>
                <div class="infos">Prenom   : <strong><?=$q["prenom_eleve"]?></strong></div>
                <div class="infos">Né(e) le : <strong><?=$q["date_naiss"]?></strong></div>
                <div class="infos">SEXE     : <strong><?= $q["sexe"]?></strong></div>
                <div class="infos">A        : <strong><?=$q["lieu_naiss"]??'N/A'?></strong></div>
                <div class="infos">Matricule: <strong><?=$q["matricule"]?></strong></div>
                <div class="infos">Classe   : <strong><?=$q["nom_classe"]?></strong></div>
            </nav>
        </div>    
    </body>
</html>