<?php require "./view/header.php"; ?>

<section>
    <h3>SELECTIONNER LES COURS A ATTRIBUER AU PROFFESSEUR</h3>
    <form action="cours_manage.php?id_teacher=<?=$id?>" method="post" class="form-control" style="width: 100%;">
        <? foreach($tab_cours as $cours):?>
        <div class="check-cours">
        <div class="block">
            <input type="checkbox" name="cours[]" id='<?=$cours["nom_classe"]."_".$cours["nom_cours"]?>' value='<?=$cours["nom_classe"]."_".$cours["nom_cours"]?>'>
            <label for='<?=$cours["nom_classe"]."_".$cours["nom_cours"]?>'><?=$cours["nom_classe"].":".$cours["nom_cours"]?></label><br>
        </div>
        <? endforeach;?>
        </div>
        <input type="submit" name="attribuer" value="Attribuer" class="btn btn-primary">
    </form>
</section>

<style>
    .block{
        display: block;
        width: 20%;
        margin: 1%;
        background-color: silver;
    }
    .heck-cours{
        height: 500px;
        overflow: hidden;
        overflow-y: auto;
    }

    </style>

<?php require "./view/footer.php" ?>