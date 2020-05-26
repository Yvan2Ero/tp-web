<?php require"./view/header.view.php"; ?>

    <div id="section-profile">
        <div id="avatar">
            <img src="<?=$_SESSION['user_avatar']==null?$path.$default_avatar:$path.$_SESSION['user_avatar']?>" alt="avatar" width="120px", height="120px">
        </div>
        <span><i class="fa fa-user" style="color: gray"></i><strong>&nbsp;Pseudo:&nbsp;&nbsp;</strong><?= $_SESSION['user_pseudo']?><br></span>
        <span><i class="fa fa-envelope" style="color: gray"></i><strong>&nbsp;Email:&nbsp;&nbsp;</strong><?= $_SESSION['user_email']?><br></span>
</div>
<div class="edit-profile">
            <h2 style="text-align: center; color:seagreen;">Modifier le profile?</h2>
            <form method="post" enctype="multipart/form-data">
                <input type="text" name="new_pseudo" id="new_pseudo" value="<?$pseudo??null?>" placeholder="Nouveau pseudo...">
                <input type="email" name="new_email" id="new_email" value="<?$email??null?>" placeholder="Nouvel adresse e-mail...">
                <input type="file" name="avatar" id="avatarImg" accept="image/">
                <label id="avatar_" for="avatarImg">Importer une photo de profile</label>
                <button name="modifier" id="appliquer" type="submit">Appliquer!</button>
                <p style="color: red; text-align:center;"><?=$erreur??null?></p>
            </form>
        </div>
<? require "./view/footer.view.php";?>