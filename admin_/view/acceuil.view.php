<?php
require "./view/header.php";
?>
<div class="menu">
    <a class="menu-item" href="./../index.php">Retour au site</a>
    <a class="menu-item" href="index.php">Enseignant??</a>
    <a class="menu-item" href="set.php?type=teacher">Liste des enseignants</a>
    <a class="menu-item" href="set.php?type=student">Liste des eleves</a>
</div>
<div class="container">
    <h1 style="text-align: center;">Bienvenu</h1>
    <button type="button" name="button-add_prof" id="button-add_prof" class="btn btn-primary">Nouveau enseignant?</button>
    <button type="button" name="button-add_stuent" id="button-add_stuent" class="btn btn-primary">Nouvel eleve?</button>
</div>
<input type="hidden" id="section" value="<?=$_GET["type"]??null?>">
<section class="container-fluid" id="section" style="margin-top: 20px">

    <div id="add_prof_section" class="row">
        <div class="col-md-6 col-sm-12  col-lg-6" style="margin-top: 10px">
            <form action="acceuil.php?type=teacher" method="post" class="form-control" id="form_add_prof">
                <h3>Ajouter un enseignant</h3>
            <?if(!empty($erreurT)):?><div class="alert alert-danger" style="width: 405px;"><?=$erreurT?></div><?endif;?>
            <?if(!empty($succesT)):?><div class="alert alert-success" style="width: 405px;"><?=$succesT?></div><?endif;?>
            <?if(!empty($_GET["statut"])):?><div class="alert alert-success" style="width: 405px;"><?=$_GET["statut"]?></div><?endif;?>
                <input type="text" name="prof_name" id="prof_name" class="form form-group" value="<?=$name??null?>" placeholder="Nom..."><br>
                <input type="text" name="prof_surname" id="prof_surname" class="form form-group" value="<?=$surname??null?>" placeholder="Prenom..."><br>
                <input type="email" name="prof_emial" id="prof_emial" class="form form-group" value="<?=$email??null?>" placeholder="E-mail..."><br>
                <input type="text" name="prof_login" id="prof_login" class="form form-group" value="<?=$login??null?>" placeholder="Nom d'utilisateur..."><br>
                <input type="password" name="prof_password" id="prof_password" class="form form-group" placeholder="Mot de passe..."><br>
                <input type="submit" name="add" class="btn btn-secondary" value="Ajouter"><br>
            </form>
        </div>       
    </div>
    <div class="" style="margin-top: 10px" id="add_student_section">
        <form action="acceuil.php?type=student" method="post" class="form-control" id="form_add_prof"><br>
        <h3>Ajouter un eleve</h3>
        <?if(!empty($erreurS)):?><div class="alert alert-danger" style="width: 405px;"><?=$erreurS?></div><?endif;?>
        <?if(!empty($succesS)):?><div class="alert alert-success" style="width: 405px;"><?=$succesS?></div><?endif;?>
            <input type="text" name="nom_eleve" id="nom_eleve" class="form form-group" value="<?=$nom_eleve??null?>" placeholder="Nom..."><br>
            <input type="text" name="prenom_eleve" id="prenom_eleve" class="form form-group" value="<?=$prenom_eleve??null?>" placeholder="Prenom..."><br>
            <input type="date" name="date_naiss" id="date_naiss" class="form form-group"><br>
            <input type="text" name="lieu_naiss" id="lieu_naiss" class="form form-group" value="<?=$lieu_naiss??null?>" placeholder="Lieu de naissance..."><br>
            <input type="password" name="password" id="password" class="form form-group" placeholder="Mot de passe..."><br>
            <label for="classe">Classe:</label><br>
            <select name="classe" id="classe" class="form custom-select" style="width: 215px"><br>
                        <option value="6eme"l <?php if(isset($_SESSION['classe'])&& $_SESSION['classe']=="6eme")echo "selected='selected'"; ?>>6eme</option>
                        <option value="5eme" <?php if(isset($_SESSION['classe'])&& $_SESSION['classe']=="5eme")echo "selected='selected'"; ?>>5eme</option>
                        <option value="4eme All" <?php if(isset($_SESSION['classe'])&& $_SESSION['classe']=="4eme All")echo "selected='selected'"; ?>">4eme All</option>
                        <option value="4eme Esp" <?php if(isset($_SESSION['classe'])&& $_SESSION['classe']=="4eme Esp")echo "selected='selected'"; ?>>4eme Esp</option>
                        <option value="3eme All" <?php if(isset($_SESSION['classe'])&& $_SESSION['classe']=="3eme All")echo "selected='selected'"; ?>>3eme All</option>
                        <option value="3eme Esp" <?php if(isset($_SESSION['classe'])&& $_SESSION['classe']=="3eme Esp")echo "selected='selected'"; ?>>3eme Esp</option>
                        <option value="2nde C" <?php if(isset($_SESSION['classe'])&& $_SESSION['classe']=="2nde C")echo "selected='selected'"; ?>>2nde C</option>
                        <option value="2nde A" <?php if(isset($_SESSION['classe'])&& $_SESSION['classe']=="2nde A")echo "selected='selected'"; ?>>2nde A</option>
                        <option value="1ere C" <?php if(isset($_SESSION['classe'])&& $_SESSION['classe']=="1ere C")echo "selected='selected'"; ?>>1ere C</option>
                        <option value="1ere D" <?php if(isset($_SESSION['classe'])&& $_SESSION['classe']=="1ere D")echo "selected='selected'"; ?>>1ere D</option>
                        <option value="1ere A" <?php if(isset($_SESSION['classe'])&& $_SESSION['classe']=="1ere A")echo "selected='selected'"; ?>>1ere A</option>
                        <option value="Tle C" <?php if(isset($_SESSION['classe'])&& $_SESSION['classe']=="Tle C")echo "selected='selected'"; ?>>Tle C</option>
                        <option value="Tle D" <?php if(isset($_SESSION['classe'])&& $_SESSION['classe']=="Tle D")echo "selected='selected'"; ?> >Tle D</option>
                        <option value="Tle A" <?php if(isset($_SESSION['classe'])&& $_SESSION['classe']=="Tle A")echo "selected='selected'"; ?>>Tle A</option>
            </select><br>
            <label for="sexe">Sexe:</label><br>
            <input type="radio" name="sexe" value="1" id="Masc"><label for="Masc">Homme</label><br>
            <input type="radio" name="sexe" value="2" id="Fem"><label for="Fem">Femme</label><br>
            <input type="submit" value="Ajouter" name="add" class="btn btn-secondary"><br>
        </form>
    </div>
</section>
<script>
     if(document.querySelector("input#section").value=="student")
        {
            document.getElementById("add_student_section").style.display="block";
            document.getElementById("add_prof_section").style.display="none";
        }
        else if(document.querySelector("input#section").value=="teacher")
        {
            document.getElementById("add_student_section").style.display="none";
            document.getElementById("add_prof_section").style.display="block";
        }
        
    document.getElementById("button-add_student").addEventListener("click",function(e){
        e.preventDefault();
        document.querySelector("#add_student_section").style.display="block";
        document.getElementById("add_prof_section").style.display="none";
        alert("clique");
    });

    document.getElementById("button-add_prof").addEventListener("click",function(e){
        e.preventDefault();
        document.getElementById("add_prof_section").style.display="block";
        document.getElementById("add_student_section").style.display="none";
    });
    // var tab = document.querySelectorAll(".btn-cours-manaage");
    // for(var i=0; i<tab.length; i++)
    // {
    //     tab[i].addEventListener("click",function(){
    //         alert()
    //     })
    // }
</script>
<?php require "./view/footer.php"; ?>