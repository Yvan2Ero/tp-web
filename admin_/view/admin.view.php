<?php require"./view/header.php"; ?>
        <div >
            <h1>ESPACE PERSONNEL DE MISE EN LIGNE DES NOTES</h1>
            <?if(!empty($erreur)):?>
                <span class="alert alert-danger"><?=$erreur;?></span>
            <?endif;?>
            <form method="post" class="form form-control">
                <label for="classe">Classe: </label>
                <select name="classe" id="classe" class="form" >
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
                <input type="radio" class="form form-check-label" name="trimestre" value="1" id="trimestre1" <?if(isset($_SESSION['trimestre'])&& $_SESSION['trimestre']==1) echo "checked='checked'";elseif(empty($_SESSION['trimestre'])){ echo "checked='checked'";}?> ><label for="trimestre1">1er trimestre</label><br>
                <input type="radio" class="form form-check-label" name="trimestre" value="2" id="trimestre2" <?if(isset($_SESSION['trimestre'])&& $_SESSION['trimestre']==2) echo "checked='checked'";?> ><label for="trimestre2">2e trimestre</label><br>
                <input type="radio" class="form form-check-label" name="trimestre" value="3" id="trimestre3" <?if(isset($_SESSION['trimestre'])&& $_SESSION['trimestre']==3) echo "checked='checked'";?> ><label for="trimestre3">3e trimestre</label><br>
                <input type="submit" class="btn btn-primary" value="Afficher les eleves?">
            </form>
        </div><br>
        <? if(!empty($_SESSION["eleves"])): ?>
            <div class="container-fluid">
                    <?if(!empty($sucess)):?>
                    <div class="row"><div class="alert btn-success"><?=$sucess?></div></div>
                    <?endif?>
                <div class="row">
                    <?if(!empty($erreur_note)):?>
                    <div class="alert btn-danger"><?=$erreur_note?></div>
                    <?endif?><br><br>
                    <div class="col-md-10" style="height: 300px;overflow: hidden; overflow-y:scroll;">
                        <table class="table table-responsive-xl table-responsive-sm table-primary">
                            <tr>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Classe</th>
                                <th>Cours</th>
                                <th>Valeur</th>
                                <th>Ajouter</th>
                            </tr>
                        <? foreach($_SESSION["eleves"] as $eleve): ?>
                            <tr>
                                <form>
                                    <td><?=$eleve["nom_eleve"] ?></td>
                                    <td><?=$eleve["prenom_eleve"] ?></td>
                                    <td><?=$eleve["nom_classe"] ?></td>
                                    <td>
                                        <select name="nom_cours" id="">
                                            <? foreach($_SESSION['cours'] as $cour): ?>
                                                <option value="<?=$cour['nom_cours']?>" ><?=$cour['nom_cours']?></option>
                                            <? endforeach ?>
                                        </select>
                                    </td>
                                    <td><input type="text" class="form form-group" name="note" value="<?=$note_pr??null?>" ></td>
                                    <input type="hidden" name="id_eleve" value="<?=$eleve['id_eleve']?>">
                                    <td><input class="btn btn-success" type="submit" value="Attribuer la note"></td>
                                </form>
                            </tr>
                        <? endforeach ?>
                        </table>
                    </div>
                    <div class="col-md-2">
                        <table class="table table-responsive-x btn-successl">
                            <th>Eleve</th>
                            <th>Note</th>
                        </table>
                    </div>
                </div>
            </div>
        <? endif ?>
        <input type="hidden" id="actual_cours" value="<?php if(prof_autorisation())echo$_SESSION['cours_sel']; else echo "";?>">
        <input type="hidden" id="actual_classe"value="<?=$_SESSION['classe']??null?>">
        <script src="./js/request_note.js"></script>
<?php require "./view/footer.php" ?>
